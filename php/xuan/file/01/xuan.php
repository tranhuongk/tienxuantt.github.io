<meta charset="UTF-8">
<?php

session_start();
$_SESSION["NAME"] = "XUAN";
$_SESSION["NAME2"] = "XUAN2";

// unset($_SESSION["NAME"]);

$array = array(
    "name" => "nguyễn tiến xuân",
    "age"  => 20,
    "dob"  => "6/6/1998"
);
$_SESSION["xuan"] = $array;
 $session = session_encode();
// echo $session;
session_unset();
session_decode($session);
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>