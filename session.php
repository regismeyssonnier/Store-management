<?php

	session_start();
	
	function Teste_autorisation($type_util, $nom_fichier){
	
		if( ($type_util == 'Administrateur') || ($type_util == 'Gestionnaire des stocks') )
		{
			return true;
		}
		else if($type_util == 'Personnel')
		{
			$tab_page_aut = array('index.php', 'accueil.php', 'effectuer_demande.php', 'suivre_demande.php');
			$n = count($tab_page_aut);
			for($i = 0;$i < $n;$i++)
			{
				if($nom_fichier == $tab_page_aut[$i])
					return true;
			
			}
		
		}
		else if($type_util == 'Controleur de gestion')
		{
			$tab_page_aut = array('index.php', 'accueil.php', 'effectuer_demande.php', 'suivre_demande.php');
			$n = count($tab_page_aut);
			for($i = 0;$i < $n;$i++)
			{
				if($nom_fichier == $tab_page_aut[$i])
					return true;
			
			}
		
		}
	
		return false;
		
	}

	if(!isset($_SESSION['login']))
	{
		header('Refresh:0; URL=session_vide.php');
	
	}
	else
	{
		$fichier = split("/", $_SERVER['SCRIPT_NAME']);
		$n = count($fichier);
		if(!Teste_autorisation($_SESSION['type_util'], $fichier[$n-1]))
			header('Refresh:0; URL=session_interdit.php');
	}




?>