<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_previlleges extends CI_Model
{

	function __construct()
	{
		parent::__construct();		 
	}

	function create($data,$table)
	{
		$this->db->insert($table,$data);
	}

	function update($id,$data,$trig,$table)
	{
		$this->db->where($trig,$id);
		$this->db->update($table,$data);
	}

	function delete($trig,$id,$table)
	{
		$this->db->where($trig, $id);
		$this->db->delete($table);
	}
	
	function get_previlleges()
	{
		$this->db->select('hak_akses.*, role.role_name, menu.title')
				->from('hak_akses')
				->join('role', 'role.role_id=hak_akses.hak_akses_role', 'left')
				->join('menu', 'menu.id_menu=hak_akses.hak_akses_menu', 'left')
				->order_by('hak_akses_role','asc');
			
		$get = $this->db->get();
	
		if($get->num_rows() > 0)
		{
			return $get->result();
		}
		else
		{
			return 0;
		}
	}
	
	function edit($id)
	{
		$this->db->select('*')
		->where('id_hak_akses',$id)
		->from('hak_akses');
			
		$get = $this->db->get();
	
		if($get->num_rows() > 0)
		{
			return $get->result();
		}
		else
		{
			return 0;
		}
	}
	
	function get_menu()
	{
		$this->db->select('*')
		->from('menu')
		->order_by('title', 'asc');
			
		$get = $this->db->get();
	
		if($get->num_rows() > 0)
		{
			return $get->result();
		}
		else
		{
			return 0;
		}
	}
	
	function get_role()
	{
		$this->db->select('*')
		->from('role')
		->where('role_name <> ', 'Super Admin')
		->order_by('role_name', 'asc');
			
		$get = $this->db->get();
	
		if($get->num_rows() > 0)
		{
			return $get->result();
		}
		else
		{
			return 0;
		}
	}
	
	function get_role_by_id($id)
	{
		$this->db->select('*')->where('role_id',$id)->from('role');
		$get = $this->db->get();
		return $get->result();
	}
	
	function get_menu_by_id($id)
	{
		$this->db->select('*')->where('id_menu',$id)->from('menu');
		$get = $this->db->get();
		return $get->result();
	}
	
}