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
	
	<!-- Perso Core CSS -->
    <link href="css/style.css" rel="stylesheet">

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
		include("bdd/variableSession.php");
		include("bdd/identifiants.php");
		include("./header_index.php"); 
	?> 
	
    <!-- Page Content -->
    <div class="container">

        <!-------------------------- Container --------------------------------->
				<br/><br/><br/><br/>
						<?php
							if (!isset($_POST['e_mail'])) //On est dans la page de formulaire
							{
								echo '
								<div class="row">
									<div class="col-lg-offset-3 col-lg-6">
										<div id="loginbox" class="panel panel-default">
											<div class="panel-heading" style="background: #0C9277">
												<h3 class="panel-title text-center"><b>Connexion</b></h3>
												<div style="float:right; font-size: 80%; position: relative; top:-10px;"><a style="color:white;" href="#">Forgot password?</a></div>
											</div>
											<div class="panel-body">
												<form method="post" action="connexion.php">
												<fieldset>
													<div style="margin-bottom: 25px" class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
														<input id="e_mail" type="text" class="form-control" name="e_mail" value="" placeholder="e-mail adress" required="true">                                        
													</div>
													
													<div style="margin-bottom: 25px" class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
														<input id="Password" type="password" class="form-control" name="Password" placeholder="Password" required="true">
													</div>
												</fieldset>
												
												<div class="col-sm-12 controls">
													<input type="submit" value="Connexion" class="btn btn-success"/></p></form>
												</div>
												
												<div class="form-group">
													<div class="col-md-12 control">
														<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
															Don\'t have an account! 
																<a href="#" onClick="$(\'#loginbox\').hide(); $(\'#signupbox1\').show(); $(\'#signupbox2\').show();">
																	Sign Up Here
																</a>
														</div>
													</div>
												</div>    
											</div>
										</div>
								<!-- --------------------FORMULAIRE INSCRIPTION---------------------------- -->		
										<div class="panel panel-warning" id="signupbox1" style="display:none;">
											<div class="panel-heading">
												<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
												<br/>
												<h4>ATTENTION : Veillez à remplir tous les champs suivis d\'un <span style="color:red">*</span> !</h4>
												<p>Certaines informations peuvent vous être demandées lors de l\'oublie du mot de passe ... </p></center>
											</div>
										</div>
										
										<div id="signupbox2" class="panel panel-default" style="display:none;">
											<div class="panel-heading" style="background: #0C9277">
												<h3 class="panel-title text-center"><b>Sign Up</b></h3>
												<div style="float:right; font-size: 85%; position: relative; top:-10px"><a style="color:white;" id="signinlink" href="#" onclick="$(\'#signupbox\').hide(); $(\'#loginbox\').show()">Sign In</a></div>
											</div>
											<div class="panel-body">
												<form method="post" action="register.php" enctype="multipart/form-data">
												
												<fieldset>
													<div class="form-group">
														<label for="e_mail" class="col-md-3 control-label">E-mail <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="e_mail" type="text" class="form-control" name="e_mail" placeholder="E-mail Address" required="true">
														</div>
													</div>
													
													<br/><br/>
													
													<div class="form-group">
														<label for="Password" class="col-md-3 control-label">Password <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="Password" type="password" class="form-control" name="Password" placeholder="Password" required="true">
														</div>
													</div>
													
													<br/><br/>
													
													<div class="form-group">
														<label for="confirm" class="col-md-3 control-label">Confirm password <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="confirm" type="password" class="form-control" name="confirm" placeholder="Password" required="true">
														</div>
													</div>
													
													<br/><br/>
													
													<div class="form-group">
														<label for="First_name" class="col-md-3 control-label">First Name <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="First_name" type="text" class="form-control" name="First_name" placeholder="First Name" required="true">
														</div>
													</div>
													
													<br/><br/>
													
													<div class="form-group">
														<label for="Last_name" class="col-md-3 control-label">Last Name <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="Last_name" type="text" class="form-control" name="Last_name" placeholder="Last Name" required="true">
														</div>
													</div>
													
													<br/><br/>
													
													<div class="form-group">
														<label for="Country" class="col-md-3 control-label">Country <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="Country" type="text" class="form-control" name="Country" placeholder="Country" required="true">
														</div>
													</div>
													
													<br/><br/>
													
													<div class="form-group">
														<label for="City" class="col-md-3 control-label">City <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="City" type="text" class="form-control" name="City" placeholder="City" required="true">
														</div>
													</div>
													
													<br/><br/>
													
													<div class="form-group">
														<label for="Institution" class="col-md-3 control-label">Institution <span style="color:red">*</span></label>
														<div class="col-md-9">
															<input id="Institution" type="text" class="form-control" name="Institution" placeholder="Institution" required="true">
														</div>
													</div>
													
													<br/><br/>
												</fieldset>
												
												<div class="col-sm-12 controls">
													<p>Les champs suivis d\'un <span style="color:red">*</span> sont obligatoires</p>
													<input type="submit" value="Submit" class="btn btn-primary"/></p>
													</form>
												</div>
											</div>
										</div>
										
									</div>
								</div>								 	
								';
							}
							else
							{
								$message='';
								if (empty($_POST['e_mail']) || empty($_POST['Password']) ) //Oublie d'un champ
								{
									
									msg_connexion_WARNING(MSG_CO_empty);

								}
								else //On check le mot de passe
								{
									$query=$bdd->prepare('SELECT Id_User, e_mail, First_name, Last_name, Country, City, Institution, Admin, Password FROM usr WHERE e_mail = :mail');
									$query->bindValue(':mail',$_POST['e_mail'], PDO::PARAM_STR);
									$query->execute();
									$data=$query->fetch();
						
									if ($data['Password'] == md5($_POST['Password'])) // Acces OK !
									{
										$_SESSION['Id_User'] = $data['Id_User'];
										$_SESSION['e_mail'] = $data['e_mail'];
										$_SESSION['First_name'] = $data['First_name'];
										$_SESSION['Last_name'] = $data['Last_name'];
										$_SESSION['Country'] = $data['Country'];
										$_SESSION['City'] = $data['City'];
										$_SESSION['Institution'] = $data['Institution'];
										$_SESSION['Admin'] = $data['Admin'];
										
										msg_connexion_INFO(MSG_CO);
										
									}
									else // Acces pas OK !
									{
										
										msg_connexion_ERROR(MSG_CO_ERR);
										
									}
									$query->CloseCursor();
								}

							echo $message;
								
							}
						?>
						
        
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
