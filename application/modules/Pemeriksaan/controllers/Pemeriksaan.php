<?php
  /**
   *
   */
  class Pemeriksaan extends CI_Controller{
    function __construct(){
      parent::__construct();
      $this->load->model('Pasien/M_Pasien','modelPasien');
      $this->load->model('M_pemeriksaan','model');
    }
    function index(){
      $data['rekam_mediks'] = $this->M_crud->get_select_to_array('*','pemeriksaan');
      $data['registered']=$this->modelPasien->getRegistered();
      // echo json_encode($data['registered']);
      $this->load->view('index',$data);
    }
    function form($id_pasien,$no_regis){
      if($_POST){
  			$tgl_pemeriksaan= date('Y-m-d',strtotime($this->input->post('tgl_pemeriksaan')));;
        $diagnosa = $this->input->post('diagnosa');
        $keluhan = $this->input->post('keluhan');
        $anamnesa = $this->input->post('anamnesa');
        $tensi = $this->input->post('tensi');
        $berat_badan = $this->input->post('berat_badan');
        $tinggi_badan = $this->input->post('tinggi_badan');
        $is_double = $this->model->validate_double('pemeriksaan','id_pasien',$id_pasien,'tgl_pemeriksaan',$tgl_pemeriksaan,'diagnosa',$diagnosa,'keluhan',$keluhan,'anamnesa',$anamnesa);
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
            'tgl_pemeriksaan' =>$tgl_pemeriksaan,
            'id_dokter'=>$this->input->post('id_dokter'),
            'diagnosa' =>$diagnosa,
            'anamnesa' =>$anamnesa,
            'keluhan' =>$keluhan,
            'tensi' => $tensi,
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
          );
          $this->M_crud->_insert('pemeriksaan',$data);
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
      $this->load->view('form_pemeriksaan',$data);
    }
    function hapus($id,$id_pasien,$no_regis){
      $this->M_crud->_delete('pemeriksaan','id_pemeriksaan',$id);
      $data = array(
        'class'=>1,
        'msg'=>'Data Berhasil Dihapus',
      );
      $this->session->set_flashdata('alert',$data);
      redirect('Pemeriksaan/form/'.$id_pasien.'/'.$no_regis);
    }
  }
 ?>
