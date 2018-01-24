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
                    <label>LAPORAN LABA RUGI</label>
                </td>
    		</tr>  
    		<tr>
                <td align=center style="border:none; font-size:12px;">
                    <label><b>Per <?php echo $bulan; ?> <?php echo $tahun; ?></b></label>
                </td>
    		</tr>
    	</table>
		<br />	
		<table style="width:80%; font-size:12px; border: none;">
			<?php $total = 0; ?>
		  	<tbody>
		  		<tr>
		  			<td colspan="3" width=100% style="border: none; text-align:left; font-weight:bold;">PENDAPATAN</td>
		  		</tr>
		  		<?php foreach($pendapatan as $key){ ?>
		  		<tr>
		  			<td width=33% style="border: none; text-align:left; padding-left:25px;">Pendapatan</td>
		  			<td width=33% style="border: none; text-align:left; padding-left:25px;"></td>
		  			<td width=33% style="border: none; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->GrandTotal,0,",","."); ?></td>
		  			<?php $total = $key->GrandTotal; ?>
		  		</tr>
		  		<?php } ?>	
		  		<tr>
		  			<td colspan="3" width=100% style="border: none; text-align:left; font-weight:bold;">PENGELUARAN</td>
		  		</tr>
		  		<?php foreach($pengeluaran as $key){ ?>
		  		<tr>
		  			<td width=33% style="border: none; text-align:left; padding-left:25px;">Pengeluaran</td>
		  			<td width=33% style="border: none; text-align:left; padding-left:25px;"></td>
		  			<td width=33% style="border: none; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->GrandTotal,0,",","."); ?></td>
		  			<?php $total = $total - $key->GrandTotal; ?>
		  		</tr>
		  		<?php } ?>	
		  		<tr>
		  			<td colspan="3" width=100% style="border: none; text-align:left; font-weight:bold;"></td>
		  		</tr>
		  		<tr>
		  			<td width=33% style="border: none; text-align:right; padding-right:25px; font-weight:bold;">Laba Usaha</td>
		  			<td width=33% style="border: none; text-align:right; padding-right:5px;"></td>
		  			<td width=33% style="border-bottom:1px solid #e3e3e3; text-align:right; padding-right:5px; font-weight:bold;"><?php echo "Rp. ".number_format($total,0,",","."); ?></td>
		  		</tr>
		  	</tbody>
		</table>
	</div>
</body>
</html>