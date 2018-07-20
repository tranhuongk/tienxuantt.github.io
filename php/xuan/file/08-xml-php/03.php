<?php
$xml2 = new DOMDocument('1.0','UTF-8');

// $book = $xml2 -> createElement("book");
// $bookText = $xml2 -> createTextNode("lap trinh php");
$book = $xml2 -> createElement("book");
$title = $xml2 -> createElement("title","lap trinh php2");
$author = $xml2 -> createElement("author","zend");
$name = $xml2 -> createElement("name","xuan");
$units = $xml2 -> createAttribute("units");
$units -> value = "gram";
// $book->appendChild($bookText);
$book->appendChild($units);
$book->appendChild($title);
$book->appendChild($author);
$book->appendChild($name);
$xml2->appendChild($book);

$xml2->formatOutput = true;
$xml2->save("03.xml");
