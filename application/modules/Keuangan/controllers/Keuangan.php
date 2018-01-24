<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Keuangan extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_keuangan','modelKeuangan');
	}
	
	public function index()
	{
	}
	
	public function datapengeluaran()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
	
		$data['pengeluaran'] = $this->modelKeuangan->get_pengeluaran();
	
		$this->load->view('show_pengeluaran',$data);
	}
	
	public function add_pengeluaran()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
	
		$data['no_pengeluaran']		= $this->session->flashdata("no_pengeluaran");
		$data['tgl_pengeluaran']	= $this->session->flashdata("tgl_pengeluaran");
		$data['nama_pengeluaran']	= $this->session->flashdata("nama_pengeluaran");
		$data['qty_pengeluaran']	= $this->session->flashdata("qty_pengeluaran");
		$data['harga_pengeluaran']	= $this->session->flashdata("harga_pengeluaran");
		$data['total_pengeluaran']	= $this->session->flashdata("total_pengeluaran");
	
		$this->load->view('form_pengeluaran',$data);
	}
	
	public function edit_pengeluaran($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
    	
    	if(!empty($this->session->flashdata("no_pengeluaran"))){
    		$data['pengeluaran_id']		= $id;
    		$data['no_pengeluaran']		= $this->session->flashdata("no_pengeluaran");
    		$data['tgl_pengeluaran']	= $this->session->flashdata("tgl_pengeluaran");
    		$data['nama_pengeluaran']	= $this->session->flashdata("nama_pengeluaran");
			$data['qty_pengeluaran']	= $this->session->flashdata("qty_pengeluaran");
			$data['harga_pengeluaran']	= $this->session->flashdata("harga_pengeluaran");
			$data['total_pengeluaran']	= $this->session->flashdata("total_pengeluaran");
    	}else{
    		$query = $this->modelKeuangan->edit_pengeluaran($id);
    		foreach ($query as $result){
    			$qty_pengeluaran = $this->M_base->currFormat2($result->qty_pengeluaran);
    			$qty_pengeluaran = str_replace(".00", "", $qty_pengeluaran);
    			$harga_pengeluaran = $this->M_base->currFormat2($result->harga_pengeluaran);
    			$harga_pengeluaran = str_replace(".00", "", $harga_pengeluaran);
    			$data['pengeluaran_id']		= $id;
    			$data['no_pengeluaran']		= $result->no_pengeluaran;
    			$data['tgl_pengeluaran']	= $result->tgl_pengeluaran;
    			$data['nama_pengeluaran']	= $result->nama_pengeluaran;
				$data['qty_pengeluaran']	= $qty_pengeluaran;
				$data['harga_pengeluaran']	= $harga_pengeluaran;
    		}
    	}
		
		$this->load->view('form_pengeluaran',$data);
	}
	
	function insert_pengeluaran()
	{
		$harga_pengeluaran = $this->input->post('harga_pengeluaran', TRUE);
		$harga_pengeluaran = str_replace(",", "", $harga_pengeluaran);
		
		$qty_pengeluaran = $this->input->post('qty_pengeluaran', TRUE);
		
		$total_pengeluaran = $harga_pengeluaran * $qty_pengeluaran;
		
		$data = array(
				'no_pengeluaran' => $this->input->post('no_pengeluaran', TRUE),
				'tgl_pengeluaran' => date('Y-d-m', strtotime($this->input->post('tgl_pengeluaran', TRUE))),
				'nama_pengeluaran' => $this->input->post('nama_pengeluaran', TRUE),
				'qty_pengeluaran' => $this->input->post('qty_pengeluaran', TRUE),
				'harga_pengeluaran' => $harga_pengeluaran,
				'total_pengeluaran' => $total_pengeluaran,
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		 
		if(!$this->modelKeuangan->create($data,'pengeluaran'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menginput data pengeluaran.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('keuangan/datapengeluaran');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
			);
			$this->session->set_flashdata("no_pengeluaran", $this->input->post('no_pengeluaran', TRUE));
			$this->session->set_flashdata("tgl_pengeluaran", $this->input->post('tgl_pengeluaran', TRUE));
			$this->session->set_flashdata("nama_pengeluaran", $this->input->post('nama_pengeluaran', TRUE));
			$this->session->set_flashdata("qty_pengeluaran", $this->input->post('qty_pengeluaran', TRUE));
			$this->session->set_flashdata("harga_pengeluaran", $this->input->post('harga_pengeluaran', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect('keuangan/add_pengeluaran');
		}
	}
	
	function update_pengeluaran()
	{
		$id = $this->input->post('id', TRUE);
		
		$harga_pengeluaran = $this->input->post('harga_pengeluaran', TRUE);
		$harga_pengeluaran = str_replace(",", "", $harga_pengeluaran);
		
		$qty_pengeluaran = $this->input->post('qty_pengeluaran', TRUE);
		
		$total_pengeluaran = $harga_pengeluaran * $qty_pengeluaran;
		
		$data = array(
				'no_pengeluaran' => $this->input->post('no_pengeluaran', TRUE),
				'tgl_pengeluaran' => date('Y-d-m', strtotime($this->input->post('tgl_pengeluaran', TRUE))),
				'nama_pengeluaran' => $this->input->post('nama_pengeluaran', TRUE),
				'qty_pengeluaran' => $this->input->post('qty_pengeluaran', TRUE),
				'harga_pengeluaran' => $harga_pengeluaran,
				'total_pengeluaran' => $total_pengeluaran,
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		
		if(!$this->modelKeuangan->update($id,$data,'pengeluaran_id','pengeluaran'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengeluaran.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('keuangan/datapengeluaran');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
			);
			$this->session->set_flashdata("no_pengeluaran", $this->input->post('no_pengeluaran', TRUE));
			$this->session->set_flashdata("tgl_pengeluaran", $this->input->post('tgl_pengeluaran', TRUE));
			$this->session->set_flashdata("nama_pengeluaran", $this->input->post('nama_pengeluaran', TRUE));
			$this->session->set_flashdata("qty_pengeluaran", $this->input->post('qty_pengeluaran', TRUE));
			$this->session->set_flashdata("harga_pengeluaran", $this->input->post('harga_pengeluaran', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("keuangan/edit_pengeluaran/$id");
		}			
	}
	
	function delete_pengeluaran($id)
	{
		if(!$this->kamar->delete('pengeluaran_id',$id,'pengeluaran'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data pengeluaran.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('keuangan/datapengeluaran');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("keuangan/datapengeluaran");
		}
	}
	
	function cetak_pengeluaran()
	{
		$data['pengeluaran'] = $this->modelKeuangan->get_pengeluaran();
		$this->load->view('print',$data);
	}
	
	function doexport_pengeluaran()
	{
		$header = [
				'No',
				'No. Kuitansi',
				'Tgl. Pengeluaran',
				'Nama Item',
				'Total'
		];
		 
		$dataList = array();
		$list = $this->modelKeuangan->get_pengeluaran();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$total_pengeluaran = $this->M_base->currFormat2($datas->total_pengeluaran);
			$total_pengeluaran = str_replace(".00", "", $total_pengeluaran);
			$total_pengeluaran = "Rp. ".$total_pengeluaran;
			$row[] = $datas->no_pengeluaran;
			$row[] = date('d-M-Y',strtotime($datas->tgl_pengeluaran));
			$row[] = $datas->nama_pengeluaran;
			$row[] = $total_pengeluaran;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Pengeluaran_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
	
	function laporanpendapatan()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['tgl_awal']		= "";
		$data['tgl_akhir']		= "";
		$data['formType']		= "";
		
		$this->load->view('show_lappendapatan', $data);
	}
	
	function showlaporanpendapatan($dateFrom, $dateTo)
	{
		$data['details'] 		= $this->modelKeuangan->get_lappendapatan($dateFrom, $dateTo);
		$data['tgl_awal']		= date('d-m-Y', strtotime($dateFrom));
		$data['tgl_akhir']		= date('d-m-Y', strtotime($dateTo));
		$data['formType']		= "cetak";
		$this->load->view('show_lappendapatan',$data);
	}
	
	function cetak_laporanpendapatan()
	{
		$valType = $this->input->post('valType');
		if($valType == "show"){
			$dateFrom = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$dateTo = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$this->showlaporanpendapatan($dateFrom, $dateTo);
		}else{
			$location = 'logo';
			$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
			$data['imgpath'] = $path_to_file;
			$data['periode_awal'] = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$data['periode_akhir'] = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$ta = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$tk = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$data['details'] = $this->modelKeuangan->get_lappendapatan($ta, $tk);
			$this->load->view('print_lappendapatan',$data);
			$html = $this->output->get_output();
			$this->pdf->load_html($html);
			$this->pdf->set_paper("A4","landscape");
			$this->pdf->render();
			$this->pdf->stream('LaporanPendapatan'.date('Ymd'),array("Attachment"=>0));
		}		
	}
	
	function laporanpengeluaran()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['tgl_awal']		= "";
		$data['tgl_akhir']		= "";
		$data['formType']		= "";
		
		$this->load->view('show_lappengeluaran',$data);
	}
	
	function showlaporanpengeluaran($dateFrom, $dateTo)
	{
		$data['details'] 		= $this->modelKeuangan->get_lappengeluaran($dateFrom, $dateTo);
		$data['tgl_awal']		= date('d-m-Y', strtotime($dateFrom));
		$data['tgl_akhir']		= date('d-m-Y', strtotime($dateTo));
		$data['formType']		= "cetak";
		$this->load->view('show_lappengeluaran',$data);
	}
	
	function cetak_laporanpengeluaran()
	{
		$valType = $this->input->post('valType');
		if($valType == "show"){
			$dateFrom = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$dateTo = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$this->showlaporanpengeluaran($dateFrom, $dateTo);
		}else{
			$location = 'logo';
			$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
			$data['imgpath'] = $path_to_file;
			$data['periode_awal'] = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$data['periode_akhir'] = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$ta = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$tk = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$data['details'] = $this->modelKeuangan->get_lappengeluaran($ta, $tk);
			$this->load->view('print_lappengeluaran',$data);
			$html = $this->output->get_output();
			$this->pdf->load_html($html);
			$this->pdf->set_paper("A4","landscape");
			$this->pdf->render();
			$this->pdf->stream('LaporanPengeluaran'.date('Ymd'),array("Attachment"=>0));
		}		
	}
	
	function pembayaranpasien()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['tgl_awal']		= "";
		$data['tgl_akhir']		= "";
		$data['formType']		= "";
		
		$this->load->view('show_lappembpasien', $data);
	}
	
	function showpembayaranpasien($dateFrom, $dateTo)
	{
		$data['details'] 		= $this->modelKeuangan->get_lappembpasien($dateFrom, $dateTo);
		$data['tgl_awal']		= date('d-m-Y', strtotime($dateFrom));
		$data['tgl_akhir']		= date('d-m-Y', strtotime($dateTo));
		$data['formType']		= "cetak";
		$this->load->view('show_lappembpasien',$data);
	}
	
	function cetak_laporanpembayaranpasien()
	{
		$valType = $this->input->post('valType');
		if($valType == "show"){
			$dateFrom = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$dateTo = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$this->showpembayaranpasien($dateFrom, $dateTo);
		}else{
			$location = 'logo';
			$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
			$data['imgpath'] = $path_to_file;
			$data['periode_awal'] = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$data['periode_akhir'] = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$ta = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$tk = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$data['details'] = $this->modelKeuangan->get_lappembpasien($ta, $tk);
			$this->load->view('print_lappembpasien',$data);
			$html = $this->output->get_output();
			$this->pdf->load_html($html);
			$this->pdf->set_paper("A4","landscape");
			$this->pdf->render();
			$this->pdf->stream('LaporanPembayaranPasien'.date('Ymd'),array("Attachment"=>0));
		}
	}
	
	function laporanpiutang()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['tgl_awal']		= "";
		$data['tgl_akhir']		= "";
		$data['formType']		= "";
		
		$this->load->view('show_lappiutang', $data);
	}
	
	function showlaporanpiutang($dateFrom, $dateTo)
	{
		$data['details'] 		= $this->modelKeuangan->get_lappiutang($dateFrom, $dateTo);
		$data['tgl_awal']		= date('d-m-Y', strtotime($dateFrom));
		$data['tgl_akhir']		= date('d-m-Y', strtotime($dateTo));
		$data['formType']		= "cetak";
		$this->load->view('show_lappiutang',$data);
	}
	
	function cetak_laporanpiutang()
	{
		$valType = $this->input->post('valType');
		if($valType == "show"){
			$dateFrom = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$dateTo = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$this->showlaporanpiutang($dateFrom, $dateTo);
		}else{
			$location = 'logo';
			$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
			$data['imgpath'] = $path_to_file;
			$data['periode_awal'] = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$data['periode_akhir'] = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$ta = date('Y-m-d', strtotime($this->input->post('TglAwal')));
			$tk = date('Y-m-d', strtotime($this->input->post('TglAkhir')));
			$data['details'] = $this->modelKeuangan->get_lappiutang($ta, $tk);
			$this->load->view('print_lappiutang',$data);
			$html = $this->output->get_output();
			$this->pdf->load_html($html);
			$this->pdf->set_paper("A4","landscape");
			$this->pdf->render();
			$this->pdf->stream('LaporanPiutang'.date('Ymd'),array("Attachment"=>0));
		}		
	}
	
	function laporanlabarugi()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['bulan']			= "";
		$data['tahun']			= "";
		$data['formType']		= "";
		
		$this->load->view('show_laplabarugi', $data);
	}
	
	function showlaporanlabarugi($bulan, $tahun)
	{
		$data['pengeluaran'] 	= $this->modelKeuangan->select_labarugi_pengeluaran($bulan, $tahun);
		$data['pendapatan'] 	= $this->modelKeuangan->select_labarugi_pendapatan($bulan, $tahun);
		$data['bulan']			= $bulan;
		$data['tahun']			= $tahun;
		$data['formType']		= "cetak";
		$this->load->view('show_laplabarugi',$data);
	}
	
	function cetak_laporanlabarugi()
	{
		$valType = $this->input->post('valType');
		if($valType == "show"){
			$bulan = $this->input->post('Bulan');
			$tahun = $this->input->post('Tahun');
			$this->showlaporanlabarugi($bulan, $tahun);
		}else{
			$location = 'logo';
			$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
			$data['imgpath'] = $path_to_file;
			$bulan = $this->input->post('Bulan');
			$tahun = $this->input->post('Tahun');
			$data['bulan'] = $this->bulan($bulan);
			$data['tahun'] = $this->input->post('Tahun');
			$data['pengeluaran'] = $this->modelKeuangan->select_labarugi_pengeluaran($bulan, $tahun);
			$data['pendapatan'] = $this->modelKeuangan->select_labarugi_pendapatan($bulan, $tahun);
			$this->load->view('print_laplabarugi',$data);
			$html = $this->output->get_output();
			$this->pdf->load_html($html);
			$this->pdf->set_paper("A4","potrait");
			$this->pdf->render();
			$this->pdf->stream('LaporanLabaRugi'.date('Ymd'),array("Attachment"=>0));
		}		
	}
	
	function jurnalpendapatan()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['bulan']			= "";
		$data['tahun']			= "";
		$data['formType']		= "";
		
		$this->load->view('show_lapjurnalpendapatan', $data);
	}
	
	function showjurnalpendapatan($bulan, $tahun)
	{
		$data['details'] 		= $this->modelKeuangan->get_jurnalpendapatan($bulan, $tahun);
		$data['bulan']			= $bulan;
		$data['tahun']			= $tahun;
		$data['formType']		= "cetak";
		$this->load->view('show_lapjurnalpendapatan',$data);
	}
	
	function cetak_laporanjurnalpendapatan()
	{
		$valType = $this->input->post('valType');
		if($valType == "show"){
			$bulan = $this->input->post('Bulan');
			$tahun = $this->input->post('Tahun');
			$this->showjurnalpendapatan($bulan, $tahun);
		}else{
			$location = 'logo';
			$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
			$data['imgpath'] = $path_to_file;
			$bulan = $this->input->post('Bulan');
			$tahun = $this->input->post('Tahun');
			$data['bulan'] = $this->bulan($bulan);
			$data['tahun'] = $this->input->post('Tahun');
			$data['details'] = $this->modelKeuangan->get_jurnalpendapatan($bulan, $tahun);
			$this->load->view('print_lapjurnalpendapatan',$data);
			$html = $this->output->get_output();
			$this->pdf->load_html($html);
			$this->pdf->set_paper("A4","potrait");
			$this->pdf->render();
			$this->pdf->stream('JurnalPendapatan',array("Attachment"=>0));
		}		
	}
	
	function jurnalpengeluaran()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['bulan']			= "";
		$data['tahun']			= "";
		$data['formType']		= "";
		
		$this->load->view('show_lapjurnalpengeluaran', $data);
	}
	
	function showjurnalpengeluaran($bulan, $tahun)
	{
		$data['details'] 		= $this->modelKeuangan->get_jurnalpengeluaran($bulan, $tahun);
		$data['bulan']			= $bulan;
		$data['tahun']			= $tahun;
		$data['formType']		= "cetak";
		$this->load->view('show_lapjurnalpengeluaran',$data);
	}
	
	function cetak_laporanjurnalpengeluaran()
	{
		$valType = $this->input->post('valType');
		if($valType == "show"){
			$bulan = $this->input->post('Bulan');
			$tahun = $this->input->post('Tahun');
			$this->showjurnalpengeluaran($bulan, $tahun);
		}else{
			$location = 'logo';
			$path_to_file = FCPATH . $location."\KMB_Logo_Small.png";
			$data['imgpath'] = $path_to_file;
			$bulan = $this->input->post('Bulan');
			$tahun = $this->input->post('Tahun');
			$data['bulan'] = $this->bulan($bulan);
			$data['tahun'] = $this->input->post('Tahun');
			$data['details'] = $this->modelKeuangan->get_jurnalpengeluaran($bulan, $tahun);
			$this->load->view('print_lapjurnalpengeluaran',$data);
			$html = $this->output->get_output();
			$this->pdf->load_html($html);
			$this->pdf->set_paper("A4","potrait");
			$this->pdf->render();
			$this->pdf->stream('JurnalPengeluaran',array("Attachment"=>0));
		}		
	}
	
	function bulan($bulan)
	{
		Switch ($bulan){
			case 1 : $bulan="Januari";
			Break;
			case 2 : $bulan="Februari";
			Break;
			case 3 : $bulan="Maret";
			Break;
			case 4 : $bulan="April";
			Break;
			case 5 : $bulan="Mei";
			Break;
			case 6 : $bulan="Juni";
			Break;
			case 7 : $bulan="Juli";
			Break;
			case 8 : $bulan="Agustus";
			Break;
			case 9 : $bulan="September";
			Break;
			case 10 : $bulan="Oktober";
			Break;
			case 11 : $bulan="November";
			Break;
			case 12 : $bulan="Desember";
			Break;
		}
		return $bulan;
	}
	
}