<?= $this->extend("Layouts/defaultLayout") ?>


<?= $this->section('title') ?>WebCore<?= $this->endSection() ?>

<?= $this->section('content') ?>


<div class="w-100 no-gutters">
    <div class="chat-prev" style="height:100vh;overflow:auto;">
        <?php foreach($allUsers as $aUser):?>
        <a href="<?=site_url('/Message/chatWith/'.$aUser->from_user_id)?>">
            <div class="msg-prev ">
                <div class="chat-img">
                    <?php if($aUser->profile_image):?>
                    <?php if($aUser->social_id):?>
                    <img class="my-auto" src="<?=$aUser->profile_image?>">
                    <?php else:?>
                    <img class="my-auto" src="<?=site_url($aUser->profile_image)?>">
                    <?php endif;?>
                    <?php else:?>
                    <img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>">
                    <?php endif;?>
                </div>
                <div class="msg-prev-info">
                    <div class="h6 d-flex justify-content-between container"><?=$aUser->name?> <span
                            style="font-weight: bold;color: rgba(80, 80, 80, 0.41);"><?=$aUser->time?></span>
                    </div>
                    <div class="msg-prev-msg container"><?=$aUser->text?></div>
                </div>

            </div>
        </a>
        <?php endforeach;?>

        <!-- <?php for($i=0;$i<28;$i++):?>
        <div class="msg-prev ">
            <div class="chat-img"><img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>"></div>
            <div class="msg-prev-info">
                <div class="h6 d-flex justify-content-between container">John Doe <span
                        style="font-weight: bold;color: rgba(80, 80, 80, 0.41);">7:24</span>
                </div>
                <div class="msg-prev-msg container">Lorem ipsum dolor, sit amet...</div>
            </div>
        </div>
        <?php endfor;?> -->
    </div>
</div>

<script>
$(document).ready(function() {
    $("#shell").removeClass("container");

    resizeMap();
});
$("#chatToggle").click(function() {
    $(".chat-prev").toggleClass("d-none");
    $(".chat-direct").toggleClass("d-none");
});

$(".prev-toggle").click(function() {
    $(".chat-prev").toggleClass("d-md-block");
    $(".chat-direct").toggleClass("col-12");
    $(".chat-direct").toggleClass("col-md-9");
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




    $(".direct-chat-msg").height(h - 192);
    $(".chat-prev").height(h - 20);
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