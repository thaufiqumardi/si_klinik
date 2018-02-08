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
      $this->load->view('index',$data);
    }
    function form($id_pasien,$no_regis){
      if($_POST){
  			$tgl_rekam_medik= date('Y-m-d',strtotime($this->input->post('tgl_rekam_medik')));;
        $diagnosa = $this->input->post('diagnosa');
        $keluhan = $this->input->post('keluhan');
        $anamnesa = $this->input->post('anamnesa');
        $tensi = $this->input->post('tensi');
        $berat_badan = $this->input->post('berat_badan');
        $tinggi_badan = $this->input->post('tinggi_badan');
        $is_double = $this->model->validate_double('rekam_medik','id_pasien',$id_pasien,'tgl_rekam_medik',$tgl_rekam_medik,'diagnosa',$diagnosa,'keluhan',$keluhan,'anamnesa',$anamnesa);
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
            'diagnosa' =>$diagnosa,
            'anamnesa' =>$anamnesa,
            'keluhan' =>$keluhan,
            'tensi' => $tensi,
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
          );
          $this->M_crud->_insert('rekam_medik',$data);
          $alert = array(
            'class'=>1,
            'msg'=>'Diagnosa Berhasil Disimpan',
          );
          $this->session->set_flashdata('alert',$alert);
        }
      }
      $data['pasien']= $this->model->get_pasien_by_registrasi($no_regis);
      $data['now'] = date('d-m-Y');
      $data['riwayats']= $this->model->get_diagnosa_by_pasien_id($id_pasien);
      $this->load->view('form_rekammedik',$data);
    }
    function hapus($id,$id_pasien,$no_regis){
      $this->M_crud->_delete('rekam_medik','id_rekam_medik',$id);
      $data = array(
        'class'=>1,
        'msg'=>'Data Berhasil Dihapus',
      );
      $this->session->set_flashdata('alert',$data);
      redirect('rekammedik/form/'.$id_pasien.'/'.$no_regis);
    }
  }
 ?>
