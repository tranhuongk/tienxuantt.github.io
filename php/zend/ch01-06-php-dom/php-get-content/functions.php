<?php 

	function getContentVN1($link){
		$html	= file_get_contents($link);
		
		$doc	= new DOMDocument();
		@$doc->loadHTML($html);
		
		$contextNode	= $doc->getElementById('news_home');
		
		
		$xpath	= new DOMXPath($doc);
		
		$nameNode	= $xpath->query('.//div[@class="title_news"]/a', $contextNode);
		$imageNode	= $xpath->query('.//div[@class="thumb"]/a/img', $contextNode);
		$desNode	= $xpath->query('.//div[@class="news_lead"]', $contextNode);
		
		$xhtml = '<ol>';
		for($i = 0; $i <=3; $i++){
			$name			= trim($nameNode->item($i)->nodeValue);
			$link			= $nameNode->item($i)->getAttribute('href');
			$image			= $imageNode->item($i)->getAttribute('src');
			$description	= trim($desNode->item($i)->nodeValue);
			
			$xhtml .= '<li>
							<div class="media">
								<a class="pull-left" href="'.$link.'"><img class="media-object" src="'.$image.'"></a>
								<div class="media-body">
									<h4 class="media-heading"><a href="'.$link.'">'.$name.'</a></h4>'.$description.
								'</div>
							</div>
						</li>';
		}
		$xhtml .= '<ol>';

		return $xhtml;
	}
	
	function getContentVN2($link){
		$html	= file_get_contents($link);
		
		$doc	= new DOMDocument();
		@$doc->loadHTML($html);
		
		$contextNode	= $doc->getElementById('news_home');
		
		
		$xpath	= new DOMXPath($doc);
		
		$objNode	= $xpath->query('.//div[@class="title_news"]/a | .//div[@class="thumb"]/a/img | .//div[@class="news_lead"]', $contextNode);
		
		$i = 0;
		$xhtml = '<ol>';
		foreach($objNode as $node){
			if($i > 9) break;
			$name			= trim($objNode->item($i)->nodeValue);
			$link			= $objNode->item($i)->getAttribute('href');
			$image			= $objNode->item($i+1)->getAttribute('src');
			$description	= trim($objNode->item($i+2)->nodeValue);
			
			$xhtml .= '<li>
							<div class="media">
								<a class="pull-left" href="'.$link.'"><img class="media-object" src="'.$image.'"></a>
								<div class="media-body">
									<h4 class="media-heading"><a href="'.$link.'">'.$name.'</a></h4>'.$description.
												'</div>
							</div>
						</li>';
			
			$i+=3;
		}
		
		$xhtml .= '<ol>';
	
		return $xhtml;
	}
?>