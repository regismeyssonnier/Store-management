<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ajouter TVA</title>
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
		if(isset($_POST['ajout_tva']))
		{
			$sql_insert_tva = "INSERT INTO TVA VALUES(NULL, " .$_POST['taux_tva'] .");";
			mysql_query($sql_insert_tva);
			$saisie = false;
			
			if($_POST['ref'] == '')
			{
			
	?>
	
			<script type="text/javascript">
						
				new Ajax.Request(
					'select_tva.php',
					{
						asynchronous:false,
						method: 'post',
						parameters: {ajax:'ajax'},
						onSuccess: function(http) {
								
							opener.document.getElementById('zone_tva').innerHTML = http.responseText;
								
																
						}
						
					}
				);
				
				//selectionne la tva ajouter
				var sel = opener.document.getElementById('tva');
				sel.options[sel.length-1].selected = true;
				
				
			</script>	
	
	<?php
			}
			else
			{
	?>
	
			<script type="text/javascript">
			
				new Ajax.Request(
					'select_tva.php',
					{
						asynchronous:false,
						method: 'post',
						parameters: {ajax:'ajax'},
						onSuccess: function(http) {
								
							opener.document.getElementById('zone_tva').innerHTML = http.responseText;
								
																
						}
						
					}
				);
				
				//selectionne la tva ajouter
				var sel = opener.document.getElementById('tva');
				sel.options[sel.length-1].selected = true;
				
				//enregistre les modifications
				var form = opener.document.getElementById('form_aff_conso');
				
				var param = 'reference=' + form.reference.value + '&designation=' + form.designation.value + '&pu=' + form.pu.value + '&lot=' + form.lot.value +  '&qte_stock=' + form.qte_stock.value + '&seuil_reap=' + form.seuil_reap.value + '&commentaire=' + form.com1.value + form.com2.value + form.com3.value + form.com4.value + form.com5.value + form.com5.value + '&tva=' + form.tva.value + '&type_conso=' + form.type_conso.value + '&conso_ref=' + form.conso_ref.value;
				ajaxLoadContentModifconso('modif_conso.php', opener.document.getElementById('ajax_modif'), param);
					

			</script>	
	
	<?php
			
			
			}
	
			
		}
		
		
		if($saisie)
		{
	
	
	?>

			<form action="ajouter_tva.php" method="post" id="form_ajout_tva" onsubmit="return Valider_form_ajout_tva();">
			<table class="tab_ajout_tva">
				<tr>
					<td colspan="2" class="titre_fond_bleu">Ajouter TVA</td>
				</tr>
				<tr>
					<td>Taux TVA</td><td><input type="text" name="taux_tva" value="" maxlength="10" size="10"/></td>
				</tr>
				<tr>
					<td colspan="2" class="titre_fond_bleu25"><input type="submit" name="ajout_tva" value="Ajouter TVA" class="bouton_bleu12" /></td>
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
			<form action="ajouter_tva.php" method="post">
			<table class="tab_ajout_tva">
					<tr>
						<td class="titre_fond_bleu">Ajouter TVA</td>
					</tr>
					<tr>
						<td>Le nouveau taux de tva a bien &eacute;t&eacute; ajout&eacute;</td>
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