<!DOCTYPE HTML>
<html>
	<head>
		<?php $this->load->view('template/v_header'); ?>
  </head>
	<body class="fixed hold-transition skin-blue-light">
    <?php $this->load->view('template/v_left_menu'); ?>
  	<div class="content-wrapper">
    	<section class="content">
        <div class="row">
          <div  class="col-md-12">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
								<div class="col-xs-6">
									<dl class="dl-horizontal pull-left">
										<dt>Nama Pasien :</dt>
										<dd><?= $pasien->nama_pasien;?></dd>
										<dt>No. Rekam Medik :</dt>
										<dd><?= $pasien->no_rm;?></dd>
										<dt>No. Kartu :</dt>
										<dd><?= $pasien->no_kartu;?></dd>
									</dl>
							</div>
							<div class="col-xs-6">
								<br>
								<a href="<?php echo site_url('Rekammedik/detail\/').$pasien->id_pasien;?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak</a>

							</div>
              </div>
              <div class="box-body">



								<!-- riwayat pasien -->
                <div class="row">
                  <div  class="col-md-12">
                    <div class="box box-primary  ">
											<div class="box-header with-border">
				                <h3 class="box-title">Riwayat Pemeriksaan</h3>
				              </div>
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
                                  <th class="text-center">Dokter</th>
                                  <th class="text-center">Tanggal</th>
                                  <th class="text-center">Tensi</th>
                                  <th class="text-center">Berat</th>
                                  <th class="text-center">Tinggi</th>
                                  <th class="text-center">Keluhan</th>
                                  <th class="text-center">Anamnesa</th>
                                  <th class="text-center">Diagnosa</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($riwayats as $key => $row):?>
                                  <tr>
                                    <td><?= ++$key;?></td>
                                    <td><?= $row->nama_dokter;?></td>
                                    <td><?= date('d-M-Y', strtotime($row->tgl_pemeriksaan));?></td>
                                    <td><?= $row->tensi;?></td>
                                    <td><?= $row->berat_badan;?></td>
                                    <td><?= $row->tinggi_badan;?></td>
                                    <td><?= $row->keluhan;?></td>
                                    <td><?= $row->anamnesa;?></td>
                                    <td><?= $row->diagnosa;?></td>
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
								<!-- riwayat pasien -->

								<!-- Riwayat Tindakan -->
								<div class="row">
									<div  class="col-md-6">
										<div class="box box-primary  ">
											<div class="box-header with-border">
												<h3 class="box-title">Riwayat Tindakan</h3>
											</div>
											<?php
												if(empty($layanans)){
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
																	<th class="text-center">Tanggal</th>
																	<th class="text-center">Tindakan</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($layanans as $key => $row):?>
																	<tr>
																		<td><?= ++$key;?></td>
																		<td><?= date('d-M-Y', strtotime($row->tgl_pemeriksaan));?></td>
																		<td><?= $row->nama_layanan;?></td>
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

								<!-- Riwayat TIndakan -->

								<!-- Riwayat Resep Obat -->

									<div  class="col-md-6">
										<div class="box box-primary  ">
											<div class="box-header with-border">
												<h3 class="box-title">Riwayat Resep Obat</h3>
											</div>
											<?php
												if(empty($obats)){
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
																	<th class="text-center">Tanggal</th>
																	<th class="text-center">Nama Obat</th>
																	<th class="text-center">Jumlah</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($obats as $key => $row):?>
																	<tr>
																		<td><?= ++$key;?></td>
																		<td><?= date('d-M-Y', strtotime($row->tgl_pemeriksaan));?></td>
																		<td><?= $row->nama_obat;?></td>
																		<td><?= $row->qty_obat;?></td>
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
								<!-- Riwayat Resep Obat -->
              </div>
							<div class="box-footer">
							</div>
            </div>
          </div>
        </div>
      </secton>
    </div>
    <?php $this->load->view('template/v_copyright'); ?>
    </body>
    <?php $this->load->view('template/v_footer'); ?>

</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#mnrekammedik').addClass('active');
	});
</script>