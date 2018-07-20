<?php
session_start();
require_once "Student.class.php";

$list = array(
    array("name" => "xuân", "age" => 20, "mssv" => "222"),
    array("name" => "tùng", "age" => 10, "mssv" => "212"),
    array("name" => "tuấn", "age" => 60, "mssv" => "522"),
    array("name" => "tú", "age" => 80, "mssv" => "622")
);
$xuan = array();
foreach($list as $key => $value){
    $xuan[] = new Student($value["name"], $value["age"], $value["mssv"]);
}

echo "<pre>";
print_r($xuan);
echo "</pre>";
