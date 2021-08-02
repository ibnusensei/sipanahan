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
                    <a name="" id="" class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#create"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                </div>
                <div class="col-md-6">
                    <form role="search" action="<?php echo site_url('alat')?>" method="get" class="app-search d-flex me-5">
                        <input type="text" placeholder="Cari Alat..." value="<?php echo $_GET['search'] ?? '' ?>" name="search" class="form-control mt-0">
                        <button type="submit" class="btn btn-link"><i class="fa fa-search"></i></button>
                        <a name="" id="" class="btn btn-link text-danger" href="<?php echo site_url('alat')?>" role="button"><i class="fa fa-times"></i></a>
                    </form>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nama</th>
                            <th class="border-top-0">Pemilik</th>
                            <th class="border-top-0">Jenis</th>
                            <th class="border-top-0">Kondisi</th>
                            <th class="border-top-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($alat as $x => $data):?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td>
                                <div class="profile-pic">
                                    <img src="<?= base_url($data->image) ?>" alt="user-img" width="36" class="img-circle">
                                    <span><?=$data->alat?></span>
                                </div>
                            </td>
                            <td><?= $data->nama ?></td>
                            <td><?= $jenis[$data->jenis - 1]  ?></td>
                            <td>
                                <span class="badge badge-primary"><?= $kondisi[$data->kondisi - 1]  ?></span>
                            </td>   
                            <td>
                                <div class="text-center">
                                    <span>  
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#update_<?=$data->id?>">
                                            <button class="btn btn-sm btn-primary mr-1"  data-placement="top"
                                                    title="" data-original-title="Edit" style="float:left;">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>    
                                        <a href="<?php echo site_url().'/admin/destroy/alat/'.$data->id; ?>" class="btnDelete">
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
                <form role="form" action="<?php echo site_url('alat/store')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Nama Alat</label>
                                    <input type="text" class="form-control" name="alat" required placeholder="Nama Alat">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Pemilik</label>
                                <select class="form-control" name="user_id" required>
                                    <option>Pilih Anggota</option>
                                    <?php foreach ($user as $x => $d) : ?>
                                        <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <select class="form-control" name="jenis" required>
                                    <option>Pilih Jenis</option>
                                    <?php foreach ($jenis as $x => $d) : ?>
                                        <option value="<?= $x+1 ?>"><?= $d ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Kondisi</label>
                                <select class="form-control" name="kondisi" required>
                                    <option>Pilih Kondisi</option>
                                    <?php foreach ($kondisi as $x => $d) : ?>
                                        <option value="<?= $x+1 ?>"><?= $d ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12">
                        <div class="box-gambar"><img src="" id="blah" alt="Your Image"></div>
						<div class="form-group mt-3">
		                    <div class="custom-file">
		                      	<input type="file" class="custom-file-input" name="image" id="image" onChange="readURL(this);" value="" required>
		                      	<label class="custom-file-label" for="image">Choose file</label>
		                    </div>
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
<?php foreach ($alat as $d): ?>
<div class="modal fade" id="update_<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit Alat</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('alat/update')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id" value="<?= $d->id ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Nama Alat</label>
                                    <input type="text" class="form-control" name="alat" value="<?= $d->alat ?>" required placeholder="Nama Alat">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Pemilik</label>
                                <select class="form-control" name="user_id" required>
                                    <option>Pilih Anggota</option>
                                    <?php foreach ($user as $x => $e) : ?>
                                        <option value="<?= $e->id ?>" <?= ($d->user_id == $e->id) ? 'selected' : '' ?>><?= $e->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <select class="form-control" name="jenis" required>
                                    <option>Pilih Jenis</option>
                                    <?php foreach ($jenis as $x => $e) : ?>
                                        <option value="<?= $x+1 ?>" <?= ($d->jenis == $x+1) ? 'selected' : '' ?>><?= $e ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Kondisi</label>
                                <select class="form-control" name="kondisi" required>
                                    <option>Pilih Kondisi</option>
                                    <?php foreach ($kondisi as $x => $e) : ?>
                                        <option value="<?= $x+1 ?>" <?= ($d->kondisi == $x+1) ? 'selected' : '' ?>><?= $e ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12">
                        <div class="box-gambar"><img src="<?=base_url($d->image)?>" id="blah_<?= $d->id ?>" alt="Your Image" style="height:200px;"></div>
						<div class="form-group mt-3">
		                    <div class="custom-file">
		                      	<input type="file" class="custom-file-input" name="image" id="image" onChange="readURL<?=$d->id?>(this);">
		                      	<label class="custom-file-label" for="image">Choose file</label>
		                    </div>
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

