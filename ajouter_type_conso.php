<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ajouter Type consommable</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
<script src="site.js" type="text/javascript">
</script>
<script src="ajax.js" type="text/javascript">
</script>
<script src="prototype.js" type="text/javascript">
</script>
</head>
<body>

	<?php
	
		include('connect.php');
	
		$saisie = true;
		if(isset($_POST['ajout_type_conso']))
		{
			$sql_insert_tp_c = "INSERT INTO TYPE_CONSO VALUES(NULL, '" .addslashes($_POST['lib_type_conso']) ."');";
			mysql_query($sql_insert_tp_c);
			$saisie = false;
			
			
			if($_POST['ref'] == '')
			{
			
	?>
	
			<script type="text/javascript">
			
				new Ajax.Request(
					'select_type_conso.php',
					{
						asynchronous:false,
						method: 'post',
						parameters: {ajax:'ajax'},
						onSuccess: function(http) {
								
							opener.document.getElementById('zone_type_conso').innerHTML = http.responseText;
								
																
						}
						
					}
				);
				
				var sel = opener.document.getElementById('type_conso');
				sel.options[sel.length-1].selected = true;
			
				//ajaxLoadContent('select_type_conso.php', opener.document.getElementById('zone_type_conso'), 'ajax=ajax');
			
			</script>	
	
	<?php
	
			}
			else
			{
			
	?>
	
			<script type="text/javascript">
				
				new Ajax.Request(
					'select_type_conso.php',
					{
						asynchronous:false,
						method: 'post',
						parameters: {ajax:'ajax'},
						onSuccess: function(http) {
								
							opener.document.getElementById('zone_type_conso').innerHTML = http.responseText;
								
																
						}
						
					}
				);
				
				var sel = opener.document.getElementById('type_conso');
				sel.options[sel.length-1].selected = true;
				
				var form = opener.document.getElementById('form_aff_conso');

				var param = 'reference=' + form.reference.value + '&designation=' + form.designation.value + '&pu=' + form.pu.value + '&lot=' + form.lot.value +  '&qte_stock=' + form.qte_stock.value + '&seuil_reap=' + form.seuil_reap.value + '&commentaire=' + form.com1.value + form.com2.value + form.com3.value + form.com4.value + form.com5.value + form.com5.value + '&tva=' + form.tva.value + '&type_conso=' + form.type_conso.value + '&conso_ref=' + form.conso_ref.value;
				ajaxLoadContentModifconso('modif_conso.php', opener.document.getElementById('ajax_modif'), param);
						
				
							
				//ajaxLoadContent('select_type_conso_modif.php', opener.document.getElementById('zone_type_conso'), 'ajax=ajax&ref=<?php echo $_POST['ref']; ?>');
			
			</script>	
	
	<?php
			
			
			}
	
	
			
		}
		
		
		if($saisie)
		{
	
	
	?>

			<form action="ajouter_type_conso.php" method="post" id="form_ajout_type_conso" onsubmit="return Valider_form_ajout_type_conso();">
			<table class="tab_ajout_type_conso">
				<tr>
					<td colspan="2" class="titre_fond_bleu">Ajouter Type conso</td>
				</tr>
				<tr>
					<td>Libelle type</td><td><input type="text" name="lib_type_conso" value="" maxlength="75" size="75"/></td>
				</tr>
				<tr>
					<td colspan="2" class="titre_fond_bleu25"><input type="submit" name="ajout_type_conso" value="Ajouter type conso" class="bouton_bleu12" /></td>
				</tr>
			</table>
			<input type="hidden" name="ref" value="<?php 
														if(isset($_GET['ref']))
															echo $_GET['ref']; 
														else if(isset($_POST['ref']))
															echo $_POST['ref'];
															
												   ?>" />
			</form>
			
	<?php
	
		}
		else
		{
	
	?>
			<form action="ajouter_type_conso.php" method="post">
			<table class="tab_ajout_type_conso">
					<tr>
						<td class="titre_fond_bleu">Ajouter Type conso</td>
					</tr>
					<tr>
						<td>Le nouveau type de conso a bien &eacute;t&eacute; ajout&eacute;</td>
					</tr>
					<tr>
						<td class="titre_fond_bleu25"><input type="submit" name="retour" value="Retour" class="bouton_bleu12" /></td>
					</tr>
			</table>
			<input type="hidden" name="ref" value="<?php echo $_POST['ref']; ?>" />
			</form>
	
	
	<?php
	
		}
	
	?>

</body>
</html>