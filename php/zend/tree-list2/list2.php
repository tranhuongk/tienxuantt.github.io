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
 echo '<br>' . $tree->getTable();
 
 $infoNode = $tree->getNodeInfo(5);
 
 echo '<pre>';
 print_r($infoNode);
 echo '</pre>';
 
  $sql = 'SELECT * 
 		 FROM ' . $tree->getTable() . '
 		 WHERE lft BETWEEN ' . $infoNode['lft'] . ' AND ' . $infoNode['rgt'] . ' 
 		 ORDER BY lft ASC';
  
 echo '<br>' . $sql;
 $result = mysql_query($sql,$tree->getConnect());
 
 while($row = mysql_fetch_assoc($result)){
 	$strMenu = '';
 	if($row['level'] == 1){
 		$strMenu = '+ ' . $row['name']; 		 
 	}else{
 		$strMenu = str_repeat('|&mdash; ', $row['level']-1) . $row['name']; 
 	}
 	echo '<br>' . $strMenu;
 }
?>

 