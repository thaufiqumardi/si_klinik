<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Pegawai extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_pegawai','modelPegawai');
	}
	function index(){
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		$data['pegawai'] = $this->modelPegawai->getPegawai();
		$this->load->view('index',$data);
	}
	function form(){
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
			$this->form_validation->set_rules('nik','Nik Pegawai','is_unique[pegawai.nik]',
				array('is_unique'=>'<li>NIK Sudah Terdaftar Sebelumnya</li>')
			);
			if($_POST){
				if($this->form_validation->run()===FALSE){
				$data=array(
					'class'=>'0',
					'msg'=>'Penambahan Data Pegawai Gagal, NIP dan NIK Pegawai Sudah Ada.',
				);
					$this->session->set_flashdata('alert',$data);
				}
				else{
					$lahir = str_replace('/','-',$this->input->post('tgl_lahir'));
					$tgl_lahir= date('Y-m-d',strtotime($lahir));
					if($this->M_crud->check_table('pegawai', 'nama', $this->input->post('nama', TRUE),
								'tgl_lahir', $tgl_lahir) != NULL){
						$data=array(
								'class'=>'0',
								'msg'=>'Penambahan Data Pegawai Gagal, Karena Data Pegawai Sudah Ada.',
						);
						$this->session->set_flashdata('alert',$data);
						//redirect('pegawai/form');
					}else{
						$this->modelPegawai->simpanPegawai();
						$data=array(
								'class'=>'1',
								'msg'=>'Penambahan Data Pegawai Berhasil Dilakukan'
						);
						$this->session->set_flashdata('alert',$data);
						redirect('pegawai');
					}
				}
			}

		$data['jabatan']=$this->modelPegawai->getJabatan();
		$this->load->view('formPegawai',$data);
	}
	function simpan_pegawai($id=FALSE){
		if($id===false){

		}
		else{			
			$getdata = $this->M_crud->get_by_id('pegawai', 'id_pegawai', $id);
			$existing_nik = $getdata->nik;
			$existing_tgllahir = date('Y-m-d',strtotime($getdata->tgl_lahir));
			
			if($existing_nik <> $this->input->post('nik')){
				if($this->M_crud->check_table('pegawai', 'nik', $this->input->post('nik', TRUE)) != NULL){
					$data=array(
							'class'=>'0',
							'msg'=>'Penambahan Data Pegawai Gagal, Karena NIK Pegawai Sudah Ada.',
					);
					$this->session->set_flashdata('alert',$data);
					redirect('pegawai/edit/'.$id);
				}
			}
			
			$lahir = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($lahir));
			if($existing_tgllahir <> $tgl_lahir){
				if($this->M_crud->check_table('pegawai', 'nama', $this->input->post('nama', TRUE),
								'tgl_lahir', $tgl_lahir) != NULL){
					$data=array(
							'class'=>'0',
							'msg'=>'Penambahan Data Pegawai Gagal, Karena Data Pegawai Sudah Ada.',
					);
					$this->session->set_flashdata('alert',$data);
					redirect('pegawai/edit/'.$id);
				}
			}
			
			$query=$this->modelPegawai->updatePegawai($id);
			if($query=0){
				$data=array(
					'class'=>'0',
					'msg'=>'Penambahan Data Pegawai Gagal, Karena Nama Pegawai dan NIP Pegawai Sudah Ditambahkan Sebelumnya',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('pegawai/edit/'.$id);
			}
			else{
					$data=array(
					'class'=>'1',
					'msg'=>'Update Data Pegawai Berhasil Dilakukan'
				);
				$this->session->set_flashdata('alert',$data);
				redirect('pegawai');
			}
			redirect('pegawai');
		}

	}
	function hapus($id){
		$this->modelPegawai->hapusPegawai($id);
		$data=array(
		'class'=>'1',
		'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data pegawai.',
	);
	$this->session->set_flashdata('alert',$data);
		redirect('pegawai');
	}
	function edit($id){
		$data['pegawai'] = $this->modelPegawai->editPegawai($id);
		$data['jabatan']=$this->modelPegawai->getJabatan();
		$this->load->view('formPegawai',$data);
	}
	function update($id){
		$update=$this->modelPegawai->updatePegawai($id);
		redirect('pegawai');
	}
	function cetak(){
		$data['pegawai'] = $this->modelPegawai->getPegawai();
		$this->load->view('printPegawai',$data);
	}

	function doexport()
	{
		$header = [
				'No',
				'NIP',
				'Nama Pegawai',
				'No. Handphone',
				'Mulai Bekerja',
				'Jabatan',
				'Alamat',
		];

		$dataList = array();
		$list = $this->modelPegawai->getPegawai();
		$no = 0;
		foreach ($list as $index => $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas['nip'];
			$row[] = $datas['nama'];
			$row[] = $datas['no_hp'];
			$row[] = date('d-M-Y', strtotime($datas['mulai_bekerja']));
			$row[] = $datas['nama_jabatan'];
			$row[] = $datas['alamat'];
			$dataList[] = $row;
		}

		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Pegawai_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
}