<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pemeriksaan extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function getRegistrasiJoined($no_registrasi){
		$this->db->select('*, pasien.jenis_kelamin AS jenis_kelamin_pasien, pasien.tgl_lahir AS tgl_lahir_pasien, pasien.gol_darah AS gol_darah_pasien')
							->from('registrasi_pasien')
							->join('pasien','registrasi_pasien.id_pasien=pasien.id_pasien','left')
							->join('dokter','registrasi_pasien.id_dokter=dokter.id_dokter','left')
							->where('no_registrasi',$no_registrasi);
		return $this->db->get()->row();
	}
	function getRegisteredPasien(){
		$this->db->select('*')
					->from('registrasi_pasien')
					->join('pasien','registrasi_pasien.id_pasien=pasien.id_pasien');
		return $this->db->get()->result();
	}
}
