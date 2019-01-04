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
    <li><a href="./misPeliculas.php">Mis Peliculas</a></li>
    <li><a class="active" href="./misSeries.php">Mis Series</a></li>
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
        $consultaMisSeries="SELECT * FROM `usuarioseries` where login='$login';";
        $datosMisSeries=mysqli_query($conexion, $consultaMisSeries) or die(mysqli_error($conexion));
        echo "<table witdh='50%'>"
            . "<tr>";
        while($arrayDeDatosMisSeries = mysqli_fetch_array($datosMisSeries)){
            $id=$arrayDeDatosMisSeries['id'];
            $consultaSerie="SELECT nombre,ruta FROM `series` where id='$id'";    
            $datosPelicula=mysqli_query($conexion, $consultaSerie) or die(mysqli_error($conexion));
            $arrayDeDatosSerie=mysqli_fetch_array($datosPelicula);
            $ruta=$arrayDeDatosSerie['ruta'];
            $nombre=$arrayDeDatosSerie['nombre'];
            if($contador==4){
                $contador=0;
                echo "</tr>";
                echo "<tr>";
            }
            ++$contador;
            echo "                 

                   <td>
                   
                    <a href='./watch.php?id=$id&type=serie'><img width='201px' height='298px' src='$ruta'/></a><br>
                    <center><a href='./watch.php?id=$id&type=serie'>$nombre</a></center>
                        
                   </td>
                    
                    
             "; 
            
       
           }
        echo "</tr></table>";
        
                
       
    
    ?>
    
</div>   
    
    
</body>
</html>