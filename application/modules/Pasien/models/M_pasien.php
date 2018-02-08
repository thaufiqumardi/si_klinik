<?php
	class M_pasien extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function getPasien(){
			$this->db->order_by('no_rm', 'asc');
			$query = $this->db->get('pasien');
			return $query->result_array();
		}
		function getPasienExport(){
			$this->db->order_by('no_rm', 'asc');
			$query = $this->db->get('pasien');
			return $query->result();
		}
		function simpanPasien(){
			$tgl = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($tgl));
			$this->db->select('no_kartu')
				->from('pasien')
				->order_by('no_kartu','desc')
				->limit(1);
				$no_kartu=$this->db->get()->result();
				if(empty($no_kartu)){
					$no_kartu = "00000001";
				}
				else{
					$start = substr($no_kartu[0]->no_kartu, 0-8);
					$next = ++$start;
					if ($next < 10){ $no_kartu = "0000000".$next;}
					elseif ($next < 100 && $next > 9) { $no_kartu = "000000".$next;}
					elseif ($next < 1000 && $next > 99) { $no_kartu = "00000".$next;}
					elseif ($next < 10000 && $next > 999) { $no_kartu = "0000".$next;}
					elseif ($next < 100000 && $next > 9999) { $no_kartu = "000".$next;}
					elseif ($next < 1000000 && $next > 99999) { $no_kartu = "00".$next;}
				}
				$thn = date('y');
			$this->db->select('no_rm')
					->from('pasien')
					->where('no_rm like',$thn.'%')
					->order_by('no_rm','desc')
					->limit(1);
					$no_rm = $this->db->get()->result();
			if(empty($no_rm)){
				$no_rm= $thn."000001";
			}
			else{
				$begin = substr($no_rm[0]->no_rm,2-8);
				$continue = ++$begin;
				if ($begin < 10){ $no_rm = $thn."00000".$begin;}
				elseif ($begin < 100 && $begin > 9) { $no_rm = $thn."0000".$begin;}
				elseif ($begin < 1000 && $begin > 99) { $no_rm = $thn."000".$begin;}
				elseif ($begin < 10000 && $begin > 999) { $no_rm = $thn."00".$begin;}
				elseif ($begin < 100000 && $begin > 9999) { $no_rm = $thn."0".$begin;}
				// elseif ($begin < 1000000 && $begin > 99999) { $no_rm = "00".$begin;}
			}
			$data=array(
				'no_kartu'=>$no_kartu,
				'no_rm'=>$no_rm,
				'nama_pasien'=>$this->input->post('nama_pasien'),
				'nik_pasien'=>$this->input->post('nik_pasien'),
				'tempat_lahir'=>$this->input->post('tempat_lahir'),
				'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
				'tgl_lahir'=>$tgl_lahir,
				'umur' => $this->input->post('umur'),
				'agama'=>$this->input->post('agama'),
				'pekerjaan_pasien'=>$this->input->post('pekerjaan_pasien'),
				'gol_darah'=>$this->input->post('gol_darah'),
				'no_telp_rumah'=>$this->input->post('no_telp_rumah'),
				'no_handphone'=>$this->input->post('no_handphone'),
				'jalan'=>$this->input->post('jalan'),
				'rtrw'=>$this->input->post('rtrw'),
				'kelurahan'=>$this->input->post('keldesa'),
				'kecamatan'=>$this->input->post('kecamatan'),
				'kota'=>$this->input->post('kota'),
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->insert('pasien',$data);
			$id_pasien= $this->db->insert_id();
			$pasien_terdaftar = $this->db->get_where('pasien',array('id_pasien'=>$id_pasien))->row();
			return $pasien_terdaftar;
		}
		function insert_detail_pembiayaan($data){
			$data_pendaftaran = array(

			);
		}
		function editPasien($id){
			$query = $this->db->get_where('pasien',array('id_pasien'=>$id));
			return $query->row_array();
		}
		function updatePasien($id_pasien){
			$tgl = str_replace('/','-',$this->input->post('tgl_lahir'));
			$tgl_lahir= date('Y-m-d',strtotime($tgl));
			$updated_pasien= date('Y-m-d',strtotime($tgl));
			$data=array(
				'nama_pasien'=>$this->input->post('nama_pasien'),
				'nik_pasien'=>$this->input->post('nik_pasien'),
				'tempat_lahir'=>$this->input->post('tempat_lahir'),
				'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
				'tgl_lahir'=>$tgl_lahir,
				'agama'=>$this->input->post('agama'),
				'pekerjaan_pasien'=>$this->input->post('pekerjaan_pasien'),
				'gol_darah'=>$this->input->post('gol_darah'),
				'no_telp_rumah'=>$this->input->post('no_telp_rumah'),
				'no_handphone'=>$this->input->post('no_handphone'),
				'jalan'=>$this->input->post('jalan'),
				'rtrw'=>$this->input->post('rtrw'),
				'kelurahan'=>$this->input->post('keldesa'),
				'kecamatan'=>$this->input->post('kecamatan'),
				'kota'=>$this->input->post('kota'),
				'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->where('id_pasien',$id_pasien);
			return $this->db->update('pasien',$data);

		}
		function hapusPasien($id){
			$this->db->where('id_pasien',$id);
			$this->db->delete('pasien');
		}
		function hapusAntrian($id){
			$this->db->where('id_registrasi',$id);
			return $this->db->delete('registrasi_pasien');
		}
		function getRegistered(){
			$now= date('Y-m-d');
			$this->db->select('*');
			$this->db->from('registrasi_pasien');
			$this->db->where('tgl_registrasi',$now);
			$this->db->join('dokter','dokter.id_dokter = registrasi_pasien.id_dokter');
			$this->db->join('pasien','pasien.id_pasien = registrasi_pasien.id_pasien');
			$this->db->order_by('no_antrian','desc');

			$query = $this->db->get();
			return $query->result();
		}
		function getRegistered1(){
			$now= date('Y-m-d');
			$this->db->select('*');
			$this->db->from('registrasi_pasien');
			$this->db->join('dokter','dokter.id_dokter = registrasi_pasien.id_dokter');
			// $this->db->where('tgl_registrasi',$now);
			// $this->db->where('status_antrian',1);
			$this->db->join('pasien','pasien.id_pasien = registrasi_pasien.id_pasien');
			return $this->db->get()->result();
		}
		function isRegistExist($data){
			$id=$data['id_pasien'];
			$now = date('Y-m-d');
			$query = $this->db->get_where('registrasi_pasien',array('id_pasien'=>$id,'tgl_registrasi'=>$now));
			// return $query->row();
			if($query->num_rows() > 0){
				return 0;
			}
			else{
				return 1;
			}
		}
		function getLast($select,$table,$where){
			$now = date('Y-m-d');
			$this->db->select($select)
							->from($table)
							->where($where, $now)
							->order_by($select,'desc')
							->limit(1);
			return $this->db->get()->row();
		}
	}
