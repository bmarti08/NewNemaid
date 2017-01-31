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
		Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a> 
		pour revenir à la page précédente.<br />';
		}
?>
