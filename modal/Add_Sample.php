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
										<select id="genusName" name="genusName" onchange="save(this)">
											<option disabled selected value> -- select an option -- </option>';
											$query=$bdd->prepare('SELECT * FROM `genus`'); 
											$query->execute();									
											while($data=$query->fetch()){	
												echo '<option value='.$data['Genus_Name'].'>'.$data['Genus_Name'].'</option>';
											}
											$query->CloseCursor();
								echo '</select>
								</td>';								
								//$GName = isset($_POST['genusName']) ? $_POST['genusName'] : NULL;								
					echo'</tr>	
							Le genus est '.$GName.', mais si y\'a rien c\'est cassé									
							<tr>
								<td width="50%">';
									echo '
									<strong>Specie name: </strong>
									<input id="specieName" list="speName" action="Add_Sample.php">
									<datalist id="speName" >';
										$query2=$bdd->prepare('SELECT * FROM `species` WHERE Genus_Name="Helico"');  
										$query2->execute();									
										while($data2=$query2->fetch()){	
											echo '<option value='.$data2['Species_Name'].'/>';
										}
										$query2->CloseCursor();
							echo '</datalist>
								</td>
							</tr>';
							
							$query3=$bdd->prepare('SELECT * FROM `is_characterized_by` WHERE Genus_Name="Helico"'); 
							$query3->execute();									
							while($data3=$query3->fetch())
							{	
								echo'
								<tr><td width="50%"><p>------------------------------------------------------------------------------</p></td></tr>
								<tr>
									<td width="50%">';
										$query4=$bdd->prepare('SELECT * FROM `characters` WHERE Id_Character='.$data3['Id_Character'].''); 
										$query4->execute();									
										while($data4=$query4->fetch())
										{	
											if ($data4['Id_Qual_Possible_Value_List'] == NULL)
											{
												echo'Quantitative character: <B>'.$data4['Character_Name'].'</B>';
												$query5=$bdd->prepare('SELECT * FROM `in_range` WHERE Id_Range='.$data4['Id_Range'].''); 
												$query5->execute();	
												$data5=$query5->fetch();												
												echo'<br/><B>'.$data5['Unit'].'</B> between <B>'.$data5['Min_Range'].'</B> and <B>'.$data5['Max_Range'].'</B>';
												echo'<input id="CharValue"  type="text">';
												$query5->CloseCursor();
											}
											else{
												echo'Qualitative character: <B>'.$data4['Character_Name'].'</B>';
										echo'<FORM>
													<SELECT name="Value" size="1">
														<option disabled selected value> -- select an option -- </option>';
													$query6=$bdd->prepare('SELECT * FROM `composed_by` WHERE Id_Qual_Possible_Value_List ='.$data4['Id_Qual_Possible_Value_List'].'');  
													$query6->execute();									
													while($data6=$query6->fetch()){	
													echo '<option value="'.$data6['Value_Name'].'">'.$data6['Value_Name'].'</option>';		
													}	
													$query6->CloseCursor();
											echo'</SELECT>
												</FORM>';
											}
									echo'<button type="button" class="glyphicon glyphicon-question-sign text-center" onclick="toggle_text(\'spanX\');"/>
											<span id="spanX" style="display:none;">';								
										echo'<br/><B><I>'.$data4['Explaination'].'</I></B>';
									echo'</span>';
										}	
										$query4->CloseCursor();
							echo'</td>
							</tr>';
							}
							$query3->CloseCursor();
							echo'
						</table>
						<hr width="50%">
						<form method="POST" action="SampleDataEntry.php">
						<div id="radioBtn" class="btn-group">
							<a name="Admin" class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="Y" value="1">OK</a>
							<a name="Admin" class="btn btn-primary btn-sm active " data-toggle="happy" data-title="N" value="0">Cancel</a>
						</div>';							
					}							
					else{
						echo'<h3> ERROR </h3>';
					}?>
				
	</body>

</html>
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
		
		function save(form_element){
			var $GName = document.getElementById("genusName").value;
			alert($GName); 
			esseyId = e.relatedTarget.id;		
			$.ajax({
				cache: false,
				type: 'GET',
				url: 'modal/Add_Sample.php',
				data: 'GName='+esseyId,
			});	
		}
	</script>'
	<script>
			$('#radioBtn a').on('click', function(){
				var sel = $(this).data('title');
				var tog = $(this).data('toggle');
				$('#'+tog).prop('value', sel);
				
				$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
				$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
			})
			$({
				url: 'Add_Sample.php',
				data: 'maVariable='+ maVariable				
				}
			});
			
			$('#genusName').change(function(){		
				alert('essai n°1'); 			
				//var $GName = $(this).,
				//	esseyId = e.relatedTarget.id;				
				//$.ajax({
				//	cache: false,
				//	type: 'GET',
				//	url: 'modal/Add_Sample.php',
				//	data: 'GName='+esseyId,					
				//});				
			})
	</script>