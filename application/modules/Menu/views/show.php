<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$menusid = $this->M_crud->get_by_param("menu", 'name', "Menu");
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
    			<div class="box box-primary box-solid">
					<div class="box-header with-border">
					  <h3 class="box-title">Data Menu</h3>
					</div>
					<div class="box-body">
					    <a href="<?php echo site_url('Menu/cetak');?>" target="_blank" class="btn btn-default pull-right hidden"><i class="fa fa-print"></i> Cetak</a>
		              	<a href="<?php echo site_url('Menu/doexport');?>" style="margin-right: 10px;" target="_blank" class="btn btn-success pull-right hidden">
		              		<i class="fa fa-file-excel-o"></i> Export Excell</a><br><br>
						<table id="example2" class="table table-bordered table-striped">
							<thead>
							<tr>
							  <th style="width: 5%;" class="text-center">No</th>
							  <th style="width: 5%;" class="text-center">Icon</th>
							  <th class="text-center">Title</th>
							  <th class="text-center">Parent</th>
							  <th style="width: 15%;" class="text-center">Urutan Menu</th>
							  <th style="width: 5%;" class="text-center">Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php
								if($menu > 0)
								{
									$no = 1;
									foreach($menu as $data)
									{
									echo '
									<tr class="odd gradeX">
										<td>'.$no.'</td>
										<td><i class="fa fa-fw '.$data->icon.'"></i></td>
										<td>'.$data->title.'</td>';
									if(!empty($data->parent) AND !is_null($data->parent)){
										$result = $this->menu->get_menu_parent($data->parent);
										foreach ($result as $row){
											$menu_parent = $row->title;
										}
										echo '<td>'.$menu_parent.'</td>';
									}else{
										echo '<td></td>';
									}
									echo '<td>'.$data->urutan.'</td>
										  <td class="center">
											<a href="'.base_url().'Menu/edit_menu/'.$data->id_menu.'" class="btn btn-warning btn-xs"><i class="fa fa-fw fa-pencil"></i></a>
										</td>
									</tr>';
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
    </body>

    <?php $this->load->view('template/v_footer'); ?>

    <script type="text/javascript">
    $(document).ready(function() {
    	$('#mnPengaturan').addClass('active');
    	$('#mnMenu').addClass('active');

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
</html>
