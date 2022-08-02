<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}

use session\session;
use session\token;
use security\hash;
use ui\write;

?>
<h3 class="mb-3">Yorumlar</h3>

<?php if (session::have_session("user")) {
    $User = $db->select("*", "user")->where("UserUsername=?", [session::get_session("user")])->get_one();
?>
    <form id="form-comment" method="POST" class="mb-5 row gy-3">
        <input name="comment-token" id="comment-token" value="<?php echo token::create_token("comment-token") ?>" type="hidden">
        <input name="PostId" value="<?php echo hash::encrypt($post["PostId"]) ?>" type="hidden">
        <input name="UserId" id="UserId" value="<?php echo hash::encrypt($User["UserId"]) ?>" type="hidden">
        <div class="col-6">
            <label class="form-label text-muted"><small>Adınız</small></label>
            <input class="form-control" value="<?php echo $User["UserFirstname"] ?>" readonly>
        </div>
        <div class="col-6">
            <label class="form-label text-muted"><small>Soyadınız</small></label>
            <input class="form-control" value="<?php echo $User["UserLastname"] ?>" readonly>
        </div>
        <div class="col-6">
            <label class="form-label text-muted"><small>Kullanıcı adınız</small></label>
            <input class="form-control" value="<?php echo $User["UserUsername"] ?>" readonly>
        </div>
        <div class="col-6">
            <label class="form-label text-muted"><small>E-posta adresiniz</small></label>
            <input class="form-control" value="<?php echo $User["UserEmail"] ?>" readonly>
        </div>
        <div class="col-12">
            <textarea name="Comment" rows="5" class="form-control" placeholder="Yorumunuz..."></textarea>
            <div class="form-text">Maksimum 500 karakter</div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Yorum yap</button>
        </div>
    </form>
<?php  } else { ?>
    <div class="alert alert-warning" role="alert">Yorum yapabilmek için giriş yapmalısınız.
        <a href="<?php echo URL ?>/giris-yap&<?php echo $post["CategoryUrl"] . "&" . $post["PostUrl"] ?>" class="alert-link d-inline">Giriş Yap</a>
    </div>
    <div class="mb-5">
        <div class="mb-3">
            <input id="name" type="text" class="form-control" placeholder="İsminiz" disabled>
        </div>
        <div class="mb-3">
            <textarea name="comment" id="comment" rows="5" class="form-control" placeholder="Yorumunuz..." disabled></textarea>
        </div>
        <div>
            <button type="button" class="btn btn-secondary w-25" disabled>Gönder</button>
        </div>
    </div>
<?php } ?>
<hr>
<?php
$Comments = $db->select("*", "comment", "c")->join("user", "u", "UserId")->where("PostId=?", [$post["PostId"]])->get_all();

if (count($Comments) == 0) { ?>
    <div class="alert alert-primary"><i class="fa-solid fa-circle-exclamation fa-xl me-2"></i>Bu sayfaya henüz yorum yapılmamış</div>
    <?php } else {
    foreach ($Comments as $Comment) { ?>
        <div class="comment-list row row-cols-1 g-0">
            <div class="col">
                <div class="row g-0">
                    <div class="col-1">
                        <img src="<?php echo URL ?>/images/user.jpg" alt="">
                    </div>
                    <div class="col-11">
                        <div class="row row-cols-1">
                            <div class="col fw-bolder"><?php echo $Comment["UserFirstname"] . " " . $Comment["UserLastname"] ?></div>
                            <small class="col text-muted">@<?php echo $Comment["UserUsername"] ?></small>
                            <div class="col mt-1">
                                <p class="text-break"><?php echo $Comment["Comment"] ?></p>
                            </div>
                            <div class="col text-muted"><small class="float-end"><?php echo write::date_to_turkish($Comment["CommentDate"]) ?></small>
                            </div>
                            <?php if (session::have_session("user")) { ?>
                                <div class="col mb-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-reply">Cevapla</button>
                                    <div id="replyForm">
                                        <input name="CommentId" id="CommentId" type="hidden" value="<?php echo hash::encrypt($Comment["CommentId"]) ?>">
                                    </div>
                                </div>
                            <?php }
                            $Replies = $db->select("*", "reply", "r")->join("user", "u", "UserId")->where("CommentId=?", [$Comment["CommentId"]])->get_all();
                            foreach ($Replies as $Reply) { ?>
                                <div class="col">
                                    <div class="row g-0">
                                        <div class="col-1">
                                            <img src="<?php echo URL ?>/images/user.jpg" alt="">
                                        </div>
                                        <div class="col-11">
                                            <div class="row row-cols-1">
                                                <div class="col fw-bolder"><?php echo $Reply["UserFirstname"] . " " . $Reply["UserLastname"] ?></div>
                                                <small class="col text-muted">@<?php echo $Reply["UserUsername"] ?></small>
                                                <div class="col mt-1"><?php echo $Reply["Reply"] ?></div>
                                                <div class="col text-muted"><small class="float-end"><?php echo write::date_to_turkish($Reply["ReplyDate"]) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
<?php }
}  ?>