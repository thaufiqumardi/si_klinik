<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

	class Dokter extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('M_dokter','modelDokter');

		}
		function index(){
			$this->M_setting->_make_sure_is_login();
			$this->M_setting->_check_menu();
			$data['dokters']=$this->modelDokter->getDokter();
			$this->load->view('index',$data);
		}
		function form(){
			$this->form_validation->set_rules('no_izin_praktek','Kode Dokter','is_unique[dokter.no_izin_praktek]', array(
				'is_unique' => '<li> Nomor Izin Praktek yang dimasukan sudah terdaftar Sebelumnya </li>'
			));
			if($_POST){
				if($this->form_validation->run()===FALSE){
					$data=array(
						'class'=>'0',
						'msg'=>'Penambahan Data Dokter Gagal, Karena No. Izin Praktek Sudah Ada.',
					);
					$this->session->set_flashdata('alert',$data);
				}
				else{
					$lahir = str_replace('/','-',$this->input->post('tgl_lahir'));
					$tgl_lahir= date('Y-m-d',strtotime($lahir));
					if($this->M_crud->check_table('dokter', 'nama_dokter', $this->input->post('nama', TRUE),
							'tgl_lahir', $tgl_lahir) != NULL){
							$data=array(
									'class'=>'0',
									'msg'=>'Penambahan Data Dokter Gagal, Karena Data Dokter Sudah Ada.',
							);
							$this->session->set_flashdata('alert',$data);
							//redirect('pegawai/form');
					}else{
						$this->modelDokter->simpanDokter();
						$data=array(
								'class'=>'1',
								'msg'=>'Penambahan Data Dokter Berhasil Dilakukan'
						);
						$this->session->set_flashdata('alert',$data);
						redirect('dokter');
					}					
				}
			}
			$this->load->view('formDokter');
		}
		function edit($id){
			$data['dokter']=$this->modelDokter->editDokter($id);
				$this->load->view('formDokter',$data);
				if($_POST){
					$getdata = $this->M_crud->get_by_id('dokter', 'id_dokter', $id);
					$existing_tgllahir = date('Y-m-d',strtotime($getdata->tgl_lahir));
					$existing_no_izin = $getdata->no_izin_praktek;
					$existing_nama = $getdata->nama_dokter;
					$lahir = str_replace('/','-',$this->input->post('tgl_lahir'));
					$tgl_lahir= date('Y-m-d',strtotime($lahir));
					
					if($existing_nama <> $this->input->post('nama', TRUE)){
						if($this->M_crud->check_table('dokter', 'nama_dokter', $this->input->post('nama', TRUE),
								'tgl_lahir', $tgl_lahir) != NULL)
						{
							$data=array(
									'class'=>'0',
									'msg'=>'Penambahan Data Dokter Gagal, Karena Data Dokter Sudah Ada.',
							);
							$this->session->set_flashdata('alert',$data);
							redirect('dokter/edit/'.$id);
						}
					}
						
						
					if($existing_tgllahir <> $tgl_lahir){
						if($this->M_crud->check_table('dokter', 'nama_dokter', $this->input->post('nama', TRUE),
								'tgl_lahir', $tgl_lahir) != NULL)
						{
							$data=array(
									'class'=>'0',
									'msg'=>'Penambahan Data Dokter Gagal, Karena Data Dokter Sudah Ada.',
							);
							$this->session->set_flashdata('alert',$data);
							redirect('dokter/edit/'.$id);
						}
					}
						
					if($existing_no_izin <> $this->input->post('no_izin_praktek', TRUE)){
						if($this->M_crud->check_table('dokter', 'no_izin_praktek', $this->input->post('no_izin_praktek', TRUE)) != NULL)
						{
							$data=array(
									'class'=>'0',
									'msg'=>'Penambahan Data Dokter Gagal, No Izin Praktek Sudah Ada.',
							);
							$this->session->set_flashdata('alert',$data);
							redirect('dokter/edit/'.$id);
						}
					}
					
					$query=$this->modelDokter->updateDokter($id);
					if($query==0){
						$data=array(
							'class'=>'0',
							'msg'=>'Penambahan Data Dokter Gagal, Karena Kode Dokter Sudah Ditambahkan Sebelumnya',
						);
						$this->session->set_flashdata('alert',$data);
						$this->form($id);
					}
					else {
						$data=array(
							'class'=>'1',
							'msg'=>'Pembaharuan Data Dokter Berhasil Dilakukan'
						);
						$this->session->set_flashdata('alert',$data);
						redirect('dokter');
					}
				}
		}
		function update($id){
			$getdata = $this->M_crud->get_by_id('dokter', 'id_dokter', $id);
			$existing_tgllahir = date('Y-m-d',strtotime($getdata->tgl_lahir));
			$existing_no_izin = $getdata->no_izin_praktek;
			$existing_nama = $getdata->nama_dokter;			
			$lahir = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($lahir));
			
			if($existing_nama <> $this->input->post('nama', TRUE)){
				if($this->M_crud->check_table('dokter', 'nama_dokter', $this->input->post('nama', TRUE),
						'tgl_lahir', $tgl_lahir) != NULL)
				{
					$data=array(
							'class'=>'0',
							'msg'=>'Penambahan Data Dokter Gagal, Karena Data Dokter Sudah Ada.',
					);
					$this->session->set_flashdata('alert',$data);
					redirect('dokter/edit/'.$id);
				}
			}
			
			
			if(($existing_tgllahir <> $tgl_lahir) or ($existing_nama <> $this->input->post('nama', TRUE))){
				if($this->M_crud->check_table('dokter', 'nama_dokter', $this->input->post('nama', TRUE),
						'tgl_lahir', $tgl_lahir) != NULL)
				{
						$data=array(
								'class'=>'0',
								'msg'=>'Penambahan Data Dokter Gagal, Karena Data Dokter Sudah Ada.',
						);
						$this->session->set_flashdata('alert',$data);
						redirect('dokter/edit/'.$id);
				}
			}
			
			if(($existing_no_izin <> $this->input->post('no_izin_praktek', TRUE)) or ($existing_nama <> $this->input->post('nama', TRUE)) ){
				if($this->M_crud->check_table('dokter', 'nama_dokter', $this->input->post('nama', TRUE),
					'no_izin_praktek', $this->input->post('no_izin_praktek', TRUE)) != NULL)
				{
					$data=array(
							'class'=>'0',
							'msg'=>'Penambahan Data Dokter Gagal, Karena Data Dokter Sudah Ada.',
					);
					$this->session->set_flashdata('alert',$data);
					redirect('dokter/edit/'.$id);
				}
			}
			
			$this->modelDokter->updateDokter($id);
			redirect('dokter');
		}
		function hapus($id){
			$this->modelDokter->hapusDokter($id);
			$data=array(
				'class'=>'1',
				'msg'=>'Penghapusan Data Dokter Berhasil Dilakukan'
			);
			$this->session->set_flashdata('alert',$data);
			redirect('dokter');
		}
	function cetak()
    {
    	$data['dokter']=$this->modelDokter->getDokter();
    	$this->load->view('printDokter',$data);
    }

    function doexport()
    {
    	$header = [
    			'No',
    			'Kode Dokter',
    			'Nama Dokter',
    			'Jenis Kelamin',
    			'Alamat',
    			'No. Telepon',
    			'No. Izin Praktek'
    	];

    	$dataList = array();
    	$list = $this->modelDokter->getDokter();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$row[] = $datas['kd_dokter'];
    		$row[] = $datas['nama_dokter'];
    		$row[] = $datas['jenis_kelamin'];
    		$row[] = $datas['alamat'];
    		$row[] = $datas['telepon'];
    		$row[] = $datas['no_izin_praktek'];
    		$dataList[] = $row;
    	}

    	$writer = WriterFactory::create(Type::XLSX);
    	$namaFile = 'Data_Dokter_'.date('Ymd') . '.xlsx';
    	$writer->openToBrowser($namaFile);
    	$writer->addRow($header);
    	$writer->addRows($dataList);
    	$writer->close();
    }
}
