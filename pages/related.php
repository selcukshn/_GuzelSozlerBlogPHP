<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
$ThisCategoryId = $db->select("CategoryId", "category")->where("CategoryUrl=?", [$url])->get_column();
$PostsAsSameCategoryThis = $db->select("PostTitle,PostUrl,PostImg", "posts")->where("CategoryId=? and PostId!=?", [$ThisCategoryId, $post["PostId"]])->get_all();
$Relateds = [];
for ($i = 0; $i < 4; $i++) {
    $Keys = array_keys($PostsAsSameCategoryThis);
    $n = rand(0, count($Keys) - 1);
    array_push($Relateds, $PostsAsSameCategoryThis[$Keys[$n]]);
    unset($PostsAsSameCategoryThis[$Keys[$n]]);
}

?>
<h3 class="mb-3">Önerilenler <i class="far fa-thumbs-up"></i></h3>
<ul class="row row-cols-2 row-cols-md-4 g-2">
    <?php
    foreach ($Relateds as $Related) { ?>
        <li class="col">
            <a href="<?php echo URL . "/" . $url . "/" . $Related["PostUrl"] ?>">
                <div class="card">
                    <img src="<?php echo URL . "/images/post/" . $Related["PostImg"] ?>" class="card-img-top">
                    <div class="card-body p-2">
                        <h5 class="card-title fs-6 m-0"><?php echo $Related["PostTitle"] ?></h5>
                    </div>
                </div>
            </a>
        </li>
    <?php }
    ?>
</ul>
<hr>