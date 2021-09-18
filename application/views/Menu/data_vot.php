<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Status Mahasiswa</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>

        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-7">

            <table id="tbl_status" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
            </table>


          </div>

          <div class="col-sm-5">
            <form class="form-horizontal" id="status">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Status Mahasiswa</label>
                <div class="col-sm">
                  <?= form_error('kkategori') ?>
                  <input type="text" class="form-control <?= form_error('kkategori') ? 'is-invalid' : ''; ?>" name="status">
                </div>
              </div>


              <button type="button" class="btn btn-primary float-right" data="<?= $q ?>" id="btn_simapn_s" name="btn_simapn_s"> Simpan</button>

            </form>
          </div>
        </div>


      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->


    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Kategori Mahasiswa</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>

        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-7">
            <table id="tbl_kategori_m" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
            </table>


          </div>

          <div class="col-sm-5">
            <form class="form-horizontal">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Kategori Mahasiswa</label>
                <div class="col-sm">
                  <?= form_error('kkategori') ?>
                  <input type="text" class="form-control <?= form_error('kkategori') ? 'is-invalid' : ''; ?>" name="kategori_m">
                </div>
              </div>

              <button type="button" class="btn btn-primary float-right" data="<?= $q ?>" id="btn_simapn_k" name="btn_simapn_k"> Simpan</button>

            </form>
          </div>
        </div>


      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->


    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Jurusan</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>

        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-7">
            <table id="tbl_jurusan" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
            </table>


          </div>

          <div class="col-sm-5">
            <form class="form-horizontal">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">jurusan</label>
                <div class="col-sm">

                  <input type="text" class="form-control <?= form_error('kkategori') ? 'is-invalid' : ''; ?>" name="jurusan">
                </div>
              </div>

              <button type="button" class="btn btn-primary float-right" data="<?= $q ?>" id="btn_simapn_j" name="btn_simapn_j"> Simpan</button>

            </form>
          </div>
        </div>


      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Acount Mahasiswa Dilengkapi</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>

        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-7">

            <table id="tb_mhs" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
            </table>

          </div>

          <div class="col-sm-5">
            <form class="form-horizontal" id="mhs">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Nim</label>
                <div class="col-sm">
                  <?= form_error('kkategori') ?>
                  <input type="text" class="form-control <?= form_error('kkategori') ? 'is-invalid' : ''; ?>" name="nim">
                </div>
              </div>


              <button type="button" class="btn btn-primary float-right" data="<?= $q ?>" id="btn_simapn_mhs" name="btn_simapn_s"> Simpan</button>

            </form>
          </div>
        </div>


      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal hapus-->
<div class="modal fade" id="ModalHapus" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value="" disabled>


        <div class="alert alert-warning" id="nama"> </div>

      </div>
      <div class="modal-footer justify-content-between" id="btn_h">

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- end modal hapus-->



<!-- modal edit-->
<div class="modal fade" id="modalEdit" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="edit">


      </div>
      <div class="modal-footer justify-content-between" id="btn">

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- end modal hapus-->