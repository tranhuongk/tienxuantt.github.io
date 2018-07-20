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
 
  $sql = 'SELECT * 
 		 FROM ' . $tree->getTable() . ' AS node,' . $tree->getTable() . ' AS parent 
 		 WHERE node.lft BETWEEN parent.lft AND parent.rgt 
 		 AND node.id =  15 
 		 ORDER BY node.lft ASC'; 
 		 
 		 
  
 echo '<br>' . $sql;
 $result = mysql_query($sql,$tree->getConnect());
 
 while($row = mysql_fetch_assoc($result)){
 	$strMenu = '';
 	if($row['level'] == 0){
 		$strMenu = '+ ' . $row['name']; 		 
 	}else{
 		$strMenu = str_repeat('|&mdash; ', $row['level']) . $row['name']; 
 	}
 	echo '<br>' . $strMenu;
 }
?>

 