<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Hargaobat extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      $this->load->model('M_harga','model');
    }
    
    function index()
    {
    	$this->M_setting->_make_sure_is_login();
    	$this->M_setting->_check_menu();
    	
        $data['hargaobat']=$this->model->get_joined('harga_obat');
        $this->load->view('index',$data);
    }
    
    function form($id=FALSE)
    {
    	$this->M_setting->_make_sure_is_login();
    	$this->M_setting->_check_menu();
    	
	      $data['obat']=$this->model->get_obat();
	      if($id===false){
	        $this->load->view('form',$data);
	      }
	      else {
	        $arr=array('harga_obat_id'=>$id);
	        $data['hargaobat']=$this->model->get_spesific('harga_obat',$arr);
	        $this->load->view('form',$data);
	      }
    }
    
    function simpan()
    {
      $this->form_validation->set_rules('id_obat','ID OBAT','is_unique[harga_obat.id_obat]');
      if($this->form_validation->run()===false){
        $data=array(
  				'class'=>'0',
  				'msg'=>'Penambahan Harga Obat Gagal, Karena Sudah Ada',
  			);
  			$this->session->set_flashdata('alert',$data);
  			redirect('hargaobat/form');
      }
      else {
      	
      	$beli = $this->input->post('harga_beli', TRUE);
      	$beli = str_replace(",", "", $beli);
      	
      	$jual1 = $this->input->post('harga_jual1', TRUE);
      	$jual1 = str_replace(",", "", $jual1);
      	
      	$jual2 = $this->input->post('harga_jual2', TRUE);
      	$jual2 = str_replace(",", "", $jual2);
      	
        $data=array(
          'id_obat'=>$this->input->post('id_obat'),
          'harga_beli'=>$beli,
          'harga_jual1'=>$jual1,
          'harga_jual2'=>$jual2,
		  'created_by' => $this->session->userdata['simklinik']['ap_sid'],
        );
        $this->model->insert('harga_obat',$data);
        $data=array(
  				'class'=>'1',
  				'msg'=>'Penambahan Harga Obat Berhasil Dilakukan'
  			);
  			$this->session->set_flashdata('alert',$data);
  			redirect('hargaobat');
      }
    }
    
    public function update($id)
    {
    	$beli = $this->input->post('harga_beli', TRUE);
    	$beli = str_replace(",", "", $beli);
    	 
    	$jual1 = $this->input->post('harga_jual1', TRUE);
    	$jual1 = str_replace(",", "", $jual1);
    	 
    	$jual2 = $this->input->post('harga_jual2', TRUE);
    	$jual2 = str_replace(",", "", $jual2);
    	
    	$getdata = $this->M_crud->get_by_id('harga_obat', 'harga_obat_id', $id);
    	$existing_harga = $getdata->id_obat;
    	$status_exs = TRUE;
    	
    	if($existing_harga <> $this->input->post('id_obat', TRUE)){
    		if($this->M_crud->check_table('harga_obat', 'id_obat', $this->input->post('id_obat', TRUE)) != NULL){
    			$status_exs = FALSE;
    		}
    	}
    	
    	if($status_exs == TRUE){
    		$data=array(
    				'id_obat'=>$this->input->post('id_obat'),
    				'harga_beli'=>$beli,
    				'harga_jual1'=>$jual1,
    				'harga_jual2'=>$jual2,
    				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
    		);
    		$query = $this->model->update('harga_obat',$data,$id);
    		if($query==0){
    			$data=array(
    					'class'=>'0',
    					'msg'=>'Perubahan Data Harga Obat Gagal, Karena Sudah Ada',
    			);
    			$this->session->set_flashdata('alert',$data);
    			redirect('hargaobat/form');
    		}
    		else {
    			$data=array(
    					'class'=>'1',
    					'msg'=>'Perubahan Data Harga Obat Berhasil Dilakukan'
    			);
    			$this->session->set_flashdata('alert',$data);
    			redirect('hargaobat');
    		}
    	}else{
    		$data = array(
    				'class' => '0',
    				'msg' => '<strong>Maaf</strong>, Harga obat/alkes yang anda masukan sudah ada.',
    		);
    		$this->session->set_flashdata('alert',$data);
    		redirect("Hargaobat/form/$id");
    	}
  	}
  	
  	public function hapus($id)
  	{
  		$query = $this->model->hapus('harga_obat',$id);
  			if($query==0){
  				$data=array(
  					'class'=>'0',
  					'msg'=>'Hapus Data Harga Obat Gagal',
  				);
  				$this->session->set_flashdata('alert',$data);
  				redirect('hargaobat/form');
  			}
  			else {
  				$data=array(
  				'class'=>'1',
  				'msg'=>'Hapus Data Harga Obat Berhasil Dilakukan'
  				);
  				$this->session->set_flashdata('alert',$data);
  				redirect('hargaobat');
  			}
  	}

  	function cetak()
  	{
  		$data['hargaobat']=$this->model->get_joined('harga_obat');
  		$this->load->view('print',$data);
  	}
  	
  	function doexport()
  	{
  		$header = [
  				'No',
  				'Nama Obat/Alkes',
  				'Harga Beli',
  				'Harga Jual 1',
  				'Harga Jual 2'
  		];
  		 
  		$dataList = array();
  		$list = $this->model->get_joined('harga_obat');
  		$no = 0;
  		foreach ($list as $datas)
  		{
  			$no++;
  			$row = array();
  			$row[] = $no;
  			$beli = $this->M_base->currFormat2($datas->harga_beli);
  			$beli = str_replace(".00", "", $beli);
  			$beli = "Rp. ".$beli;
  			 
  			$jual1 = $this->M_base->currFormat2($datas->harga_jual1);
  			$jual1 = str_replace(".00", "", $jual1);
  			$jual1 = "Rp. ".$jual1;
  			
  			$jual2 = $this->M_base->currFormat2($datas->harga_jual2);
  			$jual2 = str_replace(".00", "", $jual2);
  			$jual2 = "Rp. ".$jual2;
  			
  			$row[] = $datas->nama_obat;
  			$row[] = $beli;
  			$row[] = $jual1;
  			$row[] = $jual2;
  			$dataList[] = $row;
  		}
  		 
  		$writer = WriterFactory::create(Type::XLSX);
  		$namaFile = 'Data_Harga_Obat_'.date('Ymd') . '.xlsx';
  		$writer->openToBrowser($namaFile);
  		$writer->addRow($header);
  		$writer->addRows($dataList);
  		$writer->close();
  	}

}

 ?>
