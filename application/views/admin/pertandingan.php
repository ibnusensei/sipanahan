<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title">Daftar <?= $title ?></h3>
                    <p class="text-muted">Sistem Informasi Atlet Panahan Banjarmasin</p>
                </div>
                <div class="col-md-6 text-right" >
                    <form role="search" action="<?= site_url('export/pertandingan') ?>" method="get" class="">
                        <input type="hidden" value="<?php echo (!empty($_GET['a'])) ? $_GET['a'] : '' ?>" name="a">
                        <input type="hidden" value="<?php echo (!empty($_GET['b'])) ? $_GET['b'] : '' ?>" name="b">
                        <button type="submit" class="btn btn-success text-white mr-3"><i class="fa fa-file" aria-hidden="true"></i> Export</button>
                        <a name="" id="" class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#create"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                    </form>
                </div>
                <div class="col-md-6">
                    <form role="search" action="<?php echo site_url('pertandingan')?>" method="get" class="app-search d-flex me-5">
                        <input type="date" value="<?php echo (!empty($_GET['a'])) ? $_GET['a'] : '' ?>" name="a" class="form-control mt-0 w-50 mr-2">
                        <input type="date" value="<?php echo (!empty($_GET['b'])) ? $_GET['b'] : '' ?>" name="b" class="form-control mt-0 w-50">
                        <button type="submit" class="btn btn-link"><i class="fa fa-search"></i></button>
                        <a name="" id="" class="btn btn-link text-danger" href="<?php echo site_url('pertandingan')?>" role="button"><i class="fa fa-times"></i></a>
                    </form>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Tanggal & Waktu</th>
                            <th class="border-top-0">Pertandingan</th>
                            <th class="border-top-0">Tingkat</th>
                            <th class="border-top-0">Pelatih</th>
                            <th class="border-top-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pertandingan as $x => $data):?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td><?= longdate_indo($data->tanggal) ?> <br> <?= $data->waktu ?></td>
                            <td><?= $data->tempat ?></td>
                            <td><?= $tingkat[$data->tingkat - 1] ?></td>
                            <td><?= $data->nama ?></td>  
                            <td>
                                <div class="text-center">
                                    <span>  
                                        <a style="cursor: pointer;" class="d-none" data-toggle="modal" data-target="#show_<?=$data->id?>">
                                            <button class="btn btn-sm btn-info mr-1"  data-placement="top"
                                                    title="" data-original-title="Peserta" style="float:left;">
                                                <i class="fa fa-user" style="color: #fafafa;"></i>
                                            </button>
                                        </a> 
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#update_<?=$data->id?>">
                                            <button class="btn btn-sm btn-primary mr-1"  data-placement="top"
                                                    title="" data-original-title="Edit" style="float:left;">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>   
                                        <a href="<?php echo site_url().'/admin/destroy/pertandingan/'.$data->id; ?>" class="btnDelete">
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" type="submit" style="float:left;">
                                                <i class="fa fa-times" style="color: #fafafa;"></i>
                                            </button>
                                        </a>    
                                    </span> 
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if ($pertandingan == null): ?>
                    <p class="text-center">Tidak Ditemukan Data</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>  


<!-- Modal Create User -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('pertandingan/store')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Pertandingan</label>
                                <input type="text" class="form-control" name="tempat" required placeholder="Pertandingan">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama">Tanggal Pertandingan</label>
                                    <input type="date" class="form-control" name="tanggal" required placeholder="Tanggal Pertandingan">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama">Waktu Pertandingan</label>
                                    <input type="time" class="form-control" name="waktu" required placeholder="Waktu Pertandingan">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Tingkat</label>
                                <select class="form-control" name="tingkat" required>
                                    <option>Pilih Tingkat</option>
                                    <?php foreach ($tingkat as $x => $d) : ?>
                                        <option value="<?= $x+1 ?>"><?= $d ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Pelatih</label>
                                <select class="form-control" name="user_id" required>
                                    <option>Pilih Pelatih</option>
                                    <?php foreach ($user as $x => $d) : ?>
                                        <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Update User -->
<?php foreach ($pertandingan as $d): ?>
<div class="modal fade" id="update_<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit Pertandingan</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('pertandingan/update')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id" value="<?= $d->id ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Pertandingan</label>
                                <input type="text" class="form-control" name="tempat" value="<?= $d->tempat ?>" required placeholder="Pertandingan">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama">Tanggal Pertandingan</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?= $d->tanggal ?>" required placeholder="Tanggal Pertandingan">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama">Waktu Pertandingan</label>
                                    <input type="time" class="form-control" name="waktu" value="<?= $d->waktu ?>" required placeholder="Waktu Latihan">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Tingkat</label>
                                <select class="form-control" name="tingkat" required>
                                    <option>Pilih Tingkat</option>
                                    <?php foreach ($tingkat as $x => $e) : ?>
                                        <option value="<?= $x+1 ?>" <?= ($d->tingkat == $x+1) ? 'selected' : '' ?>><?= $e ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Pelatih</label>
                                <select class="form-control" name="user_id" required>
                                    <option>Pilih Pelatih</option>
                                    <?php foreach ($user as $x => $e) : ?>
                                        <option value="<?= $e->id ?>" <?= ($d->user_id == $e->id) ? 'selected' : '' ?>><?= $e->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="" rows="3"><?= $d->deskripsi ?></textarea>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="show_<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Detail Latihan</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('pertandingan/update')?>" method="post" enctype="multipart/form-data">
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
                <hr>
                <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nilai</th>
                            <th class="border-top-0">Anggota</th>
                            <th class="border-top-0">Aksi</th>
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
                            <td>
                                <div class="text-center">
                                    <span>  
                                        <a href="<?php echo site_url().'/admin/destroy/kehadiran/'.$data->id; ?>" class="btnDelete">
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" type="submit" style="float:left;">
                                                <i class="fa fa-times" style="color: #fafafa;"></i>
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

