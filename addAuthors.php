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
                    <h1 class="page-header">Add a new Author</h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> Authors </FONT> / <FONT color="#BDBDBD"> Add a new author </FONT>
						</li>
						<li class="active"></li>
					</ol>	
                </div>
            </div>
			<br/>	
			
	<?php
		
		if (!isset($_POST['Name_Author'])) //On est dans la page de formulaire
		{
			echo'<!-- --------------------FORMULAIRE INSCRIPTION---------------------------- -->		
			<div class="row">
			   <div class="col-lg-offset-2 col-lg-8">	
				<div class="panel panel-warning" id="signupbox1" style="display:none;">
						<div class="panel-heading">
							<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
							<br/>
							<h4>WARNING : Be sure to fill in all fields followed by a <span style="color:red">*</span> !</h4>
						</div>
					</div>
					
					<div id="signupbox2" class="panel panel-default">
						<div class="panel-body">
							<form method="POST" action="addAuthors.php" enctype="multipart/form-data">
							
							<fieldset>
								<div class="form-group">
									<label for="Name_Author" class="col-md-3 control-label">Name of the Author <span style="color:red">*</span></label>
									<div class="col-md-9">
										<input id="Name_Author" type="text" class="form-control" name="Name_Author" placeholder="Enter a name" required="true">
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
			$Authorname=$_POST['Name_Author'];
			$i=0;
			
			//initialisation
			$mail_erreur1 = NULL;
			$mail_erreur2 = NULL;
			$pswd_erreur = NULL;
			
			//Vérification de la présence
			$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM author WHERE Name_Author =:Authorname');
			$query->bindValue(':Authorname',$Authorname, PDO::PARAM_STR);
			$query->execute();
			$nameG_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			
			if(!$nameG_free)
			{
				$mail_erreur1 = "<center><div class=\"alert alert-danger\" role=\"alert\">Name already present in the databas !</div></center>";
				$i++;
			}
			
			//vérification pour l'enregistrement dans la BDD
		   if ($i==0)
		   {
			   $query=$bdd->prepare('INSERT INTO `author` (`Name_Author`) VALUES (:Authorname)');
				$query->bindValue(':Authorname', $Authorname, PDO::PARAM_STR);
				$query->execute();
				//var_dump($Authorname);
				echo'<center><div class="alert alert-sucess" role="alert">The new author is adding !</div></center>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=findAuthors.php">';
		   }
		   else{
			   echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
					echo'<h1 style="color:red">ERROR</h1>';
				echo'</span>';
				echo'<br/>
				<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addAuthors.php">';
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
