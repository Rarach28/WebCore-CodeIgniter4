<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>Edit user<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit user</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open("/admin/users/update/" . $user->id) ?>

    <?= $this->include('Admin/Users/form') ?>
    
    <a class="btn btn-l-gray"  href="<?= site_url("/admin/users/show/" . $user->id) ?>">Cancel</a>
    <button class="btn btn-blue" >Save</button>
    

</form>

<?= $this->endSection() ?>