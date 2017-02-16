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

        <!-------------------------- Container --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a new reference</h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> References </FONT> / <FONT color="#BDBDBD"> Add a new reference </FONT>
						</li>
						<li class="active"></li>
					</ol>	
                </div>
            </div>
			<br/>	
			
	<?php
		
		if (!isset($_POST['Name_Author'])) //On est dans la page de formulaire
		{
			//recherche des genus qui ne sont pas déjà rattaché à une species 
			//Vérification de la présence
			$query=$bdd->prepare('SELECT `Name_Author` FROM `author`');
			$query->execute();
			
			
			echo'<!-- --------------------FORMULAIRE ---------------------------- -->		
			<div class="row">
			   <div class="col-lg-offset-3 col-lg-7">	
				<div class="panel panel-warning" id="signupbox1" style="display:none;">
						<div class="panel-heading">
							<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
							<br/>
							<h4>WARNING : Be sure to fill in all fields followed by a <span style="color:red">*</span> !</h4>
						</div>
					</div>
					
					<div id="signupbox2" class="panel panel-default">
						<div class="panel-body">
							<form method="POST" action="addReferences.php" enctype="multipart/form-data">
							
							<fieldset>
								<div class="form-group">
									<label for="Title" class="col-md-4 control-label">Title <span style="color:red">*</span></label>
									<div class="col-md-8">
										<input id="Title" type="text" class="form-control" name="Title" placeholder="Enter the title" required="true">
									</div>
								</div>
								<br/>
								<div class="form-group">
									<label for="Year" class="col-md-4 control-label">Year <span style="color:red">*</span></label>
									<div class="col-md-8">
										<input format="NNNN" minlength="4" maxlength="4" id="Year" type="text" class="form-control" name="Year" placeholder="Enter the Year (YYYY)" required="true">
									</div>
								</div>
								<br/>
								<div class="form-group">
									<label for="Journal" class="col-md-4 control-label">Journal <span style="color:red">*</span></label>
									<div class="col-md-8">
										<input id="Journal" type="text" class="form-control" name="Journal" placeholder="Enter the Journal\'s name" required="true">
									</div>
								</div>
								<br/>
								<div class="form-group">
									<label for="Published_in" class="col-md-4 control-label">Published in <span style="color:red">*</span></label>
									<div class="col-md-8">
										<input format="NNNN" minlength="4" maxlength="4" id="Published_in" type="text" class="form-control" name="Published_in" placeholder="Enter the Year (YYYY)" required="true">
									</div>
								</div>
								<br/>
								<!-- Select Basic -->
								<div class="form-group">
								  <label for="Name_Author" class="col-md-4 control-label">The first Author name <span style="color:red">*</span></label>
								  <div class="col-md-8">
									<input id="Name_Author" list="AutName" class="form-control" placeholder="Select a name" name="Name_Author">
									<datalist id="AutName">';
										while($result=$query->fetch()){	
										  echo'<option value="'.$result['Name_Author'].'">'.$result['Name_Author'].'</option>';
										}
										$query->CloseCursor();
									echo'
									</datalist>
								  </div>
								</div>
								<br/>
								<div class="form-group">
									<label for="Rank" class="col-md-4 control-label">Rank <span style="color:red">*</span></label>
									<div class="col-md-8">
										<input id="Rank" type="number" min="1" class="form-control" name="Rank" placeholder="Select the Rank" required="true">
									</div>
								</div>
								<br/>
								
								<br/><br/>
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
			$Title=$_POST['Title'];
			$Year=$_POST['Year'];
			$Journal=$_POST['Journal'];
			$Published_in=$_POST['Published_in'];
			$NameAuthor=$_POST['Name_Author'];
			$Rank=$_POST['Rank'];

			var_dump($NameAuthor);
			
			$i=0;
			
			//initialisation
			$mail_erreur1 = NULL;
			$mail_erreur2 = NULL;
			$pswd_erreur = NULL;
			
			//Vérification de la présence
			$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM bibliography WHERE Title =:Title');
			$query->bindValue(':Title',$Title, PDO::PARAM_STR);
			$query->execute();
			$Title_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			
			if(!$Title_free)
			{
				$mail_erreur1 = "<center><div class=\"alert alert-danger\" role=\"alert\">Title not available !</div></center>";
				$i++;
			}
			
			//vérification pour l'enregistrement dans la BDD
		   if ($i==0)
		   {			   
			   //ajout des données en lien avec la table bibliography
				$queryAjoutBiblio=$bdd->prepare('INSERT INTO `bibliography` (`Id_Biblio`, `Title`, `Year`, `Journal`, `Published_in`) 
													VALUES (NULL, :Title, :Year, :Journal, :Published_in)');
				$queryAjoutBiblio->bindValue(':Title', $Title, PDO::PARAM_STR);
				$queryAjoutBiblio->bindValue(':Year', $Year, PDO::PARAM_INT);
				$queryAjoutBiblio->bindValue(':Journal', $Journal, PDO::PARAM_STR);
				$queryAjoutBiblio->bindValue(':Published_in', $Published_in, PDO::PARAM_INT);
				$queryAjoutBiblio->execute();
					
				//recherche id des données entrées dans la bibliography
			   $queryIdBiblio=$bdd->prepare('SELECT * FROM `bibliography` WHERE Title="'.$Title.'"');
			   $queryIdBiblio->execute();
			   $result2 = $queryIdBiblio->fetch();
					$IdBiblio = $result2['Id_Biblio'];
					
					//var_dump($IdBiblio);
				
			   //recherche id de l'auteur sélectionné
			   $queryIdAuthor=$bdd->prepare('SELECT * FROM `author` WHERE Name_Author="'.$NameAuthor.'"');
			   $queryIdAuthor->execute();
			   $result = $queryIdAuthor->fetch();
					$IdAuthor = $result['Id_Author'];
				
					//var_dump($IdAuthor);
					
			   //ajout du lien entre auteur et bibliography => table write_by
			   $queryAjoutRef=$bdd->prepare('INSERT INTO `writen_by` (`Id_Author`, `Id_Biblio`, `Rank`) 
													VALUES (:IdAuthor, :IdBiblio, :Rank)');
				$queryAjoutRef->bindValue(':IdAuthor', $IdAuthor, PDO::PARAM_STR);
				$queryAjoutRef->bindValue(':IdBiblio', $IdBiblio, PDO::PARAM_STR);
				$queryAjoutRef->bindValue(':Rank', $Rank, PDO::PARAM_INT);
				$queryAjoutRef->execute();
			   
				
				echo'<center><div class="alert alert-sucess" role="alert">The new species is adding !</div></center>';
				echo'<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addAuthorReferences.php?IdRef='.$IdBiblio.'">';   
		   }
		   else{
			   echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
					echo'<h1 style="color:red">ERROR</h1>';
				echo'</span>';
				echo'<br/>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addReferences.php">';
				echo $mail_erreur1;
		   }
			
		}
		?>
		
	</div>
</div>								 	
						
        
        <!-------------------------- /Container --------------------------------->


        
    <?php include("footer.php"); ?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
