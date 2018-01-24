<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Paket extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      //$this->load->model('Hargaobat/M_harga');
      $this->load->model('M_paket','modelPaket');
    }

    function index(){
      	$this->M_setting->_make_sure_is_login();
  		$this->M_setting->_check_menu();
     	$data['pakets']=$this->M_crud->get_select_to_array('*','paket_layanan');
      	$this->load->view('index',$data);
    }

    function tambah(){
      if($_POST){
        $this->form_validation->set_rules('nama_paket','Nama Paket','is_unique[paket_layanan.nama_paket_layanan]',
      	array('is_unique'=>'<li>Paket Dengan Nama Yang Dimasukan Pernah Dimasukan Sebelumnya</li>'));
        if($this->form_validation->run()===FALSE){
          $data=array(
						'class'=>'0',
						'msg'=>'Penambahan Paket Gagal',
					);
					$this->session->set_flashdata('alert',$data);
        }
        else{
          $total_harga = (str_replace('.','',$this->input->post('total_harga')));
          $data = array(
            'nama_paket_layanan'=>$this->input->post('nama_paket'),
            'total_harga'=>$total_harga,
            'created_by' => $this->session->userdata['simklinik']['ap_sid'],
          );
          $id_masuk=$this->modelPaket->insert('paket_layanan',$data);
          $selected_ruangan = explode(",",$this->input->post('ruangan'));
          $id_ruangan = $selected_ruangan[0];
          $nama_ruangan = $selected_ruangan[1];
          $tarif_ruangan = str_replace(',','',$this->input->post('tarif_ruangan'));
          $array_item[] = array(
            'paket_id'=>$id_masuk,
            'item_id'=>$id_ruangan,
            'nama_item'=>$nama_ruangan,
            'harga_item'=>$tarif_ruangan,
            'kategori_item'=>"Ruangan",
            'created_by' => $this->session->userdata['simklinik']['ap_sid'],
          );
          $sum_layanan = count($this->input->post('layanan'));
          $layanan = $this->input->post('layanan');
          for($i=0; $i<$sum_layanan;$i++){
            $selected = explode(",",$layanan[$i]);

            $id_layanan = $selected[0];
            $trf_layanan = $selected[1];
            $nama_layanan = $selected[2];
            $kategori_item = "Layanan";

            $array_item[] = array(
              'paket_id'=>$id_masuk,
              'item_id'=>$id_layanan,
              'nama_item'=>$nama_layanan,
              'harga_item'=>$trf_layanan,
              'kategori_item'=>$kategori_item,
              'created_by' => $this->session->userdata['simklinik']['ap_sid'],
            );
          }
          $sum_obat = count($this->input->post('obat'));
          $obat = $this->input->post('obat');
          for($x=0; $x < $sum_obat;$x++){
            $selected_obat = explode(",",$obat[$x]);

            $id_obat = $selected_obat[0];
            $nama_obat = $selected_obat[1];
            $harga_obat = $selected_obat[2];
            $kategori = "Obat";

            $array_item[]= array(
              'paket_id'=>$id_masuk,
              'item_id'=>$id_obat,
              'nama_item'=>$nama_obat,
              'harga_item'=>$harga_obat,
              'kategori_item'=>$kategori,
        'created_by' => $this->session->userdata['simklinik']['ap_sid'],
            );
          }
          $jumlah_item = count($array_item);
          for($a=0;$a<$jumlah_item;$a++){
          $hasil_insert= $this->M_crud->_insert('detail_paket_layanan',$array_item[$a]);
          }
          if($hasil_insert == 1){
            $data = array(
                'class' => '1',
                'msg' => '<strong>Berhasil</strong> Menambahkan Paket.',
            );
            $this->session->set_flashdata('alert',$data);
            redirect('paket');
          }
        }
      }
      $data['layanans']=$this->M_crud->get_select_to_array('*','layanan');
      $data['ruangans']=$this->M_crud->get_select_to_array('*','kamar');
      $data['obats'] = $this->modelPaket->get_joined('harga_obat');
      $this->load->view('form',$data);
    }

    function getLayananById($id){
      $data['detail_layanan']=$this->M_crud->get_by_id('layanan','id_layanan',$id);
      echo json_encode($data['detail_layanan']);
    }

    function getAllLayanan(){
      $layanans= $this->M_crud->get_select_to_array('*','layanan');
      echo json_encode($layanans);
    }

    function getRuanganById($id){
      $data['detail_ruangan']=$this->M_crud->get_by_id('kamar','id_kamar',$id);
      echo json_encode($data['detail_ruangan']);
    }
    function edit($id_paket_edit){
      if($_POST){
      	$getdata = $this->M_crud->get_by_id('paket_layanan', 'paket_layanan_id', $id_paket_edit);
      	$existing_paket = $getdata->nama_paket_layanan;
      	
      	if($existing_paket <> $this->input->post('nama_paket')){
      		if($this->M_crud->check_table('paket_layanan', 'nama_paket_layanan', $this->input->post('nama_paket', TRUE)) != NULL){
      			$data=array(
      					'class'=>'0',
      					'msg'=>'Penambahan Paket Gagal, Karena Nama Paket Sudah Ada.',
      			);
      			$this->session->set_flashdata('alert',$data);
      			redirect('Paket/edit/'.$id_paket_edit);
      		}
      	}
      	
        $total_harga = (str_replace(',','',$this->input->post('total_harga')));
        $data = array(
          'nama_paket_layanan'=>$this->input->post('nama_paket'),
          'total_harga'=>$total_harga,
		   'created_by' => $this->session->userdata['simklinik']['ap_sid'],
        );
        $update_paket = $this->M_crud->_update('paket_layanan','paket_layanan_id',$id_paket_edit,$data);

        $selected_ruangan = explode(",",$this->input->post('ruangan'));
        $id_ruangan = $selected_ruangan[0];
        $nama_ruangan = $selected_ruangan[1];
        $detail_paket_id = isset($selected_ruangan[2])?$selected_ruangan[2]:'';
        $tarif_ruangan = str_replace(',','',$this->input->post('tarif_ruangan'));
        $array_item[] = array(
          'detail_paket_id'=>$detail_paket_id,
          'paket_id'=>$id_paket_edit,
          'item_id'=>$id_ruangan,
          'nama_item'=>$nama_ruangan,
          'harga_item'=>$tarif_ruangan,
          'kategori_item'=>"Ruangan",
		      'created_by' => $this->session->userdata['simklinik']['ap_sid'],
        );
        $sum_layanan = count($this->input->post('layanan'));
        $layanan = $this->input->post('layanan');
        for($i=0; $i<$sum_layanan;$i++){
          $selected = explode(",",$layanan[$i]);

          $id_layanan = $selected[0];
          $trf_layanan = $selected[1];
          $nama_layanan = $selected[2];
          $detail_paket_id = isset($selected[3])?$selected[3]:'';
          $kategori_item = "Layanan";

          $array_item[] = array(
            'detail_paket_id'=>$detail_paket_id,
            'paket_id'=>$id_paket_edit,
            'item_id'=>$id_layanan,
            'nama_item'=>$nama_layanan,
            'harga_item'=>$trf_layanan,
            'kategori_item'=>$kategori_item,
			      'created_by' => $this->session->userdata['simklinik']['ap_sid'],
          );
        }
        $obat = $this->input->post('obat');
        $sum_obat = count($obat);
        for($x=0; $x < $sum_obat;$x++){
          $selected_obat = explode(",",$obat[$x]);
          $id_obat = $selected_obat[0];
          $nama_obat = $selected_obat[1];
          $harga_obat = $selected_obat[2];
          $detail_paket_id = isset($selected_obat[3])?$selected_obat[3]:'';
          $kategori = "Obat";

          $array_item[]= array(
            'detail_paket_id'=>$detail_paket_id,
            'paket_id'=>$id_paket_edit,
            'item_id'=>$id_obat,
            'nama_item'=>$nama_obat,
            'harga_item'=>$harga_obat,
            'kategori_item'=>$kategori,
			      'created_by' => $this->session->userdata['simklinik']['ap_sid'],
          );
        }

        $paket_delete = $this->modelPaket->delete('paket_id',$id_paket_edit,'detail_paket_layanan');
        $jumlah_item = count($array_item);
        for($a=0;$a<$jumlah_item;$a++){
          if($array_item[$a]['detail_paket_id']==""){
            	$hasil_detail= $this->M_crud->_insert('detail_paket_layanan',$array_item[$a]);
          }
          else{
          	   $hasil_detail = $this->M_crud->_insert('detail_paket_layanan',$array_item[$a]);
              //$hasil_detail= $this->M_crud->_update('detail_paket_layanan','detail_paket_id',$array_item[$a]['detail_paket_id'],$array_item[$a]);
          }
        }
        if($update_paket == 1 && $hasil_detail==1){
          $data = array(
      				'class' => '1',
      				'msg' => '<strong>Berhasil</strong> Update Paket.',
      		);
      		$this->session->set_flashdata('alert',$data);
          redirect('paket');
        }
      }
      $data['layanans']=$this->M_crud->get_select_to_array('*','layanan');
      $data['ruangans']=$this->M_crud->get_select_to_array('*','kamar');
      $data['obats'] = $this->modelPaket->get_joined('harga_obat');
      $data['paket'] = $this->M_crud->get_by_id('paket_layanan','paket_layanan_id',$id_paket_edit);
      $data['detail_paket'] = $this->M_crud->get_select_no_join_to_array('*','detail_paket_layanan','paket_id',$id_paket_edit);
      $data['detail_paket_ruangan'] = $this->M_crud->get_by_param('detail_paket_layanan','kategori_item','ruangan','paket_id',$id_paket_edit);
      $data['detail_paket_obat'] = $this->M_crud->get_by_param_to_array('detail_paket_layanan','kategori_item','obat','paket_id',$id_paket_edit);
      $data['detail_paket_layanan'] = $this->M_crud->get_by_param_to_array('detail_paket_layanan','kategori_item','layanan','paket_id',$id_paket_edit);
      $this->load->view('form',$data);
    }
    function hapus($id){
    	if(!$this->modelPaket->delete('paket_layanan_id',$id,'paket_layanan') and !$this->modelPaket->delete('paket_id',$id,'detail_paket_layanan'))
    	{
    		$data = array(
    				'class' => '1',
    				'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data paket.',
    		);
    		$this->session->set_flashdata('alert',$data);
    		redirect('Paket');
    	}
    	else
    	{
    		$data = array(
    				'class' => '0',
    				'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
    		);
    		$this->session->set_flashdata('alert',$data);
    		redirect("Paket");
    	}
    }

    function cetak()
    {
    	$data['paket']=$this->modelPaket->get_paket();
    	$this->load->view('print',$data);
    }

    function doexport()
    {
    	$header = [
    			'No',
    			'Nama Paket',
    			'Harga Paket'
    	];

    	$dataList = array();
    	$list = $this->modelPaket->get_paket();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$harga = $this->M_base->currFormat2($datas->total_harga);
    		$harga = str_replace(".00", "", $harga);
    		$harga = "Rp. ".$harga;
    		$row[] = $datas->nama_paket_layanan;
    		$row[] = $harga;
    		$dataList[] = $row;
    	}

    	$writer = WriterFactory::create(Type::XLSX);
    	$namaFile = 'Data_Paket_'.date('Ymd') . '.xlsx';
    	$writer->openToBrowser($namaFile);
    	$writer->addRow($header);
    	$writer->addRows($dataList);
    	$writer->close();
    }
}
