<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Role extends MX_Controller {
	 
	function __construct()
    {
      parent::__construct();
      $this->load->model('M_role','role');	  
    }

	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['role'] = $this->role->get_role();
		
		$this->load->view('show',$data);
	}	

	public function add_role()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['role_name']			= $this->session->flashdata("role_name");
	
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		 
		if(!empty($this->session->flashdata("role_name"))){
			$data['role_id']			= $id;
			$data['role_name']			= $this->session->flashdata("role_name");
		}else{
			$query = $this->role->edit($id);
			foreach ($query as $result){
				$data['role_id']			= $id;
				$data['role_name']			= $result->role_name;
			}
		}
	
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		$data = array(
				'role_name' => $this->input->post('role_name', TRUE),
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if($this->M_crud->check_table('role', 'role_name', $this->input->post('role_name', TRUE)) == NULL)
		{
			if(!$this->role->create($data,'role'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil menginput data tipe akses.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Role');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("role_name", $this->input->post('role_name', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Role/add_role');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Tipe akses yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("role_name", $this->input->post('role_name', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect('Role/add_role');
		}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
	
		$data = array(
				'role_name' => $this->input->post('role_name', TRUE),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
	
		if($this->M_crud->check_table('role', 'role_name', $this->input->post('role_name', TRUE)) == NULL)
		{
			if(!$this->role->update($id,$data,'role_id','role'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data tipe akses.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Role');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("role_name", $this->input->post('role_name', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Role/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Tipe akses yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("role_name", $this->input->post('role_name', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Role/edit/$id");
		}
	}
	
	function delete($id)
	{
		if(!$this->role->delete('role_id',$id,'role'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data tipe akses.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Role');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Role");
		}
	}
	
	function cetak()
	{
		$data['role']=$this->role->get_role();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Tipe Akses'
		];
		 
		$dataList = array();
		$list = $this->role->get_role();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->role_name;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Tipe_Akses_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
}
