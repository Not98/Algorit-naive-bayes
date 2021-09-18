

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

<!--  jQuery -->
<script src="<?= base_url('assets/plugin')?>/plugins/jquery/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugin')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/plugin')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

 <script>
  $(document).ready(function(){
    function soal(){

    }
    // function gets(){
    //   var cekb=$('.x');
    //   $.each(cekb,function(){
    //     var idd='';
    //     idd+=$(this).attr('data');
    //     $.ajax({
    //     type: "post",
    //     url: "<?=base_url('user/ajaxsoal')?>",
    //     data: {ids:idd},
    //     dataType: "json",
    //     success: function (respons) {
          
    //      var html='';
    //       for (let i = 0; i < respons.length; i++) {
    //       html+='<input type="radio" name="jawaban-'+idd+'" value="'+respons[i].nilai+'">'+respons[i].kategori+'';
    //       }
        
         
    //       $('#jawab-'+idd).html(html);
           
    //     }
    //     });
		// 		})
      
    //     return true;
    // }
    // gets();
   
  $("#vot").on('click',function(){
    var id='';
    var cekb=$('.x');
      $.each(cekb,function(){
        id+=$(this).attr('data');
        
      })
      console.log(id)
    })
    
  });
  </script>
  
</body>
</html>
