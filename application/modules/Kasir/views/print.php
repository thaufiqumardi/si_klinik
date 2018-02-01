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
    </head>
    <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
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
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info" >
          <div class="col-sm-8">
            <dl class="dl-horizontal">
							<dt>
								No. Nota :
							</dt>
							<dd>
								<?= $detail_pemasukan->no_kuitansi;?>
							</dd>
							<dt>
								Pelanggan :
							</dt>
							<dd>
								Umum
							</dd>
							<dt>
								Keterangan :
							</dt>
							<dd>
								Pembelian Obat
							</dd>
						</dl>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
              <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
              </tr>
              </thead>
              <tbody>
								<?php foreach($transaksi as $trx):?>
									<tr>
										<td>
											<?= $trx->kode_obat;?>
										</td>
										<td>
											<?= $trx->nama_obat;?>
										</td>
										<td>
											<?= substr($this->M_base->currFormat2($trx->harga_barang),0,-3);?>
										</td>
										<td>
											<?= $trx->qty_barang;?>
										</td>
										<td>
											<?= substr($this->M_base->currFormat2($trx->total_harga),0,-3);?>
										</td>
									</tr>
								<?php endforeach;?>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    </body>
		<!-- <script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script> -->
</html>
