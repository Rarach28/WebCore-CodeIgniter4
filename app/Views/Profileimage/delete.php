<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>Delete prfile image<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Delete prfile image</h1>

<p>Are you sure?</p>

<?= form_open("profileimage/delete") ?>

    <button>Yes</button>
    <a href="<?= site_url('/profile/show/')?>">Cancel</a>
    
</form>

<?= $this->endSection() ?>