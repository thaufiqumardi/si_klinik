<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Satuan extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_satuan','modelSatuan');
	}
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		$data['satuan'] = $this->modelSatuan->get_satuan();
	
		$this->load->view('show',$data);
	}
	
	public function add_satuan()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		$data['satuan_nama']		= $this->session->flashdata("satuan_nama");
	
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		 
		if(!empty($this->session->flashdata("satuan_nama"))){
			$data['satuan_id']			= $id;
			$data['satuan_nama']		= $this->session->flashdata("satuan_nama");
		}else{
			$query = $this->modelSatuan->edit($id);
			foreach ($query as $result){
				$data['satuan_id']			= $id;
				$data['satuan_nama']		= $result->satuan_nama;
			}
		}
	
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		$data = array(
			'satuan_nama' => $this->input->post('satuan_nama', TRUE),
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if($this->M_crud->check_table('satuan', 'satuan_nama', $this->input->post('satuan_nama', TRUE)) == NULL)
		{
			if(!$this->modelSatuan->create($data,'satuan'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil menginput data satuan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Satuan');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("satuan_nama", $this->input->post('satuan_nama', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Satuan/add_satuan');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Satuan yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("satuan_nama", $this->input->post('satuan_nama', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect('Satuan/add_satuan');
		}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
	
		$data = array(
			'satuan_nama' => $this->input->post('satuan_nama', TRUE),
			'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
	
		if($this->M_crud->check_table('satuan', 'satuan_nama', $this->input->post('satuan_nama', TRUE)) == NULL)
		{
			if(!$this->modelSatuan->update($id,$data,'satuan_id','satuan'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data satuan.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Satuan');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("satuan_nama", $this->input->post('satuan_nama', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Satuan/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Satuan yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("satuan_nama", $this->input->post('satuan_nama', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Satuan/edit/$id");
		}
	}
	
	function delete($id)
	{
		if(!$this->modelSatuan->delete('satuan_id',$id,'satuan'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data satuan.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Satuan');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Satuan");
		}
	}
	
	function cetak()
	{
		$data['satuan']=$this->modelSatuan->get_satuan();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Satuan'
		];
		 
		$dataList = array();
		$list = $this->modelSatuan->get_satuan();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
    		$row[] = $no;
			$row[] = $datas->satuan_nama;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Satuan_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
	
}