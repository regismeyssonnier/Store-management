<?php

	header('Content-Type: text/html; charset=ISO-8859-1'); 
	include('connect.php');
		
?>


<table class="tab_bleu_575">
	<tr>
		<td class="titre_fond_bleu25" valign="top" colspan="3">
			<?php echo "DIVISION " .$_POST['id_division']; ?>
		</td>
	</tr>
	<tr>
		<td>
		<?php
		
			$sql_da = "SELECT * FROM DIVISION_ARCHIVE WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
			$res_da = mysql_query($sql_da);
			$div_a = mysql_fetch_array($res_da);
			
			$t_d = split("-", $div_a['DATE_ARCHIVE_DIV']);
			$date_arc = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
			
			echo "La division " .$div_a['ID_DIVISION'] ." est la division " .$div_a['NOM_DIVISION'] ." archivée le " .$date_arc .".<br/>";
			if($div_a['ID_DIVISION_PARENT'] != '')
				echo "Cette division était anciennement le " .$div_a['ID_DIVISION_PARENT'] .'<br/>';
				
			$sql_p = "SELECT * FROM DIVISION_ARCHIVE WHERE ID_DIVISION_PARENT = '" .$div_a['ID_DIVISION'] ."';";
			$res_p = mysql_query($sql_p);
			
			if(mysql_num_rows($res_p) > 0)
			{
				$div_p = mysql_fetch_array($res_p);
				
				$t_d = split("-", $div_p['DATE_ARCHIVE_DIV']);
				$date_p = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
			
				echo "Cette division est devenu le " .$div_p['ID_DIVISION'] ." le " .$date_p.'<br/>';
			}
			
			
			$sql_fus = "SELECT * FROM FUSIONNER WHERE ID_DIVISION_FUSION = '" .$_POST['id_division'] ."';";
			$res_f = mysql_query($sql_fus);
			
			if(mysql_num_rows($res_f) > 0)
			{
				$division = mysql_fetch_array($res_f);
				
				$t_d = split("-", $division['DATE_FUSION']);
				$date_fus = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
											
				echo "La division " .$_POST['id_division'] ." est le résultat de la fusion de la division " .$division['ID_DIVISION'] ." et de la division " .$division['ID_DIVISION2'] ." le " .$date_fus ."<br/>";
				
			
			}
		
			$sql_div = "SELECT * FROM FUSIONNER WHERE ID_DIVISION = '" .$_POST['id_division'] ."' OR ID_DIVISION2 = '" .$_POST['id_division'] ."';";
			$res_d = mysql_query($sql_div);
			
			if(mysql_num_rows($res_d) > 0)
			{
				$division = mysql_fetch_array($res_d);
				echo "La division " .$_POST['id_division'] ." a fusionné avec la division ";
				if($division['ID_DIVISION'] != $_POST['id_division'])
					echo $division['ID_DIVISION'];
				else if($division['ID_DIVISION2'] != $_POST['id_division'])
					echo $division['ID_DIVISION2'];
					
				$t_d = split("-", $division['DATE_FUSION']);
				$date_fus = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
					
				echo " pour donner la division " .$division['ID_DIVISION_FUSION'] ." le " .$date_fus ."<br/>";
			
			}
			
			$sql_ser = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
			$res_s = mysql_query($sql_ser);
			
			if(mysql_num_rows($res_s) > 0)
			{
				echo "Cette division posséde les services suivants: <br/>";
				while($service = mysql_fetch_array($res_s))
				{
					echo " - " .$service['ID_SERVICE'] ."<br/>";
				}
				
			}
			
			
		?>
		</td>
	</tr>
	<tr>
		<td class="titre_fond_bleu25" colspan="3">
		</td>
	</tr>
</table>	







