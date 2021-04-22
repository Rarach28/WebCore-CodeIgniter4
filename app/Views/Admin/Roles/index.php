<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>Role<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Role <a href="<?=site_url("Admin/Roles/new");?>"><i class="fas fa-plus text-info"></i></a></h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>
<table>
<thead>
<tr>
        <th class="text-center mx-2">Name</th>
        <th class="text-center mx-2">Edit</th>
        <th class="text-center mx-2">Delete</th>
        </tr>
</thead>
<tbody>
<?php foreach( $roles as $role):?>
<tr>
<td class="text-center mx-2"><?=$role->name?></td>
<td class="text-center mx-2"><a  href="<?=site_url("Admin/Roles/edit/$role->id");?>"><i class="fas fa-edit"></i></a></td>
<td class="text-center mx-2"><a onclick="dropAlert()" href="<?=site_url("Admin/Roles/delete/$role->id");?>"><i class=" text-danger fas fa-trash-alt"></i></a></td>
</tr>
<?php endforeach;?>
</tbody>
<table>

<script>
function dropAlert(){
    if(confirm("Tato akce by mohla aplikaci rozbít. Určitě chceš tuto roli smazat?")){

    } else{
        event.preventDefault();
    }
}
</script>
<?= $this->endSection() ?>