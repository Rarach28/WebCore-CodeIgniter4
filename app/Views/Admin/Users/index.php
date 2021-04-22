<?= $this->extend("Layouts/defaultLayout") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Users</h1>

<a href="<?= site_url("/admin/users/new") ?>">New user</a>
<a href="<?= site_url("/admin/roles/") ?>">upravit role</a>

<?php if ($users): ?>

<table>
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
            <?php if($user->social_id==NULL):?>
            <td class="text-center px-2">
                <?php if($user->profile_image):?>
                <img src="<?=site_url(WRITEPATH.'uploads/profile_images/1619031495_ced4bc497f1609ce505c.jpg')?>"
                    style="padding:2px 0px;height:34px;width:30px;border-radius:50%;">
                <?php else:?>
                <img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>"
                    style="padding:2px 0px;height:34px;width:30px;border-radius:50%;">
                <?php endif;?>
                <a class="" href="<?= site_url("/admin/users/show/$user->id") ?>"><?=$user->name?></a>
            </td>
            <?php else:?>
            <td class="text-center px-2">
                <img class="my-auto" src="<?=$user->profile_image?>"
                    style="padding:2px 0px;height:34px;width:30px;border-radius:50%;">
                <a class="" href="<?= site_url("/admin/users/show/$user->id") ?>"><?=$user->name?></a>
            </td>
            <?php endif;?>
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
</table>
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