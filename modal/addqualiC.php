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
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/portfolio-item.css" rel="stylesheet">
	
	<!-- Perso Core CSS -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php 
		//Cette fonction doit être appelée avant tout code html
		session_start();

		//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
		include("../bdd/variableSession.php");
		include("../bdd/identifiants.php");
		include("../header_index.php"); 
	?> 

	<div class="container">
		<?php
		
			//On récupère les variables

			$i=0;
			$GenusName = $_POST['Genus_Name'];
			$CharacterName = $_POST['Character_Name'];
			$Explain = $_POST['Explaination'];
			$EntitledCharacter = $_POST['Entitled_Character'];
			$Weight = $_POST['Weight'];						
			$CorrectionFactor = $_POST['Correction_Factor'];
			$ValueName = $_POST['Value_Name'];
						
			//initialisation
			$erreur1 = NULL;
			
			//Vérification de du character name
			$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM characters WHERE Character_Name =:CharacterName');
			$query->bindValue(':CharacterName',$CharacterName, PDO::PARAM_STR);
			$query->execute();
			$nameC_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			
			if(!$nameC_free)
			{
				$erreur1 = "<center><div class=\"alert alert-danger\" role=\"alert\">Not available !</div></center>";
				$i++;
			}
			
			//vérification pour l'enregistrement dans la BDD
		   if ($i==0)
		   {		
			/*	
				//requête SQL pour add dans qualitative_value
				$query1=$bdd->prepare('INSERT INTO `qualitative_value` (`Value_Name`)
										VALUES (:Value_Name)');
				$query1->bindValue(':Value_Name', $ValueName, PDO::PARAM_INT);
				$query1->execute();
			
			
				//calcul du nombre de ligne dans la table composed_by
				$queryNb_Ligne=$bdd->prepare('SELECT count(Value_Name) as NbLigne FROM `composed_by`');
			    $queryNb_Ligne->execute();
			    $resultNb_Ligne = $queryNb_Ligne->fetch();
					$Nb_Ligne = $resultNb_Ligne['NbLigne'];
				
			//	var_dump($Nb_Ligne);
				
			
				//requête SQL pour retrouver l'id du Id_Qual_Possible_Value_List ajouté
				$queryId_Character=$bdd->prepare('SELECT * FROM `characters` WHERE Character_Name="'.$CharacterName.'"');
			    $queryId_Character->execute();
			    $result2 = $queryId_Character->fetch();
					$IdChar = $result2['Id_Character'];
				
				//requête SQL pour add dans qualitative_list
				$query1=$bdd->prepare('INSERT INTO `in_range` (`Id_Range`, `Min_Range`, `Max_Range`, `Unit`)
										VALUES (NULL, :MinRange, :MaxRange, :Unit)');
				$query1->bindValue(':MinRange', $MinRange, PDO::PARAM_INT);
				$query1->bindValue(':MaxRange', $MaxRange, PDO::PARAM_STR);
				$query1->bindValue(':Unit', $Unit, PDO::PARAM_STR);
				$query1->execute();
				
				//requête SQL pour add dans character				
				$query=$bdd->prepare('INSERT INTO `characters` (`Id_Character`, `Character_Name`, `Explaination`, `Entitled_Character`, `Weight`, `Correction_Factor`, `Id_Range`, `Id_Qual_Possible_Value_List`) 
											VALUES (NULL, :Character_Name, :Explain, :Entitled_Character, :Weight, :Correction_Factor, NULL, :Id_Qual_Possible_Value_List )');
				$query->bindValue(':Character_Name', $CharacterName, PDO::PARAM_STR);
				$query->bindValue(':Explain', $Explain, PDO::PARAM_STR);
				$query->bindValue(':Entitled_Character', $EntitledCharacter, PDO::PARAM_STR);
				$query->bindValue(':Weight', $Weight, PDO::PARAM_INT);
				$query->bindValue(':Correction_Factor', $CorrectionFactor, PDO::PARAM_INT);
				$query->bindValue(':Id_Qual_Possible_Value_List', $Id_QualPossibleValue_List, PDO::PARAM_INT);
				$query->execute();
				
				//requête SQL pour retrouver l'id du character ajouté
				$queryId_Character=$bdd->prepare('SELECT * FROM `characters` WHERE Character_Name="'.$CharacterName.'"');
			    $queryId_Character->execute();
			    $result2 = $queryId_Character->fetch();
					$IdChar = $result2['Id_Character'];
					
					var_dump($IdChar);
				
				//requête SQL pour add dans is_characterized_by
				$query1=$bdd->prepare('INSERT INTO `is_characterized_by` (`Id_Character`, `Genus_Name`)
										VALUES (:IdChar, :Genus_Name)');
				$query1->bindValue(':IdChar', $IdChar, PDO::PARAM_INT);
				$query1->bindValue(':Genus_Name', $GenusName, PDO::PARAM_STR);
				$query1->execute();

				echo'<center><div class="alert alert-sucess" role="alert">The new species is adding !</div></center>';
				echo'<META HTTP-EQUIV="Refresh" CONTENT="2;URL=findCharacters.php">';  
				*/
		   }
		   else{
			   echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
					echo'<h1 style="color:red">ERROR</h1>';
				echo'</span>';
				echo'<br/>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=../findCharacters.php">';
				echo $erreur1;
		   } 
		

		?>
	</div>
			
	<?php include("../footer.php"); ?> 
    </div>
    <!-- /content -->

</body>

</html>
