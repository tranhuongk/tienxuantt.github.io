<meta charset="utf-8">
<?php 
	include_once 'html.php';
	
	$doc	= new DOMDocument();
	$doc->loadHTML($html);
	
	$xpath	= new DOMXPath($doc);
	
	$nameNode	= $xpath->query('//div[@class="caption"]/h3');
	$yearNode	= $xpath->query('//div[@class="caption"]/p');
	$imageNode	= $xpath->query('//div[@class="thumbnail"]/img');
	
	$result		= array();
	for($i = 0; $i <= 3; $i ++){
		$result[$i]['name']		=	$nameNode->item($i)->nodeValue;
		$result[$i]['year']		=	$yearNode->item($i)->nodeValue;
		$result[$i]['image']	=	$imageNode->item($i)->getAttribute('src');
	}
	
	echo '<pre style="color:red;font-weight:bold">';
	print_r($result);
	echo '</pre>';
	