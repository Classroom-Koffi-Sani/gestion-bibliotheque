<?php
$bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");
   if(isset($_GET['id']) AND !empty($_GET['id'])){
	$supprim_id = htmlspecialchars($_GET['id']);
	$supprim_article = $bdd-> prepare('DELETE  FROM articles WHERE id = ?');
	$supprim_article-> execute(array($supprim_id));

	header("Location: home.php");
}
?>