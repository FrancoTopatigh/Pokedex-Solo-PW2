<?php
global $conexion;
include 'conexion.php';

if ($conexion) {
    echo "¡Conexión exitosa!";
} else {
    echo "Error al conectar.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokedex</title>
</head>
<body>
<h1>Mi Pokedex</h1>
</body>
</html>