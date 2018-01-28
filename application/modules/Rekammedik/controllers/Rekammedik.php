<?php
  /**
   *
   */
  class Rekammedik extends CI_Controller
  {

    function __construct(){
      parent::__construct();
      $this->load->model('Pasien/M_Pasien','modelPasien');
    }
    function index(){
      $data['rekam_mediks'] = $this->M_crud->get_select_to_array('*','rekam_medik');
      $data['registered']=$this->modelPasien->getRegistered();
      // echo json_encode($data['registered']);
      // die;
      $this->load->view('index');
    }
    function form($id_pasien){
      $data['riwayats'] = $this->M_crud->get_by_param_to_array('rekam_medik','id_pasien',$id_pasien);

      $this->load->view('form_rekammedik',$data);
    }
  }

 ?>
