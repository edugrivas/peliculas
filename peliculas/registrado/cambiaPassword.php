<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location:../index.php');
}

include_once '../config/config.php';

        $mensajeError="";
        $mensajeOk="";
if(isset($_POST['botonCambioContrasena'])){ // Han pulsado cambiar contraseña
        // Conectamos con la BD
        
        $conexion=  mysqli_connect($host, $user, $password, $DB);
        $oldPass=mysqli_real_escape_string($conexion,$_POST['password']);
        $newPass=mysqli_real_escape_string($conexion,$_POST['password1']);
        $usuario=$_SESSION['login'];             
         $consultaComprobarContrasena= "select * from usuarios where login='$usuario' and `password`=PASSWORD('$oldPass');";
        $consultaComprobarContrasena=  mysqli_query($conexion,  $consultaComprobarContrasena) or die(mysqli_error($conexion));
        if(mysqli_num_rows($consultaComprobarContrasena)==1){
            $consultaCambiarContrasena= "UPDATE `usuarios` SET `password` =PASSWORD('$newPass') WHERE `login` = '$usuario' and 'password'!=PASSWORD('$newPass');"; 
            $datosCambiarContrasena=  mysqli_query($conexion, $consultaCambiarContrasena) or die(mysqli_error($conexion));
            if (mysqli_affected_rows($conexion)==1){
                $mensajeOk="Contraseña cambiada con exito";
            }else{
                $mensajeError="La nueva contraseña es la misma que tu antigua contraseña";

            }
            echo $consultaCambiarContrasena;
        }else{
          $mensajeError="La contraseña es incorrecta";  
            
        }
        
        




  }
?>
<!DOCTYPE html>
<html>
<head>
        <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
        <script src="../javascript/javascript.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        

</head>
<body style="background: #f3f3f3">
<ul>
    <li><a href="./misPeliculas.php">Mis Peliculas</a></li>
    <li><a href="./misSeries.php">Mis Series</a></li>
    <li><a href="./buscar.php">Buscar</a></li>
    <?php if($_SESSION['rol']=="administrador"){echo "<li><a href='../administrador/menu.php'>Administración</a></li>";} ?>
   <li id="cerrar"><a href="../salir.php">Cerrar sesión</a></li>
   <li id="cerrar"><a class="active" href="./cambiaPassword.php">Cambiar password</a></li>
  
</ul>
<div id="peliculas">
    <form class="w3-container w3-card-4" style="width: 50%; padding-bottom:25px" action="" onsubmit="return cambiarContrasena(this);" method="POST">   
        <br>
               Contraseña actual<input style="display: block;" type="password" name="password" required/><br>
               Nueva contraseña <input style="display: block;" type="password" name="password1" required/><br>
               Confirmar nueva contraseña <input style="display: block;" type="password" name="password2" required/><br>
                             
              <input type="submit" name="botonCambioContrasena" value="Cambiar Contraseña"/>
              <?php echo "<br><font color='red'>$mensajeError</font>";
                    echo "<br><font color='green'>$mensajeOk</font>";
              ?> 
    </form>
              
    
    </div>

</body>
</html>