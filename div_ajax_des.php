<?php

	include('connect.php');

	$sql_ref = "SELECT * FROM CONSOMMABLE WHERE DESIGNATION LIKE '" .addslashes($_POST['designation']) ."%';";
	$res_r = mysql_query($sql_ref);
	
	if(mysql_num_rows($res_r) > 0)
	{
		echo '{res:true,';
		//Calculer la taille du div
		$sql_ref1 = "SELECT * FROM CONSOMMABLE WHERE DESIGNATION LIKE '" .addslashes($_POST['designation']) ."%';";
		$res_r1 = mysql_query($sql_ref);
		$max_t = 0;
		while($conso1 = mysql_fetch_array($res_r1))
		{
			$t = strlen($conso1['REFERENCE'] ." - " .$conso1['DESIGNATION']);
			if($t > $max_t)
				$max_t = $t;
					
		}
		
		echo 'largeur:' .$max_t .', conso:[';
	
		$i = 1;
		while($conso = mysql_fetch_array($res_r))
		{
			/*$t = strlen($conso['REFERENCE'] ." - " .$conso['DESIGNATION']) * 3;
			echo '<div style="width:' .$max_t .'mm;height:0.7cm;border:1px solid black;text-align:center;cursor:pointer;';
			echo 'font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:bold;" id="' .$i .'" ';
			echo 'onmouseover="' ."Sur_div_ajax('" .$i ."');" .'"' .'onmouseout="' ."Sortie_div_ajax('" .$i ."');" .'"';
			echo 'onclick="' ."Clic_div_ajax('" .$i ."');" .'">';
			echo $conso['REFERENCE'] ." - " .$conso['DESIGNATION'];
			echo '</div>';*/
			
			if($i == 1)
				echo '{ref:"' .$conso['REFERENCE'] .'", des:"' .$conso['DESIGNATION'] .'", i:' .$i .'}';
			else
				echo ',{ref:"' .$conso['REFERENCE'] .'", des:"' .$conso['DESIGNATION'] .'", i:' .$i .'}';
			
			
			$i++;
			
			
			
		}
		
		echo ']}';
		
		
	}
	else
	{
		echo "{res:false}";
	
	}




?>