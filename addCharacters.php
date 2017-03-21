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

        <!-------------------------- Container --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Add a new Character </h1>    
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#424242"> Database Management </FONT> / <FONT color="#424242"> Characters </FONT> / <a href="findCharacters.php"> Characters view </a> / <FONT color="#BDBDBD"> Add a new Character </FONT>
						</li>
						<li class="active"></li>
					</ol>	
                </div>
            </div>
			<br/>	
		
			
        <!-- /.row -->
        <br/>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-10">
				<div class="panel panel-default text-center">
					<div class="panel-body">
						<!-- Bouton execution modal -->
						<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#quantC">
						  <span class="glyphicon glyphicon-plus"></span>
						  Add a new quantitative character
						</button>
						<!-- --------------- -->
						<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#qualiC">
						  <span class="glyphicon glyphicon-plus"></span>
						  Add a new qualitative character
						</button>
					</div>
				</div>
			</div>
		</div>		
    <!-- ----------------------------------------------------------------------------------------------------------- -->
		<?php
			//recherche des genus qui sont déjà rattaché à une species 
			//Vérification de la présence
			$query=$bdd->prepare('SELECT `Genus_Name` FROM `genus` where Genus_Name in (SELECT Genus_Name FROM species)');
			$query->execute();
		?>
		<!-- Modal quantitative -->
		<div class="modal fade" id="quantC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Add a new quantitative character</h4>
					</div>
					<div class="modal-body">
						
						<div class="panel panel-warning">
							<div class="panel-heading">
								<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
								<br/>
								<h4>WARNING : Be sure to fill in all fields followed by a <span style="color:red">*</span> !</h4>
							</div>
						</div>
						
							<div id="signupbox2" class="panel panel-default">
								<div class="panel-body">
									<form method="POST" action="modal/addquantC.php" enctype="multipart/form-data">
									
									<fieldset>
										<!-- Select Basic -->
										<div class="form-group">
										  <label for="Genus_Name" class="col-md-5 control-label">Genus Name <span style="color:red">*</span></label>
										  <div class="col-md-7">
											<input id="Genus_Name" list="genusName" class="form-control" placeholder="Select a name" name="Genus_Name">
											<datalist id="genusName">
											<?php
												while($result=$query->fetch()){	
												  echo'<option value="'.$result['Genus_Name'].'">'.$result['Genus_Name'].'</option>';
												}
												$query->CloseCursor();
											?>
											</datalist>
										  </div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Character_Name" class="col-md-5 control-label">Character Name <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Character_Name" type="text" class="form-control" name="Character_Name" placeholder="" required="true">
											</div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Explaination" class="col-md-5 control-label">Explaination <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Explaination" type="text" class="form-control" name="Explaination" placeholder="" required="true">
											</div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Entitled_Character" class="col-md-5 control-label">Entitled Character <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Entitled_Character" type="text" class="form-control" name="Entitled_Character" placeholder="" required="true">
											</div>
										</div>
										<br/>	
										<div class="form-group">
											<label for="Weight" class="col-md-5 control-label">Weight <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Weight" type="number" min="0" class="form-control" name="Weight" placeholder="" required="true">
											</div>
										</div>
										<br/>	
										<div class="form-group">
											<label for="Correction_Factor" class="col-md-5 control-label">Correction Factor <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Correction_Factor" type="number" min="0" class="form-control" name="Correction_Factor" placeholder="" required="true">
											</div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Min_Range" class="col-md-5 control-label">Min Range <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Min_Range" type="number" min="0" class="form-control" name="Min_Range" placeholder="" required="true">
											</div>
										</div>
										<br/>	
										<div class="form-group">
											<label for="Max_Range" class="col-md-5 control-label">Max Range <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Max_Range" type="number" min="0" class="form-control" name="Max_Range" placeholder="" required="true">
											</div>
										</div>
										<br/>	
										<div class="form-group">
											<label for="Unit" class="col-md-5 control-label">Unit <span style="color:red">*</span></label>
											<div class="col-md-7">
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
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
	<!-- ----------------------------------------------------------------------------------------------------------- -->
	
	
		<!-- Modal qualitative -->
		<div class="modal fade" id="qualiC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Add a new qualitative character</h4>
					</div>
					<div class="modal-body">
						
						<div class="panel panel-warning">
							<div class="panel-heading">
								<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
								<br/>
								<h4>WARNING : Be sure to fill in all fields followed by a <span style="color:red">*</span> !</h4>
							</div>
						</div>
						
							<div id="signupbox2" class="panel panel-default">
								<div class="panel-body">
									<form method="POST" action="modal/addqualiC.php" enctype="multipart/form-data">
									
									<fieldset>
										<!-- Select Basic -->
										<div class="form-group">
										  <label for="Genus_Name" class="col-md-5 control-label">Genus Name <span style="color:red">*</span></label>
										  <div class="col-md-7">
											<input id="Genus_Name" list="genusName" class="form-control" placeholder="Select a name" name="Genus_Name">
											<datalist id="genusName">
											<?php
												while($result=$query->fetch()){	
												  echo'<option value="'.$result['Genus_Name'].'">'.$result['Genus_Name'].'</option>';
												}
												$query->CloseCursor();
											?>
											</datalist>
										  </div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Character_Name" class="col-md-5 control-label">Character Name <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Character_Name" type="text" class="form-control" name="Character_Name" placeholder="" required="true">
											</div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Explaination" class="col-md-5 control-label">Explaination <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Explaination" type="text" class="form-control" name="Explaination" placeholder="" required="true">
											</div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Entitled_Character" class="col-md-5 control-label">Entitled Character <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Entitled_Character" type="text" class="form-control" name="Entitled_Character" placeholder="" required="true">
											</div>
										</div>
										<br/>	
										<div class="form-group">
											<label for="Weight" class="col-md-5 control-label">Weight <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Weight" type="number" min="0" class="form-control" name="Weight" placeholder="" required="true">
											</div>
										</div>
										<br/>	
										<div class="form-group">
											<label for="Correction_Factor" class="col-md-5 control-label">Correction Factor <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Correction_Factor" type="number" min="0" class="form-control" name="Correction_Factor" placeholder="" required="true">
											</div>
										</div>
										<br/>
										<div class="form-group">
											<label for="Value_Name" class="col-md-5 control-label">Value Name <span style="color:red">*</span></label>
											<div class="col-md-7">
												<input id="Value_Name" type="text" class="form-control" name="Value_Name" placeholder="" required="true">
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
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<!-- -------------------------------------------------------- -->       


        
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
