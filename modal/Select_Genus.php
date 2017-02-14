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
//var_dump($_GET['IdU']);

					if(isset($_GET['IdU'])){		
						$idU = $_GET['IdU'];		
						$GName = NULL;						
						echo'
						<table width="50%">		
							<tr>';
								echo '
								<td width="50%">
									<strong>Genus name: </strong>
									<select id="genusName" name="genusName" onchange="save()">
										<option disabled selected value> -- select an option -- </option>';
										$query=$bdd->prepare('SELECT * FROM `genus`'); 
										$query->execute();									
										while($data=$query->fetch()){	
											echo '<option value='.$data['Genus_Name'].'>'.$data['Genus_Name'].'</option>';
										}
										$query->CloseCursor();
							echo '</select>
								</td>													
							</tr>
						</table>
						<hr width="50%">
						<td class="text-center">
							<button data-toggle="modal" data-target="#okModal" id="ok" class="btn btn-primary btn-xs"><span>Ok</span></button>																		
							<button data-toggle="modal" data-target="#cancelModal" id="cancel" class="btn btn-danger btn-xs"><span>Cancel</span></button>
						</td>';	 
					}							
					else{
						echo'<h3> ERROR </h3>';
					}?>
				
	</body>

</html>
	<script>
		function save() {
			document.getElementById("ok").value = document.getElementById("genusName").value;
			alert(document.getElementById("ok").value);
		}

		$('#okModal').on('show.bs.modal', function(e) {				
			var $GenusName = $(this).value,
				esseyId = e.relatedTarget.id;
				
			$.ajax({
				cache: false,
				type: 'GET',
				url: 'Add_Sample.php',
				data: 'GenusName='+esseyId,
				success: function(data) 
				{
					$(".edit-content").html(data);
				}
			});				
		})
		
		$('#cancelModal').on('show.bs.modal', function(e) {							
			$.ajax({
				cache: false,
				type: 'GET',
				url: '../SampleDataEntry.php',
			});				
		})
	</script>