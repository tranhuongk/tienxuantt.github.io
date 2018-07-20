<?php
 require_once 'nested.set.php';
 
 $connArr = array(
 					'server'	=>'localhost',
 					'username'	=>'root',
 					'password'	=>'',
 					'db'		=>'nested_set',
 					'table'		=>'menu',
 				);
 
 $tree = new Nested_Set($connArr);
 $data = array('name'=>'Group B2','url'=>'http://www.group-b2.vn');
 $parent = 15; 
 $tree->insertNode($data,$parent);