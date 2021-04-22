<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>Edit user roles<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit user roles<a href="<?=site_url("Admin/Users/editRoles/$user->id")?>"></a> </h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open("/admin/users/updateRoles/" . $user->id) ?>
    <?= view('Admin/Users/edit_form',['user'=>$user,'roles'=>$roles]) ?>
    
    <a class="btn btn-l-gray"  href="<?= site_url("/admin/users/") ?>">Cancel</a>
    <button onclick="valid()" class="btn btn-blue" >Save</button>
    

</form>

<?= $this->endSection() ?> 