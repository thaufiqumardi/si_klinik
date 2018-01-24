<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ANTRIAN PASIEN SIMKLINIK MELATI BUNDA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="refresh" content="5"/>

  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/easyslider/css/screen.css');?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">

  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
    <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/pace/pace.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <!-- iCheck -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
  <script src="<?php echo base_url('assets/plugins/easyslider/js/easySlider1.7.js');?>"></script>
</head>
<body class="hold-transition login-page">
  <!-- <div class="row">
    <div class="login-logo">
      <br>
      <b>ANTRIAN KLINIK MELATI BUNDA</b>
    </div>
  </div> -->
  <div class="row">
    <section class="col-lg-6">
      <div class="login-box" style="width:100%;">
        <div class="login-box-body" style="margin-left: 20px;">
          <div class="row" style="padding-left: 10px;">
            <div class="col-md-6">
              <img src="<?php echo config_item('owner_image'); ?>" style="position:'center';" class="img-responsive">
            </div>
            <div class="col-md-6">
              <?php
                $now = date('D');
                $hari = array(
                  'Sun'=>'Minggu',
                  'Mon' => 'Senin',
                  'Tue' => 'Selasa',
                  'Wed' => 'Rabu',
                  'Thu' => 'Kamis',
                  'Fri' => "Jum'at",
                  'Sat' => 'Sabtu'
                );
                $bulan = array(
                '01' => 'JANUARI',
                '02' => 'FEBRUARI',
                '03' => 'MARET',
                '04' => 'APRIL',
                '05' => 'MEI',
                '06' => 'JUNI',
                '07' => 'JULI',
                '08' => 'AGUSTUS',
                '09' => 'SEPTEMBER',
                '10' => 'OKTOBER',
                '11' => 'NOVEMBER',
                '12' => 'DESEMBER',
                );
             ?>
              <h1><?= $hari[$now];?></h1>
              <h2><?= date('d').' '.$bulan[date('m')].' '.date('Y');?></h2>
            </div>
            <div id="content">
	        	<div id="slider">
					<ul>				
						<li><a href="#"><img src="<?php echo base_url('logo/Anggrek.png'); ?>" alt="" /></a></li>
						<li><a href="#"><img src="<?php echo base_url('logo/Mawar.png'); ?>" alt="" /></a></li>
						<li><a href="#"><img src="<?php echo base_url('logo/Tulip.png'); ?>" alt="" /></a></li>			
					</ul>
				</div>
        	</div>
          </div>
        </div>
      </div>
    </section>
    <section class="col-lg-6">
      <div class="login-box" style="width:100%;">
        <div class="login-box-body" style="margin-right: 20px;">
        	<div class="row" style="padding-right: 10px;">          
	            <div class="text-center" style="padding-top: 103px; padding-bottom: 100px;">
	              <h3>Nomor Antrian</h3>
	                <h1 style="font-size: 8em;"><?= empty($antrian)?" --- ":$antrian[0]->no_antrian;?></h1>
	              <h3>Menuju Ruang Pemeriksaan</h3>
	            </div>
          </div>
        </div> 
      </div>
    </section>
  </div>
  <audio id="soundHandle" style="display: none;"></audio>
  <input type="hidden" id="count" value="<?php echo $count; ?>">
  <input type="hidden" id="play_sound" value="<?= empty($antrian)?"":$antrian[0]->play_sound;?>">
  <input type="hidden" id="suara" value="<?= empty($antrian)?"":$antrian[0]->no_antrian;?>">
  <input type="hidden" id="id_registrasi" value="<?= empty($antrian)?"":$antrian[0]->id_registrasi;?>">
</body>
<script type="text/javascript">
$(document).ready(function(){	
	$("#slider").easySlider({
		auto: true,
		continuous: true,
		numeric: false
	});
});
count = $('#count').val();
suara = $('#suara').val();
id_reg = $('#id_registrasi').val();
play_sound = $('#play_sound').val();
if(count != 0){
	if(play_sound == 0){
		soundHandle = document.getElementById('soundHandle');
		soundHandle.src = '<?php echo site_url()?>'+'/suara_antrian/'+suara+'.mp3';
		soundHandle.play();
		$.ajax({
	        url : "<?php echo site_url('Antrian/update_sound')?>"+"/"+id_reg,
	        type: "POST",
	        dataType: "JSON",
	        success: function(data)
	        {
	        }
	    });
	}	
}
</script>
</html>
