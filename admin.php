<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
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
<!-- formulaire d'ajout d'un article -->

	<?php 

		try{

			$bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'benji', 'aqwsedcft7777');
		}

		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}
// connexion base de données

		if (empty($_POST['newtitle']) && empty($_POST['newtext'])) {
			echo 'var vaut soit 0, vide, ou pas définie du tout';

		}
// On vérifie le cas où les champs ne seraient pas remplis

		else{
			echo 'var est définie même si elle est vide';
		
			$newtitle = $_POST['newtitle'];
			$newtext = $_POST['newtext'];
// On crée deux nouvelles variables auxquelles on associent les valeurs rentrées dans le formulaire d'ajout.	
// pour $_POST['newtitle']; $_POST fait référence à l'attribut method="post", utilisé dans la balise <form> du formulaire, et ['newtitle'], fait référence à l'attribut name="newtitle", utilisé dans une des deux balise <textarea> (la méthode est la même pour une balise <input>)

			$bdd->query("INSERT INTO articles (title, texte)
				VALUES ('$newtitle', '$newtext')") ;
// requête sql pour insérer les nouvelles variables contenant les valeurs rentrées dans les champs du formulaire d'ajout, dans la table "articles" de la base de données

			unset($newtitle);
			unset($newtext);
			header("location: admin.php");
// On vide les variables et on bloque le rechargement de la page pour empêcher l'envoie automatique du formulaire lors du rechargement de la page

		}
	
	?>


	
	<div>
		<?php

			if (isset($_GET['modifier'])) {
// Première condition qui correspond au click du bouton "modifier" : 
// si on "appelle" le <button name = "modifier">

				$id = $_GET['input'];
				$title = $_GET['title'];
				$texte = $_GET['texte'];
// On récupère les valeurs des deux textarea et de l'input caché affichés dynamiquement plus bas
			
				$query  = "
				UPDATE
				articles
				SET
				title = '".$title."',
				texte = '".$texte."'
				WHERE
				id    = '".$id."'";

				$bdd->query($query);

// Requête sql de mise à jour des colonnes "title" et "texte" de la table "articles" avec les valeurs récupérées au-dessus, uniquement pour l'id que l'on a également récupérere au-dessus.
//j'ai été obligé de mettre ma requête dans une variable et d'appeler ensuite cette variable dans la fonction d'appel de la base de données sinon la requête ne fonctinnait pas, je n'ai pas d'explication à cela...


				$reponse = $bdd->query('SELECT * FROM articles') ;

// Requête sql de séléction de la table "articles"

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
// On affiche dynamiquement les données de la table "articles" à l'intérieur de deux textarea - de manière à pouvoir écrire à l'intérieur ensuite et donc de pouvoir "modifier" directement l'article que l'on a sous les yeux.
// On place ces deux textarea à l'intérieur d'un formulaire d'envoi <form method="get">, dans lequel on crée également deux boutons, <button name="modifier" et <button name="supp",                                     ainsi qu'un input <input value=' . $donnees['id'] . '> dont la valeur sera égale à la valeur de l'id correspondant dans la base de données. On cachera ensuite cet input à l'aide du css.

// C'est à partir de cet affichage dynamique, et grâce à lui, que l'on peut éffectuer les trois premières étapes à partir de la première condition !!!

			} //fin de la première condition

			else if (isset($_GET['supp'])) {
// Deuxième condition qui correspond au click du bouton "supp" : 
// si on "appelle" le <button name = "supp">

				$id = $_GET['input'];
// On récupère la valeur de l'input caché

				$bdd->query("DELETE FROM articles WHERE id=".
				$id) ;
// Requête sql de suppression de la table "articles" uniquement pour la colonne où l'id correspond à la valeur récupérée juste avant

			
				unset($id);

				$reponse = $bdd->query('SELECT * FROM articles') ;
// Requête sql de séléction de la table "articles"

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
// Ici l'affichage est exactement le même que pour la première condition, et la logique générale est exactement la même

			} // Fin de la deuxième condition

			else{
// si l'on a ni "appellé" le <button name = "modifier">, ni le <button name = "supp">, alors :

				$reponse = $bdd->query('SELECT * FROM articles') ;
// Requête sql de séléction de la table "articles"

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
// Affichage dynammique, toujours inchangé

			}
		?>

	</div>





</body>
</html>








