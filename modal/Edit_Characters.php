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
				//var_dump($_GET['characterId']);

				if(isset($_GET['characterId'])){
						$characterId = $_GET['characterId'];
						
						////recherche pour savoir si qualitatif ou quantitatif
						$query=$bdd->prepare('SELECT * FROM `characters` WHERE Id_Character='.$characterId.'');
						$query->execute();
						$result = $query->fetch();
												
						echo'<h3 class="text-center">'.$result['Character_Name'].'</h3>
						<hr width="50%">';
						
						if($Admin == 1){
							if ($result['Id_Range']!=null && $result['Id_Qual_Possible_Value_List']==null){
								echo'
								<a href="addQualiC_ValueName.php?IdRef='.$characterId.'" class="btn btn-primary btn-xs pull-right"><b>+</b> Add another Value Name</a>';
							}
							if ($result['Id_Range']==null && $result['Id_Qual_Possible_Value_List']!=null){
								echo'
								<a href="addQuantC_Range.php?IdRef='.$characterId.'" class="btn btn-primary btn-xs pull-right"><b>+</b> Add another Range</a>';
							}
						} 
						
						///si le Id_Range est non vide et Id_Qual_Possible_Value_List est vide == données quantitatives
						if ($result['Id_Range']!=null && $result['Id_Qual_Possible_Value_List']==null){
							
							////recherche pour affichage dans le tableau
						$query1=$bdd->prepare('SELECT * FROM characters inner join in_range USING (`Id_Range`) inner join is_characterized_by USING(Id_Character)
												where Id_Character ="'.$characterId.'"');
						$query1->execute();
														
							echo'<table class="table table-striped table-hover" width="50%">
								<caption>Quantitatives characters : </caption>
								<thead>	
									<tr>
										<th class="text-center">Genus Name</th>
										<th class="text-center">Min_Range</th>
										<th class="text-center">Max_Range</th>
										<th class="text-center">Unit</th>
									</tr>
								</thead>
								<tbody>';
								while($data=$query1->fetch()){	
											echo'
											
												<tr>
													<td>'.$data['Genus_Name'].'</td>
													<td>'.$data['Min_Range'].'</td>
													<td>'.$data['Max_Range'].'</td>
													<td>'.$data['Unit'].'</td>
												</tr>
											';
										}
								echo'</tbody>
							</table>';
						}
						///si le Id_Range est vide et Id_Qual_Possible_Value_List est non vide == données qualitatives
						if ($result['Id_Range']==null && $result['Id_Qual_Possible_Value_List']!=null){
							
							$query1=$bdd->prepare('SELECT * FROM characters inner join qualitative_list USING (`Id_Qual_Possible_Value_List`) 
												INNER JOIN`composed_by` using (`Id_Qual_Possible_Value_List`) 
												inner join qualitative_value USING (Value_Name)
												where Id_Character ="'.$characterId.'"');
							$query1->execute();
							
							echo'<table class="table table-striped table-hover" width="50%">
								<caption>Qualitatives characters : </caption>
								<thead>	
									<tr>
										<th class="text-center">Value Name</th>
									</tr>
								</thead>
								<tbody>';
								while($data=$query1->fetch()){	
											echo'
											
												<tr>
													<td>'.$data['Value_Name'].'</td>
												</tr>
											';
										}
								echo'</tbody>
							</table>';
						}
					
						///////////////////////////////////
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
