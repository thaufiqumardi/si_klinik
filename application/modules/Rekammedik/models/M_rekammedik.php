<?php
  /**
   *
   */
  class M_rekammedik extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    function getKala2Joined($id_pasien){
  		$this->db->select('*')
  							->from('rm_kala2')
  							->join('rm_persalinan','rm_kala2.id_pasien=rm_persalinan.id_pasien')
  							->where('rm_kala2.id_pasien',$id_pasien);
  		return $this->db->get()->result();
  	}
    function getPasien(){
  		$this->db->order_by('no_rm', 'asc');
  		$query = $this->db->get('pasien');
  		return $query->result_array();
  	}
  }
 ?>
