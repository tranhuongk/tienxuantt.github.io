<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php
	$dictionnaryNumbers 	= array(
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
	$dictionnaryUnits 	= array(
								0 => "tỷ",		
								1 => "triệu",		
								2 => "nghìn",		
								3 => "đồng",		
								);
	
	function readNumber3Digits($number, $dictionnaryNumber, $readFull = true){
		
		// 01 - LẤY CHỮ SỐ HÀNG TRĂM, HÀNG CHỤC, HÀNG ĐƠN VỊ
		$number 	= strval($number);
		$number 	= str_pad($number, 3, 0, STR_PAD_LEFT);
		$digit_0 	= substr($number, 2, 1);
		$digit_00 	= substr($number, 1, 1);
		$digit_000 	= substr($number, 0, 1);
			
		// 02 - HÀNG TRĂM
		$str_000 = $dictionnaryNumber[$digit_000] . " trăm ";
			
		// 03 - HÀNG CHỤC
		$str_00 = $dictionnaryNumber[$digit_00] . " mươi ";
		if($digit_00 == 0) $str_00 = " linh ";
		if($digit_00 == 1) $str_00 = " mười ";
			
		// 04 - HÀNG ĐƠN VỊ
		$str_0 = $dictionnaryNumber[$digit_0];
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
	
	function formatString($str, $type = null){
		// Dua tat ca cac ky tu ve dang chu thuong
		$str	= strtolower($str);
	
		// Loai bo khoang trang dau va cuoi chuoi
		$str	= trim($str);
	
		// Loai bo khoang trang du thua giua cac tu
	
		$array 	= explode(" ", $str);
		foreach($array as $key => $value){
			if(trim($value) == null) {
				unset($array[$key]);
				continue;
			}
				
			// Xu ly cho danh tu
			if($type=="danh-tu") {
				$array[$key] = ucfirst($value);
			}
		}
	
		$result = implode(" ", $array);
	
		// Chuyen ky tu dau tien thanh chu hoa
		$result	= ucfirst($result);
	
		return $result;
	}
	
	function readNumber12Digits($number, $dictionnaryUnits, $dictionnaryNumbers){
		$number 	= strval($number);
		$number 	= str_pad($number, 12, 0, STR_PAD_LEFT);
		$arrNumber 	= str_split($number, 3);
		
		foreach($arrNumber as $key => $value){
			if($value != "000"){
				$index = $key;
				break;
			}
		}
		foreach($arrNumber as $key => $value){
			if($key >= $index){
				$readFull = true;
				if($key >= $index) $readFull = false;
				$result[$key] = readNumber3Digits($value, $dictionnaryNumbers, $readFull) . " " . $dictionnaryUnits[$key];
			}
		}
		$result = implode(" ", $result);
		$result = formatString($result);
		
// 		$result = str_replace("không đồng", "đồng", $result);
// 		$result = str_replace("không trăm đồng", "đồng", $result);
// 		$result = str_replace("không nghìn đồng", "đồng", $result);
// 		$result = str_replace("không trăm nghìn đồng", "đồng", $result);
 		$result = str_replace("triệu nghìn đồng", "triệu đồng", $result);
 		$result = str_replace("tỷ triệu đồng", "tỷ đồng", $result);
		return $result;
	}
	$number 	= 1000; 
	$result = readNumber12Digits($number, $dictionnaryUnits, $dictionnaryNumbers);
	echo "Input: " . $number . '<br />';
	echo "Output: " . $result . '<br />';
	
	