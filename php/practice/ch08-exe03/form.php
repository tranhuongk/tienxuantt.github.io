<?php
	require_once 'class/Validate.class.php'; 
	require_once 'class/HTML.class.php'; 
	require_once 'connect.php'; 
	session_start();
	
	$error 			= '';
	$success		= '';
	$outValidate	= array();
	if(isset($_GET['id'])){
		$id				= $_GET['id'];
	}
	if(isset($_GET['action'])){
		$action			= $_GET['action'];
	}
	$flagRedirect	= false;
	$titlePage		= '';
	
	if($action == 'edit'){
		$id = mysqli_real_escape_string($database->getConnect(),$id);
		$query = "SELECT `name`, `status`, `ordering` FROM `group` WHERE id = '" . $id . "'";
		$database->query($query);
		$outValidate	= $database->singleRecord();
		$linkForm		= 'form.php?action=edit&id=' . $id;
		if(empty($outValidate)) $flagRedirect	= true;		
		$titlePage		= 'EDIT GROUP';
	}else if($action == 'add'){
		$linkForm		= 'form.php?action=add';
		$titlePage		= 'ADD GROUP';
	}else{
		$flagRedirect	= true;
	}
	
	// Redirect page
	if($flagRedirect == true) {
		header('location: error.php');
		exit();
	}
	
	if(!empty($_POST)){
		if($_SESSION['token'] == $_POST['token']){ // refresh page
			unset($_SESSION['token']);
			header('location: ' . $linkForm);
			exit();
		}else{
			$_SESSION['token'] = $_POST['token'];
		}
		
		$source   = array('name' => $_POST['name'], 'status'=> $_POST['status'], 'ordering'=> $_POST['ordering']);
		$validate = new Validate($source);
		$validate->addRule('name', 'string', 2, 50)
				 ->addRule('ordering', 'int', 1, 10)
				 ->addRule('status', 'status');
		
		$validate->run();

		$outValidate = $validate->getResult();
		
		if(!$validate->isValid()){
			$error = $validate->showErrors();
		}else{
			if($action == 'edit'){
				$where = array(array('id', $id));
				$database->update($outValidate, $where);
			}else if($action == 'add'){
				$database->insert($outValidate);
				$outValidate = array();
			}
			$success = '<div class="success">Success</div>'; 
		}
	}
	
	$arrStatus 	= array(2=> 'Select status', 0 => 'Inactive', 1 => 'Active');
	if(!empty($error)){
		$status		= HTML::createSelectbox($arrStatus, 'status', $outValidate['status']);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title><?php echo $titlePage;?></title>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/my-js.js"></script>
</head>
<body>
	<div id="wrapper">
    	<div class="title"><?php echo $titlePage;?></div>
        <div id="form">   
        	<?php echo $error . $success; ?>
			<form action="<?php echo $linkForm;?>" method="post" name="add-form">
				<div class="row">
					<p>Name</p>
					<input type="text" name="name" value="<?php 
					if(!empty($error)){
						echo $outValidate['name'];
					}
					?>">
				</div>
				
				<div class="row">
					<p>Status</p>
					<?php 
					if(!empty($error)){
						echo $status;
					}
					?>
				</div>
				
				<div class="row">
					<p>Ordering</p>
					<input type="text" name="ordering" value="<?php
					if(!empty($error)){
						echo $outValidate['ordering'];
					}
					 ?>">
				</div>
				
				<div class="row">
					<input type="submit" value="Save" name="submit">
					<input type="button" value="Cancel" name="cancel" id="cancel-button">
					<input type="hidden" value="<?php echo time();?>" name="token" />
				</div>
												
			</form>    
        </div>
        
    </div>
</body>
</html>
