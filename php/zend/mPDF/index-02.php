<?php
	require_once 'library/mpdf.php';
	
	// Giới thiệu mảng cấu hình
	// Thay đổi các giá trị margin
	// Thay đổi kích thước của trang A4 array(150,150)
	// Thay đổi font chữ để hiển thị tốt với ngôn ngữ Tiếng Việt
	
	$mpdf	= new mPDF(
		'utf-8', 			// mode - default ''
		array(150,150),    	// format - A4, for example, default ''
		22,     			// font size - default 0
		'arial',			// default font family
		0,    				// margin_left
		15,    				// margin right
		0,     				// margin top
		16,    				// margin bottom
		20,     			// margin header
		9,     				// margin footer
		'P'  				// L - landscape, P - portrait
	);
	
	// Text
	$mpdf->WriteHTML('Hello mPDF');
	
	// HTML
	$mpdf->WriteHTML('<h3 style="color:red">ZendVN - Khóa học trực tuyến</h3>');
	
	$mpdf->Output();