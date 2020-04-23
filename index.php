<?php
	session_start();
?>
<html>
    <head>
			<title>Randonnées de l'Isère</title>
			<link rel="stylesheet" href="styles/navbar.css" >
			<link rel="stylesheet" href="styles/index.css" >

		
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
									<li><a href="#">Bonjour  '.$_SESSION['admin'].' </a>
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

	<!-- TOOLTIP  -->

		<section id="tooltip">
			<div class="container">
						<h1 data-anime="scroll">Géographie de l'Isère</h1>
							<div class="wrapper" data-anime-top="scroll-top">
							<p>
								L’Isère est un département français composé de 521 communes, et ayant pour préfecture la ville de Grenoble.
								Elle est entourée de sept départements : la Drôme au sud-ouest, l’Ardèche, la Loire et le Rhône à l’ouest,
								l’Ain au nord ; la Savoie au nord-est et les Hautes-Alpes au sud-est. Le département ne dispose pas d’accès à la mer.
								D’une superficie de 7 431 km2, le département est le plus grand de la région Rhône-Alpes et le dixième plus grand département de
								France métropolitaine se classant ainsi derrière les Pyrénées-Atlantiques et devant l’Yonne.
							</p>

							<p>
								Les points extrêmes du département se situent au nord à Vertrieu, au sud à Tréminis,
								à l’ouest à Saint-Alban-du-Rhône et à l’est à Saint-Christophe-en-Oisans. Le département fait 150 km dans sa plus grande 
								longueur et 135 km dans sa plus grande largeur. Dans sa plus grande majorité la limite du département est naturelle, 
								elle est formée soit par des rivières, ou des montagnes. Une petite partie de cette frontière est artificielle, 
								c'est-à-dire tracée par l'homme à travers champs par des lignes conventionnelles.
							</p>

							<p>
							de la Chartreuse, Vercors, et Diois à l’extrême sud du département) ainsi que le relief du massif du Jura qui fait une incursion
							dans le département via le plateau du Grand-Ratz qui se termine à Voreppe. Le point culminant du département est 
							le Pic Lory avec ses 4 088 m d’altitude. À l'inverse le point le plus bas se trouve sur 
							la commune de Sablons (vallée du Rhône) et culmine à 134 m. Ce vaste département a un rôle charnière entre 
							les plaines du Rhône et les massifs des Alpes du Nord. 
							</p>

								<img src="./images/1ind.png" alt="">

							<p>En 2010, l’Isère compte 1 206 375 habitants répartis de façon non-homogène sur son territoire. En effet, le relief du département,
							avec notamment la présence des Alpes fait que la population et les grandes villes sont concentrées dans les vallées, notamment 
							la vallée du Grésivaudan, ainsi que dans les plaines rhodaniennes, aux portes de Lyon. </p>    

					</div>
					</div>
		</section>
     

 <footer>
    <p class="main">
        2020 ©  | Tous droits réservés |  by <a href="https://www.linkedin.com/in/abderrahmen-meliani-bb10b6176/" target="_blank">MELIANI Abderrahmen</a> |  <a href="#" target="_blank">Nasser-Eddine Monir .</a>    
    </p>
</footer>
        
    </body>
</html>