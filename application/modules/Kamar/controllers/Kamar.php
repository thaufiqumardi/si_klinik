<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Kamar extends MX_Controller {
	 
	function __construct()
    {
      parent::__construct();
      $this->load->model('M_kamar','kamar');	  
    }
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['kamar'] = $this->kamar->get_kamar();
		
		$this->load->view('show',$data);
	}
	
	public function add_kamar()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['nama_ruangan']		= $this->session->flashdata("nama_ruangan");
    	$data['kelas']				= $this->session->flashdata("kelas");
    	$data['jumlah']				= $this->session->flashdata("jumlah");
		$data['tarif']				= $this->session->flashdata("tarif");
		
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
    	
    	if(!empty($this->session->flashdata("nama_ruangan"))){
    		$data['id_kamar']			= $id;
    		$data['nama_ruangan']		= $this->session->flashdata("nama_ruangan");
    		$data['kelas']				= $this->session->flashdata("kelas");
    		$data['jumlah']				= $this->session->flashdata("jumlah");
			$data['tarif']				= $this->session->flashdata("tarif");
    	}else{
    		$query = $this->kamar->edit($id);
    		foreach ($query as $result){
    			$tarif = $this->M_base->currFormat2($result->tarif);
    			$tarif = str_replace(".00", "", $tarif);
    			$data['id_kamar']			= $id;
    			$data['nama_ruangan']		= $result->nama_ruangan;
    			$data['kelas']				= $result->kelas;
    			$data['jumlah']				= $result->jumlah;
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
			'nama_ruangan' => $this->input->post('nama_ruangan', TRUE), 
			'kelas' => $this->input->post('kelas', TRUE), 
			'jumlah' => $this->input->post('jumlah', TRUE),
			'tarif' => $tarif,
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
    	
    	if($this->M_crud->check_table('kamar', 'nama_ruangan', $this->input->post('nama_ruangan', TRUE)) == NULL)
    	{
	    	if(!$this->kamar->create($data,'kamar'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menginput data ruangan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Kamar');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("nama_ruangan", $this->input->post('nama_ruangan', TRUE));
				$this->session->set_flashdata("kelas", $this->input->post('kelas', TRUE));
				$this->session->set_flashdata("jumlah", $this->input->post('jumlah', TRUE));
				$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Kamar/add_kamar');
			}
    	}else{
    		$data = array(
    				'class' => '0',
    				'msg' => '<strong>Maaf</strong>, Nama ruangan yang anda masukan sudah ada.',
    		);
    		$this->session->set_flashdata("nama_ruangan", $this->input->post('nama_ruangan', TRUE));
    		$this->session->set_flashdata("kelas", $this->input->post('kelas', TRUE));
    		$this->session->set_flashdata("jumlah", $this->input->post('jumlah', TRUE));
			$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
    		$this->session->set_flashdata('alert',$data);
    		redirect('Kamar/add_kamar');
    	}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
		$getdata = $this->M_crud->get_by_id('kamar', 'id_kamar', $id);
		$existing = $getdata->nama_ruangan;
		$status_exs = TRUE;
		
		if($existing <> $this->input->post('nama_ruangan', TRUE)){
			if($this->M_crud->check_table('kamar', 'nama_ruangan', $this->input->post('nama_ruangan', TRUE)) != NULL){
				$status_exs = FALSE;
			}
		}
		
		$tarif = $this->input->post('tarif', TRUE);
		$tarif = str_replace(",", "", $tarif);
		
		$data = array(
			'nama_ruangan' => $this->input->post('nama_ruangan', TRUE), 
			'kelas' => $this->input->post('kelas', TRUE), 
			'jumlah' => $this->input->post('jumlah', TRUE),
			'tarif' => $tarif,
			'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		
		if($status_exs == TRUE)
		{
			if(!$this->kamar->update($id,$data,'id_kamar','kamar'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data ruangan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Kamar');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("nama_ruangan", $this->input->post('nama_ruangan', TRUE));
				$this->session->set_flashdata("kelas", $this->input->post('kelas', TRUE));
				$this->session->set_flashdata("jumlah", $this->input->post('jumlah', TRUE));
				$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Kamar/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Nama ruangan yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("nama_ruangan", $this->input->post('nama_ruangan', TRUE));
			$this->session->set_flashdata("kelas", $this->input->post('kelas', TRUE));
			$this->session->set_flashdata("jumlah", $this->input->post('jumlah', TRUE));
			$this->session->set_flashdata("tarif", $this->input->post('tarif', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Kamar/edit/$id");
		}
	}
	
	function delete($id)
    {			
		if(!$this->kamar->delete('id_kamar',$id,'kamar'))
		{
			$data = array(
			'class' => '1',
			'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data ruangan.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Kamar');
		}
		else
		{
			$data = array(
				'class' => '0',
				'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Kamar");
		}
    }
    
    function kelas($id)
    {
    	$klas = "";
    	switch($id)
    	{
    		case '1';
    		$klas = "VIP";
    		break;
    		 
    		case '2';
    		$klas = "Kelas 1";
    		break;
    		 
    		case '3';
    		$klas = "Kelas 2";
    		break;
    		 
    		case '4';
    		$klas = "Kelas 3";
    		break;
    	}
    
    	return $klas;
    }
    
    function cetak()
    {
    	$data['ruangan']=$this->kamar->get_kamar();
    	$this->load->view('print',$data);
    }
    
    function doexport()
    {
    	$header = [
    			'No',
    			'Ruangan',
    			'Kelas',
    			'Jumlah Bed',
    			'Tarif'
    	];
    	
    	$dataList = array();
    	$list = $this->kamar->get_kamar();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$tarif = $this->M_base->currFormat2($datas->tarif);
    		$tarif = str_replace(".00", "", $tarif);
    		$tarif = "Rp. ".$tarif;
    		$row[] = $datas->nama_ruangan;
    		$row[] = $this->kelas($datas->kelas);
    		$row[] = $datas->jumlah;
    		$row[] = $tarif;
    		$dataList[] = $row;
    	}
    	
    	$writer = WriterFactory::create(Type::XLSX);
    	$namaFile = 'Data_Ruangan_'.date('Ymd') . '.xlsx';
    	$writer->openToBrowser($namaFile);   
    	$writer->addRow($header);    	
    	$writer->addRows($dataList);
    	$writer->close();
    }
}
