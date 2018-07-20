<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        require_once "function.php";
        session_start();
        if($_SESSION == null){
            $_SESSION["trangthai"] = false;
        }
        if($_SESSION["trangthai"] == true){
            if($_SESSION["timeout"] + 30 > time()){
                echo "<h1>chào mừng  " . $_SESSION["name"] . "</h1>";
                echo '<a href="logout.php">Đăng xuất</a>';
            }else{
                $_SESSION["trangthai"] = false;
                header("location: login.php");
            }
        }else{
            $user = "";
            $pass = "";
            if(isset($_POST["name1"]) && isset($_POST["user1"]) && isset($_POST["password1"])){
                if(!checkEmty($_POST["name1"]) && !checkEmty($_POST["user1"]) && !checkEmty($_POST["password1"])){
                    $str = "\n[". $_POST["user1"] ."]".
                    "\nuser = ". $_POST["user1"] . 
                    "\npassword = " . md5($_POST["password1"]) .
                    "\nname = " . $_POST["name1"];
                    file_put_contents("user.ini",$str,FILE_APPEND);
                    $user = $_POST["user1"];
                    $pass = $_POST["password1"];
                }else{
                    header("location: dangky.php");
                }
            }
            echo '<form action="process.php" method="post">
            <table>
                <tr>
                    <td> USER:</td>
                    <td><input type="text" name="user" value = '.$user.'></td>
                </tr>
                <tr>
                    <td>PASSWORD:</td>
                    <td><input type="password" name= "password" value = '. $pass .'></td>
                </tr>
                <tr>
                    <td><input type="submit" value="ĐĂNG NHẬP"></td>
                </tr>
                <tr>
                    <td><a href="dangky.php"> ĐĂNG KÝ </a></td>
                </tr>
            </table>
        </form>';

        }
    ?>
    
</body>
</html>