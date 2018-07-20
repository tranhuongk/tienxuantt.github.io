<?php
	$connect = @mysqli_connect('localhost', 'root', '');
	
	if(!$connect) die('<h3>Fail</h3>');
	
	// INSERT
	mysqli_select_db($connect,'manage_user');
	
	$query = "INSERT INTO `group`(`name`, `status`, `ordering`) VALUES 
					('Member', '1', '10'),('Member 1', '1', '10')";
	$result = mysqli_query($connect,$query);
	
	if($result){
		echo $total = mysqli_affected_rows($connect);
		echo "success";
	}else{
		echo mysqli_error($connect);
	}
	mysqli_close($connect);