<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_keuangan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
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
	
	function get_pengeluaran()
	{
		$this->db->select('*')
		->from('pengeluaran')
		->order_by('no_pengeluaran','asc');
			
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
	
	function edit_pengeluaran($id)
	{
		$this->db->select('*')
		->where('pengeluaran_id',$id)
		->from('pengeluaran');
			
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
	
	function get_lappengeluaran($ta, $tk){
		$this->db->select("* from pengeluaran where (tgl_pengeluaran BETWEEN '".$ta."' AND '".$tk."') order by no_pengeluaran asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_lappendapatan($ta, $tk){
		$this->db->select("* from pemasukan where (tgl_pemasukan BETWEEN '".$ta."' AND '".$tk."') order by no_registrasi asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_lappembpasien($ta, $tk){
		$this->db->select("* from detail_pembiayaan where (tgl_registrasi BETWEEN '".$ta."' AND '".$tk."') order by no_registrasi asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_lappiutang($ta, $tk){
		$this->db->select("* from piutang where (tgl_registrasi BETWEEN '".$ta."' AND '".$tk."') AND status=0 order by no_registrasi asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function select_labarugi_pendapatan($bulan, $tahun){
		$this->db->select("SUM(total_pemasukan) as GrandTotal
							from pemasukan
							where YEAR(tgl_pemasukan) = '".$tahun."' AND MONTH(tgl_pemasukan) = '".$bulan."' ");
		$query = $this->db->get();
		return $query->result();
	}
	
	function select_labarugi_pengeluaran($bulan, $tahun){
		$this->db->select("SUM(total_pengeluaran) as GrandTotal
							from pengeluaran
							where YEAR(tgl_pengeluaran) = '".$tahun."' AND MONTH(tgl_pengeluaran) = '".$bulan."' ");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_jurnalpendapatan($bulan, $tahun){
		$this->db->select("* from pemasukan where YEAR(tgl_pemasukan) = '".$tahun."' AND MONTH(tgl_pemasukan) = '".$bulan."'
							 order by no_registrasi asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_jurnalpengeluaran($bulan, $tahun){
		$this->db->select("* from pengeluaran where YEAR(tgl_pengeluaran) = '".$tahun."' AND MONTH(tgl_pengeluaran) = '".$bulan."'
							order by no_pengeluaran asc");
		$query = $this->db->get();
		return $query->result();
	}
	
}