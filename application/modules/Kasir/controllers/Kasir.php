<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once APPPATH."third_party/printpos/autoload.php";

class Kasir extends MX_Controller {

	function __construct()
    {
      parent::__construct();
			$this->load->model('M_kasir','modelKasir');
			$this->load->model('Pasien/M_pasien','modelPasien');
			$this->load->model('Pemeriksaan/M_pemeriksaan','modelPemeriksaan');
    }

	public function index(){
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		$data['no_kuitansi']=$this->modelKasir->get_nomor_kuitansi();
		
		$this->load->view('show',$data);
	}
	function pemeriksaan(){
		$data['registered']=$this->modelKasir->get_belum_bayar();
		$this->load->view('kasir_pemeriksaan',$data);
	}
	function bayar_pemeriksaan($id_registrasi){
		$data['pasien']   = $this->modelKasir->get_pasien_by_registrasi($id_registrasi);
		$data['sub_total'] = 0;
		$data['detail_pembiayaan'] = $this->modelKasir->get_pembiayaan($id_registrasi);
		$data['no_kuitansi']=$this->modelKasir->get_nomor_kuitansi();
		foreach($data['detail_pembiayaan'] as $detail_pembiayaan){
			$data['sub_total'] += $detail_pembiayaan->total_harga;
		}
		$this->load->view('show_pemeriksaan',$data);
	}
	function getObatByKd($kd_obat){
		$obat = $this->modelKasir->getObatByKodeObat($kd_obat);
		$obat->harga_jual1 = $this->M_base->currFormat2($obat->harga_jual1);
		$obat->harga_jual1 = substr($obat->harga_jual1,0,-3);
		echo json_encode($obat);
	}
	function CetakTransaksi($no_kuitansi){
		$data['detail_pemasukan']=$this->M_crud->get_by_id('pemasukan','no_kuitansi',$no_kuitansi);
		$id_registrasi = $data['detail_pemasukan']->id_registrasi;
		$data['pasien']   = $this->modelKasir->get_pasien_by_registrasi($id_registrasi);
		$data['transaksi'] = $this->M_crud->get_select_to_array('*','transaksi_kasir','obat','transaksi_kasir.id_barang=obat.id_obat','no_kuitansi',$no_kuitansi);
		// echo json_encode($data);
		// die;
		if(!empty($id_registrasi)){
			$data['detail_berobat'] = $this->modelKasir->get_pembiayaan($id_registrasi);
			// echo json_encode($data['detail_berobat']);
			$this->load->view('print_pembiayaan',$data);
		} else {
			$this->load->view('print',$data);
		}
		
	}
	function transaksiBarang(){
		if($_POST){
			$id_obat = $this->input->post('id_barang');
			$harga = str_replace(".","",$this->input->post('harga_barang'));
			$qty = $this->input->post('jumlah_barang');
			$total_harga = $harga * $qty;
			// $no_kuitansi = $this->modelKasir->get_nomor_kuitansi();
			$data = array(
				'id_barang'=> $id_obat,
				'id_satuan'=>$this->input->post('id_satuan'),
				'harga_barang'=>$harga,
				'qty_barang'=>$qty,
				'no_kuitansi'=>$this->input->post('no_kuitansi'),
				'total_harga'=>$total_harga,
			);
			$obat = $this->M_crud->get_by_id('obat','id_obat',$id_obat);
			$sisa = $obat->stok - $qty;
			$stok_sisa = array(
				'stok'=>$sisa,
			);
			$this->M_crud->_update('obat','id_obat',$id_obat,$stok_sisa);
			$this->M_crud->_insert('transaksi_kasir',$data);
			// return;
		}
	}
	function getTransaksiNow($no_kuitansi){
		$trx = $this->modelKasir->getTransaksiObatNow($no_kuitansi);
		echo json_encode($trx);
	}
	function getSubTotal($no_kuitansi){
		$transaksi = $this->M_crud->get_by_param_to_array('transaksi_kasir','no_kuitansi',$no_kuitansi);
		// $data = array();
		$sub_total = 0;
		foreach ($transaksi as $tr) {
			$sub_total = $sub_total+$tr->total_harga;
		}
		$data['sub_total'] = $sub_total;
		echo json_encode($data);
	}
	function simpanPemasukan(){
		$id_registrasi =$this->input->post('id_registrasi');
		$harga = str_replace('.','',$this->input->post('total_bayar'));
		$uang_bayar = str_replace(",","",$this->input->post('jmlh_bayar'));
		$uang_kembalian = str_replace('.','',$this->input->post('kembalian'));
		$qty = 1;
		$total = $harga * $qty;
		$no_kuitansi = $this->input->post('no_kuitansi_pemasukan');
		if(!empty($id_registrasi)){
			$nama_pemasukan	= "Pasien Berobat";
			$jenis_pemasukan	= "Pasien Berobat";
		} else {
			$nama_pemasukan		= "Transaksi Obat Apotek";
			$jenis_pemasukan	=	"Obat";
		}
		$data = array(
			'no_kuitansi'=>$no_kuitansi,
			'id_registrasi'=>$id_registrasi,
			'nama_pemasukan'=>$nama_pemasukan,
			'jenis_pemasukan'=>$jenis_pemasukan,
			'harga_pemasukan'=>$harga,
			'qty_pemasukan'=>$qty,
			'total_pemasukan'=>$total,
			'uang_bayar'=>$uang_bayar,
			'uang_kembalian'=>$uang_kembalian,
			'created_by'=>$this->session->userdata['simklinik']['ap_sid']
		);
		if(!empty($id_registrasi)){
			$resep = $this->modelKasir->get_pembiayaan_obat($id_registrasi);
		
			for($i=0; $i < count($resep); $i++){
				$obat = $this->M_crud->get_by_id('obat','id_obat',$resep[$i]->item_id);
				$stok_ada = $obat->stok;
				$stok_sisa = $stok_ada - $resep[$i]->qty ;
				$updated = array (
					'stok'=>$stok_sisa,
				);
				$this->M_crud->_update('obat','id_obat',$obat->id_obat,$updated);
			}
			$update_pembiayaan = array(
				'status_bayar'=>1,
			);
			$this->M_crud->_update('registrasi_pasien','id_registrasi',$id_registrasi,$update_pembiayaan);
			$this->M_crud->_update('detail_pembiayaan','id_registrasi',$id_registrasi,$update_pembiayaan);
		}
		$this->M_crud->_insert('pemasukan',$data);
		redirect('Kasir/CetakTransaksi/'.$no_kuitansi);
	}
	function batalTransaksi($no_kuitansi){
		$this->M_crud->_delete('transaksi_kasir','no_kuitansi',$no_kuitansi);
		redirect('kasir');
	}
	function hapusItem($id_transaksi){
		$obat_trx = $this->M_crud->get_by_id('transaksi_kasir','id_transaksi',$id_transaksi);
		$obat = $this->M_crud->get_by_id('obat','id_obat',$obat_trx->id_barang);
		$stok_balik = $obat->stok + $obat_trx->qty_barang;
		$data = array(
			'stok'=>$stok_balik,
		);
		$this->M_crud->_update('obat','id_obat',$obat_trx->id_barang,$data);
		$this->M_crud->_delete('transaksi_kasir','id_transaksi',$id_transaksi);
		redirect('kasir');
	}
}
