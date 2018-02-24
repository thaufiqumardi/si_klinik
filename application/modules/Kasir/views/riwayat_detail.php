<?php
	$menusid = $this->M_crud->get_by_param("menu", 'name', "transaksi");
	if(empty($menusid)){
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
    <body class="fixed hold-transition skin-blue-light">
    	<?php $this->load->view('template/v_left_menu'); ?>
    	<div class="content-wrapper">
    		<section class="content">
          <div class="row">
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Transaksi</h3>
                </div>
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>No. Nota : </dt>
                    <dd><?= $detail_pemasukan->no_kuitansi;?></dd>
                    <dt>Tanggal Transaksi : </dt>
                    <dd><?php
                          $when = explode(' ',$detail_pemasukan->tgl_pemasukan);
                          $tgl = date('d-M-Y',strtotime($when[0]));
                          $jam = $when[1];
                          echo $tgl;?></dd>
                    <dt>Jam Transaksi  :</dt>
                    <dd><?= $jam;?>
                    <dt>Operator : </dt>
                    <dd><?= $detail_pemasukan->name;?></dd>
                  </dl>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box box-widget">
                  <div class="box-body">
                  <h1>Untuk Detail Barang atau detail biaya</h1>
                  <small>Belum Beres</small>
                  </div>
              </div>
            </div>
          </div>
		    </section>
	    </div>
	    <?php $this->load->view('template/v_copyright'); ?>
	  </body>
	<?php $this->load->view('template/v_footer'); ?>
<script type="text/javascript">
	$(document).ready(function() {
	  $('#mnTransaksi').addClass('active');
		$('#mnRiwayatKasir').addClass('active');
    $('#alert').delay(10000).fadeOut("slow");
	});

	$(function () {
        $('.datatable').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "columnDefs": [{
              "targets": [ -1],
              "orderable": false,
      		}],
          "info": false,
          "autoWidth": true
        });
      });
</script>
