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
		
		    <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #0C9277">
                            <h3 class="panel-title text-center">Connexion</h3>
                        </div>
                        <div class="panel-body">
                           <a href="SelectGenus.php">Select Genus</a>
                          <br/><br/>  
                            lien vers boostrap ttt : <a href="http://getbootstrap.com/components/" target="_blank"> clic </a>
                          <br/><br/>
                            lien pour code couleur : <a href="http://htmlcolorcodes.com/fr/" target="_blank"> clic </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
			<br/><br/><br/>
			<div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #0C9277">
							<?php
								echo '<h3 class="panel-title text-center">Connexion</h3>';
								//if ($id!='') erreur(ERR_IS_CO);
							?>
                        </div>
                        <div class="panel-body">
						
						<?php
							if (!isset($_POST['Mail'])) //On est dans la page de formulaire
							{
								echo '<form method="post" action="index.php">
								<fieldset>
								<p>
								<label for="Mail"> Adresse mail :</label><input name="Mail" type="text" id="Mail" /><br />
								<label for="pswd"> Mot de passe :</label><input type="password" name="pswd" id="pswd" />
								</p>
								</fieldset>
								<p><input type="submit" value="Connexion" /></p></form>
																 
								
								';
							}
							else
							{
								$message='';
								if (empty($_POST['Mail']) || empty($_POST['pswd']) ) //Oublie d'un champ
								{
									
									msg_connexion_WARNING(MSG_CO_empty);

								}
								else //On check le mot de passe
								{
									$query=$bdd->prepare('SELECT idCompte, Mail, pswd, level FROM compte inner join type_compte using(level) WHERE Mail = :mail');
									$query->bindValue(':mail',$_POST['Mail'], PDO::PARAM_STR);
									$query->execute();
									$data=$query->fetch();
						
									if ($data['pswd'] == $_POST['pswd']) // Acces OK !
									{
										$_SESSION['Mail'] = $data['Mail'];
										$_SESSION['level'] = $data['level'];
										$_SESSION['idCompte'] = $data['idCompte'];
									
										
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
						
						</div>
                    </div>
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
