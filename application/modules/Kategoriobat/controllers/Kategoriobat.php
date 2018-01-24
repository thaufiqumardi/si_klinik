<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Kategoriobat extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_kategoriobat','modelKategoriobat');
	}
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['merk'] = $this->modelKategoriobat->get_kategori();
	
		$this->load->view('show',$data);
	}
	
	public function add_kategoriobat()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['nama_kategori']		= $this->session->flashdata("nama_kategori");
	
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		 
		if(!empty($this->session->flashdata("nama_kategori"))){
			$data['id_kategori']		= $id;
			$data['nama_kategori']		= $this->session->flashdata("nama_kategori");
		}else{
			$query = $this->modelKategoriobat->edit($id);
			foreach ($query as $result){
				$data['id_kategori']		= $id;
				$data['nama_kategori']		= $result->nama_kategori;
			}
		}
	
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori', TRUE),
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if($this->M_crud->check_table('kategori', 'nama_kategori', $this->input->post('nama_kategori', TRUE)) == NULL)
		{
			if(!$this->modelKategoriobat->create($data,'kategori'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil menginput data merk.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Kategoriobat');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("nama_kategori", $this->input->post('nama_kategori', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Kategoriobat/add_kategoriobat');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, MErk yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("nama_kategori", $this->input->post('nama_kategori', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect('Kategoriobat/add_kategoriobat');
		}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
	
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori', TRUE),
			'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
	
		if($this->M_crud->check_table('kategori', 'nama_kategori', $this->input->post('nama_kategori', TRUE)) == NULL)
		{
			if(!$this->modelKategoriobat->update($id,$data,'id_kategori','kategori'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data kategori.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Kategoriobat');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("nama_kategori", $this->input->post('nama_kategori', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Kategoriobat/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Kategori yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("nama_kategori", $this->input->post('nama_kategori', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Kategoriobat/edit/$id");
		}
	}
	
	function delete($id)
	{
		if(!$this->modelKategoriobat->delete('id_kategori',$id,'kategori'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data kategori.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Kategoriobat');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Kategoriobat");
		}
	}
	
	function cetak()
	{
		$data['kategori']=$this->modelKategoriobat->get_kategori();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Kategori'
		];
		 
		$dataList = array();
		$list = $this->modelKategoriobat->get_kategori();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->nama_kategori;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Kategori_Obat_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
	
}