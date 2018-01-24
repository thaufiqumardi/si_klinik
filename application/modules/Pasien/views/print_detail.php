<!DOCTYPE html>
<html>
<head>
	<title><?php echo config_item('owner_name'); ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<link rel="stylesheet" media="print" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  	<style type="text/css">
  	.form-group{
  		margin-bottom: 15px;
  	}
  	.col-md-9{
  		position: relative;
		min-height: 1px;
		width: 75%;
		float: left;
  	}
  	.col-md-6{
  		position: relative;
		min-height: 1px;
		width: 30%;
		float: left;
  	}
  	.col-md-3{
  		position: relative;
		min-height: 1px;
		width: 18%;
		float: left;
		padding-right: 15px;
  	}
  	</style>
</head>
<body onload="window.print();">
	<div class="row with-border">
		<div class="col-xs-2">
			<img src="<?php echo config_item('owner_image'); ?>" style="position:'center';" class="img-responsive">
		</div>
		<div class="col-xs-10 text-center">
			<br>
			<span>IZIN NO:445/1617-DINKES/04-S1-KK/IV/05</span><br>
			<p>Jl. Kiaracondong 304/19-21 telp. (022) 7311759</p>
		</div>
		<hr>
	</div>
	<div style="display: table; width: 100%;">
		<div style="width: 80%; float: left;">
			<h4 class="box-title">Data Pasien</h4>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">No. RM</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['no_rm'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">No. Kartu</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['no_kartu'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Nama Pasien</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['nama_pasien'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">No. KTP</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['nik_pasien'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">TTL</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['tempat_lahir'] ?> / 
				<?php 
				$tgl_lahir=explode('-',$pasien['tgl_lahir']);
				echo $tgl_lahir[2].'-'.$tgl_lahir[1].'-'.$tgl_lahir[0];
				?>
				</label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Agama</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['agama'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Pendidikan</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['pendidikan_pasien'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Pekerjaan</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['pekerjaan_pasien'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Kewarganegaraan</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['warga_negara'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Golongan Darah</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['gol_darah'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Status Perkawinan</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['status_perkawinan'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">No. Telp</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['no_telp_rumah'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Email</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['email'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Alamat</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['jalan'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Rt/Rw</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['rtrw'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Kel/Desa</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['kelurahan'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Kec</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['kecamatan'] ?></label>
			</div>
			<div class="form-group">
				<label class="col-md-3" style="text-align: right;">Kota/Kab</label>
				<label class="col-md-9" style="text-align: left;"><?php echo $pasien['kota'] ?></label>
			</div>
		</div>
	</div>
</body>
</html>