<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

	class Pasien extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('M_pasien','modelPasien');
			$this->load->library('form_validation');
		}
		function index(){
			$this->M_setting->_make_sure_is_login();
			$this->M_setting->_check_menu();
			$data['pasiens']=$this->modelPasien->getPasien();
			$this->load->view('index',$data);
		}
		function form(){
			$this->M_setting->_make_sure_is_login();
			$this->M_setting->_check_menu();
			if($_POST){
				$this->form_validation->set_rules('nik_pasien','NIK Pasien','is_unique[pasien.nik_pasien]',
					array('is_unique'=>'<li>NIK Pasien Sudah Pernah Didaftarkan</li>'));
				if($this->form_validation->run()===FALSE){
					$data=array(
						'class'=>'0',
						'msg'=>'Penambahan Pasien Gagal, Karena Sudah Ada',
					);
					$this->session->set_flashdata('alert',$data);
				}
				else{
					$pasien_terdaftar=$this->modelPasien->simpanPasien();
					// echo "<pre>";
					// print_r($pasien_terdaftar);
					// echo "</pre>";
					// die;
					$data=array(
						'class'=>'1',
						'msg'=>'Penambahan Pasien Berhasil. Silahkan Lanjutkan Untuk Pendaftaran',
						'no_kartu'=>$pasien_terdaftar->no_kartu,
					);
					$this->session->set_flashdata('alert',$data);
					redirect('Pasien/pendaftaran_pasien');
				}
			}
			$this->load->view('formPasien');
		}
		function hapus($id){
			$this->modelPasien->hapusPasien($id);
			$data=array(
				'class'=>'1',
				'msg'=>'Penghapusan Data Pasien Berhasil',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('pasien');
		}
		function edit($id){
			$this->M_setting->_make_sure_is_login();
			$this->M_setting->_check_menu();
			$data['pasien']=$this->modelPasien->editPasien($id);
			$data['penanggung']=$this->modelPasien->getPenanggung($id);
			$this->load->view('formPasien',$data);
		}
		function update_pasien($id){
			$query= $this->modelPasien->updatePasien($id);
			if($query==0){
				$data=array(
					'class'=>'0',
					'msg'=>'Pembaharuan Data Pasien Gagal',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('pasien/form');
			}
			else{
				$data=array(
					'class'=>'1',
					'msg'=>'Pembaharuan Data Pasien Berhasil',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('pasien');
			}
		}
		function pendaftaran_pasien(){
			$this->M_setting->_make_sure_is_login();
			$this->M_setting->_check_menu();
			if($_POST){
				$check = $this->modelPasien->isRegistExist($_POST);
				if($check==0){
					$data = array(
						'class'=>'0',
						'msg'=>'Pendaftaran Pasien Gagal Karena Sudah Daftar Sebelumnya'
					);
					$this->session->set_flashdata('alert',$data);
				}
				else{
					$tgl = str_replace('/','-',$this->input->post('tgl_daftar'));
					$tgl_registrasi= date('Y-m-d',strtotime($tgl));
					$jam_regis = date('H:i:s');
					$antrian_terakhir = $this->modelPasien->getLast('no_antrian','registrasi_pasien','tgl_registrasi')->no_antrian;
					if($antrian_terakhir==0){
						$antrian=1;
					}
					else{
						$antrian = $antrian_terakhir+1;
					}
					$data = array(
						'id_dokter'=>$this->input->post('id_dokter'),
						'id_pasien'=>$this->input->post('id_pasien'),
						'tgl_registrasi'=>$tgl_registrasi,
						'jam_registrasi'=>$jam_regis,
						'no_antrian'=>$antrian
					);
					$this->M_crud->_insert('registrasi_pasien',$data);
						$data = array(
							'class'=>'1',
							'msg'=>'Pendaftaran Pasien Berhasil'
						);
						$this->session->set_flashdata('alert',$data);
						redirect('Pasien/pendaftaran_pasien');
				}
			}
			$data['dokters']=$this->M_crud->get_select_to_array('*','dokter');
			$data['pasiens']=$this->modelPasien->getPasien();
			$data['registered']=$this->modelPasien->getRegistered();
			$this->load->view('form_pendaftaran',$data);
		}
		public function getPasienById($id){
			$data['pasien']=$this->modelPasien->editPasien($id);
			echo json_encode($data['pasien']);

		}
		function hapus_antrian($id){
			$p=$this->modelPasien->hapusAntrian($id);
			if($p==0){
				$data=array(
					'class'=>'0',
					'msg'=>'Hapus Pasien Dari Antrian gagal',
				);
				$this->session->set_flashdata('alert',$data);
			}
			else{
				$data=array(
					'class'=>'1',
					'msg'=>'Hapus Pasien dari Antrian Berhasil dilakukan'
				);
				$this->session->set_flashdata('alert',$data);
			}
			redirect('Pasien/pendaftaran_pasien');
		}
		function cetak(){
			$data['pasien']=$this->modelPasien->getPasienExport();
			$this->load->view('printPasien',$data);
		}
		function doexport(){
			$header = [
					'No',
					'No. RM',
					'No. Kartu',
					'Nama',
					'Tempat, Tgl Lahir',
					'Jenis Kelamin',
					'Alamat'
			];

			$dataList = array();
			$list = $this->modelPasien->getPasienExport();
			$no = 0;
			foreach ($list as $datas)
			{
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $datas->no_rm;
				$row[] = $datas->no_kartu;
				$row[] = $datas->nama_pasien;
				$row[] = $datas->tempat_lahir.', '.date('d-M-Y',strtotime($datas->tgl_lahir));
				$row[] = $datas->jenis_kelamin;
				$row[] = $datas->jalan.', RT/RW: '.$datas->rtrw.", ".
			             $datas->kelurahan.", ".$datas->kecamatan.", ".$datas->kota;
				$dataList[] = $row;
			}

			$writer = WriterFactory::create(Type::XLSX);
			$namaFile = 'Data_Pasien_'.date('Ymd') . '.xlsx';
			$writer->openToBrowser($namaFile);
			$writer->addRow($header);
			$writer->addRows($dataList);
			$writer->close();
		}
		function cetak_detail($id){
			$data['pasien']=$this->modelPasien->editPasien($id);
			$this->load->view('print_detail',$data);
		}
	}
