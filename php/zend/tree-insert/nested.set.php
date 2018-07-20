<?php
class Nested_Set{
	
	protected $_connect;
	
	protected $_db;
	
	protected $_table;
	
	public $_data;
	 
	public $_parent_id;
	 
	public $_id; 
	
	
	public function __construct($params = array(),$adapter = 'mysql'){
		
		if(count($params)>0) {
			if($adapter == 'mysql'){
				$link = mysql_connect($params['server'],$params['username'],$params['password']);
				if(!$link){
					die('Could not connect: ' . mysql_error());
				}else{
					$this->_connect 	= $link;
					$this->_db 			= $params['db'];
					$this->_table 		= $params['table'];
					$this->setDb();
				}
			}
		
		}
	}
	
	public function setConnect($connect){
		$this->_connect = $connect;
	}
	
	public function setDb($db = null){
		if($db != null){
			$this->_db = $db;
		}		
		mysql_select_db($this->_db,$this->_connect);
	}
	
	public function setTable($table){
		$this->_table = $table;
	}	
	
	public function widthNode($lftMoveNode,$rgtMoveNode){
		$widthMoveNode = $rgtMoveNode - $lftMoveNode + 1;
		return $widthMoveNode;
	}
	
	public function insertNode($data,$parent = 1,$options = null){
		
		$this->_data = $data;
		$this->_parent_id = $parent;
		
		if($options['position'] == 'right' || $options == null ) $this->insertRight();
		
		if($options['position'] == 'left') $this->insertLeft();
		
		if($options['position'] == 'before') $this->insertBefore($options['brother_id']);
		
		if($options['position'] == 'after') $this->insertAfter($options['brother_id']);
		
	}
	
	protected function insertAfter($brother_id){
		echo '<br>' . __METHOD__;
		
		$parentInfo  = $this->getNodeInfo($this->_parent_id);		
		echo '<pre>';
		print_r($parentInfo);
		echo '</pre>';
		
		$brothderInfo = $this->getNodeInfo($brother_id);
		echo '<pre>';
		print_r($brothderInfo);
		echo '</pre>';
		
		$sqlUpdateLeft = 'UPDATE ' .$this->_table 
						 . ' SET lft = (lft + 2) '
						 . ' WHERE lft > ' . $brothderInfo['rgt'];
		echo '<br>' . $sqlUpdateLeft;						 
		mysql_query($sqlUpdateLeft,$this->_connect);

		$sqlUpdateRight = 'UPDATE ' .$this->_table 
						 . ' SET rgt = (rgt + 2) '
						 . ' WHERE rgt > ' . $brothderInfo['rgt'];
		echo '<br>' . $sqlUpdateRight;						 
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		$data = $this->_data;	
		$data['parent'] 	= $parentInfo['id']; //$this->_parent_id
		$data['lft'] 		= $brothderInfo['rgt'] + 1;
		$data['rgt'] 		= $brothderInfo['rgt'] + 2;
		$data['level'] 		= $parentInfo['level'] + 1;
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		$newQuey = $this->createInsertQuery($data);
		
		$sqlInsert = 'INSERT INTO ' . $this->_table 
					 . "(" . $newQuey['cols'] . ") "
					 . " VALUES(" . $newQuey['vals'] . ")"; 
		echo '<br>' . $sqlInsert;
		mysql_query($sqlInsert,$this->_connect);	
	
		
	}
	
	protected function insertBefore($brother_id){
		
		$parentInfo  = $this->getNodeInfo($this->_parent_id);		
		
		$brothderInfo = $this->getNodeInfo($brother_id);
	
		$sqlUpdateLeft = 'UPDATE ' .$this->_table 
						 . ' SET lft = (lft + 2) '
						 . ' WHERE lft >= ' . $brothderInfo['lft'];
		//echo '<br>' . $sqlUpdateLeft;						 
		mysql_query($sqlUpdateLeft,$this->_connect);	
		
		$sqlUpdateRight = 'UPDATE ' .$this->_table 
						 . ' SET rgt = (rgt + 2) '
						 . ' WHERE rgt >= ' . ($brothderInfo['lft'] + 1);
		//echo '<br>' . $sqlUpdateRight;						 
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		$data = $this->_data;	
		$data['parent'] 	= $parentInfo['id']; //$this->_parent_id
		$data['lft'] 		= $brothderInfo['lft'];
		$data['rgt'] 		= $brothderInfo['lft']+1;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newQuey = $this->createInsertQuery($data);
		
		$sqlInsert = 'INSERT INTO ' . $this->_table 
					 . "(" . $newQuey['cols'] . ") "
					 . " VALUES(" . $newQuey['vals'] . ")"; 
		//echo '<br>' . $sqlInsert;
		mysql_query($sqlInsert,$this->_connect);	
		
		
		
		
	}
	
