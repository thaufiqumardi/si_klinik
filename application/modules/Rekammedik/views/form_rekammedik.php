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
									<h3 class="box-title">Rekam Medik Pasien</h3>
								</div>

								<div class="box-body">
									<div class='row'>
										<div class='col-sm-12'>
											<div class="nav-tabs-custom">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#tab_riw" data-toggle="tab" id="tab_riwayat">Riwayat</a></li>
													<li><a href="#tab_res" data-toggle="tab" id="tab_resep">Resep Obat</a></li>
													<li><a href="#tab_tin" data-toggle="tab" id="tab_tindakan">Tindakan</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="tab_riw">
														<div class="row">
															<div  class="col-md-12">
																<div class="box box-primary box-solid">
																	<div class="box-header with-border">
																			<h3 class="box-title">Riwayat Pasien</h3>
																	</div>
																	<form method="POST"  class="formDokter form-horizontal" action="<?=site_url('rekammedik/form').'/'.$pasien->id_pasien.'/'.$pasien->no_registrasi;?>">
																		<div class="box-body">
																			<input type="hidden" class="ignoreDeletion" name="is_what" value="diagnosa" />
																			<input type="hidden" class="ignoreDeletion" name="no_reg"/>
																			<div class="row">
																				<div class="col-md-6">
																					<div class="form-group">
																						<label class="control-label col-md-3">No. Rekam Medik </label>
																						<div class="col-md-9">
																							<input type="text" name="no_izin_praktek" value="<?= $pasien->no_rm;?>" class="form-control" readonly >
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label col-md-3">No. Kartu</label>
																						<div class="col-md-9">
																							<input type="text" name="no_kartu" class="form-control" value="<?= $pasien->no_kartu;?>" readonly>
																						</div>
																					</div>

																					<div class="form-group">
																						<label class="control-label col-md-3">Nama Pasien</label>
																						<div class="col-md-9">
																							<input type="text" class="form-control" name="nama_pasien" value="<?= $pasien->nama_pasien;?>" readonly>
																						</div>
																					</div>

																					<div class="form-group">
																						<label class="control-label col-md-3">Tgl. Rekam Medik</label>
																						<div class="col-md-3">
																									<input type="text" name="tgl_rekam_medik" value="<?=$now;?>"  class="form-control" readonly/>
																						</div>
																					</div>

																					<div class="form-group">
																						<label class="control-label col-md-3">Dokter</label>
																						<div class="col-md-9">
																							<input type="text" class="form-control" value="<?= $pasien->nama_dokter;?>" name="dokter" readonly >
																							<input type="hidden" value="<?= $pasien->id_dokter;?>" name="id_dokter">
																						</div>
																					</div>

																					<div class="form-group">
																						<label class="control-label col-md-3">Tensi</label>
																						<div class="col-md-9">
																							<input type="text" class="form-control"  name="tensi" >
																						</div>
																					</div>

																				</div>

																				<div class="col-md-6">
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

																					<div class="form-group">
																						<label class="control-label col-md-3">Keluhan</label>
																						<div class="col-md-9">
																							<textarea class="form-control" name="keluhan" rows="2" required></textarea>
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label col-md-3">Anamnesa</label>
																						<div class="col-md-9">
																							<textarea class="form-control" name="anamnesa" rows="2" required></textarea>
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label col-md-3">Diagnosa</label>
																						<div class="col-md-9">
																							<textarea class="form-control" name="diagnosa" rows="2" required></textarea>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="box-footer">
																			<div class="pull-right">
																				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
																				<a href="<?= site_url('rekammedik');?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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
																							<th class="text-center">Tgl. Rekammedik</th>
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
																								<td>
																									<?= ++$key;?>
																								</td>
																								<!-- <td>
																									<?= $row->no_rm;?>
																								</td> -->
																								<!-- <td>
																									<?= $row->id_pasien;?>
																								</td> -->
																								<td>
																									<?= $row->nama_pasien;?>
																								</td>
																								<td>
																									<?= $row->nama_dokter;?>
																								</td>
																								<td>
																									<?= $row->tgl_rekam_medik;?>
																								</td>
																								<td>
																									<?= $row->tensi;?>
																								</td>
																								<td>
																									<?= $row->berat_badan;?>
																								</td>
																								<td>
																									<?= $row->tinggi_badan;?>
																								</td>
																								<td>
																									<?= $row->keluhan;?>
																								</td>
																								<td>
																									<?= $row->anamnesa;?>
																								</td>
																								<td>
																									<?= $row->diagnosa;?>
																								</td>
																								<td>
																									<a href="<?php echo site_url('rekammedik/hapus').'/'.$row->id_rekam_medik.'/'.$pasien->id_pasien.'/'.$pasien->no_registrasi;?>" class="btn btn-danger btn-xs" onClick="history.go(0)" ><i class="fa fa-trash" ></i> Hapus</a>
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
													<div class="tab-pane " id="tab_res">
														<div class="row">
															<div  class="col-md-12">
																<div class="box box-primary box-solid">
																	<div class="box-header with-border">
																			<h3 class="box-title">Resep Obat</h3>
																	</div>
																	<form  class="formDokter">
																		<div class="box-body">
																			<div class="row">
																				<div class="col-md-5">
																					<label class="control-label col-md-4">Nama Obat</label>
																					<div class="col-md-8">
																						<select class="form-control selectOption" name="id_obat[]" style="width:100%;">
																							<option value="">
																								- Pilih -
																							</option>
																							<?php foreach($obats as $obat):?>
																								<option value="<?= $obat->id_obat;?>"><?= $obat->nama_obat;?></option>
																							<?php endforeach;?>
																						</select>
																					</div>
																				</div>
																				<div class="col-md-5">
																					<label class="control-label col-md-3">Jumlah</label>
																					<div class="col-md-4">
																						<input type="text" name="jumlah_obat[]" class="form-control" required />
																					</div>
																					<div class="col-md-5">
																						<select class="form-control" name="satuan_obat[]" required>
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
																				<div class="col-md-2">
																					<button type="button" class="btn btn-warning" title="Tambah" id="btn_tambah_obat"><i class="fa fa-plus"></i></button>
																				</div>
																			</div>
																			<div id="wrapperObat">

																			</div>
																		</div>
																		<div class="box-footer">
																			<div class="pull-right">
																				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
																				<a href="<?= site_url('rekammedik');?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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
																			<!-- <th>
																				No
																			</th> -->
																			<th>
																				Tanggal
																			</th>
																			<th>
																				Nama Obat
																			</th>
																			<th>
																				Jumlah
																			</th>
																			<th>
																				Keterangan
																			</th>
																			<th>
																				Aksi
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php if(!empty($obat_by_paket)){
																			foreach($obat_by_paket as $key => $obat):?>
																			<tr>
																				<!-- <td>
																					<?= ++$key;?>
																				</td> -->
																				<td>
																					<?= date('d-M-Y',strtotime($obat->created_date));?>
																				</td>
																				<td>
																					<?= $obat->nama_item;?>
																				</td>
																				<td>
																					<?= 0;?>
																				</td>
																				<td>
																					<label class="label bg-gray">Dari Paket</label>
																				</td>
																				<td>
																					<button class="btn btn-xs btn-danger" disabled><i class="fa fa-trash"></i> Hapus</button>
																				</td>
																			</tr>
																		<?php endforeach;
																		}?>
																	</tbody>
																</table>
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
																	<form  class="formDokter">
																		<div class="box-body">
																			<div class="row">
																				<div class="col-md-5">
																					<label class="control-label col-md-4">Tindakan</label>
																					<div class="col-md-8">
																						<select class="form-control selectOption" name="id_obat[]" style="width:100%;">
																							<option value="">
																								- Pilih -
																							</option>
																							<?php foreach($obats as $obat):?>
																								<option value="<?= $obat->id_obat;?>"><?= $obat->nama_obat;?></option>
																							<?php endforeach;?>
																						</select>
																					</div>
																				</div>

																				<div class="col-md-2">
																					<button type="button" class="btn btn-warning" title="Tambah" id="btn_tambah_obat"><i class="fa fa-plus"></i></button>
																				</div>
																			</div>
																			<div id="wrapperObat">

																			</div>
																		</div>
																		<div class="box-footer">
																			<div class="pull-right">
																				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
																				<a href="<?= site_url('rekammedik');?>" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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
																			<!-- <th>
																				No
																			</th> -->
																			<th>
																				Tanggal
																			</th>
																			<th>
																				Nama Obat
																			</th>
																			<th>
																				Jumlah
																			</th>
																			<th>
																				Keterangan
																			</th>
																			<th>
																				Aksi
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php if(!empty($obat_by_paket)){
																			foreach($obat_by_paket as $key => $obat):?>
																			<tr>
																				<!-- <td>
																					<?= ++$key;?>
																				</td> -->
																				<td>
																					<?= date('d-M-Y',strtotime($obat->created_date));?>
																				</td>
																				<td>
																					<?= $obat->nama_item;?>
																				</td>
																				<td>
																					<?= 0;?>
																				</td>
																				<td>
																					<label class="label bg-gray">Dari Paket</label>
																				</td>
																				<td>
																					<button class="btn btn-xs btn-danger" disabled><i class="fa fa-trash"></i> Hapus</button>
																				</td>
																			</tr>
																		<?php endforeach;
																		}?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
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

				$('#mnMasterPegawai').addClass('active');
				$('#mnDokter').addClass('active');
				$('#example2').DataTable({
					"info":false,
				});
				$('#resetBtn').click(function() {
		        $('.formDokter').data('bootstrapValidator').resetForm(true);
		    });
		    	$("[data-mask]").inputmask();
		    	$('.datepicker').datepicker({
		           format:'dd/mm/yyyy',
		           todayHighlight:true,
		           containter:true,
		        });
		        $('.selectOption').select2();
		        $('#alert').delay(2000).fadeOut("slow");
			});
		</script>
