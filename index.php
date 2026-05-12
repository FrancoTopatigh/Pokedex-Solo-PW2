<?php
include_once 'conexion.php';
include_once 'html/header.php';

$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$query = "SELECT * FROM pokemon";

if (!empty($busqueda)) {
    $query .= " WHERE nombre LIKE ? OR tipo LIKE ? OR numero = ?";
    $stmt = mysqli_prepare($conexion, $query);
    $termino = "%$busqueda%";
    mysqli_stmt_bind_param($stmt, "sss", $termino, $termino, $busqueda);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
} else {
    $resultado = mysqli_query($conexion, $query);
}

$esAdmin = isset($_SESSION['usuario']);
?>

    <main class="container mt-4">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                <tr>
                    <th>imagen</th>
                    <th>tipo</th>
                    <th>número</th>
                    <th>nombre</th>
                    <?php if ($esAdmin): ?>
                        <th>acciones</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td>
                            <img src="<?php echo $fila['imagen']; ?>" alt="Pokemon" style="width: 50px; height: 50px; object-fit: contain;">
                        </td>
                        <td>
                            <?php echo $fila['tipo']; ?>
                        </td>
                        <td><?php echo $fila['numero']; ?></td>
                        <td><?php echo $fila['nombre']; ?></td>

                        <?php if ($esAdmin): ?>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="modificar_formulario.php?id=<?php echo $fila['id']; ?>" class="btn btn-primary btn-sm">Modificación</a>
                                    <a href="procesar_baja.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea eliminar este Pokemon?')">Baja</a>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>

                <?php if (mysqli_num_rows($resultado) == 0): ?>
                    <tr>
                        <td colspan="<?php echo $esAdmin ? 5 : 4; ?>" class="text-center">No se encontraron resultados</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($esAdmin): ?>
            <div class="d-grid mt-3">
                <a href="alta_formulario.php" class="btn btn-light border">Nuevo pokemon</a>
            </div>
        <?php endif; ?>
    </main>

<?php
include_once 'html/footer.php';
mysqli_close($conexion);
?>