<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>New Role<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>New role</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open("/Admin/Roles/create") ?>

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="rolename">
    </div>
    
    
    <a class="btn btn-light" href="<?= site_url("/admin/roles") ?>">Cancel</a>
    <button class="btn btn-blue">Save</button>
    
</form>

<?= $this->endSection() ?>