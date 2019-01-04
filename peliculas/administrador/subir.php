<?php
session_start();
include_once '../config/config.php';
seguridad('administrador');

if(isset($_POST['enviar'])){
    
    $conexion=  mysqli_connect($host, $user, $password, $DB);
    
    $peliculaOserie=$_POST['option'];    
    
    if($peliculaOserie=="pelicula"){
        $ruta="../fotosPeliculas/";
        $consultaIdPeliculaOSerie= "SELECT count(id) as total FROM `peliculas`;";
        
    }else{
        $ruta="../fotosSeries/";
        $consultaIdPeliculaOSerie= "SELECT count(id) as total FROM `series`;";
        
    }
    $datos=mysqli_query($conexion, $consultaIdPeliculaOSerie) or die(mysqli_error($conexion));
    $idParaNombre = mysqli_fetch_array($datos);
    $idParaNombre=$idParaNombre['total'];
    if($idParaNombre==0){
        $idParaNombre=1; 
        
    }else{
       
       ++$idParaNombre;
    }
    
    
    
    $nombre=mysqli_real_escape_string($conexion,$_POST['nombre']);
    $sinopsis=mysqli_real_escape_string($conexion,$_POST['sinopsis']);
    
    
    $archivo=$_FILES['imagen']['tmp_name'];
    
    
    
    
    $ruta=$ruta.$nombre.$idParaNombre;
    
    move_uploaded_file($archivo,$ruta);
    
    if($peliculaOserie=="pelicula"){
        $consulta= "INSERT INTO `peliculas` (`id`, `nombre`, `sinopsis`, `ruta`) VALUES (NULL, '$nombre', '$sinopsis', '$ruta');";
    }else{
        $consulta= "INSERT INTO `series` (`id`, `nombre`, `sinopsis`, `ruta`) VALUES (NULL, '$nombre', '$sinopsis', '$ruta');";
    }
           
    mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        
           
}




?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
    <script src="../javascript/javascript.js"></script>
    
    
    <style type="text/css"> 
                a:link 
                { 
                text-decoration:none; 
                } 
                a:hover{
                    color:white;
                }
        </style>
    
</head>
<body style="background: #f3f3f3">

<ul>
    <li><a href="../registrado/misPeliculas.php">Mis Peliculas</a></li>
    <li><a href="../registrado/misSeries.php">Mis Series</a></li>
    <li><a href="../registrado/buscar.php">Buscar</a></li>
    <li><a class="active" href='./menu.php'>Administración</a></li>
    <li id="cerrar"><a href="../salir.php">Cerrar sesión</a></li>
    <li id="cerrar"><a href="../registrado/cambiaPassword.php">Cambiar password</a></li>
</ul>
<div id="peliculas">
    
    
  
<form class="w3-container w3-card-4" enctype="multipart/form-data" action="" method="POST">
  <h3>Selecciona qué quieres subir.</h3>

  <select class="w3-select w3-border" name="option">
    <option value="" disabled selected>Elige una opción</option>
    <option value="pelicula">Pelicula</option>
    <option value="serie">Serie</option>
  </select>
  <br>
  <br>
  Nombre: <input name="nombre"/>
  <br>
  <br>
  Sinopsis: <input name="sinopsis"/>
  <br>
  <br>
  <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
    Enviar este fichero: <input name="imagen" type="file" />
    <p><button type="submit" name="enviar" value="Subir" class="w3-btn w3-teal">Subir</button></p>
</form>
    
    
    </div>

</body>
</html>