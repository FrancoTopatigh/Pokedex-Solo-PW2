<?php
include_once 'conexion.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre_usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    $login_sql = "SELECT id,nombre_usuario, password,esAdmin FROM usuario WHERE nombre_usuario=?";

    if($stmt = mysqli_prepare($conexion, $login_sql)){
        mysqli_stmt_bind_param($stmt, "s", $nombre_usuario);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $nombre_usuario, $hashed_password,$esAdmin);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password,$hashed_password)){
                        $_SESSION["logeado"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["nombre_usuario"] = $nombre_usuario;
                        $_SESSION['esAdmin'] = $esAdmin;
                        header("location:index.php");
                    } else{
                        echo "Contraseña invalida";
                    }
                }
            } else{
                echo "No se encontro ninguna cuenta con ese nombre de usuario";
            }
        }
    }

}
include_once 'html/header.php';

if(isset($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
