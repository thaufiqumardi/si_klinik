<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-validator/css/bootstrapValidator.css');?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/css/ionicons.css');?>">
  <!-- Pace -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/pace/pace.min.css');?>">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>">
  <!-- Select 2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css');?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/css/bootstrap-datepicker.css');?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css');?>">
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>

  <!-- Validator Form Jangan Dihapus-->
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap-validator/js/bootstrapValidator.js');?>"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/css/simklinik_style.css');?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="fixed hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>MB</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIM KLINIK</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('username');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
                <p><?php echo ucfirst($this->session->userdata('username')).' - '. ucfirst($this->session->userdata('level'));?>

                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url('Master/home/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('username'));?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="<?php if($current_page=='beranda'){echo 'active';}?>">
          <a href="<?php echo site_url('beranda');?>"><i class="fa fa-home"></i> Beranda</a>
        </li>

        <li class="<?php if($current_page=='pendaftaran_pasien'){echo 'active';}?>">
          <a href="<?php echo site_url('pendaftaran_pasien');?>"><i class="fa fa-edit "></i> Pendaftaran Pasien</a>
        </li>

        <li class="treeview <?php if($current_page=='ledger')echo 'active';?>">
          <a href="#">
            <i class="fa fa-clone"></i><span>Laporan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($current_page=='ledger')echo 'active';?>">
              <a href="<?php echo site_url('ledger');?>">
                  <i class="fa fa-circle-o"></i> Ledger
                </a>
            </li>
          </ul>
        </li>

        <li class="treeview <?php if($current_page=='pasien_terdaftar' || $current_page=='tambah_pasien')echo 'active';?>">
          <a href="#">
            <i class="fa fa-wheelchair"></i> <span>Master Pasien</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li class="<?php if($current_page=='tambah_pasien')echo 'active';?>">
              <a href="<?php echo site_url('pasien/tambah');?>">
                <i class="fa fa-circle-o"></i> Tambah Pasien Baru
              </a>
            </li>
            <li class="<?php if($current_page=='pasien_terdaftar')echo 'active';?>"><a href="<?php echo site_url('pasien');?>"><i class="fa fa-circle-o"></i> Pasien Terdaftar</a></li>

          </ul>
          </a>
        </li>

        <li class="treeview <?php if($current_page=='pegawai' || $current_page=='jabatan' || $current_page=='dokter')echo 'active';?>">
          <a href="#">
            <i class="fa fa-users"></i><span>Master Pegawai</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($current_page=='jabatan')echo 'active';?>">
              <a href="<?php echo site_url('jabatan');?>">
                  <i class="fa fa-circle-o"></i> Jabatan
                </a>
            </li>
            <li class="<?php if($current_page=='pegawai')echo 'active';?>">
              <a href="<?php echo site_url('pegawai');?>">
                  <i class="fa fa-circle-o"></i> Pegawai
                </a>
            </li>
            <li class="<?php if($current_page=='dokter')echo 'active';?>">
              <a href="<?php echo site_url('dokter');?>">
                  <i class="fa fa-circle-o"></i> Dokter
                </a>
            </li>
          </ul>
        </li>

        <li class="treeview <?php if($current_page=='kamar' || $current_page=='bed' || $current_page=='layanan'
                  || $current_page=='suplier' || $current_page=='diagnosa' || $current_page=='farmasi'
                  || $current_page=='kategori')echo 'active';?>">
          <a href="#">
              <i class="fa fa-cubes"></i> <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($current_page=='kamar')echo 'active';?>">
              <a href="<?php echo site_url('kamar');?>">
                  <i class="fa fa-circle-o"></i> Ruangan
                </a>
            </li>
            <li class="<?php if($current_page=='bed')echo 'active';?>">
              <a href="<?php echo site_url('bed');?>">
                  <i class="fa fa-circle-o"></i> Bed
                </a>
            </li>
            <li class="<?php if($current_page=='layanan')echo 'active';?>">
              <a href="<?php echo site_url('layanan');?>">
                  <i class="fa fa-circle-o"></i> Layanan
                </a>
            </li>
            <li class="<?php if($current_page=='diagnosa')echo 'active';?>">
              <a href="<?php echo site_url('diagnosa');?>">
                  <i class="fa fa-circle-o"></i> ICD
                </a>
            </li>
            <li class="<?php if($current_page=='suplier')echo 'active';?>">
              <a href="<?php echo site_url('suplier');?>">
                  <i class="fa fa-circle-o"></i> Suplier
                </a>
            </li>
            <li class="<?php if($current_page=='farmasi')echo 'active';?>">
              <a href="<?php echo site_url('Farmasi/master_obat');?>">
                  <i class="fa fa-circle-o"></i> Obat
                </a>
            </li>
            <li class="<?php if($current_page=='suplier')echo 'active';?>">
              <a href="<?php echo site_url('Farmasi/kategori');?>">
                  <i class="fa fa-circle-o"></i> Kategori Obat
                </a>
            </li>
          </ul>
        </li>

        <li class="treeview <?php if($current_page=='owner' || $current_page=='menu' || $current_page=='role'
                  || $current_page=='previlleges') echo 'active';?>">
          <a href="#">
            <i class="fa fa-gear"></i><span>Pengaturan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($current_page=='menu')echo 'active';?>">
              <a href="<?php echo site_url('menu');?>">
                  <i class="fa fa-circle-o"></i> Menu
                </a>
            </li>
            <li class="<?php if($current_page=='role')echo 'active';?>">
              <a href="<?php echo site_url('role');?>">
                  <i class="fa fa-circle-o"></i> Tipe Akses
                </a>
            </li>
            <li class="<?php if($current_page=='previlleges')echo 'active';?>">
              <a href="<?php echo site_url('previlleges');?>">
                  <i class="fa fa-circle-o"></i> Hak Akses
                </a>
            </li>
            <li class="<?php if($current_page=='owner')echo 'active';?>">
              <a href="<?php echo site_url('owner');?>">
                  <i class="fa fa-circle-o"></i> Owner
                </a>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

<div class="content-wrapper">
<section class="content">
