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
				//var_dump($_GET['SpeciesName']);

				if(isset($_GET['SpeciesName'])){
						$SpeciesName = $_GET['SpeciesName'];
						$query=$bdd->prepare('SELECT * FROM `species` inner join genus using (Genus_Name) 
												inner join is_characterized_by USING (Genus_Name) 
												inner join characters using(Id_Character)
												where Species_Name ="'.$SpeciesName.'"');
						$query->execute();
						/////Requete 2
						$query2=$bdd->prepare('SELECT Genus_Name FROM `species` 
												where Species_Name ="'.$SpeciesName.'"');
						$query2->execute();
						$result = $query2->fetch();
						
						echo'<h3 class="text-center">'.$SpeciesName.'</h3>
						<hr width="50%">';
						
						echo'<p class="text-info"> <b>Genus Name : </b>'.$result['Genus_Name'].'</p>';
						
					echo'<table class="table table-striped table-hover" width="50%">
						<thead>	
							<tr>
								<th class="text-center">Character Name</th>
								<th class="text-center">Explanation</th>
								<th class="text-center">Entitled Character</th>
								<th class="text-center">Correction Factor</th>
								<th class="text-center">Weight</th>
							</tr>
						</thead>
						<tbody>';
						while($data=$query->fetch()){	
									echo'
									
										<tr>
											<td>'.$data['Character_Name'].'</td>
											<td>'.$data['Explaination'].'</td>
											<td>'.$data['Entitled_Character'].'</td>
											<td>'.$data['Weight'].'</td>
											<td>'.$data['Correction_Factor'].'</td>
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
								$query->CloseCursor();
					}
					else{
						echo'<h3> ERROR </h3>';
					}
				?>
				
	</body>

</html>
