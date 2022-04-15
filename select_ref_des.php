<?php

	if(isset($_POST['ajax']))
	{
	
		include('connect.php');

		$sql_impr = "SELECT * FROM IMPRIMANTE AS I, TYPE_IMPRIMANTE AS T WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR AND I.ID_TYPE_IMPR = " .$_POST['id_type'] .";";
		$res_i = mysql_query($sql_impr);

		echo '<select name="impr" id="impr" class="select_refdes">';
		while($impr = mysql_fetch_array($res_i))
		{
			echo '<option value="' .$impr['REF_IMPRIMANTE'] .'">' .$impr['REF_IMPRIMANTE'] ." - " .$impr['DESIGNATION_IMPRIMANTE'] .'</option>';

		}
	
	}
	else
	{

		$sql_impr = "SELECT * FROM IMPRIMANTE AS I, TYPE_IMPRIMANTE AS T WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR AND I.ID_TYPE_IMPR = " .$id_type .";";
		$res_i = mysql_query($sql_impr);

		echo '<select name="impr" id="impr" class="select_refdes">';
		while($impr = mysql_fetch_array($res_i))
		{
			echo '<option value="' .$impr['REF_IMPRIMANTE'] .'">' .$impr['REF_IMPRIMANTE'] ." - " .$impr['DESIGNATION_IMPRIMANTE'] .'</option>';

		}
		
	}

	



?>