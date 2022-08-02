<?php
define('95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce', '');

require_once("init.php");

if (isset($_SESSION["user"])) {

    $User = $db->select("UserId,UserFirstname,UserLastname,UserUsername,UserEmail", "user")->where("UserUsername=?", [$_SESSION["user"]])->get_one();
}



use security\form_control;



$page = "anasayfa";

if (isset($_GET["page"])) {

    $pageControl = form_control::request_get($_GET["page"], 100);

    if ($pageControl[0]) {

        die("yasadışı istek");
    }

    $page = $pageControl[1];
}

?>

<?php require_once("head.php"); ?>



<body>

    <header class="row">

        <?php

        require_once("nav.php");

        require_once("nav-bottom.php");

        ?>

    </header>



    <div class="container">

        <main class="content row">

            <?php

            $categoryUrl = [];

            foreach ($categories as $category) {

                array_push($categoryUrl, $category["CategoryUrl"]);
            }

            if (in_array($page, $categoryUrl)) {

                $categoryIndex = array_search($page, $categoryUrl);
            }

            switch ($page) {

                case "anasayfa":

                    require("pages/home.php");

                    break;

                case "kategoriler":

                    require("pages/category.php");

                    break;

                case "son-eklenenler":

                    require("pages/last-added.php");

                    break;

                case "populer":

                    require("pages/popular.php");

                    break;

                case "giris-yap":

                    if (isset($_GET["returnurl"])) {

                        $returnurl = $_GET["returnurl"];
                    }

                    require("pages/login.php");

                    break;

                case "kayit-ol":

                    require("pages/register.php");

                    break;

                case "cikis-yap":

                    require("pages/logout.php");

                    break;

                case "sifremi-unuttum":

                    require("pages/forgot-password.php");

                    break;

                case $categoryUrl[$categoryIndex]:

                    $url = $categoryUrl[$categoryIndex];

                    if (isset($_GET["post"])) {

                        $postUrlControl = form_control::request_get($_GET["post"], 100);

                        if ($postUrlControl[0]) {

                            die("geçersiz istek");
                        }

                        $postUrl = $postUrlControl[1];

                        require("pages/post-detail.php");
                    } else {

                        require("pages/post-list.php");
                    }

                    break;

                default:

                    header("Location:" . URL . "/404.html");

                    exit;

                    break;
            }

            ?>

        </main>

    </div>



    <?php require_once("footer.php"); ?>

    <?php require_once("scripts.php"); ?>

</body>



</html>

<?php ob_flush(); ?>