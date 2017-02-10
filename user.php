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

			
	<?php
		if (!isset($_POST['Password']))
				{
	?>
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
											<button data-toggle="modal" data-target="#squarespaceModal" id="'.$data['Id_User'].'" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</button>
																						
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
		<!-- -------------------------------------------------------- -->
		<!-- edit modal -->
		<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">User Edit</h3>
				</div>
				<div class="modal-body edit-content">
						   
					

				</div>
			</div>
		  </div>
		</div>   
	<!-- -------------------------------------------------------- -->
	<!-- edit modal -->
		<div class="modal fade" id="suppModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div style="background-color:#d9534f;" class="modal-header">
					<button type="button" class="close" data-dismiss="modal" onclick='window.location.reload(false)'><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Delete user</h3>
				</div>
				<div class="modal-body edit-content">
						   
					

				</div>
			</div>
		  </div>
		</div>   
			<?php
				}
				else{
					echo'<p>blblaaaaaaaaaaaaaa</p>';
				}
			?>

				
					
				


	   
    <?php 
	include("footer.php"); 
	?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	

	
	<script>
			$('#squarespaceModal').on('show.bs.modal', function(e) {
				
				var $idU = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/Edit_User.php',
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
					url: 'modal/Supprimer_User.php',
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
