<meta charset="utf-8">
<?php 
	include_once 'html.php';
	
	$doc	= new DOMDocument();
	$doc->loadHTML($html);
	
	$xpath	= new DOMXPath($doc);
	
	$objNode	= $xpath->query('//div[@class="caption"]/h3 | //div[@class="caption"]/p | //div[@class="thumbnail"]/img');
	
	$i	= 0;
	$result		= array();
	foreach ($objNode as $obj) {
		if(count($result) == 4) break;
		$tmp['image']	= $objNode->item($i)->getAttribute('src');
		$tmp['name']	= $objNode->item($i+1)->nodeValue;
		$tmp['year']	= $objNode->item($i+2)->nodeValue;
		$result[]	= $tmp;
		$i+=3;
	}
	
	
	
	
	
	echo '<pre style="color:red;font-weight:bold">';
	print_r($result);
	echo '</pre>';
	