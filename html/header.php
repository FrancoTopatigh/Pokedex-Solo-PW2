<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="img/pokemonlogo2.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top me-2">
            <span class="h3 mb-0">Pokedex</span>
        </a>

        <div class="ms-auto">
            <?php
            session_start();
            if (isset($_SESSION['nombre_usuario'])): ?>
                <div class="d-flex align-items-center">
                    <span class="me-3">Usuario: <strong><?php echo $_SESSION['nombre_usuario']; ?></strong></span>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm">Salir</a>
                </div>
            <?php else: ?>
                <form class="d-flex align-items-center gap-2" action="procesar_login.php" method="POST">
                    <input type="text" name="usuario" class="form-control form-control-sm" placeholder="Usuario" required>
                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Password" required>
                    <button type="submit" class="btn btn-primary btn-sm" name="btn-ingresar">Ingresar</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <form action="index.php" method="GET" class="d-flex gap-2">
                <input type="text" name="buscar" class="form-control" placeholder="Ingrese el nombre, tipo o número de pokémon" value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
                <button type="submit" class="btn btn-outline-success">Buscar</button>
            </form>
        </div>
    </div>