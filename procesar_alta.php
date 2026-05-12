<?php
include_once 'conexion.php';

echo "<div class='w3-margin'><b>Numero:</b> " . $_POST["numero"] . "</div>";
echo "<div class='w3-margin'><b>Nombre:</b> " . $_POST["nombre"] . "</div>";
echo "<div class='w3-margin'><b>Descripcion:</b> " . $_POST["descripcion"] . "</div>";
echo "<div class='w3-margin'><b>Tipo (Select):</b> " . $_POST["tipo"] . "</div>";
echo "<div class='w3-margin'><b>imagen:</b>";

if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
    $nombre_archivo = $_FILES["imagen"]["name"];
    $tipo_archivo = $_FILES["imagen"]["type"];
    $tamano_archivo = $_FILES["imagen"]["size"] / 1024; // KB

    $rutaArchivo = "./" . $nombre_archivo;
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaArchivo))
        echo "exito al subir el archivo $rutaArchivo";
    else
        echo "error al subir el archivo $rutaArchivo";



    echo "<div class='w3-panel w3-pale-blue w3-leftbar w3-border-blue'>";
    echo "<h4>Archivo Recibido:</h4>";
    echo "<img src='". $rutaArchivo  . "' />";
    echo "<ul>
                        <li>Nombre: $nombre_archivo</li>
                        <li>Tipo: $tipo_archivo</li>
                        <li>Tamaño: " . round($tamano_archivo, 2) . " KB</li>
                      </ul>";
    echo "</div>";

} else {
    echo "<p class='w3-text-red'>No se subió ninguna foto o hubo un error.</p>";
}
if(!empty($_POST["numero"]) && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["tipo"])) {
    $alta_sql = "INSERT INTO pokemon(numero, nombre, tipo, imagen, descripcion) 
        VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conexion, $alta_sql)) {
        mysqli_stmt_bind_param($stmt, "issss", $param_numero, $param_nombre, $param_tipo, $rutaArchivo, $param_descripcion);


        $param_numero = $_POST["numero"];
        $param_nombre = $_POST["nombre"];
        $param_tipo = $_POST["tipo"];
        $param_imagen = $rutaArchivo;
        $param_descripcion = $_POST["descripcion"];

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
            exit();
        } else {
            echo "Algo salio mal! Intente mas tarde.";
        }
    }
}
?>