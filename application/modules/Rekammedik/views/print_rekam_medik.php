<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('template/v_header'); ?>
  <style type="text/css">
  @media print
    {
          .page-break  { display:block; page-break-before:always; }

    }
	.custom-table > tbody > tr > th {
		width: 10%;
	}
	.custom-table > .jam > tbody > tr > th {
		width: 10%;
	}
  </style>
</head>
<!-- <body onload="window.print();"> -->
<body>
<div class="wrapper">
    <!-- title row -->
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Klinik Utama Melati Bunda
          <small class="pull-right">Dicetak Pada: <?= date('d-m-Y');?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
        <address>
          <?= $pasien->nama_pasien;?><br>
          <?= $pasien->no_kartu;?><br>
          <?= $pasien->no_rm;?><br>
          <?= "+62".$pasien->no_handphone;?><br>
          <?= $pasien->email;?><br>

        </address>
      </div>
      <div class="col-sm-6 invoice-col">
        <address>
          <strong><?= $pasien->jalan;?></strong><br>

        </address>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-md-12 table-responsive">
				<h4 class="text-center">Tindakan</h4>
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>No Registrasi</th>
            <th>Kode ICD</th>
            <th>Nama Diagnosa/Tindakan</th>
            <th>Tanggal Diagnosa</th>
          </tr>
          </thead>
          <tbody>

						<?php foreach($tindakans as $key => $tindakan):?>
					<tr>
            <td><?= ++$key;?></td>
            <td><?= $tindakan->no_registrasi;?></td>
            <td><?= $tindakan->kode_icd;?></td>
            <td><?= $tindakan->nama_tindakan;?></td>
						<?php
							$tgl_diagnosa = explode(" ",$tindakan->created_date_tindakan);

						?>
            <td><?= date('d-m-Y',strtotime($tgl_diagnosa[0]))." | "."Pukul: ".date('H:i:s',strtotime($tgl_diagnosa[1]));?></td>

          </tr>
				<?php endforeach;?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row page-break">
			<div class="col-md-12 table-responsive">
				<h4 class="text-center">Obsterti</h4>
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th rowspan="2">#</th>
						<th rowspan="2">Tanggal Obsterti</th>
            <th rowspan="2">Kehamilan</th>
            <th rowspan="2">Partus</th>
            <th rowspan="2">Hasil Kehamilan</th>
            <th rowspan="2">Jenis Persalinan</th>
            <th colspan='5' style="text-align:center;">Penyulit Anak</th>
          </tr>
					<tr>
						<th>
							Ante partum
						</th>
						<th>
							Intra partum
						</th>
						<th>
							Post Partum
						</th>
						<th>
							Jenis
						</th>
						<th>
							Sekarang Hidup/Mati
						</th>
					</tr>
          </thead>
          <tbody>
						<?php foreach($obstertis as $key => $obsterti):?>
					<tr>
            <td><?= ++$key;?></td>
						<td><?= date('d-m-Y',strtotime($obsterti->tgl_obsterti));?></td>
            <td><?= $obsterti->kehamilan_obsterti;?></td>
            <td><?= $obsterti->partus_obsterti;?></td>
            <td><?= $obsterti->hasil_kehamilan_obsterti;?></td>
            <td><?= $obsterti->jenis_persalinan_obsterti;?></td>
						<td class="text-center">
							<i class="fa fa-check-circle text-success"></i>
						</td>
						<td class="text-center">
							<i class="fa fa-check-circle text-success"></i>
						</td>
						<td class="text-center">
							<i class="fa fa-check-circle text-success"></i>
						</td>
						<td class="text-center">
							<i class="fa fa-check-circle text-success"></i>
						</td>
						<td class="text-center">
							<i class="fa fa-check-circle text-success"></i>
						</td>
            <!-- <td><?= $obsterti->jenis_persalinan_obsterti;?></td> -->
          </tr>
				<?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
		<div class="row page-break">
			<div class="col-md-12 table-responsive">
				<h4 class="text-center">Observasi Kala</h4>
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
						<th>Tanggal</th>
            <th>Jam</th>
            <th>BJA</th>
            <th>HIS</th>
            <th>Pemeriksaan</th>
            <th>Dalam</th>
            <th>Penyakit / Tindakan</th>
            <th>Keterangan</th>
          </tr>
          </thead>
          <tbody>
						<?php foreach($observasi_kalas as $key => $observasi):?>
					<tr>
            <td><?= ++$key;?></td>
						<td><?= date('d-m-Y',strtotime($observasi->tgl_observasi_kala));?></td>
            <td><?= $observasi->jam_observasi_kala;?></td>
            <td><?= $observasi->bja_observasi_kala;?></td>
            <td><?= $observasi->his_observasi_kala;?></td>
            <td><?= $observasi->pemeriksaan_observasi_kala;?></td>
            <td><?= $observasi->dalam_observasi_kala;?></td>
            <td><?= $observasi->tindakan_observasi_kala;?></td>
            <td><?= $observasi->keterangan_observasi_kala;?></td>
          </tr>
				<?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>

		<?php foreach ($kala1s as $key => $kala1):?>
		<div class="row page-break">
      <div class="col-md-6">
				<div class="box box-solid">
					<h4>Kala1</h4>
					<div class="box-body">
						<table class="table no-border table-responsive">
							<tr>
								<th style="width:4px;">
									Tanggal
								</th>
								<td class="text-left">
									: <?=date('d-m-Y',strtotime($kala1->tgl_kala1));?>
								</td>
								<th style="width:4px;">
									Jam
								</th>
								<td class="text-left">
									: <?=date('H:i:s',strtotime($kala1->jam_kala1));?>
								</td>
							</tr>
							<tr>
								<th style="width:4px;">
									Komplikasi
								</th>
								<td class="text-left">
									: <?= $kala1->komplikasi_kala1;?>
								</td>
							</tr>
							<tr>
								<th style="width:4px;">
									Terapi
								</th>
								<td class="text-left">
									: <?= $kala1->terapi_kala1;?>
								</td>
							</tr>
							<tr>
								<th style="width:4px;">
									Tindakan
								</th>
								<td class="text-left">
									: <?= $kala1->tindakan_kala1;?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

    </div>
		<?php endforeach;?>

		<?php foreach($kala2s as $key => $kala2):?>
		<div class="row page-break">
			<h4 style="margin-left:19px;">Kala II</h4>
      <div class="col-xs-6">
				<div class="box box-solid">
					<div class="box-body">
						<table class="table no-border table-responsive">
							<tr>
								<th style="width:4px;">
									Tanggal
								</th>
								<td class="text-left">
									: <?= date('d-m-Y',strtotime($kala2->tgl_kala2));?>
								</td>
								<th style="width:4px;">
									Jam
								</th>
								<td class="text-left">
									: <?= date('H:i:s',strtotime($kala2->jam_kala2));?>
								</td>
							</tr>
							<tr>
								<th style="width:4px;">
									Komplikasi
								</th>
								<td class="text-left">
									: <?= $kala2->komplikasi_kala2;?>
								</td>
							</tr>
							<tr>
								<th style="width:4px;">
									Terapi
								</th>
								<td class="text-left">
									: <?= $kala2->terapi_kala2;?>
								</td>
							</tr>
							<tr>
								<th style="width:4px;">
									Tindakan
								</th>
								<td class="text-left">
									: <?= $kala2->tindakan_kala2;?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="box box-solid">
					<div class="box-body">
								<table class="table no-border table-responsive">
									<tr>
										<th>
											Jenis Persalinan
										</th>
										<td >
											:	<?= $kala2->jenis_persalinan;?>
										</td>
									</tr>
									<tr>
										<th>
											Anak Lahir
										</th>
										<td >
											: <?= $kala2->anak_lahir;?>
										</td>
									</tr>
									<tr>
										<th>
											Tgl Lahir
										</th>
										<td >
											: <?= $kala2->tgl_lahir;?>
										</td>
										<th>
											Jam Lahir
										</th>
										<td >
											: <?= $kala2->jam_lahir;?>
										</td>
									</tr>
									<tr>
										<th >
											Jenis Kelamin
										</th>
										<td >
											: <?= $kala2->jenis_kelamin;?>
										</td>
									</tr>
									<tr>
										<th style="width:4px;">
											Panjang
										</th>
										<td >
											: <?= $kala2->panjang;?>
										</td>
									</tr>
									<tr>
										<th >
											Berat Badan
										</th>
										<td >
											: <?= $kala2->berat_badan;?>
										</td>
									</tr>
									<tr>
										<th>
											Cacat / Meserasi
										</th>
										<td >
											: <?= $kala2->cacat_persalinan;?>
										</td>
									</tr>
									<tr>
										<th>
											Dapat Oksigen
										</th>
										<td >
											: <?= $kala2->oksigen_persalinan;?>
										</td>
									</tr>
								</table>
					</div>
				</div>
			</div>
    </div>
		<?php endforeach;?>

		<?php foreach($kala3s as $key => $kala3):?>
		<div class="row page-break">
			<div class="col-md-12">
				<h4>Kala III</h4>
				<table class="table no-border table-responsive custom-table">
					<tbody>
						<tr>
							<th>
								Tanggal
							</th>
							<td >
								: <?= date('d-m-Y',strtotime($kala3->tgl_kala3));?>
							</td>
							<th class="jam">
								Jam
							</th>
							<td>
								: <?= date('H:i:s',strtotime($kala3->jam_kala3));?>
							</td>
						</tr>
						<tr>
							<th>
								Placenta
							</th>
							<td>
								: <?= $kala3->placenta_kala3;?>
							</td>
						</tr>
						<tr>
							<th>
								Komplikasi
							</th>
							<td>
								: <?= $kala3->komplikasi1_kala3;?>
							</td>
						</tr>
						<tr>
							<th>
								Tindakan
							</th>
							<td>
								: <?= $kala3->tindakan1_kala3;?>
							</td>
						</tr>
						<tr>
							<th>
								Pendarahan
							</th>
							<td>
								: <?= $kala3->pendarahan_kala3;?>
							</td>
						</tr>
						<tr>
							<th>
								Komplikasi 2
							</th>
							<td>
								: <?= $kala3->komplikasi2_kala3;?>
							</td>
						</tr>
						<tr>
							<th>
								Tindakan
							</th>
							<td>
								: <?= $kala3->tindakan2_kala3;?>
							</td>
						</tr>
						<tr>
							<th>
								Perincum
							</th>
							<td style="width:100px;">
								: <?= $kala3->perincum_kala3;?>
							</td>
							<th style="text-align:left;">
								Tingkat
							</th>
							<td>
								: <?= $kala3->tingkat_kala3;?>
							</td>
						</tr>
						<tr>
							<th>
								Tindakan
							</th>
							<td>
								: <?= $kala3->tindakan3_kala3;?>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
		<?php endforeach;?>

		<?php foreach($pasca_persalinan as $key => $pasca):?>
		<div class="row page-break">
			<h4 style="margin-left:20px;">Pasca Persalinan</h4>
			<div class="col-xs-4">
				<div class="box box-solid">
					<div class="box-body">
						<table class="table no-border table-responsive">
							<tr>
								<th style="width:48%;">
									Keadaan Umum
								</th>
								<td>
									: <?= $pasca->keadaan;?>
								</td>
							</tr>
							<tr>
								<th style="width:48%;">
									Tensi
								</th>
								<td>
									: <?= $pasca->tensi;?>
								</td>
							</tr>
							<tr>
								<th style="width:48%;">
									Nadi
								</th>
								<td>
									: <?= $pasca->nadi;?>
								</td>
							</tr>
							<tr>
								<th style="width:48%;">
									Pernapasan
								</th>
								<td>
									: <?= $pasca->pernapasan;?>
								</td>
							</tr>
							<tr>
								<th style="width:48%;">
									Suhu
								</th>
								<td>
									: <?= $pasca->suhu;?>
								</td>
							</tr>
							<tr>
								<th style="width:48%;">
									Tinggi Uterus
								</th>
								<td>
									: <?= $pasca->tinggi_uterus;?>
								</td>
							</tr>
							<tr>
								<th style="width:48%;">
									Kontraksi
								</th>
								<td>
									: <?= $pasca->kontraksi;?>
								</td>
							</tr>
							<tr>
								<th style="width:48%;">
									Urine
								</th>
								<td>
									: <?= $pasca->urine;?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xs-8">
				<div class="box box-solid">
					<div class="box-body">
						<table class="table no-border table-responsive">
							<tr>
								<th>
									Keadaan Anak
								</th>
								<td>
									: <?= $pasca->keadaan_anak;?>
								</td>
							</tr>
							<tr>
								<th>
									Tgl Lahir
								</th>
								<td>
									: <?= date('d-m-Y',strtotime($pasca->tgl_lahir));?>
								</td>
								<th style="text-align:left; width:50px;">
									Jam
								</th>
								<td>
									: <?= date('H:i:s',strtotime($pasca->jam_lahir));?>
								</td>
							</tr>
							<tr>
								<th>
									Berat
								</th>
								<td>
									: <?= $pasca->berat;?>
								</td>
								<th>
									Panjang
								</th>
								<td>
									: <?= $pasca->panjang;?>
								</td>
							</tr>
							<tr>
								<th>
									Pronto
								</th>
								<td>
									: <?= $pasca->pronto;?>
								</td>
							</tr>
							<tr>
								<th>
									Subento
								</th>
								<td>
									: <?= $pasca->subento;?>
								</td>
							</tr>
							<tr>
								<th>
									Suboccid
								</th>
								<td>
									: <?= $pasca->suboccid;?>
								</td>
							</tr>
							<tr>
								<th>
									Cacat Meserasi
								</th>
								<td>
									: <?= $pasca->cacat_maserasi;?>
								</td>
							</tr>
							<tr>
								<th>
									Apgar
								</th>
								<td>
									: <?= $pasca->apgar;?>
								</td>
							</tr>
							<tr>
								<th>
									Oksigen
								</th>
								<td>
									: <?= $pasca->oksigen;?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach;?>

		<?php foreach($status_pasien as $key=>$status):?>
		<div class="row page-break">
			<h4 class="text-center">Status Pasien</h4>
			<div class="col-xs-6">
				<div class="box box-widget box-solid">
					<div class="box-header with-border">
						<h4 class="box-title">Status Praesens</h4>
					</div>
					<div class="box-body">
						<table class="table no-border">
							<tr>
								<th>
									Jam
								</th>
								<td>
									: <?= $status->jam;?>
								</td>
							</tr>
							<tr>
								<th>
									Keadaan Umum
								</th>
								<td>
									: <?= $status->keadaan_umum;?>
								</td>
							</tr>
							<tr>
								<th>
									Tensi
								</th>
								<td>
									: <?= $status->tensi;?>
								</td>
							</tr>
							<tr>
								<th>
									Nadi
								</th>
								<td>
									: <?= $status->nadi;?>
								</td>
							</tr>
							<tr>
								<th>
									Suhu
								</th>
								<td>
									: <?= $status->suhu;?>
								</td>
							</tr>
							<tr>
								<th>
									Pernapasan
								</th>
								<td>
									: <?= $status->pernapasan;?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="box box-widget box-solid">
					<div class="box-header with-border">
						<h4 class="box-title">Pemeriksaan Luar</h4>
					</div>
					<div class="box-body">
						<table class="table no-border">
							<tr>
								<th>
									Fundus Uteri
								</th>
								<td>
									: <?= $status->fundus_uteri;?>
								</td>
							</tr>
							<tr>
								<th>
									Lingkaran Perut
								</th>
								<td>
									: <?= $status->lingkaran_perut;?>
								</td>
							</tr>
							<tr>
								<th>
									Letak Anak
								</th>
								<td>
									: <?= $status->letak_anak;?>
								</td>
							</tr>
							<tr>
								<th>
									Bunyi Jantung Anak
								</th>
								<td>
									: <?= $status->bunyi_jantung_anak;?>
								</td>
							</tr>
							<tr>
								<th>
									HIS
								</th>
								<td>
									: <?= $status->his;?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="box box-widget box-solid">
					<div class="box-header with-border">
						<h4 class="box-title">Pemeriksaan Dalam</h4>
					</div>
					<div class="box-body">
						<table class="table no-border">
						<tr>
								<th>
									Inspeculo
								</th>
								<td>
									: <?= $status->inspeculo;?>
								</td>
							</tr>
							<tr>
								<th>
									Vulva / Vagina
								</th>
								<td>
									: <?= $status->vulva;?>
								</td>
							</tr>
							<tr>
								<th>
									Portio
								</th>
								<td>
									: <?= $status->portio;?>
								</td>
							</tr>
							<tr>
								<th>
									Pembukaan
								</th>
								<td>
									: <?= $status->pembukaan;?>
								</td>
							</tr>
							<tr>
								<th>
									Ketuban
								</th>
								<td>
									: <?= $status->ketuban;?>
								</td>
							</tr>
							<tr>
								<th>
									Hodge
								</th>
								<td>
									: <?= $status->hodge;?>
								</td>
							</tr>
							<tr>
								<th>
									Uterus
								</th>
								<td>
									: <?= $status->uterus;?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="box box-solid box-widget">
					<div class="box-header with-border">
						<h4 class="box-title">Tindakan / Pemeriksaan Lainnya</h4>
					</div>
					<div class="box-body">
						<table class="table no-border">
							<tr>
								<th>
									Tindakan Lainnya
								</th>
							</tr>
							<tr>
								<td>
									<?= $status->tindakan_lainnya;?>
									</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	</div>
  <!-- /.content -->
<!-- ./wrapper -->
</body>
</html>
