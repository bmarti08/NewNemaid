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
						
						/////Requete 2
						$req=$bdd->prepare('SELECT * FROM `bibliography` b inner join species_description spe_desc on b.Id_Biblio = spe_desc.Id_Bibliography
												inner join Species s on s.Species_Name = spe_desc.Id_Species
												where b.Id_Biblio ="'.$ReferencesId.'"');
						$req->execute();
						$res = $req->fetch();
						
						////recherche pour le tableau author
						$query1=$bdd->prepare('SELECT * FROM bibliography inner join `writen_by` using (`Id_Biblio`) 
												inner join author USING (`Id_Author`)
												where Id_Biblio ="'.$ReferencesId.'"');
						$query1->execute();

						////recherche pour le tableau character quantitatif
						$quantQ=$bdd->prepare('SELECT * FROM species_description 
													inner join has_for_quant_value using (`Id_Species_Description`) 
													inner join characters USING(Id_Character)
													WHERE Id_Bibliography = "'.$ReferencesId.'"
													ORDER by Id_Species ASC');
						$quantQ->execute();
						
						////recherche pour le tableau character qualitatif
						$qualiQ=$bdd->prepare('SELECT * FROM species_description 
							inner join has_for_value using (`Id_Species_Description`) 
							inner join qualitative_value USING(Value_Name)  
							INNER JOIN composed_by USING(Value_Name)
							INNER JOIN qualitative_list USING(Id_Qual_Possible_Value_List)
							INNER JOIN characters USING(Id_Qual_Possible_Value_List)
							WHERE Id_Bibliography = "'.$ReferencesId.'"
							ORDER by Id_Species ASC');
						$qualiQ->execute();
						
						
						//////
						echo'<h3 class="text-center">'.$res['Title'].'</h3>
						<hr width="50%">';
						
						///details
						echo'<p class="text-info"> <b> Genera : </b>'.$res['Genus_Name'].'</p>';
						echo'<p class="text-info"> <b> Species : </b>'.$res['Id_Species'].'</p>';
						echo'<p class="text-info"> <b> Year : </b>'.$res['Year'].'</p>';
						echo'<p class="text-info"> <b> Journal : </b>'.$res['Journal'].'</p>';
						echo'<p class="text-info"> <b> Published_in : </b>'.$res['Published_in'].'</p>';
						
						if($Admin == 1){
							echo'<a href="addAuthorReferences.php?IdRef='.$ReferencesId.'" class="btn btn-primary btn-xs pull-right"><b>+</b> Add another author</a>';
						} 
					
						echo'<p class="text-info"> <b> Authors : </b></p>';
						echo'<table class="table table-striped table-hover" width="50%">
							<thead>	
								<tr>
									<th class="text-center">Author</th>
									<th class="text-center">Rank</th>
								</tr>
							</thead>
							<tbody>';
							while($data=$query1->fetch()){	
										echo'
										
											<tr>
												<td>'.$data['Name_Author'].'</td>
												<td>'.$data['Rank'].'</td>
											</tr>
										';
									}
							echo'</tbody>
						</table>';
						
						
						///////////////////
						echo'
						<hr>
						<br/>';
						
						/////////////////////
						
						if($Admin == 1){
							echo'<a href="addAuthorReferences.php?IdRef='.$ReferencesId.'#AddCharRef" class="btn btn-success btn-xs pull-right"><b>+</b> Add another character</a>';
						echo'<br/>';
						} 
						
						if(!empty($quantQ))
						{
							echo'<p class="text-info"> <b> Quantitatives characters : </b></p>';
							echo'<table class="table table-striped table-hover" width="50%">
								<thead>	
									<tr>
										<th class="text-center">Character name</th>
										<th class="text-center">Explanation</th>
										<th class="text-center">Quantitative value</th>
									</tr>
								</thead>
								<tbody>';
								while($quant=$quantQ->fetch()){	
											echo'
											
												<tr>
													<td>'.$quant['Character_Name'].'</td>
													<td>'.$quant['Explaination'].'</td>
													<td>'.$quant['Quantitative_value'].'</td>
												</tr>
											';
										}
								echo'</tbody>
							</table>';
						}
						/////////////////////
						echo'<br/>';
						////////////////////
						if(!empty($qualiQ))
						{
							echo'<p class="text-info"> <b> Qualitatives characters : </b></p>';
							echo'<table class="table table-striped table-hover" width="50%">
								<thead>	
									<tr>
										<th class="text-center">Character name</th>
										<th class="text-center">Explanation</th>
										<th class="text-center">value Name</th>
										<th class="text-center">Value proportion</th>
									</tr>
								</thead>
								<tbody>';
								while($quali=$qualiQ->fetch()){	
											echo'
											
												<tr>
													<td>'.$quali['Character_Name'].'</td>
													<td>'.$quali['Explaination'].'</td>
													<td>'.$quali['Value_Name'].'</td>
													<td>'.$quali['value_proportion'].'</td>
												</tr>
											';
										}
								echo'</tbody>
							</table>';
						}
						
						
						echo'
						<hr width="50%">
							<div class="btn-group btn-group-justified" role="group" aria-label="group button">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
								</div>
							</div>';
								$query1->CloseCursor();
					}
					else{
						echo'<h3> ERROR </h3>';
					}
				?>
				
	</body>

</html>
