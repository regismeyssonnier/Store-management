<?php

	include('session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Accueil</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
<script src="site.js" type="text/javascript">
</script>
<script src="prototype.js" type="text/javascript">
</script>
<!--------------------------- EXT JS ------------------------------>
<link rel="stylesheet" type="text/css" href="Ext_JS/resources/css/ext-all.css" />
<script type="text/javascript" src="Ext_JS/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="Ext_JS/ext-all.js"></script>
<!--------------------------- FIN EXT JS ------------------------------>
</head>
<body>

	<table class="tab_principal">
		<tr>
			<td class="cell_entete" colspan="2"></td>
		</tr>	
		<tr>
			<td class="cell_gauche" valign="top">
			<?php
			
				include('menu.php');
			
			?>
			</td>
			<td class="cell_centre" valign="top">
			
				<center>
				<div class="titre_page">
					DEMANDE - Archiver les demandes
				</div>
				</center>
			
				<form action="archiver_demande.php" id="form_archiver">
				<table class="tab_bleu_575">
					<tr>
						<td class="titre_fond_bleu25" valign="top" colspan="2">
							Archiver les demandes traitées
						</td>
					</tr>	
					<tr>
						<td>Période:</td>
						<td>
							Du <input type="text" name="date1" id="date1" value="01/01/<?php echo date('Y'); ?>" size="10" maxlength="10" />
							au <input type="text" name="date2" id="date2" value="<?php echo date('d'); ?>/<?php echo date('m'); ?>/<?php echo date('Y'); ?>" size="10" maxlength="10" />
						</td>
					</tr>
					<tr>
						<td class="titre_fond_bleu25" valign="top" colspan="2">
							<input type="button" name="archiver" class="bouton_blanc12" value="Archiver" onclick="Archiver_demande();" />
						</td>
					</tr>	
				</table>
				</form>
			
				
			</td>
		</tr>
		<tr>
			<td class="cell_pied_page" colspan="2">
			</td>
		</tr>
	</table>









</body>
</html>