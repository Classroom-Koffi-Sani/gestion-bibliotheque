<?php
   $bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");
   $adherant = $bdd-> query('SELECT * FROM adherant ORDER BY id ASC');
   $articles = $bdd-> query('SELECT * FROM articles ORDER BY id DESC');

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
				<a href="CreAdh.php">Creer un adherant</a>		
		</div><br>
		<center>
				<div class="forms pull-center">
     		 	<form role="form" class="form1">
            	<div class="input-group" style="width: 275px;">
              		<input type="search" class="form-control "  placeholder="Rechercher un adherant ...." />
              		<span class="input-group-btn">
                 		<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
              		</span>
           		</div>
          		</form>
          	</div>
          </center>	
		<br>
	<div class="container">
		<?php while($adh = $adherant->fetch()){?>
		<div class="row">
		<div class="col-lg-6">
			<h2>Adherant N<?= $adh['id'] ?></h2>
			<div id="numero1" style="font-family: Century Gothic">
				<p>Pseudo : <strong><?= $adh['pseudonyme'] ?> </strong></p><br>
				<p>Nom : <strong><?= $adh['nom'] ?> </strong></p><br>
				<p>Prenom : <strong> <?= $adh['prenom'] ?> </strong></p><br>
				<p>Filiere : <strong> <?= $adh['filiere'] ?> </strong></p><br>
				<p>Mail : <strong> <?= $adh['email'] ?> </strong></p><br>
			</div>
		</div>
		<div class="col-lg-6" style="padding: 80px 80px 80px 0px; line-height: 20px;">		
			<div class="text-left">
				<a href="CreAdh.php?modif=<?= $adh['id']?>"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a>
				<a href="SupprAdh.php?id=<?= $adh['id']?>"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Supprimer</button></a>
				<button type="button" class="btn btn-primary" value="<?= $adh['id']?>"><span class="glyphicon glyphicon-ok-circle"></span> Preter un article</button>
			</div>       
		</div>
		</div>
	<hr>
	<?php } ?>
    </div>
	</div>
<script type="text/javascript" src="dist/js/jquery compressed-3.2.1.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap.js"></script>
<script type="text/javascript" src="dist/js/script.js"></script>
</body>
</html>