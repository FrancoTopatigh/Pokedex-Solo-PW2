<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulario Alta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="w3-container form-container">
    <div class="w3-card-4 w3-white">
        <form action="procesar_alta.php"
              method="POST"
              enctype="multipart/form-data">
            <label>Numero <span class="field-name">(name: numero)</span></label>
            <input type="number" name="numero" style="margin-top:13px"><br>

            <label>Nombre<span class="field-name">(name: nombre)</span></label>
            <input type="text" name="nombre" style="margin-top:13px"><br>

            <label>Descripcion<span class="field-name">(name: descripcion)</span></label>
            <input type="text" name="descripcion" style="margin-top:13px"><br>

            <select name="tipo" id="tipos" style="margin-top:13px">
                <option value="planta">Planta</option>
                <option value="veneno">Veneno</option>
                <option value="fuego">Fuego</option>
                <option value="volador">Volador</option>
                <option value="agua">Agua</option>
                <option value="normal">Normal</option>
            </select><br>

            <input name="imagen" type="file" style="margin-top:13px">

            <input type="submit">

        </form>
    </div>
</div>
</body>

