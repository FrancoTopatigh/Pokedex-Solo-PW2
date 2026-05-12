<?php
include_once 'conexion.php';
session_start();

$usuario_admin = "admin";
$hash = password_hash("1234", PASSWORD_DEFAULT);

$admin_sql = "INSERT INTO usuario (nombre_usuario, password, esAdmin) VALUES (?, ?, ?)";

if($stmt = mysqli_prepare($conexion, $admin_sql)) {
    mysqli_stmt_bind_param($stmt, "ssi", $param_nombre_usuario,$param_password,$param_es_admin);

    $param_nombre_usuario = $usuario_admin;
    $param_password = $hash;
    $param_es_admin = 1;

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        header("location:index.php");
        exit();
    }
}


