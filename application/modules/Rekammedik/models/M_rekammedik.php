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
    function get_diagnosa_by_pasien_id($id_pasien){
      $this->db->from('pemeriksaan')
                ->where('pemeriksaan.id_pasien',$id_pasien)
                ->join('dokter','pemeriksaan.id_dokter=dokter.id_dokter')
                ->join('pasien','pemeriksaan.id_pasien=pasien.id_pasien');
      return $this->db->get()->result();
    }
    function get_layanan_by_pasien_id($id_pasien){
      $this->db->from('pemeriksaan_tindakan')
                ->where('pemeriksaan_tindakan.id_pasien',$id_pasien)
                ->join('layanan','pemeriksaan_tindakan.id_layanan=layanan.id_layanan')
                ->join('pasien','pemeriksaan_tindakan.id_pasien=pasien.id_pasien');
      return $this->db->get()->result();
    }
    function get_resep_by_pasien_id($id_pasien){
      $this->db->from('pemeriksaan_resep')
                ->where('pemeriksaan_resep.id_pasien',$id_pasien)
                ->join('obat','pemeriksaan_resep.id_obat=obat.id_obat')
                ->join('pasien','pemeriksaan_resep.id_pasien=pasien.id_pasien');
      return $this->db->get()->result();
    }
  }
 ?>
