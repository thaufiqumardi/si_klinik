<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Menu extends MX_Controller {
	 
	function __construct()
    {
      parent::__construct();
      $this->load->model('M_menu','menu');	  
    }
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['menu'] = $this->menu->get_data();
		
		$this->load->view('show',$data);
	}
	
	public function edit_menu($id)
	{		
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
    	
    	if(!empty($this->session->flashdata("menu_title"))){
    		$data['id_menu']	= $id;
    		$data['menu_title'] = $this->session->flashdata("menu_title");
	    	$data['icon'] 		= $this->session->flashdata("icon");
	    	$data['urutan'] 	= $this->session->flashdata("urutan");
    	}else{
    		$query = $this->menu->get_menu($id);
    		foreach ($query as $result){
    			$data['id_menu']			= $id;
    			$data['menu_title']			= $result->title;
    			$data['icon']				= $result->icon;
    			$data['urutan']				= $result->urutan;
    		}
    	}
		
		$this->load->view('form',$data);
	}
	
	public function update()
	{
		$id = $this->input->post('id', TRUE);
		$getdata = $this->M_crud->get_by_id('menu', 'id_menu', $id);
		$exs_menutitle = $getdata->title;
		$status_title = TRUE;
		
		if($exs_menutitle <> $this->input->post('menu_title', TRUE)){
			if($this->M_crud->check_table('menu', 'title', $this->input->post('menu_title', TRUE)) != NULL){
				$status_title = FALSE;
			}
		}

		$data = array(
				'title' => $this->input->post('menu_title', TRUE),
				'icon' => $this->input->post('icon', TRUE),
				'urutan' => $this->input->post('urutan', TRUE),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
		);
		
		if($status_title == TRUE)
		{
			if(!$this->menu->update($id,$data,'id_menu','menu'))
			{
				$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data menu.',
				);
				$this->session->set_flashdata('alert',$data);
				redirect('Menu');
			}
			else
			{
				$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
				);
				$this->session->set_flashdata('alert',$data);
				$this->session->set_flashdata("menu_title", $this->input->post('menu_title', TRUE));
				$this->session->set_flashdata("icon", $this->input->post('icon', TRUE));
				$this->session->set_flashdata("urutan", $this->input->post('urutan', TRUE));
				redirect("Menu/edit_menu/$id");
			}
		}else{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Title menu yang anda masukan sudah ada.',
			);
			$this->session->set_flashdata("menu_title", $this->input->post('menu_title', TRUE));
			$this->session->set_flashdata("icon", $this->input->post('icon', TRUE));
			$this->session->set_flashdata("urutan", $this->input->post('urutan', TRUE));
			$this->session->set_flashdata('alert',$data);
			redirect("Menu/edit_menu/$id");
		}
	}
	
	function hapus_menu($id)
    {			
		if(!$this->menu->delete('id_menu',$id,'menu'))
		{
			$data = array(
			'class' => '1',
			'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data menu.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Menu');
		}
		else
		{
			$data = array(
				'class' => '0',
				'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Menu");
		}
    }
    
    function get_menu_parent($id)
    {
    	$result = $this->menu->get_menu_parent($id);
    	foreach ($result as $row){
    	 	$menu_parent = $row->title;
    	}
    	return $menu_parent;
    }
    
    function cetak()
    {
    	$data['menus']=$this->menu->get_data();
    	$this->load->view('print',$data);
    }
    
    function doexport()
    {
    	$header = [
    			'No',
    			'Title',
    			'Parent',
    			'Urutan'
    	];
    	 
    	$dataList = array();
    	$list = $this->menu->get_data();
    	$no = 0;
    	foreach ($list as $datas)
    	{
    		$no++;
    		$row = array();
    		$row[] = $no;
    		$menu_parent = "";
    		if(!empty($datas->parent) AND !is_null($datas->parent)){
    			$result = $this->menu->get_menu_parent($datas->parent);
    			foreach ($result as $rows){
    				$menu_parent = $rows->title;
    			}
    		}
    		$row[] = $datas->title;
    		$row[] = $menu_parent;
    		$row[] = $datas->urutan;
    		$dataList[] = $row;
    	}
    	 
    	$writer = WriterFactory::create(Type::XLSX);
    	$namaFile = 'Data_Menu_'.date('Ymd') . '.xlsx';
    	$writer->openToBrowser($namaFile);
    	$writer->addRow($header);
    	$writer->addRows($dataList);
    	$writer->close();
    }
}
