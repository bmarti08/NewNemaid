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
		<?php
			$query=$bdd->prepare('SELECT * FROM `characters` WHERE Id_Character='.$_GET['IdRef'].'');
			$query->execute();
			$result = $query->fetch();
		?>
        <!-------------------------- Container --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Add a new Qualitative Value </h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> Characters </FONT> / <a href="findCharacters.php"> Characters view </a> / <FONT color="#BDBDBD"> Add a new Qualitative Value for the character " <u><i><?php echo $result['Character_Name'] ?></i></u> " </FONT>
						</li>
						<li class="active"></li>
					</ol>	
                </div>
            </div>
			<br/>	
		
	<?php		
	if (!isset($_POST['Value_Name'])) //On est dans la page de formulaire
		{
			
		echo'<!-- ----------------------------FORMULAIRE------------------------------------ -->
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8">					
				<div class="panel panel-warning">
					<div class="panel-heading">
						<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
						<br/>
						<h4>WARNING : Be sure to fill in all fields followed by a <span style="color:red">*</span> !</h4>
					</div>
				</div>
		
		
				<div id="signupbox2" class="panel panel-default">
					<div class="panel-body">
						<form method="POST" action="addQualiC_ValueName.php?IdRef='.$_GET['IdRef'].'" enctype="multipart/form-data">
						
						<fieldset>
							<div class="form-group">
								<label for="Value_Name" class="col-md-3 control-label">Value Name <span style="color:red">*</span></label>
								<div class="col-md-9">
									<input id="Value_Name" type="text" class="form-control" name="Value_Name" placeholder="" required="true">
								</div>
							</div>	
						</fieldset>
						
						<div class="col-sm-12 controls">
							<input type="submit" value="Submit" class="btn btn-primary"/></p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>';
		}
		else{
			//On récupère les variables
			$i=0;
			$idRef = $_GET['IdRef'];
			$Value_Name=$_POST['Value_Name'];
						
			//var_dump($idRef);
			//var_dump($Value_Name);
			
			//initialisation
			$erreur1 = NULL;
			
			//Vérification présence déjà de la value dans le character
			$query=$bdd->prepare('SELECT COUNT(Value_Name) AS nbr FROM characters inner join qualitative_list USING (`Id_Qual_Possible_Value_List`) 
									INNER JOIN`composed_by` using (`Id_Qual_Possible_Value_List`) 
									inner join qualitative_value USING (Value_Name)
									where Id_Character =:idRef and Value_Name=:Val_Name');
			$query->bindValue(':idRef',$idRef, PDO::PARAM_INT);
			$query->bindValue(':Val_Name',$Value_Name, PDO::PARAM_STR);
			$query->execute();
			$nameC_free=($query->fetchColumn()==0)?1:0;

			if(!$nameC_free)
			{
				$erreur1 = "<center><div class=\"alert alert-danger\" role=\"alert\">Not available !</div></center>";
				$i++;
			}
			
			//vérification pour l'enregistrement dans la BDD
		   if ($i==0)
		   {	
				//requête SQL pour add dans qualitative_value
				$query1=$bdd->prepare('INSERT INTO `qualitative_value` (`Value_Name`)
										VALUES (:Value_Name)');
				$query1->bindValue(':Value_Name', $Value_Name, PDO::PARAM_STR);
				$query1->execute();
							
				//requête SQL pour retrouver l'id du Id_Qual_Possible_Value_List du character
				$queryId_Qual=$bdd->prepare('SELECT `Id_Qual_Possible_Value_List` FROM `characters` WHERE `Id_Character`= :idchar');
				$queryId_Qual->bindValue(':idchar',$idRef, PDO::PARAM_INT);
			    $queryId_Qual->execute();
					$result_qual = $queryId_Qual->fetch();
				
				//echo $result_qual['Id_Qual_Possible_Value_List'];
				
				//requête SQL pour add dans composed_by
				$query3=$bdd->prepare('INSERT INTO `composed_by` (`Value_Name`, `Id_Qual_Possible_Value_List`)
										VALUES (:Value_Name, :Id_Qual_Possible_Value_List)');
				$query3->bindValue(':Value_Name', $Value_Name, PDO::PARAM_STR);
				$query3->bindValue(':Id_Qual_Possible_Value_List', $result_qual['Id_Qual_Possible_Value_List'], PDO::PARAM_INT);
				$query3->execute();
				
				//FIN
				echo'<center><div class="alert alert-success" role="alert">The new value name is adding !</div></center>';
				echo'<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addQualiC_ValueName.php?IdRef='.$_GET['IdRef'].'">';  
		   }
		   else{
			//affiche message error
				echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
				echo'<h1 style="color:red">ERROR</h1>';
				echo'</span>';
				echo'<br/>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addQualiC_ValueName.php?IdRef='.$_GET['IdRef'].'">';  
				echo $erreur1;
		   }
		}
		?>

        
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
	

</body>

</html>
