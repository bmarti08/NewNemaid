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

    <!--<?php include("header.php"); ?> -->

    <!-- Page Content -->
    <div class="container">

        <!-------------------------- Container --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Select genus
                    </h1>                    
                </div>
            </div>
            <!-- /.row -->
        <br/>
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				-- Choose a Genus --
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a href="#">Helicotylenchus </a></li>
				<li><a href="#">Aphasmatylenchus(In progress)</a></li>
				<li><a href="#">Genus3</a></li>
			</ul>
			<input type="submit" name="SelectedGenus" value="Confirm" />	
		</div>
		
		<br/><br/>	
		<ol class="breadcrumb">
             <li><a href="SelectedGenus.php">Add a new Genus</a>
             </li>
             <li class="active"></li>
         </ol>
        
            <!-- ICI mettre ce qu'on veut -->
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