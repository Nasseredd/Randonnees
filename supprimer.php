<?php
require_once './database/database.php' ;
$database = new database();
session_start();
$data['id']=$_GET['id'];
$database->supprimerUneRandonnee($data);
?>