<!DOCTYPE html>
<html>
<head>
	<title>myblog</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div>
		<h1>My Blog2</h1>
	</div>

	
	<?php 

	try{

		$bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'benji', 'aqwsedcft7777');

	}


	catch (Exception $e)

	{

		die('Erreur : ' . $e->getMessage());

	}

		if (empty($_POST['newtitle']) && empty($_POST['newtext'])) {
			echo '$var vaut soit 0, vide, ou pas définie du tout';
		}

// Evalué à vrai car $var est défini
		else{
			echo '$donnees est définie même si elle est vide';
			$newtitle = $_POST['newtitle'];
			$newtext = $_POST['newtext'];
		}

	

	$reponse = $bdd->query("INSERT INTO articles (title, texte)
		VALUES ('$newtitle', '$newtext')") ;

	while($donnees=$reponse->fetch()){
			echo 

			'<div class="title">' . $donnees['newtitle'] . '</div>' .
			'<div class="text">' . $donnees['newtext'] . '</div>' ;



	}

	
	?>

	


	

</body>
</html>

