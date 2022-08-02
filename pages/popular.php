<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}

use security\hash;
use ui\write;

$populars = $db->select("p.*,c.CategoryUrl,c.CategoryName", "posts", "p")->join("category", "c", "CategoryId")->order_by("p.ClickCount")->limit(50)->get_all();
?>
<section class="col-12 m-0 text-center p-5 ">
    <h1 class="fw-light">En popüler sayfalar</h1>
</section>
<section class="col-12 bg-white py-3">
    <div class="album mb-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4  g-3 last-added-row">
            <?php foreach ($populars as $popular) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="<?php echo URL . "/" . $popular["CategoryUrl"] . "/" . $popular["PostUrl"] ?>">
                            <img src="<?php echo URL ?>/images/post/<?php echo $popular["PostImg"] ?>" class="card-img-top">
                        </a>
                        <div class="card-body text-black">
                            <h6 class="card-title fw-bold"><?php echo $popular["PostTitle"] ?></h6>
                            <p class="card-text">
                                <small>
                                    <?php echo mb_substr($popular["PostSummary"], 0, 100, "utf-8") . "..." ?>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fa-solid fa-eye"></i> <?php echo $popular["ClickCount"] ?></small>
                            <a href="<?php echo URL . "/" . $popular["CategoryUrl"] ?>" class="d-inline">
                                <small><?php echo $popular["CategoryName"] ?></small>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>