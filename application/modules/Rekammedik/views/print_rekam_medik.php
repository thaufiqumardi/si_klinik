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
<body  onload="window.print();">
<div class="wrapper" style="padding-left: 20px;padding-right: 20px;">
    <div class="row">
      <div class="col-xs-3">
      <table style="width:100%; font-size:12px; background-color: white;">
			<tr>
    			<td width=10% style="border:none; padding:0;">
    			</td>
                <td align=left style="border:none; font-size:12px;">
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
  </div>
		<br />
    <div class="col-xs-7">
		<table style="width:100%; font-size:12px; background-color: white;">
			<tr>
    			<td width=10% style="border:none; padding:0;">
    			</td>
                <td align=center style="border:none; font-size:12px;">
					<span></span><br>
					<p>Jl. Raya Pilang No. 147 Cirebon</p>
                </td>
                <td width=10% style="border:none; padding:0;"></td>
    		</tr>
		</table>
		<br>
  </div>
    </div>
    <br>
    <br>
    <div class="row">
      <div  class="col-md-12">
        <div class="box box-default box-solid">
          <div class="box-header with-border">
            <div class="row">
              <div class="col-md-6">
                <address>
                  Nama      : <?= $pasien->nama_pasien;?><br>
                  No. Kartu : <?= $pasien->no_kartu;?><br>
                  Alamat    : <?= $pasien->jalan;?> Rt/Rw. <?= $pasien->rtrw;?>
                            <br>Kel. <?= $pasien->kelurahan;?> Kec. <?= $pasien->kecamatan;?> <?= $pasien->kota;?>
                </address>
              </div>
            </div>
          </div>
          <div class="box-body">
    <div class="row">
      <div class="col-md-12 table-responsive">
				<h4 class="text-left">Pemeriksaan</h4>
        <table class="table table-bordered table-striped">
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

						<?php foreach($riwayats as $key => $row):?>
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
    </div>
    <div class="row">
			<div class="col-md-12 table-responsive">
				<h4 class="text-Left">Tindakan</h4>
        <table class="table table-bordered table-striped">
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
    </div>
		<div class="row">
			<div class="col-md-12 table-responsive">
				<h4 class="text-left">Resep Obat</h4>
        <table class="table table-bordered table-striped">
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
    </div>
  </div>
</div>
</div>
	</div>
</div>
</body>
</html>
