<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_setting extends CI_Model {
	
	public function _make_sure_is_login()
	{
		$user_id = $this->_get_user_id();
			
		if(empty($user_id)){
			redirect('login');
		}
	}
	
	function _get_user_id()
	{
		$CI= & get_instance();
		$user_id = "";
		if(isset($CI->session->userdata['simklinik']))
		{
			$user_id = $CI->session->userdata['simklinik']['ap_sid'];
		}
			
		return $user_id;
	}
	
	function _check_menu()
	{
		$is_admin = $this->session->userdata['simklinik']['ap_is_admin'];
		$menus = $this->M_crud->get_select_to_array('m.id_menu', 'hak_akses as p','menu as m','p.hak_akses_menu = m.id_menu','p.hak_akses_role', $this->session->userdata['simklinik']['ap_role'], 'p.hak_akses_retrive', '1', 'm.id_menu');
		$listmenu = "";
	
		if(!empty($menus)){
			foreach($menus as $item) {
				$listmenu .= $item->id_menu.",";
			}
			$listmenu = rtrim($listmenu,",");
				
			$mysql_query = "select * from menu where id_menu in(".$listmenu.") order by urutan asc";
				
			$query = $this->M_crud->_custom_query($mysql_query);
			$num_rows = $query->num_rows();
				
			if($num_rows < 1){
				if($is_admin == 1){
					return TRUE;
				}else{
					redirect('beranda');
				}
			}else{
				return TRUE;
			}
		}else{
			if($is_admin == 1){
				return TRUE;
			}else{
				redirect('beranda');
			}
		}
	}
	
}