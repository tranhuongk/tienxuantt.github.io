<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tổng hợp tin tức thể thao - DOM</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div class="container list-quiz">
		<h1 class="page-header">Tổng hợp tin tức thể thao - DOM</h1>
		<div class="my-content">
			<ul class="nav nav-pills nav-justified">
				<li class="active"><a href="#vnexpress" data-toggle="tab">VnExpress 1</a></li>
				<li><a href="#dantri" data-toggle="tab">VnExpress 2</a></li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div id="vnexpress" class="tab-pane fade in active"></div>
				<div id="dantri" class="tab-pane fade"></div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var isLoad = false;
		$(document).ready(function(){
			$('#vnexpress').load('load-data.php', {type: 'vnexpress'});
			$('a[href="#dantri"]').on('click',function(){
				if(isLoad == false){
					if(length == 0) $('#dantri').load('load-data.php', {type: 'dantri'});
				}
			});
		});
	</script>
</body>
</html>