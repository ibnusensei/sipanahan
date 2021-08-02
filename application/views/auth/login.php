<div class="error-box">
    <div class="error-body">
        <form action="<?= site_url('auth/login') ?>" method="post">
            <div class="row m-4 justify-content-center">
                <div class="col-md-4">
                    <div class="mb-4">
                        <h3 class="text-primary text-center">Sistem Informasi Atlet Panahan Banjarmasin</h3>

                        <?php if($this->session->flashdata('message')) {
                            echo '<div class="alert alert-warning" style="margin:10px 0 0 0; padding:10px; text-align:center;"> '  . $this->session->flashdata('message') . '</div>'; }
                        ?>
                    </div>
                    
                    <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="" placeholder="Username">
                    </div>

                    <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="" placeholder="Password">
                    </div>                     
                    <button type="submit" name="" id="" class="btn btn-primary btn-lg btn-block">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>