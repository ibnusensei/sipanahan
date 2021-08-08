<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<?php 
    $role = ['', 'admin', 'pelatih', 'atlet'];
    if ($level == 3) {
        $linksearch = 'user';
    } else {
        $linksearch = 'user/pelatih';
    }
?>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title">Daftar <?= $title ?></h3>
                    <p class="text-muted">Sistem Informasi Atlet Panahan Banjarmasin</p>
                </div>
                <div class="col-md-6 text-right" >
                    <?php if ($level == 3): ?>
                    <a href="<?php echo site_url('export/penilaian'); ?>" >
                        <button class="btn btn-info mr-1" style="color: #fafafa;">
                            <i class="fa fa-chart-area"></i> Penilaian
                        </button>
                    </a>
                    <?php endif; ?>
                    <a name="" id="" class="btn btn-success text-white mr-1" href="<?= site_url('export/'.$role[$level]) ?>" role="button"><i class="fa fa-file" aria-hidden="true"></i> Export</a>
                    <a name="" id="" class="btn btn-warning mr-1" href="<?= site_url('bonus/'.$role[$level]) ?>" role="button"><i class="fa fa-dollar" aria-hidden="true"></i> Bonus</a>
                    <a name="" id="" class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#create"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                </div>
                <div class="col-md-6">
                <form role="search" action="<?php echo site_url($linksearch)?>" method="get" class="app-search d-flex me-5">
                    <input type="text" placeholder="Cari Nama..." value="<?php echo (!empty($_GET['search'])) ? $_GET['search'] : '' ?>" name="search" class="form-control mt-0">
                    <button type="submit" class="btn btn-link"><i class="fa fa-search"></i></button>
                    <a name="" id="" class="btn btn-link text-danger" href="<?php echo site_url($linksearch)?>" role="button"><i class="fa fa-times"></i></a>
                </form>
                </div>
            </div>
                
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nama</th>
                            <th class="border-top-0">Email/Telp</th>
                            <th class="border-top-0">Tim</th>
                            <th class="border-top-0">Status</th>
                            <th class="border-top-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($user as $x => $data):?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td>
                                <a href="" class="profile-pic" data-toggle="modal" data-target="#show_<?=$data->id?>">
                                    <img src="<?= base_url($data->image) ?>" alt="user-img" width="36" class="img-circle">
                                    <span><?=$data->nama?></span>
                                </a>
                            </td>
                            <td><?= $data->email ?> <br> <?= $data->telepon ?></td>
                            <td><?= $data->tim  ?></td>
                            <td>
                                <?php if($data->status == "1"): ?>
                                    <span class="badge badge-primary">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Non Aktif</span>
                                <?php endif; ?>
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
                                        <a href="<?php echo site_url('export/user/'.$data->id); ?>" >
                                            <button class="btn btn-sm btn-success mr-1" style="float:left;">
                                                <i class="fa fa-file" style="color: #fafafa;"></i>
                                            </button>
                                        </a>
                                        <?php if ($level == 3): ?>
                                        <a href="<?php echo site_url('export/prestasi/'.$data->id); ?>" >
                                            <button class="btn btn-sm btn-warning mr-1"  style="float:left;">
                                                <i class="fa fa-chart-line" style="color: #fafafa;"></i>
                                            </button>
                                        </a>
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#nilai_<?=$data->id?>">
                                            <button class="btn btn-sm btn-info mr-1"  style="float:left; color: #fafafa;">
                                                <i class="fa fa-chart-area"></i>
                                            </button>
                                        </a>
                                        <?php endif; ?> 
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
                <?php if ($user == null): ?>
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
                <form role="form" action="<?php echo site_url('user/store')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="level" value="<?= $level ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" required placeholder="Nama Lengkap">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required placeholder="Email">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" required placeholder="Telepon">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" required placeholder="Alamat">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" required name="username" placeholder="Username" maxlength="12">
                                    <small>Username akan menjadi password default user</small>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Tim</label>
                                <select class="form-control" name="tim_id" required>
                                    <option>Pilih Tim</option>
                                    <?php foreach ($tim as $x => $d) : ?>
                                        <option value="<?= $d->id ?>"><?= $d->tim ?></option>
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
<?php foreach ($user as $d): ?>
<div class="modal fade" id="update_<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit User</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('user/update')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id" value="<?= $d->id ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" required placeholder="Nama Lengkap" value="<?= $d->nama ?>">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required placeholder="Email" value="<?= $d->email ?>">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" required placeholder="Telepon" value="<?= $d->telepon ?>">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" required placeholder="Alamat" value="<?= $d->alamat ?>">
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" required name="username" placeholder="Username" maxlength="12" value="<?= $d->username ?>">
                                    <small>Username akan menjadi password default user</small>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Tim</label>
                                <select class="form-control" name="tim_id" required>
                                    <option>Pilih Tim</option>
                                    <?php foreach ($tim as $x => $t) : ?>
                                        <option value="<?= $t->id ?>" <?= ($d->tim_id == $t->id) ? 'selected' : '' ?>><?= $t->tim ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-xs-4">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="radio">
                                <input type="radio" name="status" class="minimal" <?php if($d->status == "1"){ echo "checked";} ?>  value="1" />
                                <label>Aktif</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="status" class="minimal-red" <?php if($d->status == "0"){ echo "checked";} ?>  value="0" />
                                <label>Non Aktif</label>
                            </div>
                            
                        </div>
                        </div>

                        <div class="col-xs-12">
                        <div class="box-gambar"><img src="<?=base_url($d->image)?>" id="blah_<?= $d->id ?>" alt="Your Image" style="height:200px; width:100%"></div>
						<div class="form-group mt-3">
		                    <div class="custom-file">
		                      	<input type="file" class="custom-file-input" name="image" id="image" onChange="readURL<?=$d->id?>(this);" value="<?=$d->image?>" required>
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


