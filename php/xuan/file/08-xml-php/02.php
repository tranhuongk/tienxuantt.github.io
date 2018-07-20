<?php
$xml2 = simplexml_load_file("02.xml");

echo "<pre>";
print_r($xml2);
echo "</pre>";
// echo "<pre>";
// print_r($xml2 -> book[0]);
// echo "</pre>";
// echo "<pre>";
// print_r($xml2 -> book[0] -> title );
// echo "</pre>";
// echo $xml2 -> book[0] -> title;
echo $xml2 -> book[0] -> attributes() -> id;
echo $xml2 -> book[0] -> shipping -> VN;
