<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'An unknown error occured';
   exit('<p>'.$mess.'</p>
   <p>Click <a href="../index.php">here</a> to return to the home page</p>');
}

function erreur2($err='')
{
   $mess=($err!='')? $err:'An unknown error occured';
   exit('<p>'.$mess.'</p>
   <p>Click <a href="./index.php">here</a> to return to the home page</p>');
}

function msg_connexion_ERROR($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-danger" role="alert">'.$mess.'
			<p>Click <a href="./connexion.php">here</a> to return to the login page</p></div></center>');
}

function msg_connexion_WARNING($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert"> '.$mess.'
						<p>Click <a href="./connexion.php">here</a> to return to the login page</p></div></center>');
}

function msg_connexion_INFO($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-success" role="alert">'.$mess.'
						<p>Click <a href="./index.php">here</a> to access to the home page</p></div></center>');
}

function msg_deconnexion_INFO($msg='')
{
   $mess=($msg!='')? $msg: '';
   exit('<center><div class="alert alert-warning" role="alert">'.$mess.'
						<p>Click <a href="./index.php">here</a> to access to the home page</p></div></center>');
}
?>
