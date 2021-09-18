<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voting <?= $this->uri->segment(2) ?></title>

  <style>
    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    button {
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      font-family: Raleway;
      cursor: pointer;
    }

    button:hover {
      opacity: 0.8;
    }

    #prevBtn {
      background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #4CAF50;
    }
  </style>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugin') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugin') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" src="<?= base_url('') ?>assets/plugin/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/plugin') ?>/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?= base_url('assets/plugin') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

</head>

<body class="login-page" style="min-height: 512.391px;">
  <div class="login-box">
    <div class="login-logo">
      <b>Slamat Datang </b><br><?= $this->session->userdata('nim'); ?>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body">
        <form id="vot" action="<?= base_url('user/vot/').$this->uri->segment(2) ?>" method="post">
          <label oninput="this.className = ''"></label>
          <?php if ($soal != null) : ?>

            <?php $c=0; foreach ($soal as $so) :?>

            <?php if ($so['id'] != null || $so['soal'] != null):$c++  ?>
              <div class="tab">
                <p id='soal' data="<?= $so['id'] ?>"><?= $so['soal'] ?></p>
                <?php $query = $this->db->select('kategori.id as id, kategori.kategori')
                ->from('kategori')
                ->join('jawaban', 'jawaban.id_kategori = kategori.id')
                ->join('penilaian', 'penilaian.id = jawaban.id_penialian')
                ->where('penilaian.id', $so['id'])->get()->result_array();
                foreach ($query as $s) : ?>
                  <div>
                    <div id="msg"></div>
                    <input type="radio" oninput="this.className = ''" id="<?= $so['layanan'] ?>" name="<?=  substr(preg_replace("/[^A-Za-z0-9]/", "",$so['layanan']),5,10); $this->session->set_userdata('inp',substr(preg_replace("/[^A-Za-z0-9]/", "",$so['layanan']),5,10)); ?>" value="<?= $s['id'] ?>">
                    <label for="<?= $so['soal'] ?>"><?= $s['kategori'] ?></label>
                  </div>
                <?php endforeach ?>
              </div>
            <?php endif ?>
          <?php endforeach ?>
          <div>
          </div>
          <?php if($c):?>
            <div style="overflow:auto;">
              <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
              </div>
            </div>
            <?php else:?>
              <h3>Anda Sudah Voting</h3>
              <a class="btn btn-primary col-5  btn-block float-right" href="<?=base_url('voting')?>"> beck</a>
            <?php endif;?>



            <div style="text-align:center;margin-top:40px;">
              <?php foreach ($soal as $so) : ?>
                <?php if ($so['id'] != null || $so['soal'] != null) : ?>
                  <span class="step"></span>
                <?php endif ?>
              <?php endforeach ?>
            </div>
          </form>
        <?php endif; ?>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <!-- jQuery -->
  <script src="<?= base_url('assets/plugin') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/plugin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/plugin') ?>/dist/js/adminlte.min.js"></script>
  <script src="<?= base_url('assets/plugin') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url('assets') ?>/message.js"></script>


  <script>
    var currentTab = 0; // Tab saat ini disetel menjadi tab pertama (0)
    showTab(currentTab); // Menampilkan tab saat ini

    function showTab(n) {
      // Fungsi ini akan menampilkan tab yang ditentukan dalam bentuk ...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      // ... dan perbaiki tombol Sebelumnya / Berikutnya:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      // ... dan jalankan fungsi yang akan menampilkan indikator langkah yang benar:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // Fungsi ini akan menentukan tab mana yang akan ditampilkan
      var x = document.getElementsByClassName("tab");
      // Keluar dari fungsi jika ada bidang di tab saat ini yang tidak valid:
      if (n == 1 && !validateForm()) return false;
      // Sembunyikan tab saat ini:
      x[currentTab].style.display = "none";
      // Naikkan atau turunkan tab saat ini sebesar 1:
      currentTab = currentTab + n;
      // jika Anda telah mencapai akhir formulir ...
      if (currentTab >= x.length) {
        // ... formulir dikirimkan:
        document.getElementById("vot").submit();
        return false;
      }
      // Jika tidak, tampilkan tab yang benar:
      showTab(currentTab);
    }

    function validateForm() {
      // Fungsi ini berhubungan dengan validasi bidang formulir

      var x, y, i, btn = 0,
      valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");

      // Perulangan yang memeriksa setiap bidang masukan di tab saat ini:
      for (i = 0; i < y.length; i++) {
        // Jika sebuah field kosong 
        if (y[i].checked == true) {
          btn += 1;
        } else {
          btn += 0
        }
      }
      if (btn == 1) {
        valid = true;
      } else {
        valid = false;
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          icon: 'warning',
          title: 'Pilih salah satau jawaban'
        })
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // Fungsi ini menghapus kelas "aktif" dari semua langkah ...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      // ... dan menambahkan kelas "aktif" pada langkah saat ini:
      x[n].className += " active";
    }
  </script>

</body>

</html>