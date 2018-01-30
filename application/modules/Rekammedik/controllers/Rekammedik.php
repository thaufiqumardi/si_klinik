<?php
  /**
   *
   */
  class Rekammedik extends CI_Controller{
    function __construct(){
      parent::__construct();
      $this->load->model('Pasien/M_Pasien','modelPasien');
      $this->load->model('M_rekammedik','model');
    }
    function index(){
      $data['rekam_mediks'] = $this->M_crud->get_select_to_array('*','rekam_medik');
      $data['registered']=$this->modelPasien->getRegistered1();
      // echo json_encode($data['registered']);
      // die;
      $this->load->view('index',$data);
    }
    function form($id_pasien){
      if($_POST){
  			$tgl_rekam_medik= date('Y-m-d',strtotime($this->input->post('tgl_rekam_medik')));;
        $diagnosa = $this->input->post('diagnosa');
        $is_double = $this->model->validate_double('rekam_medik','id_pasien',$id_pasien,'tgl_rekam_medik',$tgl_rekam_medik,'diagnosa',$diagnosa);
        if($is_double > 0){
          $data = array(
            'class'=>0,
            'msg' => 'Penyimpanan gagal karena sudah ada sebelumnya',
          );
          $this->session->set_flashdata('alert',$data);
        }
        else{
          $data = array (
            'id_pasien' => $id_pasien,
            'tgl_rekam_medik' =>$tgl_rekam_medik,
            'id_dokter'=>$this->input->post('id_dokter'),
            'diagnosa' =>$diagnosa
          );
          $this->M_crud->_insert('rekam_medik',$data);
          $alert = array(
            'class'=>1,
            'msg'=>'Diagnosa Berhasil Disimpan',
          );
          $this->session->set_flashdata('alert',$alert);
          // $this->form($id_pasien);
        }
      }
      $data['pasien']= $this->model->get_pasien_by_id($id_pasien);
      $data['now'] = date('d-m-Y');
      $data['riwayats']= $this->model->get_diagnosa_by_pasien_id($id_pasien);
      $this->load->view('form_rekammedik',$data);
    }
    function hapus($id){
      $this->M_crud->_delete('rekam_medik','id_rekam_medik',$id);
      $data = array(
        'class'=>0,
        'msg'=>'Data Berhasil Dihapus',
      );
      $this->session->set_flashdata('alert',$data);
    }
  }
 ?>
