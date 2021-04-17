<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Profile</h1>
<?php if($user->profile_image):?>
<img src="<?=site_url("profile/image") ?>" width="200" height="200" alt="Profile image">

<a href="<?=site_url('profileimage/delete') ?>">Delete profile image</a>
<?php else:?>
<img src="<?=site_url("\images\blank_profile.png") ?>" width="200" height="200" alt="Profile image">
<?php endif;?>
<dl>
    <dt>Name</dt>
    <dd><?=esc($user->name) ?></dd>

    <dt>Email</dt>
    <dd><?=esc($user->email) ?></dd>
</dl>

<a href="<?=site_url("/profile/edit")?>">Edit</a>
<a href="<?=site_url("/profile/editpassword")?>">change password</a>
<a href="<?=site_url("/profileimage/edit")?>">change profile image</a>

<?= $this->endSection() ?>