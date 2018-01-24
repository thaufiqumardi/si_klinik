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
							<?php 
							if(isset($msg['msg'])){
								echo $msg['msg'];
							}else{
								echo "Penambahan Pegawai Gagal, Karena : <br>".validation_errors();
							} 
							?>
					</div>
					<?php
				}
				?>
				<div class="row">
					<div class="col-md-9">
						<div class="box box-primary box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">
									Input Data Pegawai
								</h3>
							</div>
					<form method="POST" class="formPegawai form-horizontal" action="<?php
							if(isset($pegawai['id_pegawai'])){
								echo site_url('Pegawai/simpan_pegawai').'/'.$pegawai['id_pegawai'];
							}
							else{
								echo site_url('Pegawai/form');
							}
					?>">
					<div class="box-body">
						<?php
						if(isset($pegawai['id_pegawai'])){
						?>						
						<div class="form-group">
							<label class="control-label col-md-3">NIP</label>
							<div class="col-md-9">
								<input type="text" name="nip" class="form-control" disabled="disabled" placeholder="Nomor Induk Pegawai" <?php
									if(isset($pegawai)){
										echo("value='".$pegawai['nip']."'");
									}
									else{
										echo "value='".set_value('nip')."'";
									}
								?> />
							</div>
						</div>
						<?php
						}
						?>
						<div class="form-group">
							<label class="control-label col-md-3">Nama<sup style="color:red;">*</sup></label>
							<div class="col-md-9">
								<input type="text" name="nama" class="form-control" required="required" placeholder="Nama Pegawai" <?php
									if(isset($pegawai)){echo("value='".$pegawai['nama']."'");
									}
									else{
										echo "value='".set_value('nama')."'";
									}
								?> />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">NIK<sup style="color:red;">*</sup></label>
							<div class="col-md-9">
								<input type="text" name="nik" maxlength="16" class="form-control" onkeypress='return isNumberKey(event);' required="required" placeholder="Nomor Induk Kependudukan" <?php
									if(isset($pegawai)){echo("value='".$pegawai['nik']."'");}
									else{
										echo "value='".set_value('nik')."'";
									}
								?>/>
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
											if(isset($pegawai)){
												echo($pegawai['jenis_kelamin']=="Laki-Laki"?"checked":"");
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
											if(isset($pegawai)){
												echo($pegawai['jenis_kelamin']=="Perempuan"?"checked":"");
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
									if(isset($pegawai)){
										echo("value='".$pegawai['tempat_lahir']."'");
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
											if(isset($pegawai)){
												$tgl_lahir=explode('-',$pegawai['tgl_lahir']);
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
											if(isset($pegawai)){
												echo($pegawai['status_perkawinan']=='Kawin'?'selected':'');
											}
											else{
												echo set_select('status_perkawinan','Kawin');
											}
										?>
									>Kawin</option>
									<option value="Belum Kawin"
									<?php
											if(isset($pegawai)){
												echo($pegawai['status_perkawinan']=='Belum Kawin'?'selected':'');
											}
											else{
												echo set_select('status_perkawinan','Belum Kawin');
											}
										?>
									>Belum Kawin</option>
									<option value="Janda"
									<?php
											if(isset($pegawai)){
												echo($pegawai['status_perkawinan']=='Janda'?'selected':'');
											}
											else{
												echo set_select('status_perkawinan','Janda');
											}
										?>
									>Janda</option>
									<option value="Duda"
									<?php
											if(isset($pegawai)){
												echo($pegawai['status_perkawinan']=='Duda'?'selected':'');
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
								<input type="text" name="agama" class="form-control" required="required" placeholder="Agama"  <?php
									if(isset($pegawai)){
										echo("value='".$pegawai['agama']."'");
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
								<textarea name="alamat" class="form-control" placeholder="Alamat" required><?php
									if(isset($pegawai)){
										echo($pegawai['alamat']);
									}
									else{
										echo set_value('alamat');
									}
								?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">No. Handphone<sup style="color:red;">*</sup></label>
							<div class="col-md-9">
								<div class="input-group">
									<span class="input-group-addon">+62</span><input type="text" name="no_hp" required="required" class="form-control" data-inputmask='"mask": "999-9999-9999"' data-mask placeholder="8XX-XXXX-XXXX"  <?php
									if(isset($pegawai)){
										echo("value='".$pegawai['no_hp']."'");
									}
									else{
										echo "value='".set_value('no_hp')."'";
									}
								?> />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Jabatan<sup style="color:red;">*</sup></label>
							<div class="col-md-9">
								<select name="id_jabatan" class="form-control selectOption" required="required">
									<option selected disabled value="">Pilih Jabatan</option>
									<?php foreach($jabatan as $j):?>
									<option value="<?= $j['id_jabatan'];?>" <?php
										echo (isset($pegawai)? ($pegawai['id_jabatan']==$j['id_jabatan']?'selected':''):set_select('id_jabatan',$j['id_jabatan']));
									?>
									><?= $j['nama_jabatan'];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Mulai Bekerja<sup style="color:red;">*</sup></label>
							<div class="col-md-9">
								<input required="required" type="text" name="mulai_bekerja" required="required" class="form-control datepicker" placeholder="hh/bb/tttt" data-mask data-inputmask='"mask":"99/99/9999"'
								<?php
											if(isset($pegawai)){
												$m_kerja=explode('-',$pegawai['mulai_bekerja']);
												echo "value='$m_kerja[2].$m_kerja[1].$m_kerja[0]'";
											}
											else{
												echo "value='".set_value('mulai_bekerja')."'";
											}
										?>/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Status<sup style="color:red;">*</sup></label>
							<div class="col-md-9">
								<select name="status" class="form-control selectOption" required="required">
									<option selected disabled value="">Pilih Status Pegawai</option>
									<option value="Aktif" <?php
										echo(isset($pegawai)?($pegawai['status']=="Aktif"?'selected':''):set_select('status','Aktif'));
									?>
									 >Aktif</option>
									<option value="Tidak Aktif" <?php
										echo(isset($pegawai)?($pegawai['status']=="Tidak Aktif"?'selected':''):set_select('status','Tidak Aktif'));
									?>>Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="pull-left">
							<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
						</div>
						<div class="pull-right">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?php echo base_url(); ?>Pegawai" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
		  	$('#mnPegawai').addClass('active');
			$('#resetBtn').click(function() {
	        $('.formPegawai').data('bootstrapValidator').resetForm(true);
	    	});
	    	$("[data-mask]").inputmask();
	    	$('.datepicker').datepicker({
	           format:'dd/mm/yyyy',
	           todayHighlight:true,
	           containter:true,
	        });
	        $('.selectOption').select2();
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