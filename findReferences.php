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
	<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/portfolio-item.css" rel="stylesheet">

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
                    <h1 class="page-header">Find a reference</h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> References </FONT> / <FONT color="#BDBDBD"> Find a reference </FONT>
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
			
					<table id="referencesList" class="table table-striped table-hover">
						<thead>
							<?php
								if($Admin == 1){
									echo'
										<a href="addReferences.php" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new reference</a>';
								}
							?>
							<tr>
								<th>Title</th>
								<th>Journal</th>
								<th>Published in</th>
								<th>Author</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=$bdd->prepare('SELECT * FROM bibliography inner join `writen_by` using (`Id_Biblio`) 
															inner join author USING (`Id_Author`)order by Title ASC ');
									$query->execute();
									
								while($data=$query->fetch()){	
									echo'
									<tr>
										<td>'.$data['Title'].'</td>
										<td>'.$data['Journal'].'</td>
										<td>'.$data['Published_in'].'</td>
										<td>'.$data['Name_Author'].'</td>
										<td class="text-center">';
											if($Admin == 0){											
												echo'
													<button data-toggle="modal" data-target="#edit_references" id="'.$data['Id_Biblio'].'" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> View</button>';
											}
											if($Admin == 1){											
												echo'
													<button data-toggle="modal" data-target="#edit_references" id="'.$data['Id_Biblio'].'" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</button>
													<button data-toggle="modal" data-target="#supp_references" id="'.$data['Id_Biblio'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete </button>';
											}
										echo'</td>
									</tr>';
								}
								$query->CloseCursor();
							?>	
						</tbody>
					</table>
				</div>
			</div>
		</div>		
    <!-- -------------------------------------------------------- -->
		<!-- edit modal -->
		<div class="modal fade" id="edit_references" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Reference details </h3>
				</div>
				<div class="modal-body edit-content">
					

				</div>
			</div>
		  </div>
		</div>   
	<!-- -------------------------------------------------------- -->
	<!-- edit modal -->
		<div class="modal fade" id="supp_references" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div style="background-color:#d9534f;" class="modal-header">
					<button type="button" class="close" data-dismiss="modal" onclick='window.location.reload(false)'><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Delete reference</h3>
				</div>
				<div class="modal-body supp-content">
						   
					

				</div>
			</div>
		  </div>
		</div>       


        
    <?php 
	include("footer.php"); 
	?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	
	<script>	
		$('#edit_references').on('show.bs.modal', function(e) {
				
				var $ReferencesId = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/Edit_References.php',
					data: 'ReferencesId='+esseyId,
					success: function(data) 
					{
						$(".edit-content").html(data);
					}
				});
				
			})
			

	////////////////////////////////////////////////////////////////
    $('#supp_references').on('show.bs.modal', function(e) {
				
				var $ReferencesId = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/Supprimer_References.php',
					data: 'ReferencesId='+esseyId,
					success: function(data) 
					{
						$(".supp-content").html(data);
					}
				});
				
			})
	
	
		////////////////////////////////////////////////////////////////
		$(document).ready(function() {
			$('#referencesList').DataTable();
		} );
    </script>

</body>

</html>
