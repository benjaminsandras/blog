


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

	

	<form method="post">
		<textarea name="newtitle"></textarea>
		<textarea name="newtext"></textarea>
		<button type="submit">send</button>
	</form>

	<?php 

	try{

		$bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'benji', 'aqwsedcft7777');
	}

	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	if (empty($_POST['newtitle']) && empty($_POST['newtext'])) {
		echo 'var vaut soit 0, vide, ou pas définie du tout';

	}

	else{
		echo 'var est définie même si elle est vide';
		
		$newtitle = $_POST['newtitle'];
		$newtext = $_POST['newtext'];
		
		
		$bdd->query("INSERT INTO articles (title, texte)
			VALUES ('$newtitle', '$newtext')") ;

		unset($newtitle);
		unset($newtext);
		header("location: admin.php");
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
			'<form method="get">
			<button name="modifier" type="submit" >' . 'modifier' . '</button>' . 
			'<button name="supp" type="submit">' . 'supprimer' . '</button>' .
			'<input name="input" value=' . $donnees['id'] . '></form>' .

			'</div>' ;
			

		}
		// if (isset($_GET['supp'])) {
			$id = $_GET['input'];

			// $bdd->query("DELETE FROM articles WHERE id=".
			// 	$id) ;

			var_dump($id);
			// unset($id);
		// }
		?>

		<?php
		?>

	</div>

	

	

</body>
</html>


<!-- 
	id=' . uniqid() . ' -->





