<?php

	session_start();
	
	include('connect.php');
	include('ldap.php');

	$mess_auth = '';
	
	if(isset($_POST['connecter']))
	{
		$sql_auth = "SELECT LOGIN_UTILISATEUR FROM UTILISATEUR WHERE LOGIN_UTILISATEUR = '" .addslashes($_POST['login']) ."'";
		$res_a = mysql_query($sql_auth);
		if(mysql_num_rows($res_a) == 0)
		{
			$mess_auth = "Vous n'êtes pas autorisé à utiliser cette application.";
		}
		else
		{
			
			
			$_SESSION['login'] = $_POST['login'];
			$sql_type_util = "SELECT * 
							  FROM UTILISATEUR AS U, TYPE_UTIL AS T
							  WHERE U.ID_TYPE_UTIL = T.ID_TYPE_UTIL
							  AND LOGIN_UTILISATEUR = '" .$_POST['login'] ."';";
			
			$res_t = mysql_query($sql_type_util);
			$type = mysql_fetch_array($res_t);
			$_SESSION['id_util'] = $type['ID_UTILISATEUR'];
			$_SESSION['type_util'] = $type['LIBELLE_TYPE_UTIL'];
			$_SESSION['nom'] = 'Meyssonnier';
			$_SESSION['prenom'] = 'Regis';
			$_SESSION['connect'] = 'normal';
			
						
			/*
			$serveur = "ldap://aristote.dijon.men.fr";
			$port = "389";
			$dn="ou=ac-dijon, ou=education, o=gouv, c=fr"; 
			
			$ldap = new Ldap($serveur, $port);
			$ldap->Connecter_serveur();
			$r_ld = $ldap->Authentifier_utilisateur($_POST['login'], $_POST['password'], $dn);
			
			if($r_ld->resultat)
			{	
				$sql_type_util = "SELECT * 
								  FROM UTILISATEUR AS U, TYPE_UTIL AS T
								  WHERE U.ID_TYPE_UTIL = T.ID_TYPE_UTIL
								  AND LOGIN_UTILISATEUR = '" .$_POST['login'] ."';";
				
				$res_t = mysql_query($sql_type_util);
				$type = mysql_fetch_array($res_t);
				$_SESSION['id_util'] = $type['ID_UTILISATEUR'];
				$_SESSION['type_util'] = $type['LIBELLE_TYPE_UTIL'];
			
				$mess_auth = $r_ld->message;
				$_SESSION['login'] = $ldap->login;
				$_SESSION['nom'] = $ldap->nom;
				$_SESSION['prenom'] = $ldap->prenom;
				$_SESSION['email'] = $ldap->email;
				$_SESSION['dn_perso'] = $ldap->dn_perso;
				$_SESSION['connect'] = 'normal';
				
			}
			else
			{
				$mess_auth = $r_ld->message;
			}
			$ldap->Deconnecter_serveur();
			
			if($r_ld->resultat)*/
				header('Refresh:0; URL=accueil.php');
		
		
		}
	
	
	}


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
			<td class="cell_entete"></td>
		</tr>	
		<tr>
			<td class="cell_centre_index">
			
				<center>Pour pouvoir utiliser l'application de gestion de consommable, vous devez d'abord vous connectez</center>
			
				<form action="index.php" method="post" id="form_connexion" onsubmit="return Valider_form_connexion();">
				<table class="tab_connexion">
					<tr>
						<td align="center" colspan="2" class="titre_fond_blanc">
							Connectez-vous
						</td>
					</tr>
					<tr>
						<td>Login :</td><td><input type="text" name="login" value=""/></td>
					</tr>
					<tr>
						<td>Mot de passe :</td><td><input type="password" value="" name="password"/></td>
					</tr>
					<tr>
						<td colspan="2" align="center" ><input type="submit" name="connecter" value="Se connecter" class="bouton_12"/></td>
					</tr>
				</table>
				</form>
				
				<center>
					<span class="rouge">
					<?php
					
						echo $mess_auth;
					
					?>	
					</span>			
				</center>
			
			</td>
		</tr>
		<tr>
			<td class="cell_pied_page">
			</td>
		</tr>
	</table>









</body>
</html>
