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
							<?php echo "Penambahan pasien gagal, karena : ".validation_errors(); ?>
							<p>
								<?php if(!empty($msg['no_kartu']))$msg['no_kartu'];?>
							</p>
					</div>
					<?php
				}
				?>
				<div class="box box-widget">
					<div class="box-header with-border">
						<h3 class="box-title">Formulir Pendaftaran Pasien Baru</h3><br>
					</div>
					<form method="POST" class="formPasien form-horizontal" action="<?php
						if(!empty($pasien['id_pasien'])){
							echo site_url('pasien/update_pasien'.'/'.$pasien['id_pasien']);
						}
						else{
							echo site_url('pasien/form');
						}
					?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="box box-primary box-solid">
									<div class="box-header">
										<div class="pull-left">
											<small>Yang bertanda <span style="color: red;">*</span> wajib diisi</small>
										</div>
									</div>
									<?php
										if(!empty($pasien['id_pasien'])){
												$action = site_url('pasien/update'.'/'.$pasien['id_pasien']);
											}
											else{
												$action= site_url('pasien/simpan');
												// echo $action;
												// die;
											}
									?>
									<div class="box-body">
										<?php
											if(!empty($pasien['id_pasien'])){
										?>
										<div class="form-group">
											<label class="control-label col-md-2">No. RM</label>
											<div class="col-md-9">
												<input type="text" name="nama_pasien" class="form-control" value="<?php echo $pasien['no_rm'] ?>" disabled="disabled" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2">No. Kartu</label>
											<div class="col-md-9">
												<input type="text" name="nama_pasien" class="form-control" value="<?php echo $pasien['no_kartu'] ?>" disabled="disabled" />
											</div>
										</div>
										<?php
											}
										?>
										<div class="form-group">
											<label class="control-label col-md-2">Nama Pasien<sup style="color:red;">*</sup></label>
											<div class="col-md-9">
												<input type="text" name="nama_pasien" class="form-control" required="required"
													<?php
														if(isset($pasien)){
															echo("value='".$pasien['nama_pasien']."'");
														}
														else{
															echo "value='".set_value('nama_pasien')."'";
														}
													?>
												/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2">No. KTP<sup style="color:red;">*</sup></label>
											<div class="col-md-9">
												<input type="text" name="nik_pasien" class="form-control" required="required"
												<?php
														if(isset($pasien)){
															echo("value='".$pasien['nik_pasien']."'");
														}
														else{
															echo "value='".set_value('nik_pasien')."'";
														}
													?>/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2">TTL<sup style="color:red;">*</sup></label>
											<div class="col-md-9">
												<div class="row">
													<div class="col-md-5 offset-md-2">
														<input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="form-control" required="required"
														<?php
														if(isset($pasien)){
															echo("value='".$pasien['tempat_lahir']."'");
														}
														else{
															echo "value='".set_value('tempat_lahir')."'";
														}
														?>
														/>
													</div>
													<div class="col-md-4" style="margin-left: -20px;width:55%;">
														<input required="required" type="text" name="tgl_lahir" placeholder="Tanggal Lahir" class="form-control datepicker" data-mask data-inputmask='"mask":"99/99/9999"'
															<?php
																if(isset($pasien)){
																	$tgl_lahir=explode('-',$pasien['tgl_lahir']);
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
											<label class="control-label col-md-2">Agama</label>
											<div class="col-md-9">
												<input type="text" name="agama" placeholder="Agama" class="form-control"
													<?php
														if(isset($pasien)){
															echo("value='".$pasien['agama']."'");
														}
														else{
															echo "value='".set_value('agama')."'";
														}
														?>
												/>
											</div>
										</div>
										<!-- <div class="form-group">
											<label class="control-label col-md-2">Pendidikan</label>
											<div class="col-md-9">
												<input type="text" name="pendidikan_pasien" placeholder="Pendidikan Terakhir" class="form-control"
												<?php
														if(isset($pasien)){
															echo("value='".$pasien['pendidikan_pasien']."'");
														}
														else{
															echo "value='".set_value('pendidikan_pasien')."'";
														}
														?>
												/>
											</div>
										</div> -->
										<div class="form-group">
											<label class="control-label col-md-2">Pekerjaan</label>
											<div class="col-md-9">
												<input type="text" name="pekerjaan_pasien" placeholder="Pekerjaan" class="form-control"
												<?php
														if(isset($pasien)){
															echo("value='".$pasien['pekerjaan_pasien']."'");
														}
														else{
															echo "value='".set_value('pekerjaan_pasien')."'";
														}
														?>
												/>
											</div>
										</div>
										<!-- <div class="form-group">
											<label class="control-label col-md-2">Kewarganegaraan<sup style="color:red;">*</sup></label>
											<div class="col-md-9">
												<select class="form-control selectOption" name="warga_negara" required="required">
													<option selected disabled value="">Kewarganegaraan Pasien</option>
													<option value="Indonesia"
														<?php
															echo(isset($pasien)?($pasien['warga_negara']=='Indonesia'?'selected':''):set_select('warga_negara','Indonesia'));
														?>
													>WNI (Indonesia)</option>
													<option value="Asing"
														<?php
															echo(isset($pasien)?($pasien['warga_negara']=='Asing'?'selected':''):set_select('warga_negara','Asing'));
														?>
													>WNA (Asing)</option>
												</select>
											</div>
										</div> -->
										<div class="form-group">
											<label class="control-label col-md-2">Golongan Darah</label>
											<div class="col-md-9">
												<?php
													$gol=['A','B','AB','O'];
												?>
												<select class="form-control selectOption" name="gol_darah">
													<option selected disabled value="">Golongan Darah Pasien</option>
													<?php foreach ($gol as $key => $value):?>
														<option value="<?= $value;?>"
															<?php
																echo(isset($pasien)?($pasien['gol_darah']==$value?'selected':''):set_select('gol_darah',$value));
															?>
															><?=$value;?></option>
														<?php endforeach;?>
												</select>
											</div>
										</div>
										<!-- <div class="form-group">
											<label class="control-label col-md-2">Status Perkawinan</label>
											<div class="col-md-9">
												<select class="form-control selectOption" name="status_perkawinan">
													<?php
														$status=["Kawin","Belum Kawin","Janda","Duda"];
													?>
													<option selected disabled value="">Status Perkawinan</option>
													<?php foreach ($status as $key => $value):?>
														<option value="<?= $value;?>"
															<?php
																echo(isset($pasien)?($pasien['status_perkawinan']==$value?'selected':''):set_select('status_perkawinan',$value));
															?>
															><?= $value;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div> -->
										<div class="form-group">
											<label class="control-label col-md-2">No. Telp</label>
											<div class="col-md-9">
												<input type="text" name="no_telp_rumah" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask placeholder="(022) XXXX-XXXX"
												<?php
														if(isset($pasien)){
															echo("value='".$pasien['no_telp_rumah']."'");
														}
														else{
															echo "value='".set_value('no_telp_rumah')."'";
														}
														?>
												/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2">No. Handphone</label>
											<div class="col-md-9">
												<div class="input-group">
												<span class="input-group-addon">+62</span><input type="text" name="no_handphone" class="form-control" data-inputmask='"mask": "999-9999-9999"' data-mask placeholder="8XX-XXXX-XXXX"
													<?php
														if(isset($pasien)){
															echo("value='".$pasien['no_handphone']."'");
														}
														else{
															echo "value='".set_value('no_handphone')."'";
														}
														?>
												/>
												</div>
											</div>
										</div>
										<!-- <div class="form-group">
											<label class="control-label col-md-2">Email</label>
											<div class="col-md-9">
												<input type="email" name="email" placeholder="Contoh: nama@contoh.com" class="form-control"
												<?php
														if(isset($pasien)){
															echo("value='".$pasien['email']."'");
														}
														else{
															echo "value='".set_value('email')."'";
														}
														?>
												/>
											</div>
										</div> -->
										<div class="form-group">
											<label class="control-label col-md-2">Alamat<sup style="color:red;">*</sup></label>
											<div class="col-md-9">
												<input type="text" name="jalan" class="form-control" placeholder="Nama Jalan" required="required"
													<?php
														if(isset($pasien)){
															echo "value='".$pasien['jalan']."'";
														}
														else{
															echo "value='".set_value('jalan')."'";
														}
													?>
												/>
												<div class="row" style="margin-top: 5px;">
													<label class="control-label col-md-1">Rt/Rw<sup style="color:red;">*</sup></label>
													<div class="col-md-11">
														<input required="required" name="rtrw" placeholder="RT/RW" type="text" class="form-control" data-inputmask='"mask": "99/99"' data-mask
															<?php
																if(isset($pasien)){
																	echo "value='".$pasien['rtrw']."'";
																}
																else{
																	echo "value='".set_value('rtrw')."'";
																}
															?>
														 />
													</div>
												</div>
												<div class="row" style="margin-top: 5px;">
													<label class="control-label col-md-1">Kel/Desa<sup style="color:red;">*</sup></label>
													<div class="col-md-11">
														<input name="keldesa" type="text" class="form-control" placeholder="Kelurahan / Desa" required="required"
															<?php
																if(isset($pasien)){
																	echo "value='".$pasien['kelurahan']."'";
																}
																else{
																	echo "value='".set_value('keldesa')."'";
																}
															?>
														/>
													</div>
												</div>
												<div class="row" style="margin-top: 5px;">
													<label class="control-label col-md-1">Kec<sup style="color:red;">*</sup></label>
													<div class="col-md-11">
														<input name="kecamatan" type="text" class="form-control" placeholder="Kecamatan" required="required"
															<?php
																if(isset($pasien)){
																	echo "value='".$pasien['kecamatan']."'";
																}
																else{
																	echo "value='".set_value('kecamatan')."'";
																}
															?>
														/>
													</div>
												</div>
												<div class="row" style="margin-top: 5px;">
													<label class="control-label col-md-1">Kota/Kab<sup style="color:red;">*</sup></label>
													<div class="col-md-11">
														<input name="kota" type="text" class="form-control" placeholder="Kota /" required="required"
														<?php
															if(isset($pasien)){
																	echo "value='".$pasien['kota']."'";
																}
																else{
																	echo "value='".set_value('kota')."'";
																}
														?>
														/>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="pull-left">
							<p>Yang bertanda <span style="color: red;">*</span> wajib diisi</p>
						</div>
								<div class="pull-right">
								<?php
									if(!empty($pasien['id_pasien'])){
								?>
								<a href="<?php echo site_url('pasien/cetak_detail\/').$pasien['id_pasien'];?>" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
								<?php
										}
								?>
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
								<a class="btn btn-danger" href="<?php echo site_url('pasien');?>"><i class="fa fa-close"></i> Batal</a>
						</div>
					</div>
					</form>
				</div>
			</section>
		</div>
		<?php $this->load->view('template/v_copyright'); ?>
    </body>

    <?php $this->load->view('template/v_footer'); ?>
	<script type="text/javascript">
	  $(document).ready(function(){
	  	$('#mnTambahPasien').addClass('active');

	    $("[data-mask]").inputmask();
	    $('.selectOption').select2();
	    $('.DataTable').DataTable({});
	    $('.datepicker').datepicker({
	           format:'dd/mm/yyyy',
	           todayHighlight:true,
	           containter:true,
	        });

	    $('#alert').delay(10000).fadeOut("slow");
	    $("#btnExportExcell").click(function(e) {
	      e.preventDefault();

	      $('#opsi').remove();
	      $('.opsiTd').remove();
	      //getting data from our table
	      var data_type = 'data:application/vnd.ms-excel';
	      var table_div = document.getElementById('tablePasien');
	      var table_html = table_div.outerHTML.replace(/ /g, '%20');

	      var a = document.createElement('a');
	      a.href = data_type + ', ' + table_html;
	      var today = new Date();
		    var dd = today.getDate();
		    var mm = today.getMonth()+1; //January is 0!

		    var yyyy = today.getFullYear();
		    if(dd<10){
		        dd='0'+dd;
		    }
		    if(mm<10){
		        mm='0'+mm;
		    }
		    var today = dd+'/'+mm+'/'+yyyy;
		      a.download = 'Data Pasien' + dd +'-'+ mm +'-'+yyyy+ '.xls';
		      a.click();
		      location.reload();
		    });
	    $('#tgl_lahir').change(function(data){
	      var tgl_lahir=$(this).val().split('/');
	      var today = new Date();
	      var year = today.getFullYear();
	      var umur = year - tgl_lahir[2];
	      $('#umur').val(umur);
	    });
	    $('.status').change(function(data){
	      var stat= data.target.value;
	      var x = document.getElementById('pernikahan');
	      // console.log(stat);
	      if(stat=="Menikah"){
	              x.style.display = "block";
	      }
	      else{
	        x.style.display = "none";
	      }
	    });
	    var jk=$('.jk').val();
	    // console.log(jk);
	    if(jk == 'Laki-Laki'){
	        $('.suamiIstri').text("Istri");
	      }
	      else{
	        $('.suamiIstri').text("Suami");
	      }
	    $('.jk').change(function(data){
	      var jenis= data.target.value;
	      // console.log(jenis);
	      if(jenis == 'Laki-Laki'){
	        $('.suamiIstri').text("Istri");
	      }
	      else{
	        $('.suamiIstri').text("Suami");
	      }
	    });
	    $('#id_pasien').change(function(data){
	      var id = data.target.value;
	      var url = "<?php echo site_url('pasien/getPasienById');?>";
	      $.get(url + '/' + id, function(data) {
	        $('#nama').val(data.nama_pasien);
	        // $('#nama').attr('readonly',true);
	        $('#alamat').val(data.alamat);
	        $('#no_rm').val(data.no_rekam_medik);
	      }, "JSON");
	    });
	    $('#jenis_rawat').change(function(data){
	      var jenis=data.target.value;
	      if(jenis=="RAWAT JALAN"){
	        $('#ruangan').attr('disabled',true);
	        $('#bed').attr('disabled',true);
	      }
	      else{
	        $('#ruangan').attr('disabled',false);
	        $('#bed').attr('disabled',false);
	      }
	    });
	    $('#ruangan').change(function(data){
	      var id_kamar = data.target.value;
	      // console.log(id_kamar);
	      var url="<?php echo site_url('pasien/getEmptyBedByIdKamar');?>";
	      $.get(url+'/'+id_kamar,function(data){
	        if(data.length==0){
	          $('#bed').append("<option selected disabled class='text-danger'>Tidak Ada Bed yang Kosong</option>");
	        }
	        else{
	          $.each(data,function(i,data){

	            $('#bed').append("<option value='"+data.nomor_bed+"'>"+data.nomor_bed+"</option>");
	          // console.log(data.nomor_bed);
	        });
	        }
	      },"JSON")
	    });
	  });
	</script>
	<!-- End of ThaufiqUmardi's Script -->
