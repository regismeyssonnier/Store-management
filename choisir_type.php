<?php

	header('Content-Type: text/html; charset=ISO-8859-1');

?>
<div>
<table class="choisir_type">
	
	<tr>
		<td class="cell_lib_ed">Type</td>
		<td class="cell_text_ed">
		<?php
		
			include('connect.php');
		
			$sql_tp_c = "SELECT * FROM TYPE_CONSO;";
			$res_t = mysql_query($sql_tp_c);
			
			$id_type = '';
			$prem = true;
			echo '<select id="type_conso" name="type_conso" onchange="Changer_select_conso();">';
			while($tpc = mysql_fetch_array($res_t))
			{
				if($prem)
				{
					$id_type = $tpc['ID_TYPE'];
					$prem = false;
				}
				echo '<option value="' .$tpc['ID_TYPE'] .'">' .$tpc['LIBELLE_TYPE'] .'</option>';
			
			}
			echo '</select>';
		
		?>
		</td>
		
	</tr>
	<tr >
		<td class="cell_lib_ed">Ref + Designation</td>
		<td class="cell_text_ed" align="left" id="zone_conso">
		<?php
		
			include('select_ref_des_conso.php');
		
		?>
		</td>
		
	</tr>
</table>
</div>