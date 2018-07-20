<?php
	require_once 'Database.class.php';
	
	$params		= array(
						'server' 	=> 'localhost',
						'username'	=> 'root',
						'password'	=> '',
						'database'	=> 'manage_user',
						'table'		=> 'group',
					);
	
	$database = new Database($params);
	
	$data 	= array('status' => 0, 'ordering' => 0, 'name' => 'Admin xuan');
	$where	= array(
						array('status', 0),
						array('ordering', 99)
				);
	
	echo $database->update($data, $where);
	
