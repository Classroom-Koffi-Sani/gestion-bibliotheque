<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des Bibliotheques</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" href="dist/css/bootstrap.css">
	 <style>
  /* Note: Try to remove the following lines to see the effect of CSS positioning */
  .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container {
      padding-top: 70px;
  
  }

  </style>
</head>
<body>
	<div class="row">
     <div class="headerBanniere">
     	<img src="images/Esgis.png" class="col-lg-2 rounded" width="200px;">
     	<center>
     		<div class="col-lg-5 forms">
     		 	<form role="form" class="form1" method="GET" action="ArtList.php">
            	<div class="input-group">
              		<input type="search" name="search" class="form-control "  placeholder="Rechercher un article ...." />
              		<span class="input-group-btn">
                 		<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
              		</span>
           		</div>
          		</form>
          	</div>
        </center>
        <div class="col-lg-3" style="color: green;" >
        	<blockquote>Biblio Esgis</blockquote>
        </div>
     </div>
    </div>
    <div class="row1"  data-spy="affix" data-offset-top="197">
    	<a href="#">Accueil</a>
    </div><br>
    <div class="col-lg-3">
    	<?php require 'aside.php';?>
    </div>
    <div class="col-lg-8 slide1">
    	<?php require 'accueil.php';?>
    </div>
    <div class="col-lg-8 slide2">
    	<?php require 'article.php'?>
    </div>
    <div class="col-lg-8 slide3">
    	<?php require 'adherant.php'?>
    </div>

<button onclick="topFunction()" id="myBtn" title="Aller en haut"><span class="glyphicon glyphicon-menu-up"></span></button> 
<script type="text/javascript" src="dist/js/jquery compressed-3.2.1.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap.js"></script>
<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="dist/js/script.js"></script>
</body>
</html>