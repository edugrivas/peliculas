<?php
    session_start();
    if(!isset($_SESSION['login'])){
    header('Location:../index.php');
}

    include_once '../config/config.php';
	    
    $contador=0;
            

?>

<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
    <script src="../javascript/javascript.js"></script>
</head>
<body style="background: #f3f3f3">

<ul>
    <li><a href="./misPeliculas.php">Mis Peliculas</a></li>
    <li><a href="./misSeries.php">Mis Series</a></li>
    <li><a class="active" href="./buscar.php">Buscar</a></li>
    <li id="cerrar"><a href="../salir.php">Cerrar sesión</a></li>
    <?php if($_SESSION['rol']=="administrador"){echo "<li><a href='../administrador/menu.php'>Administración</a></li>";} ?>
    <li id="cerrar"><a  href="./cambiaPassword.php">Cambiar password</a></li>
    
</ul>
<div id="peliculas">
 <form class="w3-container w3-card-4" style="width: 50%; height: 5%; padding-bottom:25px" action="" method="POST">   
    <br>
     <select class="w3-select w3-border" name="option">
    <option value="" disabled selected>Elige una opción</option>
    <option value="pelicula">Pelicula</option>
    <option value="serie">Serie</option>
  </select>
  <br>
  <br>
  Nombre: <input style="height: 40px" name="nombre"/>
    <button style="height: 40px" type="submit" name="buscar" value="Buscar" class="w3-btn w3-teal">Buscar</button>
    </form>
    
<?php

         if(isset($_POST['buscar'])){   
          //Ponemos los datos de la conexion con la base de datos
        $conexion=  mysqli_connect($host, $user, $password, $DB);
        $peliculaOserie=$_POST['option'];
        $nombre=mysqli_real_escape_string($conexion,$_POST['nombre']);
        
        
        
         if($peliculaOserie=="pelicula"){
                $consulta= "SELECT * FROM `peliculas` where nombre like '%$nombre%';";
                $tipo="film";
            }else{
                $consulta= "SELECT * FROM `series` where nombre like '%$nombre%';";
                $tipo="serie";
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
                   
                    <a href='./watch.php?id=$id&type=$tipo'><img width='201px' height='298px' src='$ruta'/></a><br>
                    <center><a href='./watch.php?id=$id&type=$tipo'>$nombre</a></center>
                        
                   </td>
                    
                    
             "; 
            
       
           }
        echo "</tr></table>";
        
         }
                
   
    
    
    ?>
    
    </div>

</body>
</html>