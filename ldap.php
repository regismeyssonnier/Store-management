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
		
		public function Authentifier_utilisateur_CAS($login, $dn){
		
			if($this->connecter)
			{
				$sr=ldap_search($this->id_connect, $dn, "uid=" .$login);
				$info = ldap_get_entries($this->id_connect, $sr);
				
				if($info['count'] > 0)
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













?>