<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Penialaian</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>

          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-7">
              <table id="tb_nilai" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">

              </table>

            </div>

            <div class="col-sm-5">
              <form class="form-horizontal" id="penilain">
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Penilaian</label>
                  <div class="col-sm">
                    <?= form_error('kkategori') ?>
                    <input type="text" class="form-control <?= form_error('kkategori') ? 'is-invalid' : ''; ?>" name="Kategori">
                  </div>
                </div>


                <button type="button" class="btn btn-primary float-right" id="btn_simapn_P" name="btn_simapn_P"> Simpan</button>
              </button>

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
          <h3 class="card-title">Layanan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>

            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table id="tbl_layanan" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">

                </table>
              </div>
              <div class="col-sm-5">
                <form>
                  <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Layanan</label>
                    <div class="col-sm">
                      <input type="text" class="form-control <?= form_error('nilai') ? 'is-invalid' : ''; ?>" name="Layanann">
                    </div>
                  </div>


                  <button type="button" name="btn_simapn_l" class="btn btn-primary float-right"> Simpan</button>
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




        <!-- kuesioner -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">kuesioner</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>

              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <table id="tbl_kuesioner" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">

                  </table>
                </div>
                <div class="col-sm-5 soal">
                  <form id="simpan">
                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label">Layanan</label>
                      <div class="col-sm">
                        <select class="form-control" id="La" key="f64bcbe9a0d6aba323de32598558d87f15df084c396b401d8024ac1ad170714d5fc6963842ca3c7b5c3b93a006f826d5ea77b435ffe0f2e3068d270852a12ee9AvAN6GXxwneWMVMTe4E+I4s4Bzd6Yxs9DqARhfDmYDXs5371JQJQ+AL9y/U84QHl" name="La">
                          <option name="ops">Pilih Layanan</option>
                        </select>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label">Untuk Mahasiswa</label>
                      <div class="col-sm">
                        <select class="form-control" name="kats">
                          <option >Pilih kategori Mhs</option>
                          <option value="9999">Label</option>
                          <?php if ($status):?>
                            <?php foreach ($status as $key => $value): ?>
                              <?php if($value['id']!=1):?>

                                <option value="<?=$value['id']?>" ><?=$value['status']?></option>
                              <?php endif;?>
                            <?php endforeach;?>
                          <?php endif;?>
                        </select>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label">jawaban yang di tampilkan</label>
                      <div class="col-sm jwb">

                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label">kuesioner</label>
                      <div class="col-sm">
                        <textarea class="form-control" rows="3" name="pertanyaan" placeholder="Pertanyaan"></textarea>
                      </div>
                    </div>


                    <button type="button" name="btn_simapn_ku" class="btn btn-primary float-right"> Simpan</button>
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