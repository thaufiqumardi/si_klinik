<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Previlleges extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_previlleges','previlleges');
	}
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['previlleges'] = $this->previlleges->get_previlleges();
	
		$this->load->view('show',$data);
	}
	
	public function add_previlleges()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['hak_akses_role']		= $this->session->flashdata("hak_akses_role");
		$data['hak_akses_menu']		= $this->session->flashdata("hak_akses_menu");
		$data['hak_akses_create']	= $this->session->flashdata("hak_akses_create");
		$data['hak_akses_retrive']	= $this->session->flashdata("hak_akses_retrive");
		$data['hak_akses_update']	= $this->session->flashdata("hak_akses_update");
		$data['hak_akses_delete']	= $this->session->flashdata("hak_akses_delete");
		$data['arr_role']			= $this->previlleges->get_role();
		$data['arr_menu']			= $this->previlleges->get_menu();
	
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		 
		if(!empty($this->session->flashdata("hak_akses_role"))){
			$data['id_hak_akses']		= $id;
			$data['hak_akses_role']		= $this->session->flashdata("hak_akses_role");
			$data['hak_akses_menu']		= $this->session->flashdata("hak_akses_menu");
			$data['hak_akses_create']	= $this->session->flashdata("hak_akses_create");
			$data['hak_akses_retrive']	= $this->session->flashdata("hak_akses_retrive");
			$data['hak_akses_update']	= $this->session->flashdata("hak_akses_update");
			$data['hak_akses_delete']	= $this->session->flashdata("hak_akses_delete");
			$data['arr_role']			= $this->previlleges->get_role();
			$data['arr_menu']			= $this->previlleges->get_menu();
		}else{
			$query = $this->previlleges->edit($id);
			foreach ($query as $result){
				$data['id_hak_akses']		= $id;
				$data['hak_akses_role']		= $result->hak_akses_role;
				$data['hak_akses_menu']		= $result->hak_akses_menu;
				$data['hak_akses_create']	= $result->hak_akses_create;
				$data['hak_akses_retrive']	= $result->hak_akses_retrive;
				$data['hak_akses_update']	= $result->hak_akses_update;
				$data['hak_akses_delete']	= $result->hak_akses_delete;
			}
			$data['arr_role']			= $this->previlleges->get_role();
			$data['arr_menu']			= $this->previlleges->get_menu();
		}
	
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		$data = array(
				'hak_akses_role'    	=> $this->input->post('hak_akses_role', TRUE),
				'hak_akses_menu'    	=> $this->input->post('hak_akses_menu', TRUE),
				'hak_akses_create'    	=> $this->input->post('hak_akses_create',TRUE)==null ? 0 : 1,
				'hak_akses_retrive'    	=> $this->input->post('hak_akses_retrive',TRUE)==null ? 0 : 1,
				'hak_akses_update'    	=> $this->input->post('hak_akses_update',TRUE)==null ? 0 : 1,
				'hak_akses_delete'    	=> $this->input->post('hak_akses_delete',TRUE)==null ? 0 : 1,
				'hak_akses_search'    	=> 1,
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if($this->M_crud->check_table('hak_akses', 'hak_akses_role', $this->input->post('hak_akses_role', TRUE), 
							'hak_akses_menu', $this->input->post('hak_akses_menu', TRUE)) == NULL)
		{
			if(!$this->previlleges->create($data,'hak_akses'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil menginput data hak akses.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Previlleges');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("hak_akses_role", $this->input->post('hak_akses_role', TRUE));
				$this->session->set_flashdata("hak_akses_menu", $this->input->post('hak_akses_menu', TRUE));
				$this->session->set_flashdata("hak_akses_create", $this->input->post('hak_akses_create'));
				$this->session->set_flashdata("hak_akses_retrive", $this->input->post('hak_akses_retrive'));
				$this->session->set_flashdata("hak_akses_update", $this->input->post('hak_akses_update'));
				$this->session->set_flashdata("hak_akses_delete", $this->input->post('hak_akses_delete'));
				$this->session->set_flashdata("hak_akses_search", $this->input->post('hak_akses_search'));
				$this->session->set_flashdata('alert',$data);
				redirect('Previlleges/add_previlleges');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, hak akses untuk menu dan tipe akses ini sudah ada.',
			);
			$this->session->set_flashdata("hak_akses_role", $this->input->post('hak_akses_role', TRUE));
			$this->session->set_flashdata("hak_akses_menu", $this->input->post('hak_akses_menu', TRUE));
			$this->session->set_flashdata("hak_akses_create", $this->input->post('hak_akses_create'));
			$this->session->set_flashdata("hak_akses_retrive", $this->input->post('hak_akses_retrive'));
			$this->session->set_flashdata("hak_akses_update", $this->input->post('hak_akses_update'));
			$this->session->set_flashdata("hak_akses_delete", $this->input->post('hak_akses_delete'));
			$this->session->set_flashdata("hak_akses_search", $this->input->post('hak_akses_search'));
			$this->session->set_flashdata('alert',$data);
			redirect('Previlleges/add_previlleges');
		}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
	
		$data = array(
				'hak_akses_create'    	=> $this->input->post('hak_akses_create',TRUE)==null ? 0 : 1,
				'hak_akses_retrive'    	=> $this->input->post('hak_akses_retrive',TRUE)==null ? 0 : 1,
				'hak_akses_update'    	=> $this->input->post('hak_akses_update',TRUE)==null ? 0 : 1,
				'hak_akses_delete'    	=> $this->input->post('hak_akses_delete',TRUE)==null ? 0 : 1,
				'hak_akses_search'    	=> 1,
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
	
		if(!$this->previlleges->update($id,$data,'id_hak_akses','hak_akses'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data hak akses.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Previlleges');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
			);
			$this->session->set_flashdata("hak_akses_role", $this->input->post('hak_akses_role', TRUE));
			$this->session->set_flashdata("hak_akses_menu", $this->input->post('hak_akses_menu', TRUE));
			$this->session->set_flashdata("hak_akses_create", $this->input->post('hak_akses_create'));
			$this->session->set_flashdata("hak_akses_retrive", $this->input->post('hak_akses_retrive'));
			$this->session->set_flashdata("hak_akses_update", $this->input->post('hak_akses_update'));
			$this->session->set_flashdata("hak_akses_delete", $this->input->post('hak_akses_delete'));
			$this->session->set_flashdata("hak_akses_search", $this->input->post('hak_akses_search'));
			redirect("Previlleges/edit/$id");
		}
	}
	
	function delete($id)
	{
		if(!$this->previlleges->delete('id_hak_akses',$id,'hak_akses'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data hak akses.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Previlleges');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Previlleges");
		}
	}
	
	function cetak()
	{
		$data['hakakses']=$this->previlleges->get_previlleges();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Tipe Akses',
				'Menu',
				'Tampil',
				'Tambah',
				'Ubah',
				'Hapus'
		];
		 
		$dataList = array();
		$list = $this->previlleges->get_previlleges();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->role_name;
			$row[] = $datas->name;
			$row[] = $datas->hak_akses_retrive;
			$row[] = $datas->hak_akses_create;
			$row[] = $datas->hak_akses_update;
			$row[] = $datas->hak_akses_delete;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Hak_Akses_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
	
}