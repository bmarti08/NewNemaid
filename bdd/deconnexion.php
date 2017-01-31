<?php
	session_start();
	session_destroy();

	include("variableSession.php");
	
	echo '<p> id de connexion : '.$id.' </p>';
	echo '<p> mail de connexion : '.$Mail.' </p>';
	echo '<p> level de connexion : '.$lvl.' </p>';
	
	if ($id==0) erreur(ERR_IS_CO);
	else{
		echo '<p>Vous êtes à présent déconnecté <br />
		<p>Cliquez <a href="../index.php">ici</a> pour revenir à la page d\'accueil</p>';
		}
?>
