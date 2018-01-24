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
				<div class="row">
          <div class="col-md-12">
            <div class="box box-widget">
              <div class="box-body">
                <table class="table table-border">
                  
                </table>
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
		$('#mnBerandaGudang').addClass('active');
	  	// $('#mnObat').addClass('active');

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
