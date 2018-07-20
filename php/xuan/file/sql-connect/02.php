<?php
	// Kết nối
	$con = @mysqli_connect('localhost', 'root', '');
	
	mysqli_query($con,"SELECT * FROM sql_qlct");
    echo "Affected rows: " . mysqli_affected_rows($con);
	// Đóng kết nối
	mysqli_close($con);