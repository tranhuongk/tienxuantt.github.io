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
 $data = array('name'=>'Group O.1','url'=>'http://www.group-o1.vn');
 $parent = 9; 
 //$tree->insertNode($data,$parent);