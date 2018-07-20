<?php
	// Kết nối
	$connect = @mysqli_connect('localhost', 'root', '');
	
	// Kiểm tra kết nối
	if(!$connect){
		die('<h3>Fail</h3>');
	}
	
	echo '<h3>Success</h3>';
	
	// Danh sách table
	$list_tables = mysqli_query($connect,'SHOW TABLES FROM sql_qlct');
	
	while($row = mysqli_fetch_array($list_tables)){
		 echo '<h3>' . $row[0] . '</h3>';
	}
	
	// Đóng kết nối
	mysqli_close($connect);