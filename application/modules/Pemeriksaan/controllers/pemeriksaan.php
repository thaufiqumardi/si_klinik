<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller{
function __construct()
    {
      parent::__construct();
      $this->load->model('M_pemeriksaan','modelPemeriksaan');
    }

	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();

    if($_POST){
      $is_what = $this->input->post('is_what');
      switch ($is_what) {
        case 'diagnosa':
          $data = array(
            'no_registrasi' =>$this->input->post('no_reg'),
            'no_rm'         =>$this->input->post('no_rm'),
            'id_registrasi' =>$this->input->post('id_reg'),
            'id_pasien'     =>$this->input->post('pasien'),
            'no_antrian'    =>$this->input->post('antri'),
            'id_diagnosa'   =>$this->input->post('id_diagnosa'),
            'nama_tindakan' =>$this->input->post('nama_tindakan')
          );
          $hasil = $this->M_crud->_insert('rm_tindakan',$data);
          break;
        case 'Resep Obat':
          $arr_id_obat = $this->input->post('id_obat[]');
          $arr_jumlah_obat = $this->input->post('jumlah_obat[]');
          $sum_total_harga = 0;
          echo "<pre>";
          print_r($_POST);
          echo "</pre>";
          die;
          for($i=0;$i<count($arr_id_obat);$i++){
            $harga_obat = $this->M_crud->get_by_id('harga_obat','id_obat',$arr_id_obat[$i]);
            $nama_obat = $this->M_crud->get_by_id('obat','id_obat',$arr_id_obat[$i]);

            $input[] = array(
              'no_registrasi' =>$this->input->post('no_reg'),
              'no_rm'         =>$this->input->post('no_rm'),
              'id_registrasi' =>$this->input->post('id_reg'),
              'id_pasien'     =>$this->input->post('pasien'),
              'no_antrian'    =>$this->input->post('antri'),
              'id_obat'       =>$arr_id_obat[$i],
              'qty'           =>$arr_jumlah_obat[$i]
            );
            $total_harga = $harga_obat->harga_jual1 * $arr_jumlah_obat[$i];
            $data_harga[] = array(
              'id_registrasi' =>$this->input->post('id_reg'),
              'no_registrasi' =>$this->input->post('no_reg'),
              'tgl_registrasi'=>$this->input->post('tgl_registrasi'),
              'nama_item'     =>$nama_obat->nama_obat,
              'jenis_item'    =>"Obat",
              'item_id'       =>$arr_id_obat[$i],
              'harga'         =>$harga_obat->harga_jual1,
              'qty'           =>$arr_jumlah_obat[$i],
              'total_harga'   => $total_harga,
            );
            $sum_total_harga = $sum_total_harga+$total_harga;
          }
          for($i=0;$i<count($input);$i++){
            $hasil_insert_pembiayaan = $this->M_crud->_insert('detail_pembiayaan',$data_harga[$i]);
            $hasil_insert_rm_obat = $this->M_crud->_insert('rm_obat',$input[$i]);
          }

          $piutang = $this->M_crud->get_by_id('piutang','no_registrasi',$this->input->post('no_reg'));
          $total_biaya = $sum_total_harga + $piutang->total_biaya;
          $sisa_bayar = $piutang->sisa_bayar + $sum_total_harga;
          // print_r($piutang);
          $input_piutang = array(
            'total_biaya'     =>$total_biaya,
            'sisa_bayar'      =>$sisa_bayar,
            'status'          =>0,
          );
          $hasil_insert_piutang = $this->M_crud->_update('piutang','piutang_id',$piutang->piutang_id,$input_piutang);
          if($hasil_insert_pembiayaan ==1 && $hasil_insert_rm_obat ==1 && $hasil_insert_piutang ==1){
            $hasil = 1;
          }
          // die;
          break;
        case 'Riwayat Obsterti':
          $tgl = str_replace('/','-',$this->input->post('tgl_obsterti'));
    			$tgl_obsterti= date('Y-m-d',strtotime($tgl));
          $data = array(
            'no_registrasi' =>$this->input->post('no_reg'),
            'no_rm'         =>$this->input->post('no_rm'),
            'id_registrasi' =>$this->input->post('id_reg'),
            'id_pasien'     =>$this->input->post('pasien'),
            'no_antrian'    =>$this->input->post('antri'),
            'tgl_obsterti'  =>$tgl_obsterti,
            'jam_obsterti'  =>$this->input->post('jam_obsterti').":00",
            'pengirim_obsterti' =>$this->input->post('pengirim_obsterti'),
            'keluhan_obsterti'  =>$this->input->post('keluhan_obsterti'),
            'kehamilan_obsterti' =>$this->input->post('kehamilan_obsterti'),
            'partus_obsterti'  =>$this->input->post('partus_obsterti'),
            'hasil_kehamilan_obsterti' =>$this->input->post('hasil_kehamilan_obsterti'),
            'jenis_persalinan_obsterti' =>$this->input->post('jenis_persalinan_obsterti'),
            'keterangan_penyulit_obsterti'  =>$this->input->post('keterangan_penyulit_obsterti')
          );
          $hasil = $this->M_crud->_insert('rm_obsterti',$data);
          break;
        case 'Observasi Kala 1':
          $msk = str_replace('/','-',$this->input->post('tgl_masuk_observasi_kala'));
          $tgl_masuk= date('Y-m-d',strtotime($msk));

          $obs = str_replace('/','-',$this->input->post('tgl_observasi_kala'));
          $tgl_obs= date('Y-m-d',strtotime($obs));
          $data = array(
            'no_registrasi' =>$this->input->post('no_reg'),
            'no_rm'         =>$this->input->post('no_rm'),
            'id_registrasi' =>$this->input->post('id_reg'),
            'id_pasien'     =>$this->input->post('pasien'),
            'no_antrian'    =>$this->input->post('antri'),
            'tgl_masuk_observasi_kala'  =>$tgl_masuk,
            'jam_masuk_observasi_kala'  =>$this->input->post('jam_masuk_observasi_kala'),
            'tgl_observasi_kala'        =>$tgl_obs,
            'jam_observasi_kala'        =>$this->input->post('jam_observasi_kala'),
            'bja_observasi_kala'        =>$this->input->post('bja_observasi_kala'),
            'his_observasi_kala'        =>$this->input->post('his_observasi_kala'),
            'pemeriksaan_observasi_kala' =>$this->input->post('pemeriksaan_observasi_kala'),
            'dalam_observasi_kala'      =>$this->input->post('dalam_observasi_kala'),
            'tindakan_observasi_kala'   =>$this->input->post('tindakan_observasi_kala'),
            'keterangan_observasi_kala' =>$this->input->post('keterangan_observasi_kala'),
          );
          $hasil = $this->M_crud->_insert('rm_observasi_kala',$data);
          break;
        case 'Kala 1':
          $kal1 = str_replace('/','-',$this->input->post('tgl_kala1'));
          $tgl_kala1= date('Y-m-d',strtotime($kal1));

          $data = array(
            'no_registrasi' =>$this->input->post('no_reg'),
            'no_rm'         =>$this->input->post('no_rm'),
            'id_registrasi' =>$this->input->post('id_reg'),
            'id_pasien'     =>$this->input->post('pasien'),
            'no_antrian'    =>$this->input->post('antri'),
            'tgl_kala1'     =>$tgl_kala1,
            'jam_kala1'     =>$this->input->post('jam_kala1'),
            'komplikasi_kala1'  =>$this->input->post('komplikasi_kala1'),
            'terapi_kala1'      =>$this->input->post('terapi_kala1'),
            'tindakan_kala1'    =>$this->input->post('tindakan_kala1'),
          );
          $hasil = $this->M_crud->_insert('rm_kala1',$data);
          break;
        case 'Kala 2':
          $kal2 = str_replace('/','-',$this->input->post('tgl_kala2'));
          $tgl_kala2= date('Y-m-d',strtotime($kal2));

          $data = array(
            'no_registrasi' =>$this->input->post('no_reg'),
            'no_rm'         =>$this->input->post('no_rm'),
            'id_registrasi' =>$this->input->post('id_reg'),
            'id_pasien'     =>$this->input->post('pasien'),
            'no_antrian'    =>$this->input->post('antri'),
            'tgl_kala2'     => $tgl_kala2,
            'jam_kala2'     => $this->input->post('jam_kala2'),
            'komplikasi_kala2' => $this->input->post('komplikasi_kala2'),
            'terapi_kala2'  => $this->input->post('terapi_kala2'),
            'tindakan_kala2' => $this->input->post('tindakan_kala2'),
          );
            $lhr = str_replace('/','-',$this->input->post('tgl_lahir'));
            $tglLahir = date('Y-m-d',strtotime($lhr));
          $data2 = array(
            'no_rm'         =>$this->input->post('no_rm'),
            'no_registrasi' =>$this->input->post('no_reg'),
            'jenis_persalinan' => $this->input->post('jenis_persalinan'),
            'anak_lahir'    => $this->input->post('anak_lahir'),
            'tgl_lahir'     => $tglLahir,
            'jam_lahir'     => $this->input->post('jam_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'panjang' => $this->input->post('panjang'),
            'berat_badan' => $this->input->post('berat_badan'),
            'cacat_persalinan' => $this->input->post('cacat_persalinan'),
            'oksigen_persalinan' => $this->input->post('oksigen_persalinan'),
          );
          $hasil1 = $this->M_crud->_insert('rm_kala2',$data);
          $hasil2 = $this->M_crud->_insert('rm_persalinan',$data2);
          $hasil = ($hasil1 && $hasil2);
          break;

        case 'Kala 3':
          $kal3 = str_replace('/','-',$this->input->post('tgl_kala3'));
          $tgl_kal3 = date('Y-m-d',strtotime($kal3));
          $data = array(
            'no_registrasi' =>$this->input->post('no_reg'),
            'no_rm'         =>$this->input->post('no_rm'),
            'id_registrasi' =>$this->input->post('id_reg'),
            'id_pasien'     =>$this->input->post('pasien'),
            'no_antrian'    =>$this->input->post('antri'),
            'tgl_kala3'     =>$tgl_kal3,
            'jam_kala3'     =>$this->input->post('jam_kala3'),
            'placenta_kala3'  =>$this->input->post('placenta_kala3'),
            'komplikasi1_kala3' =>$this->input->post('komplikasi1_kala3'),
            'tindakan1_kala3'   =>$this->input->post('tindakan1_kala3'),
            'pendarahan_kala3'  =>$this->input->post('pendarahan_kala3'),
            'komplikasi2_kala3' =>$this->input->post('komplikasi2_kala3'),
            'tindakan2_kala3'   =>$this->input->post('tindakan2_kala3'),
            'perincum_kala3'    =>$this->input->post('perincum_kala3'),
            'tingkat_kala3'     =>$this->input->post('tingkat_kala3'),
            'tindakan3_kala3'   =>$this->input->post('tindakan3_kala3')
          );
          $hasil = $this->M_crud->_insert('rm_kala3',$data);
          break;

        case 'Pasca Persalinan':
          $tgl = str_replace('/','-',$this->input->post('tgl_lahir'));
          $tgl_lahir = date('Y-m-d',strtotime($tgl));
          $data = array(
            'no_registrasi' =>$this->input->post('no_reg'),
            'no_rm'         =>$this->input->post('no_rm'),
            'id_registrasi' =>$this->input->post('id_reg'),
            'id_pasien'     =>$this->input->post('pasien'),
            'no_antrian'    =>$this->input->post('antri'),
            'keadaan' => $this->input->post('keadaan'),
            'tensi' => $this->input->post('tensi'),
            'nadi' => $this->input->post('nadi'),
            'pernapasan' => $this->input->post('pernapasan'),
            'suhu' => $this->input->post('suhu'),
            'tinggi_uterus' => $this->input->post('tinggi_uterus'),
            'urine' => $this->input->post('urine'),
            'kontraksi' => $this->input->post('kontraksi'),
            'keadaan_anak' => $this->input->post('keadaan_anak'),
            'tgl_lahir' => $tgl_lahir,
            'jam_lahir' => $this->input->post('jam_lahir'),
            'berat' => $this->input->post('berat'),
            'panjang' => $this->input->post('panjang'),
            'pronto' => $this->input->post('pronto'),
            'subento' => $this->input->post('subento'),
            'suboccid' => $this->input->post('suboccid'),
            'cacat_maserasi' => $this->input->post('cacat_maserasi'),
            'apgar' => $this->input->post('apgar'),
            'oksigen' => $this->input->post('oksigen'),
          );
          $hasil = $this->M_crud->_insert('rm_pasca_persalinan',$data);
          break;

          case 'Status Pasien':
            $data = array(
              'no_registrasi' =>$this->input->post('no_reg'),
              'no_rm'         =>$this->input->post('no_rm'),
              'id_registrasi' =>$this->input->post('id_reg'),
              'id_pasien'     =>$this->input->post('pasien'),
              'no_antrian'    =>$this->input->post('antri'),
              'jam' => $this->input->post('jam'),
              'keadaan_umum' => $this->input->post('keadaan_umum'),
              'tensi' => $this->input->post('tensi'),
              'nadi' => $this->input->post('nadi'),
              'suhu' => $this->input->post('suhu'),
              'pernapasan' => $this->input->post('pernapasan'),
              'fundus_uteri' => $this->input->post('fundus_uteri'),
              'lingkaran_perut' => $this->input->post('lingkaran_perut'),
              'letak_anak' => $this->input->post('letak_anak'),
              'bunyi_jantung_anak' => $this->input->post('bunyi_jantung_anak'),
              'his' => $this->input->post('his'),
              'inspeculo' => $this->input->post('inspeculo'),
              'vulva' => $this->input->post('vulva'),
              'portio' => $this->input->post('portio'),
              'pembukaan' => $this->input->post('pembukaan'),
              'ketuban' => $this->input->post('ketuban'),
              'hodge' => $this->input->post('hodge'),
              'uterus' => $this->input->post('uterus'),
              'tindakan_lainnya' => $this->input->post('tindakan_lainnya'),
            );
            $hasil = $this->M_crud->_insert('rm_status_pasien',$data);
            break;

          case 'Resume Medis':
            $msk = str_replace('/','-',$this->input->post('tgl_masuk'));
            $tgl_masuk = date('Y-m-d',strtotime($msk));

            $kel = str_replace('/','-',$this->input->post('tgl_keluar'));
            $tgl_keluar = date('Y-m-d',strtotime($kel));

            $data = array(
              'no_registrasi' =>$this->input->post('no_reg'),
              'no_rm'         =>$this->input->post('no_rm'),
              'id_registrasi' =>$this->input->post('id_reg'),
              'id_pasien'     =>$this->input->post('pasien'),
              'no_antrian'    =>$this->input->post('antri'),
              'tgl_masuk' => $tgl_masuk,
              'tgl_keluar' => $tgl_keluar,
              'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
              'pemeriksaan_klinis' => $this->input->post('pemeriksaan_klinis'),
              'pemeriksaan_lab' => $this->input->post('pemeriksaan_lab'),
              'diagnosa' => $this->input->post('diagnosa'),
              'tindakan' => $this->input->post('tindakan'),
            );
            $hasil = $this->M_crud->_insert('rm_resume',$data);
            break;
      }
      if($hasil==1){
        $data=array(
          'class'=>'1',
          'msg'=>'Berhasil Menambahkan Data ',
          'data'=>$is_what
        );
        $this->session->set_flashdata('alert',$data);
      }
      else{
        $data=array(
          'class'=>'0',
          'msg'=>'Gagal Menambahkan Data',
          'data'=>$is_what
        );
        $this->session->set_flashdata('alert',$data);
      }
    }
    $data['registered_pasiens'] = $this->modelPemeriksaan->getRegisteredPasien();
    $data['diagnosa'] = $this->M_crud->get_select_to_array('*','diagnosa');
    $data['obats'] = $this->M_crud->get_select_to_array('*','obat');
    $this->load->view('show',$data);
	}
  function getPasienByNoRegistrasi($no_registrasi){
    $data['registrasi']= $this->modelPemeriksaan->getRegistrasiJoined($no_registrasi);
    echo json_encode($data['registrasi']);
  }
  function getDetailDiagnosa($id_diagnosa){
    $data['diagnosa']=$this->M_crud->get_by_id('diagnosa','id_diagnosa',$id_diagnosa);
    echo json_encode($data['diagnosa']);
  }
}
