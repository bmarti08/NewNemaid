<?php
	if (isset($_POST['genusselection']))
		{
		$choix = $_POST['genusselection'];
		if ($choix==0)
			{
			header('Location: SelectGenus.php'); 
			}
		elseif ($choix==2)
			{
			header('Location: SampleDataEntry.php?genre=helicotylenchus');
			}
		elseif ($choix==3)
			{
			header('Location: SampleDataEntry.php?genre=Aphasmatylenchus');
			}
		}
?>