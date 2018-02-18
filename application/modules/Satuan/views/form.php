<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('template/v_header'); ?>
    </head>
    <body class="fixed hold-transition skin-blue-light ">
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
								  <h3 class="box-title">Input Data Satuan</h3>
								</div>
								<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($satuan_id) ? 'Satuan/update' : 'Satuan/insert'); ?>">
								  <?php
									if(isset($satuan_id))
									{
										echo "<input type='hidden' name='id' value='".$satuan_id."'>";
									}
								  ?>
								<div  class="box-body">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Satuan<sup style="color:red;">*</sup></label>

									  <div class="col-sm-4">
										<input type="text" name="satuan_nama" class="form-control" value="<?php echo (isset($satuan_nama) ? $satuan_nama : ''); ?>" placeholder="Masukan Nama Satuan..." required="required">
									  </div>
									</div>

								  <div class="box-footer">
									  	<div class="pull-left">
								  			<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
										</div>
										<div class="pull-right">
											<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
											<a href="<?php echo base_url(); ?>Satuan" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnMasterObat').addClass('active');
    	$('#mnSatuan').addClass('active');

        $('#alert').delay(10000).fadeOut("slow");
    });
	</script>
</html>
