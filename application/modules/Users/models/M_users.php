<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model{

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

    function get_users()
    {
    	$this->db->select('users.*, role.role_name')
    	->from('users')
    	->join('role', 'role.role_id=users.role_id', 'left')
    	->where('username <>', 'administrator')
			->where('is_admin',0)    	
    	->order_by('username','asc');

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
    	->where('user_id',$id)
    	->from('users');

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
}
