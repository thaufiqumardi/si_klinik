<?php
		$menusid = $this->M_crud->get_by_param("menu", 'name', "Obat");
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
		// die;
		?>
<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('template/v_header'); ?>
    </head>
    <body class="fixed hold-transition skin-blue-light sidebar-mini">
    	<?php $this->load->view('template/v_left_menu'); ?>
    	<div class="content-wrapper">
    		<section class="content">
				<?php
				if(!empty($this->session->flashdata('alert'))){
					$msg=$this->session->flashdata('alert');
					?>
					<div id="alert" class="alert <?php echo ($msg['class'] == 0 ? 'alert-danger' : 'alert-success'); ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-<?php echo ($msg['class'] == 0 ? 'ban' : 'check'); ?>"></i> <?php echo ($msg['class'] == 0 ? 'Alert!' : 'Berhasil!'); ?></h4>
							<?php echo $msg['msg']; ?>
					</div>
					<?php
				}
				?>
				<div class="box box-widget">
					<div class="box-header with-border">
						<h3 class="box-title pull-left">Data Stok Obat</h3>
					</div>
					<div class="box-body">
							<a href="<?php echo site_url('Obat/cetak');?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak</a>
			              	<a href="<?php echo site_url('Obat/doexport');?>" style="margin-right: 10px;" target="_blank" class="btn btn-success pull-right">
			              		<i class="fa fa-file-excel-o"></i> Export Excell</a>

						<table id="example2" style="border: 2" class="table table-bordered table-striped table-hover DataTable">
							<thead>
								<tr>
									<th style="width: 5%;" class="text-center">No.</th>
									<th >Kode Obat</th>
									<th class="text-center">Nama Obat / Alkes</th>
									<th class="text-center">Kategori</th>
									<th class="text-center">Merk</th>
									<th class="text-center">Stok</th>
									<th class="text-center">Satuan</th>
									<th class="text-center">Supplier</th>
									<th style="width: 10%;" class="text-center">Aksi</th>
								</tr>
							</thead>
              <tbody>


              </tbody>
						</table>
					</div>
				</div>
				<div class="modal fade" id="confirmHapus"  data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog">
						<div class="modal-content" style="margin-top:100px;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" style="text-align:center;">
									Anda Yakin Akan menghapus <span class="grt"></span>?
								</h4>
							</div>
							<div class="modal-footer">
								<span id="preloader-delete"></span>
								<br><a class="btn btn-primary" id="delete_link_m_n" href="">Delete</a>
								<button type="button" class="btn btn-default" data-dismiss="modal" id="delete_cancel_link">
									Cancel
								</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('template/v_copyright'); ?>
	</body>
	<?php $this->load->view('template/v_footer'); ?>
	<script>
		function confirm_delete(delete_url,title)
			{
				jQuery('#confirmHapus').modal('show', {backdrop: 'static',keyboard :false});
				jQuery("#confirmHapus .grt").text(title);
				document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
			}
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#mnMasterObat').addClass('active');
	  	$('#mnObat').addClass('active');

	  	$('#alert').delay(10000).fadeOut("slow");
	});

	$(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "info": false,
          "autoWidth": true,
          "columnDefs": [{
              "targets": [ -1],
              "orderable": false,
      		}],
        });
      });
	</script>
</html>
