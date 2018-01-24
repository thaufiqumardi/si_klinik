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
class M_ledger extends CI_Model
{

	function __construct()
    {
      parent::__construct();
	  
    }

    function akun()
    {
        $this->db->where('kode_header_akun','0')
                 ->where('kode_akun','0');
        $get = $this->db->get('ledger');

        if($get->num_rows() > 0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
    }

    function akun2()
    {
        $this->db->where_not_in('kode_header_akun',array('0'))
                 ->where('kode_akun','0');
        $get = $this->db->get('ledger');

        if($get->num_rows() > 0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
    }

    function read_akn()
    {
        $this->db->order_by('kode_header,kode_header_akun,kode_akun','asc');
        $get = $this->db->get('ledger');

        if($get->num_rows() > 0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
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
	
	function get($id)
	{
		$this->db->where('id',$id);
		
		$get = $this->db->get('ledger');
		
		if($get->num_rows() > 0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
	}

    function akun_jr()
    {
        $this->db->where_not_in('kode_header_akun',array('0'));
        $get = $this->db->get('ledger');

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