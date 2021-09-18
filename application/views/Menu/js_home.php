

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1
    </div>
    <strong>Copyright &copy; <?= date('Y')?> <a href="">Programer Mahal</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugin')?>/plugins/jquery/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugin')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/plugin')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/plugin')?>/dist/js/demo.js"></script>
 <script>
        $(document).ready(function(){
          var donut_chart = Morris.Donut({
          element: 'chart',
          data:<?php echo json_encode($donut)?>,
          formatter: function (x) { return x + "Vote"}
          });

        var tahun_angkat =  Morris.Line({
                element: 'tahun-a',
                data: "+ json_encode($donut)+",
                xkey: 'elapsed',
                ykeys: ['value'],
                labels: ['value'],
                parseTime: false
              });

        });
      </script>
  
</body>
</html>
