<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-12 d-none">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted">Sistem Informasi Atlet Panahan Banjarmasin</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title">Daftar <?= $title ?></h3>
                    <p class="text-muted">Sistem Informasi Atlet Panahan Banjarmasin</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Tanggal & Waktu</th>
                            <th class="border-top-0">Tempat</th>
                            <th class="border-top-0">Pelatih</th>
                            <th class="border-top-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($latihan as $x => $data):?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td><?= longdate_indo($data->tanggal) ?> <br> <?= $data->waktu ?></td>
                            <td><?= $data->tempat ?></td>
                            <td><?= $data->nama ?></td>  
                            <td>
                                <div class="text-center">
                                    <span> 
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#show_<?=$data->id?>">
                                            <button class="btn btn-sm btn-info mr-1"  data-placement="top"
                                                    title="" data-original-title="Peserta" style="float:left;">
                                                <i class="fa fa-user" style="color: #fafafa;"></i>
                                            </button>
                                        </a>
                                    </span> 
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  


<!-- Modal Update User -->
<?php foreach ($latihan as $d): ?>

<div class="modal fade" id="show_<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Detail Latihan</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nilai</th>
                            <th class="border-top-0">Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $this->load->model('m_app');
                    $kehadiran = $this->m_app->getKehadiran($d->id)->result();
                    ?>
                    <?php foreach ($kehadiran as $x => $data):?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td><?= $data->nilai ?></td>
                            <td><?= $data->nama ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                    $hadir = $this->m_app->getKehadiran($d->id, $this->session->id)->num_rows();
                    if ($hadir == null): ?>
                        <tr>
                            <td colspan="3">
                                <form role="form" action="<?php echo site_url('atlet/kehadiran')?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" name="latihan_id" value="<?= $d->id ?>">
                                    <button type="submit" class="btn btn-primary btn-block">Hadir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php endforeach ?>



<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });


</script>

