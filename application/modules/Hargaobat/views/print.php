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
			<span></span><br>
			<p>Jl. Raya Pilang No. 147 Cirebon</p>
		</div>
		<hr>
	</div>
	<br>
	<br>
	<table style="border: 2" class="table table-bordered table-striped DataTable">
		<thead>
			<tr>
				<th class="col-xs-1">No.</th>
				<th>Nama Obat/Alkes</th>
				<th>Harga Beli</th>
				<th>Harga Jual</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($hargaobat as $row):?>
			<?php
				$beli = $this->M_base->currFormat2($row->harga_beli);
				$beli = str_replace(".00", "", $beli);
				$beli = "Rp. ".$beli;

				$jual1 = $this->M_base->currFormat2($row->harga_jual1);
				$jual1 = str_replace(".00", "", $jual1);
				$jual1 = "Rp. ".$jual1;
			?>
			<tr>
				<td class="col-xs-1"><?php echo $i++;?></td>
				<td><?php echo $row->nama_obat;?></td>
				<td><?php echo $beli;?></td>
				<td><?php echo $jual1;?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</body>
</html>
