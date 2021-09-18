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

<!-- jQuery -->
<script src="<?= base_url('assets/plugin') ?>/plugins/jquery/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/jquery/jquery-3.3.1.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/plugin') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/plugin') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets') ?>/message.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var data_s = $("#tb_mhs").DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?php echo base_url('Tabel/tbl_vot') ?>", // URL file untuk proses select datanya
        "type": "POST"
      },
      "deferRender": true,
      "aLengthMenu": [
        [10, 20, 50],
        [10, 20, 50]
      ], // Combobox Limit
      "columns": [{
          "title": "No",
          "data": null
        },
        {
          "title": "Nim",
          "data": "nim"
        },
        {
          "title": "Jurusan",
          "data": "jurusan"
        }, {
          "title": "Tahun",
          "data": "th"
        },
        {
          "title": "Aksi",
          "render": function(data, type, row) {
            // Tampilkan kolom aksi
            var i;
            var html = '';
            html = '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus_mhss" crfsN="<?= $q ?>"data="' + row.id + '"><span class="fa fa-trash"></span></a>  <a href="javascript:;" class="btn btn-info btn-xs item_edit_mhs" crfsnU="<?= $q ?>"data="' + row.id + '"><span class="fas fa-edit"></span></a>';
            return html
          }
        }


      ]
    });

    var tbl_kategori_m = $("#tbl_kategori_m").DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?php echo base_url('Tabel/tbl_k_m') ?>", // URL file untuk proses select datanya
        "type": "POST"
      },
      "deferRender": true,
      "aLengthMenu": [
        [10, 20, 50],
        [10, 20, 50]
      ], // Combobox Limit
      "columns": [{
          "title": "No",
          "data": null
        },
        {
          "title": "Kategori Mahasiswa",
          "data": "ktegori"
        },

        {
          "title": "Aksi",
          "render": function(data, type, row) {
            // Tampilkan kolom aksi
            var i;
            var html = '';
            html = '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus_k" crfsN="<?= $q ?>"data="' + row.id + '"><span class="fa fa-trash"></span></a>  <a href="javascript:;" class="btn btn-info btn-xs item_edit_k" crfsnU="<?= $q ?>"data="' + row.id + '"><span class="fas fa-edit"></span></a>';
            return html
          }
        }

      ]
    });

    var tbl_status = $("#tbl_status").DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?php echo base_url('Tabel/tbl_status_m') ?>", // URL file untuk proses select datanya
        "type": "POST"
      },
      "deferRender": true,
      "aLengthMenu": [
        [5, 10, 50],
        [5, 10, 50]
      ], // Combobox Limit
      "columns": [{
          "title": "No",
          "data": null
        },
        {
          "title": "Status Mahasiswa",
          "data": "status"
        },


        {
          "title": "Aksi",
          "render": function(data, type, row) {
            // Tampilkan kolom aksi
            var i;
            var html = '';
            html = '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus_s" crfsN="<?= $q ?>"data="' + row.id + '"><span class="fa fa-trash"></span></a>  <a href="javascript:;" class="btn btn-info btn-xs item_edit_s" crfsnU="<?= $q ?>"data="' + row.id + '"><span class="fas fa-edit"></span></a>';
            return html
          }
        }

      ]
    });
    var tbl_jurusan = $('#tbl_jurusan').DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?php echo base_url('Tabel/tbl_jurusan') ?>", // URL file untuk proses select datanya
        "type": "POST"
      },
      "deferRender": true,
      "aLengthMenu": [
        [5, 10, 50],
        [5, 10, 50]
      ], // Combobox Limit
      "columns": [{
          "title": "No",
          "data": null
        },

        {
          "title": "Juerusan",
          "data": "jurusan"
        },
        {
          "title": "Aksi",
          "render": function(data, type, row) {
            // Tampilkan kolom aksi
            var i;
            var html = '';
            html = '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus_j" crfsN="<?= $q ?>"data="' + row.id + '"><span class="fa fa-trash"></span></a>  <a href="javascript:;" class="btn btn-info btn-xs item_edit_j" crfsnU="<?= $q ?>"data="' + row.id + '"><span class="fas fa-edit"></span></a>';
            return html
          }
        }

      ]

    })
    //membuat nomer urut
    data_s.on('draw.dt', function() {
      var PageInfo = $('#tb_mhs').DataTable().page.info();
      data_s.column(0, {
        page: 'current'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
    tbl_kategori_m.on('draw.dt', function() {
      var PageInfo = $('#tbl_kategori_m').DataTable().page.info();
      tbl_kategori_m.column(0, {
        page: 'current'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
    tbl_status.on('draw.dt', function() {
      var PageInfo = $('#tbl_status').DataTable().page.info();
      tbl_status.column(0, {
        page: 'current'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
    tbl_jurusan.on('draw.dt', function() {
      var PageInfo = $('#tbl_jurusan').DataTable().page.info();
      tbl_jurusan.column(0, {
        page: 'current'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    })

    function reload_m() {
      data_s.ajax.reload(null, true); //reload datatable ajax
    }

    function reload_s() {
      tbl_status.ajax.reload(null, true); //reload datatable ajax
    }

    function reload_k() {
      tbl_kategori_m.ajax.reload(null, true); //reload datatable ajax
    }

    function reload_j() {
      tbl_jurusan.ajax.reload(null, true); //reload datatable ajax
    }

    // aksi get_id Statud
    $('#tbl_status').on('click', '.item_edit_s', function() {
      var id, ky;
      id = $(this).attr('data');
      key = $(this).attr('crfsnu');
      console.log(key);

      $.ajax({
        type: "Get",
        url: "<?= base_url('menu/vot_get_id') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          var html;
          $('#modalEdit').modal('show');
          html = '<div class="form-group row">' +
            '<label for="" class="col-sm-3 col-form-label">Status Mahasiswa</label>' +
            '<div class="col-sm">' +
            '<input type="text"data="' + response[0].id + '"class="form-control"Value="' + response[0].status + '"name="statusE">' +
            ' </div>' +
            '</div><br>' +

            '</div>';
          var btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary" crfsup="<?= $q ?>" data="' + response[0].id + '" id="btn_update_S">Updat</button>';
          $('#btn').html(btn);
          $('#edit').html(html);

        }
      });
    })
    $('#tbl_status').on('click', '.item_hapus_s', function() {
      var id, ky;
      id = $(this).attr('data');
      key = $(this).attr('crfsn');
      $.ajax({
        type: "Get",
        url: "<?= base_url('menu/vot_get_id') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          var html;
          $('#ModalHapus').modal('show');
          html = '<p>Apakah Anda yakin mau memhapus data Status Mahasiswa' + response[0].status + '?</p>  ';
          var btb = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary"data="' + response[0].id + '" crfsds="<?= $q ?>" id="btn_hapus_st">Hapus</button>';
          $('#btn_h').html(btb);
          $('#nama').html(html);

        }
      })
    })
    $('#ModalHapus').on('click', '#btn_hapus_st', function() {
      var key, id;
      id = $(this).attr('data');
      key = $(this).attr('crfsds');
      $.ajax({
        type: "Post",
        url: "<?= base_url('menu/status_del') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          if (response.message == "ok") {
            delet();
            $('#ModalHapus').modal('hide');
            reload_s();
          } else {
            del_error();
          }
        }
      });
    })
    $('#modalEdit').on('click', '#btn_update_S', function() {
      var id, key, status, nilai;
      id = $(this).attr('data');
      key = $(this).attr('crfsup');
      status = $('[name="statusE"]').val();


      if (id == '' || key == '' || status == '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/updat_sta') ?>",
          data: {
            id: id,
            key: key,
            status: status
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              update_data();
              $('#modalEdit').modal('hide');
              reload_s();
            } else {
              updat_error();
              console.log(response.message)
            }
          }
        });
      }

    })
    $('#btn_simapn_s').on('click', function() {
      var key, status, nilai;
      key = $(this).attr('data');
      status = $('[name="status"]').val();

      if (key == '' || status == '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/simpan_s') ?>",
          data: {
            key: key,
            status: status
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              ok();
              $('[name="status]').val('');;
              reload_s();
            } else if (response.message == 'sudah_ada') {
              add_error();
            } else {
              error();
            }
          }
        });
      }
    })
    //kategori
    $('#tbl_kategori_m').on('click', '.item_hapus_k', function() {
      var id, key;
      id = $(this).attr('data');
      key = $(this).attr('crfsn');
      $.ajax({
        type: "GET",
        url: "<?= base_url('menu/get_id_km') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          var html;
          $('#ModalHapus').modal('show');
          html = '<p>Apakah Anda yakin mau memhapus data Status Mahasiswa"' + response[0].ktegori + '"?</p>  ';
          var btb = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary"data="' + response[0].id + '" crfsds="<?= $q ?>" id="btn_hapus_k">Hapus</button>';
          $('#btn_h').html(btb);
          $('#nama').html(html);
        }
      });
    })
    $('#tbl_kategori_m').on('click', '.item_edit_k', function() {
      var id, key;
      id = $(this).attr('data');
      key = $(this).attr('crfsnu');
      $.ajax({
        type: "GET",
        url: "<?= base_url('menu/get_id_km') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "Json",
        success: function(response) {
          var html;
          $('#modalEdit').modal('show');
          html = '<div class="form-group row">' +
            '<label for="" class="col-sm-3 col-form-label">Kategori Mahasiswa</label>' +
            '<div class="col-sm">' +
            '<input type="text"data="' + response[0].id + '"class="form-control"Value="' + response[0].ktegori + '"name="edit_k">' +
            ' </div>' +
            '</div><br>' +

            '</div>';
          var btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary" crfsup="<?= $q ?>" data="' + response[0].id + '" id="btn_update_k">Updat</button>';
          $('#btn').html(btn);
          $('#edit').html(html);
        }
      });
    })
    $('#ModalHapus').on('click', '#btn_hapus_k', function() {
      var key, id;
      id = $(this).attr('data');
      key = $(this).attr('crfsds');
      $.ajax({
        type: "Post",
        url: "<?= base_url('menu/km_del') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          if (response.message == "ok") {
            delet();
            $('#ModalHapus').modal('hide');
            reload_k();
          } else {
            del_error();
          }
        }
      });
    })
    $('#modalEdit').on('click', '#btn_update_k', function() {
      var id, key, kategori, nilai;
      id = $(this).attr('data');
      key = $(this).attr('crfsup');
      kategori = $('[name="edit_k"]').val();

      console.log(nilai);
      if (id == '' || key == '' || kategori == '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/update_km') ?>",
          data: {
            id: id,
            key: key,
            kategori: kategori
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              update_data();
              $('#modalEdit').modal('hide');
              reload_k();
            } else {
              updat_error();
              console.log(response.message)
            }
          }
        });
      }

    })
    $('#btn_simapn_k').on('click', function() {
      var key, status, nilai;
      key = $(this).attr('data');
      kategori = $('[name="kategori_m"]').val();

      if (key == '' || status == '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/simpan_km') ?>",
          data: {
            key: key,
            kategori: kategori
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              ok();
              $('[name="kategori_m"]').val('');

              reload_k();
            } else if (response.message == 'sudah_ada') {
              add_error();
            } else {
              error();
            }
          }
        });
      }
    })
    // Jurusan
    $('#tbl_jurusan').on('click', '.item_hapus_j', function() {
      var id, key;
      id = $(this).attr('data');
      key = $(this).attr('crfsn');
      $.ajax({
        type: "GET",
        url: "<?= base_url('menu/get_id_jrs') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          var html;
          $('#ModalHapus').modal('show');
          html = '<p>Apakah Anda yakin mau memhapus data Status Mahasiswa"' + response[0].jurusan + '"?</p>  ';
          var btb = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary"data="' + response[0].id + '" crfsds="<?= $q ?>" id="btn_hapus_j">Hapus</button>';
          $('#btn_h').html(btb);
          $('#nama').html(html);
        }
      });
    })
    $('#tbl_jurusan').on('click', '.item_edit_j', function() {
      var id, key;
      id = $(this).attr('data');
      key = $(this).attr('crfsnu');
      $.ajax({
        type: "GET",
        url: "<?= base_url('menu/get_id_jrs') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "Json",
        success: function(response) {
          var html;
          $('#modalEdit').modal('show');
          html = '<div class="form-group row">' +
            '<label for="" class="col-sm-3 col-form-label">Jurusan</label>' +
            '<div class="col-sm">' +
            '<input type="text"data="' + response[0].id + '"class="form-control"Value="' + response[0].jurusan + '"name="edit_j">' +
            ' </div>' +
            '</div>' +
            '</div>';
          var btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary" crfsup="<?= $q ?>" data="' + response[0].id + '" id="btn_update_j">Updat</button>';
          $('#btn').html(btn);
          $('#edit').html(html);
        }
      });
    })
    $('#ModalHapus').on('click', '#btn_hapus_j', function() {
      var key, id;
      id = $(this).attr('data');
      key = $(this).attr('crfsds');
      $.ajax({
        type: "Post",
        url: "<?= base_url('menu/del_jrs') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          if (response.message == "ok") {
            delet();
            $('#ModalHapus').modal('hide');
            reload_j();
          } else {
            del_error();
          }
        }
      });
    })
    $('#modalEdit').on('click', '#btn_update_j', function() {
      var id, key, jurusan;
      id = $(this).attr('data');
      key = $(this).attr('crfsup');
      jurusan = $('[name="edit_j"]').val();
      if (id == '' || key == '' || jurusan == '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/up_jurusan') ?>",
          data: {
            id: id,
            key: key,
            jurusan: jurusan
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              update_data();
              $('#modalEdit').modal('hide');
              reload_j();
            } else {
              updat_error();

            }
          }
        });
      }

    })
    $('#btn_simapn_j').on('click', function() {
      var jursan, key;
      jurusan = $('[name="jurusan"]').val();
      key = $(this).attr('data');
      console.log(key)
      if (jurusan === '' || key === '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/add_jursan') ?>",
          data: {
            key: key,
            jurusan: jurusan
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              ok();
              $('[name="jurusan"]').val('');
              reload_j();
            } else if (response.message == 'sudah_ada') {
              add_error();
            } else {
              error();
            }
          }
        });
      }

    })
    //mahasiswa
    $('#tb_mhs').on('click', '.item_hapus_mhss', function() {
      var id, key;
      id = $(this).attr('data');
      key = $(this).attr('crfsn');
      $.ajax({
        type: "GET",
        url: "<?= base_url('menu/get_mhs') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          var html;
          $('#ModalHapus').modal('show');
          html = '<p>Apakah Anda yakin mau memhapus data Status Mahasiswa"' + response[0].nim + '"?</p>  ';
          var btb = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary"data="' + response[0].id + '" crfsds="<?= $q ?>" id="btn_hapus_mhs">Hapus</button>';
          $('#btn_h').html(btb);
          $('#nama').html(html);
        }
      });
    })
    $('#tb_mhs').on('click', '.item_edit_mhs', function() {
      var id, key;
      id = $(this).attr('data');
      key = $(this).attr('crfsnu');
      $.ajax({
        type: "GET",
        url: "<?= base_url('menu/get_mhs') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "Json",
        success: function(response) {
          var html;
          $('#modalEdit').modal('show');
          html = '<div class="form-group row">' +
            '<label for="" class="col-sm-3 col-form-label">nim</label>' +
            '<div class="col-sm">' +
            '<input type="text"data="' + response[0].id + '"class="form-control"Value="' + response[0].nim + '"name="nim_e">' +
            ' </div>' +
            '</div>' +
            '</div>';
          var btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary" crfsup="<?= $q ?>" data="' + response[0].id + '" id="btn_update_m">Updat</button>';
          $('#btn').html(btn);
          $('#edit').html(html);
        }
      });
    })
    $('#ModalHapus').on('click', '#btn_hapus_mhs', function() {
      var key, id;
      id = $(this).attr('data');
      key = $(this).attr('crfsds');
      $.ajax({
        type: "Post",
        url: "<?= base_url('menu/del_mhs') ?>",
        data: {
          id: id,
          key: key
        },
        dataType: "JSON",
        success: function(response) {
          if (response.message == "ok") {
            delet();
            $('#ModalHapus').modal('hide');
            reload_m();
          } else {
            del_error();
          }
        }
      });
    })
    $('#modalEdit').on('click', '#btn_update_m', function() {
      var id, key, nim;
      id = $(this).attr('data');
      key = $(this).attr('crfsup');
      nim = $('[name="nim_e"]').val();
      if (id == '' || key == '' || nim == '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/up_mhs') ?>",
          data: {
            id: id,
            key: key,
            nim: nim
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              update_data();
              $('#modalEdit').modal('hide');
              reload_m();
            } else {
              updat_error();

            }
          }
        });
      }

    })
    $('#btn_simapn_mhs').on('click', function() {
      var jursan, key;
      nim = $('[name="nim"]').val();
      key = $(this).attr('data');

      if (nim === '' || key === '') {
        cek();
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('menu/add_mhs') ?>",
          data: {
            key: key,
            nim: nim
          },
          dataType: "Json",
          success: function(response) {
            if (response.message == 'ok') {
              ok();
              $('[name="nim"]').val('');
              reload_m();
            } else if (response.message == 'sudah_ada') {
              add_error();
            } else {
              error();
            }
          }
        });
      }
    })

  });
</script>

</body>

</html>