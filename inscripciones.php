<?php
include("./db.php");

include("./plantillas/header.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['idCandidato'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener el ID del candidato desde la sesión
$idCandidato = $_SESSION['idCandidato'];

// Consultar las candidaturas del candidato
$sql = "SELECT candidaturas.idAplicacion, empleos.idOferta, empleos.titulo, candidaturas.fechaAplicacion, candidaturas.estado
        FROM candidaturas
        INNER JOIN empleos ON candidaturas.idOferta = empleos.idOferta
        WHERE candidaturas.idCandidato = :idCandidato";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':idCandidato', $idCandidato);
$stmt->execute();
$candidaturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inscripciones</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Enlace a tus estilos CSS -->
    <link rel="stylesheet" href="styles.css">

    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <header>
        <!-- ... (código del encabezado, puede incluir un enlace a la página principal) ... -->
    </header>

    <main class="container mt-5">
        <h2>Estado de tus Inscripciones</h2>

        <?php if (empty($candidaturas)) : ?>
            <p class="mt-3">No tienes ninguna candidatura.</p>
        <?php else : ?>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID de Aplicación</th>
                        <th>ID de Oferta</th>
                        <th>Posición</th>
                        <th>Fecha de Aplicación</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidaturas as $candidatura) : ?>
                        <tr>
                            <td><?php echo $candidatura['idAplicacion']; ?></td>
                            <td><?php echo $candidatura['idOferta']; ?></td>
                            <td><?php echo $candidatura['titulo']; ?></td>
                            <td><?php echo $candidatura['fechaAplicacion']; ?></td>
                            <td><?php echo $candidatura['estado']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <footer>
        <!-- ... (código del pie de página) ... -->
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>

</html>
