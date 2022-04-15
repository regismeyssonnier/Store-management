<table class="choisir_impr">
<tr>
	<td class="cell_lib_ed">Type</td>
	<td class="cell_text_ed">
	<?php
	
		include('connect.php');
	
		$sql_impr = "SELECT * FROM IMPRIMANTE ORDER BY DESIGNATION_IMPRIMANTE;";
		$res_i = mysql_query($sql_impr);
		
		$ref_impr = '';
		$prem = true;
		echo '<select name="impr" id="impr" class="select_refdes" onchange="Changer_select_conso_impr();">';
		while($impr = mysql_fetch_array($res_i))
		{
			if($prem)
			{
				$ref_impr = $impr['REF_IMPRIMANTE'];
				$prem = false;
			}
			echo '<option value="' .$impr['REF_IMPRIMANTE'] .'">' .$impr['REF_IMPRIMANTE'] ." - " .$impr['DESIGNATION_IMPRIMANTE'] .'</option>';

		}
	
	?>
	</td>
</tr>
<tr>
	<td class="cell_lib_ed">Ref + Designation</td>
	<td class="cell_text_ed" id="zone_conso_impr">
	<?php
	
		include('select_conso_impr.php');
	
	?>
	</td>
</tr>
</table>