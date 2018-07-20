<?php
$xml2 = new DOMDocument('1.0','UTF-8');

$xml2->load("03.xml");

$book = $xml2->getElementsByTagName("book");
$currentNode = $book -> item(0);
$titleNode = $currentNode -> getElementsByTagName("title");

echo "<pre>";
print_r($titleNode->item(0));
echo "</pre>";