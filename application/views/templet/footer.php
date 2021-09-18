
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.4
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
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
<script src="<?= base_url('assets/AdminLTE-master')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/AdminLTE-master')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/AdminLTE-master')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/AdminLTE-master')?>/dist/js/demo.js"></script>
<?php 
    $home=" <script>
        $(document).ready(function(){
          var donut_chart = Morris.Donut({
          element: 'chart',
          data:<?php echo json_encode($donut)?>,
          formatter: function (x) { return x + "+'Vote'+"}
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
      </script>"
    ?>

<?php if ($this->uri->segment(1) == 'Home'): ?>
    <?= $home?>
<?php else: ?>
<?php endif; ?>
</body>
</html>
