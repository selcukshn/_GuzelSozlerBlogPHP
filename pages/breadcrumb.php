<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}
?>
<ol class="breadcrumb px-3 py-1">
    <li class="breadcrumb-item">
        <a href="<?php echo URL ?>/anasayfa">Anasayfa</a>
    </li>
    <li class="breadcrumb-item">
        <a href="<?php echo URL ?>/kategoriler">Kategoriler</a>
    </li>
    <li class="breadcrumb-item">
        <a href="<?php echo URL . "/" . $post["CategoryUrl"] ?>"><?php echo $post["CategoryName"] ?></a>
    </li>
    <li class="breadcrumb-item active">
        <a><?php echo $post["PostTitle"] ?></a>
    </li>
</ol>