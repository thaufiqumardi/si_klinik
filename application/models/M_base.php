<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_base extends CI_Model {

	public function check_session()
	{
		$CI= & get_instance();
		$session = "";
		if(isset($CI->session->userdata['simklinik']))
		{
			$session=$CI->session->userdata['simklinik']['ap_status_login'];
		}
		return $session;
	}

	public function check_session_login()
	{
		$CI= & get_instance();
		$session = "";
		if(isset($CI->session->userdata['simklinik']))
		{
			$session=$CI->session->userdata['simklinik']['ap_status_login'];
		}
		return $session;
	}

	public function currFormat0($num)
	{
		$result = number_format($num,0,".",",");
		return $result;
	}

	public function currFormat2($num)
	{
		$result = number_format($num,2,".",".");
		return $result;
	}
}
