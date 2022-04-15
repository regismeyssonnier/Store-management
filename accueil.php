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
				<table class="tab_bleu_735">
					<tr>
						<td class="titre_fond_bleu25" valign="top">
							Bienvenue sur l'application de gestion de consommable
						</td>
					</tr>
					<tr>
						<td valign="top">
						
							<div class="texte400">
							Vous etes connecte en tant que <?php echo $_SESSION['type_util']; ?><br/>
							<?php
								if($_SESSION['type_util'] == 'Administrateur')
								{
									echo "Vous avez les droits suivants :<br/>";
									echo "- Vous pouvez effectuer toutes les actions que vous voulez<br/>";
								}
								else if($_SESSION['type_util'] == 'Gestionnaire des stocks')
								{
									echo "Vous avez les droits suivants :<br/>";
									echo "- Prendre connaissance des demandes et les traiter<br/>";
									echo "- Gérer les stocks de consommables<br/>";
									echo "- Gérer les commandes et les livraison passées<br/>";
									
								}
								else if($_SESSION['type_util'] == 'Controleur de gestion')
								{
									echo "Vous avez les droits suivants :<br/>";
									echo "- Connaître les cout d'achats du stock et des differents articles<br/>";
									echo "- Suivre l'evolution de la demande<br/>";
																		
								}
								else
								{
									echo "Vous avez les droits suivants :<br/>";
									echo "- Passer une demande<br/>";
									echo "- Suivre l'evolution de vos demandes<br/>";
								
								}


							?>
							</div>
							<p><br/></p>
							<center><img src="Image/logo-transparent.gif" alt="logo rectorat" width="450" height="550"/></center>
							
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="cell_pied_page" colspan="2">
			</td>
		</tr>
	</table>









</body>
</html>