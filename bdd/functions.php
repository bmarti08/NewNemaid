<?php
//////////////////
/// Fonction des messages d'erreur prédéfinis !
/////////////////////////

//////////ERROR
function erreur($err='')
{
   $mess=($err!='')? $err:'An unknown error occured';
   exit('<p>'.$mess.'</p>
   <p>Click <a href="../index.php">here</a> to return to the home page</p>
		<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./index.php">');
}

function erreur2($err='')
{
   $mess=($err!='')? $err:'An unknown error occured';
   exit('<p>'.$mess.'</p>
   <p>Click <a href="./index.php">here</a> to return to the home page</p>
		<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./index.php">');
}

function msg_connexion_ERROR($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-danger" role="alert">'.$mess.'
			<p>Click <a href="./connexion.php">here</a> to return to the login page</p></div></center>
			<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./connexion.php">');
}

////WARNING
function msg_connexion_WARNING($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert"> '.$mess.'
						<p>Click <a href="./connexion.php">here</a> to return to the login page</p></div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./connexion.php">');
}

function msg_addQ_WARNING($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert"> '.$mess.'
						<p>Click <a href="../findCharacters.php">here</a> to return to the previous page</p></div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=../findCharacters.php">');
}

function msg_addS_WARNING($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert"> '.$mess.'
						<p>Click <a href="./addSpecies.php">here</a> to return to the previous page</p></div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./addSpecies.php">');
}

function msg_addR_WARNING($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert"> '.$mess.'
						<p>Click <a href="./addReferences.php">here</a> to return to the previous page</p></div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./addReferences.php">');
}

function msg_addAR_WARNING($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert"> '.$mess.'
						<p>Click <a href="./addAuthorReferences.php">here</a> to return to the previous page</p></div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./addAuthorReferences.php?IdRef='.$_GET['IdRef'].'">');
}

////////INFO

function msg_connexion_INFO($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-success" role="alert">'.$mess.'
						<p>Click <a href="./index.php">here</a> to access to the home page</p></div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./index.php">');
}

function msg_deconnexion_INFO($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert">'.$mess.'
						<p>Click <a href="./index.php">here</a> to access to the home page</p></div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=./index.php">');
}
?>
