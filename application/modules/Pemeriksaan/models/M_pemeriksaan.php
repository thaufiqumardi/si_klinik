<?php
  /**
   *
   */
  class M_pemeriksaan extends CI_Model
  {

    function __construct(){
      $this->load->database();
    }
    function validate_double($table,$param,$where,$param1=NULL,$where1=NULL,$param2=NULL, $where2=NULL){
      $this->db->where($param,$where);
      if(!empty($param1)){
        $this->db->where($param1,$where1);
      }
      if(!empty($param2)){
        $this->db->where($param2,$where2);
      }
      $rows = $this->db->get($table)->num_rows();
      return $rows;
    }
	function getPasienPeriksa(){
			$now= date('Y-m-d');
			$this->db->select('*');
			$this->db->from('registrasi_pasien');
			$this->db->where('tgl_registrasi',$now);
			$this->db->where('status_antrian',1);
			$this->db->where('status_bayar',0);
			$this->db->join('dokter','dokter.id_dokter = registrasi_pasien.id_dokter');
			$this->db->join('pasien','pasien.id_pasien = registrasi_pasien.id_pasien');
			$this->db->order_by('no_antrian','desc');
			$query = $this->db->get();
			return $query->result();
		}
    function get_pm($table,$field,$param,$ordering,$join=NULL,$join_where=NULL){
      $this->db->from($table);
      $this->db->where($field,$param);
      if(!empty($join)){
        $this->db->join($join,$join_where);
      }
      $this->db->order_by($ordering,"DESC");
      return $this->db->get()->result();
    }
    function get_pasien_by_registrasi($no_regis){
      $this->db->from('registrasi_pasien')
                ->where('registrasi_pasien.no_registrasi',$no_regis)
                ->join('pasien','pasien.id_pasien=registrasi_pasien.id_pasien')
                ->join('dokter','registrasi_pasien.id_dokter=dokter.id_dokter');
      return $this->db->get()->row();
    }
    function get_diagnosa_by_pasien_id($id_registrasi){
      $this->db->from('pemeriksaan')
                ->where('pemeriksaan.id_registrasi',$id_registrasi)
                ->join('dokter','pemeriksaan.id_dokter=dokter.id_dokter')
                ->join('pasien','pemeriksaan.id_pasien=pasien.id_pasien');
      return $this->db->get()->result();
    }
  }

?>
