<?php
include_once 'conexion.php';

if(empty(trim($_GET["id"]))) {
    header("location:error.php");
    exit();
} else{$bajaSql = "DELETE FROM pokemon WHERE id = ?";

    if($stmt = mysqli_prepare($conexion, $bajaSql)){
        mysqli_stmt_bind_param($stmt, "i",$param_id);

        $param_id=trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
            header("location:index.php");
            exit();
        }


    }
}