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
					<div id="alert" class="alert <?php echo ($msg['class'] == 0 ? 'alert-danger' : 'alert-success'); ?> alert-dismissible">
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
					<!-- box widget 1 -->
					<div class="row">
						<div  class="col-md-12">
							<div class="box box-widget">
								<div class="box-header with-border">
									<h3 class="box-title">Pemeriksaan Pasien</h3>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-md-8">
											<div class="box box-primary">
												<div class="box-header with-border">
													<h3 class="box-title">Data Pasien</h3>
													<div class="pull-right">
														No. Kartu: <?= $pasien->no_kartu;?>
													</div>
												</div>
												<div class="box-body">
													<div class="col-xs-6">
														<dl class="dl-horizontal">
															<dt>
																No. Rekam Medik :
															</dt>
															<dd>
																<?= $pasien->no_rm;?>
															</dd>
															<dt>
																No. Pendaftaran :
															</dt>
															<dd>
																<?= $pasien->no_registrasi;?>
															</dd>
														</dl>
													</div>
													<div class="col-xs-6">
														<dl class="dl-horizontal">
															<dt>
																Nama :
															</dt>
															<dd>
																<?= $pasien->nama_pasien;?>
															</dd>
															<dt>
																Tanggal Daftar :
															</dt>
															<dd>
																<?= $pasien->tgl_registrasi;?>
															</dd>
														</dl>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="box box-primary">
												<div class="box-header with-border">
													<h3 class="box-title">Data Dokter</h3>
												</div>
												<div class="box-body">
													<dl class="dl-horizontal">
														<dt >
															Nama :
														</dt>
														<dd>
															<?= $pasien->nama_dokter;?>
														</dd>
													</dl>
												</div>
											</div>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-12'>
											<div class="nav-tabs-custom">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#tab_riw" data-toggle="tab" id="a_tab_riwayat">Diagnosa</a></li>
													<li><a href="#tab_tin" data-toggle="tab" id="a_tab_tindakan">Tindakan / Layanan</a></li>
													<li><a href="#tab_res" data-toggle="tab" id="a_tab_resep">Resep Obat</a></li>
												</ul>
												<div class="tab-content">
														<div class="tab-pane active" id="tab_riw">
															<form method="POST"  class="formPemeriksaan form-horizontal" action="<?=site_url('Pemeriksaan/form').'/'.$pasien->id_pasien.'/'.$pasien->no_registrasi;?>">
																<input type="text" class="ignoreDeletion"  name="is_what" value="diagnosa" />
																<input type="text" class="ignoreDeletion" name="id_pasien" value="<?=$pasien->id_pasien;?>"/>
																<input type="text" class="ignoreDeletion" name="id_registrasi" value="<?=$pasien->id_registrasi;?>"/>
																<input type="text" class="ignoreDeletion" name="id_dokter" value="<?=$pasien->id_dokter;?>"/>
															<div class="row">
																<div  class="col-md-12">
																	<div class="box box-primary box-solid">
																		<div class="box-header with-border">
																				<h3 class="box-title">Diagnosa Pasien</h3>
																		</div>
																			<div class="box-body">
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group">
																							<label class="control-label col-md-3">Tensi</label>
																							<div class="col-md-9">
																								<input type="text" class="form-control"  name="tensi" data-inputmask='"mask": "999/99"' data-mask >
																							</div>
																						</div>
																						<div class="form-group">
																							<label class="control-label col-md-3">Berat Badan</label>
																							<div class="col-md-9">
																								<input type="text" class="form-control"  name="berat_badan" placeholder="(Kg)">
																							</div>
																						</div>
																						<div class="form-group">
																							<label class="control-label col-md-3">Tinggi Badan</label>
																							<div class="col-md-9">
																								<input type="text" class="form-control"  name="tinggi_badan" placeholder="(Cm)">
																							</div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group">
																							<label class="control-label col-md-3">Keluhan</label>
																							<div class="col-md-9">
																								<textarea class="form-control" name="keluhan" rows="2" ></textarea>
																							</div>
																						</div>
																						<div class="form-group">
																							<label class="control-label col-md-3">Anamnesa</label>
																							<div class="col-md-9">
																								<textarea class="form-control" name="anamnesa" rows="2" ></textarea>
																							</div>
																						</div>
																						<div class="form-group">
																							<label class="control-label col-md-3">Diagnosa</label>
																							<div class="col-md-9">
																								<textarea class="form-control" name="diagnosa" rows="2" ></textarea>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="box-footer">
																				<div class="pull-right">
																					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
																					<a href="<?= site_url('Pemeriksaan');?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
															<div class="row">
																<div  class="col-md-12">
																	<div class="box box-widget ">
																		<?php
																			if(empty($riwayats)){
																				?>
																				<div class="box-body">
																					<div class="alert bg-warning text-center">
																						<p>
																							Belum Ada Riwayat
																						</p>
																					</div>
																				</div>
																				<?php
																			}
																			else{
																				?>
																				<div class="box-body">
																					<table id="example2" style="border: 2" class="table table-bordered table-striped DataTable">
																						<thead>
																							<tr>
																								<th style="width: 5%;" class="text-center">No.</th>
																								<!-- <th class="text-center">No. Rekam Medik</th> -->
																								<!-- <th class="text-center">No. Kartu</th> -->
																								<th class="text-center">Nama Pasien</th>
																								<th class="text-center">Dokter</th>
																								<th class="text-center">Tanggal</th>
																								<th class="text-center">Tensi</th>
																								<th class="text-center">Berat</th>
																								<th class="text-center">Tinggi</th>
																								<th class="text-center">Keluhan</th>
																								<th class="text-center">Anamnesa</th>
																								<th class="text-center">Diagnosa</th>
																								<th style="width: 10%;" class="text-center">Aksi</th>
																							</tr>
																						</thead>
																						<tbody>
																							<?php foreach ($riwayats as $key => $row):?>
																								<tr>
																									<td><?= ++$key;?></td>
																									<td><?= $row->nama_pasien;?></td>
																									<td><?= $row->nama_dokter;?></td>
																									<td><?= $row->tgl_pemeriksaan;?></td>
																									<td><?= $row->tensi;?></td>
																									<td><?= $row->berat_badan;?></td>
																									<td><?= $row->tinggi_badan;?></td>
																									<td><?= $row->keluhan;?></td>
																									<td><?= $row->anamnesa;?></td>
																									<td><?= $row->diagnosa;?></td>
																									<td>
																										<a href="<?php echo site_url('Pemeriksaan/hapus').'/'.$row->id_pemeriksaan.'/'.$pasien->id_pasien.'/'.$pasien->no_registrasi;?>" class="btn btn-danger btn-xs" onClick="history.go(0)" ><i class="fa fa-trash" ></i> Hapus</a>
																									</td>
																								</tr>
																							<?php endforeach;?>
																						</tbody>
																					</table>
																				</div>
																				<?php
																			}
																		 ?>
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane " id="tab_tin">
															<div class="row">
																<div  class="col-md-12">
																	<div class="box box-primary box-solid">
																		<div class="box-header with-border">
																				<h3 class="box-title">Tindakan</h3>
																		</div>
																		<form method="POST"  class="formPemeriksaan form-horizontal" action="<?=site_url('Pemeriksaan/form').'/'.$pasien->id_pasien.'/'.$pasien->no_registrasi;?>">
																		<input type="hidden" class="ignoreDeletion"  name="is_what" />
																		<input type="hidden" class="ignoreDeletion" name="id_pasien" value="<?=$pasien->id_pasien;?>"/>
																		<input type="hidden" class="ignoreDeletion" name="id_registrasi" value="<?=$pasien->id_registrasi;?>"/>
																		<input type="hidden" class="ignoreDeletion" name="id_dokter" value="<?=$pasien->id_dokter;?>"/>
																			<div class="box-body">
																				<div class="row">
																					<div class="col-md-7">
																						<div class="form-group">
																							<label class="control-label col-md-4">Tindakan / Layanan</label>
																							<div class="col-md-8">
																								<select class="form-control selectOption" name="id_layanan[]" style="width:100%;">
																									<option value="" selected disabled>
																										- Pilih -
																									</option>
																									<?php foreach($layanans as $layanan):?>
																										<option value="<?= $layanan->id_layanan;?>"><?= $layanan->nama_layanan;?></option>
																									<?php endforeach;?>
																								</select>
																							</div>
																						</div>
																					</div>
																					<div class="col-md-2">
																						<button type="button" class="btn btn-warning" title="Tambah" id="btnTambahTindakan"><i class="fa fa-plus"></i></button>
																					</div>
																				</div>
																				<div id="wrapperTindakan">

																				</div>
																			</div>
																			<div class="box-footer">
																				<div class="pull-right">
																					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
																					<a href="<?= site_url('Pemeriksaan');?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<table class="table table-bordered table-striped" id="tbl_data_obat">
																		<thead>
																			<tr>
																				<th>Tanggal</th>
																				<th>Nama Obat</th>
																				<th>Jumlah</th>
																				<th>Keterangan</th>
																				<th>Aksi</th>
																			</tr>
																		</thead>
																		<tbody>

																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="tab-pane " id="tab_res">
															<div class="row">
																<div  class="col-md-12">
																	<div class="box box-primary box-solid">
																		<div class="box-header with-border">
																				<h3 class="box-title">Resep Obat</h3>
																		</div>
																		<form method="POST"  class="formPemeriksaan form-horizontal" action="<?=site_url('Pemeriksaan/form').'/'.$pasien->id_pasien.'/'.$pasien->no_registrasi;?>">
																		<input type="text" class="ignoreDeletion"  name="is_what" value="diagnosa" />
																		<input type="text" class="ignoreDeletion" name="id_pasien" value="<?=$pasien->id_pasien;?>"/>
																		<input type="text" class="ignoreDeletion" name="id_registrasi" value="<?=$pasien->id_registrasi;?>"/>
																		<input type="text" class="ignoreDeletion" name="id_dokter" value="<?=$pasien->id_dokter;?>"/>
																			<div class="box-body">
																				<div class="row">
																					<div class="col-md-5">
																						<div class="form-group">
																						<label class="control-label col-md-4">Nama Obat</label>
																							<div class="col-md-8">
																								<select class="form-control selectOption" name="id_obat[]" style="width:100%;">
																									<option value="" selected disabled>
																										- Pilih -
																									</option>
																									<?php foreach($obats as $obat):?>
																										<option value="<?= $obat->id_obat;?>"><?= $obat->nama_obat;?></option>
																									<?php endforeach;?>
																								</select>
																							</div>
																						</div>	
																					</div>
																					<div class="col-md-5">
																						<div class="form-group">
																							<label class="control-label col-md-3">Jumlah</label>
																							<div class="col-md-4">
																								<input type="text" name="jumlah_obat[]" selected class="form-control"/>
																							</div>
																							<div class="col-md-5">
																								<select class="form-control selectOption" style="width:100%;" name="satuan_obat[]" selected >
																									<option value="">
																										- Pilih Satuan -
																									</option>
																									<?php foreach($satuans as $satuan):?>
																										<option value="<?= $satuan->satuan_id;?>">
																											<?= $satuan->satuan_nama;?>
																										</option>
																									<?php endforeach;?>
																								</select>
																							</div>
																						</div>
																					</div>
																					<div class="col-md-2">
																						<div class="form-group">
																							<button type="button" class="btn btn-warning" title="Tambah" id="btnTambahObat"><i class="fa fa-plus"></i></button>
																						</div>
																					</div>
																				</div>
																				<div id="wrapperObat">

																				</div>
																			</div>
																			<div class="box-footer">
																				<div class="pull-right">
																					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
																					<a href="<?= site_url('Pemeriksaan');?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
																				</div>
																			</div>
																		<!-- </form> -->
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<table class="table table-bordered table-striped" id="tbl_data_obat">
																		<thead>
																			<tr>
																				<th>Tanggal</th>
																				<th>Nama Obat</th>
																				<th>Jumlah</th>
																				<th>Keterangan</th>
																				<th>Aksi</th>
																			</tr>
																		</thead>
																		<tbody>

																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- akhir box widget 1 -->
			</section>
		</div>
