<?php
if (!empty($_POST["btningresar"])){
    if (empty($_POST["usuario"]) and empty($_POST["password"])) {
        echo '<div class="alert alert-danger">Los campos estan vacios</div>';
    } else {
        $usuario=$_POST["usuario"];
        $pass=$_POST["password"];
        $sql=$conexion->query(" select * from usuarios where usuario='$usuario' and contra='$pass' ");
        if($datos=$sql->fetch_object()){
            header("location:inicio.php");
        } else{
            echo '<div class="alert alert-danger">Acceso denegado</div>';
        }
    }
    
}
?>