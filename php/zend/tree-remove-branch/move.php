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
/* MOVE RIGHT
 $id = 9;
 $parent = 5; 
 $tree->moveNode($id, $parent);*/
 
/* MOVE LEFT
 $id = 9;
 $parent = 5; 
 $options['position'] = 'left';
 $tree->moveNode($id, $parent,$options);*/
 
 
 /*$id = 9;
 $parent = 1; 
 $options['position'] = 'after';
 $options['brother_id'] = 4;
 $tree->moveNode($id,$parent,$options);*/
 
/* $id = 9;
 $tree->moveUp($id);*/
 
  $id = 9;
 $tree->moveDown($id);
 
 
 
 
 
 
 
 
 