<?php
	use PHPImageWorkshop\ImageWorkshop;
	require_once(__DIR__ . '/autoload.php');
	
	$pathImage	= __DIR__ . '/images/nature-background.jpg';
	
	$layer = ImageWorkshop::initFromPath($pathImage);
	
// 	$height	= $layer->getHeight();
// 	$width	= $layer->getWidth();
	
// 	if($height <= $width){
// 		$layer->cropInPixel($height, $height, 0, 0, 'MM');
// 	}else{
// 		$layer->cropInPixel($width, $width, 0, 0, 'MM');
// 	}
	$layer->cropMaximumInPixel(0, 0, "MM");
	 
	//$layer->resizeInPixel(100, 100, true);
	
	
	
	// Save image
	$dirPath 			= __DIR__."/outputs";
	$filename 			= "card.jpg";
	$createFolders 		= true;
	$backgroundColor 	= null; // transparent, only for PNG (otherwise it will be white if set null)
	$imageQuality 		= 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)
	 
	$layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);
