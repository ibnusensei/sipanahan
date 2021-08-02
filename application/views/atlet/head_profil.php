<?php 
    $role = ['', 'admin', 'pelatih', 'atlet']
?>

<div class="col-md-12 mb-4">
    <a class="btn btn-<?= ($head == 'akun') ? 'primary' : 'outline-primary'; ?> text-capitalize" href="<?= site_url($role[$user->level].'/profil') ?>" role="button">Akun <?= $role[$user->level] ?></a>

    <a class="btn btn-<?= ($head == 'bonus') ? 'primary' : 'outline-primary'; ?> ml-3" href="<?= site_url($role[$user->level].'/bonus') ?>" role="button">Bonus</a>
</div>