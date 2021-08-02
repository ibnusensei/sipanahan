<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title"><?= $title ?></h3>
                    <p class="text-muted">Sistem Informasi Atlet Panahan Banjarmasin</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Tanggal</th>
                            <th class="border-top-0">Bonus</th>
                            <th class="border-top-0">Nominal</th>
                            <th class="border-top-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($bonus as $x => $data):?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td><?= longdate_indo($data->tanggal) ?></td>
                            <td><?= $data->bonus ?></td>  
                            <td>
                                <?= rupiah($data->jumlah) ?>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span>  
                                        <a style="cursor: pointer;" class="" data-toggle="modal" data-target="#show_<?=$data->id?>">
                                            <button class="btn btn-sm btn-warning mr-1"  data-placement="top"
                                                    title="" data-original-title="Bonus" style="float:left;">
                                                <i class="fa fa-eye" style="color: #fafafa;"></i>
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


<!-- Modal Create User -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('bonus/store')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Bonus</label>
                                <input type="text" class="form-control" name="bonus" required placeholder="Bonus">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" required placeholder="Jumlah">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" required placeholder="Tanggal">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Anggota</label>
                                <select class="form-control" name="user_id" required>
                                    <option>Pilih Anggota</option>
                                    <?php foreach ($user as $x => $d) : ?>
                                        <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan Tambahan</label>
                            <textarea class="form-control" name="ket" id="ket" rows="3"></textarea>
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
<?php foreach ($bonus as $d): ?>
<div class="modal fade" id="update_<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit Bonus</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('bonus/update')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id" value="<?= $d->id ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Bonus</label>
                                <input type="text" class="form-control" name="bonus" value="<?= $d->bonus ?>" required placeholder="Bonus">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?= $d->tanggal ?>" required placeholder="Tanggal Pertandingan">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" value="<?= $d->jumlah ?>" required placeholder="Jumlah">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Anggota</label>
                                <select class="form-control" name="user_id" required>
                                    <option>Pilih Anggota</option>
                                    <?php foreach ($user as $x => $e) : ?>
                                        <option value="<?= $e->id ?>" <?= ($d->user_id == $e->id) ? 'selected' : '' ?>><?= $e->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan Tambahan</label>
                            <textarea class="form-control" name="ket" id="ket" rows="3"><?= $d->ket ?></textarea>
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
                <h4 class="modal-title" id="exampleModalLabel"><?= $d->bonus ?></h4>
            </div>
            <div class="modal-body">
                <p><?= $d->nama ?></p>
                <br>
                <p class="text-sm text-muted">Bonus <?= rupiah($d->jumlah) ?> <br> diterima pada tanggal <?= date_indo($d->tanggal) ?></p>
                <hr>
                <p class="text-semibold"><?= $d->ket ?></p>
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

