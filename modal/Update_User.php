<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<META HTTP-EQUIV="Refresh" CONTENT="2;URL=../user.php"> <!-- --Redirection vers une autre page--- -->
	
    <title>NEMAID</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/portfolio-item.css" rel="stylesheet">
	
	<!-- Bootstrap Core CSS -->
    <link href="../css/style.css" rel="stylesheet">
	
	<link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>

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
		include("../bdd/variableSession.php");
		include("../bdd/identifiants.php");
		include("../header_index.php"); 
	?> 

	<div class="container">


<!-- content goes here -->
                <?php	
					//var_dump($_GET['Password']);
					//var_dump($_GET['IdU']);

				if(!empty($_GET['Password']) && !empty($_GET['IdU'])){			
						
						$passw = md5($_GET['Password']);
						$idU = $_GET['IdU'];
						
						$query=$bdd->prepare('UPDATE `usr` SET Password="'.$passw.'" WHERE Id_User ="'.$idU.'"');
						
						$query->execute();

						echo'<center><div class="alert alert-success" role="alert"> Changes made ! </div></center>';
							
						$query->CloseCursor();
					}
					else{
						echo'<center><div class="alert alert-danger" role="alert"> ERROR </div></center>';
				}
				?>
				

		</div>
	</body>

</html>