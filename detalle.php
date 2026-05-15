<?php
include_once "conexion.php";
include_once 'html/header.php';

if(empty(trim($_GET["id"]))){
   header("location:index.php");
   exit();
} else{
    $detalle_sql = "SELECT * FROM pokemon WHERE id = ?";
    if($stmt = mysqli_prepare($conexion, $detalle_sql)){
        mysqli_stmt_bind_param($stmt, "i",$param_id);

        $param_id = $_GET["id"];

        if(mysqli_stmt_execute($stmt)){
            $resultado = mysqli_stmt_get_result($stmt);
            $fila = mysqli_fetch_assoc($resultado);
        }

    }
}
?>

<main class="container mt-5">
    <?php if ($fila): ?>
        <div class="card shadow-lg mx-auto" style="max-width: 800px; border-radius: 20px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
                    <img src="<?php echo $fila['imagen']; ?>"
                         class="img-fluid"
                         alt="<?php echo $fila['nombre']; ?>"
                         style="max-height: 300px; filter: drop-shadow(5px 5px 10px rgba(0,0,0,0.2));">
                </div>

                <div class="col-md-7">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-secondary">#<?php echo $fila['numero']; ?></span>
                            <img src="img/tipos/<?php echo $fila['tipo']; ?>.png"
                                 alt="<?php echo $fila['tipo']; ?>"
                                 style="height: 30px;">
                        </div>

                        <h1 class="display-4 fw-bold text-capitalize mb-3">
                            <?php echo $fila['nombre']; ?>
                        </h1>

                        <h5 class="text-muted mb-2">Descripción</h5>
                        <p class="card-text fs-5 text-secondary">
                            <?php echo isset($fila['descripcion']) ? $fila['descripcion'] : 'Sin descripción disponible para este Pokémon.'; ?>
                        </p>

                        <hr>

                        <div class="d-flex gap-2 mt-4">
                            <a href="index.php" class="btn btn-outline-primary w-100">
                                Volver al Listado
                            </a>

                            <?php if (isset($_SESSION['nombre_usuario'])): ?>
                                <a href="modificar_formulario.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning">
                                    Editar
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center shadow" role="alert">
            <h4 class="alert-heading">¡Pokémon no encontrado!</h4>
            <p>El identificador ingresado no corresponde a ningún Pokémon de nuestra base de datos.</p>
            <hr>
            <a href="index.php" class="btn btn-danger">Regresar a la Pokedex</a>
        </div>
    <?php endif; ?>
</main>

<?php
include_once 'html/footer.php';
mysqli_close($conexion);
?>

