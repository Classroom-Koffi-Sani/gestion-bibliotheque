<?php
$bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");
   if(isset($_GET['id']) AND !empty($_GET['id'])){
	$supprim_id = htmlspecialchars($_GET['id']);
	$supprim_adherant = $bdd-> prepare('DELETE  FROM adherant WHERE id = ?');
	$supprim_adherant-> execute(array($supprim_id));

	header("Location: home.php");
}
?>