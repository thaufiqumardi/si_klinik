<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';

class Rekammedik extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('M_rekammedik','modelRekamMedik');
  }

  function index(){
    $this->M_setting->_make_sure_is_login();
    $this->M_setting->_check_menu();
    $data['pasiens']=$this->modelRekamMedik->getPasien();
    $this->load->view('index',$data);
  }
  function detail($id_pasien){
    $data['tindakans']= $this->get_rekam_medik_tindakan($id_pasien);
    $data['obstertis']= $this->get_rekam_medik($id_pasien,'rm_obsterti');
    $data['observasi_kalas']    = $this->get_rekam_medik($id_pasien,'rm_observasi_kala');
    $data['kala1s']   = $this->get_rekam_medik($id_pasien,'rm_kala1');
    // $data['kala2s']   = $this->get_rekam_medik($id_pasien,'rm_kala2');
    $data['kala2s']   = $this->modelRekamMedik->getKala2Joined($id_pasien);
    // echo "<pre>";
    // print_r($data['kala2s']);
    // echo "</pre>";
    // die;
    $data['kala3s']   = $this->get_rekam_medik($id_pasien,'rm_kala3');
    $data['pasca_persalinan'] = $this->get_rekam_medik($id_pasien,'rm_pasca_persalinan');
    $data['status_pasien']  = $this->get_rekam_medik($id_pasien,'rm_status_pasien');
    // print_r($data['tindakans']);
    // die;
    $data['pasien'] = $this->get_pasien($id_pasien);
    $this->load->view('print_rekam_medik',$data);
  }
  function get_pasien($id_pasien){
    $pasien = $this->M_crud->get_by_id('pasien','id_pasien',$id_pasien);
    return $pasien;
  }
  function get_rekam_medik_tindakan($id_pasien){
    // $tindakans = $this->M_crud->get_by_param_to_array('rm_tindakan','id_pasien',$id_pasien);
    $tindakans = $this->M_crud->get_select_to_array('*, rm_tindakan.created_date AS created_date_tindakan','rm_tindakan','diagnosa','diagnosa.id_diagnosa=rm_tindakan.id_diagnosa','id_pasien',$id_pasien);
    // echo json_encode($tindakans);
    // die;
    return $tindakans;
  }
  function get_rekam_medik($id_pasien,$table){
    $data = $this->M_crud->get_by_param_to_array($table,'id_pasien',$id_pasien);
    return $data;
    // echo "<pre>";
    // print_r($obstertis);
    // echo "</pre>";
    // die;
  }
}
