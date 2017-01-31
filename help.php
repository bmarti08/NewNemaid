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
                    <h1 class="page-header">Help section
                    </h1>                    
                </div>
            </div>
            <!-- /.row -->
        <br/>
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span1');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		Why do I have to register to use Nemaid ?<br/>
		<span id="span1" style="display:none;">Réponse 1  <br/></span>
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span2');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span><br/>
		</button>
		How do I do a straightforward identification ?<br/>
		<span id="span2" style="display:none;">Réponse 2<br/></span> 
	
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span3');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		Why are several species given as 100% similar to my sample ?<br/>
		<span id="span3" style="display:none;">Réponse 3<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span4');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		What are the default options and how can I change them ?<br/>
		<span id="span4" style="display:none;">Réponse 4<br/></span> 
        
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span5');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		What computation formulae are used in version 3.4 ?<br/>
		<span id="span5" style="display:none;">Réponse 5<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span6');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		What are the correction factors included in the Nemaid formulae ?<br/>
		<span id="span6" style="display:none;">Réponse 6<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span7');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		What are the weights included in the Nemaid formulae ?<br/>
		<span id="span7" style="display:none;">Réponse 7<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span8');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		What are the range included in the Nemaid formulae and why can't I change it ?<br/>
		<span id="span8" style="display:none;">Réponse 8<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span9');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		What is a composite description ?<br/>
		<span id="span9" style="display:none;">Réponse 9<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span10');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		Why are the composite descriptions missing for some species when I select the option "original and composite description" ?<br/>
		<span id="span10" style="display:none;">Réponse 10<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span11');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		What's the meaning of the codes used in the column "Authors" ?<br/>
		<span id="span11" style="display:none;">Réponse 11<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span12');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		Will there be more genera available ?<br/>
		<span id="span12" style="display:none;">Réponse 12<br/></span> 
		
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="toggle_text('span13');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
		How do I report an error in the description database ?<br/>
		<span id="span13" style="display:none;">Réponse 13<br/></span> 
		
		<script type="text/javascript">
			function toggle_text(id) {
				var span = document.getElementById(id);
				if(span.style.display == "none") {
					span.style.display = "inline";
				} 
				else {
					span.style.display = "none";
				}
			}
		</script> <br>
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
