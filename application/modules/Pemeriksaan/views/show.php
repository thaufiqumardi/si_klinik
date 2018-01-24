<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$menusid = $this->M_crud->get_by_param("menu", 'name', "Pemeriksaan");
if(!empty($menusid)){
	$akses = $this->M_crud->get_select_to_row('hak_akses_create, hak_akses_update, hak_akses_delete', 'hak_akses', null, null, 'hak_akses_role', $this->session->userdata['simklinik']['ap_role'], 'hak_akses_menu', $menusid->id_menu);
	if(count($akses) == 0)
	{
		$mnCreate = 0;
		$mnUpdate = 0;
		$mnDelete = 0;
	}else{
		$mnCreate = $akses->hak_akses_create;
		$mnUpdate = $akses->hak_akses_update;
		$mnDelete = $akses->hak_akses_delete;
	}
}else{
	$mnCreate = 0;
	$mnUpdate = 0;
	$mnDelete = 0;
}
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
							<?php echo $msg['msg']. ucfirst($msg['data']) ; ?>
					</div>
					<?php
				}
				?>
    			<div class="box box-widget">
					<div class="box-header with-border">
					  <h3 class="box-title">Form Pemeriksaan</h3>
					</div>
					<div class="box-body">
						<div class='row'>
							<div class='col-sm-3'>
								<div class="panel panel-primary">
									<div class="panel-heading">
										<i class='fa fa-file-text-o fa-fw'></i> Informasi Pasien
									</div>
									<div class="panel-body">
										<div class="form-horizontal">
											<div class="form-group informasi-kasir-noreg">
												<label class="col-sm-4 informasi-kasir-noreg control-label">No. Reg / Antrian</label>
												<div class="col-sm-8">
													<select name="no_registrasi" id="no_registrasi" class="form-control selectOption">
						                       		<option disabled selected value = ''>- Pilih -</option>
						                             <?php foreach ($registered_pasiens as $pasien):?>
																					 <option value='<?= $pasien->no_registrasi;?>'><?= $pasien->no_antrian.'/'.$pasien->no_registrasi.'/'.$pasien->no_rm;?></option>
																				 <?php endforeach;?>
							                        </select>
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-md-4 informasi-kasir control-label">Tgl. Registrasi</label>
												<div class="col-md-8">
													<input type='text' name='tgl_registrasi' class='form-control informasi-kasir' id='tgl_registrasi;' disabled="disabled">
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">No. RM</label>
												<div class="col-sm-8">
													<input type='text' name='no_rm' class='form-control input-sm informasi-kasir' id='no_rm' disabled="disabled">
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">Nama</label>
												<div class="col-sm-8">
													<input type='text' name='nama_pasien' class='form-control input-sm informasi-kasir' id='nama_pasien' disabled="disabled">
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">JK</label>
												<div class="col-sm-8">
													<input type='text' name='jk_pasien' class='form-control input-sm informasi-kasir' id='jk_pasien' disabled="disabled">
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">Umur</label>
												<div class="col-sm-8">
													<input type='text' name='umur_pasien' class='form-control input-sm informasi-kasir' id='umur_pasien' disabled="disabled">
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">Gol. Darah</label>
												<div class="col-sm-8">
													<input type='text' name='gol_darah' class='form-control input-sm informasi-kasir' id='gol_darah' disabled="disabled">
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">Alamat</label>
												<div class="col-sm-8">
													<input type='text' name='alamat_pasien' class='form-control input-sm informasi-kasir' id='alamat_pasien' disabled="disabled">
												</div>
											</div>
											<div class="pull-right">
												<a href="<?= site_url('pemeriksaan');?>" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Reset</a>
											</div>
										</div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-heading">
										<i class='fa fa-file-text-o fa-fw'></i> Informasi Dokter
									</div>
									<div class="panel-body">
										<div class="form-horizontal">
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">Dokter</label>
												<div class="col-sm-8">
													<input type='text' name='nama_dokter' class='form-control input-sm informasi-kasir' id='nama_dokter' disabled="disabled">
												</div>
											</div>
											<div class="form-group informasi-kasir">
												<label class="col-sm-4 informasi-kasir control-label">Jenis Rawat</label>
												<div class="col-sm-8">
													<input type='text' name='jenis_rawat' class='form-control input-sm informasi-kasir' id='jenis_rawat' disabled="disabled">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class='col-sm-9'>
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab_tindakan" data-toggle="tab">Penyakit/ Tindakan</a></li>
										<li><a href="#tab_obat" data-toggle="tab">Resep Obat</a></li>
										<li><a href="#tab_Obsterti" data-toggle="tab">Riwayat Obsterti</a></li>
										<li><a href="#tab_Observasi" data-toggle="tab">Observasi Kala I</a></li>
										<li><a href="#tab_Kala1" data-toggle="tab">Kala I</a></li>
										<li><a href="#tab_Kala2" data-toggle="tab">Kala II</a></li>
										<li><a href="#tab_kala3" data-toggle="tab">Kala III</a></li>
										<li><a href="#tab_pasca" data-toggle="tab">Pasca Persalinan</a></li>
										<li><a href="#tab_status" data-toggle="tab">Status Pasien</a></li>
										<li><a href="#tab_resume" data-toggle="tab">Resume Medis</a></li>
									</ul>
									<div class="tab-content form-panel">
										<div class="tab-pane active" id="tab_tindakan">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Penyakit/ Tindakan</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<input type="hidden" name="is_what" value="diagnosa" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-2 control-label">Kode ICD</label>
																		<div class="col-sm-4">
																			<select class="form-control selectOption" name="id_diagnosa" id="id_diagnosa" required="required">
																				<option disabled selected>
																					- Pilih -
																				</option>
																			<?php foreach($diagnosa as $row):?>
																				<option value="<?= $row->id_diagnosa;?>">
																					<?= $row->kode_icd;?>
																				</option>
																			<?php endforeach;?>
																			</select>

																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Diagnosa/Tindakan</label>
																		<div class="col-sm-10">
																			<textarea name="nama_tindakan" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_obat">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Resep Obat</h3>
															<div class="pull-right">

															</div>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<input type="hidden" name="is_what" value="Resep Obat" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<input type="hidden" name="tgl_registrasi" />
																<div class="row">
																	<div class="col-md-6">
																		<label class="control-label col-md-4">Nama Obat</label>
																		<div class="col-md-8">
																			<select class="form-control selectOption" data-placeholder="- Pilih -" name="id_obat[]" style="width:100%;">
																				<option selected disabled value="">
																					- Pilih -
																				</option>
																				<?php foreach($obats as $obat):?>
																					<option value="<?= $obat->id_obat;?>"><?= $obat->nama_obat;?></option>
																				<?php endforeach;?>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<label class="control-label col-md-3">Jumlah</label>
																		<div class="col-md-9	">
																			<input type="text" name="jumlah_obat[]" class="form-control" />
																		</div>
																	</div>
																	<div class="col-md-2">
																		<button type="button" class="btn btn-warning" title="Tambah" id="btn_tambah_obat"><i class="fa fa-plus"></i></button>
																	</div>
																</div>
																<div id="wrapperObat">

																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_Obsterti">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Riwayat Obsterti</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<input type="hidden" name="is_what" value="Riwayat Obsterti" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tanggal</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_obsterti" class="form-control datepicker" data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____"  />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Jam</label>
																		<div class="col-sm-4">
																			<input type="text" name="jam_obsterti" id="jam_obsterti" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Dikirim Oleh</label>
																		<div class="col-sm-9">
																			<input type="text" name="pengirim_obsterti" class="form-control"/>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Keluhan Utama</label>
																		<div class="col-sm-9">
																			<textarea name="keluhan_obsterti" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Kehamilan</label>
																		<div class="col-sm-9">
																			<textarea name="kehamilan_obsterti" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Partus</label>
																		<div class="col-sm-9">
																			<textarea name="partus_obsterti" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Hasil Kehamilan</label>
																		<div class="col-sm-9">
																			<textarea name="hasil_kehamilan_obsterti" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Jenis Persalinan</label>
																		<div class="col-sm-9">
																			<textarea name="jenis_persalinan_obsterti" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Penyulit Anak</label>
																		<div class="col-sm-9">
																			<textarea name="keterangan_penyulit_obsterti" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_Observasi">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Observasi Kala I</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<input type="hidden" name="is_what" value="Observasi Kala 1" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tanggal Masuk</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_masuk_observasi_kala" id="tgl_masuk_observasi_kala" class="form-control datepicker" required data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____"  />
																			<!-- <select class="form-control" name="tgl_masuk_observasi_kala" id="tgl_masuk_observasi_kala" required="required"> -->
																			<!-- </select> -->
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Jam Masuk</label>
																		<div class="col-sm-4">
																			<input type="text" name="jam_masuk_observasi_kala" id="jam_masuk_observasi_kala" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																			<!-- <select class="form-control" name="jam_masuk_observasi_kala" id="jam_masuk_observasi_kala" required="required">
																			</select> -->
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top:10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tanggal</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_observasi_kala" id="tgl_observasi_kala" class="form-control datepicker" required  data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Jam</label>
																		<div class="col-sm-4">
																			<input type="text" name="jam_observasi_kala" id="jam_observasi_kala" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />

																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">BJA</label>
																		<div class="col-sm-9">
																			<textarea name="bja_observasi_kala" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">HIS</label>
																		<div class="col-sm-9">
																			<textarea name="his_observasi_kala" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pemeriksaan</label>
																		<div class="col-sm-9">
																			<textarea name="pemeriksaan_observasi_kala" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Dalam</label>
																		<div class="col-sm-9">
																			<textarea name="dalam_observasi_kala" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Penyulit/Tindakan</label>
																		<div class="col-sm-9">
																			<textarea name="tindakan_observasi_kala" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Keterangan</label>
																		<div class="col-sm-9">
																			<textarea name="keterangan_observasi_kala" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_Kala1">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Kala I</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<input type="hidden" name="is_what" value="Kala 1" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tanggal</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_kala1" id="tgl_kala1" class="form-control datepicker" required data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____" />

																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Jam</label>
																		<div class="col-sm-4">
																			<input type="text" name="jam_kala1" id="jam_kala1" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Komplikasi</label>
																		<div class="col-sm-9">
																			<textarea name="komplikasi_kala1" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Terapi</label>
																		<div class="col-sm-9">
																			<textarea name="terapi_kala1" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tindakan</label>
																		<div class="col-sm-9">
																			<textarea name="tindakan_kala1" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_Kala2">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Kala II</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<input type="hidden" name="is_what" value="Kala 2" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tanggal</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_kala2" id="tgl_kala2" class="form-control datepicker" required data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Jam</label>
																		<div class="col-sm-4">
																			<input type="text" name="jam_kala2" id="jam_kala2" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Komplikasi</label>
																		<div class="col-sm-9">
																			<textarea name="komplikasi_kala2" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Terapi</label>
																		<div class="col-sm-9">
																			<textarea name="terapi_kala2" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tindakan</label>
																		<div class="col-sm-9">
																			<textarea name="tindakan_kala2" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Jenis Persalinan</label>
																		<div class="col-sm-9">
																			<input type="text" name="jenis_persalinan" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Anak Lahir</label>
																		<div class="col-sm-9">
																			<input type="text" name="anak_lahir" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tgl. Lahir</label>
																		<div class="col-sm-9">
																			<input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datepicker" required data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Jam Lahir</label>
																		<div class="col-sm-9">
																			<input type="text" name="jam_lahir" class="form-control" required="required" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Jenis Kelamin</label>
																		<div class="col-sm-9">
																			<input type="text" name="jenis_kelamin" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Panjang</label>
																		<div class="col-sm-9">
																			<input type="text" name="panjang" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Berat Badan</label>
																		<div class="col-sm-9">
																			<input type="text" name="berat_badan" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Cacat/Meserasi</label>
																		<div class="col-sm-9">
																			<input type="text" name="cacat_persalinan" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Dapat/Tidak Oksigen</label>
																		<div class="col-sm-9">
																			<input type="text" name="oksigen_persalinan" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_kala3">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Kala III</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<input type="hidden" name="is_what" value="Kala 3" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tanggal</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_kala3" id="tgl_kala3" class="form-control datepicker" required data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Jam</label>
																		<div class="col-sm-4">
																			<input type="text" name="jam_kala3" id="jam_kala3" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																			<!-- <select class="form-control" name="jam_kala3" id="jam_kala3" required="required">
																			</select> -->
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Placenta</label>
																		<div class="col-sm-9">
																			<textarea name="placenta_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Komplikasi</label>
																		<div class="col-sm-9">
																			<textarea name="komplikasi1_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tindakan</label>
																		<div class="col-sm-9">
																			<textarea name="tindakan1_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pendarahan</label>
																		<div class="col-sm-9">
																			<textarea name="pendarahan_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Komplikasi</label>
																		<div class="col-sm-9">
																			<textarea name="komplikasi2_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tindakan</label>
																		<div class="col-sm-9">
																			<textarea name="tindakan2_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pericum</label>
																		<div class="col-sm-9">
																			<textarea name="perincum_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tingkat</label>
																		<div class="col-sm-9">
																			<textarea name="tingkat_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tindakan</label>
																		<div class="col-sm-9">
																			<textarea name="tindakan3_kala3" class="form-control"></textarea>
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_pasca">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Pasca Persalinan</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<h4 class="box-title">Keadaan Pasca Persalinan</h4>
																<div class="row">
																	<input type="hidden" name="is_what" value="Pasca Persalinan" />
																	<input type="hidden" name="no_reg"/>
																	<input type="hidden" name="no_rm"/>
																	<input type="hidden" name="id_reg"/>
																	<input type="hidden" name="antri" />
																	<input type="hidden" name="pasien" />
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Keadaan Umum</label>
																		<div class="col-sm-9">
																			<textarea name="keadaan" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tensi</label>
																		<div class="col-sm-9">
																			<input type="text" name="tensi" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Nadi</label>
																		<div class="col-sm-9">
																			<input type="text" name="nadi" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pernapasan</label>
																		<div class="col-sm-9">
																			<input type="text" name="pernapasan" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Suhu</label>
																		<div class="col-sm-9">
																			<input type="text" name="suhu" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tinggi Uterus</label>
																		<div class="col-sm-9">
																			<input type="text" name="tinggi_uterus" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Kontraksi</label>
																		<div class="col-sm-9">
																			<input type="text" name="kontraksiurine" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Urine</label>
																		<div class="col-sm-9">
																			<input type="text" name="urine" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<h4 class="box-title">Keadaan Anak</h4>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Anak Lahir</label>
																		<div class="col-sm-9">
																			<input type="text" name="keadaan_anak" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tgl. Lahir</label>
																		<div class="col-sm-9">
																			<input type="text" name="tgl_lahir" class="form-control datepicker" data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____"  />
																			<!-- <input type="text" name="tgl_lahir" class="form-control" required="required" /> -->
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Jam Lahir</label>
																		<div class="col-sm-9">
																			<input type="text" name="jam_lahir" id="jam_lahir" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																			<!-- <input type="text" name="jam_lahir" class="form-control" required="required" /> -->
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Berat</label>
																		<div class="col-sm-9">
																			<input type="text" name="berat" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Panjang</label>
																		<div class="col-sm-9">
																			<input type="text" name="panjang" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pronto Occiputa</label>
																		<div class="col-sm-9">
																			<input type="text" name="pronto" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Subento Bregm</label>
																		<div class="col-sm-9">
																			<input type="text" name="subento" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Suboccid Bregm</label>
																		<div class="col-sm-9">
																			<input type="text" name="suboccid" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Cacat Maserasi</label>
																		<div class="col-sm-9">
																			<input type="text" name="cacat_maserasi" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">APGAR</label>
																		<div class="col-sm-9">
																			<input type="text" name="apgar" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Dapat/Tidak Oksigen</label>
																		<div class="col-sm-9">
																			<input type="text" name="oksigen" class="form-control" required="required" />
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-3 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_status">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Status Pasien</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
															<div class="box-body">
																<h4 class="box-title">Status Praesens</h4>
																<input type="hidden" name="is_what" value="Status Pasien" />
																<input type="hidden" name="no_reg"/>
																<input type="hidden" name="no_rm"/>
																<input type="hidden" name="id_reg"/>
																<input type="hidden" name="antri" />
																<input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Jam</label>
																		<div class="col-sm-4">
																			<input type="text" name="jam" id="jam" required class="form-control" data-mask data-inputmask='"mask":"99:99"' placeholder="00:00" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Keadaan Umum</label>
																		<div class="col-sm-9">
																			<textarea name="keadaan_umum" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tensi</label>
																		<div class="col-sm-9">
																			<textarea name="tensi" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Nadi</label>
																		<div class="col-sm-9">
																			<textarea name="nadi" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Suhu</label>
																		<div class="col-sm-9">
																			<textarea name="suhu" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pernapasan</label>
																		<div class="col-sm-9">
																			<textarea name="pernapasan" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<h4 class="box-title">Pemeriksaan Luar</h4>

																<div class="row">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Fundus Uteri</label>
																		<div class="col-sm-9">
																			<textarea name="fundus_uteri" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Lingkaran Perut</label>
																		<div class="col-sm-9">
																			<textarea name="lingkaran_perut" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Letak Anak</label>
																		<div class="col-sm-9">
																			<textarea name="letak_anak" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Bunyi Jantung Anak</label>
																		<div class="col-sm-9">
																			<textarea name="bunyi_jantung_anak" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">HIS</label>
																		<div class="col-sm-9">
																			<textarea name="his" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<h4 class="box-title">Pemeriksaan Dalam</h4>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Inspeculo</label>
																		<div class="col-sm-9">
																			<textarea name="inspeculo" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top:10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Vulva/Vagina</label>
																		<div class="col-sm-9">
																			<textarea name="vulva" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Portio</label>
																		<div class="col-sm-9">
																			<textarea name="portio" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pembukaan</label>
																		<div class="col-sm-9">
																			<textarea name="pembukaan" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Ketuban</label>
																		<div class="col-sm-9">
																			<textarea name="ketuban" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Hodge</label>
																		<div class="col-sm-9">
																			<textarea name="hodge" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Uterus</label>
																		<div class="col-sm-9">
																			<textarea name="uterus" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<h4 class="box-title">Tindakan/Pemeriksaan Lainnya</h4>
																<div class="row">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<textarea name="tindakan_lainnya" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
																  	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_resume">
											<div class="row">
												<div class="col-md-12">
													<div class="box box-primary box-solid">
														<div class="box-header with-border">
														  <h3 class="box-title">Resume Medis</h3>
														</div>
														<form method="POST" action="<?= site_url('pemeriksaan');?>">
														  <div class="box-body">
														    <input type="hidden" name="is_what" value="Resume Medis" />
														    <input type="hidden" name="no_reg"/>
														    <input type="hidden" name="no_rm"/>
														    <input type="hidden" name="id_reg"/>
														    <input type="hidden" name="antri" />
														    <input type="hidden" name="pasien" />
																<div class="row">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tgl. Masuk</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_masuk" id="tgl_masuk" class="form-control datepicker" required data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label for="input1" class="col-sm-3 control-label">Tgl. Keluar</label>
																		<div class="col-sm-4">
																			<input type="text" name="tgl_keluar" id="tgl_keluar" class="form-control datepicker" required data-mask data-inputmask='"mask":"99/99/9999"' placeholder="__/__/____" />
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Riwayat Penyakit</label>
																		<div class="col-sm-9">
																			<textarea name="riwayat_penyakit" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pemeriksaan Klinis</label>
																		<div class="col-sm-9">
																			<textarea name="pemeriksaan_klinis" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Pemeriksaan Lab</label>
																		<div class="col-sm-9">
																			<textarea name="pemeriksaan_lab" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Diagnosa</label>
																		<div class="col-sm-9">
																			<textarea name="diagnosa" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="row" style="padding-top: 10px;">
																	<div class="form-group">
																		<label class="col-sm-3 control-label">Tindakan</label>
																		<div class="col-sm-9">
																			<textarea name="tindakan" class="form-control" required="required"></textarea>
																		</div>
																	</div>
																</div>
																<div class="box-footer">
																	<div  class="form-group">
																  		<label for="inputEmail3" class="col-sm-3 control-label"></label>
																  		<div  class="col-sm-9">
																  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
																			<a href="#" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
																  		</div>
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
					</div>
				</div>
    		</section>
    	</div>
		<?php $this->load->view('template/v_copyright'); ?>
    </body>

    <?php $this->load->view('template/v_footer'); ?>

    <script type="text/javascript">
    $(document).ready(function() {
			$('.form-panel :input').attr("disabled",true);
			$('.form-panel a').attr("disabled",true);
	    	$('#mnPemeriksaanPasien').addClass('active');
    		$('#mnPemeriksaan').addClass('active');
			$('.selectOption').select2();
    	$('#alert').delay(10000).fadeOut("slow");
			$("[data-mask]").inputmask();
			$('.datepicker').datepicker({
	           format:'dd/mm/yyyy',
	           todayHighlight:true,
	           containter:true,
	        });
					$("#timepicker").timepicker({
						showInputs: false
					});
			$("select[name='no_registrasi']").change(function(data){
				$('.form-panel :input').attr("disabled",false);
				$('.form-panel a').attr("disabled",false);
				var no_registrasi = $(this).val();
				var url = "<?= site_url('Pemeriksaan/getPasienByNoRegistrasi');?>";
				$.get(url+'/'+no_registrasi,function(data){
					var tgl_lahir_splited = data.tgl_lahir_pasien.split('-');
					var umur = 2017-tgl_lahir_splited[0];
					console.log(data);
					$("input[name='no_reg']").val(data.no_registrasi);
					$("input[name='no_rm']").val(data.no_rm);
					$("input[name='id_reg']").val(data.id_registrasi);
					$("input[name='tgl_registrasi']").val(data.tgl_registrasi);
					$("input[name='pasien']").val(data.id_pasien);
					$("input[name='antri']").val(data.no_antrian);
					$("input[name='tgl_registrasi']").val(data.tgl_registrasi);
					$("input[name='no_rm']").val(data.no_rm);
					$("input[name='nama_pasien']").val(data.nama_pasien);
					$("input[name='jk_pasien']").val(data.jenis_kelamin_pasien);
					$("input[name='umur_pasien']").val(umur);
					$("input[name='gol_darah']").val(data.gol_darah_pasien);
					$("input[name='alamat_pasien']").val(data.jalan);
					$("input[name='nama_dokter']").val(data.nama_dokter);
					$("input[name='jenis_rawat']").val(data.jenis_rawat);
				},"JSON");

			});
			$("select[name='id_diagnosa']").change(function(data){
				var id_diagnosa = $(this).val();
				var url = "<?= site_url('Pemeriksaan/getDetailDiagnosa');?>";
				$.get(url+'/'+id_diagnosa,function(data){
					$("textarea[name='nama_tindakan']").val(data.nama_diagnosa);
				},"JSON");
			});
			$("#btn_tambah_obat").click(function(){
				var isNamaObat = false;
				var isJumlahObat = false;

				var inputNamaObat = document.getElementsByName('id_obat[]');
				var inputJumlahObat = document.getElementsByName('jumlah_obat[]');
				// console.log(inputNamaObat.val());
				for(var i=0;i<inputNamaObat.length;i++){
					var valNamaObat = inputNamaObat[i];
					if(valNamaObat.value==null || valNamaObat.value ==""){
						isNamaObat = false;
					}
					else {
						isNamaObat = true;
					}
				}

				for(var i=0;i<inputJumlahObat.length;i++){
					var valJumlahObat = inputJumlahObat[i];
					if(valJumlahObat.value == null || valJumlahObat.value ==""){
						isJumlahObat = false;
					}
					else{
						isJumlahObat = true;
					}
				}

				if(isNamaObat==true && isJumlahObat==true){
					var select = "<div class='row divObat' style='margin-top:10px;'>"+
						"<div class='col-md-6'>"+
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
						"<div class='col-md-4'>"+
							"<label class='control-label col-md-3'></label>"+
							"<div class='col-md-9'>"+
								"<input type='text' name='jumlah_obat[]' class='form-control' />"+
							"</div>"+
						"</div>"+
						"<div class='col-md-2'>"+
						"<button type='button' class='btn btn-danger' id='btn_remove_Obat' title='Hapus'><i class='fa fa-trash'></i></button>"+
						"</div>"+
					"</div>";
					$('#wrapperObat').append(select);
					$('#wrapperObat').on("click","#btn_remove_Obat",function(e){
						e.preventDefault();
						$(this).closest('.divObat').remove();
					});
					$('.selectObat').select2();
				}
				else{
					alert("Nama Obat dan Jumlahnya Harus Diisi Terlebih Dulu Sebelum Menambahkan");
				}
			});
    });
	</script>

</html>
