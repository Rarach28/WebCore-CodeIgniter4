<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>Edit task<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit task</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open("/tasks/update/" . $task->id) ?>

    <?= $this->include('Tasks/form') ?>
    
    <button class="btn btn-blue">Save</button>
    <a class="btn btn-light" href="<?= site_url("/tasks/show") ?>">Cancel</a>

</form>

<?= $this->endSection() ?>