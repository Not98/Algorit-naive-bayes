<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Naivfe Bayes</title>
  <link href="<?= base_url('assets/') ?>i.ico " rel="shortcut icon" type="image/ico" />

  <link rel="stylesheet" src="<?= base_url('') ?>assets/morris/morris.css">
</link>
<link rel="stylesheet" src="<?= base_url('') ?>assets/morris/morris.css">
</link>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?= base_url('') ?>assets/plugin/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url('') ?>assets/plugin/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="<?= base_url('') ?>" class="navbar-brand">
          <img src="<?= base_url('') ?>assets/ICON.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Naive Bayes</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?= base_url('') ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('login') ?>" class="nav-link">Login To Voting</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('new_accout') ?>" class="nav-link">New Acount To Voting</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('cetak/pdf') ?>" class="nav-link">Cetak Prediksi</a>
            </li>
          </ul>

        </div>

        <!-- Right navbar links -->

      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="total">

            </div>

          </div>

        </div>
        <div class="row">
          <?php if ($tampil) :?>
            <div class="col-md-6">
              
              <?php foreach ($tampil as $layanan): ?>
                <?php if($layanan['layanan']!=null):?>
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><?=$layanan['layanan']?> :     <?=$layanan['pertanyaan']?></h3>
                    </div>
                    <div class="card-body">

                      <div id="chart<?=$layanan['id']?>"></div>
                    </div>
                    <!-- /.card-body -->
                  </div>   
                <?php endif;?>
              <?php endforeach;?>

            </div>

            <div class="col-md-6">
              <?php foreach ($tampil as $layanan): ?>
                <?php if($layanan['layanan']!=null):?>

                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Vot Angkatan  </h3>
                    </div>
                    <div class="card-body">
                      <div id="tahun-<?=$layanan['id']?>"></div>
                    </div>
                    <!-- /.card-body -->
                  </div>            
                <?php endif;?>

              <?php endforeach;?>

            </div>  

          <?php endif;?>


        </div>
        <!-- End -->




      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Skripsi
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy;<?= date('Y') ?> <a href="">Programer Mahal</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/plugin') ?>/plugins/jquery/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/plugin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/plugin') ?>/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('') ?>assets/plugin/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('') ?>assets/morris/morris.min.js"></script>

  <script src="<?= base_url('') ?>assets/plugin/plugins/raphael/raphael.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

     <?php if($tampil!=0):?>
      <?php foreach ($tampil as  $value):?>
        <?php if($layanan['layanan']!=null):?>

         function jwa<?=$value['id']?>bT() {
          var id= <?=$value['id']?>;
          $.ajax({
            type: "GET",
            url: "<?=base_url('trafix/layanan')?>",
            data:{id:id},
            dataType: "JSON",
            success: function(response) {
              Morris.Donut({
                element: 'chart<?=$value['id']?>',
                data: response,
                formatter: function(x) {
                  return x + ' Vote Masuk'
                }
              });

            }
          });
        }
        function th<?=$value['id']?>bT() {
          var id= <?=$value['id']?>;
          $.ajax({
            type: "GET",
            url: "<?=base_url('trafix/tahun')?>",
            data:{id:id},
            dataType: "JSON",
            success: function(response) {
             Morris.Line({
              element: 'tahun-<?=$value['id']?>',
              data: response,
              xkey: 'elapsed',
              ykeys: ['value'],
              labels: ['Mahasiswa'],
              parseTime: false
            });
             
           }
         });
        }
        jwa<?=$value['id']?>bT();
        th<?=$value['id']?>bT();
      <?php endif;?>
    <?php endforeach;?>

    function total() {
      $.ajax({
        type: "GET",
        url: "<?=base_url('trafix/total')?>",
        data:{id:id},
        dataType: "JSON",
        success: function(response) {
         Morris.Line({
          element: 'total',
          data: response,
          xkey: 'elapsed',
          ykeys: ['value'],
          labels: ['Mahasiswa'],
          parseTime: false
        });

       }
     });
    }
  <?php endif;?>
});
</script>



</body>

</html>