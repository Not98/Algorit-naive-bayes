$('.edit').on('click','[name="btn_edit_kuess"]',function(){
    var key = $('#La').attr('key');
    var l = $("[name='La']").val();
    var p = $("[name='pertanyaan']").val();
    var pid =$('.edit').attr('data');
    console.log(pid);
    var d=	$('.get_value').each(function(){
      $(this).map(function(){
        return  this.elements ? $.makeArray(this.elements) : this;
      })
      $(this).filter(function(){
        return   this.name && !this.disabled &&(this.checked);
      })
      .map(function (i, elem) {
             var val = $(this).val();
             return val == null ?
             null :
             $.isArray(val) ?
             $.map(val, function (val, i) {
                 return { name: elem.name, value: val };
             }) :
             {
                 name: elem.name,
                value: ($(this).checkboxesAsBools && this.type === 'checkbox') ?
                        (this.checked ? true : false) :
                        val
             };
         }).get();

    });
    if (l ==="--Pilih Layanan --") {
      cek();
    }else if( p==="" || d.serializeArray({checkboxesAsBools:true}).length <1){
      cek();
    }
    else{
      // console.log(d.serializeArray({checkboxesAsBools:true}));
      $.ajax({
          type: "post",
          url: "<?=base_url('menu/updatjawaban')?>",
          data: {jawab:d.serializeArray({checkboxesAsBools:true}),p:p,l:l,key:key,pid:pid},
          dataType: "json",
          success: function (respons) {
            if (respons.message == "ok") {
              $("[name='La']").val("--Pilih Layanan --");
              $("[name='pertanyaan']").val('');

              ok();
              reload_kuesioner();
            }else if(responsok.message == "sudah_ada"){
              add_error();
            }else if(respons.message == "error"){
              cek();
            }
          }
          });

    }

    return false;
  })
