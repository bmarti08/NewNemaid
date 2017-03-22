<?php
try
{
	// On se connecte à MySQL sur l'hébergeur du site NEMAID
	$bdd = new PDO('mysql:host=91.216.107.161;dbname=genis9685;charset=utf8', 'genis9685', '666732');
	
	// On se connecte à MySQL en local
	//$bdd = new PDO('mysql:host=localhost;dbname=nemaid;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer
?>