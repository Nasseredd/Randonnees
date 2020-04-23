<?php
require_once './database/database.php' ;
$database = new database();
session_start();
$data['id']=$_GET['id'];
$rand=$database->afficherUneRandonnee($data);
  
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Randonnées de l'Isère</title>
		      	<link rel="stylesheet" href="styles/navbar.css" >
            <link rel="stylesheet" href="styles/index.css" >
            <link rel="stylesheet" href="styles/add.css" >
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
    <title>Ajouter une randonnee</title>
     
  </head>
  <body>
  
   <section id="tooltip">
			<div class="container">
        <div class="form-style-10">
          <h1><?php echo $rand->titre ; ?></span></h1>
          <br/>
           <?php 
           if (isset($_SESSION['updated'])) {
            echo $_SESSION['updated'] ;
            unset($_SESSION['updated']);
          }
                if (isset($_SESSION['admin'])) {
                  echo '<a href="./modifier.php?id='.$data['id'].'"  title="modifier une randonnee"> <img src="./images/modf.jpg" alt=""  class ="mod" 	 width= 50px;
                  ></a> ';
                  echo '<a href="./supprimer.php?id='.$data['id'].'"   title="suppimer une randonnee"> <img src="./images/supp.jpg" alt=""  class ="mod" 	 width= 50px;
                  ></a> ';

                  echo '<br/> <br/> <br/>' ;

                }
            ?>
          <div class="section"><span>1</span>Titre & resumé de la randonné<em></em></div>
          <div class="inner-wrap">
            <label><h2><?php echo $rand->titre ; ?></h2>  </label>
            <label>   <p><?php echo $rand->resume ; ?></p> </label>
          </div>

          <div class="section"><span>2</span>Description de la randonnée :
          </div>
          <div class="inner-wrap">
              <label> <p><?php echo $rand->description ; ?></p>  </label>
          </div>

          <div class="section"><span>3</span>Queslques informations pratiques :</div>
              <div class="inner-wrap">
        
                <table class="matable">
                  <tbody>
                    <tr>
                      <th><img src="./images/chrono.png" alt="" value="durée moyenne" width="50" title="durée moyenne"></th>
                      <th><img src="./images/dpos.png" alt="" title="Denivelé positif" width="50"></th>
                      <th><img src="./images/dneg.png" alt="" title="Denivelé négatif" width="50"></th>
                      <th><img src="./images/diff.png" alt="" title="Difficulté" width="50"></th>
                      <th><img src="./images/dist.png" alt="" title="Distance" width="50"></th>
                    </tr>
                    <tr>
                      <td><?php echo $rand->duree_m.' h' ; ?></td>
                      <td><?php echo $rand->denivele_pos.' m' ; ?></td>
                      <td><?php echo $rand->denivele_neg.' m' ; ?></td>
                      <td><?php echo $rand->difficulte ; ?></td>
                      <td><?php echo $rand->distance.' KM' ; ?></td>
                    </tr>
                    
                  </tbody>
                </table>
      
              </div>

              <div class="section"><span>4</span>Photo :</div>
                <div class="inner-wrap">
                   <img src="./images/<?php echo $rand->img ; ?>" alt="" width="700px">
                </div>
              </div>
      </div>
    
		</section>
     
  </body>
</html>