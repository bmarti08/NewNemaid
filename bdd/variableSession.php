<?php

//Attribution des variables de session
$id=(isset($_SESSION['idCompte']))?(int) $_SESSION['idCompte']:0;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:0;
$Mail=(isset($_SESSION['Mail']))?$_SESSION['Mail']:'';

//On inclue les 2 pages restantes
include("functions.php");
include("constants.php");
?>