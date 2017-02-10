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
	include("../bdd/identifiants.php");
	?>


<!-- content goes here -->
                <?php	
//var_dump($_GET['IdU']);

					if(isset($_GET['IdU'])){
						$idU = $_GET['IdU'];
						$query=$bdd->prepare('SELECT * FROM `usr` WHERE Id_User='.$idU.'');
						$query->execute();

							$data = $query->fetch();
							
							$Fname = $data['First_name'];
							$Lname = $data['Last_name'];
							$Email = $data['e_mail'];
							$Ctry = $data['Country'];
							$Cty = $data['City'];
							$Inst = $data['Institution'];
							$passwd = $data['Password'];
							$Adm = $data['Admin'];
							
					
						echo'
						<table width="50%">
							<tr>
								<td width="50%">
									<p><strong>First name : </strong></p>
								</td>
								<td width="50%">
									<p>'.$Fname.'</p>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<p><strong>Last name : </strong></p>
								</td>
								<td width="50%">
									<p>'.$Lname.'</p>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<p><strong>E-mail : </strong></p>
								</td>
								<td width="50%">
									<p>'.$Email.'</p>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<p><strong>Country : </strong></p>
								</td>
								<td width="50%">
									<p>'.$Ctry.'</p>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<p><strong>City : </strong></p>
								</td>
								<td width="50%">
									<p>'.$Cty.'</p>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<p><strong>Institution : </strong></p>
								</td>
								<td width="50%">
									<p>'.$Inst.'</p>
								</td>
							</tr>
						</table>
						<hr width="50%">
						<form method="POST" action="user.php">	
								<div class="form-group">
									<label for="exampleInputEmail1">Password</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder=\'Enter a new password\'>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Admin</label>
									<br/>';
									if ($Adm == 1){
										echo'
											<div id="radioBtn" class="btn-group">
												<a name="Admin" class="btn btn-primary btn-sm active" data-toggle="happy" data-title="Y">YES</a>
												<a name="Admin" class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="N" value="0">NO</a>
											</div>';
									}
									else{
										echo'<div id="radioBtn" class="btn-group">
												<a name="Admin" class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="Y" value="1">YES</a>
												<a name="Admin" class="btn btn-primary btn-sm active " data-toggle="happy" data-title="N" value="0">NO</a>
											</div>';
									}
									
								echo'</div>';
								echo'
									<div class="btn-group btn-group-justified" role="group" aria-label="group button">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group" role="group">
											<button type="submit" id="saveImage" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
										</div>
									</div>
								';
						echo'</form>'; 
								$query->CloseCursor();
					}
					else{
						echo'<h3> ERROR </h3>';
					}
				?>
				
	</body>

</html>
	<script>
			$('#radioBtn a').on('click', function(){
				var sel = $(this).data('title');
				var tog = $(this).data('toggle');
				$('#'+tog).prop('value', sel);
				
				$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
				$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
			})
	</script>