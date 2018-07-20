<?php
	use PHPImageWorkshop\ImageWorkshop;
	require_once(__DIR__ . '/autoload.php');
	
	$pathImage	= __DIR__ . '/images/main.png';
	
	$layer = ImageWorkshop::initFromPath($pathImage);
	
	$dirPath 			= __DIR__."/outputs";
	$filename 			= "card.jpg";
	$createFolders 		= true;
	$backgroundColor 	= null; // transparent, only for PNG (otherwise it will be white if set null)
	$imageQuality 		= 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)
	 
	$layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);
