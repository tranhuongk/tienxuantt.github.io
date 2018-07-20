<?php 
	require_once 'functions.php';

	$type		= $_POST['type'];
	
	if($type == 'vnexpress'){
		$result	= getContentVN1('http://thethao.vnexpress.net/');
	}
	
	if($type == 'dantri'){
		$result	= getContentVN2('http://thethao.vnexpress.net/');
	}
	
	echo $result;
?>