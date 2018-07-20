<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>PHP & MySQL - Select</title>
</head>
<body>
	<div id="wrapper">
    	<div class="title">PHP & MySQL - Select</div>
        <div class="list">   
        
        	<div class="row header">
            	<p class="no">No</p>
                <p class="name">Group Name</p>
                <p class="status">Status</p>
                <p class="ordering">Ordering</p>
                <p class="id">ID</p>
            </div>
<?php 
	$connect = @mysqli_connect('localhost', 'root', '');
	
	if(!$connect) die('<h3>Fail</h3>');
	mysqli_select_db($connect,'manage_user');
	
	mysqli_query($connect,"SET NAMES 'utf8'");
	mysqli_query($connect,"SET CHARACTER SET 'utf8'");

	
	$query[] 	= "SELECT * ";
	$query[] 	= "FROM `group`";
	$query[] 	= "ORDER BY `ordering` DESC";
	$query		= implode(" ", $query);
	
	
	$resutl = mysqli_query($connect,$query);

	$i = 1;
	while($row = mysqli_fetch_assoc($resutl)){
		$xhtml = "";
		$class 	= ($i % 2 == 0) ? "odd" : "even";
		$status = ($row['status'] == 0) ? "Inactive" : "Active";
		$xhtml .= '<div class="row ' . $class . '">
		            	<p class="no">'.$i.'</p>
		                <p class="name">'.$row['name'].'</p>
		                <p class="status">'.$status.'</p>
		                <p class="ordering">'.$row['ordering'].'</p>
		                <p class="id">'.$row['id'].'</p>
		            </div>';
		$i++;
		echo $xhtml;
	}
	
	mysqli_close($connect);
?>            
    	</div>
    </div>
</body>
</html>


	
	
	
	
	
	