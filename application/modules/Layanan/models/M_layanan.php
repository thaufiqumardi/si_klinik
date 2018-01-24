<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_layanan extends CI_Model
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
	
	function get_layanan()
	{
		$this->db->select('*')
				 ->from('layanan')
				 ->order_by('nama','asc');
				 
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
				 ->where('id_layanan',$id)
				 ->from('layanan');
				 
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