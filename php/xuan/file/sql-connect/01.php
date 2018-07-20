<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
// $dbname = "manage_user";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SHOW TABLES FROM sql_qlct";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
	echo $row[0]. '<br/>';
}

mysqli_close($conn);
?> 

</body>
</html>