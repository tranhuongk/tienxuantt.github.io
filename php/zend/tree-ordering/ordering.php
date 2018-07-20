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
 		 FROM ' . $tree->getTable() . ' 
 		 WHERE lft != 0 
 		 ORDER BY lft ASC'; 
 		 
 		 
  
 echo '<br>' . $sql;
 $result = mysql_query($sql,$tree->getConnect());
 $data = array();
 while($row = mysql_fetch_assoc($result)){
 	$data[] = $row;
 }
 
 $ordering = array();
 foreach ($data as $key => $val){ 
 	$ordering[$val['parent']][] = $val['id'];
 }
 
 /*echo '<pre>';
 print_r($ordering);
 echo '</pre>';*/
 
?>
<table width="500px" border="1">
<?php  
  foreach ($data as $key => $val){ 
  	$orderKey = array_search($val['id'], $ordering[$val['parent']]) + 1;
 	$id = $val['id'];
 	$strMenu = '';
 	if($val['level'] == 1){
 		$strMenu = '+ ' . $val['name']; 		 
 	}else{
 		$strMenu = str_repeat('|&mdash; ', $val['level']-1) . $val['name']; 
 	}
?>
<tr>
	<td width="30" style="text-align: center;"><?php echo $id;?></td>
	<td><?php echo $strMenu;?></td>
	<td width="100" style="text-align: center;"><?php echo $orderKey;?></td>
</tr>
<?php  	
 }
 
?>
</table>







 