<?php $this->load->view('template/v_copyright'); ?>
</body>
<?php $this->load->view('template/v_footer'); ?>
<!-- Script		 -->
	<script type="text/javascript">
			$(document).ready(function(){
				$('#mnPemeriksaan').addClass('active');
				$('#mnDokter').addClass('active');
				$('#example2').DataTable({
					"info":false,
				});
		    $("[data-mask]").inputmask();
		    $('.datepicker').datepicker({
		      format:'dd/mm/yyyy',
		      todayHighlight:true,
		      containter:true,
		    });
		    $('.selectOption').select2();
		    $('#alert').delay(2000).fadeOut("slow");
				
				var is_what = $("input[name='is_what']");
				$('#a_tab_riwayat').click(function(){
					is_what.val('diagnosa');
				});
				$('#a_tab_tindakan').click(function(){
					is_what.val('tindakan');
				});
				$('#a_tab_resep').click(function(){
					is_what.val('resep');
				});
				$('#btnTambahTindakan').click(function(){
					var isTindakan = false;
					var inputLayanan = document.getElementsByName('id_layanan[]');
					for(var i=0;i<inputLayanan.length;i++){
						var valLayanan = inputLayanan[i];
						if(valLayanan.value==null || valLayanan.value==''){
							isTindakan = false;
							alert("Mohon Pilih Tindakan Sebelum Menambahkan Yang Baru");
						}
						else{
							isTindakan = true;
						}
					}
					if(isTindakan==true){
						var select =
						"<div class='row tambahTindakan' style='margin-top:10px;'>"+
							"<div class='col-md-7'>"+
								"<label class='control-label col-md-4'></label>"+
								"<div class='col-md-8'>"+
									"<select class='form-control selectTindakan' name='id_layanan[]' style='width:100%;'>"+
										"<option value='' selected disabled>"+
											"- Pilih -"+
										"</option>"+
										<?php foreach($layanans as $layanan):?>
											"<option value='<?= $layanan->id_layanan;?>'><?= $layanan->nama_layanan;?></option>"+
										<?php endforeach;?>
									"</select>"+
								"</div>"+
							"</div>"+
							"<div class='col-md-2'>"+
								"<button type='button' class='btn btn-danger' id='btnRemoveTindakan' title='Hapus'><i class='fa fa-trash'></i></button>"+
							"</div>"+
						"</div>";
						$('#wrapperTindakan').append(select);
						$('.selectTindakan').select2();
						$('#wrapperTindakan').on("click","#btnRemoveTindakan",function(e){
							e.preventDefault();
							$(this).closest('.tambahTindakan').remove();
						});
					}
				});
				$('#btnTambahObat').click(function(){
					var isNamaObat		= false;
					var isJumlahObat	= false;
					var isSatuanObat	= false

					var inputNamaObat 	= document.getElementsByName('id_obat[]');
					var inputJumlahObat = document.getElementsByName('jumlah_obat[]');
					var inputSatuanObat = document.getElementsByName('satuan_obat[]');

					for(var i=0; i < inputNamaObat.length;i++){
						var valNamaObat	= inputNamaObat[i];
						if(valNamaObat.value==null || valNamaObat.value ==''){
							isNamaObat = false;
						} else {
							isNamaObat = true;
						}
					}
					
					for(var i=0; i < inputJumlahObat.length; i++){
						var valJumlahObat = inputJumlahObat[i];
						if(valJumlahObat.value == null || valJumlahObat == ''){
							isJumlahObat = false;
						} else {
							isJumlahObat = true;
						}
					}

					for(var i=0; i < inputSatuanObat.length; i++){
						var valSatuanObat = inputSatuanObat[i];
						if(valSatuanObat.value==null || valSatuanObat.value ==''){
							isSatuanObat = false;
						} else {
							isSatuanObat = true;
						}
					}

					if(isNamaObat==true && isJumlahObat == true && isSatuanObat==true){
						var tambah ="<div class='row divObat'>"+
													"<div class='col-md-5'>"+
														"<div class='form-group'>"+
															"<label class='control-label col-md-4'></label>"+
															"<div class='col-md-8'>"+
																"<select class='form-control selectObat' name='id_obat[]' style='width:100%;'>"+
																	"<option selected disabled value=''>"+
																		"- Pilih -"+
																	"</option>"+
																	<?php foreach($obats as $obat):?>
																		"<option value='<?= $obat->id_obat;?>'><?= $obat->nama_obat;?></option>"+
																	<?php endforeach;?>
																"</select>"+
															"</div>"+
														"</div>"+
													"</div>"+
													"<div class='col-md-5'>"+
														"<div class='form-group'>"+
															"<label class='control-label col-md-3'></label>"+
															"<div class='col-md-4'>"+
																"<input type='text' name='jumlah_obat[]' class='form-control' />"+
															"</div>"+
															"<div class='col-md-5'>"+
																"<select class='form-control' name='satuan_obat[]' required>"+
																"<option selected disabled value=''>-Pilih Satuan-</option>"+
																	<?php foreach($satuans as $satuan):?>
																		"<option value='<?= $satuan->satuan_id;?>'><?= $satuan->satuan_nama;?></option>"+
																	<?php endforeach;?>
																"</select>"+
															"</div>"+
														"</div>"+
													"</div>"+
													"<div class='col-md-2'>"+
														"<div class='form-group'>"+
															"<button type='button' class='btn btn-danger' id='btn_remove_Obat' title='Hapus'><i class='fa fa-trash'></i></button>"+
														"</div>"+
													"</div>"+
												"</div>";
					$('#wrapperObat').append(tambah);
					$('#wrapperObat').on("click","#btn_remove_obat",function(e){
						e.preventdefault();
						$(this).closest('.divObat').remove();
					});
					$('.selectObat').select2();
					}
					else{
						alert("Maaf, Lengkapi masukan data obat sebelumnya sebelum menambahkan yang baru");
					}
				});
			});
		</script>
