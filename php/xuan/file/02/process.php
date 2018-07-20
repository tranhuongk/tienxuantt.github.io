<meta charset="UTF-8">
<?php
require_once "function.php";
if(!checkEmty($_POST["user"]) && !checkEmty($_POST["password"])){
    $user = $_POST["user"];
    $pass = md5($_POST["password"]);
    $listUser = parse_ini_file("user.ini",true);
    if($user == $listUser[$user]["user"] && $pass == $listUser[$user]["password"]){
        echo "<h1>chào mừng  " . $listUser[$user]["name"] ;
    }else{
        header("location: login.php");
    }
}else{
    header("location: login.php");
}