<?php
	
	
	header('Refresh:3; URL=accueil.php');
	            

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="site.css"/>
<title>Redirection</title>
</head>

<body>

	<?php
	
		echo '<div class="redirection">';
		echo "Vous n'�tes pas autoris� � acc�der � cette page.<br/>";
		echo "Vous allez �tre redirig� sur la page d'accueil.<br/>";
		echo "Si vous n'�tes pas redirig�, cliquez sur ce lien : " .'<a href="accueil.php">Accueil</a>';
		echo '</div>';
	
	
	
	?>

</body>
</html>
