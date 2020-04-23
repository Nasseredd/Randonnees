<?php
require_once './database/database.php' ;
$database = new database();
session_start();
if (isset($_GET['id'])) {
     $_SESSION['id'] = $_GET['id'];
}
$data['id']=$_SESSION['id'] ;
$rand=$database->afficherUneRandonnee($data);

 
 if (isset($_POST['submit'])) {
     // vérification des champs marqués avec (*)
    //cette partie est égalment traitée avec javascript
     if (empty($_POST['titre']) || empty($_POST['resume']) || empty($_POST['distance'])) {
      $_SESSION['champsAvecEtoiles']= ' 
        <div class="alert " id="err"  >
            vous devez remplir au moins tous les champs marqués avec (*)!
       </div>
      ';
      $database->redirect('./modifier.php');
      return;
    }

        $data['titre']=$_POST['titre'];
        $data['resume']=$_POST['resume'];
        $data['description']=$_POST['description'];
        $data['duree_m']=$_POST['duree_m'];
        $data['difficulte']=$_POST['difficulte'];
        $data['distance']=$_POST['distance'];
        $data['denivele_pos']=$_POST['denivele_pos'];
        $data['denivele_neg']=$_POST['denivele_neg'];
        $data['img']= $_FILES['img']['name'];

        //traitement pour envoyer l'image à notre serveur :
        $name = $_FILES['img']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES['img']['name']);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
        move_uploaded_file($_FILES['img']['tmp_name'],$target_dir.$name);

        $database->modifierUneRandonnee($data);

}
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Randonnées de l'Isère</title>
			<link rel="stylesheet" href="styles/navbar.css" >
            <link rel="stylesheet" href="styles/index.css" >
            <link rel="stylesheet" href="styles/add.css" >
            <link rel="stylesheet" href="styles/contenu.css" >


            <script src="script_modifier.js"></script>

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
    <title>Ajouter une randonnee</title>
     
  </head>
  <body>
  
   <section id="tooltip">
			<div class="container">
                         <div class="form-style-10">
<h1>Modier une randonnee !<span>Les champs avec (*) sont obligatoires :</span></h1>
 <?php 
                if(isset( $_SESSION['champsAvecEtoiles']) ){
                echo  $_SESSION['champsAvecEtoiles'] ;
                unset( $_SESSION['champsAvecEtoiles']);
                }             
          ?>
          <br/>

          <strong id="text1"></strong> <br/>
          <sub id="text2"></sub><br/>
         <sub id="text3"></sub>
       
<form method="post" enctype="multipart/form-data"  id="myform"  onsubmit="return validateform();">
   <br/> <div class="section"><span>1</span>Titre & resumé de la randonné<em></em></div>
    <div class="inner-wrap">
        <label>*Titre : <input type="text" name="titre" value="<?php echo $rand->titre;?>"/></label>
        <label>*Resumé : <textarea class="resume" name="resume" ><?php echo $rand->resume;?></textarea></label>
    </div>

    <div class="section"><span>2</span>Description de la randonnée :</div>
    <div class="inner-wrap">
    <label>Description : <textarea name="description"><?php echo $rand->description;?></textarea></label>
     </div>

    <div class="section"><span>3</span>Durée moyenne & dificultée</div>
        <div class="inner-wrap">
        <label>*Durée moyenne :<br/><sub>en (heure)</sub> <input id="duree_m" type="text" name="duree_m" value="<?php echo $rand->duree_m;?>"/></label>
        <label>Dificultée: </label>
        <select name="difficulte" >
            <option value="<?php echo $rand->difficulte;?>"  selected disabled hidden> 
                 <?php echo $rand->difficulte;?>
            </option> 
            <option value="Facile">Facile</option>
            <option value="moyenne">moyenne</option>
            <option value="Difficile">Difficile</option>
        </select>
    </div>

    <div class="section"><span>4</span>Distance & dénivelés</div>
        <div class="inner-wrap">
        <label>*Distance : <br/><sub>en (m)</sub> : <input id="dist" type="text" name="distance" value="<?php echo $rand->distance;?>" /></label>
        <label>*Dénivelés positifs : <br/><sub>en (m)</sub> : <input id="denivele_pos" type="text" name="denivele_pos" value="<?php echo $rand->denivele_pos;?>"/></label>
        <label>*Dénivelés négatifs : <br/><sub>en (m)</sub> : <input id="denivele_neg" type="text" name="denivele_neg" value="<?php echo $rand->denivele_neg;?>"/></label>

    </div>
    <div class="section"><span>5</span>Modifier la photo :</div>
        <div class="inner-wrap">
        <label>Modifier la photo :<br/> <input type="file"  name="img" value="<?php echo $rand->img;?>"></label>
        </div>
    <div class="button-section">
     <input type="submit" name="submit" value="Modifier" />
      
    </div>
</form>
</div>
		</section>
     
  </body>
</html>