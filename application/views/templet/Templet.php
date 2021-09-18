<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Naivfe Bayes</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- prettify.min.js
  prettify.min.css -->


  <link href="<?=base_url('assets/')?>ICON.png" rel="shortcut icon" type="image/ico" />
 
  <link rel="stylesheet" src="<?=base_url('')?>assets/plugin/plugins/DataTables/jquery.dataTables.min.js"></link>
  <link rel="stylesheet"  src="<?= base_url('assets/')?>wizard.css"></link>
<?php if($this->uri->segment(1)=='Penilaian'):?>
  <style type="text/css">

      td.details-control {
        background: url('<?=base_url('assets/plugin/plugins/DataTables')?>/details_open.png') no-repeat center center;
        cursor: pointer;
      }
      tr.shown td.details-control {
        background: url('<?=base_url('assets/plugin/plugins/DataTables')?>/details_close.png') no-repeat center center;
      }

  </style>
  <?php endif;?>
  <script src="<?=base_url('')?>assets/plugin/plugins/jquery/jquery/jquery.min.js"></script>
  <link rel="stylesheet" src="<?=base_url('')?>assets/plugin/plugins/bootstrap/bootstrap.min.css"rel="stylesheet"></link>

  <script src="<?=base_url('')?>assets/plugin/plugins/raphael/raphael.min.js"></script>
  <script src="<?=base_url('')?>assets/morris/morris.min.js"></script>

  <link rel="stylesheet" src="<?=base_url('')?>assets/morris/morris.css"></link>
  <link rel="stylesheet" src="<?=base_url('')?>assets/morris/morris.css"></link>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugin')?>/plugins/fontawesome-free/css/all.min.css">


  <link rel="stylesheet" href="<?= base_url('assets/plugin')?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/plugin')?>/plugins/DataTables/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/plugin')?>/plugins/DataTables/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/plugin')?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <?php if ($this->uri->segment(1)=="voting"):?>

    <!-- Optional SmartWizard theme -->
    <link href="<?=base_url('assets/plugin')?>/dist/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugin')?>/dist/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugin')?>/dist/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
  <?php endif;?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class=" main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    </ul>
  </nav>
  <!-- /.navbar -->
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="<?=base_url('assets/')?>ICON.png"

           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Survey</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">

          <a href="#" class="d-block"></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->

          <?php if($this->session->userdata('akun')=='admin'):?>

          <li class="nav-item">
            <a href="<?=base_url('Home')?>" class="nav-link <?=("Home"== $this->uri->segment(1)?'active':'')?>"  >
             <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('Penilaian')?>" class="nav-link <?=("Penilaian"== $this->uri->segment(1)?'active':'')?>">
             <i class="nav-icon nav-icon fas fa-edit"></i>
                <p>Penilain</p>
            </a>
          </li>
					<li class="nav-item">
            <a href="<?=base_url('data_vot')?>" class="nav-link <?=("data_vot"== $this->uri->segment(1)?'active':'')?>">
             <i class="nav-icon nav-icon fas fa-edit"></i>
                <p>Data & Setting accont</p>
            </a>
          </li>


          <?php elseif($this->session->userdata('akun')=='vote'):?>
            <li class="nav-item">
            <a href="<?=base_url('user')?>" class="nav-link <?=("Home"== $this->uri->segment(1)?'active':'')?>  <?=$d?>" >
             <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('voting')?>" class="nav-link <?=("voting"== $this->uri->segment(1)?'active':'')?> <?=$d?>">
             <i class="nav-icon nav-icon fas fa-edit"></i>
                <p>Voting</p>
            </a>
          </li>
          <?php endif;?>
          <li class="nav-item">
            <a href="<?=base_url('log_out')?>" class="nav-link ">
             <i class="nav-iconfas fas fa-sign-out-alt"></i>
                <p>Log out</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php echo $contens?>
