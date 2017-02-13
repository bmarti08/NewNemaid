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

	<div class="container">
		<?php
		
			//On récupère les variables

			$i=0;
			$mail=$_POST['e_mail'];
			$First_name=$_POST['First_name'];
			$Last_name =$_POST['Last_name'];
			$Country =$_POST['Country'];
			$City =$_POST['City'];
			$Institution =$_POST['Institution'];
			$pass = md5($_POST['Password']);
			$confirm = md5($_POST['confirm']);
			
			//initialisation
			$mail_erreur1 = NULL;
			$mail_erreur2 = NULL;
			$pswd_erreur = NULL;
			
			
			//Vérification de l'adresse mail
			$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM usr WHERE e_mail =:mail');
			$query->bindValue(':mail',$mail, PDO::PARAM_STR);
			$query->execute();
			$mail_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			if(!$mail_free)
			{
				$mail_erreur1 = "<center><div class=\"alert alert-danger\" role=\"alert\">There is already an account with this E-mail adress !</div></center>";
				$i++;
			}

			//On vérifie la forme
			if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || empty($mail))
			{
				$mail_erreur2 = "<center><div class=\"alert alert-danger\" role=\"alert\">Your E-mail adress do not have a right format.</div></center>";
				$i++;
			}

			//Vérification du mdp
			if ($pass != $confirm || empty($confirm) || empty($pass))
			{
				$pswd_erreur = "<center><div class=\"alert alert-warning\" role=\"alert\">Your password and your conformation password are different, or are empty</div></center>";
				$i++;
			}
			
			//vérification pour l'enregistrement dans la BDD
		   if ($i==0)
		   {
			echo '<center><div class="alert alert-info" role="alert">';
				echo'<h1><strong>Registration completed</strong></h1>';
				echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['e_mail'])).' You are registered !</p>';
			echo'</div></center>';
				echo'<p>Click <a href="./index.php">here</a> to return to the homepage</p>';
			
				//requête SQL
				$query=$bdd->prepare('INSERT INTO `usr` (`Id_User`, `First_name`, `Last_name`, `e_mail`, `Country`, `City`, `Institution`, `Password`, `Admin`) 
										VALUES (:Id_User, :First_name, :Last_name, :e_mail, :Country, :City, :Institution, :Password, :Admin)');
			$query->bindValue(':Id_User', $id, PDO::PARAM_INT);
			$query->bindValue(':First_name', $First_name, PDO::PARAM_STR);
			$query->bindValue(':Last_name', $Last_name, PDO::PARAM_STR);
			$query->bindValue(':e_mail', $mail, PDO::PARAM_STR);
			$query->bindValue(':Country', $Country, PDO::PARAM_STR);
			$query->bindValue(':City', $City, PDO::PARAM_STR);
			$query->bindValue(':Institution', $Institution, PDO::PARAM_STR);
			$query->bindValue(':Password', $pass, PDO::PARAM_STR);
			$query->bindValue(':Admin', $Admin, PDO::PARAM_INT);
				$query->execute();
				
				
			//Et on définit les variables de sessions
				$_SESSION['e_mail'] = $mail;
				$_SESSION['Id_User'] = $bdd->lastInsertId(); ;
				$_SESSION['Admin'] = 0;
				$query->CloseCursor();
			}
			else
			{
				echo'<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i>';
					echo'<h1 style="color:red">Recording interrupted</h1>';
					echo'<p>There is(are) '.$i.'error(s) during the registration</p>';
				echo'</span>';
				echo'<br/>';				
				echo $mail_erreur1;
				echo $mail_erreur2;
				echo $pswd_erreur;
			   
				echo'<p>Click<a href="./connexion.php">here</a> to restart registration</p>';
			}
		

		?>
	</div>
			
	<?php include("footer.php"); ?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
