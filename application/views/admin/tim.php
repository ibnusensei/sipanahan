<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title">Daftar Tim Panahan</h3>
                    <p class="text-muted">Sistem Informasi Atlet Panahan Banjarmasin</p>
                </div>
                <div class="col-md-6 text-right" >
                    <a name="" id="" class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#create"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                </div>
                <div class="col-md-6">
                    <form role="search" action="<?php echo site_url('tim')?>" method="get" class="app-search d-flex me-5">
                        <input type="text" placeholder="Cari Tim..." value="<?php echo $_GET['search'] ?? '' ?>" name="search" class="form-control mt-0">
                        <button type="submit" class="btn btn-link"><i class="fa fa-search"></i></button>
                        <a name="" id="" class="btn btn-link text-danger" href="<?php echo site_url('tim')?>" role="button"><i class="fa fa-times"></i></a>
                    </form>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nama</th>
                            <th class="border-top-0">Lokasi</th>
                            <th class="border-top-0">Cabang</th>
                            <th class="border-top-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tim as $x => $data): ?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td><?= $data->tim ?></td>
                            <td><?= $data->lokasi ?></td>
                            <td><?= $data->cabang ?></td>
                            <td>
                                <div class="text-center">
                                    <span>
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#update_<?=$data->id?>">
                                            <button class="btn btn-sm btn-primary mr-1"  data-placement="top"
                                                    title="" data-original-title="Edit" style="float:left;">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="<?php echo site_url().'/admin/destroy/users/'.$data->id; ?>" class="btnDelete">
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
                <form role="form" action="<?php echo site_url('tim/store')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="tim" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" placeholder="Lokasi">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Cabang</label>
                                    <input type="text" class="form-control" name="cabang" placeholder="Cabang">
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
<?php foreach ($tim as $d): ?>
<div class="modal fade" id="update_<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit User</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('tim/update')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id" value="<?= $d->id ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="tim" placeholder="Nama Lengkap" value="<?= $d->tim ?>">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" value="<?= $d->lokasi ?>">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Cabang</label>
                                    <input type="text" class="form-control" name="cabang" placeholder="Cabang" value="<?= $d->cabang ?>">
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

<?php if ($d->id != null): 
	$id = $d->id;
	echo "
	<script type='text/javascript'>
    function readURL"?><?= $id ?><?php echo "(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah_" ?><?= $id ?><?php echo "')
                    .attr('src', e.target.result)
                    .height(200);
            };
            $('.box-gambar').css('padding-top', '0');

            reader.readAsDataURL(input.files[0]);
        }
	}
	</script>";
	endif;
?>

<?php endforeach ?>

