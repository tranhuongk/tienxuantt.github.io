<?php
function __autoload($className){
    $path = "class/";
    require_once $path . "{$className}.class.php";
}

$xuan = new Xuan();

$xuan->name2 = "ăn kẹo";
echo $xuan->age;