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
      
      $this->load->view('index',$data);
    }
    function form($id_pasien,$no_regis){
      if($_POST){
        $is_what = $this->input->post('is_what',TRUE);
        switch ($is_what) {
          case 'diagnosa':
            $this->insert_diagnosa($_POST);
            break;
          case 'tindakan':
            $this->insert_tindakan($_POST);
            break;
          case 'resep':
            $this->insert_resep($_POST);
            break;
          default:
            # code...
            break;
        }
      }

      $data['pasien']   = $this->model->get_pasien_by_registrasi($no_regis);
      $data['now']      = date('d-m-Y');
      $data['riwayats'] = $this->model->get_diagnosa_by_pasien_id($id_pasien);
      $data['layanans'] = $this->M_crud->get_select_to_array('*','layanan');
      $data['obats']    = $this->M_crud->get_select_to_array('*','obat');
      $data['satuans']  = $this->M_crud->get_select_to_array('*','satuan');

      $this->load->view('form_pemeriksaan',$data);
    }
    private function insert_diagnosa($data){
      $id_pasien        = $this->input->post('id_pasien');
      $tgl_pemeriksaan  = date('Y-m-d',strtotime($this->input->post('tgl_pemeriksaan')));;
      $diagnosa         = $this->input->post('diagnosa');
      $keluhan          = $this->input->post('keluhan');
      $anamnesa         = $this->input->post('anamnesa');
      $tensi            = $this->input->post('tensi');
      $berat_badan      = $this->input->post('berat_badan');
      $tinggi_badan     = $this->input->post('tinggi_badan');
      $is_double        = $this->model->validate_double('pemeriksaan','id_pasien',$id_pasien,'tgl_pemeriksaan',$tgl_pemeriksaan,'diagnosa',$diagnosa,'keluhan',$keluhan,'anamnesa',$anamnesa);

      if($is_double > 0){
        $data = array(
          'class'=>0,
          'msg' => 'Penyimpanan gagal karena sudah ada sebelumnya',
        );
        $this->session->set_flashdata('alert',$data);
      } else { 
          $data = array (
            'id_pasien'       => $id_pasien,
            'tgl_pemeriksaan' => $tgl_pemeriksaan,
            'id_dokter'       => $this->input->post('id_dokter'),
            'diagnosa'        => $diagnosa,
            'anamnesa'        => $anamnesa,
            'keluhan'         => $keluhan,
            'tensi'           => $tensi,
            'berat_badan'     => $berat_badan,
            'tinggi_badan'    => $tinggi_badan,
          );
          $this->M_crud->_insert('pemeriksaan',$data);
          $alert = array(
            'class'=>1,
            'msg'=>'Diagnosa Berhasil Disimpan',
          );
          $this->session->set_flashdata('alert',$alert);
        }
    }
    private function insert_tindakan($data){
      $arr_tindakan = $this->input->post('id_layanan[]');
      $now = date('Y-m-d');
      for($i=0;$i<count($arr_tindakan);$i++){
        $biaya_layanan  = $this->M_crud->get_by_id('layanan','id_layanan',$arr_tindakan[$i]);

        $data_tindakan[] = array(
          'id_pasien'                 => $this->input->post('id_pasien'),
          'id_registrasi'             => $this->input->post('id_registrasi'),
          'id_dokter'                 => $this->input->post('id_dokter'),
          'tgl_pemeriksaan_tindakan'  => $now,
          'id_layanan'                => $arr_tindakan[$i],
          'created_by'                => $this->session->userdata['simklinik']['ap_sid']
        );

        $total_biaya_perlayanan  = $biaya_layanan->tarif_layanan*1;

        $data_biaya[] = array(
          'id_registrasi'   => $this->input->post('id_registrasi'),
          'nama_item'       => $biaya_layanan->nama_layanan,
          'jenis_item'      => "Layanan",
          'item_id'         => $biaya_layanan->id_layanan,
          'harga'           => $biaya_layanan->tarif_layanan,
          'qty'             => 1,
          'total_harga'     => $total_biaya_perlayanan
        );
      }
      for($i=0;$i<count($data_tindakan);$i++){
        $this->M_crud->_insert('pemeriksaan_tindakan',$data_tindakan[$i]);
        $this->M_crud->_insert('detail_pembiayaan',$data_biaya[$i]);
      }
    }
    private function insert_resep($data){
      $arr_id_obat  = $this->input->post('id_obat[]');
      $arr_jumlah   = $this->input->post('jumlah_obat[]');
      $arr_satuan   = $this->input->post('satuan_obat[]');
      $now = date('Y-m-d');
      for($i=0; $i < count($arr_id_obat); $i++){
        $harga_obat = $this->M_crud->get_by_id('harga_obat','id_obat',$arr_id_obat[$i]);
        $obat       = $this->M_crud->get_by_id('obat','id_obat',$arr_id_obat[$i]);

        $data_obat[] = array(
          'id_pasien'             => $this->input->post('id_pasien'),
          'id_registrasi'         => $this->input->post('id_registrasi'),
          'id_dokter'             => $this->input->post('id_dokter'),
          'tgl_pemeriksaan_resep' => $now,
          'id_obat'               => $arr_id_obat[$i],
          'qty_obat'              => $arr_jumlah[$i],
          'id_satuan'             => $arr_satuan[$i],
          'created_by'            => $this->session->userdata['simklinik']['ap_sid']
        );

        $total_harga_obat  = $harga_obat->harga_jual1*$arr_jumlah[$i];

        $data_harga_obat[] = array(
          'id_registrasi'   => $this->input->post('id_registrasi'),
          'nama_item'       => $obat->nama_obat,
          'jenis_item'      => "Obat",
          'item_id'         => $obat->id_obat,
          'harga'           => $harga_obat->harga_jual1,
          'qty'             => $arr_jumlah[$i],
          'total_harga'     => $total_harga_obat
        );
      }

      for($i=0; $i < count($data_obat); $i++){
        $this->M_crud->_insert('pemeriksaan_resep',$data_obat[$i]);
        $this->M_crud->_insert('detail_pembiayaan',$data_harga_obat[$i]);
      }
      echo "<pre>";
      print_r($data_obat);
      echo "</pre>";
      die;
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
