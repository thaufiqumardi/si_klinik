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
							<h3 class="box-title">
								Input Data Harga Obat/Alkes
							</h3>
						</div>
					<form method="POST" class="formObat form-horizontal" action="<?php
							if(isset($hargaobat)){
								echo site_url('hargaobat/update').'/'.$hargaobat->harga_obat_id;
							}
							else{
								echo site_url('hargaobat/simpan');
							}
					?>">
						<div class="box-body">
				            <div class="form-group">
				              <label class="control-label col-md-2">Nama Obat/Alkes<sup style="color:red;">*</sup></label>
				              <div class="col-md-4">
				                <select class="form-control selectOption" name="id_obat" required="required">
				                  <option selected disabled>
				                    Pilih Obat
				                  </option>
				                  <?php foreach ($obat as $row):?>
				                    <option value="<?= $row->id_obat;?>"
				                      <?php echo(isset($hargaobat)?($hargaobat->id_obat==$row->id_obat?'selected':''):''); ?>
				                      ><?= $row->nama_obat;?></option>
				                  <?php endforeach;?>
				                </select>
				              </div>
				            </div>
				            <div class="form-group">
				              <label class="control-label col-md-2">Harga Beli<sup style="color:red;">*</sup></label>
				              <div class="col-md-3">
				              	<div class="input-group">
				              		<span class="input-group-addon">Rp</span><input type="text" name="harga_beli" id="harga_beli" placeholder="" <?=(isset($hargaobat)?"value='".$hargaobat->harga_beli."'":'');?> class="span8 form-control" required="required">
				              	</div>
				              </div>
				            </div>
				            <div class="form-group">
				              <label class="control-label col-md-2">Harga Satuan<sup style="color:red;">*</sup></label>
				              <div class="col-md-3">
				              	<div class="input-group">
				              		<span class="input-group-addon">Rp</span><input type="text" name="harga_jual1" id="harga_jual1" placeholder="" <?=(isset($hargaobat)?"value='".$hargaobat->harga_jual1."'":'');?> class="span8 form-control" required="required">
				              	</div>
				              </div>
				            </div>

				            <div class="box-footer">
				            	<div class="pull-left">
									<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
								</div>
								<div class="pull-right">
									<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>Hargaobat" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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
		$(document).ready(function(){
			$('#mnMasterObat').addClass('active');
		  	$('#mnHargaObat').addClass('active');

		  	$('#alert').delay(10000).fadeOut("slow");
		});

		$('#harga_beli').inputmask("numeric", {
	        radixPoint: ".",
	        groupSeparator: ",",
	        digits: 2,
	        autoGroup: true,
	        rightAlign: false,
	        oncleared: function () { self.Value(''); }
	    });

		$('#harga_jual1').inputmask("numeric", {
	        radixPoint: ".",
	        groupSeparator: ",",
	        digits: 2,
	        autoGroup: true,
	        rightAlign: false,
	        oncleared: function () { self.Value(''); }
	    });

		$('#harga_jual2').inputmask("numeric", {
	        radixPoint: ".",
	        groupSeparator: ",",
	        digits: 2,
	        autoGroup: true,
	        rightAlign: false,
	        oncleared: function () { self.Value(''); }
	    });
	</script>
</html>
