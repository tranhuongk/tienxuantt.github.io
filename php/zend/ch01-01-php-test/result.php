<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap 101 Template</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
	require_once 'functions.php';
	if(empty($_POST)) redirect('index.php');

	$arrQuestion = unserialize($_POST['array-data']);
	$xhtml = '';
	if(!empty($arrQuestion)){
		$i = 1;
		foreach ($arrQuestion as $key => $value){
			$questionId	= $_POST['question-' . $value['id']];
			
			$option0	= showAnswerCheck('option-0', $questionId, $value['answer'], $value['option-0']);
			$option1	= showAnswerCheck('option-1', $questionId, $value['answer'], $value['option-1']);
			$option2	= showAnswerCheck('option-2', $questionId, $value['answer'], $value['option-2']);
			$option3	= showAnswerCheck('option-3', $questionId, $value['answer'], $value['option-3']);
			
			$xhtml .= '<div class="form-group">
							<p>'.$i. '. ' . $value['question'].'</p>
							<div class="row">
								<div class="col-md-6">'.$option0.$option1.'</div>
								<div class="col-md-6">'.$option2.$option3.'</div>
							</div>
						</div>';
			$i++;
		}
	}
?>

	<div class="container list-quiz">
		<h1 class="page-header">Kết quả Trắc nghiệm trực tuyến</h1>
		<form action="#" method="post" name="test-form" id="test-form" >
			<?php echo $xhtml;?>
			<div class="form-group">
				<a href="index.php" class="btn btn-primary" >Làm lại</a>
			</div>
		</form>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>