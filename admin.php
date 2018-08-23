


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
		<textarea rows="2" name="newtitle"></textarea>
		<textarea rows="5" name="newtext"></textarea>
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

		if (isset($_GET['modifier'])) {
			$id = $_GET['input'];
			$title = $_GET['title'];
			$texte = $_GET['texte'];
			
			$bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'benji', 'aqwsedcft7777');
			$bdd->query("UPDATE articles SET title = '".$title."'" "WHERE id= ".$id);
			
			var_dump($title);
			var_dump($texte);
			// unset($id);
			// unset($title);
			// unset($texte);

			$reponse = $bdd->query('SELECT * FROM articles') ;

			while($donnees=$reponse->fetch()){

				echo 
				'<form method="get">' .
				'<div class="countain">' .
				'<textarea rows="2" name="title" class="article" value=' . $donnees['title'] . '>' . $donnees['title'] . '</textarea>' .
				'<textarea rows="5" name="texte" class="article" value=' . $donnees['texte'] . '>' . $donnees['texte'] . '</textarea>' . 
				
				'<button name="modifier" type="submit" >' . 'modifier' . '</button>' . 
				'<button name="supp" type="submit">' . 'supprimer' . '</button>' .
				'<input class="inputid" name="input" value=' . $donnees['id'] . '></form>' .

				'</div>' ;


			}

		}

		else if (isset($_GET['supp'])) {
			$id = $_GET['input'];

			$bdd->query("DELETE FROM articles WHERE id=".
				$id) ;

			
			unset($id);

			$reponse = $bdd->query('SELECT * FROM articles') ;

			while($donnees=$reponse->fetch()){

				echo 
				'<form method="get">' .
				'<div class="countain">' .
				'<textarea rows="2" name="title" class="article" value=' . $donnees['title'] . '>' . $donnees['title'] . '</textarea>' .
				'<textarea rows="5" name="texte" class="article" value=' . $donnees['texte'] . '>' . $donnees['texte'] . '</textarea>' . 
				
				'<button name="modifier" type="submit" >' . 'modifier' . '</button>' . 
				'<button name="supp" type="submit">' . 'supprimer' . '</button>' .
				'<input class="inputid" name="input" value=' . $donnees['id'] . '></form>' .

				'</div>' ;


			}

		}

		else{

			$reponse = $bdd->query('SELECT * FROM articles') ;

			while($donnees=$reponse->fetch()){

				echo 
				'<form method="get">' .
				'<div class="countain">' .
				'<textarea rows="2" name="title" class="article" value=' . $donnees['title'] . '>' . $donnees['title'] . '</textarea>' .
				'<textarea rows="5" name="texte" class="article" value=' . $donnees['title'] . '>' . $donnees['texte'] . '</textarea>' . 
				
				'<button name="modifier" type="submit" >' . 'modifier' . '</button>' . 
				'<button name="supp" type="submit">' . 'supprimer' . '</button>' .
				'<input class="inputid" name="input" value=' . $donnees['id'] . '></form>' .

				'</div>' ;


			}

		}
		?>

	</div>





</body>
</html>


<!-- 
	id=' . uniqid() . ' -->





