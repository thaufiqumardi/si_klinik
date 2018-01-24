<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Obat extends MX_Controller {

	function __construct()
	{
     	parent::__construct();
      	$this->load->model('M_obat','modelObat');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();

    	$data['obat'] = $this->modelObat->get_joined('obat');
		$this->load->view('index',$data);
	}

	public function form($id=FALSE)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();

		$data['kat'] = $this->modelObat->get_kategori();
		$data['merk'] = $this->modelObat->get_merk();
		$data['satuan']=$this->modelObat->get_satuan();
		$data['supplier']=$this->modelObat->get_supplier();
		if($id===false){
			$this->load->view('form_obat',$data);
		}
		else{
			$arr= array('id_obat'=>$id);
			$data['obat']=$this->modelObat->get_spesific('obat',$arr);
			$this->load->view('form_obat',$data);
		}
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_obat','Nama Obat','is_unique[obat.nama_obat]');
		if($this->form_validation->run()===FALSE){
			$data=array(
				'class'=>'0',
				'msg'=>'Penambahan Obat Gagal, Karena Sudah Ada',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('obat/form');
		}
		else {
			$data=array(
				'kode_obat'=>$this->input->post('kode_obat'),
				'nama_obat'=>$this->input->post('nama_obat'),
				'id_kategori'=>$this->input->post('id_kategori'),
				'id_merk'=>$this->input->post('id_merk'),
				'id_satuan'=>$this->input->post('id_satuan'),
				'id_supplier'=>$this->input->post('id_supplier'),
				'stok'	=> $this->input->post('stok'),
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->modelObat->insert('obat',$data);
				$data=array(
				'class'=>'1',
				'msg'=>'Penambahan Data Obat Berhasil Dilakukan'
			);
			$this->session->set_flashdata('alert',$data);
			redirect('obat');
		}
	}

	public function update($id)
	{
		$getdata = $this->M_crud->get_by_id('obat', 'id_obat', $id);
		$existing_obat = $getdata->nama_obat;
		$status_exs = TRUE;

		if($existing_obat <> $this->input->post('nama_obat', TRUE)){
			if($this->M_crud->check_table('obat', 'nama_obat', $this->input->post('nama_obat', TRUE)) != NULL){
					$status_exs = FALSE;
			}
		}

		if($status_exs == TRUE){
			$data=array(
					'nama_obat'=>$this->input->post('nama_obat'),
					'id_kategori'=>$this->input->post('id_kategori'),
					'id_merk'=>$this->input->post('id_merk'),
					'id_satuan'=>$this->input->post('id_satuan'),
					'id_supplier'=>$this->input->post('id_supplier'),
					'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$query = $this->modelObat->update('obat',$data,$id);
			if($query==0){
				$data=array(
						'class'=>'0',
						'msg'=>'Perubahan Data Obat Gagal, Karena Sudah Ada',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('obat/form');
			}
			else {
				$data=array(
						'class'=>'1',
						'msg'=>'Perubahan Data Obat Berhasil Dilakukan'
				);
				$this->session->set_flashdata('alert',$data);
				redirect('obat');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Obat/Alkes yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Obat/form/$id");
		}
	}

	public function hapus($id)
	{
		$query = $this->modelObat->hapus('obat',$id);
			if($query==0){
				$data=array(
					'class'=>'0',
					'msg'=>'Hapus Data Obat Gagal',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('obat/form');
			}
			else {
				$data=array(
				'class'=>'1',
				'msg'=>'Hapus Data Obat Berhasil Dilakukan'
				);
				$this->session->set_flashdata('alert',$data);
				redirect('obat');
			}
	}

	function cetak()
	{
		$data['obat']=$this->modelObat->get_joined('obat');
		$this->load->view('print',$data);
	}

	function doexport()
	{
		$header = [
				'No',
				'Nama Obat/Alkes',
				'Kategori',
				'Merk',
				'Satuan',
				'Supplier',
		];

		$dataList = array();
		$list = $this->modelObat->get_joined('obat');
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->nama_obat;
			$row[] = $datas->nama_kategori;
			$row[] = $datas->merk_nama;
			$row[] = $datas->satuan_nama;
			$row[] = $datas->nama_supplier;
			$dataList[] = $row;
		}

		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Obat_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
}
