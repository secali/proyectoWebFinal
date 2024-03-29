<?php
include("./../plantillas/header.php");
include("./../db.php");

// Verificar si hay una sesión abierta
if (!isset($_SESSION['email'])) {
    // Redireccionar si no hay sesión
    header("Location: {$url_base}login.php");
    exit();
}

// Obtener el ID del usuario desde la sesión
$usuario = $_SESSION['email'];

// Consultar información del usuario y candidato
$consultaUsuario = $conexion->prepare("SELECT * FROM Candidato where email = ?");
$consultaUsuario->execute([$usuario]);
$usuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <h1 class="mt-5">Mi Perfil</h1>

        <!-- Mostrar información del usuario -->
        <h2>Datos del Usuario</h2>
        <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
        <p><strong>Apellidos:</strong> <?php echo $usuario['nombre']; ?></p>
        <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
        <p><strong>Fecha de registro:</strong> <?php echo $usuario['fechaRegistro']; ?></p>
        <p><strong>Curriculum Vitae:</strong> <?php echo $usuario['cv']; ?></p>
        <!--
 Mostrar información del candidato si existe 
        <?php if ($candidato) : ?>
            <h2>Datos del Candidato</h2>
            <p><strong>Nombre:</strong> <?php echo $candidato['nombre']; ?></p>
            <p><strong>Apellido:</strong> <?php echo $candidato['apellido']; ?></p>  -->
        <?php else : ?>
            <p>No se encontraron datos del candidato.</p>
        <?php endif; ?>
    </main>

    <?php include("./plantillas/footer.php"); ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>

</html>
