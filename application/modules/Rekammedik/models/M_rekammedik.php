<?php
  /**
   *
   */
  class M_rekammedik extends CI_Model
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
    function get_pasien_by_id($id_pasien){
      $this->db->from('pasien')
                ->join('registrasi_pasien','pasien.id_pasien=registrasi_pasien.id_pasien')
                ->join('dokter','registrasi_pasien.id_dokter=dokter.id_dokter')
                ->where('pasien.id_pasien',$id_pasien);
      return $this->db->get()->row();
    }
  }

?>
