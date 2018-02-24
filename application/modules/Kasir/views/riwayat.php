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
				<div class="box box-primary box-solid box-widget">
					<div class="box-header with-border">
						<h3 class="box-title">Riwayat Transaksi</h3>
					</div>
					<div class="box-body">
            <table class="datatable table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:5px;">No. </th>
                  <th>No. Nota</th>
                  <th>Tanggal, Jam</th>
                  <th>Operator/Kasir</th>
                  <th style="width:5px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($riwayat as $key=>$r):?>
                  <tr>
                    <td><?= ++$key;?></td>
                    <td><?= $r->no_kuitansi;?></td>
                    <td><?php
                          $when = explode(' ',$r->tgl_transaksi);
                          $tgl = date('d-M-Y',strtotime($when[0]));
                          $jam = $when[1];
                          echo $tgl." | ".$jam;
                    ?></td>
                    <td><?= $r->name;?></td>
                    <td><a href="<?= site_url('kasir/riwayat').'/'.$r->no_kuitansi;?>" class="btn btn-xs btn-primary" title="Lihat Detail"><i class="fa fa-search"></i> Detail</a></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
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
