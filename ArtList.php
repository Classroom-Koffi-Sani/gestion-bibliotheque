<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");
$articles = $bdd-> query('SELECT titre FROM articles ORDER BY id ASC');

if(isset($_GET['search']) AND !empty($_GET['search'])){
	$search = htmlspecialchars($_GET['search']);
	$articles = $bdd-> query('SELECT titre FROM articles WHERE titre LIKE "%'.$search.'%" ORDER BY id DESC');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Liste des articles</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="article.css">
	<link rel="stylesheet" href="dist/css/bootstrap.css">
</head>
<body>
	<div class="CreArtMenu">
		<a href="home.php"><span class="glyphicon glyphicon-home"></span> Accueil</a>
	</div><br><br>
	<?php if($articles-> rowCount()>0) ?>
	<ul class="list-unstyled container">
		<?php while($a = $articles->fetch()){?>
		<li style="border: 1px solid #f1f1f1; background-color: #eee; color: black; padding: 20px; line-height: 10px; cursor: pointer; font-family: Verdana;"><?= $a['titre'] ?> <span class="glyphicon glyphicon-plus pull-right"></span></li>
	<?php }?>
	</ul>
	<?php} else { echo 'Aucun resultat....'; }?>
<script type="text/javascript" src="dist/js/jquery compressed-3.2.1.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap.js"></script>
</body>
</html>