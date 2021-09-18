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
        <h3 class="card-title">Pertanyaan</h3>

        <div class="card-tools">
          <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->

          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <?php if ($soal):?> 

              <?php if ($jumlah != null || $soal != null || $soal['total'] != 0) : ?>
                <?php $corl = ['', 'bg-info', 'bg-primary', 'bg-lime', 'bg-orange', 'bg-orange'];
                $i = 0;
                foreach ($jumlah as $s) : $i++ ?>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box <?= $corl[$i] ?>">
                      <div class="inner">
                        <h2> <?= $s['total'] ?> Pertanyaan</h2>

                        <p>
                         <?= $s['layanan'] ?>
                       </p>
                     </div>
                     <div class="icon">
                      <i class="ion "></i>
                    </div>
                    <a href="<?= base_url('vote/') . str_replace(' ','_',$s['layanan']) ?>" class="small-box-footer">Voting <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>





              <?php endforeach; ?>
            <?php endif; ?>
          <?php endif; ?>




        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->