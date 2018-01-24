<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Ledger extends MX_Controller {
	 
	function __construct()
    {
      parent::__construct();
      $this->load->model('M_ledger','modelLedger');	  
    }
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['akun'] = $this->modelLedger->read_akn();
		
		$this->load->view('show',$data);
	}
	
	public function add()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['akun1'] = $this->modelLedger->akun();
        $data['akun2'] = $this->modelLedger->akun2();
		
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$data['akun1'] = $this->modelLedger->akun();
        $data['akun2'] = $this->modelLedger->akun2();
        $data['edit'] = $this->modelLedger->get($id);
		
    	$data['current_page'] = 'ledger';
    	$data['title'] = 'Ledger';
		
		$this->load->view('form',$data);
	}
	
	function insert()
    {
        if($this->input->post('header') == 1)
        {
            $kd_akn = sprintf("%04s",$this->input->post('kd_akn'));
            $kode = $this->input->post('akun').strrev($kd_akn);
            $data = array(
                'kode_header' => $kode,
                'kode_header_akun' => 0,
                'kode_akun' => 0,
                'nama' => $this->input->post('name'),
				'created_at' => date("Y-m-d"),
            );

            $this->modelLedger->create($data,'ledger');

            $data = array(
                'class' => 'alert-success',
                'msg' => '<strong>Selamat</strong>, anda berhasil memasukan data ledger.',
            );
            $this->session->set_flashdata('alert',$data);
            redirect('Ledger');
        }
        elseif($this->input->post('header') == 2)
        {
            $kd = substr($this->input->post('header1'),0,2);
            $kd_akn = sprintf("%03s",$this->input->post('kd_akn'));
            $kode = $kd.strrev($kd_akn);
            $data = array(
                'kode_header' => $this->input->post('header1'), 
                'kode_header_akun' => $kode, 
                'kode_akun' => 0,
                'nama' => $this->input->post('name'),
				'created_at' => date("Y-m-d"),
            );

            $this->modelLedger->create($data,'ledger');

            $data = array(
                'class' => 'alert-success',
                'msg' => '<strong>Selamat</strong>, anda berhasil memasukan data ledger.',
            );
            $this->session->set_flashdata('alert',$data);
            redirect('Ledger');
        }
        elseif($this->input->post('header') == 3)
        {
            $kd1 = substr($this->input->post('header2'),1,1);
            $kd_akn1 = sprintf("%04s",$kd1);
            $header = strrev($kd_akn1.$this->input->post('akun'));

            $kd2 = substr($this->input->post('header2'),0,3);
            $kd_akn2 = sprintf("%02s",$this->input->post('kd_akn'));
            $kode = $kd2.strrev($kd_akn2);
			
            $data = array(
                'kode_header' => $header, 
                'kode_header_akun' => $this->input->post('header2'), 
                'kode_akun' => $kode,
                'nama' => $this->input->post('name'),
				'created_at' => date("Y-m-d"),
            );

            $this->modelLedger->create($data,'ledger');

            $data = array(
                'class' => 'alert-success',
                'msg' => '<strong>Selamat</strong>, anda berhasil memasukan data ledger.',
            );
            $this->session->set_flashdata('alert',$data);
            redirect('Ledger');
        }
    }
	
	function update()
    {
		
		$id = $this->input->post('id');
		
		if($this->input->post('header') == 1)
        {
            $kd_akn = sprintf("%04s",$this->input->post('kd_akn'));
            $kode = $this->input->post('akun').strrev($kd_akn);
            $data = array(
                'kode_header' => $kode,
                'kode_header_akun' => 0,
                'kode_akun' => 0,
                'nama' => $this->input->post('name'),
				'updated_at' => date("Y-m-d"),
            );

            $this->modelLedger->update($id,$data,'id','ledger');

            $data = array(
                'class' => 'alert-success',
                'msg' => '<strong>Selamat</strong>, anda berhasil memasukan data ledger.',
            );
            $this->session->set_flashdata('alert',$data);
            redirect('Ledger');
        }
        elseif($this->input->post('header') == 2)
        {
            $kd = substr($this->input->post('header1'),0,2);
            $kd_akn = sprintf("%03s",$this->input->post('kd_akn'));
            $kode = $kd.strrev($kd_akn);
            $data = array(
                'kode_header' => $this->input->post('header1'), 
                'kode_header_akun' => $kode, 
                'kode_akun' => 0,
                'nama' => $this->input->post('name'),
				'updated_at' => date("Y-m-d"),
            );

            $this->modelLedger->update($id,$data,'id','ledger');

            $data = array(
                'class' => 'alert-success',
                'msg' => '<strong>Selamat</strong>, anda berhasil memasukan data ledger.',
            );
            $this->session->set_flashdata('alert',$data);
            redirect('Ledger');
        }
        elseif($this->input->post('header') == 3)
        {
            $kd1 = substr($this->input->post('header2'),1,1);
            $kd_akn1 = sprintf("%04s",$kd1);
            $header = strrev($kd_akn1.$this->input->post('akun'));

            $kd2 = substr($this->input->post('header2'),0,3);
            $kd_akn2 = sprintf("%02s",$this->input->post('kd_akn'));
            $kode = $kd2.strrev($kd_akn2);
			
            $data = array(
                'kode_header' => $header, 
                'kode_header_akun' => $this->input->post('header2'), 
                'kode_akun' => $kode,
                'nama' => $this->input->post('name'),
				'updated_at' => date("Y-m-d"),
            );

            $this->modelLedger->update($id,$data,'id','ledger');

            $data = array(
                'class' => 'alert-success',
                'msg' => '<strong>Selamat</strong>, anda berhasil memasukan data ledger.',
            );
            $this->session->set_flashdata('alert',$data);
            redirect('Ledger');
        }
		
    }
    
    function delete($id)
    {
    	if(!$this->modelLedger->delete('id',$id,'ledger'))
    	{
    		$data = array(
    				'class' => '1',
    				'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data kode akun.',
    		);
    		$this->session->set_flashdata('alert',$data);
    		redirect('Ledger');
    	}
    	else
    	{
    		$data = array(
    				'class' => '0',
    				'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
    		);
    		$this->session->set_flashdata('alert',$data);
    		redirect("Ledger");
    	}
    }
    
    function cetak()
    {
    	$data['ledger'] = $this->modelLedger->read_akn();
    	$this->load->view('print',$data);
    }
    
    function doexport()
    {
    	$header = [
    			'No',
    			'Kode Akun',
    			'Nama Akun'
    	];
    	 
    	$dataList = array();
    	$list = $this->modelLedger->read_akn();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$row[] = $this->kode($datas->kode_header,$datas->kode_header_akun,$datas->kode_akun);
    		$row[] = $datas->nama;
    		$dataList[] = $row;
    	}
    	 
    	$writer = WriterFactory::create(Type::XLSX);
    	$namaFile = 'Data_KodeAkun_'.date('Ymd') . '.xlsx';
    	$writer->openToBrowser($namaFile);
    	$writer->addRow($header);
    	$writer->addRows($dataList);
    	$writer->close();
    }
    
    function kode($header,$header_akun,$akun)
    {
    	if($header != 0 and $akun == 0 and $header_akun == 0)
    	{
    		$kode = $header;
    	}
    	elseif($header != 0 and $akun == 0 and $header_akun != 0)
    	{
    		$kode = $header_akun;
    	}
    	else
    	{
    		$kode = $akun;
    	}
    
    	return $kode;
    }
	
}
