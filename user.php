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
                    <h1 class="page-header">List of users</h1>  
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#BDBDBD"> Users </FONT>
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
						<a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new user</a>						
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>E-Mail</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
							<?php
								$query=$bdd->prepare('SELECT * FROM `usr` order by First_name ASC ');
									$query->execute();
									
								while($data=$query->fetch()){	
									echo'
									<tr>
										<td>'.$data['First_name'].'</td>
										<td>'.$data['Last_name'].'</td>
										<td>'.$data['e_mail'].'</td>
										<td class="text-center">
											<a data-toggle="modal" data-target="#squarespaceModal" class="btn btn-info btn-xs" href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
											<a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a>
										</td>
									</tr>';
								}
								$query->CloseCursor();
							?>						
					</table>
				</div>
			</div>
		</div>
		<!-- -------------------------------------------------------- -->
        
    <?php 
	include ("modal/Edit_User.php");
	include("footer.php"); 
	?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Bootstrap Core JavaScript -->
    <script src="js/upload_file.js"></script>

</body>

</html>
