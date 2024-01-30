<?php
include("../../plantillas/header.php");


// Incluir el archivo de conexión a la base de datos
include("../../db.php");

// Consultar empleos disponibles
$consultaEmpleos = $conexion->query("SELECT * FROM empleos");
$empleos = $consultaEmpleos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Empleos Disponibles</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
        crossorigin="anonymous">

</head>

<body>
    <header>

    </header>

    <main class="container">
        <h1 class="mt-5">Empleos Disponibles</h1>

        <?php foreach ($empleos as $empleo) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $empleo['titulo']; ?></h5>
                    <p class="card-text"><?php echo $empleo['descripcion']; ?></p>
                    <a href="inscribirse.php?id=<?php echo $empleo['idOferta']; ?>" class="btn btn-primary">Inscribirse</a>
                </div>
            </div>
        <?php endforeach; ?>
    </main>

    <footer>

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
