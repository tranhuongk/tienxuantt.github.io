<meta charset="utf-8">
<?php 
	include_once 'html.php';
	
	preg_match('#id="show-film">(.*)</div>\s*<div class="row">#imsU', $html, $matches);
	preg_match_all('#class="thumbnail">\s*<img.*src="(.*)">\s*<div class="caption">\s*<h3>(.*)</h3>\s*<p>(.*)</p>#imsU', $matches[1], $matches);
	
	$result = array();
	foreach($matches[1] as $key => $value){
		$result[$key]['image'] 	= $matches[1][$key];
		$result[$key]['name'] 	= $matches[2][$key];
		$result[$key]['year'] 	= $matches[3][$key];
	}
	
	echo '<pre style="color:red;font-weight:bold">';
	print_r($result);
	echo '</pre>';