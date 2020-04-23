<?php
    //se déconncter en tant que admin :
    require_once './database/database.php' ;
    $database = new database(); 
    session_start();
    session_destroy();
    $database->redirect('./index.php');


?>