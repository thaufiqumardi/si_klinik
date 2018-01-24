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
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">
								Input Data Obat <?= (isset($obat)?$obat->nama_obat:'');?>
							</h3>
						</div>
						<form method="POST" class="formObat form-horizontal" action="<?php
							if(isset($obat->id_obat)){
								echo site_url('obat/update').'/'.$obat->id_obat;
							}
							else{
								echo site_url('obat/simpan');
							}
							?>">
							<div class="box-body">
									<div class="form-group">
										<label class="control-label col-md-2">Kode Obat</label>
										<div class="col-md-6">
											<input type="text" name="kode_obat" class="form-control" placeholder="Kode Obat" <?=(isset($obat)?"value='$obat->kode_obat'":'');?> required="required"/>
										</div>
									</div>
					            <div class="form-group">
					              <label class="control-label col-md-2">Nama Obat/Alkes<sup style="color:red;">*</sup></label>
					              <div class="col-md-6">
					                <input type="text" name="nama_obat" class="form-control" placeholder="Nama Obat atau Nama Alat Kesehatan"
					                <?=(isset($obat)?"value='$obat->nama_obat'":'');?> required="required"/>
					              </div>
					            </div>
					            <div class="form-group">
					              <label class="control-label col-md-2">Kategori<sup style="color:red;">*</sup></label>
					              <div class="col-md-6">
					                <select class="form-control selectOption" name="id_kategori" required="required">
					                  <option selected disabled value="">
					                    Pilih Kategori Obat
					                  </option>
					                  <?php foreach ($kat as $row):?>
					                    <option value="<?= $row->id_kategori;?>"
					                      <?php echo(isset($obat)?($obat->id_kategori==$row->id_kategori?'selected':''):''); ?>
					                      ><?= $row->nama_kategori;?></option>
					                  <?php endforeach;?>
					                </select>
					              </div>
					            </div>
					            <div class="form-group">
					              <label class="control-label col-md-2">Merk</label>
					              <div class="col-md-6">
					                <select class="form-control selectOption" name="id_merk">
					                  <option selected disabled value="">
					                    Pilih Merk Obat
					                  </option>
					                  <?php foreach ($merk as $row):?>
					                    <option value="<?= $row->merk_id;?>"
					                      <?php echo(isset($obat)?($obat->id_merk==$row->merk_id?'selected':''):''); ?>
					                      ><?= $row->merk_nama;?></option>
					                  <?php endforeach;?>
					                </select>
					              </div>
					            </div>
					            <div class="form-group">
					              <label class="control-label col-md-2">Satuan<sup style="color:red;">*</sup></label>
					              <div class="col-md-6">
					                <select class="form-control selectOption" name="id_satuan" required="required">
					                  <option selected disabled value="">
					                    Pilih Satuan Obat
					                  </option>
					                  <?php foreach ($satuan as $row):?>
					                    <option value="<?= $row->satuan_id;?>"
					                      <?php echo(isset($obat)?($obat->id_satuan==$row->satuan_id?'selected':''):''); ?>
					                      ><?= $row->satuan_nama;?></option>
					                  <?php endforeach;?>
					                </select>
					              </div>
					            </div>
					            <div class="form-group">
					              <label class="control-label col-md-2">Supplier</label>
					              <div class="col-md-6">
					                <select class="form-control selectOption" name="id_supplier">
					                  <option selected disabled value="">
					                    Pilih Supplier
					                  </option>
					                  <?php foreach ($supplier as $row):?>
					                    <option value="<?= $row->supplier_id;?>"
					                      <?php echo(isset($obat)?($obat->id_supplier==$row->supplier_id?'selected':''):''); ?>
					                      ><?= $row->nama_supplier;?></option>
					                  <?php endforeach;?>
					                </select>
					              </div>
					            </div>
					            <div class="box-footer">
					            	<div class="pull-left">
										<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
									</div>
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Obat" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
	  	$('#mnObat').addClass('active');
    	$("[data-mask]").inputmask();
    	$('.datepicker').datepicker({
           format:'dd/mm/yyyy',
           todayHighlight:true,
           containter:true,
        });
        $('.selectOption').select2();
        $('#alert').delay(10000).fadeOut("slow");
	});
</script>
</html>
