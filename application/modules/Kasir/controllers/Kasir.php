<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends MX_Controller {

	function __construct()
    {
      parent::__construct();
      $this->load->model('M_kasir','modelKasir');
    }

	public function index(){
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		$this->load->view('show');
	}
	function getObatByKd($kd_obat){
		$obat = $this->modelKasir->getObatByKodeObat($kd_obat);
		echo json_encode($obat);
	}
	function getDetail($no_registrasi){
		$list = $this->modelKasir->get_detail($no_registrasi);
		$data = array();
		$no = 0;
		foreach ($list as $op) {
			$no++;
			$row = array();
			$row[] = $op->id_pembiayaan;
			$row[] = $op->nama_item;
			$row[] = $op->harga;
			if(is_null($op->satuan)){
				$row[] = "";
			}else{
				$row[] = $op->satuan;
			}
			$row[] = $op->qty;
			$row[] = $op->total_harga;
			$data[] = $row;
		}
		echo json_encode($data);
	}
	function SimpanTransaksi(){
		$id_registrasi = $this->input->post('id_reg');
		$get_registrasi = $this->M_crud->check_table('registrasi_pasien','id_registrasi',$id_registrasi);
		$id_bed = $get_registrasi->id_bed;
		$no_registrasi = $get_registrasi->no_registrasi;

		if(!is_null($id_bed) or !empty($id_bed)){
			$data_bed = array(
					'status_isi' => 'KOSONG',
					'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->modelKasir->update($id_bed,$data_bed,'id_bed','bed');
		}

		$data_registrasi = array(
				'status_registrasi' => '1',
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		$this->modelKasir->update($id_registrasi,$data_registrasi,'id_registrasi','registrasi_pasien');

		$total_bayar = 0;

		$no_kuitansi = $this->modelKasir->get_nomor_kuitansi();

		foreach($_POST['nomor'] as $i){
			$id_pembiayaan = $this->input->post('id_pembiayaan'.$i);
			$list = $this->modelKasir->get_pembiayaan($id_pembiayaan);
			foreach ($list as $pembiayaan) {

				$total_bayar = $total_bayar + $pembiayaan->total_harga;

				$data_pemasukan = array(
						'no_kuitansi' => $no_kuitansi,
						'no_registrasi' => $pembiayaan->no_registrasi,
						'tgl_pemasukan' => $pembiayaan->tgl_registrasi,
						'nama_pemasukan' => $pembiayaan->nama_item,
						'jenis_pemasukan' => $pembiayaan->jenis_item,
						'harga_pemasukan' => $pembiayaan->harga,
						'qty_pemasukan' => $pembiayaan->qty,
						'total_pemasukan' => $pembiayaan->total_harga,
						'created_by' => $this->session->userdata['simklinik']['ap_sid'],
				);

				$this->modelKasir->create($data_pemasukan,'pemasukan');
			}
		}

		$get_piutang = $this->M_crud->check_table('piutang','no_registrasi',$no_registrasi);
		$id_piutang = $get_piutang->piutang_id;
		$juml_total = $get_piutang->total_biaya;
		$juml_bayar = $get_piutang->total_bayar;
		$sisa_bayar = $get_piutang->sisa_bayar;
		$juml_bayar = $juml_bayar + $total_bayar;
		$sisa_bayar = $sisa_bayar - $total_bayar;

		if($juml_total = $juml_bayar){
			$status_piutang = 1;
		}else{
			$status_piutang = 0;
		}

		$data_piutang = array(
				'total_bayar' => $juml_bayar,
				'sisa_bayar' => $sisa_bayar,
				'status' => $status_piutang,
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		$this->modelKasir->update($id_piutang,$data_piutang,'piutang_id','piutang');

		$data_pembiayaan = array(
				'status_bayar' => '1',
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		$this->modelKasir->update2('id_registrasi', $id_registrasi, 'status_bayar', '0', $data_pembiayaan, 'detail_pembiayaan');

		$data['status'] = TRUE;
		$data['no_kuitansi'] = $no_kuitansi;

		echo json_encode($data);
	}
	function CetakTransaksi($no_kuitansi){
		$location = 'logo';
		$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
		$data['imgpath'] = $path_to_file;
		$data['head'] = $this->modelKasir->get_head_transaksi($no_kuitansi);
		$data['details'] = $this->modelKasir->get_detail_transaksi($no_kuitansi);
		$this->load->view('print',$data);
		$html = $this->output->get_output();
		$this->pdf->load_html($html);
		$this->pdf->set_paper("A4","potrait");
		$this->pdf->render();
		$this->pdf->stream('KuitansiPembayaran'.$no_registrasi,array("Attachment"=>0));
	}
	function cetak(){
		$nomor = $this->modelKasir->get_nomor_kuitansi();
		echo $nomor;
	}

}
