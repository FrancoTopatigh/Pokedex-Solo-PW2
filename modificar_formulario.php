<?php
include_once 'conexion.php';
if(empty(trim($_GET["id"]))) {
    header("location:error.php");
    exit();
}

$modificarSql = "SELECT * FROM pokemon WHERE id = ?";

$param_id=trim($_GET["id"]);
if($stmt = mysqli_prepare($conexion, $modificarSql)){
    mysqli_stmt_bind_param($stmt, "i",$param_id);


    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $pokemon = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if (!$pokemon) {
        header("location: index.php");
        exit();
    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Pokémon</title>
</head>
<body>
<h2>Modificar Pokémon</h2>

<form action="procesar_modificar.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $pokemon['id']; ?>">

    <div>
        <label>Número:</label>
        <input type="number" name="numero" value="<?php echo $pokemon['numero']; ?>">
    </div>

    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $pokemon['nombre']; ?>">
    </div>

    <div>
        <select name="tipo" id="tipos" style="margin-top:13px">
            <option value="Planta" <?php echo ($pokemon['tipo'] === 'Planta') ? 'selected' : ''; ?>>Planta</option>
            <option value="Veneno" <?php echo ($pokemon['tipo'] === 'Veneno') ? 'selected' : ''; ?>>Veneno</option>
            <option value="Fuego" <?php echo ($pokemon['tipo'] === 'Fuego') ? 'selected' : ''; ?>>Fuego</option>
            <option value="Volador" <?php echo ($pokemon['tipo'] === 'Volador') ? 'selected' : ''; ?>>Volador</option>
            <option value="Agua" <?php echo ($pokemon['tipo'] === 'Agua') ? 'selected' : ''; ?>>Agua</option>
            <option value="Normal" <?php echo ($pokemon['tipo'] === 'Normal') ? 'selected' : ''; ?>>Normal</option>
        </select>
    </div>

    <div>
        <img src="<?php echo $pokemon['imagen']; ?>" alt="Img Pokemon guardada" style="max-width: 150px; display: block;">
        <input name="imagen" type="file" style="margin-top:13px">
    </div>

    <div>
        <label>Descripción:</label>
        <textarea name="descripcion"><?php echo $pokemon['descripcion']; ?></textarea>
    </div>

    <button type="submit">Guardar Cambios</button>
    <a href="index.php">Cancelar</a>
</form>
</body>
</html>