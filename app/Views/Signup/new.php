<?= $this->extend("Layouts/defaultLayout") ?>

<?= $this->section("addMeta")?>
<script src="<?=site_url("/js/jquery.redirect.js")?>"></script>

<meta name="google-signin-client_id" content="701853397027-d7fqtk17q636eme76c4osmug6u2r0ufi.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<?= $this->endSection();?>


<?= $this->section('title') ?>WebCore<?= $this->endSection() ?>

<?= $this->section('content') ?>




<?php if(!current_user()):?>

<div class="bg-light form-wrapper mt-0 mt-3 mx-auto pb-3 pt-3 rounded text-center container ">
    
        <h2>Přihlásit se do Web<span class="text-blue">Core</span> Ci-<?= CodeIgniter\CodeIgniter::CI_VERSION ?> </h2>
    
    <div>
        <div class="hr-long bg-l-gray"></div>
        <div class="g-signin2 mx-auto d-inline-block" onclick="ClickLogin()" data-onsuccess="onSignIn"
            data-data-onfailure="onSignInFailure" data-theme="light" data-longtitle="true"></div>
        <h5 class="mt-3"> <span class="text-muted h6"> a nebo</span> se přihlašte ručně</h5>
        <div class="w-75 mx-auto">
        <?= form_open("/signup/create") ?>
            <div class="mb-3">
                <div>
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?= old('name') ?>">
                </div>

                <div>
                    <label for="email">email</label>
                    <input class="form-control" type="text" name="email" id="email" value="<?= old('email') ?>">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                </div>

                <div>
                    <label for="password_confirmation">Repeat password</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
            </div>

            <a class="btn btn-light" href="<?= site_url("/") ?>">Cancel</a>
            <button type="submit" class="btn btn-primary ">Přihlásit</button>
            

        </form>
        </div>
    </div>

</div>
<?php else:?>
<div class="text-center alert alert-warning alert-dismissible fade show mt-3" role="alert">
    Bohužel vám nemůžeme ukázat žádný modul
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