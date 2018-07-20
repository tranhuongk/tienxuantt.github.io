<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin BookStore</title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="css/datepicker3.css" rel="stylesheet" type="text/css" />
	<link href="css/iCheck/minimal/blue.css" rel="stylesheet" type="text/css" />
	<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body class="skin-blue">
	<!-- HEADER START -->
	<header class="header">
		<?php include_once 'html/nav-left.php';?>
		<?php include_once 'html/nav-right.php';?>
	</header>
	<!-- HEADER END -->
	<div class="wrapper row-offcanvas row-offcanvas-left"
		style="min-height: 599px;">
		<!-- SIDEBAR START -->
		<aside class="left-side sidebar-offcanvas" style="min-height: 1772px;">
			<?php include_once 'html/sidebar.php';?>
		</aside>
		<!-- SIDEBAR END -->

		<!-- CONTENT START -->
		<aside class="right-side">
			<section class="content-header">
           		<?php include_once 'html/breadcrumb.php';?>         
			</section>
			<section class="content">
				<div class="row">
					<!-- BUTTON -->
					<div class="text-center">
						<a class="btn btn-app"><i class="fa fa-refresh"></i> Reload</a>
						<a class="btn btn-app"><i class="fa fa-plus-square-o"></i> Add</a>
						<a class="btn btn-app"><i class="fa fa-check-circle-o"></i> Publish</a>
						<a class="btn btn-app"><i class="fa fa-circle-o"></i> Unpublish</a>
						<a class="btn btn-app"><i class="fa fa-minus-square-o"></i> Delete</a>
					</div>
				</div>
				
				<div class="row">
					<!-- NOTICE -->
					<div class="alert alert-success alert-dismissable ">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<b>Alert!</b> Success alert preview. This alert is dismissable.
					</div>      
				</div>
                		<div class="box box-info">
                			<div class="box-header" style="padding-top: 10px;">
									<div class="col-xs-4">
										<div class="dataTables_filter" id="example1_filter" style="float: left;">
											<div class="input-group input-group-sm">
	                                        	<div class="input-group-btn">
		                                            <button type="button" data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle">Search by Name</button>
		                                            <ul class="dropdown-menu">
		                                                <li><a href="#">Search by Name</a></li>
		                                                <li><a href="#">Search by Email</a></li>
		                                                <li><a href="#">Search by All</a></li>
		                                            </ul>
		                                        </div>
		                                        <input type="text" class="form-control input-sm col-xs-2">
		                                        <span class="input-group-btn">
		                                        	<button class="btn btn-default btn-flat" type="button">Clear</button>
		                                            <button class="btn btn-primary btn-flat" type="button">Go!</button>
		                                        </span>
		                                    </div>
										</div>
									</div>
									<div class="col-xs-8 ">
										<div class="dataTables_filter pull-right">
											<select size="1" name="example1_length" class="input-sm">
												<option value="10" selected="selected">Select a status</option>
												<option value="25">25</option>
											</select> 
											<select size="1" name="example1_length" class="input-sm">
												<option value="10" selected="selected">Select a group</option>
												<option value="25">25</option>
											</select> 
										</div>
									</div>
                			</div>
                			<div class="box-body table-responsive">
								<div class="dataTables_wrapper" role="grid">
									<table class="table table-bordered table-striped dataTable text-center">
                                        <thead>
                                            <tr role="row">
                                            	<td class="small-col"><input type="checkbox" id="check-all"/></td>
                                            	<th class="sorting" >Name</th>
                                            	<th class="sorting">Browser</th>
                                            	<th class="sorting_asc" >Platform(s)</th>
                                            	<th class="sorting_desc">Engine version</th>
                                            	<th class="sorting">CSS grade</th>
                                            	<th style="small-col" class="sorting">Ordering</th>
                                            	<th style="small-col">Status</th>
                                            	<th class="small-col">ID</th>
                                            </tr>
                                        </thead>
                                        
                                    	<tbody>
                                    		<tr class="odd">
                                                <td class="small-col"><input type="checkbox" /></td>
                                                <td class=" "><a href="info.php">Gecko</a></td>
                                                <td class=" sorting_1">Firefox 1.0</td>
                                                <td class=" ">Win 98+ / OSX.2+</td>
                                                <td class=" ">1.7</td>
                                                <td class=" ">322</td>
                                                <td class=" " ><input type="text" style="width: 30px; text-align: center"></td>
                                                </td>
                                                <td class=" ">
                                                	<a class="label label-success"><i class="fa  fa-check"></i></a>
                                                </td>
                                                <td>3</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="small-col"><input type="checkbox" /></td>
                                                <td class=" sorting_1">Gecko</td>
                                                <td class=" ">Firefox 1.5</td>
                                                <td class=" ">Win 98+ / OSX.2+</td>
                                                <td class=" ">1.8</td>
                                                <td class=" ">A</td>
                                                <td class=" "><input type="text" style="width: 30px"></td>
                                                <td class=" ">
                                                	<a class="label label-success"><i class="fa  fa-check"></i></a>
                                                </td>
                                                <td>3</td>
                                            </tr>
                                            <tr class="odd">
                                            	<td class="small-col"><input type="checkbox" /></td>
                                                <td class=" sorting_1">Gecko</td>
                                                <td class=" ">Firefox 2.0</td>
                                                <td class=" ">Win 98+ / OSX.2+</td>
                                                <td class=" ">1.8</td>
                                                <td class=" ">A</td>
                                                <td class=" "><input type="text" style="width: 30px"></td>
                                                <td class="small-col">
                                                	<a class="label label-success"><i class="fa  fa-check"></i></a>
                                                </td>
                                                <td>3</td>
                                            </tr>
                                        </tbody>
									</table>
									<!-- PAGINATION -->
									<div class="row">
										<div class="col-xs-6">
											<div class="dataTables_info" id="example1_info">Showing 1 to 10 of 57 entries</div>
										</div>
										<div class="col-xs-6">
											<div class="dataTables_paginate paging_bootstrap">
												<ul class="pagination">
													<li class="prev disabled"><a href="#">Start</a></li>
													<li class=""><a href="#">&laquo;</a></li>
													<li class="active"><a href="#">1</a></li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#">5</a></li>
													<li class="next"><a href="#">&raquo;</a></li>
													<li class=""><a href="#">End</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
                	</div>
			</section>
		</aside>
		<!-- CONTENT END -->
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="js/datepicker/bootstrap-datepicker.js"
		type="text/javascript"></script>
	<script src="js/AdminLTE/app.js" type="text/javascript"></script>
	<script src="js/AdminLTE/demo.js" type="text/javascript"></script>
	<script src="js/icheck.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var totalItems	= 0;
			
			//iCheck for checkbox and radio inputs
            $('input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            //When unchecking the checkbox
            $("#check-all").on('ifUnchecked', function(event) {
                //Uncheck all checkboxes
                $("input[type='checkbox']").iCheck("uncheck");
            });
            
            //When checking the checkbox
            $("#check-all").on('ifChecked', function(event) {
                //Check all checkboxes
                $("input[type='checkbox']").iCheck("check");
            });

		});
	</script>
</body>
</html>