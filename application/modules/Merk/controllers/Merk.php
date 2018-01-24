<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;


class Merk extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_merk','modelMerk');
	}
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['merk'] = $this->modelMerk->get_merk();
	
		$this->load->view('show',$data);
	}
	
	public function add_merk()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['merk_nama']		= $this->session->flashdata("merk_nama");
	
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		 
		if(!empty($this->session->flashdata("merk_nama"))){
			$data['merk_id']		= $id;
			$data['merk_nama']		= $this->session->flashdata("merk_nama");
		}else{
			$query = $this->modelMerk->edit($id);
			foreach ($query as $result){
				$data['merk_id']		= $id;
				$data['merk_nama']		= $result->merk_nama;
			}
		}
	
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		$data = array(
			'merk_nama' => $this->input->post('merk_nama', TRUE),
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if($this->M_crud->check_table('merk', 'merk_nama', $this->input->post('merk_nama', TRUE)) == NULL)
		{
			if(!$this->modelMerk->create($data,'merk'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil menginput data merk.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Merk');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("merk_nama", $this->input->post('merk_nama', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Merk/add_merk');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Merk yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("merk_nama", $this->input->post('merk_nama', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect('Merk/add_merk');
		}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
	
		$data = array(
			'merk_nama' => $this->input->post('merk_nama', TRUE),
			'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
	
		if($this->M_crud->check_table('merk', 'merk_nama', $this->input->post('merk_nama', TRUE)) == NULL)
		{
			if(!$this->modelMerk->update($id,$data,'merk_id','merk'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data merk.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Merk');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("merk_nama", $this->input->post('merk_nama', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Merk/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Merk yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("merk_nama", $this->input->post('merk_nama', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Merk/edit/$id");
		}
	}
	
	function delete($id)
	{
		if(!$this->modelMerk->delete('merk_id',$id,'merk'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data merk.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Merk');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Merk");
		}
	}
	
	function cetak()
	{
		$data['merk']=$this->modelMerk->get_merk();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Merk'
		];
		 
		$dataList = array();
		$list = $this->modelMerk->get_merk();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->merk_nama;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Merk_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
	
}