<!-- Modal Show -->
<?php foreach ($user as $d): ?>
<div class="modal fade" id="show_<?=$d->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h4 class="modal-title">
                    <?=$d->nama?>
                </h4>
                
	      	</div>
	      	<div class="modal-body">
			
			<dt>Tim <?=$d->tim?>

            <?php if($d->status == "1"): ?>
                <span class="badge badge-primary float-right">Aktif</span>
            <?php else: ?>
                <span class="badge badge-warning float-right">Non Aktif</span>
            <?php endif; ?>

            <dt>
			<dd>Email : <?=$d->email?><dd>
            <dd>Telepon : <?=$d->telepon?><dd>
            <dd>Alamat : <?=$d->alamat?><dd>
            <br>
            <?php if($d->image == null): ?>
                <div class="box-gambar"><img src="<?=base_url('assets/img/default-user.svg')?>" style=" height:100%; width:100%; " id="" alt="Your Image"></div>
            <?php else: ?>
                <div class="box-gambar"><img src="<?=base_url($d->image)?>" style="height:100%; width:100%" id="" alt="Your Image"></div>
            <?php endif; ?>
			

			</div> 
	      	<div class="modal-footer"> 
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
	      	</div>
	      	</form>
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

<!-- Modal Show -->
<?php if ($level == 3): ?>
    <?php foreach ($user as $d): ?>
<div class="modal fade" id="nilai_<?=$d->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h4 class="modal-title">
                    <?=$d->nama?>
                </h4>
                
	      	</div>
	      	<div class="modal-body">
			<?php
                $this->load->model(['m_app']);
                $nilai = $this->m_app->getPenilaian($d->id)->row();
            ?>

                <canvas class="mb-4" id="nilai<?= $d->id ?>"></canvas>
                <form action="<?= site_url('user/penilaian') ?>" method="post">
                    <input type="hidden" name="user_id" value="<?= $d->id ?>">
                    <input type="hidden" name="id" value="<?= (!empty($nilai->id)) ? $nilai->id : '' ?>">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Stance</label>
                                <input type="number" max="10" min="0" class="form-control" name="n1" value="<?= (!empty($nilai->n1)) ? $nilai->n1 : '' ?>" placeholder="Stance">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Nocking</label>
                                <input type="number" max="10" min="0" class="form-control" name="n2" value="<?= (!empty($nilai->n2)) ? $nilai->n2 : '' ?>" placeholder="Nocking">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Set Up</label>
                                <input type="number" max="10" min="0" class="form-control" name="n3" value="<?= (!empty($nilai->n3)) ? $nilai->n3 : '' ?>" placeholder="Set Up">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Drawing</label>
                                <input type="number" max="10" min="0" class="form-control" name="n4" value="<?= (!empty($nilai->n4)) ? $nilai->n4 : '' ?>" placeholder="Drawing">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Anchoring</label>
                                <input type="number" max="10" min="0" class="form-control" name="n5" value="<?= (!empty($nilai->n5)) ? $nilai->n1 : '' ?>" placeholder="Anchoring">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Holding</label>
                                <input type="number" max="10" min="0" class="form-control" name="n6" value="<?= (!empty($nilai->n6)) ? $nilai->n6 : '' ?>" placeholder="Holding">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Aiming</label>
                                <input type="number" max="10" min="0" class="form-control" name="n7" value="<?= (!empty($nilai->n7)) ? $nilai->n7 : '' ?>" placeholder="Aiming">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Release</label>
                                <input type="number" max="10" min="0" class="form-control" name="n8" value="<?= (!empty($nilai->n8)) ? $nilai->n8 : '' ?>" placeholder="Release">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Follow Through</label>
                                <input type="number" max="10" min="0" class="form-control" name="n9" value="<?= (!empty($nilai->n9)) ? $nilai->n9 : '' ?>" placeholder="Follow Through">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo site_url('export/nilai/'.$d->id); ?>"  class="btn btn-info mr-1" style="color: #fafafa;" >
                       <i class="fa fa-print"></i> Cetak
                    </a>
                </form>
			</div> 
	      	<div class="modal-footer"> 
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
  	</div>
</div>

<?php
if ($nilai != null) {
    $total = $nilai->n1 .','. $nilai->n2 .','. $nilai->n3 .','. $nilai->n4 .','. $nilai->n5 .','. $nilai->n6 .','. $nilai->n7 .','. $nilai->n8 .','. $nilai->n9;
} else {
    $total = '0,0,0,0,0,0,0,0,0';
}

?>
<script>
    var ctx = document.getElementById('nilai<?= $d->id ?>').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'radar',
        // The data for our dataset
        data: {
            labels: [
            'Stance',
            'Nocking',
            'Set Up',
            'Drawing',
            'Anchoring',
            'Holding',
            'Aiming',
            'Release',
            'Follow Through'
          ],
          datasets: [{
            label: '<?= $d->nama ?>',
            data: [<?= $total ?>],
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
          }]
        },
        // Configuration options go here
        options: {
            elements: {
            line: {
                borderWidth: 3
            }
            },
            scale: {
                ticks: {
                    beginAtZero: true,
                    max: 10
                }
            }
        },
    });
</script>
<?php endforeach ?>
<?php endif; ?>


