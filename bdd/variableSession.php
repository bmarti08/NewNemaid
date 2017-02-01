<?php

//Attribution des variables de session
$id=(isset($_SESSION['Id_User']))?(int) $_SESSION['Id_User']:0;
$mail=(isset($_SESSION['e_mail']))?$_SESSION['e_mail']:'';
$First_name=(isset($_SESSION['First_name']))?$_SESSION['First_name']:'';
$Last_name =(isset($_SESSION['Last_name']))?$_SESSION['Last_name']:'';
$Country =(isset($_SESSION['Country']))?$_SESSION['Country']:'';
$City =(isset($_SESSION['City']))?$_SESSION['City']:'';
$Institution =(isset($_SESSION['Institution']))?$_SESSION['Institution']:'';
$Admin =(isset($_SESSION['Admin']))?(bool) $_SESSION['Admin']:0;

//On inclue les 2 pages restantes
include("functions.php");
include("constants.php");
?>