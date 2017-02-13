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
                    <h1 class="page-header">Add a new species</h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> Species Data </FONT> / <FONT color="#BDBDBD"> Add a new species </FONT>
						</li>
						<li class="active"></li>
					</ol>	
                </div>
            </div>
			<br/>	
			
	<?php
		if (!isset($_POST['Genus_Name'])) //On est dans la page de formulaire
		{
			//recherche des genus qui ne sont pas déjà rattaché à une species 
			//Vérification de la présence
			$query=$bdd->prepare('SELECT `Genus_Name` FROM `genus` where Genus_Name not in (SELECT Genus_Name FROM species)');
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
							<form method="POST" action="addSpecies.php" enctype="multipart/form-data">
							
							<fieldset>
								<div class="form-group">
									<label for="Species_Name" class="col-md-3 control-label">Species Name <span style="color:red">*</span></label>
									<div class="col-md-9">
										<input id="Species_Name" type="text" class="form-control" name="Species_Name" placeholder="Enter a name" required="true">
									</div>
								</div>
								<br/>
								<!-- datalist Basic -->
								<div class="form-group">
								  <label for="Genus_Name" class="col-md-3 control-label">Genus Name <span style="color:red">*</span></label>
								  <div class="col-md-9">
									<input id="Genus_Name" list="genName" class="form-control" placeholder="Enter a name" name="Genus_Name">
									<datalist id="genName">';
										while($result=$query->fetch()){	
										  echo'<option value="'.$result['Genus_Name'].'">'.$result['Genus_Name'].'</option>';
										}
										$query->CloseCursor();
									echo'
									</datalist>
								  </div>
								</div>
								
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
			$Speciesname=$_POST['Species_Name'];
			$Genusname=$_POST['Genus_Name'];
			$i=0;
			
			//initialisation
			$mail_erreur1 = NULL;
			$mail_erreur2 = NULL;
			$pswd_erreur = NULL;
			
			//Vérification de la présence
			$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM species WHERE Species_Name =:Speciesname');
			$query->bindValue(':Speciesname',$Speciesname, PDO::PARAM_STR);
			$query->execute();
			$nameS_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			
			if(!$nameS_free)
			{
				$mail_erreur1 = "<center><div class=\"alert alert-danger\" role=\"alert\">Name not available !</div></center>";
				$i++;
			}
			
			//vérification pour l'enregistrement dans la BDD
		   if ($i==0)
		   {
			   $query=$bdd->prepare('INSERT INTO `species` (`Species_Name`, `Genus_Name`) VALUES (:Speciesname, :Genusname)');
				$query->bindValue(':Speciesname', $Speciesname, PDO::PARAM_STR);
				$query->bindValue(':Genusname', $Genusname, PDO::PARAM_STR);
				$query->execute();
				//var_dump($Speciesname);
				echo'<center><div class="alert alert-sucess" role="alert">The new species is adding !</div></center>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=findSpecies.php">';
		   }
		   else{
			   echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
					echo'<h1 style="color:red">ERROR</h1>';
				echo'</span>';
				echo'<br/>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addSpecies.php">';
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
