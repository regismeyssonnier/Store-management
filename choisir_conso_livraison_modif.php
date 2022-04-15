<?php

	session_start();
	header('Content-Type: text/html; charset=ISO-8859-1');

?>
<div>
<table class="choisir_type">
	
	<tr>
		<td class="cell_lib_ed">N° commande</td>
		<td class="cell_text_ed" >
		<?php
			
			include('connect.php');
			echo $_GET['num_com'];
			$num_com = $_GET['num_com'];
		
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