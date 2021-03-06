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
		//Cette fonction doit être appelé avant tout code html
	session_start();
	
	include("bdd/variableSession.php");
	include("bdd/identifiants.php");
	
	include("header.php"); 

	
	if ($id==0) erreur2(ERR_IS_CO);
	?>

    <!-- Page Content -->
    <div class="container">

        <!-------------------------- Container --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Perform Comparison</h1>  
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#BDBDBD"> Perform Comparison</FONT>
						</li>
						<li class="active"></li>
					</ol>						
                </div>
            </div>
			<br/>				
			
            <!-- /.row -->
		
        
            <!-- ICI mettre ce qu'on veut -->
				<div class="panel panel-warning">
					<div class="panel-heading">
						<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
						<br/>
						<h4>WORK IN PROGRESS !</h4>
					</div>
				</div>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <!-- ------------------------ -->
        
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
