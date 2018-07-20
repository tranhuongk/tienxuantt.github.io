<?php
	$connect = @mysqli_connect('localhost', 'root', '');
	
	if(!$connect) die('<h3>Fail</h3>');
	
	// UPDATE
	mysqli_select_db($connect,'manage_user');
	
	$query = "UPDATE `group` SET `status` = '1'
				   WHERE `ordering` = 9";
	
	$result = mysqli_query($connect,$query);
	
	if($result){
		echo $total = mysqli_affected_rows($connect);
	}else{
		echo mysqli_connect_error();
	}
	mysqli_close($connect);