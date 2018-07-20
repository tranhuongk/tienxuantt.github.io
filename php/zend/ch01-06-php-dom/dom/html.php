<?php 
	$html	= '<!DOCTYPE html>
				<html lang="en">
					<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>PHP Show Data</title>
					<link href="css/bootstrap.min.css" rel="stylesheet">
					<link href="css/style.css" rel="stylesheet">
				</head>
			<body>
				<div class="container list-quiz">
					<h1 class="page-header">Danh sách phim</h1>
					<div id="show-film">
						<div class="row film-info">
							<div class="col-md-3">
								<div class="thumbnail">
									<img alt="Image 01" src="data/face-reader.jpg">
									<div class="caption">
										<h3>The Face Reader</h3>
										<p>2013</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="thumbnail">
									<img alt="Image 01" src="data/pirate-fairy.jpg">
									<div class="caption">
										<h3>The Pirate Fairy</h3>
										<p>2014</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="thumbnail">
									<img alt="Image 01" src="data/sadako.jpg">
									<div class="caption">
										<h3>Sadako</h3>
										<p>2013</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="thumbnail">
									<img alt="Image 01" src="data/resident-evil-3.jpg">
									<div class="caption">
										<h3>Resident Evil 3</h3>
										<p>2007</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<p class="col-md-2 col-md-offset-5">
							<button type="button" id="btn-show" onclick="javascript:lastPostFunc();" class="btn btn-primary btn-block">Xem thêm</button>
						</p>
					</div>
				</div>
			</body>
			</html>';
?>
