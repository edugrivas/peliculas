<?php
session_start();
include_once '../config/config.php';
seguridad('administrador');

if(isset($_GET['borrar'])){
    
    $id=$_GET['borrar'];
    $tipo=$_GET['type'];
    
    
    $conexion=  mysqli_connect($host, $user, $password, $DB);
    
   
    if($tipo=="film"){
        $selectRuta="SELECT ruta FROM `peliculas` where id='$id'";
        $borrar="DELETE FROM `peliculas` WHERE `id` = $id;";
                
    }else{
        $selectRuta="SELECT ruta FROM `series` where id='$id'";
        $borrar="DELETE FROM `series` WHERE `id` = $id;";   
        
    }
    
    
    $datos=mysqli_query($conexion, $selectRuta) or die(mysqli_error($conexion));
   
    while($row = mysqli_fetch_array($datos)){
        $rutaBorrar=$row['ruta'];
    }
        
    unlink("$rutaBorrar");
    
    mysqli_query($conexion, $borrar) or die(mysqli_error($conexion));
           
}

    



    
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="../javascript/javascript.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
    
    
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
    
    <form class="w3-container w3-card-4" style="width: 50%; padding-bottom:25px" action="" method="POST">   
        <br>
    <select class="w3-select w3-border" name="option">
    <option value="" disabled selected>Elige una opción</option>
    <option value="pelicula">Pelicula</option>
    <option value="serie">Serie</option>
  </select>
  <br>
  <br>
  Nombre: <input style="height: 40px" name="nombre"/>
    <button type="submit" name="buscar" value="Buscar" class="w3-btn w3-teal">Buscar</button><br>
    </form>
    
<?php

         if(isset($_POST['buscar'])){   
          //Ponemos los datos de la conexion con la base de datos
        $conexion=  mysqli_connect($host, $user, $password, $DB);
        $peliculaOserie=$_POST['option'];
        $nombre=$_POST['nombre'];
        
        
        
         if($peliculaOserie=="pelicula"){
                $consulta= "SELECT * FROM `peliculas` where nombre like '%$nombre%';";
                $tipo=film;
            }else{
                $consulta= "SELECT * FROM `series` where nombre like '%$nombre%';";
                $tipo=serie;
            }
        $datos=mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        
        
         echo "<table witdh='50%'>"
            . "<tr>";
        while($arrayDeDatos = mysqli_fetch_array($datos)){
            $id=$arrayDeDatos['id'];
            $ruta=$arrayDeDatos['ruta'];
            $nombre=$arrayDeDatos['nombre'];
            if($contador==4){
                $contador=0;
                echo "</tr>";
                echo "<tr>";
            }
            ++$contador;
            echo "                 

                   <td>
                   
                    <a href='../registrado/watch.php?id=$id&type=film'><img width='201px' height='298px' src='$ruta'/></a><br>
                    <center>$nombre</center>
                    <center><a class='btn btn-danger' href='./borrarPeliculas.php?borrar=$id&type=$tipo'>Borrar</a></center>
                   </td>
                    
                    
             "; 
            
       
           }
        echo "</tr></table>";
        
         }
                
   
    
    
    ?>
    
    
    
    </div>

</body>
</html>