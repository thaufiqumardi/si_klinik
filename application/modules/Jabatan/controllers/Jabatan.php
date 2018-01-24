<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Jabatan extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_jabatan','jabatan');
	}
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		$data['jabatan'] = $this->jabatan->get_jabatan();
	
		$this->load->view('show',$data);
	}
	
	public function add_jabatan()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		$data['nama_jabatan']		= $this->session->flashdata("nama_jabatan");
	
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		 
		if(!empty($this->session->flashdata("nama_jabatan"))){
			$data['id_jabatan']			= $id;
			$data['nama_jabatan']		= $this->session->flashdata("nama_jabatan");
		}else{
			$query = $this->jabatan->edit($id);
			foreach ($query as $result){
				$data['id_jabatan']			= $id;
				$data['nama_jabatan']		= $result->nama_jabatan;
			}
		}
	
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		$data = array(
				'nama_jabatan' => $this->input->post('nama_jabatan', TRUE),
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if($this->M_crud->check_table('jabatan', 'nama_jabatan', $this->input->post('nama_jabatan', TRUE)) == NULL)
		{
			if(!$this->jabatan->create($data,'jabatan'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil menginput data jabatan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Jabatan');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("nama_jabatan", $this->input->post('nama_jabatan', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Jabatan/add_jabatan');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Jabatan yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("nama_jabatan", $this->input->post('nama_jabatan', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect('Jabatan/add_jabatan');
		}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
	
		$data = array(
				'nama_jabatan' => $this->input->post('nama_jabatan', TRUE),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
	
		if($this->M_crud->check_table('jabatan', 'nama_jabatan', $this->input->post('nama_jabatan', TRUE)) == NULL)
		{
			if(!$this->jabatan->update($id,$data,'id_jabatan','jabatan'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data jabatan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Jabatan');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("nama_jabatan", $this->input->post('nama_jabatan', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Jabatan/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Jabatan yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("nama_jabatan", $this->input->post('nama_jabatan', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Jabatan/edit/$id");
		}
	}
	
	function delete($id)
	{
		if(!$this->jabatan->delete('id_jabatan',$id,'jabatan'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data jabatan.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Jabatan');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Jabatan");
		}
	}
	
	function cetak()
	{
		$data['jabatan']=$this->jabatan->get_jabatan();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Jabatan'
		];
		 
		$dataList = array();
		$list = $this->jabatan->get_jabatan();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->nama_jabatan;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Jabatan_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
	
}