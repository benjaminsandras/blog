<!DOCTYPE html>
<html>
<head>
	<title>myblog</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div>
		<h1>My Blog</h1>
	</div>

	<?php 

	try{

		$bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'benji', 'aqwsedcft7777');

	}


	catch (Exception $e)

	{

		die('Erreur : ' . $e->getMessage());

	}
	?>
	<div>
		<?php

		$reponse = $bdd->query('SELECT * FROM articles') ;

		while($donnees=$reponse->fetch()){

			echo 

			'<div class="countain">' .
			'<div class="article">' . $donnees['title'] . '</div>' .
			'<div class="article">' . $donnees['texte'] . '</div>' .
			'</div>' ;


		}
		?>

	</div>

	










	

</body>
</html>