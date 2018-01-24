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
class M_obat extends CI_Model
{

	function __construct()
    {
      parent::__construct();
			$this->load->database();
    }
	function get_joined($table){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('kategori','kategori.id_kategori=obat.id_kategori');
		$this->db->join('merk','merk.merk_id=obat.id_merk','left');
		$this->db->join('satuan','satuan.satuan_id=obat.id_satuan','left');
		$this->db->join('supplier','supplier.supplier_id=obat.id_supplier','left');
		$this->db->order_by('obat.nama_obat', 'asc');
		return $this->db->get()->result();
	}
	function get($table){
		return $this->db->get($table)->result();
	}
	function get_spesific($table,$arr){
		return $this->db->get_where($table,$arr)->row();
	}
	function insert($table,$data){
		return $this->db->insert($table,$data);
	}
	function update($table,$data,$id){
		$this->db->where('id_obat',$id);
		return $this->db->update($table,$data);
	}
	function hapus($table,$id){
		$this->db->where('id_obat',$id);
		return $this->db->delete($table);
	}
	
	function get_kategori()
	{
		$this->db->select('*')
		->from('kategori')
		->order_by('nama_kategori', 'asc');
	
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
	
	function get_merk()
	{
		$this->db->select('*')
		->from('merk')
		->order_by('merk_nama', 'asc');
	
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
	
	function get_satuan()
	{
		$this->db->select('*')
		->from('satuan')
		->order_by('satuan_nama', 'asc');
	
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
	
	function get_supplier()
	{
		$this->db->select('*')
		->from('supplier')
		->order_by('nama_supplier', 'asc');
	
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
