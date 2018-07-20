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
	
	public function getTable(){
		return $this->_table;
	}
	
	public function getConnect(){
		return $this->_connect;
	}
	
	public function removeNode($id,$options = 'branch'){
		$this->_id = $id;
		
		if($options == 'branch' || $options == null ) $this->removeBranch();
		
		if($options == 'one') $this->removeOne();
		
	}
	
	protected function removeBranch(){
		echo '<br>' . __METHOD__;
		
		/*================================================
		 *  1. Lay thong cua node bi xoa
		/*================================================*/
		$infoNodeRemove  = $this->getNodeInfo($this->_id);		
		
		
		/*================================================
		 *  2. Tinh chieu dai cua nhanh chung muon xoa
		/*================================================*/
		$widthNodeRemove = $this->widthNode($infoNodeRemove['lft'], $infoNodeRemove['rgt']);
		
		/*================================================
		 *  3. Xoa nhanh
		/*================================================*/
		$sqlDelete = 'DELETE FROM ' .$this->_table . '
					   WHERE lft BETWEEN ' . $infoNodeRemove['lft'] . ' AND ' . $infoNodeRemove['rgt'];
		mysql_query($sqlDelete,$this->_connect);	
		
		
		/*================================================
		 *  4. Cap nhat lai cai gia tri left - right của cay
		/*================================================*/
		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft - ' . $widthNodeRemove . ')
		  				   WHERE lft > ' . $infoNodeRemove['rgt'];		
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt - ' . $widthNodeRemove . ')
		  				   WHERE rgt > ' . $infoNodeRemove['rgt'];		
		mysql_query($sqlUpdateRight,$this->_connect);
		
	}
	
	protected function removeOne(){
		
		$nodeInfo = $this->getNodeInfo($this->_id);
		
		$sql = 'SELECT id 
				FROM ' . $this->_table . ' 
				WHERE parent = ' . $this->_id . '
				ORDER BY lft DESC';
		$result = mysql_query($sql,$this->_connect);
				
		while($row = mysql_fetch_assoc($result)){
			$childIds[] = $row['id'];
		}		
	
		if(count($childIds)>0){
			foreach ($childIds as $val){
				$id = $val;
				$parent = $nodeInfo['parent'];
				$options = array('position' => 'after', 'brother_id' => $nodeInfo['id']);
				$this->moveNode($id, $parent,$options);				
			}
			$this->removeNode($nodeInfo['id']);
		}
		
		
	}
	
	public  function  updateNode($data, $id = null, $newParentID = 0){
		if($id != 0 && $id > 0 && count($data)!=0  ){
			
			$strUpdate = $this->createUpdateQuery($data);			
			$sql = 'UPDATE ' . $this->_table . ' 
					SET ' . $strUpdate . ' 
					WHERE id =  ' . $id;
			//echo '<br>' . $sql;
			mysql_query($sql,$this->_connect);
			
			$infoNode = $this->getNodeInfo($id);
			
			if($newParentID > 0 && $newParentID != null){
				if($infoNode['parent'] != $newParentID){
					$this->moveNode($id, $newParentID);
				}
			}
					
			
		}
	}
	
	protected function createUpdateQuery($data){
		echo '<br>' . __METHOD__;
		if(count($data)>0){
			$result = '';
			$i = 1;
			foreach ($data as $key => $val){
				if($i == 1){
					$result .= " " . $key . "= '" . $val . "'";
				}else{
					$result .= ", " . $key . "= '" . $val . "'";
				}
				$i++;
			}
			
			return $result;
		}
	}
	
	public function moveNode($id, $parent, $options = null){
		$this->_id = $id;
		$this->_parent_id = $parent;
		
		if($options['position'] == 'right' || $options == null ) $this->moveRight();
		
		if($options['position'] == 'left') $this->moveLeft();
		
		if($options['position'] == 'before') $this->moveBefore($options['brother_id']);
		
		if($options['position'] == 'after') $this->moveAfter($options['brother_id']);
		
	}
	
	public function moveUp($id){
		echo '<br>' . __METHOD__;
		$infoMoveNode = $this->getNodeInfo($id);
		echo '<pre>';
		print_r($infoMoveNode);
		echo '</pre>';
		$infoParentNode = $this->getNodeInfo($infoMoveNode['parent']);
		echo '<pre>';
		print_r($infoParentNode);
		echo '</pre>';
		
		$sql = 'SELECT * 
				FROM ' . $this->_table .' 
				WHERE parent = ' . $infoMoveNode['parent'] .' 
				AND lft < ' . $infoMoveNode['lft'] . ' 
				ORDER BY lft DESC 
				LIMIT 1
				';
		$result = mysql_query($sql,$this->_connect);
		$infoBrotherNode = mysql_fetch_assoc($result);
		
		echo '<pre>';
		print_r($infoBrotherNode);
		echo '</pre>';
		
		if(!empty($infoBrotherNode)){
			$options = array('position'=>'before','brother_id'=>$infoBrotherNode['id']);
			$this->moveNode($id, $infoMoveNode['parent'],$options);
		}
		
	}
	
	public function moveDown($id){
		
		$infoMoveNode = $this->getNodeInfo($id);
		
		$infoParentNode = $this->getNodeInfo($infoMoveNode['parent']);
		
		
		$sql = 'SELECT * 
				FROM ' . $this->_table .' 
				WHERE parent = ' . $infoMoveNode['parent'] .' 
				AND lft > ' . $infoMoveNode['lft'] . ' 
				ORDER BY lft ASC 
				LIMIT 1
				';
		$result = mysql_query($sql,$this->_connect);
		$infoBrotherNode = mysql_fetch_assoc($result);
		
		
		if(!empty($infoBrotherNode)){
			$options = array('position'=>'after','brother_id'=>$infoBrotherNode['id']);
			$this->moveNode($id, $infoMoveNode['parent'],$options);
		}
		
	}
	
	protected function moveRight(){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
				
		$lftMoveNode = $infoMoveNode['lft']; // 3
		$rgtMoveNode = $infoMoveNode['rgt']; // 6
		
		/*================================================
		 *  1. Tach nhanh khoi cay
		/*================================================*/
	
		$sqlSelect = 'UPDATE ' . $this->_table . ' 
					  SET lft = (lft - ' . $lftMoveNode . '),
					  	  rgt = (rgt - ' . $rgtMoveNode . ') 
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		echo '<br>' . $sqlSelect;
		mysql_query($sqlSelect,$this->_connect);		
		
		/*================================================
		 *  2. Tinh do dai cua nhanh chung ta cat
		/*================================================*/
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);		
		
		/*================================================
		 *  3. Cap nhat gia tri cac node nam ben phai cua node tach
		/*================================================*/
		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft - ' . $widthMoveNode . ')
		  				   WHERE lft > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt - ' . $widthMoveNode . ')
		  				   WHERE rgt > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);
		
		/*================================================
		 *  4. Lay ra thong thong tin cua node cha ($infoParentNode)
		/*================================================*/
		
		$infoParentNode = $this->getNodeInfo($this->_parent_id);		
		$rgtParentNode = $infoParentNode['rgt'];
		
		
		/*================================================
		 * 5. Cap nhat cac gia tri truoc khi gan nhanh vao
		/*================================================*/
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $widthMoveNode . ')
		  				   WHERE lft > ' . $rgtParentNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $widthMoveNode . ')
		  				   WHERE rgt >= ' . $rgtParentNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);		
		
		/*================================================
		 * 6. Cap nhat level cho nhanh sap dc gan vao cay
		/*================================================*/
		$levelMoveNode = $infoMoveNode['level'];
		$levelParentNode = $infoParentNode['level'];
		$sqlUpdateLevel = 'UPDATE ' . $this->_table . ' 
						   SET level = (level - ' . $levelMoveNode . '+' . $levelParentNode . '+ 1) 
						   WHERE rgt <=0';
		 echo '<br>' . $sqlUpdateLevel;
		mysql_query($sqlUpdateLevel,$this->_connect);
		
		/*================================================
		 * 7. Cap nhat nhanh truoc khi gan vao node moi
		/*================================================*/		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $infoParentNode['rgt'] . ')
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $infoParentNode['rgt'] . '+' . $widthMoveNode . '- 1)
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		/*================================================
		 * 8. Gan vao node cha
		/*================================================*/
		$sqlUpdateNode = ' UPDATE ' . $this->_table . ' 
		 				   SET parent = ' .  $infoParentNode['id'] . ' 
		  				   WHERE id = ' . $infoMoveNode['id'];
		
		echo '<br>' . $sqlUpdateNode;
		mysql_query($sqlUpdateNode,$this->_connect);	
		
	}
		
	protected function moveLeft(){
		$infoMoveNode = $this->getNodeInfo($this->_id);
				
		$lftMoveNode = $infoMoveNode['lft']; // 3
		$rgtMoveNode = $infoMoveNode['rgt']; // 6
		
		/*================================================
		 *  1. Tach nhanh khoi cay
		/*================================================*/
	
		$sqlSelect = 'UPDATE ' . $this->_table . ' 
					  SET lft = (lft - ' . $lftMoveNode . '),
					  	  rgt = (rgt - ' . $rgtMoveNode . ') 
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		echo '<br>' . $sqlSelect;
		mysql_query($sqlSelect,$this->_connect);		
		
		/*================================================
		 *  2. Tinh do dai cua nhanh chung ta cat
		/*================================================*/
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);		
		
		/*================================================
		 *  3. Cap nhat gia tri cac node nam ben phai cua node tach
		/*================================================*/
		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft - ' . $widthMoveNode . ')
		  				   WHERE lft > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt - ' . $widthMoveNode . ')
		  				   WHERE rgt > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);
		
		/*================================================
		 *  4. Lay ra thong thong tin cua node cha ($infoParentNode)
		/*================================================*/
		
		$infoParentNode = $this->getNodeInfo($this->_parent_id);		
		$lftParentNode = $infoParentNode['lft'];
		
		/*================================================
		 * 5. Cap nhat cac gia tri truoc khi gan nhanh vao
		/*================================================*/
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $widthMoveNode . ')
		  				   WHERE lft > ' . $lftParentNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $widthMoveNode . ')
		  				   WHERE rgt > ' . $lftParentNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		/*================================================
		 * 6. Cap nhat level cho nhanh sap dc gan vao cay
		/*================================================*/
		$levelMoveNode = $infoMoveNode['level'];
		$levelParentNode = $infoParentNode['level'];
		$sqlUpdateLevel = 'UPDATE ' . $this->_table . ' 
						   SET level = (level - ' . $levelMoveNode . '+' . $levelParentNode . '+ 1) 
						   WHERE rgt <=0';
		 echo '<br>' . $sqlUpdateLevel;
		mysql_query($sqlUpdateLevel,$this->_connect);
		
		/*================================================
		 * 7. Cap nhat nhanh truoc khi gan vao node moi
		/*================================================*/		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $infoParentNode['lft'] . '+' . ' 1)
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $infoParentNode['lft'] . '+' . $widthMoveNode . ')
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);			
		
		/*================================================
		 * 8. Gan vao node cha
		/*================================================*/
		$sqlUpdateNode = ' UPDATE ' . $this->_table . ' 
		 				   SET parent = ' .  $infoParentNode['id'] . ' 
		  				   WHERE id = ' . $infoMoveNode['id'];
		
		echo '<br>' . $sqlUpdateNode;
		mysql_query($sqlUpdateNode,$this->_connect);	
		
		
	}
	
	protected function moveBefore($brother_id){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
				
		$lftMoveNode = $infoMoveNode['lft']; // 3
		$rgtMoveNode = $infoMoveNode['rgt']; // 6
		
		/*================================================
		 *  1. Tach nhanh khoi cay
		/*================================================*/
	
		$sqlSelect = 'UPDATE ' . $this->_table . ' 
					  SET lft = (lft - ' . $lftMoveNode . '),
					  	  rgt = (rgt - ' . $rgtMoveNode . ') 
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		echo '<br>' . $sqlSelect;
		mysql_query($sqlSelect,$this->_connect);		
		
		
		/*================================================
		 *  2. Tinh do dai cua nhanh chung ta cat
		/*================================================*/
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);		
		
		/*================================================
		 *  3. Cap nhat gia tri cac node nam ben phai cua node tach
		/*================================================*/
		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft - ' . $widthMoveNode . ')
		  				   WHERE lft > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt - ' . $widthMoveNode . ')
		  				   WHERE rgt > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);
		
		/*================================================
		 *  4. Lay ra thong thong tin cua node cha ($infoParentNode)
		/*================================================*/
		
		$infoParentNode = $this->getNodeInfo($this->_parent_id);	
		
		/*================================================
		 *  5. Lay gia tri cua node brother ($infoBrotherNode)
		/*================================================*/
		
		$infoBrotherNode = $this->getNodeInfo($brother_id);		
		$lftBrotherNode  = $infoBrotherNode['lft'];
		
		/*================================================
		 * 6. Cap nhat cac gia tri truoc khi gan nhanh vao
		/*================================================*/
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $widthMoveNode . ')
		  				   WHERE lft >= ' . $lftBrotherNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $widthMoveNode . ')
		  				   WHERE rgt > ' . $lftBrotherNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		/*================================================
		 * 7. Cap nhat level cho nhanh sap dc gan vao cay
		/*================================================*/
		$levelMoveNode = $infoMoveNode['level'];
		$levelParentNode = $infoParentNode['level'];
		$sqlUpdateLevel = 'UPDATE ' . $this->_table . ' 
						   SET level = (level - ' . $levelMoveNode . '+' . $levelParentNode . '+ 1) 
						   WHERE rgt <=0';
		 echo '<br>' . $sqlUpdateLevel;
		mysql_query($sqlUpdateLevel,$this->_connect);
		
		/*================================================
		 * 8. Cap nhat nhanh truoc khi gan vao node moi
		/*================================================*/		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $lftBrotherNode . ')
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $lftBrotherNode . '+' . $widthMoveNode . '- 1)
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		/*================================================
		 * 9. Gan vao node cha
		/*================================================*/
		$sqlUpdateNode = ' UPDATE ' . $this->_table . ' 
		 				   SET parent = ' .  $infoParentNode['id'] . ' 
		  				   WHERE id = ' . $infoMoveNode['id'];
		
		echo '<br>' . $sqlUpdateNode;
		mysql_query($sqlUpdateNode,$this->_connect);
	}
	
	protected function moveAfter($brother_id){
		
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
				
		$lftMoveNode = $infoMoveNode['lft']; // 3
		$rgtMoveNode = $infoMoveNode['rgt']; // 6
		
		/*================================================
		 *  1. Tach nhanh khoi cay
		/*================================================*/
	
		$sqlSelect = 'UPDATE ' . $this->_table . ' 
					  SET lft = (lft - ' . $lftMoveNode . '),
					  	  rgt = (rgt - ' . $rgtMoveNode . ') 
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		echo '<br>' . $sqlSelect;
		mysql_query($sqlSelect,$this->_connect);		
		
		/*================================================
		 *  2. Tinh do dai cua nhanh chung ta cat
		/*================================================*/
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);		
		
		/*================================================
		 *  3. Cap nhat gia tri cac node nam ben phai cua node tach
		/*================================================*/
		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft - ' . $widthMoveNode . ')
		  				   WHERE lft > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt - ' . $widthMoveNode . ')
		  				   WHERE rgt > ' . $rgtMoveNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);
		
		/*================================================
		 *  4. Lay ra thong thong tin cua node cha ($infoParentNode)
		/*================================================*/
		
		$infoParentNode = $this->getNodeInfo($this->_parent_id);	
		
		/*================================================
		 *  5. Lay gia tri cua node brother ($infoBrotherNode)
		/*================================================*/
		
		$infoBrotherNode = $this->getNodeInfo($brother_id);		
		$rgtBrotherNode  = $infoBrotherNode['rgt'];
		
		/*================================================
		 * 6. Cap nhat cac gia tri truoc khi gan nhanh vao
		/*================================================*/
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $widthMoveNode . ')
		  				   WHERE lft > ' . $rgtBrotherNode;
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $widthMoveNode . ')
		  				   WHERE rgt > ' . $rgtBrotherNode;
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		/*================================================
		 * 7. Cap nhat level cho nhanh sap dc gan vao cay
		/*================================================*/
		$levelMoveNode = $infoMoveNode['level'];
		$levelParentNode = $infoParentNode['level'];
		$sqlUpdateLevel = 'UPDATE ' . $this->_table . ' 
						   SET level = (level - ' . $levelMoveNode . '+' . $levelParentNode . '+ 1) 
						   WHERE rgt <=0';
		 echo '<br>' . $sqlUpdateLevel;
		mysql_query($sqlUpdateLevel,$this->_connect);
		
		/*================================================
		 * 8. Cap nhat nhanh truoc khi gan vao node moi
		/*================================================*/		
		$sqlUpdateLeft = ' UPDATE ' . $this->_table . ' 
		  				   SET lft = (lft + ' . $rgtBrotherNode . '+ 1)
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateLeft;
		mysql_query($sqlUpdateLeft,$this->_connect);
		
		$sqlUpdateRight = ' UPDATE ' . $this->_table . ' 
		  				   SET rgt = (rgt + ' . $rgtBrotherNode . '+' . $widthMoveNode . ')
		  				   WHERE rgt <= 0 ';
		echo '<br>' . $sqlUpdateRight;
		mysql_query($sqlUpdateRight,$this->_connect);	
		
		/*================================================
		 * 9. Gan vao node cha
		/*================================================*/
		$sqlUpdateNode = ' UPDATE ' . $this->_table . ' 
		 				   SET parent = ' .  $infoParentNode['id'] . ' 
		  				   WHERE id = ' . $infoMoveNode['id'];
		
		echo '<br>' . $sqlUpdateNode;
		mysql_query($sqlUpdateNode,$this->_connect);
		
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