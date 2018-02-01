<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$menusid = $this->M_crud->get_by_param("menu", 'name', "Beranda");
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
		    <section class="content-header">

		    </section>
    		<section class="content">
					<div class="row">
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-aqua">
		            <div class="inner">
		              <h3><?= $jumlah_pasien_daftar;?></h3>

		              <p>Pasien Daftar Hari Ini</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-wheelchair"></i>
		            </div>
		            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		          </div>
		        </div>
						
					</div>
					<div class="box box-widget">
						<div class="content">

							<div class="callout callout-info">
								<h4>I am an info callout!</h4>

								<p>Follow the steps to continue to payment.</p>
							</div>

							<div class="callout callout-warning">
								<h4>I am an info callout!</h4>

								<p>Follow the steps to continue to payment.</p>
							</div>

							<div class="callout callout-danger">
								<h4>I am an info callout!</h4>

								<p>Follow the steps to continue to payment.</p>
							</div>
						</div>
				</div>
    		</section>

    	</div


    	<?php $this->load->view('template/v_copyright'); ?>
    </body>

    <?php $this->load->view('template/v_footer'); ?>

    <script type="text/javascript">
    $(document).ready(function() {
    	$('#mnBeranda').addClass('active');
    });
	</script>
</html>
