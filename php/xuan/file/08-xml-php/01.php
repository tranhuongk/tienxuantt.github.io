<?php
$strxml = '<?xml version="1.0" encoding="UTF-8"?>
<bookshop>
<book>
    <title> Lap trinh php1 </title>
    <author> zendvn1 </author>
    <pages> 5001 </pages>
    <weight units="gram">4001</weight>
</book>
<book>
    <title> Lap trinh php2 </title>
    <author> zendvn2 </author>
    <pages> 5002 </pages>
    <weight units="kg"> 420 </weight>
</book>
<book>
    <title> Lap trinh php3 </title>
    <author> zendvn3 </author>
    <pages> 5003 </pages>
    <weight units="kg"> 4003 </weight>
</book>
<book>
    <title> Lap trinh php4 </title>
    <author> zendvn4 </author>
    <pages> 5004 </pages>
    <weight units="gram"> 406 </weight>
</book>
</bookshop>';
$xml2 = simplexml_load_file("01.xml");

// $arr = array("name" => "xuan", "age" => 20, "school" => "uet");
// echo "<pre>";
// print_r($arr);
// echo "</pre>";
echo "<pre>";
print_r($xml2);
echo "</pre>";
echo gettype($xml2);
echo $xml = $xml2 -> asXML();
echo gettype($xml);


