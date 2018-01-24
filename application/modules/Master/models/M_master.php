<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_master extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function get_pasien_rj(){
		$now= date('Y-m-d');
		$this->db->from('registrasi_pasien');
		$this->db->where('jenis_rawat', 'RAWAT JALAN');
		$this->db->where('tgl_registrasi',$now);
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_pasien_ri(){
		$now= date('Y-m-d');
		$this->db->from('registrasi_pasien');
		$this->db->where('jenis_rawat', 'RAWAT INAP');
		$this->db->where('tgl_registrasi',$now);
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_pasien_umum(){
		$now= date('Y-m-d');
		$this->db->from('registrasi_pasien');
		$this->db->where('jenis_pembayaran', 'UMUM');
		$this->db->where('tgl_registrasi',$now);
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_pasien_bpjs(){
		$now= date('Y-m-d');
		$this->db->from('registrasi_pasien');
		$this->db->where('jenis_pembayaran', 'BPJS');
		$this->db->where('tgl_registrasi',$now);
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_patient_registered(){
			$now= date('Y-m-d');
			$this->db->select('*');
			$this->db->from('registrasi_pasien');
			$this->db->where('tgl_registrasi',$now);
			$this->db->join('pasien','pasien.id_pasien = registrasi_pasien.id_pasien');
			$this->db->order_by('registrasi_pasien.created_date','desc');
			$this->db->limit(10);
			$query = $this->db->get();
			return $query->result();
		}
}