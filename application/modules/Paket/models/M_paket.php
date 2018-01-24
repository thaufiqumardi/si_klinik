<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_paket extends CI_Model{
    function __construct(){
      parent::__construct();
      $this->load->database();
    }
    
    function insert($table,$data){
      $this->db->insert($table,$data);
      return $this->db->insert_id();
    }
    
    function delete($trig,$id,$table)
    {
    	$this->db->where($trig, $id);
    	$this->db->delete($table);
    }
    
    function get_paket()
    {
    	$this->db->select('*')
    	->from('paket_layanan')
    	->order_by('nama_paket_layanan','asc');
    		
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
    
    function get_joined($table)
    {
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->join('obat','obat.id_obat=harga_obat.id_obat');
    	$this->db->order_by('obat.nama_obat', 'asc');
    	return $this->db->get()->result();
    }
}
