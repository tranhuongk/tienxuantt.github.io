<?php 
	Session::init();
	
	$menu = '<a class="index" href="index.php?controller=index&action=index">Home</a>';
	if(Session::get('loggedIn') == true){
		$menu .= '<a class="group" href="index.php?controller=group&action=index">Group</a>';
		$menu .= '<a class="user" href="index.php?controller=user&action=logout">Logout</a>';
	}else{
		$menu .= '<a class="user" href="index.php?controller=user&action=login">Login</a>';
	}
	
	// JS
	$fileJs = "";
	if(!empty($this->js)){
		foreach($this->js as $js) {
			$fileJs .= '<script type="text/javascript" src="'.$js.'"></script>';
		}
	}
	
	// CSS
	$fileCss = "";
	if(!empty($this->css)){
		foreach($this->css as $css) {
			$fileCss .= '<link rel="stylesheet" type="text/css" href="'.$css.'">';
		}
	}
	
	// TITLE
	$title = isset($this->title) ? $this->title : 'MVC';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<script type="text/javascript" src="./public/js/jquery.js"></script>
	<script type="text/javascript" src="./public/js/custom.js"></script>
	<?php echo $fileJs . $fileCss;?>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<h3>Header</h3>
			<?php echo $menu;?>
		</div>