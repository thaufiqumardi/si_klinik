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
			// $now = new DateTime ( NULL, new DateTimeZone('Asia/Jakarta'));
			$now = date('Y-m-d');
			$data['jumlah_pasien_daftar'] = $this->M_crud->count_where('registrasi_pasien','tgl_registrasi',$now);
			$this->load->view('Index',$data);
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
