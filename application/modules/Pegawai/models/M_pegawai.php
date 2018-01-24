<?php
	class M_pegawai extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function getPegawai(){
			$this->db->select('*');
			$this->db->from('pegawai');
			$this->db->join('jabatan','jabatan.id_jabatan=pegawai.id_jabatan');
			$this->db->order_by('nip','asc');
			return $this->db->get()->result_array();
		}
		function simpanPegawai(){
			$tgl = str_replace('/','-',$this->input->post('mulai_bekerja'));
			$m_kerja= date('Y-m-d',strtotime($tgl));
			$lahir = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($lahir));
			
			$this->db->select('nip')
			->from('pegawai')
			->order_by('nip','desc')
			->limit(1);
			$get_nip=$this->db->get()->result();
			
			$nip = "";
			if(empty($get_nip)){
				$nip = "00000001";
			}
			else{
				$start = substr($get_nip[0]->nip, 0-8);
				$next = ++$start;
				if ($next < 10){ $nip = "0000000".$next;}
				elseif ($next < 100 && $next > 9) { $nip = "000000".$next;}
				elseif ($next < 1000 && $next > 99) { $nip = "00000".$next;}
				elseif ($next < 10000 && $next > 999) { $nip = "0000".$next;}
				elseif ($next < 100000 && $next > 9999) { $nip = "000".$next;}
				elseif ($next < 1000000 && $next > 99999) { $nip = "00".$next;}
			}
			
			$data=array(
				'nip'=>$nip,
				'nama'=>$this->input->post('nama'),
				'nik'=>$this->input->post('nik'),
				'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
				'tempat_lahir'=>$this->input->post('tempat_lahir'),
				'tgl_lahir'=>$tgl_lahir,
				'status_perkawinan'=>$this->input->post('status_perkawinan'),
				'agama'=>$this->input->post('agama'),
				'alamat'=>$this->input->post('alamat'),
				'no_hp'=>$this->input->post('no_hp'),
				'id_jabatan'=>$this->input->post('id_jabatan'),
				'mulai_bekerja'=>$m_kerja,
				'status'=>$this->input->post('status'),
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			return $this->db->insert('pegawai',$data);
		}
		function hapusPegawai($id){
			$this->db->where('id_pegawai',$id);
			$this->db->delete('pegawai');
		}
		function editPegawai($id){
			$query = $this->db->get_where('pegawai',array('id_pegawai'=>$id));
			return $query->row_array();
		}
		function updatePegawai($id){
			$tgl = str_replace('/','-',$this->input->post('mulai_bekerja'));
			$m_kerja= date('Y-m-d',strtotime($tgl));
			$lahir = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($lahir));
			$data=array(
				'nama'=>$this->input->post('nama'),
				'nik'=>$this->input->post('nik'),
				'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
				'tempat_lahir'=>$this->input->post('tempat_lahir'),
				'tgl_lahir'=>$tgl_lahir,
				'status_perkawinan'=>$this->input->post('status_perkawinan'),
				'agama'=>$this->input->post('agama'),
				'alamat'=>$this->input->post('alamat'),
				'no_hp'=>$this->input->post('no_hp'),
				'id_jabatan'=>$this->input->post('id_jabatan'),
				'mulai_bekerja'=>$m_kerja,
				'status'=>$this->input->post('status'),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->where('id_pegawai',$id);
			return $this->db->update('pegawai',$data);
		}
		function getJabatan(){
			$query = $this->db->get('jabatan');
			return $query->result_array();
		}
	}