<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NEMAID</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/portfolio-item.css" rel="stylesheet">
	
	<!-- Bootstrap Core CSS -->
    <link href="css/style.css" rel="stylesheet">
	
	<link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

            <?php 
		//Cette fonction doit être appelé avant tout code html
	session_start();
	
	include("bdd/variableSession.php");
	include("bdd/identifiants.php");
	
	include("header.php"); 

	
	if ($id==0) erreur2(ERR_IS_CO);
	?>

    <!-- Page Content -->
    <div class="container">

        <!-------------------------- Container --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sample data entry</h1>  
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#BDBDBD"> Sample Data Entry </FONT>
						</li>
						<li class="active"></li>
					</ol>					
                </div>
            </div>
			<br/>	

            <!-- /.row -->
        <br/>
	<div class="row">
			<div class="col-lg-offset-2 col-lg-8">
				<div class="panel panel-default">
					<table class="table table-striped table-hover">
						<thead>						
						<button data-toggle="modal" data-target="#addModal" id="$Id_User" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-add"></span> Add new Sample</button>
							<tr>
								<th>Id_Sample</th>
								<th><?php $Id_User ?></th>
								<th>Creation date</th>
								<th>Genus name</th>
								<th>Species name</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
							<?php
								$query=$bdd->prepare('SELECT * FROM `sample` where Id_User=3');  //where Id_User =$Id_User');
									$query->execute();
									
								while($data=$query->fetch()){	
									echo'
									<tr>
										<td>'.$data['Id_Sample'].'</td>
										<td>'.$data['date'].'</td>
										<td>'.$data['Genus_Name'].'</td>
										<td>'.$data['Species_Name'].'</td>										
										<td class="text-center">
											<button data-toggle="modal" data-target="#editModal" id="'.$data['Id_User'].'" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</button>
																						
											<button data-toggle="modal" data-target="#suppModal" id="'.$data['Id_User'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete </button>
										</td>
									</tr>';
								}
								$query->CloseCursor();
							?>						
					</table>
				</div>
			</div>
		</div>
		<!-- add modal -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Adding new Sample</h3>
				</div>
				<div class="modal-body edit-content">
				</div>
			</div>
		  </div>
		</div>   
		<!-- -------------------------------------------------------- -->
		<!-- edit modal -->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Sample Edit</h3>
				</div>
				<div class="modal-body edit-content">
				</div>
			</div>
		  </div>
		</div>   
	<!-- -------------------------------------------------------- -->
	<!-- Supp modal -->
		<div class="modal fade" id="suppModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div style="background-color:#d9534f;" class="modal-header">
					<button type="button" class="close" data-dismiss="modal" onclick='window.location.reload(false)'><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Delete sample</h3>
				</div>
				<div class="modal-body edit-content">
				</div>
			</div>
		  </div>
		</div>   
	<!-- ---------------------------TEST 1---------------------- -->
		<!--<div class="row">
    	<div class="col-lg-offset-2 col-lg-8">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Upload a previously saved sample file</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Register a new sample</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
						--><!-- ---------------------------------tab1default--------------------------------- -->
						<!--	<p class="text-center"> 
								<i class="glyphicon glyphicon-warning-sign" style="font-size:20px;color:#F7BE81;"></i>
								<strong>This file must be a .xml file generated by Nemaid 3.3. </strong>
							</p>
							<div class="input-group">
								<span class="input-group-btn">
									<button id="fake-file-button-browse" type="button" class="btn btn-default">
										<span class="glyphicon glyphicon-file"> Search </span>
									</button>
								</span>
								<input type="file" id="files-input-upload" style="display:none">
								<input type="text" id="fake-file-input-name" disabled="disabled" placeholder="File not selected" class="form-control">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" disabled="disabled" id="fake-file-button-upload">
										<span class="glyphicon glyphicon-upload"> Upload </span>
									</button>
								</span>
							</div>
							<script type="text/javascript">
							// Fake file upload
							document.getElementById('fake-file-button-browse').addEventListener('click', function() {
								document.getElementById('files-input-upload').click();
							});

							document.getElementById('files-input-upload').addEventListener('change', function() {
								document.getElementById('fake-file-input-name').value = this.value;
								
								document.getElementById('fake-file-button-upload').removeAttribute('disabled');
							});
							</script>
						</div>
                        <div class="tab-pane fade" id="tab2default">
						--><!-- ---------------------------------tab2default--------------------------------- -->
						<!--	<h4>Sample information</h4>
							</br>
							<h4>Quantitative characters</h4>
								<p class="text-justify">Enter your sample data in the column "Values". Weights and correction factors are used for the computation of the similarity coefficient. 
								You can change the default values at will or set all weights and/or correction factors if you prefer to use non weighted data.
								</p>
							</br>
							<h4>Qualitative characters</h4>
								<p class="text-justify">For each qualitative character, enter each state separately as the percentage of specimens presenting that state. 
								Percentages must be entered as decimal values, not as percents (e.g. enter 0.57 instead of 57%).
								</p>
						</div>
                    </div>
                </div>
            </div>
        </div>-->

        
    <?php include("footer.php"); ?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Bootstrap Core JavaScript -->
    <script src="js/upload_file.js"></script>

		<script>
			$('#addModal').on('show.bs.modal', function(e) {				
				var $idU = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/Select_Genus.php',
					data: 'IdU='+esseyId,
					success: function(data) 
					{
						$(".edit-content").html(data);
					}
				});				
			})
			
			$('#editModal').on('show.bs.modal', function(e) {				
				var $idU = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/Edit_Sample.php',
					data: 'IdU='+esseyId,
					success: function(data) 
					{
						$(".edit-content").html(data);
					}
				});				
			})
			

			$('#suppModal').on('show.bs.modal', function(e) {				
				var $idU = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/Supp_Sample.php',
					data: 'IdU='+esseyId,
					success: function(data) 
					{
						$(".edit-content").html(data);
					}
				});				
			})
    </script>
	
</body>

</html>
