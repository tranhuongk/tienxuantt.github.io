<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php
	$arrNumber 	= array(
						0 => "không",
						1 => "một",
						2 => "hai",
						3 => "ba",
						4 => "bốn",
						5 => "năm",
						6 => "sáu",
						7 => "bẩy",
						8 => "tám",
						9 => "chín",
 						);
	
	function readNumber3Digits($number, $dictionnaryNumbers, $readFull = true){
		
		// 01 - LẤY CHỮ SỐ HÀNG TRĂM, HÀNG CHỤC, HÀNG ĐƠN VỊ
		$number 	= strval($number);
		$number 	= str_pad($number, 3, 0, STR_PAD_LEFT);
		$digit_0 	= substr($number, 2, 1);
		$digit_00 	= substr($number, 1, 1);
		$digit_000 	= substr($number, 0, 1);
			
		// 02 - HÀNG TRĂM
		$str_000 = $dictionnaryNumbers[$digit_000] . " trăm ";
			
		// 03 - HÀNG CHỤC
		$str_00 = $dictionnaryNumbers[$digit_00] . " mươi ";
		if($digit_00 == 0) $str_00 = " linh ";
		if($digit_00 == 1) $str_00 = " mười ";
			
		// 04 - HÀNG ĐƠN VỊ
		$str_0 = $dictionnaryNumbers[$digit_0];
		if($digit_00 > 1 && $digit_0 == 1) $str_0 = " mốt ";
		if($digit_00 > 0 && $digit_0 == 5) $str_0 = " lăm ";
		if($digit_00 == 0 && $digit_0 == 0){
			$str_0 	= "";
			$str_00 = "";
		}
		
		if($digit_0 == 0){
			$str_0 	= "";
		}
		
		if($readFull == false){
			if($digit_000 == 0) $str_000 = "";
			if($digit_000 == 0 && $digit_00 == 0) $str_00 = "";
		}
		$result = $str_000 . $str_00 . $str_0;
		
		return $result;
	}
	
	$number 	= 800; 
	$result 	= readNumber3Digits($number, $arrNumber, false);
	echo "Input: " . $number . '<br />';
	echo "Output: " . $result . '<br />';
	
	