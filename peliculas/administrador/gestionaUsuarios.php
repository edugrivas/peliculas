<?php
session_start();
include_once '../config/config.php';
seguridad('administrador');

if(isset($_GET['borrar'])){
        $conexion=  mysqli_connect($host, $user, $password, $DB);        
        $login= mysqli_real_escape_string($conexion,$_GET['borrar']);         
        $consulta= "DELETE FROM `usuarios` WHERE `usuarios`.`login` ='$login';";
        $datos=  mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        
    
}


if(isset($_GET['activar'])){
        $conexion=  mysqli_connect($host, $user, $password, $DB);        
        $login= mysqli_real_escape_string($conexion,$_GET['activar']);         
        $consulta= "UPDATE `usuarios` SET `estado` = 'activado' WHERE `usuarios`.`login` = '$login';";
        $datos=  mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        
    
}

if(isset($_GET['desactivar'])){
        $conexion=  mysqli_connect($host, $user, $password, $DB);        
        $login= mysqli_real_escape_string($conexion,$_GET['desactivar']);         
        $consulta= "UPDATE `usuarios` SET `estado` = 'desactivado' WHERE `usuarios`.`login` = '$login';";
        $datos=  mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
     
    
}


//    if(isset($_SESSION['login'])){
//        header("Location:../index.php");}


    
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
    <script src="../javascript/javascript.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
    
    
  <?php 
                
                //Cargar los usuario
        $conexion=  mysqli_connect($host, $user, $password, $DB);      
        $consultaUsuarios= "Select * from usuarios;";
        $datosUsuarios=  mysqli_query($conexion, $consultaUsuarios) or die(mysqli_error($conexion));
        //Comprobamos si hay anuncios, si es así, los mostramos
        if(mysqli_num_rows($datosUsuarios)==0){
            $mensajeUsuario="No hay ningún usuario";
        }else{
                echo "<table class='table table-bordered'>
                    <tr>
                    <th>Login</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Estado</th>
                    </tr>";
                
            while($row = mysqli_fetch_array($datosUsuarios)){
          
                echo "<tr>";
                echo "<td>" . $row['login'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellidos'] . "</td>";
                echo "<td>" . $row['rol'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['estado'] . "</td>";
                    if($row['estado']=='activado'){
                        echo "<td>" . "<a href='?desactivar=$row[login]'><button>Desactivar</button></a>" . "</td>";
                    }else{
                        echo "<td>" . "<a href='?activar=$row[login]'><button>Activar</button></a>" . "</td>";
                    }
                echo "<td>" . "<a href='?borrar=$row[login]'><button>Borrar</button></a>" . "</td>";
                echo "</tr>";
}   

            }
                echo "</table>";
                echo $mensajeUsuario;
                ?>
    
    
    </div>

</body>
</html>
          