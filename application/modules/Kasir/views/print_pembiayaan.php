<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$menusid = $this->M_crud->get_by_param("menu", 'name', "Kasir");
if(!empty($menusid)){
	$akses = $this->M_crud->get_select_to_row('hak_akses_create, hak_akses_update, hak_akses_delete', 'hak_akses', null, null, 'hak_akses_role', $this->session->userdata['simklinik']['ap_role'], 'hak_akses_menu', $menusid->id_menu);
	if(count($akses) == 0)
	{
		$mnCreate = 0;
		$mnUpdate = 0;
		$mnDelete = 0;
	}else{
		$mnCreate = $akses->hak_akses_create;
		$mnUpdate = $akses->hak_akses_update;
		$mnDelete = $akses->hak_akses_delete;
	}
}else{
	$mnCreate = 0;
	$mnUpdate = 0;
	$mnDelete = 0;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('template/v_header'); ?>
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/paper.css');?>"> -->
    <style>
    /*@page { size: 58mm 100mm } /* output size */
    /*body.receipt .sheet { width: 58mm; height: 100mm } /* sheet size */
    /* @media print { body.receipt { width: 58mm } } fix for Chrome */
  </style>
    </head>
    <!-- <body class="receipt">
    <section class="sheet padding-10mm"> -->
    <body>
    <!-- <section> -->
    <div class="wrapper">
      <section class="invoice">
				<?php
					$now = date('D');
					$hari = array(
						'Sun'=>'Minggu',
						'Mon' => 'Senin',
						'Tue' => 'Selasa',
						'Wed' => 'Rabu',
						'Thu' => 'Kamis',
						'Fri' => "Jum'at",
						'Sat' => 'Sabtu'
					);
					$bulan = array(
						'01' => 'Januari',
						'02' => 'Februari',
						'03' => 'Maret',
						'04' => 'April',
						'05' => 'Mei',
						'06' => 'Juni',
						'07' => 'Juli',
						'08' => 'Agustus',
						'09' => 'September',
						'10' => 'Oktober',
						'11' => 'November',
						'12' => 'Desember',
						);
					?>
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> JASA PRIMA KLINIK
              <small class="pull-right">Waktu Cetak: <?= date('d').' '.$bulan[date('m')].' '.date('Y').' - '.date('H:i:s');?></small>
            </h2>
          </div>
      
        </div>
        <div class="row invoice-info" >
          <div class="col-xs-12">
            <dl class="dl-horizontal">
							<dt>
								No. Nota :
							</dt>
							<dd>
								<?= $detail_pemasukan->no_kuitansi;?>
							</dd>
							<dt>
								Nama Pasien :
							</dt>
							<dd>
								<?= $pasien->nama_pasien;?>
							</dd>
							<dt>
								Waktu Daftar :
							</dt>
							<dd>
                <?php
                  $tgl = date('d-M-Y',strtotime($pasien->tgl_registrasi));
                  echo $tgl.' '.$pasien->jam_registrasi;
                  ?>
							</dd>
						</dl>
          </div>
      
        </div>
        <div class="row">
          <div class="col-xs-12 table-responsive">
          <table class="table table-striped tableData table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Item</th>
                        <th>Tarif / Harga</th>
                        <th>Qty</th>
                        <th>Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($detail_berobat as $key => $row):?>
                        <?php
                          $harga = $this->M_base->currformat2($row->harga);
                          $harga = substr($harga,0,-3);
                          $total = $this->M_base->currformat2($row->total_harga);
                          $total = substr($total,0,-3);
                        ?>
                        <tr>
                          <td><?= ++$key;?></td>
                          <td><?= $row->nama_item;?></td>
                          <td><?= $harga;?></td>
                          <td><?= intval($row->qty);?></td>
                          <td><?= $total;?></td>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6 pull-right">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>Rp. <?=	substr($this->M_base->currFormat2($detail_pemasukan->total_pemasukan), 0, -3);?></td>
                </tr>
                <tr>
                  <th>Uang Bayar</th>
                  <td>Rp. <?=	substr($this->M_base->currFormat2($detail_pemasukan->uang_bayar), 0, -3);?></td>
                </tr>
                <tr>
                  <th>Uang Kembali</th>
                  <td>Rp. <?=	substr($this->M_base->currFormat2($detail_pemasukan->uang_kembalian), 0, -3);?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
     </section>
    </div>
    <!-- </section> -->
    </body>
		<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>
</html>
