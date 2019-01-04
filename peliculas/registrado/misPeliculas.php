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
    <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
    <script src="../javascript/javascript.js"></script>
</head>
<body style="background: #f3f3f3">
   
<ul>
    <li><a class="active" href="./misPeliculas.php">Mis Peliculas</a></li>
    <li><a href="./misSeries.php">Mis Series</a></li>
    <li><a href="./buscar.php">Buscar</a></li>
    <?php if($_SESSION['rol']=="administrador"){echo "<li><a href='../administrador/menu.php'>Administración</a></li>";} ?>
					
    <li id="cerrar"><a href="../salir.php">Cerrar sesión</a></li>
    <li id="cerrar"><a href="./cambiaPassword.php">Cambiar password</a></li>
   
</ul>
   
<div id="peliculas">
    
<?php
          //Ponemos los datos de la conexion con la base de datos
        $conexion=  mysqli_connect($host, $user, $password, $DB);
        $login=$_SESSION['login'];
        $consultaMisPeliculas="SELECT * FROM `usuariopeliculas` where login='$login';";
        $datosMisPeliculas=mysqli_query($conexion, $consultaMisPeliculas) or die(mysqli_error($conexion));
        
        
         echo "<table witdh='50%'>"
            . "<tr>";
        while($arrayDeDatosMisPeliculas = mysqli_fetch_array($datosMisPeliculas)){
            $id=$arrayDeDatosMisPeliculas['id'];
            $consultaPelicula="SELECT nombre,ruta FROM `peliculas` where id='$id'";    
            $datosPelicula=mysqli_query($conexion, $consultaPelicula) or die(mysqli_error($conexion));
            $arrayDeDatosPelicula=mysqli_fetch_array($datosPelicula);
            $ruta=$arrayDeDatosPelicula['ruta'];
            $nombre=$arrayDeDatosPelicula['nombre'];
            if($contador==5){
                $contador=0;
                echo "</tr>";
                echo "<tr>";
            }
            ++$contador;
            
            echo "                 

                   <td>
                   
                    <a href='./watch.php?id=$id&type=film'><img width='201px' height='298px' src='$ruta'/></a><br>
                    <center><a href='./watch.php?id=$id&type=film'>$nombre</a></center>
                        
                   </td>
                    
                    
             "; 
            
       
           }
        echo "</tr></table>";
        
        
                
   
    
    
    ?>
    
    </div>

</body>
</html>