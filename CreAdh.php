<?php
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=gestbiblio", "root", "");

$modification = 0;
if(isset($_GET['modif']) AND !empty($_GET['modif'])){
  $modification = 1;

  $modif_id = htmlspecialchars($_GET['modif']);
  $modif_adherant = $bdd-> prepare('SELECT * FROM adherant WHERE id = ?');
  $modif_adherant-> execute(array($modif_id));

  if($modif_adherant->rowCount() == 1){
    $modif_adherant = $modif_adherant->fetch();
  }else{
    die('Erreur : l\'adherant concerné n\'existe pas');
  }
}

if(isset($_POST['pseudo']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['email']) && isset($_POST['filiere']) && isset($_POST['sexe']) && isset($_POST['passe']) && isset($_POST['pass'])){

       if(!empty($_POST['pseudo']) AND !empty($_POST['nom']) AND isset($_POST['prenom']) AND !empty($_POST['date']) AND !empty($_POST['email']) AND !empty($_POST['filiere']) AND !empty($_POST['sexe']) AND !empty($_POST['passe']) AND !empty($_POST['pass'])){

       $pseudo = htmlspecialchars($_POST['pseudo']);
       $prenom = htmlspecialchars($_POST['prenom']);
       $nom = htmlspecialchars($_POST['nom']);
       $email = htmlspecialchars($_POST['email']);
       $dater = $_POST['date'];
       $filiere = $_POST['filiere'];
       $sexe = $_POST['sexe'];

    
       $pass = trim($_POST['pass']);
       $pass_confirm = trim($_POST['passe']);
       

          if($modification == 0){
            $insertion = $bdd-> prepare('INSERT INTO adherant (pseudonyme, nom, prenom, datenaiss, email, filiere, sexe, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
       $insertion->execute(array($pseudo, $nom, $prenom, $dater, $email, $filiere, $sexe, $pass_confirm));

    header("Location: home.php");
  }else{
     $update = $bdd-> prepare('UPDATE adherant SET pseudonyme = ?, nom = ?, prenom = ?, datenaiss = ?, email = ?, filiere = ?, sexe = ?, password = ?  WHERE id =  ?');
            $update->execute(array($pseudo, $nom, $prenom, $dater, $email, $filiere, $sexe, $pass_confirm, $modif_id));
            $message = "Votre adherant a bien été mis a jour";
            
  }
  }else{
    $message = "Veuillez remplir tous les champs";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Creation d'un adherant</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="adherant.css">
	<link rel="stylesheet" href="dist/css/bootstrap.css">
</head>
<body style="background-color: #ccc; ">
	<div class="CreAdhMenu">
		<a href="home.php"><span class="glyphicon glyphicon-home"></span> Accueil</a>
	</div><br><br><br>

	  <div class="container ContainerAdh">
       <div class="col-lg-6 col-lg-offset-3 ">
        <div class="panel panel-success" style="width: 120%; padding: 15px; ">
          <div class="panel-body">
            <form role="form" action="CreAdh.php" method="POST">
              <fieldset>
                 <legend class="text-center">INFORMATIONS</legend>
                <div class="form-group">
                <label for="pseudo">Pseudonyme</label>
        				<input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Entrez votre pseudonyme" <?php if($modification == 1) { ?> value="<?= $modif_adherant['pseudonyme'] ?>" <?php } ?> />
                </div>
                <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom" <?php if($modification == 1) { ?> value="<?= $modif_adherant['nom'] ?>" <?php } ?>/>
                </div>
                <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prenom" <?php if($modification == 1) { ?> value="<?= $modif_adherant['prenom'] ?>" <?php } ?>/>
                </div>
                <div class="form-group">
                <label for="date">Date de naissance</label>
                <input type="date" id="date" name="date" class="form-control" <?php if($modification == 1) { ?> value="<?= $modif_adherant['datenaiss'] ?>" <?php } ?> />
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" <?php if($modification == 1) { ?> value="<?= $modif_adherant['email'] ?>" <?php } ?> />
                </div>
                <br>
                <div class="form-group">
                <label for="filiere">Votre filiere : </label>
                <select class="form-control" id="filiere" name="filiere" <?php if($modification == 1) { ?> value="<?= $modif_adherant['filiere'] ?>" <?php } ?>>
                	<option value="IRT1" selected="selected"> IRT1</option>
                	<option value="IRT2"> IRT2</option>
                	<option value="CCA/BF"> CCA/BF</option>
                	<option value="SG"> SG</option>
                </select>
                </div>
                <div class="form-group">
                <label for="sexe">Votre sexe : </label>
                <select class="form-control" id="sexe" name="sexe" <?php if($modification == 1) { ?> value="<?= $modif_adherant['sexe'] ?>" <?php } ?>>
                	<option value="homme" selected="selected"> Homme</option>
                	<option value="Femme">Femme</option>
                </select>
                </div>
                <div class="form-group">
                <label for="pass">Mot de passe</label>
                <input type="password" id="pass" class="form-control" name="pass" placeholder="Entrez votre mot de passe"/>
                </div>
                <div class="form-group">
                <label for="passe">Confirmer le mot de passe</label>
                <input type="password" id="passe" class="form-control" name="passe" placeholder="Confirmez le mot de passe"/>
                </div>
                <br>
                  <div class="text-right"><button type="submit" value="submit" class="btn btn-success"><strong>Valider</strong></button>
                </fieldset>
            </form>
          </div>  
        </div>
        <?php if(isset($message)){echo $message;}?>
       </div>
     </div>

<script type="text/javascript" src="dist/js/jquery compressed-3.2.1.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap.js"></script>
</body>
</html>