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
	session_start();
	include("../bdd/identifiants.php");
	include("../bdd/variableSession.php");
	?>


<!-- content goes here -->
                <?php	
		
				//var_dump($_GET['ReferencesId']);

				if(isset($_GET['ReferencesId'])){
						$ReferencesId = $_GET['ReferencesId'];
						////recherche pour le tableau
						$query1=$bdd->prepare('SELECT * FROM bibliography inner join `writen_by` using (`Id_Biblio`) 
												inner join author USING (`Id_Author`)
												where Id_Biblio ="'.$ReferencesId.'"');
						$query1->execute();
						///recherche pour récupération des données
						$query=$bdd->prepare('SELECT * FROM `bibliography` WHERE Id_Biblio='.$ReferencesId.'');
						$query->execute();
						$result = $query->fetch();
						
						echo'<h3 class="text-center">'.$result['Title'].'</h3>
						<hr width="50%">';
						
						if($Admin == 1){
							echo'<a href="addAuthorReferences.php?IdRef='.$ReferencesId.'" class="btn btn-primary btn-xs pull-right"><b>+</b> Add another author</a>';
							echo'<a href="addAuthorReferences.php?IdRef='.$ReferencesId.'#AddCharRef" class="btn btn-success btn-xs pull-right"><b>+</b> Add another character</a>';
						} 
					
					echo'<table class="table table-striped table-hover" width="50%">
						<thead>	
							<tr>
								<th class="text-center">Year</th>
								<th class="text-center">Journal</th>
								<th class="text-center">Published in</th>
								<th class="text-center">Author</th>
								<th class="text-center">Rank</th>
							</tr>
						</thead>
						<tbody>';
						while($data=$query1->fetch()){	
									echo'
									
										<tr>
											<td>'.$data['Year'].'</td>
											<td>'.$data['Journal'].'</td>
											<td>'.$data['Published_in'].'</td>
											<td>'.$data['Name_Author'].'</td>
											<td>'.$data['Rank'].'</td>
										</tr>
									';
								}
						echo'</tbody>
						</table>';
						
						echo'
						<hr width="50%">
							<div class="btn-group btn-group-justified" role="group" aria-label="group button">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
								</div>
							</div>';
								$query1->CloseCursor();
								$query->CloseCursor();
					}
					else{
						echo'<h3> ERROR </h3>';
					}
				?>
				
	</body>

</html>
