<?= $this->extend('Layouts/defaultLayout') ?>

<?= $this->section('title') ?>Edit user<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit user </h1> <a href="<?=site_url("Admin/Users/editRoles/$user->id")?>">-edit Roles <i class="fas fa-edit"></i></a>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open("/admin/users/update/" . $user->id) ?>
    <?= view('Admin/Users/form',['user'=>$user,'roles'=>$roles]) ?>
    
    <a class="btn btn-l-gray"  href="<?= site_url("/admin/users/") ?>">Cancel</a>
    <button onclick="valid()" class="btn btn-blue" >Save</button>
    

</form>


<script>

function valid(){
 /*   var i=0;

var elems = $(".rolename");
var arr = $.makeArray( elems );
// console.log(arr);
for (let i = 0; i < arr.length; i++) {
  console.log(arr[i].innerText);
}*/

var i=0;
var elems = $(".rolename");
var arr = $.makeArray( elems );

var txt="";
    $(".role").each(function(){
        txt=txt+"|"+$(this).prop("checked");
        // txt=txt+"|"+arr[i].innerText+"--"+$(this).prop("checked");
        // console.log("|"+arr[i].innerText+"--"+$(this).prop("checked"));
        i++;
    });
    console.log(txt);

    // $.redirect('<?=site_url("/admin/users/updateroles/$user->id")?>', {
    //     'username': "<?=$user->name?>",
    //     'email': "<?=$user->email?>",
    //     'is_active': <?=$user->is_active?>,
    //     'is_admin': <?=$user->is_admin?>,
    //     'txt': txt
    // });
    






    /*
    var admin = false;
    var active = false;

    if( $(".admincheck").prop('checked')){
        admin = true;
        console.log("admin");
    }
    if( $(".activecheck").prop('checked')){
        active = true;
        console.log("active");
    }*/
    

}

</script>
<?= $this->endSection() ?>