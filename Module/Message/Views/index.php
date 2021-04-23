<?= $this->extend("Layouts/defaultLayout") ?>

<?= $this->section("addMeta")?>
<script src="<?=site_url("/js/jquery.redirect.js")?>"></script>

<meta name="google-signin-client_id" content="701853397027-d7fqtk17q636eme76c4osmug6u2r0ufi.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<?= $this->endSection();?>


<?= $this->section('title') ?>WebCore<?= $this->endSection() ?>

<?= $this->section('content') ?>


<div class="container-md bg-light rounded">
    <div class="card bg-warning">
        <!-- HEADER -->
        <div class="card-header d-flex justify-content-between">
            <div>
                <h4>John Doe</h4>
            </div>
            <div>
                <a href="#"><i class="fas fa-comments"></i><span class="badge badge-danger navbar-badge">6</span></a>
            </div>
        </div>
        <!-- BODY -->
        <div class="card-body direct-chat-msg">
            <div class="direct-chat-msg-content">
                <?php for($i=0;$i<4;$i++):?>
                <div class="msg">
                    <div class=" chat-info d-flex justify-content-between">
                        <span>23.4. 7:00</span>
                        <span>John Doe</span>
                    </div>
                    <div class="chat-msg-wrap w-100">
                        <div class="chat-img"><img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>"></div>
                        <div class="col chat-msg">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod,
                            quaerat
                            esse.
                            Alias, id a, pariatur quos, fugiat quidem veritatis laborum sapiente assumenda quaerat quod.
                            Mollitia nemo voluptatum eaque magnam similique.</div>
                    </div>
                </div>
                <div class="msg">
                    <div class="chat-info my d-flex justify-content-between">
                        <span>23.4. 7:00</span>
                        <span>John Doe</span>
                    </div>
                    <div class="chat-msg-wrap w-100">
                        <div class="col chat-msg my">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod,
                            quaerat
                            esse.
                            Alias, id a, pariatur quos, fugiat quidem veritatis laborum sapiente assumenda quaerat quod.
                            Mollitia nemo voluptatum eaque magnam similique.</div>
                        <div class="chat-img"><img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>"></div>
                    </div>
                </div>
                <?php endfor;?>
            </div>
        </div>
        <!-- FOOTER -->
        <div class="card-footer" style="display: block;">
            <?= form_open("#") ?>
            <div class="input-group">
                <input type="text" name="message" placeholder="Napište zprávu ..." class="form-control">
                <span class="input-group-append">
                    <button type="button" class="btn btn-primary"><i
                            class=" text-light fas fa-paper-plane"></i></button>
                </span>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    resizeMap();
});

// resize on collapse

// $('#navbarSupportedContent').on('hidden.bs.collapse', function () {
//         resizeMap();
//     });
//     $('#navbarSupportedContent').on('shown.bs.collapse', function () {
//         resizeMap();
//     });

function resizeMap() {
    var h = $(window).height();
    $(".topnav").each(function() {
        // console.log($(this).height());
        h = h - $(this).height();
    
    });
    
    


    $(".direct-chat-msg").height(h - 184);
    // updateScroll();
}




$(window).resize(function() {
    resizeMap();
});

$(".direct-chat-msg").stop().animate({
    scrollTop: $(".direct-chat-msg")[0].scrollHeight
}, 1000);
</script>




<?= $this->endSection();?>