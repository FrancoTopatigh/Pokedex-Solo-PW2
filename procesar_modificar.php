<?php
include_once 'conexion.php';
include_once 'procesar_imagen.php';

$numero = $_POST["numero"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$imagen = $_FILES["imagen"];
$descricion = $_POST["descripcion"];


if(empty(trim($_POST["id"]))) {
    header("location:error.php");
    exit();
}



if(isset($_POST["id"]) && !empty(trim($_POST["id"]))) {
    $id = $_POST["id"];

    $input_numero = trim($_POST["numero"]);
    if (empty($input_numero)) {
        $numero_error = "Por favor ingrese un numero.";
    } elseif(!filter_var($input_numero, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]+$/")))){
        $numero_error = "Por favor ingrese un numero valido.";
    }


    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_error = "Por favor ingrese un nombre.";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_error = "Por favor ingrese un nombre valido.";
    }


    $input_tipo = trim($_POST["tipo"]);
    if (empty($input_tipo)) {
        $tipo_error = "Por favor ingrese el tipo de Pokemon.";
    } else {
        $tipo = $input_tipo;
    }

    $sql_imagen_vieja = "SELECT imagen FROM pokemon WHERE id = ?";
    $stmt_vieja = mysqli_prepare($conexion, $sql_imagen_vieja);
    mysqli_stmt_bind_param($stmt_vieja, "i", $id);
    mysqli_stmt_execute($stmt_vieja);
    $res_vieja = mysqli_stmt_get_result($stmt_vieja);
    $pokemon_viejo = mysqli_fetch_assoc($res_vieja);

    $foto_actual_en_db = $pokemon_viejo['imagen'];

    if ($_FILES['imagen']['size'] > 0) {
        $imagen_final = procesar_imagen($_FILES['imagen']);
    } else {
        $imagen_final = $foto_actual_en_db;
    }


    $input_descripcion = trim($_POST["descripcion"]);
    if (empty($input_descripcion)) {
        $descripcion_error = "Por favor ingrese una descripcion";
    } else {
        $descricion = $input_descripcion;
    }

    if(empty($numero_error) && empty($nombre_error) && empty($tipo_error) && empty($descripcion_error)){
        $modificar_datos_sql = "UPDATE pokemon SET numero=?, nombre=?, tipo=?, imagen=?, descripcion=? WHERE id=?";

        if($stmt = mysqli_prepare($conexion, $modificar_datos_sql)){
            mysqli_stmt_bind_param($stmt,"issssi",$param_numero,$param_nombre,$param_tipo,$param_imagen,$param_descripcion,$param_id);

            $param_numero = $numero;
            $param_nombre = $nombre;
            $param_tipo = $tipo;
            $param_imagen = $imagen_final;
            $param_descripcion = $descricion;
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                header("location:index.php");
                exit();
            } else{
                return "Algo salio mal!!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conexion);
}
