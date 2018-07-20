<meta charset="UTF-8">
<?php
require_once "function.php";
session_start();
if($_SESSION["trangthai"] == true){
    if($_SESSION["timeout"] + 30 > time()){
        echo "<h1>chào mừng  " . $_SESSION["name"] . "</h1>";
        echo '<a href="logout.php">Đăng xuất</a>';
    }else{
        $_SESSION["trangthai"] = false;
        header("location: login.php");
    }
}
else if(!checkEmty($_POST["user"]) && !checkEmty($_POST["password"])){
    $user = $_POST["user"];
    $pass = md5($_POST["password"]);
    $listUser = parse_ini_file("user.ini",true);
    if($user == $listUser[$user]["user"] && $pass == $listUser[$user]["password"]){
        echo "<h1>chào mừng  " . $listUser[$user]["name"] . "</h1>";
        $_SESSION["trangthai"] = true;
        $_SESSION["timeout"] = time();
        $_SESSION["name"] =  $listUser[$user]["name"];
        echo '<a href="logout.php">Đăng xuất</a>';
    }else{
        header("location: login.php");
    }
}else{
    header("location: login.php");
}