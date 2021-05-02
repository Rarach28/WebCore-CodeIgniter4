<?= $this->extend("Layouts/defaultLayout") ?>

<?= $this->section("addMeta")?>
<script src="<?=site_url("/js/jquery.redirect.js")?>"></script>
<?= $this->endSection();?>
<?= $this->section('title') ?>WebCore<?= $this->endSection() ?>

<?= $this->section('content') ?>


<div class="row w-100 no-gutters">
    <div class="d-none d-md-block col-md-3 chat-prev" style="height:100vh;overflow:auto;">
        <?php for($i=0;$i<28;$i++):?>
        <div class="msg-prev ">
            <div class="chat-img"><img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>"></div>
            <div class="msg-prev-info">
                <div class="h6 d-flex justify-content-between container">John Doe <span
                        style="font-weight: bold;color: rgba(80, 80, 80, 0.41);">7:24</span>
                </div>
                <div class="msg-prev-msg container">Lorem ipsum dolor, sit amet...</div>
            </div>
        </div>
        <?php endfor;?>
    </div>
    <div class="chat-direct d-md-block col-12 col-md-9 w-100">
        <div class="container-md bg-light rounded">
            <div class="card bg-blue text-light">
                <!-- HEADER -->
                <div class="card-header d-flex justify-content-between">
                    <div class="chat-direct-header d-flex justify-content-between">
                        <button class="prev-toggle btn d-none d-md-block mb-2 bg-blank"><i
                                class="text-light fas fa-expand-alt"></i></button>
                        <h4 class="d-flex align-items-center"><?= $otherUser->name?></h4>
                    </div>
                    <div>
                        <a id="chatToggle" class="d-block d-md-none" href="#"><i class="fas fa-comments"></i><span
                                class="badge badge-danger navbar-badge d-none">6</span></a>
                    </div>
                </div>
                <!-- BODY -->
                <div class="card-body direct-chat-msg bg-l-blue">
                    <div class="direct-chat-msg-content">
                        <?php foreach($allMessages as $message): ?>
                        <?php if($message->from_user_id!==current_user()->id):?>
                        <div class="msg">
                            <div class=" chat-info d-flex justify-content-between">
                                <span><?= $message->name ?></span>
                                <span><?= date("H:m",strtotime($message->time)) ?></span>
                            </div>
                            <div class="chat-msg-wrap w-100">
                                <div class="chat-img">
                                    <?php if($message->profile_image):?>
                                    <?php if($message->social_id):?>
                                    <img class="my-auto" src="<?=$message->profile_image?>">
                                    <?php else:?>
                                    <img class="my-auto" src="<?=site_url($message->profile_image)?>">
                                    <?php endif;?>
                                    <?php else:?>
                                    <img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>">
                                    <?php endif;?>
                                </div>
                                <div class="chat-msg"><?=$message->text?></div>
                            </div>
                        </div>
                        <?php else:?>
                        <div class="msg my">
                            <div class="chat-info my d-flex justify-content-between">
                            <span><?= date("H:m",strtotime($message->time)) ?></span>
                                <span><?= $message->name ?></span>
                            </div>
                            <div class="chat-msg-wrap w-100">
                                <div class="chat-msg my"><?=$message->text?></div>
                                    <div class="chat-img">
                                    <?php if($message->profile_image):?>
                                    <?php if($message->social_id):?>
                                    <img class="my-auto" src="<?=$message->profile_image?>">
                                    <?php else:?>
                                    <img class="my-auto" src="<?=site_url($message->profile_image)?>">
                                    <?php endif;?>
                                    <?php else:?>
                                    <img class="my-auto" src="<?=site_url("\img\blank_profile.png")?>">
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php endforeach;?>
                        <!-- <?php for($i=0;$i<4;$i++):?>
                        <div class="msg">
                            <div class=" chat-info d-flex justify-content-between">
                                <span>23.4. 7:00</span>
                                <span>John Doe</span>
                            </div>
                            <div class="chat-msg-wrap w-100">
                                <div class="chat-img"><img class="my-auto"
                                        src="<?=site_url("\img\blank_profile.png")?>"></div>
                                <div class="col chat-msg">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Quod,
                                    quaerat
                                    esse.
                                    Alias, id a, pariatur quos, fugiat quidem veritatis laborum sapiente assumenda
                                    quaerat quod.
                                    Mollitia nemo voluptatum eaque magnam similique.</div>
                            </div>
                        </div>
                        <div class="msg">
                            <div class="chat-info my d-flex justify-content-between">
                                <span>23.4. 7:00</span>
                                <span>John Doe</span>
                            </div>
                            <div class="chat-msg-wrap w-100">
                                <div class="col chat-msg my">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Quod,
                                    quaerat
                                    esse.
                                    Alias, id a, pariatur quos, fugiat quidem veritatis laborum sapiente assumenda
                                    quaerat quod.
                                    Mollitia nemo voluptatum eaque magnam similique.</div>
                                <div class="chat-img"><img class="my-auto"
                                        src="<?=site_url("\img\blank_profile.png")?>"></div>
                            </div>
                        </div>
                        <?php endfor;?> -->
                    </div>
                </div>
                <!-- FOOTER -->
                <div class="card-footer" style="display: block;">
                    <!-- <form action="<?=site_url('/Message/chatTo') ?>" method="get"> -->
                    <!-- <form action="<?=site_url('/Message/other-method') ?>" method="get"> -->
                    <div class="input-group">
                        <input type="text" id="message" name="message" placeholder="Napište zprávu ..." class="form-control">
                        <input type="hidden" id="toUser" name="toUser" value="<?= $otherUser->id ?>">
                        <span class="input-group-append">
                            <button onclick="send()" type="button" class="btn btn-l-blue"><i
                                    class=" text-light fas fa-paper-plane"></i></button>
                        </span>
                    </div>
                    <script>
                        function send(){
                            
                            if($("#message").val()){
                                $.redirect('<?=site_url("/Message/chatTo/")?>', {
                                    'message': $("#message").val(),
                                    'to_user_id': $("#toUser").val(),
                
                                });
                            }   
                        }
                    </script>
                </div>
            </div>
        </div>

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