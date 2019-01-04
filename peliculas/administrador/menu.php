<?php
  session_start();
include_once '../config/config.php';
seguridad('administrador');
    
        
        
        
?>

<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
    <script src="../javascript/javascript.js"></script>
        
        
        <style>
.vertical-menu {
    width: 200px;
}

.vertical-menu a {
    background-color: #eee;
    color: black;
    display: block;
    padding: 12px;
    text-decoration: none;
}

.vertical-menu a:hover {
    background-color: #ccc;
}

.vertical-menu a.active {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body style="background: #f3f3f3">

<ul>
    <li><a href="../registrado/misPeliculas.php">Mis Peliculas</a></li>
    <li><a href="../registrado/misSeries.php">Mis Series</a></li>
    <li><a href="../registrado/buscar.php">Buscar</a></li>
    <li><a class='active' href='./menu.php'>Administración</a></li>
    <li id="cerrar"><a href="../salir.php">Cerrar sesión</a></li>
    <li id="cerrar"><a href="../registrado/cambiaPassword.php">Cambiar password</a></li>
  
</ul>
<div id="peliculas">
    
    
    <h1>Administración</h1>

<div class="vertical-menu">
    <a href="./borrarPeliculas.php">Borrar películas/series</a>
    <a href="./gestionaUsuarios.php">Gestinar usuarios</a>
    <a href="./subir.php">Subir</a>
</div>
    
    
</div>
   
        
</body>
</html>