<meta charset="UTF-8">
<?php
require_once "function.php";

if(isset($_COOKIE["name"])){
        echo "<h1>chào mừng  " . $_COOKIE["name"] . "</h1>";
        echo '<a href="logout.php">Đăng xuất</a>';
}
else if(!checkEmty($_POST["user"]) && !checkEmty($_POST["password"])){
    $user = $_POST["user"];
    $pass = md5($_POST["password"]);
    $listUser = parse_ini_file("user.ini",true);
    if($user == $listUser[$user]["user"] && $pass == $listUser[$user]["password"]){
        echo "<h1>chào mừng  " . $listUser[$user]["name"] . "</h1>";
        setcookie("name",$listUser[$user]["name"],time()+200);
        echo '<a href="logout.php">Đăng xuất</a>';
    }else{
        header("location: login.php");
    }
}else{
    header("location: login.php");
}