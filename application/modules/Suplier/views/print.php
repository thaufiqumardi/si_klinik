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
		<div class="col-xs-9 text-center">
			<br>
			<br>
			<p>Jl. Raya Pilang No. 147 Cirebon</p>
		</div>
		<hr>
	</div>
	<br><br>
	<table style="border: 2" class="table table-bordered table-striped DataTable">
		<thead>
			<tr>
				<th class="col-xs-1">No.</th>
				<th>Nama Supplier</th>
				<th>No. Telepon</th>
				<th> Alamat </th>
				<th>Contact Person</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($supplier as $row):?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $row->nama_supplier;?></td>
				<td><?php echo $row->no_telpon_supplier;?></td>
				<td><?php echo $row->alamat_supplier;?></td>
				<td><?php echo $row->contact_person;?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</body>
</html>
