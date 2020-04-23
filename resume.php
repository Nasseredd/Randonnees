<?php
require_once './database/database.php' ;
session_start();
$database = new database();
?>

<html>
    <head>
		<title>Randonnées de l'Isère</title>
		<link rel="stylesheet" href="styles/navbar.css" >
		<link rel="stylesheet" href="styles/contenu.css" >
   		<h1>Randonnées de l'Isère</h1>
	 	<form  action="connexion.php" method="post">
			<nav class="nav">
				<ul>
					<li><a href="index.php">Accueil   </a>
					<li><a href="./resume.php">Toutes nos randonnées</a>
					<li><a href="trouver.php">Trouver un randonnee </a>
					<?php 
						if (isset($_SESSION['admin'] )) {
							echo '
									<li><a href="#">Bonjour '.$_SESSION['admin'].'</a>
							';
							echo '
									<li><a href="./logout.php"> <img src="./images/logout.png" alt="" width=20 ></a>
							';
						}else{
							echo '
									<li><a href="./login.php">Se connecter </a>
							';
						}
					?>
				</ul>
			</nav>
		</form>				
    </head>
    <body>
  			<?php
				if (isset($_SESSION['admin'] )) {
 					echo '<a href="./add.php"  value="Ajouter une randonnee"> <img src="./images/add.png" alt=""  id ="add" title="ajouter une randonnee" ></a> ';
				}

				if (isset($_SESSION['added'])) {
					echo $_SESSION['added'] ;
					unset($_SESSION['added']);
				}
				if (isset($_SESSION['deleted'])) {
					echo $_SESSION['deleted'] ;
					unset($_SESSION['deleted']);
				}
			?>
 						 <?php
							$database->afficherResume();
						?>
 <footer>
    <p class="main">
	2020 ©  | Tous droits réservés |  by <a href="https://www.linkedin.com/in/abderrahmen-meliani-bb10b6176/" target="_blank">MELIANI Abderrahmen</a> |  <a href="#" target="_blank">Nasser-Eddine Monir .</a>    

    </p>
</footer>
        
    </body>
</html>