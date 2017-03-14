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
		
		if ($id==0) erreur2(ERR_IS_CO);
	?> 

	<div class="container">
		<?php
		if (!empty($_POST['Genus_Name'])) 
		{
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
			$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM characters inner join is_characterized_by USING(Id_Character) 
									WHERE Character_Name = :CharacterName and Genus_Name = :GenusName');
			$query->bindValue(':CharacterName',$CharacterName, PDO::PARAM_STR);
			$query->bindValue(':GenusName',$GenusName, PDO::PARAM_STR);
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
				//var_dump($ValueName);
				
				//requête SQL pour add dans qualitative_value
				$query1=$bdd->prepare('INSERT INTO `qualitative_value` (`Value_Name`)
										VALUES (:Value_Name)');
				$query1->bindValue(':Value_Name', $ValueName, PDO::PARAM_STR);
				$query1->execute();
			
			
				//requête SQL pour add dans qualitative_list
				$query2=$bdd->prepare('INSERT INTO `qualitative_list` (`Id_Qual_Possible_Value_List`)
										VALUES (NULL)');
				$query2->execute();
								
			
				//requête SQL pour retrouver l'id du Id_Qual_Possible_Value_List ajouté
				$queryId_Qual=$bdd->prepare('SELECT MAX(Id_Qual_Possible_Value_List) as maxId_Qual FROM qualitative_list');
			    $queryId_Qual->execute();
			    $result = $queryId_Qual->fetch();
					$IdQual = $result['maxId_Qual'];
					
					//var_dump($IdQual);
				
				//requête SQL pour add dans composed_by
				$query3=$bdd->prepare('INSERT INTO `composed_by` (`Value_Name`, `Id_Qual_Possible_Value_List`)
										VALUES (:Value_Name, :Id_Qual_Possible_Value_List)');
				$query3->bindValue(':Value_Name', $ValueName, PDO::PARAM_STR);
				$query3->bindValue(':Id_Qual_Possible_Value_List', $IdQual, PDO::PARAM_INT);
				$query3->execute();
				
				
				//requête SQL pour add dans character				
				$query=$bdd->prepare('INSERT INTO `characters` (`Id_Character`, `Character_Name`, `Explaination`, `Entitled_Character`, `Weight`, `Correction_Factor`, `Id_Range`, `Id_Qual_Possible_Value_List`) 
											VALUES (NULL, :Character_Name, :Explain, :Entitled_Character, :Weight, :Correction_Factor, NULL, :Id_Qual_Possible_Value_List )');
				$query->bindValue(':Character_Name', $CharacterName, PDO::PARAM_STR);
				$query->bindValue(':Explain', $Explain, PDO::PARAM_STR);
				$query->bindValue(':Entitled_Character', $EntitledCharacter, PDO::PARAM_STR);
				$query->bindValue(':Weight', $Weight, PDO::PARAM_INT);
				$query->bindValue(':Correction_Factor', $CorrectionFactor, PDO::PARAM_INT);
				$query->bindValue(':Id_Qual_Possible_Value_List', $IdQual, PDO::PARAM_INT);
				$query->execute();
				
				//requête SQL pour retrouver l'id du character ajouté
				$queryId_Character=$bdd->prepare('SELECT MAX(Id_Character) as nbMax FROM `characters` WHERE Character_Name="'.$CharacterName.'"');
			    $queryId_Character->execute();
			    $result2 = $queryId_Character->fetch();
					$IdChar = $result2['nbMax'];
					
					//var_dump($IdChar);
				
				//requête SQL pour add dans is_characterized_by
				$query1=$bdd->prepare('INSERT INTO `is_characterized_by` (`Id_Character`, `Genus_Name`)
										VALUES (:IdChar, :Genus_Name)');
				$query1->bindValue(':IdChar', $IdChar, PDO::PARAM_INT);
				$query1->bindValue(':Genus_Name', $GenusName, PDO::PARAM_STR);
				$query1->execute();

				echo'<center><div class="alert alert-success" role="alert">The new qualitative character is adding !</div></center>';
				echo'<META HTTP-EQUIV="Refresh" CONTENT="2;URL=../addQualiC_ValueName.php?IdRef='.$IdChar.'">';  
				
		   }
		   else{
			   echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
					echo'<h1 style="color:red">ERROR</h1>';
				echo'</span>';
				echo'<br/>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=../findCharacters.php">';
				echo $erreur1;
		   } 
		}
		else{
			msg_addQ_WARNING(MSG_CO_empty);
		}

		?>
	</div>
			
	<?php include("../footer.php"); ?> 
    </div>
    <!-- /content -->

</body>

</html>
