<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo config_item('owner_name'); ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<link rel="stylesheet" media="print" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
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
	<table style="border: 2" class="table table-bordered table-striped DataTable">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama Obat/Alkes</th>
				<th>Kategori</th>
				<th>Merk</th>
				<th>Satuan</th>
				<th>Supplier</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($obat as $row):?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $row->nama_obat;?></td>
				<td><?php echo $row->nama_kategori;?></td>
				<td><?php echo $row->merk_nama;?></td>
				<td><?php echo $row->satuan_nama;?></td>
				<td><?php echo $row->nama_supplier;?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</body>
</html>