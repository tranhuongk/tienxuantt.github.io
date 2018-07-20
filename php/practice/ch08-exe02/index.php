<?php
	require_once 'class/Database.class.php';
	$params		= array(
		'server' 	=> 'localhost',
		'username'	=> 'root',
		'password'	=> '',
		'database'	=> 'manage_user',
		'table'		=> 'online'
);
	$database = new Database($params);
	$ip 	= $_SERVER['REMOTE_ADDR'];
	$url	= $_SERVER['PHP_SELF'];
	
	// Tìm kiếm userInfo trong online
	$query[] = "SELECT `id`";
	$query[] = "FROM `online`";
	$query[] = "WHERE `ip` = '" . $ip . "'";
	$query[] = "AND `url` = '" . $url . "'";
	$query	= implode(" ", $query);
	
	$flagExist = $database->isExist($query);
	
	// INSERT _ UPDATE
	$arrData = array('ip' => $ip, 'url' => $url, 'time' => time());
	if($flagExist){
		// update
		$where = array(
						array('ip', $ip),
						array('url', $url)
				);
		$database->update($arrData, $where);
	}else{
		// insert
		$database->insert($arrData);
	}
	
	// DELETE: time + 10*60 < time()
	$time = time();
	$query = "DELETE FROM `online` WHERE `time` + 10*60 < $time";
	$database->query($query);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>User online</title>
</head>
<body>
	<div id="wrapper">
    	<div class="title">User online</div>
        <div id="form">
		<?php 
		echo 'id la :' . $flagExist['id'];
		
		?>
        </div>       
    </div>
</body>
</html>
