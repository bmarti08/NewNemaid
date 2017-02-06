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
	
	<!-- Bootstrap Core CSS -->
    <link href="css/style.css" rel="stylesheet">
	
	<link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php include("header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <!-------------------------- Container --------------------------------->
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sample data entry</h1>  
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a> / <FONT color="#BDBDBD"> Sample Data Entry </FONT>
						</li>
						<li class="active"></li>
					</ol>					
                </div>
            </div>
			<br/>	

            <!-- /.row -->
        <br/>
	
	<!-- ---------------------------TEST 1---------------------- -->
		<div class="col-lg-offset-2 col-lg-8">
			<div class="input-group">
				<span class="input-group-btn">
					<button id="fake-file-button-browse" type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-file"> Search </span>
					</button>
				</span>
				<input type="file" id="files-input-upload" style="display:none">
				<input type="text" id="fake-file-input-name" disabled="disabled" placeholder="File not selected" class="form-control">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" disabled="disabled" id="fake-file-button-upload">
						<span class="glyphicon glyphicon-upload"> Upload </span>
					</button>
				</span>
			</div>
			<script type="text/javascript">
			// Fake file upload
			document.getElementById('fake-file-button-browse').addEventListener('click', function() {
				document.getElementById('files-input-upload').click();
			});

			document.getElementById('files-input-upload').addEventListener('change', function() {
				document.getElementById('fake-file-input-name').value = this.value;
				
				document.getElementById('fake-file-button-upload').removeAttribute('disabled');
			});
			</script>
		</div>        
        <!-------------------------- /TODO --------------------------------->
		<br/><br/><br/>
		<center><b>faire l'enregistrement de la piéce jointe !</b></center>

        
    <?php include("footer.php"); ?> 
    </div>
    <!-- /content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Bootstrap Core JavaScript -->
    <script src="js/upload_file.js"></script>

</body>

</html>
