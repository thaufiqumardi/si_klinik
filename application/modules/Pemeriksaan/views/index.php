<?php
	$menusid = $this->M_crud->get_by_param("menu", 'name', "Dokter");
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
				<div class="box box-primary box-solid box-widget">
					<div class="box-header with-border">
						<h3 class="box-title">Pemeriksaan Pasien</h3>
					</div>
					<div class="box-body">
						<a href="<?php echo site_url('Pemeriksaan/Cetak');?>" target="_blank"  class="btn btn-default pull-right hidden"><i class="fa fa-print"></i> Cetak</a>
										<!-- <a href="<?php echo site_url('Pemeriksaan/doexport');?>" style="margin-right: 10px;" target="_blank" class="btn btn-success pull-right">
		              		<i class="fa fa-file-excel-o"></i> Export Excell</a> -->
						  <?php if($this->session->userdata['simklinik']['ap_is_admin'] == 1 || $mnCreate == 1){
		              	  ?>
		              	  <a href="<?php echo base_url(); ?>Pemeriksaan" style="margin-right: 10px;" class="btn btn-warning pull-right">
		              	  <i class="fa fa-refresh"></i> Refresh</a><br><br>
		              	  <?php
		              	  }
		              	  ?>
						<table id="example2" style="border: 2" class="table table-bordered table-striped DataTable">
							<thead>
								<tr>
									<th style="width: 5%;" class="text-center">No.</th>
									<th class="text-center">No. Rekam Medik</th>
									<th class="text-center">No. Kartu</th>
									<th class="text-center">Nama Pasien</th>
									<th class="text-center">Dokter</th>
									<th style="width: 10%;" class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($registered as $key => $row):?>
									<tr>
										<td><?= ++$key;?></td>
										<td><?= $row->no_rm;?></td>
										<td><?= $row->no_kartu;?></td>
										<td><?= $row->nama_pasien;?></td>
										<td><?= $row->nama_dokter;?></td>
										<td>
											<a href="<?=site_url('Pemeriksaan/form').'/'.$row->id_pasien.'/'.$row->no_registrasi;?>" class="btn btn-primary"><i class="fa fa-stethoscope"></i> Pemeriksaan</a>
										</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
					<div class="box-footer">

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
	  $('#mnPemeriksaan').addClass('active');


      $('#alert').delay(10000).fadeOut("slow");
	});

	$(function () {
        $('#example2').DataTable({
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
