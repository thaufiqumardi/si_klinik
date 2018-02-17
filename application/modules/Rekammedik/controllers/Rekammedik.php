<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';

class Rekammedik extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Pasien/M_Pasien','modelPasien');
    $this->load->model('M_rekammedik','model');
  }

  function index(){
    $this->M_setting->_make_sure_is_login();
    $this->M_setting->_check_menu();
    $data['pasiens']=$this->model->getPasien();
    $this->load->view('index',$data);
  }

  function show($id_pasien){
  $data['pasien']=$this->M_crud->get_by_id('pasien','id_pasien',$id_pasien);
    $data['riwayats'] = $this->model->get_diagnosa_by_pasien_id($id_pasien);
    $data['layanans'] = $this->model->get_layanan_by_pasien_id($id_pasien);
    $data['obats'] = $this->model->get_resep_by_pasien_id($id_pasien);
    $this->load->view('show',$data);
  }
  function detail($id_pasien){
    $data['pasien']=$this->M_crud->get_by_id('pasien','id_pasien',$id_pasien);
    $data['riwayats'] = $this->model->get_diagnosa_by_pasien_id($id_pasien);
    $data['layanans'] = $this->model->get_layanan_by_pasien_id($id_pasien);
    $data['obats'] = $this->model->get_resep_by_pasien_id($id_pasien);
    $location = 'logo';
    $path_to_file = FCPATH . $location."/KMB_Logo_Small.png";
    $data['imgpath'] = $path_to_file;
    $this->load->view('print_rekam_medik',$data);
  }

}
