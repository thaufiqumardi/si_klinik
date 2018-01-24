<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Bed extends MX_Controller {
	 
	function __construct()
    {
      parent::__construct();
      $this->load->model('M_bed','modelBed');	  
    }
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['bed'] = $this->modelBed->get_bed();
		
		$this->load->view('show',$data);
	}
	
	public function add_bed()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['id_kamar']		= $this->session->flashdata("id_kamar");
    	$data['nama_bed']		= $this->session->flashdata("nama_bed");
    	$data['status_isi']		= $this->session->flashdata("status_isi");
		$data['arr_kamar']		= $this->modelBed->get_kamar();
		
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();    	

		$data['arr_kamar']			= $this->modelBed->get_kamar();
		
    	if(!empty($this->session->flashdata("nama_bed"))){
    		$data['id_bed']			= $id;
    		$data['id_kamar']		= $this->session->flashdata("id_kamar");
    		$data['nama_bed']		= $this->session->flashdata("nama_bed");
    		$data['status_isi']		= $this->session->flashdata("status_isi");
    	}else{
    		$query = $this->modelBed->edit($id);
    		foreach ($query as $result){
    			$data['id_bed']			= $id;
    			$data['id_kamar']		= $result->id_kamar;
    			$data['nama_bed']		= $result->nama_bed;
    			$data['status_isi']		= $result->status_isi;
    		}
    	}
		
		$this->load->view('form',$data);
	}
	
	public function insert()
	{		
    	$data = array(
			'id_kamar' => $this->input->post('id_kamar', TRUE), 
			'nama_bed' => $this->input->post('nama_bed', TRUE), 
			'status_isi' => $this->input->post('status_isi', TRUE),
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
    	
    	if($this->M_crud->check_table('bed', 'id_kamar', $this->input->post('id_kamar', TRUE),
    				'nama_bed', $this->input->post('nama_bed', TRUE)) == NULL)
    	{
	    	if(!$this->modelBed->create($data,'bed'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menginput data bed.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Bed');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("id_kamar", $this->input->post('id_kamar', TRUE));
				$this->session->set_flashdata("nama_bed", $this->input->post('nama_bed', TRUE));
				$this->session->set_flashdata("status_isi", $this->input->post('status_isi', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Bed/add_bed');
			}
    	}else{
    		$data = array(
    				'class' => '0',
    				'msg' => '<strong>Maaf</strong>, Bed yang anda masukan sudah ada.',
    		);
    		$this->session->set_flashdata("id_kamar", $this->input->post('id_kamar', TRUE));
			$this->session->set_flashdata("nama_bed", $this->input->post('nama_bed', TRUE));
			$this->session->set_flashdata("status_isi", $this->input->post('status_isi', TRUE));
    		$this->session->set_flashdata('alert',$data);
    		redirect('Bed/add_bed');
    	}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
		$getdata = $this->M_crud->get_by_id('bed', 'id_bed', $id);
		$existing_bed = $getdata->nama_bed;
		$existing_kamar = $getdata->id_kamar;
		$status_exs = TRUE;
		
		if($existing_bed <> $this->input->post('nama_bed', TRUE)){
			if($this->M_crud->check_table('bed', 'nama_bed', $this->input->post('nama_bed', TRUE),
					'id_kamar', $this->input->post('id_kamar', TRUE)) != NULL){
				$status_exs = FALSE;
			}
		}else{
			if($existing_kamar <> $this->input->post('id_kamar', TRUE)){
				if($this->M_crud->check_table('bed', 'nama_bed', $this->input->post('nama_bed', TRUE),
						'id_kamar', $this->input->post('id_kamar', TRUE)) != NULL){
						$status_exs = FALSE;
				}
			}
		}
		
		$data = array(
			'id_kamar' => $this->input->post('id_kamar', TRUE), 
			'nama_bed' => $this->input->post('nama_bed', TRUE), 
			'status_isi' => $this->input->post('status_isi', TRUE),
			'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		
		if($status_exs == TRUE)
		{
			if(!$this->modelBed->update($id,$data,'id_bed','bed'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data bed.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Bed');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("id_kamar", $this->input->post('id_kamar', TRUE));
				$this->session->set_flashdata("nama_bed", $this->input->post('nama_bed', TRUE));
				$this->session->set_flashdata("status_isi", $this->input->post('status_isi', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Bed/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Bed yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("id_kamar", $this->input->post('id_kamar', TRUE));
			$this->session->set_flashdata("nama_bed", $this->input->post('nama_bed', TRUE));
			$this->session->set_flashdata("status_isi", $this->input->post('status_isi', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Bed/edit/$id");
		}
	}
	
	function delete($id)
    {			
		if(!$this->modelBed->delete('id_bed',$id,'bed'))
		{
			$data = array(
			'class' => '1',
			'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data bed.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Bed');
		}
		else
		{
			$data = array(
				'class' => '0',
				'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Bed");
		}
    }
    
    function cetak(){
    	$data['bed']=$this->modelBed->get_bed();
    	$this->load->view('print',$data);
    }
    
    function doexport()
    {
    	$header = [
    			'No',
    			'Bed',
    			'Ruangan',
    			'Status'
    	];
    	 
    	$dataList = array();
    	$list = $this->modelBed->get_bed();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$row[] = $datas->nama_bed;
    		$row[] = $datas->nama_ruangan;
    		$row[] = $datas->status_isi;
    		$dataList[] = $row;
    	}
    	 
    	$writer = WriterFactory::create(Type::XLSX);
    	$namaFile = 'Data_Bed_'.date('Ymd') . '.xlsx';
    	$writer->openToBrowser($namaFile);
    	$writer->addRow($header);
    	$writer->addRows($dataList);
    	$writer->close();
    }
}
