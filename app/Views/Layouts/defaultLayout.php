<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=$this->renderSection("addMeta")?>
    <link rel="stylesheet" href="<?=site_url("/scss/main.css")?>">
    <title>webCore-ci4</title>

    <script src="https://kit.fontawesome.com/e577b58e18.js" crossorigin="anonymous"></script>

    <script src="<?=site_url("/js/jquery.js")?>"></script>
    <script src="<?=site_url("/js/jquery.redirect.js")?>"></script>
    <script src="<?=site_url("/js/script.js")?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="<?=site_url("/bootstrap/js/bootstrap.min.js")?>"></script>
</head>

<body class="bg-l-gray no-gutters">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= site_url("/") ?>">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if (current_user()): ?>
                    <?php if(current_user()->social_id==NULL):?>
                        <li class="nav-item" style="display: flex;pointer-events:none;">
                        <?php if(current_user()->profile_image):?>
                        <img src="<?=site_url("profile/image") ?>"
                            style="padding:2px 0px;height:34px;width:30px;border-radius:50%;">
                        <?php else:?>
                        <img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>"
                            style="padding:2px 0px;height:34px;width:30px;border-radius:50%;">
                        <?php endif;?>
                        <p style="display:table-cell; padding-bottom:0; cursor:context-menu;" class="nav-link">
                            <?= current_user()->name?></p>
                        </li>
                    <?php else:?>
                        <li class="nav-item" style="display: flex;pointer-events:none;">
                            <img class="my-auto" src="<?=current_user()->profile_image?>"
                                style="padding:2px 0px;height:34px;width:30px;border-radius:50%;">
                            <a class="nav-link" href="<?= site_url("/profile/show") ?>"><?=current_user()->name?></a>
                        </li>
                    <?php endif;?>
                    <?php if (current_user()->is_admin): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= site_url("/admin/users") ?>">uzivatele</a>
                    </li>
                    <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url("/tasks") ?>">Tasks</a>
                    </li>
                    <?php if(current_user()->social_id==NULL):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url("/profile/show") ?>">Profil</a>
                    </li>
                    <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url("/logout") ?>">Odhlasit</a>
                    </li>
                <?php else: ?>
                <a class="nav-link" href="<?= site_url("/signup") ?>">registrovat</a>

                <a class="nav-link" href="<?= site_url("/login") ?>">přihlásit</a>

                <?php endif; ?>

            </ul>
        </div>
    </nav>
    <?php if (session()->has('success')): ?>
    <div class="text-center alert alert-success alert-dismissible fade show mt-3 container" role="alert">
        <strong><?=session('success')?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if (session()->has('info')): ?>
    <div class="text-center mx-auto alert alert-info alert-dismissible fade show mt-3 container" role="alert">
        <strong><?=session('info')?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
    <div class="text-center mx-auto alert alert-danger alert-dismissible fade show mt-3 container" role="alert">
        <strong><?=session('error')?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if (session()->has('errors')): ?>
    <?php foreach(session('errors') as $error):?>
    <div class="text-center alert alert-danger alert-dismissible fade show mt-3 container" role="alert">
        <strong><?=$danger?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endforeach;?>
    <?php endif; ?>

    <div id="shell" class="px-0 mx-auto container">
        <?=$this->renderSection("content")?>
    </div>

</body>

</html>