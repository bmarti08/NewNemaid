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

	<?php 
	include("../bdd/identifiants.php");
	?>


<!-- content goes here -->
                <?php	
//var_dump($_GET['authorName']);

				if(isset($_GET['authorName'])){
						$authorName = $_GET['authorName'];
						$query=$bdd->prepare('SELECT * FROM bibliography inner join `writen_by` using (`Id_Biblio`) 
													inner join author USING (`Id_Author`)WHERE Name_Author="'.$authorName.'"');
						$query->execute();
						
						echo'<h3 class="text-center">'.$authorName.'</h3>
						<hr width="50%">';
						
					echo'<table class="table table-striped table-hover" width="50%">
						<thead>	
							<tr>
								<th>Title</th>
								<th>Journal</th>
								<th>Year</th>
								<th>Published in</th>
								<th>Rank</th>
							</tr>
						</thead>
						<tbody>';
						while($data=$query->fetch()){	
									echo'
									
										<tr>
											<td>'.$data['Title'].'</td>
											<td>'.$data['Journal'].'</td>
											<td>'.$data['Year'].'</td>
											<td>'.$data['Published_in'].'</td>
											<td>'.$data['Rank'].'</td>
										</tr>
									';
								}
						echo'</tbody>
						</table>';
						
						echo'
						<hr width="50%">
							<div class="btn-group btn-group-justified" role="group" aria-label="group button">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
								</div>
							</div>';
								$query->CloseCursor();
					}
					else{
						echo'<h3> ERROR </h3>';
					}
				?>
				
	</body>

</html>
