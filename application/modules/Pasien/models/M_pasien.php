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
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->insert('pasien',$data);
			$id_pasien= $this->db->insert_id();
			$pasien_terdaftar = $this->db->get_where('pasien',array('id_pasien'=>$id_pasien))->row();
			return $pasien_terdaftar;
		}
		function editPasien($id){
			$query = $this->db->get_where('pasien',array('id_pasien'=>$id));
			return $query->row_array();
		}
		function updatePasien($id_pasien){
			$this->updatePenanggung($id_pasien);
			$tgl = str_replace('/','-',$this->input->post('tgl_lahir'));
			$updated_pasien= date('Y-m-d',strtotime($tgl));
			$data=array(
				'nama_pasien'=>$this->input->post('nama_pasien'),
				'nik_pasien'=>$this->input->post('nik_pasien'),
				'tempat_lahir'=>$this->input->post('tempat_lahir'),
				'tgl_lahir'=>$updated_pasien,
				'agama'=>$this->input->post('agama'),
				'pendidikan_pasien'=>$this->input->post('pendidikan_pasien'),
				'pekerjaan_pasien'=>$this->input->post('pekerjaan_pasien'),
				'warga_negara'=>$this->input->post('warga_negara'),
				'gol_darah'=>$this->input->post('gol_darah'),
				'status_perkawinan'=>$this->input->post('status_perkawinan'),
				'no_telp_rumah'=>$this->input->post('no_telp_rumah'),
				'no_handphone'=>$this->input->post('no_handphone'),
				'email'=>$this->input->post('email'),
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
		function insertDetailPembiayaanLayanan($id_regis, $no_regis, $tgl_registrasi){
			$layanan = $this->input->post('layanan');
			$sum_layanan = count($layanan);
			$total = 0;
			for($i =0; $i < $sum_layanan; $i++){
				$select_layanan = $this->M_crud->check_table('layanan','id_layanan',$layanan[$i]);
				$qty = 1;
				$harga = $select_layanan->tarif;
				$total_harga = $harga * $qty;
				$total = $total + $total_harga;
				$layanan_terpilih[] = array(
					'id_registrasi'=>$id_regis,
					'item_id'=>$select_layanan->id_layanan,
					'nama_item'=>$select_layanan->nama,
					'harga'=>$harga,
					'jenis_item'=>"Layanan",
					'qty'=>$qty,
					'total_harga'=>$total_harga,
					'no_registrasi'=>$no_regis,
					'tgl_registrasi'=>$tgl_registrasi,
					'created_by' => $this->session->userdata['simklinik']['ap_sid'],
					// 'nama_item'=>
				);
			}
			$jumlah_layanan = count($layanan_terpilih);
			for($i=0; $i<$jumlah_layanan;$i++){
				$this->db->insert('detail_pembiayaan',$layanan_terpilih[$i]);
			}

			$id_pasien = $this->input->post('id_pasien');
			$get_pasien = $this->M_crud->check_table('pasien','id_pasien',$id_pasien);
			$no_rm = $get_pasien->no_rm;
			$nama_pasien = $get_pasien->nama_pasien;
			$status_pasien = $get_pasien->status_pasien;
			$biaya_pendaftaran = 0;
			$jenis_pendaftaran = "";

			if($status_pasien == "BARU"){
				$biaya_pendaftaran = 15000;
				$jenis_pendaftaran = "Biaya Pendaftaran Pasien Baru";
				$data=array(
						'status_pasien'=>'LAMA',
						'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
				);
				$this->db->where('id_pasien',$id_pasien);
				$this->db->update('pasien',$data);
			}else{
				$biaya_pendaftaran = 10000;
				$jenis_pendaftaran = "Biaya Pendaftaran Pasien Lama";
			}

			$data_pendaftaran = array(
					'id_registrasi'=>$id_regis,
					'item_id'=>0,
					'nama_item'=>$jenis_pendaftaran,
					'harga'=>$biaya_pendaftaran,
					'jenis_item'=>"Pendaftaran",
					'qty'=>1,
					'total_harga'=>$biaya_pendaftaran,
					'no_registrasi'=>$no_regis,
					'tgl_registrasi'=>$tgl_registrasi,
					'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->insert('detail_pembiayaan',$data_pendaftaran);

			$total = $total + $biaya_pendaftaran;

			$data_piutang = array(
					'no_registrasi'=>$no_regis,
					'tgl_registrasi'=>$tgl_registrasi,
					'no_rm'=>$no_rm,
					'nama_pasien'=>$nama_pasien,
					'total_biaya'=>$total,
					'total_bayar'=>0,
					'sisa_bayar'=>$total,
					'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->insert('piutang',$data_piutang);
		}
		function insertDetailPembiayaanPaket($id_regis, $no_regis, $tgl_registrasi){
			$paket=$this->M_crud->check_table('paket_layanan','paket_layanan_id',$this->input->post('id_paket'));
			$qty = 1;
			$harga = $paket->total_harga;
			$total_harga = $harga * $qty;
			$data = array(
				'id_registrasi'=>$id_regis,
				'nama_item'=>$paket->nama_paket_layanan,
				'item_id'=>$paket->paket_layanan_id,
				'jenis_item'=>"Paket",
				'harga'=>$harga,
				'qty'=>$qty,
				'total_harga'=>$total_harga,
				'no_registrasi'=>$no_regis,
				'tgl_registrasi'=>$tgl_registrasi,
				'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->insert('detail_pembiayaan',$data);

			$id_pasien = $this->input->post('id_pasien');
			$get_pasien = $this->M_crud->check_table('pasien','id_pasien',$id_pasien);
			$no_rm = $get_pasien->no_rm;
			$nama_pasien = $get_pasien->nama_pasien;
			$status_pasien = $get_pasien->status_pasien;
			$biaya_pendaftaran = 0;
			$jenis_pendaftaran = "";

			if($status_pasien == "BARU"){
				$biaya_pendaftaran = 15000;
				$jenis_pendaftaran = "Biaya Pendaftaran Pasien Baru";
				$data=array(
						'status_pasien'=>'LAMA',
						'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
				);
				$this->db->where('id_pasien',$id_pasien);
				$this->db->update('pasien',$data);
			}else{
				$biaya_pendaftaran = 10000;
				$jenis_pendaftaran = "Biaya Pendaftaran Pasien Lama";
			}

			$data_pendaftaran = array(
					'id_registrasi'=>$id_regis,
					'item_id'=>0,
					'nama_item'=>$jenis_pendaftaran,
					'harga'=>$biaya_pendaftaran,
					'jenis_item'=>"Pendaftaran",
					'qty'=>1,
					'total_harga'=>$biaya_pendaftaran,
					'no_registrasi'=>$no_regis,
					'tgl_registrasi'=>$tgl_registrasi,
					'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->insert('detail_pembiayaan',$data_pendaftaran);

			$total_harga = $total_harga + $biaya_pendaftaran;

			$data_piutang = array(
					'no_registrasi'=>$no_regis,
					'tgl_registrasi'=>$tgl_registrasi,
					'no_rm'=>$no_rm,
					'nama_pasien'=>$nama_pasien,
					'total_biaya'=>$total_harga,
					'total_bayar'=>0,
					'sisa_bayar'=>$total_harga,
					'created_by' => $this->session->userdata['simklinik']['ap_sid'],
			);
			$this->db->insert('piutang',$data_piutang);
		}
		function getRegistered(){
			$now= date('Y-m-d');
			$this->db->select('*');
			$this->db->from('registrasi_pasien');
			$this->db->where('tgl_registrasi',$now);
			$this->db->join('pasien','pasien.id_pasien = registrasi_pasien.id_pasien');

			$query = $this->db->get();
			return $query->result_array();
		}
		function getRegistered1(){
			$now= date('Y-m-d');
			$this->db->select('*');
			$this->db->from('registrasi_pasien');
			$this->db->join('dokter','dokter.id_dokter = registrasi_pasien.id_dokter');
			$this->db->where('tgl_registrasi',$now);
			$this->db->where('status_antrian',1);
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
