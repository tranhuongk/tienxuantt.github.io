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
 
 $data = array('name'=>'Group O.1.2','url'=>'http://www.group-o12.vn');
 $id = 11;
 $newParentID = 4;

 $tree->updateNode($data,$id,$newParentID);
 
 
 
 
 
 
 
 
 