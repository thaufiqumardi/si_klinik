<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
						<div class="col-xs-12">
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
								  <h3 class="box-title">Input Data Supplier</h3>
								</div>
								<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($supplier_id) ? 'Suplier/update' : 'Suplier/insert'); ?>">
								  <?php
									if(isset($supplier_id))
									{
										echo "<input type='hidden' name='id' value='".$supplier_id."'>";
									}
								  ?>
								  <div  class="box-body">
									<!-- <div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Kode Supplier</label>

									  <div class="col-sm-2">
										<input type="text" name="kode_supplier" class="form-control" value="</?php echo (isset($kode_supplier) ? $kode_supplier : ''); ?>" placeholder="Masukan Kode Supplier..." required="required">
									  </div>
									</div> -->

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Nama Supplier<sup style="color:red;">*</sup></label>

									  <div class="col-sm-4">
										<input type="text" name="nama_supplier" class="form-control" value="<?php echo (isset($nama_supplier) ? $nama_supplier : ''); ?>" placeholder="Masukan Nama Suplier..." required="required">
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

									  <div class="col-sm-9">
									  	<textarea class="form-control" name="alamat_supplier" id="alamat_supplier" placeholder="Alamat Supplier"><?php echo (isset($alamat_supplier) ? $alamat_supplier : ''); ?></textarea>
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">No. Telepon</label>

									  <div class="col-sm-3">
										<input type="text" name="no_telpon_supplier" class="form-control" value="<?php echo (isset($no_telpon_supplier) ? $no_telpon_supplier : ''); ?>" placeholder="Masukan No. Telepon..." onkeypress='return isNumberKey(event);'>
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Contact Person</label>

									  <div class="col-sm-4">
										<input type="text" name="contact_person" class="form-control" value="<?php echo (isset($contact_person) ? $contact_person : ''); ?>" placeholder="Masukan Nama Contact Person...">
									  </div>
									</div>

								  <div class="box-footer">
								  	<div class="pull-left">
										<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
									</div>
									<div class="pull-right">
										<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Suplier" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnSupplier').addClass('active');

        $('#alert').delay(10000).fadeOut("slow");
    });

    function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
       return true;
    }
	</script>
</html>
