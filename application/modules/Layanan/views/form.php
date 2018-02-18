<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$menusid = $this->M_crud->get_by_param("menu", 'name', "Layanan");
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
    			<div class="row">
						<div class="col-md-12">
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
								  <h3 class="box-title">Form Data Layanan</h3>
								</div>
								<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($id_layanan) ? 'Layanan/update' : 'Layanan/insert'); ?>">
								  <?php
									if(isset($id_layanan))
									{
										echo "<input type='hidden' name='id' value='".$id_layanan."'>";
									}
								  ?>
								  <div  class="box-body">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Nama Layanan<sup style="color:red;">*</sup></label>

									  <div class="col-sm-4">
										<input type="text" name="nama" class="form-control" value="<?php echo (isset($nama) ? $nama : ''); ?>" placeholder="Masukan Nama Layanan..." required="required">
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Tarif<sup style="color:red;">*</sup></label>

									  <div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">Rp</span><input type="text" name="tarif" id="tarif" placeholder="" value="<?php echo (isset($tarif) ? $tarif : ''); ?>" class="span8 form-control" required="required">
										</div>
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Tarif Khusus</label>

									  <div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">Rp</span><input type="text" name="tarif_khusus" id="tarif_khusus" placeholder="" value="<?php echo (isset($tarif_khusus) ? $tarif_khusus : ''); ?>" class="span8 form-control" >
										</div>
									  </div>
									</div>

								  <div class="box-footer">
								  	<div class="pull-left">
										<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
									</div>
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Layanan" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
									</div>
								  </div>
								  </div>
								</form>
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
    	$('#mnMasterLayanan').addClass('active');
    	$('#mnLayanan').addClass('active');

        $('#alert').delay(10000).fadeOut("slow");
    });

    $('#tarif').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ".",
        digits: 2,
        autoGroup: true,
        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });

    $('#tarif_khusus').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,
        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });
	</script>
</html>
