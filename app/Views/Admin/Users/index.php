<?= $this->extend("Layouts/defaultLayout") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Users</h1>

<a href="<?= site_url("/admin/users/new") ?>">přidat uživatele<i class="fas fa-plus text-info"></i></a>
<a href="<?= site_url("/admin/roles/") ?>">upravit role<i class="fas fa-edit text-warning"></i></a>
<div class="container">

    <div class="mx-auto bg-white rounded text-center">
    <a class="w-100 rounded d-block" data-toggle="collapse" href="#csv" role="button" aria-expanded="false" aria-controls="csv">CSV</a>
    </div>
    <div id="csv" class="multi-collapse collapse show">
        <div class="col-md-12">
            <?php 
	        	// Display Response
	        	if(session()->has('message')){
	        	?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                <?= session()->getFlashdata('message') ?>
            </div>
            <?php
	        	}
	        	?>

            <?php $validation = \Config\Services::validation(); ?>

            <form method="post" action="<?=site_url('/admin/users/importFile')?>" enctype="multipart/form-data">

                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="file">Soubor:</label>

                    <input type="file" class="form-control " id="file" name="file" />
                    <!-- Error -->
                    <?php if( $validation->getError('file') ) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $validation->getError('file'); ?>
                    </div>
                    <?php }?>

                </div>

                <input type="submit" class="btn btn-success w-100" name="submit" value="Import .CSV">
            </form>
            <div class="dropdown-divider"></div>
            <div class="w-100 text-center"><a href="http://localhost:8080/admin/users/exportData" class="btn btn-danger w-100">Export to .CSV</a></div>
        </div>
    </div>

    <div class="row">

        <!-- Users list -->
        <div class="col-md-12 mt-4">

            <h3 class="mb-4">Users List</h3>
            <script>
                $(document).ready(function(){
                    $("#userTableFilter").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#userTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>
            <div class="d-flex justify-content-end"><input id="userTableFilter" class="form-control text-right px-2" type="text" placeholder="Filtrujte"></div>
            <div class="w-100" style="overflow-x:auto;overflow-y:hidden">
            <table id="userTable" class="table table-striped" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>password_hash</th>
                        <th>is_admin</th>
                        <th>is_active</th>
                        <th>profile_image</th>
                        <th>social_id</th>
                        <th>Roles</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
						if(isset($users) && count($users) > 0){
							foreach($users as $user){
								?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><img class="my-auto" src="
            <?php if($user->profile_image):?>
                <?php if($user->social_id):?>
                    <?=$user->profile_image?>
                <?php else:?>
                    <?=site_url("profile/image") ?>
                <?php endif;?>
            <?php else:?>
                <?=site_url("\img\blank_profile.png")?>
            <?php endif;?>
            "style="padding:2px 0px;height:34px;width:30px;border-radius:50%;"></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->password_hash ?></td>
                        <td><input type="checkbox" <?php if($user->is_admin){ echo("checked");}?> disabled></td>
                        <td><input type="checkbox" <?php if($user->is_active){ echo("checked");}?> disabled></td>
                        <td><?= $user->profile_image?></td>
                        <td><?= $user->social_id?></td>
                        <td><?= $user->role?></td>
                        <td class="text-center mx-2"><a href="<?=site_url("/admin/users/edit/$user->id");?>"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center mx-2"><a href="<?=site_url("/admin/users/delete/$user->id");?>"><i class="fas fa-trash text-danger"></i></a></td>
                    </tr>
                    <?php
							}
						}else{
							?>
                    <tr>
                        <td colspan="5">No record found.</td>
                    </tr>
                    <?php
						}
						?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<?php if ($users): ?>

<!-- <table>
    <thead>
        <tr>
            <th class="px-2 text-center">Name</th>
            <th class="px-2 text-center">email</th>
            <th class="px-2 text-center">is_admin</th>
            <th class="px-2 text-center">is_active</th>

            <?php foreach($roles as $role):?>
            <th class="px-2 text-center"><?=$role->name?></th>
            <?php endforeach;?>

            <th class="px-2 text-center">edit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>

        <tr <?php if(!$user->is_active):?>style="background:rgba(255,0,0,0.14);" <?php endif;?>>
            <td class="text-center px-2">
                <img class="my-auto" src="
            <?php if($user->profile_image):?>
                <?php if($user->social_id):?>
                    <?=$user->profile_image?>
                <?php else:?>
                    <?=site_url("profile/image") ?>
                <?php endif;?>
            <?php else:?>
                <?=site_url("\img\blank_profile.png")?>
            <?php endif;?>
            " style="padding:2px 0px;height:34px;width:30px;border-radius:50%;">
            </td>
            <td class="text-center px-2"><?= esc($user->email) ?></td>
            <td class=" text-center px-2"><input class="admincheck" type="checkbox"
                    <?php if($user->is_admin){ echo("checked ");} ?>disabled>
            </td>
            <td style="border-right:2px solid black;" class="text-center px-2"><input type="checkbox"
                    <?php if($user->is_active){ echo("checked");}?> disabled></td>

            <?php $role_arr = preg_split ("/,/", $user->role); ?>
            <?php foreach($roles as $role):?>
            <th class="text-center"><input type="checkbox"
                    <?php if(in_array($role->name,$role_arr)){ echo("checked");}?> disabled></th>
            <?php endforeach;?>

            <td class="text-center mx-2"><a href="<?=site_url("/admin/users/edit/$user->id");?>"><i
                        class="fas fa-edit"></i></a></td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table> -->
<script>
// function checkAdminCheck(){
//     if($(".admincheck").prop("checked") == true) {
//                 alert("Checkbox is checked.");
//               }
//               else if($(this).prop("checked") == false) {
//                 alert("Checkbox is unchecked.");
//               }

// }


function dropAlert() {
    if (confirm("Tato role zviditelní uživateli všechny moduly, určitě ji chcete uživateli přidělit?")) {

    } else {
        event.preventDefault();
    }
}
</script>

<?php else: ?>

<p>No users found.</p>

<?php endif; ?>

<?= $this->endSection() ?>