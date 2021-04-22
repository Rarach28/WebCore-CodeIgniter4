<?= $this->extend("Layouts/defaultLayout") ?>

<?= $this->section("addMeta")?>
<script src="<?=site_url("/js/jquery.redirect.js")?>"></script>

<meta name="google-signin-client_id" content="701853397027-d7fqtk17q636eme76c4osmug6u2r0ufi.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<?= $this->endSection();?>


<?= $this->section('title') ?>WebCore<?= $this->endSection() ?>

<?= $this->section('content') ?>




<?php if(!current_user()):?>
<div class="text-center alert alert-warning alert-dismissible fade show mt-3" role="alert">
    <strong>BOHUŽEL!</strong> Bez přihlášení není možno zobrazit žádný modul!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<div id="headingOne" class="bg-light form-wrapper mt-0 mt-3 mx-auto pb-3 pt-3 rounded text-center container ">
    <button class="btn btn-light row no-gutters w-100" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
        aria-controls="collapseOne">
        <span class="colpoint ml-auto"><i class="text-blue fas fa-caret-down"></i></span><h2 class="col-11" style="display:inline-block;">Přihlásit se do Web<span class="text-blue">Core</span> Ci-<?= CodeIgniter\CodeIgniter::CI_VERSION ?> </h2> <span class="colpoint ml-auto"><i class="text-blue fas fa-caret-down"></i></span>
    </button>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
        <div class="hr-long bg-l-gray"></div>
        <div class="g-signin2 mx-auto d-inline-block" onclick="ClickLogin()" data-onsuccess="onSignIn"
            data-data-onfailure="onSignInFailure" data-theme="light" data-longtitle="true"></div>
        <h5 class="mt-3"> <span class="text-muted h6"> a nebo</span> se přihlašte ručně</h5>
        <div class="w-75 mx-auto">
            <?= form_open("/login/create") ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="text" name="email" id="email" value="<?= old('email') ?>">
                <small id="emailHelp" class="form-text text-muted">Vaše osobní údaje nikam neproklouznou ;)</small>
            </div>
            <div class="form-group">
                <label for="password">Heslo:</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="d-flex justify-content-between form-group">
                <div>
                    <label for="remember_me"></label>
                    <input type="checkbox" name="remember_me" id="remember_me"
                        <?php if(old('remember_me')):?>checked<?php endif;?>> pamatuj si mě
                </div>
                <a href="<?= site_url("/password/forgot") ?>">Zapomenuté heslo?</a>
            </div>
            <button type="submit" class="btn btn-primary ">Přihlásit</button>
            </form>
        </div>
    </div>

</div>
<?php else:?>
<div class="text-center alert alert-warning alert-dismissible fade show mt-3" role="alert">
    Bohužel vám nemůžeme ukázat žádný modul <?php if(session()->has('editor')){echo "ADMIN";}?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif;?>


<script>
//Google SDK for Javascript
function onSignInFailure() {
    alert(error);
}
var clicked = false; //Global Variable
function ClickLogin() {
    clicked = true;
}

function onSignIn(googleUser) {
    if (clicked) {
        var profile = googleUser.getBasicProfile();
        // var id_token = googleUser.getAuthResponse().id_token;
        // console.log(id_token);
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

        $(document).ready(function() {
            $.redirect('<?=site_url('/Signup/createGoogle')?>', {
                'social_id': profile.getId(),
                'name': profile.getName(),
                'email': profile.getEmail(),
                'profile_image': profile.getImageUrl(),
            });
        });
    }
}
</script>


<?= $this->endSection();?>