<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orderModel
 *
 * @author Temmy Rustandi Hidayat
 */
class M_role extends CI_Model
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
	
	function get_role()
	{        
        $this->db->select('*')
        		 ->from('role')
        		 ->where('role_name <> ','Super Admin')
        		 ->order_by('role_name','asc');
        	
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
	
	function got_menu($array)
	{
		$this->db->select('*')
				 ->where_in('id_menu',$array)
				 ->from('menu');
		
		$get = $this->db->get();
		
		if($get->num_rows() > 0)
		{
			foreach($get->result() as $dim)
			{
				$data[] = $dim->title;
			}
			
			return $data;
		}
		else
		{
			return 0;
		}
	}
	
	function edit_role($id)
	{
		$this->db->select('*')
				 ->where('role_id',$id)
				 ->from('role');
				 
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
				 ->from('menu');
				 
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
		->where('role_id',$id)
		->from('role');
			
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

}