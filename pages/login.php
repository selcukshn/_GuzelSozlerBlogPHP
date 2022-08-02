<?php

use security\form_control;

if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
if (isset($_GET["returncategory"]) && isset($_GET["returnpost"])) {
    $returnCategoryControl = form_control::request_get($_GET["returncategory"]);
    if ($returnCategoryControl[0]) {
        die("...");
    }
    $returnCategory = $returnCategoryControl[1];

    $returnPostControl = form_control::request_get($_GET["returnpost"]);
    if ($returnPostControl[0]) {
        die("...");
    }
    $returnPost = $returnPostControl[1];

    $returnUrl = $returnCategory . "/" . $returnPost;
}

use security\hash;
use session\session;
use session\token;
?>
<section class="col-12 m-0 text-center py-5">
    <h1 class="fw-light">Giriş yap</h1>
</section>
<section class="col-12 bg-white py-5">
    <form id="form-login" method="post" class="row justify-content-center m-auto">
        <div class="col-sm-8 col-lg-5">
            <?php if (isset($returnUrl)) { ?>
                <input name="returnUrl" value="<?php echo hash::encrypt($returnUrl) ?>" type="hidden">
            <?php  } ?>
            <input name="login-token" value="<?php echo token::create_token("login-token") ?>" type="hidden">
            <div class="mb-3">
                <label for="Username" class="form-label">Kullanıcı Adı</label>
                <div class="input-group">
                    <input name="Username" id="Username" type="text" class="form-control">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                </div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Şifre</label>
                <div class="input-group">
                    <input name="Password" id="Password" type="Password" class="form-control">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>
            </div>
            <div class="d-grid mb-3">
                <button id="btn-login" type="submit" class="btn btn-primary">Giriş yap
                    <span class="onload"></span>
                </button>
            </div>
            <div>Hesabınız yok mu?
                <a href="<?php echo URL ?>/kayit-ol" class="link-primary d-inline"><u>Kayıt ol</u></a>
            </div>
            <div>
                <a href="<?php echo URL ?>/sifremi-unuttum" class="link-primary d-inline"><u>Şifremi unuttum</u></a>
            </div>
        </div>
    </form>
</section>