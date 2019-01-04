<?php
    session_start();
    if(!isset($_SESSION['login'])){
    header('Location:../index.php');
}
    
    
        include_once '../config/config.php';
        $id=$_GET['id'];
        $tipo=$_GET['type'];
        $conexion=mysqli_connect($host, $user, $password, $DB);
        if($tipo=="film"){
        $consulta="SELECT * FROM `peliculas` where id='$id';";
        }else{
        $consulta="SELECT * FROM `series` where id='$id';";    
        }
        $datos=mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        
        $datos = mysqli_fetch_array($datos);       
        $nombre=$datos['nombre'];
        $sinopsis=$datos['sinopsis'];
        $ruta=$datos['ruta'];
        
        if(isset($_POST['add'])){
            $conexion=mysqli_connect($host, $user, $password, $DB);
            $login=$_SESSION['login'];
            if($tipo=="film"){
            $insertar="INSERT INTO `usuariopeliculas` (`login`, `id`) VALUES ('$login', '$id');";
            }else{
            $insertar="INSERT INTO `usuarioseries` (`login`, `id`) VALUES ('$login', '$id');";    
            }
            mysqli_query($conexion, $insertar) or die(mysqli_error($conexion));
        }
        
        if(isset($_POST['remove'])){
            $conexion=mysqli_connect($host, $user, $password, $DB);
            $login=$_SESSION['login'];
            if($tipo=="film"){
            $borrar="DELETE FROM `usuariopeliculas` WHERE `login` = '$login' AND `id` = '$id';";
            }else{
            $borrar="DELETE FROM `usuarioseries` WHERE `login` = '$login' AND `id` = '$id';";    
            }
            mysqli_query($conexion, $borrar) or die(mysqli_error($conexion));
        }
        
        
        
?>

<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="../css/estilos.css"/>
    <script src="../javascript/javascript.js"></script>
</head>
<body style="background: #f3f3f3">

<ul>
    <li><a <?php if($_GET['type']=="film"){echo "class='active'";}?> href="./misPeliculas.php">Mis Peliculas</a></li>
    <li><a <?php if($_GET['type']=="serie"){echo "class='active'";}?> href="./misSeries.php">Mis Series</a></li>
    <li><a href="./buscar.php">Buscar</a></li>
    <?php if($_SESSION['rol']=="administrador"){echo "<li><a href='../administrador/menu.php'>Administración</a></li>";} ?>
    <li id="cerrar"><a href="../salir.php">Cerrar sesión</a></li>
    <li id="cerrar"><a href="./cambiaPassword.php">Cambiar password</a></li>
  
</ul>
<div id="peliculas">
    <h1><?php echo $nombre;?></h1>
    <img width="201px" height="298px" src="<?php echo $ruta; ?>">
    <?php
            $conexion=mysqli_connect($host, $user, $password, $DB);
            $login=$_SESSION['login'];
            if($tipo=="film"){
            $comprobarEstado="SELECT * FROM `usuariopeliculas` where login='$login' and id='$id'";
            }else{
            $comprobarEstado="SELECT * FROM `usuarioseries` where login='$login' and id='$id';";    
            }
            $datos=mysqli_query($conexion, $comprobarEstado) or die(mysqli_error($conexion));
            echo "<form method='POST'>";
            //Si es igual a uno significa que esta añadido, por lo que tendremos que poner el boton para quitaral
            if(mysqli_num_rows($datos)==1){
            
                echo "<button name='remove'>Quitar</button>";
            }else{
                echo "<button name='add'>Añadir</button>";
            }
            echo "</form>";
    ?>
    
    
    </div>
    <div id="sinopsis" style="bottom: 50%; left:40%" >
        <h2>Sinopsis</h2>
        <?php echo $sinopsis;?>
        
    </div>
</body>
</html>