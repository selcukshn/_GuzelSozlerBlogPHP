<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}

use security\hash;
use ui\write;

$last_added = $db->select("*", "posts", "p")->join("category", "c", "CategoryId")->order_by("PostDate")->limit(8)->get_all();
?>
<section class="col-12 m-0 text-center p-5 ">
    <h1 class="fw-light">Son eklenenler</h1>
</section>
<section class="col-12 bg-white py-3">
    <div class="album mb-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4  g-3 last-added-row">
            <?php foreach ($last_added as $last) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="<?php echo URL . "/" . $last["CategoryUrl"] . "/" . $last["PostUrl"] ?>">
                            <img src="<?php echo URL ?>/images/post/<?php echo $last["PostImg"] ?>" class="card-img-top">
                        </a>
                        <div class="card-body text-black">
                            <h6 class="card-title fw-bold"><?php echo $last["PostTitle"] ?></h6>
                            <p class="card-text">
                                <small>
                                    <?php echo mb_substr($last["PostSummary"], 0, 100, "utf-8") . "..." ?>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="<?php echo URL . "/" . $last["CategoryUrl"] ?>" class="d-inline">
                                <small><?php echo $last["CategoryName"] ?></small>
                            </a>
                            <small class="text-muted"><?php echo write::date_to_turkish($last["PostDate"]) ?></small>
                        </div>

                    </div>
                </div>
            <?php
                $lastPostId = $last["PostId"];
            } ?>
        </div>
    </div>
    <div class="onload text-center"></div>
    <div class="last-added-show_more text-center">
        <button last-item="<?php echo hash::encrypt($lastPostId) ?>" class="btn btn-outline-secondary w-50 last-added-show_more_btn">Daha fazla göster</button>
    </div>