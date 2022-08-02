<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}

use session\session;
use session\token;
?>
<section class="col-12 m-0 text-center py-5">
    <h1 class="fw-light">Kayıt ol</h1>
</section>
<section class="row bg-white py-5">
    <form id="form-register" method="post" class="col-12 col-sm-10 col-md-8 col-lg-6 m-auto">
        <input name="register-token" value="<?php echo token::create_token("register-token") ?>" type="hidden">
        <div class="mb-3">
            <div class="input-group">
                <input name="Firstname" type="text" class="form-control" placeholder="Adınız">
                <span class="input-group-text"><i class="fa-solid fa-pen-to-square"></i></span>
            </div>
        </div>
        <div class="mb-3">
            <div class="input-group">
                <input name="Lastname" type="text" class="form-control" placeholder="Soyadınız">
                <span class="input-group-text"><i class="fa-solid fa-pen-to-square"></i><span>
            </div>
        </div>
        <div class="mb-3 input-helper">
            <div class="input-group">
                <input name="Username" type="text" class="form-control" placeholder="Kullanıcı adınız">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <ol class="input-helper-list" style="list-style: inside;">
                    <li class="input-helper-item">Minimum 4 karakter</li>
                    <li class="input-helper-item">Türkçe karakterler içeremez</li>
                    <li class="input-helper-item">Özel karakterler içeremez</li>
                </ol>
            </div>

        </div>
        <div class="mb-3">
            <div class="input-group">
                <input name="Email" type="email" class="form-control" placeholder="E-posta adresiniz">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
            </div>
            <div class="form-text">E-posta adresinize onay bağlantısı gönderilecek</div>
        </div>
        <div class="mb-3 input-helper">
            <div class="input-group">
                <input name="Password" type="password" class="form-control" placeholder="Şifreniz">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <ol class="input-helper-list" style="list-style: inside;">
                    <li class="input-helper-item">Minimum 6 karakter</li>
                    <li class="input-helper-item">Türkçe karakterler içeremez</li>
                    <li class="input-helper-item">Özel karakterler içeremez</li>
                </ol>
            </div>
        </div>
        <div class="mb-3 input-helper">
            <div class="input-group">
                <input name="Passwordre" type="password" class="form-control" placeholder="Şifreniz tekrar">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <ol class="input-helper-list" style="list-style: inside;">
                    <li class="input-helper-item">Minimum 6 karakter</li>
                    <li class="input-helper-item">Türkçe karakterler içeremez</li>
                    <li class="input-helper-item">Özel karakterler içeremez</li>
                </ol>
            </div>
        </div>
        <div class="d-grid mb-3">
            <button id="btn-register" type="submit" class="btn btn-primary">Kayıt ol
                <span class="onload"></span>
            </button>
        </div>
        <div>
            Hesabınız var mı?
            <a href="giris-yap" class="link-primary d-inline"><u>Giriş yap</u></a>
        </div>
    </form>
</section>