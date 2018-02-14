<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kasir extends CI_Model
{

	function __construct()
    {
      parent::__construct();
    }

    function get_no_registrasi()
    {
    	$this->db->select('A.no_registrasi, B.no_antrian')
    	->from('detail_pembiayaan A')
    	->join('registrasi_pasien B','A.no_registrasi = B.no_registrasi','left')
    	->where('A.status_bayar', '0')
    	->group_by('A.no_registrasi');

    	$get = $this->db->get();

    	if($get->num_rows() > 0)
    	{
    		return $get->result();
    	}
    	else
    	{
    		return 0;
    	}
    }

    function getRegistrasiJoined($no_registrasi){
    	$this->db->select('*, pasien.jenis_kelamin AS jenis_kelamin_pasien, pasien.tgl_lahir AS tgl_lahir_pasien')
    	->from('registrasi_pasien')
    	->join('pasien','registrasi_pasien.id_pasien=pasien.id_pasien','left')
    	->join('dokter','registrasi_pasien.id_dokter=dokter.id_dokter','left')
    	->where('no_registrasi',$no_registrasi);
    	return $this->db->get()->row();
    }

    function create($data,$table)
    {
    	$this->db->insert($table,$data);
    }

    function update($id,$data,$trig,$table)
    {
    	$this->db->where($trig,$id);
    	$this->db->update($table,$data);
    }

    function update2($param1,$where1,$param2,$where2,$data,$table)
    {
    	$this->db->where($param1,$where1);
    	$this->db->where($param2,$where2);
    	$this->db->update($table,$data);
    }

    function get_detail($id_registrasi)
    {
    	$this->db->select('*')
    	->from('detail_pembiayaan')
    	->where('id_registrasi', $id_registrasi)
    	->where('status_bayar', '0');
    	return $this->db->get()->result();
    }

    function get_pembiayaan($id_registrasi)
    {
    	$this->db->select('*')
    	->from('detail_pembiayaan')
    	->where('id_registrasi', $id_registrasi);

    	$get = $this->db->get();

    	if($get->num_rows() > 0)
    	{
    		return $get->result();
    	}
    	else
    	{
    		return 0;
    	}
    }
		function get_pembiayaan_obat($id_registrasi){
			$this->db->from('detail_pembiayaan')
								->where('jenis_item','Obat')
								->where('id_registrasi',$id_registrasi);
			return $this->db->get()->result();
		}
    function get_piutang($no_registrasi)
    {
    	$this->db->select('*')
    	->from('piutang')
    	->where('no_registrasi', $no_registrasi);

    	$get = $this->db->get();

    	if($get->num_rows() > 0)
    	{
    		return $get->result();
    	}
    	else
    	{
    		return 0;
    	}
    }

    function get_head_transaksi($no_kuitansi)
    {
    	$this->db->select('A.*, C.*')
    	->from('pasien A')
    	->join('registrasi_pasien B','A.id_pasien = B.id_pasien','left')
    	->join('pemasukan C','B.no_registrasi = C.no_registrasi','left')
    	->where('C.no_kuitansi', $no_kuitansi)
    	->group_by('C.no_kuitansi');

    	$get = $this->db->get();

    	if($get->num_rows() > 0)
    	{
    		return $get->result();
    	}
    	else
    	{
    		return 0;
    	}
    }

    function get_detail_transaksi($no_kuitansi){
    	$this->db->select('*')
    	->from('transaksi_kasir')
    	->where('no_kuitansi',$no_kuitansi);
    	$query = $this->db->get();
    	return $query->result();
    }

    function get_nomor_kuitansi()
    {
    	$this->db->select('no_kuitansi')
    	->from('pemasukan')
    	->order_by('no_kuitansi','desc')
    	->limit(1);

    	$no_kuitansi=$this->db->get()->result();

    	if(empty($no_kuitansi)){
    		$no_kuitansi = "00000001";
    	}
    	else{
    		$start = substr($no_kuitansi[0]->no_kuitansi, 0-8);
    		$next = ++$start;
    		if ($next < 10){ $no_kuitansi = "0000000".$next;}
    		elseif ($next < 100 && $next > 9) { $no_kuitansi = "000000".$next;}
    		elseif ($next < 1000 && $next > 99) { $no_kuitansi = "00000".$next;}
    		elseif ($next < 10000 && $next > 999) { $no_kuitansi = "0000".$next;}
    		elseif ($next < 100000 && $next > 9999) { $no_kuitansi = "000".$next;}
    		elseif ($next < 1000000 && $next > 99999) { $no_kuitansi = "00".$next;}
    	}

    	return $no_kuitansi;
    }

		function getObatByKodeObat($kode_obat){
			$this->db->from('obat')
								->join('satuan','obat.id_satuan=satuan.satuan_id')
								->join('harga_obat','obat.id_obat=harga_obat.id_obat')
								->where('kode_obat',$kode_obat);
			return $this->db->get()->row();
		}
		function getTransaksiObatNow($no_kuitansi){
			$this->db->from('transaksi_kasir')
								->join('obat','obat.id_obat=transaksi_kasir.id_barang')
								->where('no_kuitansi',$no_kuitansi);
			return $this->db->get()->result();
		}
		function get_pasien_by_registrasi($id_registrasi){
			$this->db->from('registrasi_pasien')
                ->where('registrasi_pasien.id_registrasi',$id_registrasi)
                ->join('pasien','pasien.id_pasien=registrasi_pasien.id_pasien')
                ->join('dokter','registrasi_pasien.id_dokter=dokter.id_dokter');
      return $this->db->get()->row();
		}
		function get_belum_bayar(){
			$this->db->from('registrasi_pasien')
								->where('status_bayar',0)
								->join('pasien','pasien.id_pasien=registrasi_pasien.id_pasien')
								->join('dokter','registrasi_pasien.id_dokter=dokter.id_dokter');
			return $this->db->get()->result();
		}
}
