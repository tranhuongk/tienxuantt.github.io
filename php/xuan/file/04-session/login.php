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
        session_start();
        if($_SESSION == null){
            $_SESSION["trangthai"] = false;
        }
        if($_SESSION["trangthai"] == true){
            if($_SESSION["timeout"] + 10 > time()){
                echo "<h1>chào mừng  " . $_SESSION["name"] . "</h1>";
                echo '<a href="logout.php">Đăng xuất</a>';
            }else{
                $_SESSION["trangthai"] = false;
                header("location: login.php");
            }
        }else{
            echo '<form action="process.php" method="post">
            <table>
                <tr>
                    <td> USER:</td>
                    <td><input type="text" name="user" id=""></td>
                </tr>
                <tr>
                    <td>PASSWORD:</td>
                    <td><input type="password" name="password" id=""></td>
                </tr>
                <tr>
                    <td><input type="submit" value="ĐĂNG NHẬP"></td>
                </tr>
            </table>
        </form>';

        }
    ?>
    
</body>
</html>