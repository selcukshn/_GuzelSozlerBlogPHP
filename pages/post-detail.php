<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
$post = $db->select("p.*,c.CategoryName,c.CategoryUrl", "posts", "p")->join("category", "c", "CategoryId")->where("PostUrl=?", [$postUrl])->get_one();
if (!$post) {
    header("Location:" . URL . "/404.html");
}
$ViewerIp = $_SERVER["REMOTE_ADDR"];
$View = $db->select("PostId,Ip", "post_views")->where("PostId=? and Ip=?", [$post["PostId"], $ViewerIp])->get_one();
if (!$View) {
    $db->insert("post_views", "PostId,Ip", "?,?", [$post["PostId"], $ViewerIp]);
    $db->update("posts", "ClickCount=?", [$post["ClickCount"] + 1])->where("PostId=?", [$post["PostId"]])->set();
}
$addScript = ["comment.js", "reply.js"];
?>
<div class="col-12 col-lg-8 bg-white">

    <section class="w-100 my-3">
        <?php require_once("breadcrumb.php") ?>
    </section>

    <section id="post" class="w-100 row">

        <div class="col-12 px-0">
            <h2 class="post-title mt-2"><?php echo $post["PostTitle"] ?></h2>
        </div>
        <div class="col-12 post-detail border-top border-bottom py-1 px-0 my-3">
            <span>
                <i class="fas fa-user"></i><?php echo $post["AddedBy"] ?>
            </span>
            <span>
                <i class="fas fa-calendar-alt"></i><?php echo $post["PostDate"] ?>
            </span>
            <span>
                <a href="<?php echo URL . "/" . $post["CategoryUrl"] ?>">
                    <i class="fas fa-tags"></i><?php echo $post["CategoryName"] ?>
                </a>
            </span>
        </div>
        <div class="col-12 text-center">
            <img src="<?php echo URL ?>/images/post/<?php echo $post["PostImg"] ?>" alt="Post image">
        </div>
        <div class="col-12">
            <blockquote>
                <?php echo $post["PostSummary"] ?>
            </blockquote>
        </div>
        <div class="col-12">
            <?php echo $post["PostContent"] ?>
        </div>
        <div class="col-12 py-4">
            <div class="d-inline-block">
                <?php
                if (isset($User)) {
                    $UserLikeThisPost = $db->select("*", "liked")->where("UserId=? and PostId=?", [$User["UserId"], $post["PostId"]])->get_one();
                    if ($UserLikeThisPost) { ?>
                        <div id="like-prev" liked="true">
                            <div class="rounded-circle p-2">
                                <div class="d-flex justify-content-start align-items-center text-danger fs-3">
                                    <span class="me-1"><?php echo $post["LikeCount"] ?></span>
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a id="like" href="#">Beğenme</a>
                        </div>
                    <?php } else { ?>
                        <div id="like-prev" liked="false">
                            <div class="rounded-circle p-2">
                                <div class="d-flex justify-content-start align-items-center fs-3">
                                    <span class="me-1"><?php echo $post["LikeCount"] ?></span>
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a id="like" href="#">Beğen</a>
                        </div>
                    <?php }
                } else { ?>
                    <div id="like-prev">
                        <div class="rounded-circle p-2">
                            <div class="d-flex justify-content-start align-items-center text-danger fs-3">
                                <span class="me-1"><?php echo $post["LikeCount"] ?></span>
                                <i class="fa-solid fa-heart"></i>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
        <hr>
    </section>

    <section id="related-post" class="w-100">
        <?php require_once("related.php") ?>
    </section>
    <section id="commentarea" class="w-100">
        <?php require_once("comments.php") ?>
    </section>
</div>

<aside class="col-12 col-lg-4 bg-white">
    <?php require_once("side.php") ?>
</aside>