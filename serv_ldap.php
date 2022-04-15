<html>
<head>
	<title>LDAP</title>
</head>
<body>

	<form action="serv_ldap.php" method="post">
		<table>
			<tr>
				<td>login:</td><td><input type="text" name="login" value=""/></td>
			</tr>
			<tr>
				<td>mdp:</td><td><input type="password" name="mdp" value=""/></td>
			</tr>
			<tr>
				<td></td><td><input type="submit" name="connecter" value="Se connecter"/></td>
			</tr>
		</table>
	
	</form>

	<?php
	

		class Res_Auth_Ldap
		{
			private $resultat;
			private $message;
			
			public function __construct($res, $mess){
			
				$this->resultat = $res;
				$this->message = $mess;
			
			}
			
			public function __get($attribut){
			
				if($attribut == 'resultat')
					return $this->resultat;
				else if($attribut == 'message')
					return $this->message;
				else
					throw new Exception("Attribut inconnu");
			
			}
		
		}
	
	
		class Ldap
		{
			private $serveur;
			private $port;
			private $id_connect;
			private $nom;
			private $prenom;
			private $email;
			private $login;
			private $dn_perso;
			private $connecter;
			
			public function __construct($serveur, $port){

				$this->serveur = $serveur;
				$this->port = $port;
				$this->connecter = false;
							
			}
		
			public function Connecter_serveur(){
			
				if($this->connecter == false)
				{
					$this->id_connect = ldap_connect($this->serveur, $this->port)
										or die("Impossible de se connecter au serveur " .$serveur);
										
					$this->connecter = true;
				}
				else
					throw new Exception("Erreur Connexion : déja connecter");
				
				
				
			}
			
			public function Authentifier_utilisateur($login, $mdp, $dn){
			
				if($this->connecter)
				{
					$sr=ldap_search($this->id_connect, $dn, "uid=" .$login);
					$info = ldap_get_entries($this->id_connect, $sr);
					
					if($info['count'] > 0)
					{
						if(@ldap_bind($this->id_connect, $info[0]["dn"], $mdp))
						{	
							$this->nom = $info[0]["sn"][0];	
							$this->prenom = $info[0]["givenname"][0];
							$this->email = $info[0]["mail"][0];
							$this->login = $login;
							$this->dn_perso = $info[0]["dn"];
							
							$res = new Res_Auth_Ldap(true, "Authentification réussie");
							return $res;					
						}
						else
						{	
							$res = new Res_Auth_Ldap(false, "Mauvais mot de passe");
							return $res;
						}
						
					}
					else
					{	
						$res = new Res_Auth_Ldap(false, "Le login n'existe pas");
						return $res;
					
					}
					
				}
				else
				{
					throw new Exception("Erreur Authentification : non connecter au serveur");
				}

			}
			
			public function Deconnecter_serveur(){
			
				if($this->connecter)
				{
					ldap_close($this->id_connect);
					$this->connecter = false;
					
				}
				else
				{
					throw new Exception("Erreur Authentification : non connecter au serveur");
				}
			
			}
			
			public function __get($attribut){
			
				if($attribut == 'nom')
					return $this->nom;
				else if($attribut == 'prenom')
					return $this->prenom;
				else if($attribut == 'email')
					return $this->email;
				else if($attribut == 'login')
					return $this->login;
				else if($attribut == 'dn_perso')
					return $this->dn_perso;
				else
					throw new Exception("Attribut inconnu");
			
			}
			
			
			
		}
	
	
		if(isset($_POST['connecter']))
		{
			
			$serveur = "ldap://aristote.dijon.men.fr";
			$port = "389";
			$persodn="ou=ac-dijon, ou=education, o=gouv, c=fr"; 
			echo "Connexion...<br>";
			$filtre="uid=" .$_POST['login'];
			$ldap = new Ldap($serveur, $port);
			$ldap->Connecter_serveur($persodn, $filtre);
			$r_ld = $ldap->Authentifier_utilisateur($_POST['login'], $_POST['mdp'], $persodn);
			
			if($r_ld->resultat)
			{
				echo "oui:" .$r_ld->message;
			}
			else
			{
				echo "non" .$r_ld->message;
			}
			$ldap->Deconnecter_serveur();
			echo "<br/>nom:".$ldap->nom ."<br/>";
			
			/*
			$ds=ldap_connect($serveur, $port)or die("Impossible de se connecter au serveur " .$serveur);
						
			$filtre="uid=" .$_POST['login'];
			echo "<br/>".$ds .$persodn .$filtre ."<br/>";
			$sr=ldap_search($ds, $persodn, $filtre);
			$info = ldap_get_entries($ds, $sr);
			echo $info[0]["dn"]."<br/>";
			echo $info[0]["mail"][0];
			if($info['count'] > 0)
			{
				echo "le login existe " .$info['count'];	

				if(ldap_bind($ds, $info[0]["dn"], $_POST['mdp']))
				{
					echo "authentification reussi<br/>";					
				}
				
			}
			else
			{
				echo "le login n'existe pas";
			
			}
			
			
							
			echo "Déconnexion...<br>";
			ldap_close($ds);
			
			*/
			
			/*try
			{

			$res = new Res_Auth_Ldap(true, "Authentification réussie");
			echo $res->sarace;

			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			
			}*/
		
		
		
		}
	
	
	
	
	?>




</body>
</html>