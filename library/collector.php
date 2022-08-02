<?php
if (!defined("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce")) {
    die("...");
}


//* aynı dizinde bulunan namespace olmayan classları toplar
/*
spl_autoload_register(function ($class) {
    $path = __DIR__ . "/" . $class . "-class.php";
    if (file_exists($path)) {
        require_once $path;
    }
});
*/

//* farklı dizinlerdeki classları toplar
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . "/";
    $path = $baseDir . str_replace("\\", "/", $class . "-class.php");
    if (file_exists($path)) {
        require_once $path;
    }
});
