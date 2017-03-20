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
	if(isset($_GET['Id_Species_Description'])){
		
		if (!isset($_POST['Value_Name'])){
			//var_dump($_GET['Id_Species_Description']);
			$Id_Species_Desc=$_GET['Id_Species_Description'];
			
			//var_dump($Id_Species_Desc);
			//////////Récupération du species id = species name
			$query=$bdd->prepare('SELECT * FROM `species_description` WHERE Id_Species_Description ="'.$Id_Species_Desc.'"');
			$query->execute();
			$result = $query->fetch();
			
			//var_dump($result['Id_Species']);
			
			////Récupération du genus name en lien avec la species
			$query2=$bdd->prepare('SELECT * FROM `species` WHERE Species_Name ="'.$result['Id_Species'].'"');
			$query2->execute();
			$result2 = $query2->fetch();
			
			//var_dump($result2['Genus_Name']);
			
			///Récupération de tous les characters qualitatifs en lien avec le genus
			$query3=$bdd->prepare('SELECT * FROM characters 
									inner join qualitative_list USING (`Id_Qual_Possible_Value_List`) 
									INNER JOIN`composed_by` using (`Id_Qual_Possible_Value_List`) 
									inner join qualitative_value USING (Value_Name)
									INNER join is_characterized_by USING(Id_character)
									INNER join genus USING(Genus_Name)
									INNER join species USING(Genus_Name)
									where Genus_Name="'.$result2['Genus_Name'].'"
										and Value_Name not in (SELECT Value_Name FROM Has_for_Value)');
				$query3->execute();
			
			echo'<!-- --------------------FORMULAIRE ---------------------------- -->		
				<div class="row">
				   <div class="col-lg-12">	
						<div class="panel panel-warning" id="signupbox1" style="display:none;">
							<div class="panel-heading">
								<center><i class="glyphicon glyphicon-warning-sign" style="font-size:50px;"></i>
								<br/>
								<h4>WARNING : Be sure to fill in all fields followed by a <span style="color:red">*</span> !</h4>
							</div>
						</div>
						
						<div id="signupbox2" class="panel panel-default">
							<div class="panel-body">
								<form method="POST" action="./modal/AddqualiRef.php?Id_Species_Description='.$_GET['Id_Species_Description'].'" enctype="multipart/form-data">
								
								<fieldset>
									<!-- Select Basic -->
									<div class="form-group">
									  <label for="Value_Name" class="col-md-4 control-label">The Value name <span style="color:red">*</span></label>
									  <div class="col-md-8">
										<select id="Value_Name" name="Value_Name" class="form-control">';
											while($result3=$query3->fetch()){	
											  echo'<option value="'.$result3['Value_Name'].'">'.$result3['Value_Name'].'</option>';
											}
											$query3->CloseCursor();
										echo'
										</select>
									  </div>
									</div>
									<br/>
									<div class="form-group">
										<label for="value_proportion" class="col-md-4 control-label">Value proportion <span style="color:red">*</span></label>
										<div class="col-md-8">
											<input id="value_proportion" type="number" min="0" class="form-control" name="value_proportion" placeholder="Enter the value proportion" required="true">
										</div>
									</div>
									<br/><br/>
									
								</fieldset>
								
								<div class="col-sm-12 controls">
									<input type="submit" value="Submit" class="btn btn-primary"/></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>';
		}else{
			if (!empty($_POST['Value_Name'])) 
			{
				//////////////variables
				$ValueName=$_POST['Value_Name'];
				$valueproportion=$_POST['value_proportion'];
				$Id_Species_Desc=$_GET['Id_Species_Description'];
				
				var_dump($ValueName);
				var_dump($Id_Species_Desc);
				var_dump($valueproportion);
		
				////Insert dans la table => has_for_value
				$query=$bdd->prepare('INSERT INTO `has_for_value` (`Value_Name`, `Id_Species_Description`, `value_proportion`) 
											VALUES (:Value_Name, :Id_Species_Description, :value_proportion)');
				$query->bindValue(':Value_Name', $ValueName, PDO::PARAM_STR);
				$query->bindValue(':Id_Species_Description', $Id_Species_Desc, PDO::PARAM_INT);
				$query->bindValue(':value_proportion', $valueproportion, PDO::PARAM_INT);
				$query->execute();
				
				echo'<center><div class="alert alert-success" role="alert">The qualitative character is adding for the reference!</div></center>';
				echo'<META HTTP-EQUIV="Refresh" CONTENT="2;URL=../findReferences.php">';  
				
			}
		
		}

	}
	else{
		echo'<h3> ERROR </h3>';
	}
	?>
				
	</body>

</html>
