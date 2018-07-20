<?php
	$connect = @mysqli_connect('localhost', 'root', '');
	
	if(!$connect) die('<h3>Fail</h3>');
	
	// DELTE
	mysqli_select_db($connect,'manage_user');
	
	$id = 21;
	$query 	= "DELETE FROM `group` WHERE `id` = '" . $id . "'";
	$result = mysqli_query($connect,$query);
	
	if($result){
		echo $total = mysqli_affected_rows($connect);
	}else{
		echo mysqli_error($connect);
	}
	mysqli_close($connect);