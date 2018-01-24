<?php
	class M_antrian extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function getAntrianBelumTerlayani(){
			$now = date('Y-m-d');
			$this->db->select('*')
								->from('registrasi_pasien')
								->where('tgl_registrasi',$now)
								->where('status_antrian','0')
								->limit(10);
			return $this->db->get()->result();
		}
		function getAntrianTampil(){
			$now = date('Y-m-d');
			$this->db->select('*')
			->from('registrasi_pasien')
			->where('tgl_registrasi',$now)
			->where('status_antrian','1')
			->where('jenis_rawat','RAWAT JALAN')
			->order_by('no_antrian','desc')
			->limit(1);
			return $this->db->get()->result();
		}
		function getAllAntrianToday(){
			$now = date('Y-m-d');
			$this->db->select('*')
								->from('registrasi_pasien')
								->where('tgl_registrasi',$now)
								->join('pasien','pasien.id_pasien = registrasi_pasien.id_pasien')
								->order_by('no_antrian','asc')
								->limit(10);
			return $this->db->get()->result();
		}
		function getAntrianTerlayani(){
			$now = date('Y-m-d');
			$this->db->select('*')
								->from('registrasi_pasien')
								->where('tgl_registrasi',$now)
								->where('status_antrian','1')
								->join('pasien','pasien.id_pasien = registrasi_pasien.id_pasien')
								->order_by('no_antrian','asc')
								->limit(10);
			return $this->db->get()->result();
		}
		function getMin(){
			$this->db->select_min('no_antrian');
			return $this->db->get('registrasi_pasien')->result_array();
		}
		function getCountAntrian(){
			$now = date('Y-m-d');
			$this->db->select('*')
			->from('registrasi_pasien')
			->where('tgl_registrasi',$now)
			->where('status_antrian','1')
			->where('play_sound','0');
			$query = $this->db->get();
			$num_rows = $query->num_rows();
			return $num_rows;
		}
		function update($id,$data,$trig,$table)
		{
			$this->db->where($trig,$id);
			$this->db->update($table,$data);
		}
	}
