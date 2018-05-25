<?php
$bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");
require_once('JBBCode/Parser.php');
 $articles = $bdd-> query('SELECT * FROM articles ORDER BY id DESC');

           $parser = new JBBCode\Parser();
           $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
?>
<!DOCTYPE html>
<html>
<head>
	<title>Article Page</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="article.css"/>
	<link rel="stylesheet" href="dist/css/bootstrap.css">
</head>
<body>
	<div class="containerMenu" id="ContainerArticle">
		<div class="Banniere">
			<span>
				<a href="CreArt.php">Creer un article</a>
				<a href="ArtList.php"> Liste des articles</a>
			</span>
		</div><br>
	<div class="container scroll">
	<?php while($a = $articles->fetch()){?>
	<div class="rowArticle">
		<div class="col-lg-9">
			<h3><strong style="font-size:30px; font-family: Century Gothic;"><?= $a['titre'] ?></strong></h3>
			<h5><span class="glyphicon glyphicon-time"></span> Publié le <?= $a['date_time_publication'] ?></h5>
			<p class="text-justify">
				<?php
				$parser->parse($a['contenu']); 
           		echo $parser->getAsHtml(). '<br />';
				  ?>
			</p>
			<div class="text-center">
				<a href="AffichArt .php?id=<?= $a['id']?>"><button type="button" class="btn btn-info" name="Afficher"><span class="glyphicon glyphicon-eye-open"></span> Afficher</button></a>
				<a href="CreArt.php?modif=<?= $a['id']?>"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a>
				<a href="supprimer.php?id=<?= $a['id']?>"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</button></a>
			</div>
		</div>
	</div>
	<?php } ?>
    </div>
	</div>
<script type="text/javascript" src="dist/js/jquery compressed-3.2.1.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap.js"></script>
</body>
</html>