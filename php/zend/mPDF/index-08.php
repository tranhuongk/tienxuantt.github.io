<?php
	require_once 'library/mpdf.php';
	
	// Bảo mật cho file PDF bằng watermark
	
	$mpdf	= new mPDF(
		'utf-8', 			// mode - default ''
		array(100,100),    			// format - A4, for example, default ''
		22,     			// font size - default 0
		'arial',			// default font family
		0,    				// margin_left
		0,    				// margin right
		0,     				// margin top
		0,    				// margin bottom
		0,     				// margin header
		9,     				// margin footer
		'P'  				// L - landscape, P - portrait
	);
	
	// Page 1
	
	
	$mpdf->WriteHTML('<h3 style="color:red">ZendVN - Khóa học trực tuyến 1</h3>');
	
	// $mpdf->watermark('www.zend.vn', -45, 30, 0.4);
	$mpdf->watermarkImg('images/logo.png',0.2);
	$mpdf->Output();
	
	
	
	
	
	
	
	
	
	