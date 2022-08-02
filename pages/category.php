<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
?>
<section class="col-12 m-0 text-center p-5">
    <h1 class="fw-light">Tüm Kategoriler</h1>
</section>
<section class="col-12 bg-white py-3">
    <div class="album">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2">
            <?php
            foreach ($categories as $category) { ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="<?php echo URL . "/" . $category["CategoryUrl"] ?>">
                            <img src="<?php echo URL ?>/images/category/<?php echo $category["CategoryImg"] ?>" class="card-img-top">
                            <div class="card-body text-black">
                                <h6 class="card-title fw-bold m-0"><?php echo $category["CategoryName"] ?></h6>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>