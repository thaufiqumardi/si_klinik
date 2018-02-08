<?php


class Model_login extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function authenticate($username, $password) {
		$this->db->select("*");
		$result = $this->db->get_where('users', array('username' => $username, 'password' => $this->hash($password), 'status' => 'Aktif'));
		if ($result->num_rows() == 1) {
			$user_info = $result->row();
			return $result->result();
		}else{
			return FALSE;
		}
	}

	function hash($string){
		return hash('sha512', $string . config_item('encryption_key'));
	}
}
