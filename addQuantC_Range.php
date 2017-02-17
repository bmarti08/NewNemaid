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
                    <h1 class="page-header"> Add a new character </h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> Characters </FONT> / <a href="findCharacters.php"> Find a character </a> / <FONT color="#BDBDBD"> Add a new Quantitative Value for the character " <u><i><?php echo $result['Character_Name'] ?></i></u> " </FONT>
						</li>
						<li class="active"></li>
					</ol>	
                </div>
            </div>
			<br/>	
		
			
	<?php
		
		if (!isset($_POST['Min_Range'])) //On est dans la page de formulaire
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
						<form method="POST" action="addQuantC_Range.php" enctype="multipart/form-data">
						
						<fieldset>
							<div class="form-group">
								<label for="Min_Range" class="col-md-3 control-label">Min Range <span style="color:red">*</span></label>
								<div class="col-md-9">
									<input id="Min_Range" type="number" min="0" class="form-control" name="Min_Range" placeholder="" required="true">
								</div>
							</div>
							<br/>	
							<div class="form-group">
								<label for="Max_Range" class="col-md-3 control-label">Max Range <span style="color:red">*</span></label>
								<div class="col-md-9">
									<input id="Max_Range" type="number" min="0" class="form-control" name="Max_Range" placeholder="" required="true">
								</div>
							</div>
							<br/>	
							<div class="form-group">
								<label for="Unit" class="col-md-3 control-label">Unit <span style="color:red">*</span></label>
								<div class="col-md-9">
									<input id="Unit" type="text" class="form-control" name="Unit" placeholder="" required="true">
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
