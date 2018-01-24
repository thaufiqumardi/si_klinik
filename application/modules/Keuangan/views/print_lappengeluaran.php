<!DOCTYPE html>
<html>
<head>
  <title><?php echo config_item('web_title'); ?></title>
  <!-- <link href='</?php echo config_item('img'); ?>favicon.png' type='image/x-icon' rel='shortcut icon'> -->
  <style type="text/css"> 
    .short{
      width: 50px;
    }
 
    .normal{
      width: 150px;
    }
 
    table{
      	border-collapse: collapse;
    	border-spacing: 0;
    	margin: 0;
    	padding: 0;
      	font-family: arial;
      	color:#5E5B5C;
    }
 
    thead th{
      text-align: left;
    }
 
    tbody td{
      border-collapse: collapse;
    }
 
    tbody tr:nth-child(even){      
      border-collapse: collapse;
    }
 
    tbody tr:hover{
      border-collapse: collapse;
    }
  </style>
</head>
<body>
	<div id="outtable">	
		<table style="width:100%; font-size:12px;">
			<tr>
    			<td width=10% style="border:none; padding:0;">
    			</td>
                <td align=center style="border:none; font-size:12px;">
    				<?php 
						$image = $imgpath;
						$imageData = base64_encode(file_get_contents($image));
						$finfo = new finfo();
						$fileinfo = $finfo->file($image, FILEINFO_MIME);
						$src = 'data: '.$fileinfo.';base64,'.$imageData;
						$src=str_replace(" ","",$src);
						echo'<img align="middle" position="center" src="'.$src.'"/>';
					?>
					<br>
                </td>
                <td width=10% style="border:none; padding:0;"></td>
    		</tr>  
		</table>
		<br>
		<table style="width:100%; font-size:12px;"> 
			<tr>
    			<td width=10% style="border:none; padding:0;">
    			</td>
                <td align=center style="border:none; font-size:12px;">
					<span>IZIN NO:445/1617-DINKES/04-S1-KK/IV/05</span><br>
					<p>Jl. Kiaracondong 304/19-21 telp. (022) 7311759</p>
                </td>
                <td width=10% style="border:none; padding:0;"></td>
    		</tr>  
		</table>
		<br />
		<br />
		<table style="width:100%; font-size:12px;">
    		<tr>
                <td align=center style="border:none; font-size:12px;">
                    <label>LAPORAN PENGELUARAN</label>
                </td>
    		</tr>  
    		<tr>
                <td align=center style="border:none; font-size:12px;">
                    <label><b>Periode : <?php echo date('d-m-Y', strtotime($periode_awal)); ?> s/d <?php echo date('d-m-Y', strtotime($periode_akhir)); ?></b></label>
                </td>
    		</tr>
    	</table>
		<br />
		<table style="width:100%; font-size:12px; border: 1px solid #e3e3e3;">
			<thead>
		  		<tr>
		  			<th width=5% style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">No.</th>
		  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">No. Kuitansi</th>
		  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Tgl.</th>
		  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Nama Item</th>
		  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Harga</th>
		  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Qty</th>
		  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Sub Total</th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  		<?php $no=1; ?>
		  		<?php $total = 0; ?>
		  		<?php foreach($details as $key){ ?>
		  		  <tr>
		  			<td style="border: 1px solid #e3e3e3; text-align:center;"><?php echo $no; ?></td>
		  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo $key->no_pengeluaran; ?></td>
		  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo date('d-m-Y', strtotime($key->tgl_pengeluaran)); ?></td>
		  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo $key->nama_pengeluaran; ?></td>
		  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->harga_pengeluaran,0,",","."); ?></td>
		  			<?php 
			  			$qty = $this->M_base->currFormat0($key->qty_pengeluaran);
						$qty = str_replace(".00", "", $qty);
						$total = $total + $key->total_pengeluaran;
		  			?>
		  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo $qty; ?></td>
		  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->total_pengeluaran,0,",","."); ?></td>
		  		  </tr>
		  		<?php $no++; ?>
		  		<?php } ?>
		  		<tr>
	    			<td style="border: none;"></td>
		  			<td style="border: none;"></td>
		  			<td style="border: none;"></td>
		  			<td style="border: none;"></td>
		  			<td style="border: none;"></td>
		  			<td style="border: none; text-align:right; padding-right:5px; font-weight:bold; font-size:14px;">Total</td>
		  			<td style="border: none; text-align:right; padding-right:5px; font-weight:bold; font-size:14px;"><?php echo "Rp. ".number_format($total,0,",","."); ?></td>
	    		</tr>
		  	</tbody>
		</table>
	</div>
</body>
</html>