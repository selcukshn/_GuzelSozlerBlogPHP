<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}

use ui\write;

$post_list_category = $db->select("CategoryId,CategoryName,CategoryUrl,ClickCount", "category")->where("CategoryUrl=?", [$url])->get_one();
$getPosts = $db->select("*", "posts")->where("CategoryId=?", [$post_list_category["CategoryId"]])->get_all();

$ViewerIp = $_SERVER["REMOTE_ADDR"];
$View = $db->select("CategoryId,Ip", "category_views")->where("CategoryId=? and Ip=?", [$post_list_category["CategoryId"], $ViewerIp])->get_one();
if (!$View) {
    $db->insert("category_views", "CategoryId,Ip", "?,?", [$post_list_category["CategoryId"], $ViewerIp]);
    $db->update("category", "ClickCount=?", [$post_list_category["ClickCount"] + 1])->where("CategoryId=?", [$post_list_category["CategoryId"]])->set();
}
?>
<section class="col-12 m-0 text-center p-5 ">
    <h1 class="fw-light"><?php echo $post_list_category["CategoryName"] ?></h1>
</section>
<section class="col-12 bg-white py-3">
    <div class="album">
        <div class="row  row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            <?php
            foreach ($getPosts as $post) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="<?php echo URL . "/" . $post_list_category["CategoryUrl"] . "/" . $post["PostUrl"] ?>">
                            <img src="<?php echo URL ?>/images/post/<?php echo $post["PostImg"] ?>" class="card-img-top">
                        </a>
                        <div class="card-body text-black">
                            <h6 class="card-title fw-bold"><?php echo $post["PostTitle"] ?></h6>
                            <p class="card-text">
                                <small>
                                    <?php echo mb_substr($post["PostSummary"], 0, 100, "utf-8") . "..." ?>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <small class="text-muted"><i class="fa-solid fa-eye"></i> <?php echo $post["ClickCount"] ?></small>
                            <small class="text-muted"><?php echo write::date_to_turkish($post["PostDate"]) ?></small>
                        </div>
                    </div>

                </div>
            <?php } ?>

        </div>
    </div>
</section>