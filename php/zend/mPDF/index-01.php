<?php
	require_once 'library/mpdf.php';
	
	$mpdf	= new mPDF();
	
	// Text
	$mpdf->WriteHTML('Hello mPDF');
	
	// HTML
	$mpdf->WriteHTML('<h3 style="color:red">ZendVN</h3>');
	
	$mpdf->Output();