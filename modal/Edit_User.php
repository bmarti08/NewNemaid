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
							
							$IdU = $data['Id_User'];
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
							<tr>
								<td width="50%">
									<p><strong>Administrator : </strong></p>
								</td>
								<td width="50%">';
									if ($Adm == 1){
										echo'<p> Yes </p>';
									}
									else {
										echo'<p> False </p>';
									}
								echo'</td>
							</tr>
						</table>
						<hr width="50%">
						<form action="modal/Update_User.php" id="UpdateForm">
								<input type="text" class="form-control hidden" value="'.$IdU.'" id="'.$IdU.'" name="IdU">
								<div class="form-group">
									<label for="Password">Password <span style="color:red">*</span></label>
									<input type="text" class="form-control" id="Password" name="Password" placeholder=\'Enter a new password\' required="true">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Admin</label>
									<br/>
									<div class="btn-group btn-group-justified" role="group" aria-label="group button">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group" role="group">
											<button type="submit" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
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
			
		$(function() {	
			$('#UpdateForm').on('submit', function(e)  {	
					var $this = $(this); // L'objet jQuery du formulaire
	
					
				$.ajax({
					type: 'GET',
					url: $this.attr('action'),
					data: $this.serialize();//recupere les données du formulaire 
				});	
			})
		});
	</script>