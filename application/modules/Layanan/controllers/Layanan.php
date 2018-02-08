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

    	$data['nama_layanan']			= $this->session->flashdata("nama");
		$data['tarif']			= $this->session->flashdata("tarif");
		$data['tarif_khusus']	= $this->session->flashdata("tarif_khusus");

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
				$data['tarif_khusus']		= $this->session->flashdata("tarif_khusus");
    	}else{
    		$query = $this->modelLayanan->edit($id);
    		foreach ($query as $result){
					$tarif = $result->tarif_layanan;
    			$tarif = str_replace(".00", "", $tarif);
    			$tarif_khusus = $result->tarif_khusus;
    			$tarif_khusus = str_replace(".00", "", $tarif_khusus);
    			$data['id_layanan']			= $id;
    			$data['nama']				= $result->nama_layanan;
					$data['tarif']				= $tarif;
					$data['tarif_khusus']		= $tarif_khusus;
    		}
    	}

		$this->load->view('form',$data);
	}

	public function insert()
	{
		$tarif = $this->input->post('tarif', TRUE);
		$tarif = str_replace(",", "", $tarif);

		$tarif_khusus = $this->input->post('tarif_khusus', TRUE);
		$tarif_khusus = str_replace(",", "", $tarif_khusus);

    	$data = array(
			'nama_layanan' => $this->input->post('nama', TRUE),
			'tarif_layanan' => $tarif,
			'tarif_khusus' => $tarif_khusus,
			'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);

    	if($this->M_crud->check_table('layanan', 'nama_layanan', $this->input->post('nama', TRUE)) == NULL)
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
				$this->session->set_flashdata("tarif_khusus", $this->input->post('tarif_khusus', TRUE));
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
			$this->session->set_flashdata("tarif_khusus", $this->input->post('tarif_khusus', TRUE));
    		$this->session->set_flashdata('alert',$data);
    		redirect('Layanan/add_layanan');
    	}
	}

	public function update()
	{
		$id = $this->input->post('id', TRUE);
		$getdata = $this->M_crud->get_by_id('layanan', 'id_layanan', $id);
		$existing = $getdata->nama_layanan;
		$status_exs = TRUE;

		if($existing <> $this->input->post('nama', TRUE)){
			if($this->M_crud->check_table('layanan', 'nama_layanan', $this->input->post('nama', TRUE)) != NULL){
				$status_exs = FALSE;
			}
		}

		$tarif = $this->input->post('tarif', TRUE);
		$tarif = str_replace(",", "", $tarif);
		$tarif_khusus = $this->input->post('tarif_khusus', TRUE);
		$tarif_khusus = str_replace(",", "", $tarif_khusus);

		$data = array(
			'nama_layanan' => $this->input->post('nama', TRUE),
			'tarif_layanan' => $tarif,
			'tarif_khusus' => $tarif_khusus,
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
				$this->session->set_flashdata("tarif_khusus", $this->input->post('tarif_khusus', TRUE));
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
			$this->session->set_flashdata("tarif_khusus", $this->input->post('tarif_khusus', TRUE));
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
    			'Tarif Normal',
    			'Tarif Khusus'
    	];

    	$dataList = array();
    	$list = $this->modelLayanan->get_layanan();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$tarif = $this->M_base->currFormat2($datas->tarif_layanan);
    		$tarif = str_replace(".00", "", $tarif);
    		$tarif = "Rp. ".$tarif;

    		$tarif_khusus = "";
    		if(!empty($datas->tarif_khusus)){
    			$tarif_khusus = $this->M_base->currFormat2($datas->tarif_khusus);
    			$tarif_khusus = str_replace(".00", "", $tarif_khusus);
    			$tarif_khusus = "Rp. ".$tarif_khusus;
    		}

    		$row[] = $datas->nama_layanan;
    		$row[] = $tarif;
    		$row[] = $tarif_khusus;
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
