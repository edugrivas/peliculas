<?php

//Credenciales del usuario con privilegios sobre la bd
$host="localhost";
$user="root";
$password="Admin123";
$DB="peliculas";

function seguridad($rol){
    session_start();
    if(!isset($_SESSION['login'])||$_SESSION['rol']!=$rol){
    header('Location:../index.php');        
    }
    
}

?>