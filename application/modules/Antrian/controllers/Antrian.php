<?php
	class Antrian extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('M_antrian','antrian');
			// $this->load->model('Pasien/M_pasien','modelPasien');
		}
		public function index(){
			$data['antrian']=$this->antrian->getAntrianTampil();
			$data['now']=$this->antrian->getMin();
			$data['count'] = $this->antrian->getCountAntrian();
			$this->load->view('antrian',$data);
		}
		function antrianpasien(){
			$data['antrian']=$this->antrian->getAllAntrianToday();
			$data['antrian_terlayani']=$this->antrian->getAntrianTerlayani();
			$data['antrian_belum_terlayani']=$this->antrian->getAntrianBelumTerlayani();
			$this->load->view('show',$data);
		}
		function nextAntrian(){
			$belum_terlayani = $this->antrian->getAntrianBelumTerlayani();
			$pasien_maju = $belum_terlayani[0];
			$data = array(
				'status_antrian'=>1
			);
			$update = $this->M_crud->_update('registrasi_pasien','id_registrasi',$pasien_maju->id_registrasi,$data);
			if($update==1){
				redirect('Antrian/antrianpasien');
			}
			else{
				echo "gagal";
				die;
			}
		}
		function update_sound($id){
			$data = array(
				'play_sound' => 1,
			);
			$this->antrian->update($id,$data,'id_registrasi','registrasi_pasien');
			echo json_encode(array("status" => TRUE));
		}
	}
