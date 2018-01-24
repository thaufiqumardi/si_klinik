<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Diagnosa extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_diagnosa','modelDiagnosa');
	}
	
	function index(){
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['diagnosas']=$this->modelDiagnosa->get_diagnosa();
		
		$this->load->view('show',$data);
	}
	
	function add_diagnosa()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['nama_diagnosa']		= $this->session->flashdata("nama_diagnosa");
    	$data['kode_icd']			= $this->session->flashdata("kode_icd");
		
		$this->load->view('form',$data);
	}
	
	function edit($id){
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();    	
		
    	if(!empty($this->session->flashdata("nama_diagnosa"))){
    		$data['id_diagnosa']	= $id;
    		$data['nama_diagnosa']	= $this->session->flashdata("nama_diagnosa");
    		$data['kode_icd']		= $this->session->flashdata("kode_icd");
    	}else{
    		$query = $this->modelDiagnosa->edit($id);
    		foreach ($query as $result){
    			$data['id_diagnosa']	= $id;
    			$data['nama_diagnosa']	= $result->nama_diagnosa;
    			$data['kode_icd']		= $result->kode_icd;
    		}
    	}
		
		$this->load->view('form',$data);
	}
	
	function insert()
	{		
    	$data = array(
			'nama_diagnosa' => $this->input->post('nama_diagnosa', TRUE), 
			'kode_icd' => $this->input->post('kode_icd', TRUE), 
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
    	
    	if($this->M_crud->check_table('diagnosa', 'nama_diagnosa', $this->input->post('nama_diagnosa', TRUE)) == NULL){
    			if($this->M_crud->check_table('diagnosa', 'kode_icd', $this->input->post('kode_icd', TRUE)) != NULL){
    				$data = array(
    						'class' => '0',
    						'msg' => '<strong>Maaf</strong>, Kode ICD yang anda masukan sudah ada.',
    				);
    				$this->session->set_flashdata("nama_diagnosa", $this->input->post('nama_diagnosa', TRUE));
    				$this->session->set_flashdata("kode_icd", $this->input->post('kode_icd', TRUE));
    				$this->session->set_flashdata('alert',$data);
    				redirect('Diagnosa/add_diagnosa');
    			}
    			else{
    				if(!$this->modelDiagnosa->create($data,'diagnosa'))
    				{
    					$data = array(
    							'class' => '1',
    							'msg' => '<strong>Selamat</strong>, anda berhasil menginput data ICD.',
    					);
    					$this->session->set_flashdata('alert',$data);
    					redirect('Diagnosa');
    				}
    				else
    				{
    					$data = array(
    							'class' => '0',
    							'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
    					);
    					$this->session->set_flashdata("nama_diagnosa", $this->input->post('nama_diagnosa', TRUE));
    					$this->session->set_flashdata("kode_icd", $this->input->post('kode_icd', TRUE));
    					$this->session->set_flashdata('alert',$data);
    					redirect('Diagnosa/add_diagnosa');
    				}
    			}
    	}else{
    		$data = array(
    				'class' => '0',
    				'msg' => '<strong>Maaf</strong>, Nama Diagnosa yang anda masukan sudah ada.',
    		);
    		$this->session->set_flashdata("nama_diagnosa", $this->input->post('nama_diagnosa', TRUE));
    		$this->session->set_flashdata("kode_icd", $this->input->post('kode_icd', TRUE));
    		$this->session->set_flashdata('alert',$data);
    		redirect('Diagnosa/add_diagnosa');
    	}
	}
	
	function update()
	{
		$id = $this->input->post('id', TRUE);
		$getdata = $this->M_crud->get_by_id('diagnosa', 'id_diagnosa', $id);
		$existing_kode = $getdata->kode_icd;
		$existing_diagnosa = $getdata->nama_diagnosa;
		$status_exs = TRUE;
	
		if($existing_kode <> $this->input->post('kode_icd', TRUE)){
			if($existing_diagnosa <> $this->input->post('nama_diagnosa', TRUE)){
				if($this->M_crud->check_table('diagnosa', 'kode_icd', $this->input->post('kode_icd', TRUE),
						'nama_diagnosa', $this->input->post('nama_diagnosa', TRUE)) != NULL){
						if($existing_diagnosa <> $this->input->post('nama_diagnosa', TRUE)){
							if($this->M_crud->check_table('diagnosa', 'kode_icd', $this->input->post('kode_icd', TRUE),
									'nama_diagnosa', $this->input->post('nama_diagnosa', TRUE)) != NULL){
									$status_exs = FALSE;
							}
					}
				}
			}else{
				if($this->M_crud->check_table('diagnosa', 'kode_icd', $this->input->post('kode_icd', TRUE)) != NULL){
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, ICD yang anda masukan sudah ada.',
					);
					$this->session->set_flashdata("nama_diagnosa", $this->input->post('nama_diagnosa', TRUE));
					$this->session->set_flashdata("kode_icd", $this->input->post('kode_icd', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Diagnosa/edit/$id");
				}
			}
			
			if($this->M_crud->check_table('diagnosa', 'kode_icd', $this->input->post('kode_icd', TRUE)) != NULL){
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, ICD yang anda masukan sudah ada.',
				);
				$this->session->set_flashdata("nama_diagnosa", $this->input->post('nama_diagnosa', TRUE));
				$this->session->set_flashdata("kode_icd", $this->input->post('kode_icd', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Diagnosa/edit/$id");
			}
		}
	
		$data = array(
				'kode_icd' => $this->input->post('kode_icd', TRUE),
				'nama_diagnosa' => $this->input->post('nama_diagnosa', TRUE),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
	
		if($status_exs == TRUE)
		{
			if(!$this->modelDiagnosa->update($id,$data,'id_diagnosa','diagnosa'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data ICD.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Diagnosa');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("nama_diagnosa", $this->input->post('nama_diagnosa', TRUE));
				$this->session->set_flashdata("kode_icd", $this->input->post('kode_icd', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Diagnosa/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, ICD yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("nama_diagnosa", $this->input->post('nama_diagnosa', TRUE));
			$this->session->set_flashdata("kode_icd", $this->input->post('kode_icd', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Diagnosa/edit/$id");
		}
	}
	
	function delete($id)
    {			
		if(!$this->modelDiagnosa->delete('id_diagnosa',$id,'diagnosa'))
		{
			$data = array(
			'class' => '1',
			'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data ICD.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Diagnosa');
		}
		else
		{
			$data = array(
				'class' => '0',
				'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Diagnosa");
		}

		
    }
    
	function cetak(){
		$data['diagnosa']=$this->modelDiagnosa->get_diagnosa();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Kode ICD',
				'Nama Diagnosa'
		];
		 
		$dataList = array();
		$list = $this->modelDiagnosa->get_diagnosa();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->kode_icd;
			$row[] = $datas->nama_diagnosa;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_ICD_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
}