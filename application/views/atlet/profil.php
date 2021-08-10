<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->

<div class="row">
    <!-- <?php $this->load->view('atlet/head_profil') ?> -->
    <div class="col-lg-3 col-md-12 text-center">
        <div class="white-box analytics-info">
            <img src="<?= base_url($user->image) ?>" alt="user-img" width="100%" class="img-circle">
            <h3 class="box-title mb-0"><?= $user->nama ?></h3>
            <p class="text-muted text-sm"><?= $user->tim ?></p>
            <p class="text-capitalize badge badge-primary"></p>
            <a name="" id="" class="btn btn-warning btn-block" href="<?= site_url('export/user/'.$this->session->id)?>" role="button">Cetak Kartu</a>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="card border-primary">
            <div class="card-body">
                <form role="form" action="<?php echo site_url('user/update_profil')?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden Input disini yaa -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id" value="<?= $user->id ?>">
                        <!-- Hidden Input disini yaa -->

                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?= $user->nama ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $user->email ?>">
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" placeholder="Telepon" value="<?= $user->telepon ?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?= $user->alamat ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" maxlength="12" value="<?= $user->username ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="12" value="">
                                    <small>Isikan password untuk mengubah password lama</small>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box-gambar"><img src="<?=base_url($user->image)?>" id="blah" alt="Your Image" style="height:200px;"></div>
                            <div class="form-group mt-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image" onChange="readURL(this);" value="<?=$user->image?>">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                            <button type="submit text-right btn-block" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>