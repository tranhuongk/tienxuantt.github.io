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
 
 /*$sql = 'SELECT * 
 		FROM ' . $tree->getTable() . '
 		ORDER BY lft ASC';*/
 
 /* $sql = 'SELECT * 
 		 FROM ' . $tree->getTable() . '
 		 WHERE lft != 0 
 		 ORDER BY lft ASC';*/
 
  $sql = 'SELECT * 
 		 FROM ' . $tree->getTable() . '
 		 WHERE lft != 0 
 		 AND level <= 2 
 		 ORDER BY lft ASC';
  
 echo '<br>' . $sql;
 $result = mysql_query($sql,$tree->getConnect());
 
 while($row = mysql_fetch_assoc($result)){
/* 	echo '<pre>';
 	print_r($row);
 	echo '</pre>';*/
 	$strMenu = '';
 	if($row['level'] == 1){
 		$strMenu = '+ ' . $row['name']; 		 
 	}else{
 		$strMenu = str_repeat('|&mdash; ', $row['level']-1) . $row['name']; 
 	}
 	echo '<br>' . $strMenu;
?>
		
<?php  	
 }
?>
 