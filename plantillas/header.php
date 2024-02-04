<!-- header.php -->

<?php
session_start();
$url_base = "http://localhost:3000/";

// Verificar si hay una sesión abierta
if (!isset($_SESSION['email'])) {
    $enlaceCerrarSesion = "<a class='nav-link' href='{$url_base}login.php'>Login</a>";
    $perfilUsuario = ''; // Si no hay sesión, el perfil está vacío
} else {
    $enlaceCerrarSesion = "<a class='nav-link' href='{$url_base}cerrar.php'>Cerrar Sesión</a>";

    // Si hay sesión, mostrar enlace "Mi Perfil" con los datos del Usuario y Candidato
    $perfilUsuario = "
        <li class='nav-item'>
            <a class='nav-link' href='{$url_base}mi_perfil.php'>Mi Perfil</a>
        </li>
    ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Title</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>inscripciones.php">Inscripciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>index.php">Ofertas de trabajo</a>
            </li>
            <?php echo $perfilUsuario; ?>
            <?php echo $enlaceCerrarSesion; ?>
        </ul>
    </nav>
