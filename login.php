 <?php
require_once './database/database.php' ;
session_start();

$database = new database();
$data=array();
//vérification des deux champs
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['pass'])) {
		echo '
			<div class="alert ">
					vous devez remplir les deux champs !
			</div>
		';
	}else{
	 $data['username']=$_POST['username'];
	 $data['pass']=$_POST['pass'];

	 if ($database->login($data)) {
		$_SESSION['admin'] =$data['username'];
		$database->redirect('./index.php');
	}else{
		$_SESSION['nadmin'] ="non";
	}
	}

  }

?>
 <html>
     <head>
            <link rel="stylesheet" href="styles/conn.css" >
     </head>
     <body>
		
	 <form action="login.php" method="post"> 
            Identifiant : <input type="text" size="16" name="username" />  
            <br/>Mot de passe : <input type="password" size="16" name="pass" /> 
			<button type="submit" name="submit">login to your account</button>     
		
		</form>	
		
		<?php
			if (isset($_SESSION['nadmin'] )) {
				echo '
				<div class="alert " id="err" role="alert">
					vous ne pouvez pas vous connecter en tant que admin !
				</div>
			';
			unset($_SESSION['nadmin']);
			}
		?>
 
     </body>
 
 
</html>
 