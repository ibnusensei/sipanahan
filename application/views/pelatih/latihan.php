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
                <?php if ($d->user_id == $this->session->id): ?>
                <form role="form" action="<?php echo site_url('latihan/kehadiran')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="latihan_id" value="<?= $d->id ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Peserta</label>
                                <select class="form-control" name="user_id" required>
                                    <option>Pilih Anggota</option>
                                    <?php foreach ($anggota as $x => $e) : ?>
                                        <option value="<?= $e->id ?>"><?= $e->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="number" max="10" min="0" class="form-control" name="nilai" id="" aria-describedby="helpId" placeholder="Nilai">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>
                    </div>
                </form>    
                <?php endif; ?>
                
                <hr>
                <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nilai</th>
                            <th class="border-top-0">Anggota</th>
                            <?php if ($d->user_id == $this->session->id): ?>
                                <th class="border-top-0">Aksi</th>
                            <?php endif; ?>
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
                            <?php if ($d->user_id == $this->session->id): ?>
                            <td>
                                <div class="text-center">
                                    <span>  
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#update_nilai_<?=$data->id?>">
                                            <button class="btn btn-sm btn-primary mr-1"  data-placement="top"
                                                    title="" data-original-title="Edit" style="float:left;">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a> 
                                    </span> 
                                </div>
                                <div class="modal fade" id="update_nilai_<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Edit Kehadiran</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" action="<?php echo site_url('latihan/kehadiran_update')?>" method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <!-- Hidden Input disini yaa -->
                                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                            <input type="hidden" name="id" value="<?= $data->id ?>">
                                                        <!-- Hidden Input disini yaa -->

                                                        <div class="col-xs-6">
                                                            <div class="form-group">
                                                                <label for="">Peserta</label>
                                                                <select class="form-control" name="user_id" required>
                                                                    <option>Pilih Anggota</option>
                                                                    <?php foreach ($anggota as $x => $a) : ?>
                                                                        <option value="<?= $a->id ?>" <?= ($a->id == $data->user_id) ? 'selected':''; ?>><?= $a->nama ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <input type="number" max="10" min="0" class="form-control" name="nilai" id="" aria-describedby="helpId" placeholder="Nilai" value="<?= $data->nilai ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
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

