<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card" data="<?= $this->session->userdata('key') ?>"">
      <div class=" card-header">
        <h3 class="card-title">Profile</h3>

        <div class="card-tools">
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-5 offset-4">
            <form action="">
              <div class="form-group row">
                <label for="nim" class="col-sm-4 col-form-label">Nim</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control " id="nim" placeholder="<?= $akun['nim'] ?>" disabled>
                </div>
              </div>


              <div class="form-group row">
                <label for="jenis_k" class="col-sm-4 col-form-label">Jenis kelamin</label>
                <div class="form-check col-md-3">
                  <input class="form-check-input" type="radio" name="jk[]" value="L">
                  <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check col-md-3">
                  <input class="form-check-input" type="radio" name="jk[]" value="P">
                  <label class="form-check-label">Permpuan</label>
                </div>
              </div>

              <div class="form-group row">
                <label for="status" class="col-sm-4 col-form-label">Status Mahasiswa </label>
                <div class="col-sm-6">
                  <select name="status" id="status">
                    <option value="">-- Pilih Status --</option>
                    <?php $semester = $this->db->get('status')->result_array();
                    foreach ($semester as $sm) : ?>
                      <?php if ($sm['id'] != 1) : ?>
                        <option value="<?= $sm['id'] ?>"><?= $sm['status'] ?></option>
                      <?php endif ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>


              <div class="form-group row">
                <label for="status" class="col-sm-4 col-form-label">Tahun Angkatan </label>
                <div class="col-sm-6">
                  <select name="th" id="th">
                    <option value="">-- Pilih Tahun Angkatan --</option>
                    <?php for ($i=16; $i < 20 ; $i++): ?>
                      
                      <option value="<?= '20'.$i ?>"><?= '20'.$i ?></option>
                      
                    <?php endfor;?>
                  </select>
                </div>
              </div>


              <div class="form-group row">
                <label for="jenis_k" class="col-sm-4 col-form-label">Kelas Mahasiswa</label>
                <div class="form-check col-md-3">
                  <input class="form-check-input" type="radio" value="Karyawan" name="klas[]">
                  <label class="form-check-label">Karyawan</label>
                </div>
                <div class="form-check col-md-3">
                  <input class="form-check-input" type="radio" value="Reguler" name="klas[]">
                  <label class="form-check-label">Reguler</label>
                </div>
              </div>

              <div class="form-group row">
                <label for="semester" class="col-sm-4 col-form-label">Semester </label>
                <div class="col-sm-6">
                  <select name="semester" id="semester">
                    <option value="">-- Pilih Semester --</option>
                    <?php $semester = $this->db->get('semester')->result_array();
                    foreach ($semester as $sm) : ?>
                      <?php if ($sm['semester'] != 0) : ?>
                        <option value="<?= $sm['semester'] ?>"><?= $sm['semester'] ?></option>
                      <?php endif ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="prodi" class="col-sm-4 col-form-label">Pilih Prodi Jurusan </label>
                <div class="col-sm-6">
                  <select name="prodi" id="prodi">
                    <option value="">-- Pilih Prodi Jurusan --</option>
                    <?php $semester = $this->db->get('jurusan')->result_array();
                    foreach ($semester as $sm) : ?>
                      <?php if ($sm['id'] != 0) : ?>
                        <option value="<?= $sm['id'] ?>"><?= $sm['jurusan'] ?></option>
                      <?php endif ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>


              <button type="button" class="btn btn-primary float-right" id="simpan">Simpan</button>
            </form>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <marquee behavior="" direction="">Harap Mengisi Biodata Sebelum Voting</marquee>
      </div>
      <!-- /.card-footer-->

      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->