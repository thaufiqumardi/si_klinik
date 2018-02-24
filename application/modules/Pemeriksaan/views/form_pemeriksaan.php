<!DOCTYPE HTML>

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

						<h4><i class="icon fa fa-<?php echo ($msg['class'] == 0 ? 'ban' : 'check'); ?>"></i> <?php echo ($msg['class'] == 0 ? 'Gagal' : 'Berhasil!'); ?></h4>

						<?php

							if(isset($msg['msg'])){

								echo $msg['msg'];

							}

						?>

					</div>

					<?php

					}

					?><div class="row">

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

										<dt>No. Rekam Medik :</dt>

										<dd><?= $pasien->no_rm;?></dd>

										<dt>No. Pendaftaran :</dt>

										<dd><?= $pasien->no_registrasi;?></dd>

									</dl>

								</div>

								<div class="col-xs-6">

									<dl class="dl-horizontal">

										<dt>Nama :</dt>

										<dd><?= $pasien->nama_pasien;?></dd>

										<dt>Tanggal Daftar :</dt>

										<dd><?= date('d-M-Y', strtotime($pasien->tgl_registrasi));?></dd>

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

									<dt>Nama :</dt>

									<dd><?= $pasien->nama_dokter;?></dd>

								</dl>

							</div>

						</div>

					</div>

				</div>

					<!-- box widget 1 -->

					<div class="row">

						<div  class="col-md-12">

							<div class="box box-widget">

								<div class="box-header with-border">

									<h3 class="box-title">Formulir Pemeriksaan</h3>

									<div class="pull-right">

										

										<a href="<?=site_url('pemeriksaan');?>" class="btn btn-warning"><i class="fa fa-check"></i> Selesai</a>

									</div>

								</div>

								<div class="box-body">

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

															<form class="formPemeriksaan form-horizontal">

																<input type="hidden" class="ignoreDeletion" name="is_what" value="diagnosa" />

																<input type="hidden" class="ignoreDeletion" name="id_pasien" value="<?=$pasien->id_pasien;?>"/>

																<input type="hidden" class="ignoreDeletion" name="id_registrasi" value="<?=$pasien->id_registrasi;?>"/>

																<input type="hidden" class="ignoreDeletion" name="id_dokter" value="<?=$pasien->id_dokter;?>"/>

															<div class="row">

																<div  class="col-md-12">

																	<div class="box box-widget">

																		<!-- <div class="box-header with-border">

																				<h3 class="box-title">Diagnosa Pasien</h3>

																		</div> -->

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

																	<!-- <div class="box box-widget "> -->

																		<!-- <div class="box-body"> -->

																			<table id="tbl_diagnosa" style="border: 2" class="table table-bordered table-striped DataTable">

																				<thead>

																					<tr>

																						<th style="width: 5%;" class="text-center">No.</th>

																						<th class="text-center">Tanggal</th>

																						<th class="text-center">Tensi</th>

																						<th class="text-center">Berat</th>

																						<th class="text-center">Tinggi</th>

																						<th class="text-center">Keluhan</th>

																						<th class="text-center">Anamnesa</th>

																						<th class="text-center">Diagnosa</th>

																						<!-- <th style="width: 10%;" class="text-center">Aksi</th> -->

																					</tr>

																				</thead>

																				<tbody>



																				</tbody>

																			</table>

																		<!-- </div> -->

																	<!-- </div> -->

																</div>

															</div>

														</div>

														<div class="tab-pane " id="tab_tin">

															<div class="row">

																<div  class="col-md-12">

																	<div class="box box-widget">

																		<!-- <div class="box-header with-border">

																				<h3 class="box-title">Tindakan</h3>

																		</div> -->

																		<form class="formPemeriksaan form-horizontal">

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

																	<table class="table table-bordered table-striped" id="tbl_tindakan">

																		<thead>

																			<tr>

																				<th>No</th>

																				<th>Tanggal</th>

																				<th>Tindakan/Layanan</th>

																				<!-- <th>Aksi</th> -->

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

																	<div class="box box-widget">

																		<!-- <div class="box-header with-border">

																				<h3 class="box-title">Resep Obat</h3>

																		</div> -->

																		<form class="formPemeriksaan form-horizontal">

																			<div class="box-body">

																				<div class="row">

																					<div class="col-md-4">

																						<div class="form-group">

																						<label class="control-label col-md-4">Nama Obat</label>

																							<div class="col-md-7">

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

																					<div class="col-md-2">

																						<div class="form-group">

																						<label class="control-label col-md-4">Stok</label>

																							<div class="col-md-6">

																								<input type="text" class="form-control" name="stok[]">

																							</div>

																						</div>

																					</div>

																					<div class="col-md-4">

																						<div class="form-group">

																							<label class="control-label col-md-3">Jumlah</label>

																							<div class="col-md-3">

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

																		</form>

																	</div>

																</div>

															</div>

															<div class="row">

																<div class="col-md-12">

																	<table class="table table-bordered table-striped" id="tbl_resep">

																		<thead>

																			<tr>

																				<th>No.</th>

																				<th>Tanggal</th>

																				<th>Nama Obat</th>

																				<th>Jumlah</th>

																				<!-- <th>Aksi</th> -->

																			</tr>

																		</thead>

																		<tbody>



																		</tbody>

																	</table>

																</div>

															</div>

														</div>

													<!-- </form> -->

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

	function hapus(url,id,table){

				var conf = confirm("Hapus Data?");

				if(conf){

					var uri = url+id+table;

					$.ajax({

						url: uri,

						type:'DELETE',

						success:function(data){

							try {

								alert("Berhasil");

								window.location.reload();

							} catch (error) {

								alert("gagal");

							}

						}

					})

				}

				else{

					console.log("Tidak Jadi");

				}

			}



		$(document).ready(function(){

			var now = new Date();

			console.log(now);

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

			var tbl_diagnosa = $('#tbl_diagnosa').DataTable({

					// 'searching':false,

					'lengthChange':false,

					'ordering':false,

					'info':false,

					'retrieve':false,

				});

				var tbl_tindakan = $('#tbl_tindakan').DataTable({

					// 'searching':false,

					'lengthChange':false,

					'ordering':false,

					'info':false,

					'retrieve':false,

				});

				var tbl_resep = $('#tbl_resep').DataTable({

					// 'searching':false,

					'lengthChange':false,

					'ordering':false,

					'info':false,

					'retrieve':false,

				});

			var id_pasien = $("input[name='id_pasien']").val();

			var no_registrasi = "<?=$pasien->no_registrasi;?>";

			var is_what = $("input[name='is_what']");

			var iswhat_val = $("input[name='is_what']").val();

			$('#a_tab_riwayat').click(function(){is_what.val('diagnosa');});

			$('#a_tab_tindakan').click(function(){is_what.val('tindakan');});

			$('#a_tab_resep').click(function(){is_what.val('resep');});

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

					"<div class='row tambahTindakan'>"+

						"<div class='col-md-7'>"+

							"<div class='form-group'>"+

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

												"<div class='col-md-4'>"+

													"<div class='form-group'>"+

														"<label class='control-label col-md-4'></label>"+

														"<div class='col-md-7'>"+

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

												"<div class='col-md-2'>"+

													"<div class='form-group'>"+

													"<label class='control-label col-md-4'></label>"+

														"<div class='col-md-6'>"+

															"<input type='text' class='form-control'>"+

														"</div>"+

													"</div>"+

												"</div>"+

												"<div class='col-md-4'>"+

													"<div class='form-group'>"+

														"<label class='control-label col-md-3'></label>"+

														"<div class='col-md-3'>"+

															"<input type='text' name='jumlah_obat[]' class='form-control' />"+

														"</div>"+

														"<div class='col-md-5'>"+

															"<select class='form-control selectObat' name='satuan_obat[]' required>"+

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

				$('#wrapperObat').on("click","#btn_remove_Obat",function(e){

					e.preventDefault();

					$(this).closest('.divObat').remove();

				});

				$('.selectObat').select2();

				}

				else{

					alert("Maaf, Lengkapi masukan data obat sebelumnya sebelum menambahkan yang baru");

				}

			});

			setTableDiagnosa(id_pasien);

			setTableTindakan(id_pasien);

			setTableResep(id_pasien);

			function setTableDiagnosa(id_pasien){

				tbl_diagnosa.clear().draw();

				var url = "<?= site_url('Pemeriksaan/setTable');?>";

				var table_db = "pemeriksaan";



				$.get(url+'/'+table_db+'/'+id_pasien,function(data){

					 var ObjectData = data;

					 if(ObjectData ==null || ObjectData==''){

						 tbl_diagnosa.clear().draw();

					 } else {

						 var counter = 1;

						 for(var key in ObjectData){

							 if(ObjectData.hasOwnProperty(key)){

								var id_pemeriksaan = ObjectData[key]["id_pemeriksaan"];

								var url_hapus = "<?= site_url('Pemeriksaan/hapus').'/';?>";

								var table = "/pemeriksaan";

								var btn_hapus = '<a onclick="hapus(\''+url_hapus+'\',\''+id_pemeriksaan+'\',\''+table+'\');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>';

								 tbl_diagnosa.row.add([

									 counter++,

									 ObjectData[key]["tgl_pemeriksaan"],

									 ObjectData[key]["tensi"],

									 ObjectData[key]["berat_badan"],

									 ObjectData[key]["tinggi_badan"],

									 ObjectData[key]["keluhan"],

									 ObjectData[key]["anamnesa"],

									 ObjectData[key]["diagnosa"],

									//  btn_hapus

								 ]).draw(false);

							 }

						 }

					 }

				},"JSON");

			}

			function setTableTindakan(id_pasien){

				tbl_tindakan.clear().draw();



				var url = "<?= site_url('Pemeriksaan/setTable');?>";

				var table_db = "pemeriksaan_tindakan";

				$.get(url+'/'+table_db+'/'+id_pasien,function(data){

					 var ObjectData = data;

					 console.log(data);

					 if(ObjectData ==null || ObjectData==''){

						 tbl_tindakan.clear().draw();

					 } else {

						 var counter = 1;

						 for(var key in ObjectData){

							 if(ObjectData.hasOwnProperty(key)){

								var id_pemeriksaan = ObjectData[key]["id_pemeriksaan_tindakan"];

								var url_hapus = "<?= site_url('Pemeriksaan/hapus').'/';?>";

								var table = "/pemeriksaan_tindakan";

								var btn_hapus = '<a onclick="hapus(\''+url_hapus+'\',\''+id_pemeriksaan+'\',\''+table+'\');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>';

								 tbl_tindakan.row.add([

									 counter++,

									 ObjectData[key]["tgl_pemeriksaan"],

									 ObjectData[key]["nama_layanan"],

									//  btn_hapus

								 ]).draw(false);

							 }

						 }

					 }

				},"JSON");

			}

			function setTableResep(id_pasien){

				tbl_resep.clear().draw();



				var url = "<?= site_url('Pemeriksaan/setTable');?>";

				var table_db = "pemeriksaan_resep";

				$.get(url+'/'+table_db+'/'+id_pasien,function(data){

					 var ObjectData = data;

					 console.log(data);

					 if(ObjectData ==null || ObjectData==''){

						 tbl_resep.clear().draw();

					 } else {

						 var counter = 1;

						 for(var key in ObjectData){

							 if(ObjectData.hasOwnProperty(key)){

								var id_pemeriksaan = ObjectData[key]["id_pemeriksaan_resep"];

								var url_hapus = "<?= site_url('Pemeriksaan/hapus').'/';?>";

								var table = "/pemeriksaan_resep";

								var btn_hapus = '<a onclick="hapus(\''+url_hapus+'\',\''+id_pemeriksaan+'\',\''+table+'\');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>';

								 tbl_resep.row.add([

									 counter++,

									 ObjectData[key]["tgl_pemeriksaan"],

									 ObjectData[key]["nama_obat"],

									 ObjectData[key]["qty_obat"],

									//  btn_hapus

								 ]).draw(false);

							 }

						 }

					 }

				},"JSON");

			}

			$('.formPemeriksaan').submit(function(e){

				e.preventDefault();

				var isTrue = confirm("Setelah disimpan, data tidak bisa diubah atau dihapus. Anda yakin sudah mengisi data dengan benar?");

				if(isTrue){

					$.ajax({

					type:"post",

					url:"<?= site_url('Pemeriksaan/form');?>"+"/"+id_pasien+"/"+no_registrasi,

					cache:false,

					data:$('.formPemeriksaan').serialize(),

					success: function(data){

						try{

							alert("Data berhasil di simpan");

							// console.log(data);

							// var jumlahInputObat = document.getElementsByName('id_obat[]');

							// for(var i =0; i< jumlahInputObat.length;i++){

							// 	$('#btn_remove_obat').trigger('click');

							// }

							// var id_pasien = $("#no_registrasi").val();

							setTableDiagnosa(id_pasien);

							setTableTindakan(id_pasien);

							setTableResep(id_pasien);

							$('.formPemeriksaan  :input:not(".ignoreDeletion")').val('');

							$('.formPemeriksaan').find('option').removeAttr('disabled');

							$('.formPemeriksaan').find('select').val('');

							$("#successInfo").modal('show');

						}

						catch(e){

							alert("GAGAL");

						}

					}

				});

				} else{



				}

			});

		});

		</script>

