<?php
	require_once 'library/mpdf.php';
	
	// Tạo nhiều trang
	
	$mpdf	= new mPDF(
		'utf-8', 			// mode - default ''
		'A4',    			// format - A4, for example, default ''
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
	
	// Pgae 2
	$mpdf->AddPage();
	$mpdf->WriteHTML('<h3 style="color:red">ZendVN - Khóa học trực tuyến 2</h3>');
	
	// Pgae 3
	$mpdf->AddPage('L');
	$mpdf->WriteHTML('<h3 style="color:red">ZendVN - Khóa học trực tuyến 3</h3>');
	
	$mpdf->Output();
	
	
	
	
	
	
	
	
	
	