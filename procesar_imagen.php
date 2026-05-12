<?php



function procesar_imagen($archivo) {
    $ruta_final_imagen = null;
    $errores = [];

    if (isset($archivo) && $archivo['error'] === UPLOAD_ERR_OK) {

        $fileTmpPath = $archivo['tmp_name'];
        $fileName    = $archivo['name'];
        $fileSize    = $archivo['size'];
        $fileType    = $archivo['type'];

        $extensiones_permitidas = ['image/jpeg', 'image/png', 'image/webp'];
        $max_size = 2 * 1024 * 1024;

        if (!in_array($fileType, $extensiones_permitidas)) {
            $errores[] = "Formato no permitido.";
        }

        if ($fileSize > $max_size) {
            $errores[] = "Archivo muy pesado.";
        }

        if (empty($errores)) {
            $carpeta_destino = './images/';
            if (!is_dir($carpeta_destino)) {
                mkdir($carpeta_destino, 0755, true);
            }

            $nombre_limpio = preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
            $ruta_final_imagen = $carpeta_destino . time() . "_" . $nombre_limpio;

            if (!move_uploaded_file($fileTmpPath, $ruta_final_imagen)) {
                $ruta_final_imagen = null;
            }
        }
    }

    return $ruta_final_imagen;
}
