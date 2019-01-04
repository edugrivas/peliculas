<?php
    $mensaje="";
    include_once './config/config.php';
	session_start();
        if(isset($_SESSION['login'])){
            header("Location:./registrado/misPeliculas.php");
        }
    // Recibimos los datos del formulario de autenticacin.
    if(isset($_POST['entra'])){ // Han pulsado entrar
        // Conectamos con la BD
        $conexion=  mysqli_connect($host, $user, $password, $DB);
        $login=  mysqli_real_escape_string($conexion,$_POST['login']);
        $pass=  mysqli_real_escape_string($conexion,$_POST['password']);
      
        $consulta= "Select * from usuarios where login='$login' and password=PASSWORD('$pass');";
        $datos=  mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        //Validación de autenticación
        if(mysqli_num_rows($datos)==1){ //Autenticacion válida
           //Comprobamos que el usuario esté activo
        $array= mysqli_fetch_array($datos);
        if($array['estado']=="activado"){
            //Si está activo, creamos las variables de sesion para autenticar
            $_SESSION['login']=$array['login'];
            $_SESSION['rol']=$array['rol'];
            header("Location:./registrado/misPeliculas.php");
            //Si no está activo, le decimos que no está activado
        }elseif($array['estado']=='desactivado'){
            $mensaje="<br><font color=#FE1C1C>El usuario está desactivado, póngase en contacto con el administrador.</font>";
        }
        
        }else{
            $mensaje="<br><font color=#FE1C1C>Error en la autenticación.</font>";
        }
    }
 
 if(isset($_POST['registro'])){ // Han pulsado registrarse
        // Conectamos con la BD
        $conexion=  mysqli_connect($host, $user, $password, $DB);
        $login= mysqli_real_escape_string($conexion,$_POST['login']);
        $pass=  mysqli_real_escape_string($conexion,$_POST['password']);
        $nombre=  mysqli_real_escape_string($conexion,$_POST['nombre']);
        $apellidos=  mysqli_real_escape_string($conexion,$_POST['apellidos']);
        $email=  mysqli_real_escape_string($conexion,$_POST['email']);
        $comprobar="Select * from usuarios where login='$login';";
        $consulta= "INSERT INTO `usuarios` (`login`, `password`, `nombre`, `apellidos`, `rol`, `email`, `estado` ) VALUES ('$login', PASSWORD('$pass'), '$nombre', '$apellidos', 'registrado', '$email','desactivado');";
            $consultacomprobar=  mysqli_query($conexion, $comprobar) or die(mysqli_error($conexion));
                if(mysqli_num_rows($consultacomprobar)!=0){
                    $mensaje="<br><font color=#FE1C1C>El usuario ya existe</font>";
                }else{
                    $datos=  mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                }

  }

            

?>
<!https://codepen.io/colorlib/pen/rxddKy>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Peliculas</title>
        
        <link type="text/css" rel="stylesheet" href="./css/estilos.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="./javascript/javascript.js"></script>
    </head>
    <div class="login-page">
      <div class="form">
        <form class="register-form" method="POST" onsubmit="return registrarse(this);">
            <input type="text" placeholder="login" name="login" required/>
          <input type="password" placeholder="password" name="password" required/>
          <input type="text" placeholder="nombre" name="nombre" required/>
          <input type="text" placeholder="apellidos" name="apellidos" required/>
          <input type="text" placeholder="email" name="email" required/>
          <button type="submit" name="registro">crear</button>
          <p class="message">¿Ya estás registrado? <a href="#">Sign In</a></p>
        </form>
          <form class="login-form" method="POST">
          <input type="text" placeholder="login" name="login" required/>
          <input type="password" placeholder="password" name="password" required/>
          <button type="submit" name="entra">login</button>
          <p class="message">¿No estás registrado? <a href="#">Crear una cuenta</a></p>
          <?php echo $mensaje; ?>
        </form>
      </div>
    </div>
</html>