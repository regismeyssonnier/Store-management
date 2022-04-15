<?php

	if(isset($_POST['ajax']))
	{
		include('connect.php');
	
	}
	
	$c_tva = '';
	if(isset($_POST['ref']))
	{
		$sql_tva_ref = "SELECT CODE_TVA FROM CONSOMMABLE WHERE REFERENCE = '" .$_POST['ref'] ."';";
		$res_tv = mysql_query($sql_tva_ref);
		$tv = mysql_fetch_array($res_tv);
		$c_tva = $tv['CODE_TVA'];
	}

	$sql_select = "SELECT * FROM TVA;";
	$res_t = mysql_query($sql_select);

	echo '<select name="tva" onchange="Modif_valider_tva();">';
	while($tva = mysql_fetch_array($res_t))
	{
		if(isset($_POST['ref']))
		{
			if($tva['CODE_TVA'] == $c_tva)
			{
				echo '<option value="' .$tva['CODE_TVA'] .'" selected="selected">' .$tva['TAUX_TVA'] .'</option>';
			}
			else
			{
				echo '<option value="' .$tva['CODE_TVA'] .'">' .$tva['TAUX_TVA'] .'</option>';
			}
			
		}
		else
		{
			echo '<option value="' .$tva['CODE_TVA'] .'">' .$tva['TAUX_TVA'] .'</option>';
		}
									
	}
	echo '</select>';








?>