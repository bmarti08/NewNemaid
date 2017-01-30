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
		
		include("bdd/identifiants.php");
		include("bdd/variableSession.php");
		include("./header_index.php"); 
	?> 
	
    <!-- Page Content -->
    <div class="container">

        <!-------------------------- Container --------------------------------->

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #0C9277">
                            <h3 class="panel-title text-center">Connexion</h3>
                        </div>
                        <div class="panel-body">
                           <a href="Page_1.php">Page 1</a>
                          <br/><br/>  
                            lien vers boostrap ttt : <a href="http://getbootstrap.com/components/" target="_blank"> clic </a>
                          <br/><br/>
                            lien pour code couleur : <a href="http://htmlcolorcodes.com/fr/" target="_blank"> clic </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #0C9277">
                            <h3 class="panel-title text-center">Connexion</h3>
                        </div>
                        <div class="panel-body">
							<form action="bdd\connexion.php" method="post">
								Id_Fruit: <input type="text" name="Id_Fruit" value="" />
					 
								NomFruit: <input type="password" name="NomFruit" value="" />
					 
								<input type="submit" name="connexion" value="Connexion" />
							</form>
						</div>
                    </div>
                </div>
            </div>
        
        <!-------------------------- /Container --------------------------------->

        
    <?php include("footer.php"); ?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
