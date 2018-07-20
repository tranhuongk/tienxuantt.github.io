<?php
	use PHPImageWorkshop\ImageWorkshop;
	require_once(__DIR__ . '/autoload.php');
	
	$pathImage	= __DIR__ . '/images/main.png';
	
	$layer = ImageWorkshop::initFromPath($pathImage);
	
	$image = $layer->getResult();
	
	header('Content-type: image/png');
	header('Content-Disposition: filename="butterfly.png"');
	imagepng($image, null, 8); 
	exit;
