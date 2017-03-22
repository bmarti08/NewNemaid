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



	<?php 
	include("../bdd/identifiants.php");
	?>


<!-- content goes here -->
                <?php	
				//var_dump($_GET['characterId']);
				$characterId = $_GET['characterId'];
				
			if(isset($_GET['characterId'])){
				
				//recherches des informations pour le character
				$queryIdChar=$bdd->prepare('SELECT * FROM characters WHERE `Id_Character` ="'.$characterId.'" ');
			    $queryIdChar->execute();
			    $result = $queryIdChar->fetch();
					
				//vérifier que c'est un character quantitatif (Id_Range != NULL && Id_Qual_Possible_Value_List==NULL)
				if ($result['Id_Range']!=NULL && $result['Id_Qual_Possible_Value_List']==NULL){
					//supprimer les données du in_range				
					$query=$bdd->prepare('DELETE FROM `in_range` WHERE `Id_Range` ="'.$result['Id_Range'].'"');
					$query->execute();
				}
				//Sinon supprimer les données de toutes les tables liées aux character qualitatif	
				else{
					//recherche Value_Name dans composed_by
					$queryNameV=$bdd->prepare('SELECT * FROM composed_by WHERE `Id_Qual_Possible_Value_List` ="'.$result['Id_Qual_Possible_Value_List'].'"');
					$queryNameV->execute();
					$result2 = $queryNameV->fetch();
					
					$query=$bdd->prepare('DELETE FROM `composed_by` WHERE `Id_Qual_Possible_Value_List` ="'.$result['Id_Qual_Possible_Value_List'].'"');
					$query->execute();
										
					$query=$bdd->prepare('DELETE FROM `qualitative_list` WHERE `Id_Qual_Possible_Value_List` ="'.$result['Id_Qual_Possible_Value_List'].'"');
					$query->execute();
					
					//Vérification de l'utilisation du Value_Name dans un autre composed_by
					$query=$bdd->prepare('SELECT COUNT(*) AS nbrX FROM composed_by WHERE Value_Name ="'.$result2['Value_Name'].'" 
												and Id_Qual_Possible_Value_List != "'.$result['Id_Qual_Possible_Value_List'].'"');
					$query->execute();
					$result3 = $query->fetch();
					$nbrX = $result3['nbrX'];
					
					if($nbrX == 0)
					{
						$query=$bdd->prepare('DELETE FROM `qualitative_value` WHERE `Value_Name` ="'.$result2['Value_Name'].'"');
						$query->execute();
					}
				}
				
				
				//Supprimer les données du character
				$characterId = $_GET['characterId'];
				$query=$bdd->prepare('DELETE FROM `characters` WHERE `characters`.`Id_Character` ="'.$characterId.'"');
				$query->execute();

						echo'<h3 class="text-center">Deletion completed! </h3>';
							
						$query->CloseCursor();
					}
					else{
						echo'<h3> ERROR </h3>';
					}
				?>


</html>