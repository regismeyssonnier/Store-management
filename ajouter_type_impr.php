<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ajouter Type consommable</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
<script src="site.js" type="text/javascript">
</script>
<script src="prototype.js" type="text/javascript">
</script>
</head>
<body>

	<?php
	
		include('connect.php');
	
		$saisie = true;
		if(isset($_POST['ajout_type_impr']))
		{
			$sql_insert_tp_i = "INSERT INTO TYPE_IMPRIMANTE VALUES(NULL, '" .addslashes($_POST['lib_type_impr']) ."');";
			mysql_query($sql_insert_tp_i);
			$saisie = false;
			
			if($_POST['modif'] == '')
			{
			
	?>
	
			<script type="text/javascript">
				
				new Ajax.Request(
					'select_type_impr.php',
					{
						asynchronous:false,
						method: 'post',
						parameters: {ajax:'ajax'},
						onSuccess: function(http) {
								
							opener.document.getElementById('zone_type_impr').innerHTML = http.responseText;
								
																
						}
						
					}
				);
				
				var sel = opener.document.getElementById('type_impr');
				sel.options[sel.length-1].selected = true;
						
			
			</script>	
	
	<?php
	
			}
			else
			{
			
	?>
	
			<script type="text/javascript">
			
				new Ajax.Request(
					'select_type_impr.php',
					{
						asynchronous:false,
						method: 'post',
						parameters: {ajax:'ajax'},
						onSuccess: function(http) {
								
							opener.document.getElementById('zone_type_impr').innerHTML = http.responseText;
								
																
						}
						
					}
				);
				
				var sel = opener.document.getElementById('type_impr');
				sel.options[sel.length-1].selected = true;
				
				Valider_type_imprimante_fen();
							
			</script>	
	
	<?php
			
			
			}
	
	
			
		}
		
		
		if($saisie)
		{
	
	
	?>

			<form action="ajouter_type_impr.php" method="post" id="form_ajout_type_impr" onsubmit="return Valider_form_ajout_type_impr();">
			<table class="tab_ajout_type_conso">
				<tr>
					<td colspan="2" class="titre_fond_bleu">Ajouter Type imprimante</td>
				</tr>
				<tr>
					<td>Libelle type</td><td><input type="text" name="lib_type_impr" value="" maxlength="75" size="75"/></td>
				</tr>
				<tr>
					<td colspan="2" class="titre_fond_bleu25"><input type="submit" name="ajout_type_impr" value="Ajouter type imprimante" class="bouton_bleu12" /></td>
				</tr>
			</table>
			<input type="hidden" name="modif" value="<?php 
														if(isset($_GET['modif']))
															echo $_GET['modif']; 
														else if(isset($_POST['modif']))
															echo $_POST['modif'];
															
												   ?>" />
			</form>
			
	<?php
	
		}
		else
		{
	
	?>
			<form action="ajouter_type_impr.php" method="post">
			<table class="tab_ajout_type_conso">
					<tr>
						<td class="titre_fond_bleu">Ajouter Type imprimante</td>
					</tr>
					<tr>
						<td>Le nouveau type d'imprimante a bien &eacute;t&eacute; ajout&eacute;</td>
					</tr>
					<tr>
						<td class="titre_fond_bleu25"><input type="submit" name="retour" value="Retour" class="bouton_bleu12" /></td>
					</tr>
			</table>
			<input type="hidden" name="modif" value="<?php echo $_POST['modif']; ?>" />
			</form>
	
	
	<?php
	
		}
	
	?>

</body>
</html>