	protected function insertLeft(){
		$parentInfo  = $this->getNodeInfo($this->_parent_id);
		
		$parentLeft = $parentInfo['lft'];
				
		$sqlUpdateLeft = 'UPDATE ' .$this->_table 
						 . ' SET lft = (lft + 2) '
						 . ' WHERE lft >= ' . ($parentLeft + 1);
		echo '<br>' . $sqlUpdateLeft;						 
		mysql_query($sqlUpdateLeft,$this->_connect);	
		
		$sqlUpdateRight = 'UPDATE ' .$this->_table 
						 . ' SET rgt = (rgt + 2) '
						 . ' WHERE rgt > ' . ($parentLeft + 1);
		echo '<br>' . $sqlUpdateRight;						 
		mysql_query($sqlUpdateRight,$this->_connect);		
		
		$data = $this->_data;	
		$data['parent'] 	= $parentInfo['id']; //$this->_parent_id
		$data['lft'] 		= $parentLeft + 1;
		$data['rgt'] 		= $parentLeft + 2;
		$data['level'] 		= $parentInfo['level'] + 1;
			
		$newQuey = $this->createInsertQuery($data);
		
		$sqlInsert = 'INSERT INTO ' . $this->_table 
					 . "(" . $newQuey['cols'] . ") "
					 . " VALUES(" . $newQuey['vals'] . ")"; 
		echo '<br>' . $sqlInsert;
		mysql_query($sqlInsert,$this->_connect);	
		
	}
	
	protected function insertRight(){
				
		$parentInfo  = $this->getNodeInfo($this->_parent_id);
		
		$parentRight = $parentInfo['rgt'];
		
		$sqlUpdateLeft = 'UPDATE ' .$this->_table 
						 . ' SET lft = (lft + 2) '
						 . ' WHERE lft > ' . $parentRight;
		echo '<br>' . $sqlUpdateLeft;						 
		mysql_query($sqlUpdateLeft,$this->_connect);		

		$sqlUpdateRight = 'UPDATE ' .$this->_table 
						 . ' SET rgt = (rgt + 2) '
						 . ' WHERE rgt >= ' . $parentRight;
		echo '<br>' . $sqlUpdateRight;						 
		mysql_query($sqlUpdateRight,$this->_connect);			

		$data = $this->_data;	
		$data['parent'] 	= $parentInfo['id']; //$this->_parent_id
		$data['lft'] 		= $parentRight;
		$data['rgt'] 		= $parentRight + 1;
		$data['level'] 		= $parentInfo['level'] + 1;
			
		$newQuey = $this->createInsertQuery($data);
		
		$sqlInsert = 'INSERT INTO ' . $this->_table 
					 . "(" . $newQuey['cols'] . ") "
					 . " VALUES(" . $newQuey['vals'] . ")"; 
		echo '<br>' . $sqlInsert;
		mysql_query($sqlInsert,$this->_connect);	
	}
	
	protected function createInsertQuery($data = null){
		if(count($data)>0 ){
			$cols = '';
			$vals = '';
			$i = 1;
			foreach ($data as $key => $value){
				if($i == 1){				
					$cols .= "`" . $key . "`";
					$vals .= "'" . $value . "'";
				}else{
					$cols .= ",`" . $key . "`";
					$vals .= ",'" . $value . "'";
				}
				$i++;
			}
			
			$newQuery['cols'] =  $cols;
			$newQuery['vals'] =  $vals;
		}
		return $newQuery;
	}
		
	public function getNodeInfo($id){
		$sql = 'SELECT * FROM ' . $this->_table . ' WHERE id = ' . $id;
		$result = mysql_query($sql,$this->_connect);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	
	
	
	
	
	
	
	
	
	
	
}