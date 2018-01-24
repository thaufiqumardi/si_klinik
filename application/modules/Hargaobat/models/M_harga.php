<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_harga extends CI_Model
{
    function __construct()
    {
      $this->load->database();
    }
    
    function get_joined($table)
    {
  		$this->db->select('*');
  		$this->db->from($table);
  		$this->db->join('obat','obat.id_obat=harga_obat.id_obat');
  		$this->db->order_by('obat.nama_obat', 'asc');
  		return $this->db->get()->result();
  	}
  	
  	function get($table)
  	{
  		return $this->db->get($table)->result();
  	}
  	
  	function get_spesific($table,$arr)
  	{
  		return $this->db->get_where($table,$arr)->row();
  	}
  	
  	function insert($table,$data)
  	{
  		return $this->db->insert($table,$data);
  	}
  	
  	function update($table,$data,$id)
  	{
  		$this->db->where('harga_obat_id',$id);
  		return $this->db->update($table,$data);
  	}
  	
  	function hapus($table,$id)
  	{
  		$this->db->where('harga_obat_id',$id);
  		return $this->db->delete($table);
  	}
  	
  	function get_obat()
  	{
  		$this->db->select('*')
  		->from('obat')
  		->order_by('nama_obat', 'asc');
  			
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

?>
