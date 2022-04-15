<?php

	session_start();
	header('Content-Type: text/html; charset=ISO-8859-1');

?>
<div>
<table class="choisir_type">
	
	<tr>
		<td class="cell_lib_ed">N° commande</td>
		<td class="cell_text_ed">
		<?php
		
			include('connect.php');
		
			$sql_c = "SELECT * FROM COMMANDE;";
			$res_c = mysql_query($sql_c);
			
			$num_com = '';
			$prem = true;
			echo '<select id="num_com" name="num_com" onchange="Changer_select_conso_livraison();">';
			while($comm = mysql_fetch_array($res_c))
			{
				
				if(isset($_SESSION['num_com']))
				{
					if($_SESSION['num_com'] == '')
					{
						echo '<option value="' .$comm['NUM_COMMANDE'] .'">' .$comm['NUM_COMMANDE'] .'</option>';
						if($prem)
						{
							$num_com = $comm['NUM_COMMANDE'];
							$prem = false;
						}
					}
					else if($_SESSION['num_com'] == $comm['NUM_COMMANDE'])
					{
						echo '<option value="' .$comm['NUM_COMMANDE'] .'" selected="selected">' .$comm['NUM_COMMANDE'] .'</option>';
						if($prem)
						{
							$num_com = $comm['NUM_COMMANDE'];
							$prem = false;
						}
					}
					else
					{
						echo '<option value="' .$comm['NUM_COMMANDE'] .'">' .$comm['NUM_COMMANDE'] .'</option>';
					}
				}
				else
				{
					if($prem)
					{
						$num_com = $comm['NUM_COMMANDE'];
						$prem = false;
					}
					echo '<option value="' .$comm['NUM_COMMANDE'] .'">' .$comm['NUM_COMMANDE'] .'</option>';
				}
				
			}
			echo '</select>';
		
		?>
		</td>
		
	</tr>
	<tr >
		<td class="cell_lib_ed">Ref + Designation</td>
		<td class="cell_text_ed" align="left" id="zone_conso">
		<?php
		
			include('select_conso_livraison.php');
		
		?>
		</td>
		
	</tr>
</table>
</div>