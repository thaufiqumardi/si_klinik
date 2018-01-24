<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Owner extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_owner','modelOwner');
	}
	
	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$query = $this->modelOwner->getOwner();
		if(!is_null($query)){
			foreach ($query as $result){
				$data['owner_id']			= $result->owner_id;
				$data['nama_owner']			= $result->nama_owner;
				$data['alamat_owner']		= $result->alamat_owner;
				$data['logo_owner']			= $result->logo_owner;
				$data['no_telpon_owner']	= $result->no_telpon_owner;
			}
		}else{
			$data['owner_id']			= "1";
			$data['nama_owner']			= "";
			$data['alamat_owner']		= "";
			$data['logo_owner']			= "";
			$data['no_telpon_owner']	= "";
		}

		$this->load->view('editOwner',$data);
	}
	
	function update($id){
		$url=$this->do_upload();
		$this->modelOwner->updateOwner($id, $url);
		redirect('owner');
	}

	private function do_upload()
	{
		$type = explode('.', $_FILES["logo_owner"]["name"]);
		$type = strtolower($type[count($type)-1]);
		$url = "./uploads/".uniqid(rand()).'.'.$type;
		if(in_array($type, array("jpg", "jpeg", "gif", "png")))
			if(is_uploaded_file($_FILES["logo_owner"]["tmp_name"]))
				if(move_uploaded_file($_FILES["logo_owner"]["tmp_name"],$url))
					return $url;
		return "";
	}
}