<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

$menusid = $this->M_crud->get_by_param("menu", 'name', "Bed");
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
					  <h3 class="box-title">Data Bed</h3>
					</div>					
						<div class="box-body">
							  <a href="<?php echo site_url('Bed/cetak');?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak</a>
			              	  <a href="<?php echo site_url('Bed/doexport');?>" style="margin-right: 10px;" target="_blank" class="btn btn-success pull-right">
			              		<i class="fa fa-file-excel-o"></i> Export Excell</a>
							  <?php if($this->session->userdata['simklinik']['ap_is_admin'] == 1 || $mnCreate == 1){
			              	  ?>
			              	  <a style="margin-right: 10px;" href="<?php echo base_url(); ?>Bed/add_bed" class="btn btn-primary pull-right">
			              	  <i class="fa fa-plus"></i> Tambah Data</a><br><br>
			              	  <?php
			              	  }
			              	  ?>
						  <table id="example2" class="table table-bordered table-striped">
							<thead>
							<tr>
							  <th style="width: 5%;" class="text-center">No</th>
							  <th class="text-center">Bed</th>
							  <th class="text-center">Ruangan</th>
							  <th class="text-center">Status</th>
							  <th style="width: 10%;" class="text-center">Aksi</th>
							</tr>
							</thead>
							
							
							<tbody>
							<?php
								if($bed > 0)
								{
									$no = 1;
									foreach($bed as $data)
									{
							?>
								<tr class="odd gradeX">
									<td><?= $no ?></td>
									<td><?= $data->nama_bed ?></td>
									<td><?= $data->nama_ruangan ?></td>
									<td><?= $data->status_isi ?></td>
									<td class="center">
							<?php
								if($this->session->userdata['simklinik']['ap_is_admin'] == 1 || $mnUpdate == 1)
								{
							?>
									<a class="btn btn-warning btn-xs" href="<?php echo site_url('Bed/edit\/').$data->id_bed;?>">
										<i class="fa fa-edit" title="Edit"></i></a>
							<?php
								}
								
								if($this->session->userdata['simklinik']['ap_is_admin'] == 1 || $mnDelete == 1)
								{
							?>
									<a class="btn btn-danger btn-xs" title="Hapus" href="" data-toggle="modal" 
										onclick="confirm_delete('<?php echo site_url('Bed/delete').'/'.$data->id_bed;?>',
										'<?php echo $data->nama_bed;?>');"><i class="fa fa-trash"></i></a>
							<?php
								}
							?>
									
									</td>
								</tr>
							<?php
									$no++;
									}
								}
							?>
							</tbody>
						  </table>
						</div>
				</div>
    		</section>
    	</div>
		<?php $this->load->view('template/v_copyright'); ?>
		
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
    </body>    
    <?php $this->load->view('template/v_footer'); ?>
    
    <script type="text/javascript">
    $(document).ready(function() {
    	$('#mnMasterRuangan').addClass('active');
    	$('#mnBed').addClass('active');

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
    function confirm_delete(delete_url,title)
	{
		jQuery('#confirmHapus').modal('show', {backdrop: 'static',keyboard :false});
		jQuery("#confirmHapus .grt").text(title);
		document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
	}
	</script>
    
</html>

