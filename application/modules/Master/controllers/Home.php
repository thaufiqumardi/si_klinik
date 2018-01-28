<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_master','modelMaster');
	}

	function index()
	{
		$login = $this->M_base->check_session_login();
		if($login == 'Ok'){
			$now = new DateTime ( NULL, new DateTimeZone('Asia/Jakarta'));
			// $data['curr_tgl'] = $now->format('d F Y');
			// $data['reg_pasien'] = $this->modelMaster->get_patient_registered();
			// $data['pasien_rj'] = $this->modelMaster->get_pasien_rj();
			// $data['pasien_ri'] = $this->modelMaster->get_pasien_ri();
			// $data['pasien_umum'] = $this->modelMaster->get_pasien_umum();
			// $data['pasien_bpjs'] = $this->modelMaster->get_pasien_bpjs();
			$this->load->view('Index');
		}else{
			redirect('login');
		}
	}

	function logout(){
		$this->session->unset_userdata('simklinik');
		$this->session->sess_destroy();
		redirect("login");
	}
}
