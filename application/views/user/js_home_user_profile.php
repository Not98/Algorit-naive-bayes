<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1
  </div>
  <strong>Copyright &copy; <?= date('Y') ?> <a href="">Programer Mahal</a>.</strong> All rights
  reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQu-- jQuery -->
<script src="<?= base_url('assets/plugin') ?>/plugins/jquery/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/plugin') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/plugin') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets') ?>/message.js"></script>
<script src="<?= base_url('assets/plugin') ?>/dist/js/demo.js"></script>
<script>
  $(document).ready(function() {
    $('#simpan').on('click', function() {
      var key = $('.card').attr('data');
      var jk = $("[name='jk[]']:checked").val();
      var kls = $("[name='klas[]']:checked").val();
      var status = $('#status').val();
      var th = $('#th').val();
      var semester = $('#semester').val();
      var prod = $('#prodi').val();
      if (jk === undefined) {
        cek();
      } else if (status === '') {
        cek();
      } else if (kls === undefined) {
        cek();
      } else if (semester === '') {
        cek();
      } else if (prod === '') {
        cek();
      }else if (th === '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('user/addpro') ?>",
          data: {
            jk: jk,
            kls: kls,
            status: status,
            semester: semester,
            prod: prod,
            key: key,
            th,th

          },
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.message == "ok") {
              Swal.fire({
                title: 'Apakah data sudah benar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if (result.value) {
                  document.location.href = "<?= base_url('user') ?>";
                }
              })
            }
          }
        });
      }

    })


  });
</script>

</body>

</html>