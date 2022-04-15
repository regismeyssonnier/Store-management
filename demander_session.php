<?php
	
	session_start();

	if(isset($_POST['donner']))
	{
		$_SESSION['tab_donner'][$_POST['i']] = $_POST['donner'];
		echo $_SESSION['tab_donner'][$_POST['i']];
	}

	if(isset($_POST['retirer']))
	{
		$_SESSION['tab_retirer'][$_POST['i']] = $_POST['retirer'];
		echo $_SESSION['tab_retirer'][$_POST['i']];
	}

?>