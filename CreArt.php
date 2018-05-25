<?php
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");

$modification = 0;
if(isset($_GET['modif']) AND !empty($_GET['modif'])){
	$modification = 1;

	$modif_id = htmlspecialchars($_GET['modif']);
	$modif_article = $bdd-> prepare('SELECT * FROM articles WHERE id = ?');
	$modif_article-> execute(array($modif_id));

	if($modif_article->rowCount() == 1){
		$modif_article = $modif_article->fetch();
	}else{
		die('Erreur : l\'article concerné n\'existe pas');
	}
}

if(isset($_POST['titre_art'], $_POST['contenu_art'])){
	if(!empty($_POST['titre_art']) AND !empty($_POST['contenu_art'])){

		$titre_art = htmlspecialchars($_POST['titre_art']);
		$contenu_art = htmlspecialchars($_POST['contenu_art']);
		if($modification == 0){
			$ins = $bdd-> prepare('INSERT INTO articles (titre, contenu, date_time_publication) VALUES (?, ?, NOW())');
		   $ins->execute(array($titre_art, $contenu_art));
		   $message = "Votre article a bien été publié";
		}else{
            $update = $bdd-> prepare('UPDATE articles SET titre = ?, contenu = ?, date_time_modif = NOW() WHERE id =  ?');
            $update->execute(array($titre_art, $contenu_art, $modif_id));
            $message = "Votre article a bien été mis a jour";
		}
		


	}else{
		$message = "Veuillez remplir tous les champs";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Article Page</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="article.css"/>
	<link rel="stylesheet" href="dist/css/bootstrap.css">
	<!-- Load jQuery  -->
<script src="dist/js/jquerywysibb.js"></script>

<!-- Load WysiBB JS and Theme -->
<script src="dist/js/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="dist/css/wbbtheme.css" />
<script src="dist/js/fr.js"></script>

<!-- Init WysiBB BBCode editor -->
<script>
$(document).ready(function() {
 var wbbOpt = {
  lang: "fr"
 }
 $("#editor").wysibb(wbbOpt);
});
</script>
	
</head>
<body>
	<div class="CreArtMenu">
		<a href="home.php"><span class="glyphicon glyphicon-home"></span> Accueil</a>
	</div><br><br>
	<div class="container">
 <form action="" method="POST">
    <div class="form-group">
    	<h3><label for="titre">Titre:</label></h3>
    	<input type="text" class="form-control" id="titre" name="titre_art" placeholder="Saissisez le titre de votre article" style="font-size: 15px;" <?php if($modification == 1) { ?> value="<?= $modif_article['titre'] ?>" <?php } ?> />
  	</div>
  	<div class="form-group">
    <h3><label for="editor">Article:</label></h3>
    	<textarea class="form-control" name="contenu_art" rows="20" id="editor"><?php if($modification == 1) { ?><?= $modif_article['contenu'] ?> <?php } ?></textarea>
  	</div>
  	<button type="submit" class="btn btn-success">Publier</button>
</form> 
  <?php if(isset($message)){ echo $message;}?>
</div>
</body>
</html>