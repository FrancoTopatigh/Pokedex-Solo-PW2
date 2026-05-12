<?php
global $conexion;
include 'conexion.php';

if ($conexion) {
    echo "¡Conexión exitosa!";
} else {
    echo "Error al conectar.";
}


$sql = "SELECT * FROM pokemon";
$res = mysqli_query($conexion, $sql);

echo "<table border='1'>";
while($row = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td><a href='procesar_baja.php?id=" . $row['id'] . "'>Eliminar Pokémon</a></td>";
    echo "<td><a href='modificar_formulario.php?id=" . $row['id'] . "'>Editar</a></td>";
    echo "</tr>";
}

echo "</table>";


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
