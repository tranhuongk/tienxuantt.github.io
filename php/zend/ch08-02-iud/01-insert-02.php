<?php
	$connect = @mysqli_connect('localhost', 'root', '');
	
	if(!$connect) die('<h3>Fail</h3>');
	
	// INSERT
	mysqli_select_db($connect,'manage_user');
	
	$arrData = array('name'=>'Member 1234', 'status' => 0, 'ordering' => 9);
	
	function createInsertSQL($data){
		$cols = "";
		$vals = "";
		$newQuery = array();
		if(!empty($data)){
			foreach($data as $key=> $value){
				$cols .= ", `$key`";
				$vals .= ", '$value'";
			}
		}
		$newQuery['cols'] = substr($cols, 2);
		$newQuery['vals'] = substr($vals, 2);
		return $newQuery;
	}
	
	
	
	$newQuery = createInsertSQL($arrData);
	
	$query = "INSERT INTO `group`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";

	
	$result = mysqli_query($connect,$query );
	
	if($result){
		echo $total = mysqli_affected_rows($connect);
	}else{
		echo mysqli_error($connect);
	}
	
	mysqli_close($connect);