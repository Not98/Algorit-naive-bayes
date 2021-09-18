
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
    </section>
    <!-- Main content -->
    <section class="content">

        <form action="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8">

            <!-- SmartWizard html -->
            <div id="smartwizard">
                <ul>
                    <?php $no=0;foreach($soal as $ss):$no++ ?>
                    <li><a href="#step-<?=$no?>">Pertanyaan <?=$no?><br /></a></li>
                <?php endforeach;?>
            </ul>

            <div>
                
             
               
             
                <?php $noo=0;foreach ($soal as $s):$noo++ ?>
                <div id="step-<?=$noo?>">
                    <h2><?=$s['soal']?></h2>
                    <div id="form-step-<?=$noo?>" role="form" >
                        <div class="form-group">
                            <label for="<?=$s['soal']?>">Pilih Jawaban </label>
                            <div class="x" data="<?=$s['id']?>"id="jawab-<?=$s['id']?>" >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach;?>
        </div>

    </form>

</div>




</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
