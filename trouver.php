<?php
require_once './database/database.php' ;
session_start();
$database = new database();
$filtre=false ;
if (isset($_POST['submit'])) {
    $data['duree_m'] = $_POST['duree_m'];
    $data['distance']= $_POST['distance'];
    $data['denivele_pos']= $_POST['denivele_pos'];
    $data['denivele_neg']= $_POST['denivele_neg'];
    $filtre=true ;
}

?>
<html>
    <head>
		<title>Randonnées de l'Isère</title>
		<link rel="stylesheet" href="styles/navbar.css" >
		<link rel="stylesheet" href="styles/contenu.css" >
        <script src="script_trouver.js"></script>
 
    
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
        <h2>Trouver une randonnee :</h2>
        <strong id="ilyaqlq"></strong>
        <sub id="err_duree"></sub>
        <sub id="err_duree2"></sub>

        <form method="post" id="myform"  onsubmit="return validateform();"> 
            <div class="wrap">
                <div class="search">
                    <input id="duree_m" type="text" class="searchTerm"  placeholder="Duree maximum en heure" name="duree_m">
                     <input id="dist" type="text" class="searchTerm" placeholder="Distance maximum en KM" name="distance">
                    <input id="denivele_pos"  type="text" class="searchTerm" placeholder="Dénivelés positifs en m" name="denivele_pos">
                    <input id="denivele_neg"  type="text" class="searchTerm" placeholder="Dénivelés négatifs en m" name="denivele_neg">
                </div>
            </div>
            <input class="button" type="submit" value="Filtrer" name="submit">  
        </form>
 
 

       
                         <?php
                            if ($filtre==true) {
                                $database->filtrerDesRandonnees($data);
                                if (empty($_POST['duree_m']) ||empty($_POST['distance']) ||empty($_POST['denivele_pos'])|| empty($_POST['denivele_neg'])) {
                                        echo '
                                         
                                        <div class="alert " id="recherche"  >
                                            <p>     vous devez préciser tous les critere dans votre recherche !  </p> 
                                        </div>
                                    
                                        
                                        ';
                                }
                            }else{
                                $database->afficherResume();
                            }
 						?>
  
 <footer>
    <p class="main">
    2020 ©  | Tous droits réservés |  by <a href="https://www.linkedin.com/in/abderrahmen-meliani-bb10b6176/" target="_blank">MELIANI Abderrahmen</a> |  <a href="#" target="_blank">Nasser-Eddine Monir .</a>    
    </p>
</footer>
        
    </body>
</html>