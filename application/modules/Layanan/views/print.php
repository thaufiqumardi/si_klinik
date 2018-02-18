<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo config_item('owner_name'); ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link  rel="shortcut icon" type="image/x-icon" href="<?php echo config_item('owner_icon'); ?>" />
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
				<th>No.</th>
				<th>Nama Layanan</th>
				<th>Tarif</th>
				<!-- <th>Tarif Khusus</th> -->
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($layanan as $row):?>
			<?php
				// $tarif_layanan = $this->M_base->currFormat2($row->tarif_layanan);
				// $tarif_layanan = str_replace(".00", "", $tarif_layanan);
				// $tarif_layanan = "Rp. ".$tarif_layanan;

				$tarif = $this->M_base->currFormat2($row->tarif_layanan);
										// $tarif = str_replace(".00", "", $tarif);
										$tarif = substr($tarif,0,-3);
										$tarif = "Rp. ".$tarif;

				// $tarif_khusus = "";
				// if(!empty($row->tarif_khusus)){
				// 	$tarif_khusus = $this->M_base->currFormat2($row->tarif_khusus);
				// 	$tarif_khusus = str_replace(".00", "", $tarif_khusus);
				// 	$tarif_khusus = "Rp. ".$tarif_khusus;
				// }
			?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $row->nama_layanan;?></td>
				<td><?php echo $tarif;?></td>
				<!-- <td><?php echo $tarif_khusus;?></td> -->
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</body>
</html>
