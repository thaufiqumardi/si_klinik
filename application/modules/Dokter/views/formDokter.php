<!DOCTYPE HTML>
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
					<div class="alert <?php echo ($msg['class'] == 0 ? 'alert-danger' : 'alert-success'); ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-<?php echo ($msg['class'] == 0 ? 'ban' : 'check'); ?>"></i> <?php echo ($msg['class'] == 0 ? 'Gagal' : 'Berhasil!'); ?></h4>
							<?php
							if(isset($msg['msg'])){
								echo $msg['msg'];
							}else{
								echo "Penambahan Dokter Gagal, Karena : <br>".validation_errors();
							}
							?>
					</div>
					<?php
				}
			?>
			<div class="row">
				<div  class="col-md-9">
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Input Data Dokter</h3>
						</div>
						<form method="POST" class="formDokter form-horizontal" action="
						<?php
							if(isset($dokter['id_dokter'])){
								echo site_url('dokter/edit').'/'.$dokter['id_dokter'];
							}
							else{
								echo site_url('dokter/form');
							}
						?>">
						<div class="box-body">
							<!-- <div class="form-group">
								<label class="control-label col-md-3">Kode Dokter<sup style="color:red;">*</sup></label>
								<div class="col-md-8">
									<input type="text" name="kode_dokter" placeholder="Kode Dokter" required="required" class="form-control"
									</?php
										if(isset($dokter)){
											echo("value='".$dokter['kd_dokter']."'");
										}
										else{
											echo("value='".set_value('kode_dokter')."'");
										}
									?>
									/>
								</div>
							</div> -->
							<div class="form-group">
								<label class="control-label col-md-3">No. Izin Praktek<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<input type="text" name="no_izin_praktek" placeholder="Nomor Izin Praktek " required="required" class="form-control" <?php
										if(isset($dokter)){
											echo("value='".$dokter['no_izin_praktek']."'");
										}
										else{
											echo("value='".set_value('no_izin_praktek')."'");
										}
									?>  />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Nama Dokter<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<input type="text" name="nama" class="form-control" required="required" placeholder="Nama Lengkap" <?php
										if(isset($dokter)){
											echo("value='".$dokter['nama_dokter']."'");
										}
										else{
											echo("value='".set_value('nama')."'");
										}
									?> />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Jenis Kelamin<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<div class="row">
										<div class="radio col-md-3">
										<label class="control-label">
											<input type="radio" name="jenis_kelamin" required="required" value="Laki-Laki"
											<?php
												if(isset($dokter)){
													echo($dokter['jenis_kelamin']=="Laki-Laki"?"checked":"");
												}
												else{
													echo set_radio('jenis_kelamin','Laki-Laki');
												}
											?>
											>Laki-Laki
										</label>
									</div>
									<div class="radio col-md-1">
										<label class="control-label">
											<input type="radio" name="jenis_kelamin" required="required" value="Perempuan"
												<?php
												if(isset($dokter)){
													echo($dokter['jenis_kelamin']=="Perempuan"?"checked":"");
												}
												else{
													echo set_radio('jenis_kelamin','Perempuan');
												}
											?>
											>Perempuan
										</label>
									</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tempat/Tgl. Lahir<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-6">
											<input type="text" name="tempat_lahir" required="required" placeholder="Tempat Lahir" class="form-control"
												<?php
										if(isset($dokter)){
											echo("value='".$dokter['tmp_lahir']."'");
										}
										else{
											echo "value='".set_value('tempat_lahir')."'";
										}

									?>
											/>
										</div>
										<div class="col-md-6" style="margin-left: -20px;width: 53%;">
											<input type="text" name="tgl_lahir" placeholder="Tanggal Lahir" required="required" class="form-control datepicker" data-mask data-inputmask='"mask":"99/99/9999"'
											<?php
												if(isset($dokter)){
													$tgl_lahir=explode('-',$dokter['tgl_lahir']);
													echo "value='$tgl_lahir[2].$tgl_lahir[1].$tgl_lahir[0]'";
												}
												else{
													echo "value='".set_value('tgl_lahir')."'";
												}
											?>
											/>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Status Perkawinan<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<select name="status_perkawinan" class="form-control selectOption" required="required">
										<option selected disabled value="">Pilih Status Perkawinan</option>
										<option value="Kawin"
											<?php
												if(isset($dokter)){
													echo($dokter['status_nikah']=='Kawin'?'selected':'');
												}
												else{
													echo set_select('status_perkawinan','Kawin');
												}
											?>
										>Kawin</option>
										<option value="Belum Kawin"
										<?php
												if(isset($dokter)){
													echo($dokter['status_nikah']=='Belum Kawin'?'selected':'');
												}
												else{
													echo set_select('status_perkawinan','Belum Kawin');
												}
											?>
										>Belum Kawin</option>
										<option value="Janda"
										<?php
												if(isset($dokter)){
													echo($dokter['status_nikah']=='Janda'?'selected':'');
												}
												else{
													echo set_select('status_perkawinan','Janda');
												}
											?>
										>Janda</option>
										<option value="Duda"
										<?php
												if(isset($dokter)){
													echo($dokter['status_nikah']=='Duda'?'selected':'');
												}
												else{
													echo set_select('status_perkawinan','Duda');
												}
											?>
										>Duda</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Agama<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="agama" required="required" placeholder="Agama"<?php
										if(isset($dokter)){
											echo("value='".$dokter['agama']."'");
										}
										else{
													echo "value='".set_value('agama')."'";
												}
									?> />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Alamat<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<textarea class="form-control" name="alamat" required="required" rows="3"><?php
									if(isset($dokter)){
										echo($dokter['alamat']);
									}
									else{
													echo set_value('alamat');
												}
								?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">No Telepon<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<div class="input-group">
										<span class="input-group-addon">+62</span>
										<input type="text" name="no_hp" class="form-control" required="required"
										data-inputmask='"mask": "999-9999-9999"' data-mask placeholder="8XX-XXXX-XXXX"
										<?php
										if(isset($dokter)){
											echo("value='".$dokter['telepon']."'");
										}
										else{
													echo "value='".set_value('no_hp')."'";
												}
									?> />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Status<sup style="color:red;">*</sup></label>
								<div class="col-md-9">
									<select name="status" class="form-control selectOption" required="required">
										<option selected disabled value="">Pilih Status</option>
										<option value="Aktif"
											<?php
												if(isset($dokter)){
													echo($dokter['status']=='Aktif'?'selected':'');
												}
												else{
													echo set_select('status','Aktif');
												}
											?>
										>Aktif</option>
										<option value="Tidak Aktif"
										<?php
												if(isset($dokter)){
													echo($dokter['status']=='Tidak Aktif'?'selected':'');
												}
												else{
													echo set_select('status','Tidak Aktif');
												}
											?>
										>Tidak Aktif</option>
									</select>
								</div>
							</div>
							<div class="box-footer">
								<div class="pull-left">
									<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
								</div>
								<div class="pull-right">
									<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>Dokter" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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
		$('#mnMasterPegawai').addClass('active');
	  	$('#mnDokter').addClass('active');
		$('#resetBtn').click(function() {
        $('.formDokter').data('bootstrapValidator').resetForm(true);
    });
    	$("[data-mask]").inputmask();
    	$('.datepicker').datepicker({
           format:'dd/mm/yyyy',
           todayHighlight:true,
           containter:true,
					 orientation:'bottom',
					 startView:'years',
        });
        $('.selectOption').select2();
        $('#alert').delay(10000).fadeOut("slow");
	});
</script>
