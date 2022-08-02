<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
$WeekAgo = date("Y-m-d H:i:s", time() - (60 * 60 * 24 * 7));
$FindPopularLastWeek = $db->select("PostId,count(*)View", "post_views")
    ->where("ViewDate>?", [$WeekAgo])
    ->group_by("PostId")
    ->order_by("View")
    ->limit(3)
    ->get_all();
?>
<div class="col-12 p-0 bg-white">
    <div class="row">
        <section id="best-categories" class="col-12">
            <div class="section-title">
                <h2>
                    <span>Son zamanlarda popüler</span>
                </h2>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                <?php
                foreach ($FindPopularLastWeek as $Find) {
                    $Popular = $db->select("*", "posts", "p")->join("category", "c", "CategoryId")->where("PostId=?", [$Find["PostId"]])->get_one();
                ?>
                    <div class="col categories-container">
                        <a href="<?php echo $Popular["CategoryUrl"] . "/" . $Popular["PostUrl"] ?>">
                            <img src="<?php echo URL . "/images/post/" . $Popular["PostImg"] ?>" alt="">
                            <div class="categories-title">
                                <h2 class="h4 m-0"><?php echo $Popular["PostTitle"] ?></h3>
                            </div>
                            <div class="best-categories-badge">
                                <i class="fas fa-star"></i>
                            </div>
                        </a>
                    </div>
                <?php  }
                ?>
            </div>
        </section>
        <section id="top-likes" class="col-12">
            <div class="section-title">
                <h2>
                    <span>En çok beğenilenler</span>
                </h2>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                <?php
                $TopLiked = $db->select("*", "posts", "p")->join("category", "c", "CategoryId")->where("LikeCount>?", [0])->order_by("CommentCount")->limit(8)->get_all();
                foreach ($TopLiked as $Liked) { ?>
                    <div class="col categories-container">
                        <a href="<?php echo $Liked["CategoryUrl"] . "/" . $Liked["PostUrl"] ?>">
                            <div class="img-box">
                                <img src="<?php echo URL . "/images/post/" . $Liked["PostImg"] ?>" alt="">
                            </div>
                            <div class="categories-title">
                                <div class="text-end">
                                    <small><?php echo $Liked["LikeCount"] ?><i class="fa-solid fa-thumbs-up ms-2"></i></small>
                                </div>
                                <h3 class="h6 m-0"><?php echo $Liked["PostTitle"] ?></h3>
                            </div>
                        </a>
                    </div>
                <?php  }
                ?>

            </div>
        </section>

        <section id="top-comments" class="col-12">
            <div class="section-title">
                <h2>
                    <span>En çok yorum yapılanlar</span>
                </h2>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                <?php
                $TopComments = $db->select("*", "posts", "p")->join("category", "c", "CategoryId")->where("CommentCount>?", [0])->order_by("CommentCount")->limit(8)->get_all();
                foreach ($TopComments as $TopComment) { ?>
                    <div class="col categories-container ">
                        <a href="<?php echo $TopComment["CategoryUrl"] . "/" . $TopComment["PostUrl"] ?>">
                            <div class="img-box">
                                <img src="<?php echo URL . "/images/post/" . $TopComment["PostImg"] ?>">
                            </div>
                            <div class="categories-title">
                                <div class="text-end">
                                    <small>
                                        <?php echo $TopComment["CommentCount"] ?><i class="fa-solid fa-comment ms-2"></i>
                                    </small>
                                </div>
                                <h3 class="h6 m-0"><?php echo $TopComment["PostTitle"] ?></h3>
                            </div>
                        </a>
                    </div>
                <?php }
                ?>
            </div>
        </section>

        <?php
        $HomeCategories = $db->select("*", "category", "c")->where("ShowHome=?", [true])->limit(4)->get_all();
        foreach ($HomeCategories as $HomeCategory) { ?>
            <section class="col-6">
                <div class="section-title">
                    <h2>
                        <span><?php echo $HomeCategory["CategoryName"] ?></span>
                    </h2>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <?php
                    $HomeCategoryPosts = $db->select("*", "posts")->where("CategoryId=?", [$HomeCategory["CategoryId"]])->limit(6)->get_all();
                    foreach ($HomeCategoryPosts as $HomeCategoryPost) { ?>
                        <div class="col categories-container">
                            <a href="<?php echo URL . "/" . $HomeCategory["CategoryUrl"] . "/" . $HomeCategoryPost["PostUrl"] ?>">
                                <img src="<?php echo URL . "/images/post/" . $HomeCategoryPost["PostImg"] ?>" alt="">
                                <div class="categories-title">
                                    <h3 class="h6 m-0"><?php echo $HomeCategoryPost["PostTitle"] ?></h3>
                                </div>
                            </a>
                        </div>
                    <?php }
                    ?>
                    <div class="col offset-md-3 categories-container text-center">
                        <a href="<?php echo URL . "/" . $HomeCategory["CategoryUrl"] ?>" class="text-dark more-btn">Devamına git</a>
                    </div>
                </div>
            </section>
        <?php } ?>

    </div>
</div>