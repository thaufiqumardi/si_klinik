<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_menu extends CI_Model
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
	
	function get_data()
	{
		$this->db->select('*')
				 ->from('menu')
				 ->order_by('id_menu', 'asc');
				 
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
	
	function get_menu($id)
	{
		$this->db->select('*')
				 ->from('menu')
				 ->where('id_menu',$id);
		
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
	
	function get_menu_parent($id)
	{
		$this->db->select('*')->where('id_menu',$id)->from('menu');
		$get = $this->db->get();
		return $get->result();
	}

}