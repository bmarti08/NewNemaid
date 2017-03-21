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
		<?php
			$query=$bdd->prepare('SELECT * FROM `bibliography` WHERE Id_Biblio='.$_GET['IdRef'].'');
			$query->execute();
			$result = $query->fetch();
		?>
        <!-------------------------- Container : Author References --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a new author for "<u><i><?php echo $result['Title'] ?></i></u>"</h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> References </FONT> / <a href="findReferences.php"> References view </a> / <FONT color="#BDBDBD"> Add a new author for "<u><i><?php echo $result['Title'] ?></i></u>" </FONT>
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
							<form method="POST" action="addAuthorReferences.php?IdRef='.$_GET['IdRef'].'" enctype="multipart/form-data">
							
							<fieldset>
								<br/>
								<!-- Select Basic -->
								<div class="form-group">
								  <label for="Name_Author" class="col-md-3 control-label">Author Name <span style="color:red">*</span></label>
								  <div class="col-md-9">
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
									<label for="Rank" class="col-md-3 control-label">Rank <span style="color:red">*</span></label>
									<div class="col-md-9">
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
			if (!empty($_POST['Name_Author'])) 
			{
				$idRef = $_GET['IdRef'];
				$NameAuthor=$_POST['Name_Author'];
				$Rank=$_POST['Rank'];

				//var_dump($idRef);
				//var_dump($NameAuthor);
				//var_dump($Rank);
				
				$i=0;
				
				//initialisation
				$erreur1 = NULL;
				
				//recherche id de l'auteur sélectionné
				   $queryIdAuthor=$bdd->prepare('SELECT * FROM `author` WHERE Name_Author="'.$NameAuthor.'"');
				   $queryIdAuthor->execute();
				   $result = $queryIdAuthor->fetch();
						$IdAuthor = $result['Id_Author'];
					
					//var_dump($IdAuthor);
				
				//Vérification de la présence
				$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM writen_by WHERE Id_Author =:IdAuthor and Id_Biblio=:IdBiblio');
				$query->bindValue(':IdAuthor',$IdAuthor, PDO::PARAM_INT);
				$query->bindValue(':IdBiblio',$idRef, PDO::PARAM_INT);
				$query->execute();
				$refAuthor_free=($query->fetchColumn()==0)?1:0;
				$query->CloseCursor();
				
				if(!$refAuthor_free)
				{
					$erreur1 = "<center><div class=\"alert alert-danger\" role=\"alert\">Title not available !</div></center>";
					$i++;
				}
				
				//vérification pour l'enregistrement dans la BDD
			   if ($i==0)
			   {			   				
				   //ajout du lien entre auteur et bibliography => table write_by
				   $queryAjoutRef=$bdd->prepare('INSERT INTO `writen_by` (`Id_Author`, `Id_Biblio`, `Rank`) 
														VALUES (:IdAuthor, :IdBiblio, :Rank)');
					$queryAjoutRef->bindValue(':IdAuthor',$IdAuthor, PDO::PARAM_INT);
					$queryAjoutRef->bindValue(':IdBiblio',$idRef, PDO::PARAM_INT);
					$queryAjoutRef->bindValue(':Rank', $Rank, PDO::PARAM_INT);
					$queryAjoutRef->execute();
				   
							
					echo'<center><div class="alert alert-success" role="alert">The new Author reference is adding !</div></center>';
					echo'<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addAuthorReferences.php?IdRef='.$_GET['IdRef'].'">';   
			   }
			   else{
				   echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
						echo'<h1 style="color:red">ERROR</h1>';
					echo'</span>';
					echo'<br/>
					<META HTTP-EQUIV="Refresh" CONTENT="2;URL=addAuthorReferences.php?IdRef='.$_GET['IdRef'].'">'; 
					echo $erreur1;
			   }
			}
			else{
				msg_addAR_WARNING(MSG_CO_empty);
			}
		}
		?>
		
	</div>
</div>								 	
        <!-------------------------- /Container --------------------------------->
		
		
		<!-------------------------- Container : Add character reference --------------------------------->
	<!-- Page Content -->
    <div class="container" id="AddCharRef">  
		<br/><br/>
		<hr>
		<?php
			$query2=$bdd->prepare('SELECT * FROM species_description speD INNER JOIN bibliography b on b.Id_Biblio = speD.Id_Bibliography 
									WHERE speD.Id_Bibliography ='.$_GET['IdRef'].'');
			$query2->execute();
			$result2 = $query2->fetch();
		?>
		<!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a new character for "<u><i><?php echo $result2['Title'] ?></i></u>" on "<i><?php echo $result2['Id_Species'] ?></i>"</h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> References </FONT> / <a href="findReferences.php"> Find a reference </a> / <FONT color="#BDBDBD"> Add a new character for "<u><i><?php echo $result2['Title'] ?></i></u>" on "<i><?php echo $result2['Id_Species'] ?></i>" </FONT>
						</li>
						<li class="active"></li>
					</ol>	
                </div>
            </div>
			<br/>	
			
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-offset-1 col-lg-10">
					<div class="panel panel-default text-center">
						<div class="panel-body">
							<!-- Bouton execution modal -->
							<button class="btn btn-info btn-md" data-toggle="modal" data-target="#AddquantRef" id="<?php echo $result2['Id_Species_Description'] ?>">
							  <span class="glyphicon glyphicon-plus"></span>
							  Add a new <b>quantitative</b> character for the reference
							</button>							
							<!-- --------------- -->
							<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#AddqualiRef" id="<?php echo $result2['Id_Species_Description'] ?>">
							  <span class="glyphicon glyphicon-plus"></span>
							  Add a new <b>qualitative</b> character for the reference
							</button>
						</div>
					</div>
				</div>
			</div>	
			
	<!-- -------------------------------------------------------- -->
		<!-- modal quantitative -->
		<div class="modal fade" id="AddquantRef" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel"> Add quantitative character for reference </h3>
				</div>
				<div class="modal-body edit-content">
						   
					

				</div>
			</div>
		  </div>
		</div>   
	<!-- -------------------------------------------------------- -->	
	<!-- -------------------------------------------------------- -->
		<!-- modal qualitative -->
		<div class="modal fade" id="AddqualiRef" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel"> Add qualitative character for reference </h3>
				</div>
				<div class="modal-body edit-content">
						   
					

				</div>
			</div>
		  </div>
		</div>   
	<!-- -------------------------------------------------------- -->
	
		
	</div>
</div>

        
    <?php include("footer.php"); ?> 
    </div>
    <!-- /content -->
	
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<script>	
		$('#AddquantRef').on('show.bs.modal', function(e) {
				
				var $Id_Species_Description = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/AddquantRef.php',
					data: 'Id_Species_Description='+esseyId,
					success: function(data) 
					{
						$(".edit-content").html(data);
					}
				});
				
			})
			
			
		///////////////////////
		
		$('#AddqualiRef').on('show.bs.modal', function(e) {
				
				var $Id_Species_Description = $(this),
					esseyId = e.relatedTarget.id;
				
				$.ajax({
					cache: false,
					type: 'GET',
					url: 'modal/AddqualiRef.php',
					data: 'Id_Species_Description='+esseyId,
					success: function(data) 
					{
						$(".edit-content").html(data);
					}
				});
				
			})
		</script>

</body>

</html>
