<?php
	require_once 'library/mpdf.php';
	
	// Ghi nội dung theo tọa độ nên xóa margin
	
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
	
	// HTML
	$mpdf->SetXY(0, 0);
	$mpdf->WriteHTML('<h3 style="color:red">ZendVN - Khóa học trực tuyến</h3>');
	
	$mpdf->SetXY(0, 5);
	$mpdf->WriteHTML('<h3 style="color:blue">ZendVN - Khóa học trực tuyến</h3>');
	
	$mpdf->WriteText(20, 20, 'mPDF');
	
	$mpdf->Output();
	
	
	
	
	
	
	
	
	
	