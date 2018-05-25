<?php
$bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");
require_once('JBBCode/Parser.php');
           $parser = new JBBCode\Parser();
           $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());

if(isset($_GET['id']) AND !empty($_GET['id'])){
	$get_id = htmlspecialchars($_GET['id']);

	$art = $bdd-> prepare('SELECT * FROM articles WHERE id = ?');
	$art-> execute(array($get_id));

	if($art->rowCount() == 1){
		$art = $art->fetch();
		$titre = $art['titre'];
		$contenu = $art['contenu'];
	}else{
		die('cet article n\'existe pas');
	}
}else{
	die('Erreur');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Affichage</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="article.css">
	<link rel="stylesheet" href="dist/css/bootstrap.css">
</head>
<body>
	<div class="CreArtMenu">
		<a href="home.php"><span class="glyphicon glyphicon-home"></span> Accueil</a>
	</div><br><br>
	<div class="container" style="background-color: #0ff;">
	<div class="col-lg-9">
			<h3><strong style="font-size:30px; font-family: Century Gothic;"><?= $titre ?></strong></h3>
			<h5><span class="glyphicon glyphicon-time"></span> Publié le <?= $art['date_time_publication'] ?></h5>
			<p class="text-justify">
				<?php
				$parser->parse($contenu); 
           		echo $parser->getAsHtml(). '<br />';
				  ?>
			</p>
	</div>
</div>
<script type="text/javascript" src="dist/js/jquery compressed-3.2.1.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap.js"></script>
</body>
</html>