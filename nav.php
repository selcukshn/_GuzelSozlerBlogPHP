<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
$categories = $db->select("*", "category")->get_all();
?>
<nav class="header-nav bg-dark col-12 px-0">
    <div class="container d-flex align-items-center">
        <div class="header-nav-home align-self-stretch">
            <a href="<?php echo URL ?>" class="nav-link px-2 py-1"><i class="fas fa-home"></i></a>
        </div>
        <ul class="nav me-auto">
            <?php
            foreach ($categories as $category) {
                if ($category["ShowNav"]) { ?>
                    <li class="nav-item">
                        <a href="<?php echo URL . "/" . $category["CategoryUrl"] ?>"><?php echo $category["CategoryName"] ?></a>
                    </li>
            <?php
                }
            }
            ?>
            <li class="nav-item header-nav-dropdown">
                <a href="<?php echo URL ?>/kategoriler" class="nav-link">Tüm Kategoriler<i class="fas fa-chevron-down ms-2"></i></a>
                <ul class="header-nav-dropdown-menu text-center bg-dark">
                    <?php
                    foreach ($categories as $category) { ?>
                        <li>
                            <a href="<?php echo URL . "/" . $category["CategoryUrl"] ?>"><?php echo $category["CategoryName"] ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>

        </ul>
        <div class="nav-user-panel p-2">
            <?php
            if (isset($_SESSION["user"])) { ?>
                <a href="<?php echo URL ?>/cikis-yap" class="btn btn-danger">Çıkış yap</a>
            <?php } else { ?>
                <a href="<?php echo URL ?>/giris-yap" class="btn btn-login">Giriş yap</a>
                <a href="<?php echo URL ?>/kayit-ol" class="btn btn-register">Kayıt ol</a>
            <?php }
            ?>
        </div>
        <div class="header-nav-collapse-btn">
            <button type="button" class="btn">
                <div></div>
                <div></div>
                <div></div>
            </button>
        </div>
    </div>
</nav>