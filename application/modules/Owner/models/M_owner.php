<?php
	class M_owner extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function getOwner(){
			$query = $this->db->get('owner');
			return $query->result();
		}
		function editOwner($id){
			$query = $this->db->get_where('owner',array('owner_id'=>$id));
			return $query->row_array();
		}
		function updateOwner($id,$url){
			$data= array(
				'nama_owner'=>$this->input->post('nama_owner'),
				'alamat_owner'=>$this->input->post('alamat_owner'),
				'logo_owner'=>$url,
				'no_telpon_owner'=>$this->input->post('no_telpon_owner'),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->where('owner_id',$id);
			$this->db->update('owner',$data);
		}
		function tambahOwner($url){
			$data= array(
				'nama_owner'=>$this->input->post('nama_owner'),
				'alamat_owner'=>$this->input->post('alamat_owner'),
				'no_telpon_owner'=>$this->input->post('no_telpon_owner'),
				'logo_owner'=>$url
			);
			return $this->db->insert('owner',$data);
		}
		function hapusOwner($id){
			$this->db->where('owner_id',$id);
			$this->db->delete('owner');
		}
	}