<?php
	require_once 'library/mpdf.php';
	
	// Header Footer
	
	$mpdf	= new mPDF(
		'utf-8', 			// mode - default ''
		array(150,150),    	// format - A4, for example, default ''
		22,     			// font size - default 0
		'arial',			// default font family
		15,    				// margin_left
		15,    				// margin right
		15,     				// margin top
		16,    				// margin bottom
		0,     				// margin header
		9,     				// margin footer
		'P'  				// L - landscape, P - portrait
	);
	
	
	
	// Header
	$mpdf->SetHTMLHeader('<p style="text-align:right; border-bottom: 1px solid #a59a9a">ZendVN</p>');
	
	// Footer
	$mpdf->SetHTMLFooter('<p style="text-align:center; border-top: 1px solid #a59a9a">ZendVN</p>');
	
	// HTML
	$mpdf->WriteHTML('<h3 style="color:red">ZendVN - Khóa học trực tuyến</h3>');
	
	$mpdf->Output();
	
	
	
	
	
	
	
	
	
	