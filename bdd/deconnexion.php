<?php
	session_start();
	session_destroy();

	include("variableSession.php");
	
	echo '<p> id de connexion : '.$id.' </p>';
	echo '<p> mail de connexion : '.$Mail.' </p>';
	echo '<p> level de connexion : '.$lvl.' </p>';
	
	msg_deconnexion_INFO(MSG_DECO);
?>
