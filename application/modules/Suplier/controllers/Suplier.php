<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Suplier extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_suplier','modelSuplier');
	}
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['supplier'] = $this->modelSuplier->get_supplier();
	
		$this->load->view('show',$data);
	}
	
	public function add_suplier()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['kode_supplier']		= $this->session->flashdata("kode_supplier");
		$data['nama_supplier']		= $this->session->flashdata("nama_supplier");
		$data['alamat_supplier']	= $this->session->flashdata("alamat_supplier");
		$data['no_telpon_supplier']	= $this->session->flashdata("no_telpon_supplier");
		$data['contact_person']		= $this->session->flashdata("contact_person");
		$data['no_telp_cp']			= $this->session->flashdata("no_telp_cp");
	
		$this->load->view('form_sup',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		 
		if(!empty($this->session->flashdata("nama_supplier"))){
			$data['supplier_id']		= $id;
			$data['kode_supplier']		= $this->session->flashdata("kode_supplier");
			$data['nama_supplier']		= $this->session->flashdata("nama_supplier");
			$data['alamat_supplier']	= $this->session->flashdata("alamat_supplier");
			$data['no_telpon_supplier']	= $this->session->flashdata("no_telpon_supplier");
			$data['contact_person']		= $this->session->flashdata("contact_person");
			$data['no_telp_cp']			= $this->session->flashdata("no_telp_cp");
		}else{
			$query = $this->modelSuplier->edit($id);
			foreach ($query as $result){
				$data['supplier_id']		= $id;
				$data['kode_supplier']		= $result->kode_supplier;
				$data['nama_supplier']		= $result->nama_supplier;
				$data['alamat_supplier']	= $result->alamat_supplier;
				$data['no_telpon_supplier']	= $result->no_telpon_supplier;
				$data['contact_person']		= $result->contact_person;
				$data['no_telp_cp']			= $result->no_telp_cp;
			}
		}
	
		$this->load->view('form_sup',$data);
	}
	
	public function insert()
	{
		$data = array(
				'kode_supplier' => $this->input->post('kode_supplier', TRUE),
				'nama_supplier' => $this->input->post('nama_supplier', TRUE),
				'alamat_supplier' => $this->input->post('alamat_supplier', TRUE),
				'no_telpon_supplier' => $this->input->post('no_telpon_supplier', TRUE),
				'contact_person' => $this->input->post('contact_person', TRUE),
				'no_telp_cp' => $this->input->post('no_telp_cp', TRUE),
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if($this->M_crud->check_table('supplier', 'nama_supplier', $this->input->post('nama_supplier', TRUE)) == NULL)
		{
			if(!$this->modelSuplier->create($data,'supplier'))
			{
				$data = array(
						'class' => '1',
						'msg' => '<strong>Selamat</strong>, anda berhasil menginput data supplier.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Suplier');
			}
			else
			{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
				);
				$this->session->set_flashdata("kode_supplier", $this->input->post('kode_supplier', TRUE));
				$this->session->set_flashdata("nama_supplier", $this->input->post('nama_supplier', TRUE));
				$this->session->set_flashdata("alamat_supplier", $this->input->post('alamat_supplier', TRUE));
				$this->session->set_flashdata("no_telpon_supplier", $this->input->post('no_telpon_supplier', TRUE));
				$this->session->set_flashdata("contact_person", $this->input->post('contact_person', TRUE));
				$this->session->set_flashdata("no_telp_cp", $this->input->post('no_telp_cp', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Suplier/add_suplier');
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Supplier yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("kode_supplier", $this->input->post('kode_supplier', TRUE));
			$this->session->set_flashdata("nama_supplier", $this->input->post('nama_supplier', TRUE));
			$this->session->set_flashdata("alamat_supplier", $this->input->post('alamat_supplier', TRUE));
			$this->session->set_flashdata("no_telpon_supplier", $this->input->post('no_telpon_supplier', TRUE));
			$this->session->set_flashdata("contact_person", $this->input->post('contact_person', TRUE));
			$this->session->set_flashdata("no_telp_cp", $this->input->post('no_telp_cp', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect('Suplier/add_suplier');
		}
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
		$getdata = $this->M_crud->get_by_id('supplier', 'supplier_id', $id);
		$existing = $getdata->nama_supplier;
		$status_exs = TRUE;
		
		if($existing <> $this->input->post('nama_supplier', TRUE)){
			if($this->M_crud->check_table('supplier', 'nama_supplier', $this->input->post('nama_supplier', TRUE)) != NULL){
				$status_exs = FALSE;
			}
		}
		
		$data = array(
			'kode_supplier' => $this->input->post('kode_supplier', TRUE),
			'nama_supplier' => $this->input->post('nama_supplier', TRUE),
			'alamat_supplier' => $this->input->post('alamat_supplier', TRUE),
			'no_telpon_supplier' => $this->input->post('no_telpon_supplier', TRUE),
			'contact_person' => $this->input->post('contact_person', TRUE),
			'no_telp_cp' => $this->input->post('no_telp_cp', TRUE),
			'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		
		if($status_exs == TRUE)
		{
			if(!$this->modelSuplier->update($id,$data,'supplier_id','supplier'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data supplier.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Suplier');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata("kode_supplier", $this->input->post('kode_supplier', TRUE));
				$this->session->set_flashdata("nama_supplier", $this->input->post('nama_supplier', TRUE));
				$this->session->set_flashdata("alamat_supplier", $this->input->post('alamat_supplier', TRUE));
				$this->session->set_flashdata("no_telpon_supplier", $this->input->post('no_telpon_supplier', TRUE));
				$this->session->set_flashdata("contact_person", $this->input->post('contact_person', TRUE));
				$this->session->set_flashdata("no_telp_cp", $this->input->post('no_telp_cp', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect("Suplier/edit/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Supplier yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("kode_supplier", $this->input->post('kode_supplier', TRUE));
			$this->session->set_flashdata("nama_supplier", $this->input->post('nama_supplier', TRUE));
			$this->session->set_flashdata("alamat_supplier", $this->input->post('alamat_supplier', TRUE));
			$this->session->set_flashdata("no_telpon_supplier", $this->input->post('no_telpon_supplier', TRUE));
			$this->session->set_flashdata("contact_person", $this->input->post('contact_person', TRUE));
			$this->session->set_flashdata("no_telp_cp", $this->input->post('no_telp_cp', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Suplier/edit/$id");
		}
	}
	
	function delete($id)
	{
		if(!$this->modelSuplier->delete('supplier_id',$id,'supplier'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data supplier.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Suplier');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Suplier");
		}
	}
	
	function cetak()
	{
		$data['supplier']=$this->modelSuplier->get_supplier();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Kode Supplier',
				'Nama Supplier',
				'Alamat',
				'No. Telepon',
				'Contact Person'
		];
		 
		$dataList = array();
		$list = $this->modelSuplier->get_supplier();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
    		$row[] = $no;
			$row[] = $datas->kode_supplier;
			$row[] = $datas->nama_supplier;
			$row[] = $datas->alamat_supplier;
			$row[] = $datas->no_telpon_supplier;
			$row[] = $datas->contact_person;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Supplier_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
	
}