<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Layanan extends MX_Controller {
	 
	function __construct()
    {
      parent::__construct();
      $this->load->model('M_layanan','modelLayanan');	  
    }
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['layanan'] = $this->modelLayanan->get_layanan();
		
		$this->load->view('show',$data);
	}
	
	public function add_layanan()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['nama']		= $this->session->flashdata("nama");
		$data['tarif']		= $this->session->flashdata("tarif");
		
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
    	
    	if(!empty($this->session->flashdata("nama"))){
    		$data['id_layanan']			= $id;
    		$data['nama']				= $this->session->flashdata("nama");
			$data['tarif']				= $this->session->flashdata("tarif");
    	}else{
    		$query = $this->modelLayanan->edit($id);
    		foreach ($query as $result){
    			$tarif = $this->M_base->currFormat2($result->tarif);
    			$tarif = str_replace(".00", "", $tarif);
    			$data['id_layanan']			= $id;
    			$data['nama']				= $result->nama;
				$data['tarif']				= $tarif;
    		}
    	}
		
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		$tarif = $this->input->post('tarif', TRUE);
		$tarif = str_replace(",", "", $tarif);
		
    	$data = array(
			'nama' => $this->input->post('nama', TRUE), 
			'tarif' => $tarif,
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
    	
    	if($this->M_crud->check_table('layanan', 'nama', $this->input->post('nama', TRUE)) == NULL)
    	{
	    	if(!$this->modelLayanan->create($data,'layanan'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menginput data layanan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Layanan');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("nama", $this->input->post('nama', TRUE));
				$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Layanan/add_layanan');
			}
    	}else{
    		$data = array(
    				'class' => '0',
    				'msg' => '<strong>Maaf</strong>, layanan yang anda masukan sudah ada.',
    		);
    		$this->session->set_flashdata("nama", $this->input->post('nama', TRUE));
			$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
    		$this->session->set_flashdata('alert',$data);
    		redirect('Layanan/add_layanan');
    	}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
		$getdata = $this->M_crud->get_by_id('layanan', 'id_layanan', $id);
		$existing = $getdata->nama;
		$status_exs = TRUE;
		
		if($existing <> $this->input->post('nama', TRUE)){
			if($this->M_crud->check_table('layanan', 'nama', $this->input->post('nama', TRUE)) != NULL){
				$status_exs = FALSE;
			}
		}
		
		$tarif = $this->input->post('tarif', TRUE);
		$tarif = str_replace(",", "", $tarif);
		
		$data = array(
			'nama' => $this->input->post('nama', TRUE), 
			'tarif' => $tarif,
			'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		
		if($status_exs == TRUE)
		{
			if(!$this->modelLayanan->update($id,$data,'id_layanan','layanan'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data layanan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Layanan');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("nama", $this->input->post('nama', TRUE));
				$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Layanan/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Layanan yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("nama", $this->input->post('nama', TRUE));
			$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Layanan/edit/$id");
		}
	}
	
	function delete($id)
    {			
		if(!$this->modelLayanan->delete('id_layanan',$id,'layanan'))
		{
			$data = array(
			'class' => '1',
			'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data layanan.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Layanan');
		}
		else
		{
			$data = array(
				'class' => '0',
				'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Layanan");
		}
    }
    
    function cetak()
    {
    	$data['layanan']=$this->modelLayanan->get_layanan();
    	$this->load->view('print',$data);
    }
    
    function doexport()
    {
    	$header = [
    			'No',
    			'Nama Layanan',
    			'Tarif'
    	];
    	 
    	$dataList = array();
    	$list = $this->modelLayanan->get_layanan();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$tarif = $this->M_base->currFormat2($datas->tarif);
    		$tarif = str_replace(".00", "", $tarif);
    		$tarif = "Rp. ".$tarif;
    		$row[] = $datas->nama;
    		$row[] = $tarif;
    		$dataList[] = $row;
    	}
    	 
    	$writer = WriterFactory::create(Type::XLSX);
    	$namaFile = 'Data_Layanan_'.date('Ymd') . '.xlsx';
    	$writer->openToBrowser($namaFile);
    	$writer->addRow($header);
    	$writer->addRows($dataList);
    	$writer->close();
    }
}
