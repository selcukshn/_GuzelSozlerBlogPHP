<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
$side_last_added = $db->select("p.*,c.CategoryUrl,c.CategoryName", "posts", "p")->join("category", "c", "CategoryId")->order_by("PostDate")->limit(8)->get_all();
$side_popular_categories = $db->select("*", "category")->order_by("ClickCount")->limit(8)->get_all();
?>
<section id="latest-categories">
    <div class="section-title px-0">
        <h2>
            <span>Son Eklenenler</span>
        </h2>
    </div>
    <ul class="side-list">
        <?php
        foreach ($side_last_added as $last) { ?>
            <li class="side-list-item">
                <a href="<?php echo URL . "/" . $last["CategoryUrl"] . "/" . $last["PostUrl"] ?>" class="py-3 clearfix">
                    <div class="side-list-img text-center w-25 float-start h-auto">
                        <img src="<?php echo URL . "/images/post/" . $last["PostImg"] ?>" alt="" class="rounded img-fluid">
                    </div>
                    <div class="side-list-info ps-2 w-75 float-start">
                        <h3 class="h6"><?php echo $last["PostTitle"] ?></h3>
                        <p class="side-list-text">
                            <?php echo mb_substr($last["PostSummary"], 0, 75) . "..." ?>
                        </p>
                    </div>
                </a>
            </li>
        <?php } ?>
        <a href="<?php echo URL ?>/son-eklenenler" class="more-btn mt-2">Devamını gör</a>
    </ul>
</section>
<section id="popular-categories">
    <div class="section-title px-0">
        <h2>
            <span>Popüler Kategoriler</span>
        </h2>
    </div>
    <ul class="side-list">
        <?php
        foreach ($side_popular_categories as $popular) { ?>
            <li class="side-list-item pb-2 mb-2">
                <a href="<?php echo URL . "/" . $popular["CategoryUrl"] ?>" class="clearfix w-100">
                    <div class="side-list-img w-25 float-start">
                        <img src="<?php echo URL . "/images/category/" . $popular["CategoryImg"] ?>" alt="">
                    </div>
                    <div class="side-list-info w-75 float-start ps-2">
                        <h3 class="h6"><?php echo $popular["CategoryName"] ?></h3>
                        <p class="side-list-text"></p>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
</section>