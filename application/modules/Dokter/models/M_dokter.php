<?php
	class M_dokter extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function getDokter(){
			$query =$this->db->get('dokter');
			return $query->result_array();
		}
		function simpanDokter(){
			$tgl = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($tgl));
			$data=array(
				'kd_dokter'=>$this->input->post('kode_dokter'),
				'no_izin_praktek'=>$this->input->post('no_izin_praktek'),
				'nama_dokter'=>$this->input->post('nama'),
				'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
				'tmp_lahir'=>$this->input->post('tempat_lahir'),
				'tgl_lahir'=>$tgl_lahir,
				// 'gol_darah'=>$this->input->post('gol_darah'),
				'agama'=>$this->input->post('agama'),
				'alamat'=>$this->input->post('alamat'),
				'telepon'=>$this->input->post('no_hp'),
				'status_nikah'=>$this->input->post('status_perkawinan'),
				// 'alumni'=>$this->input->post('alumni'),
				'status'=>$this->input->post('status'),
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			return $this->db->insert('dokter',$data);
		}
		function editDokter($id){
			$query = $this->db->get_where('dokter',array('id_dokter'=>$id));
			return $query->row_array();
		}
		function updateDokter($id){
			$tgl = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($tgl));
			$data=array(
				'kd_dokter'=>$this->input->post('kode_dokter'),
				'no_izin_praktek'=>$this->input->post('no_izin_praktek'),
				'nama_dokter'=>$this->input->post('nama'),
				'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
				'tmp_lahir'=>$this->input->post('tempat_lahir'),
				'tgl_lahir'=>$tgl_lahir,
				// 'gol_darah'=>$this->input->post('gol_darah'),
				'agama'=>$this->input->post('agama'),
				'alamat'=>$this->input->post('alamat'),
				'telepon'=>$this->input->post('no_hp'),
				'status_nikah'=>$this->input->post('status_perkawinan'),
				// 'alumni'=>$this->input->post('alumni'),
				'status'=>$this->input->post('status'),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->where('id_dokter',$id);
			return $this->db->update('dokter',$data);
		}
		function hapusDokter($id){
			$this->db->where('id_dokter',$id);
			$this->db->delete('dokter');
		}
	}