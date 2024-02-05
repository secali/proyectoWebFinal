<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluir el archivo de conexión a la base de datos
    include("./../db.php");

    // Obtener datos del formulario
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $contrasenia = $_POST["contrasenia"];

    // Evitar inyección de SQL utilizando consultas preparadas
    $sentenciaCandidato = $conexion->prepare("INSERT INTO `candidato` (nombre, apellido, email, password) VALUES (:nombre, :apellidos, :email, :contrasenia)");
    $sentenciaCandidato->bindParam(":nombre", $nombre);
    $sentenciaCandidato->bindParam(":apellidos", $apellidos);
    $sentenciaCandidato->bindParam(":email", $email);
    $sentenciaCandidato->bindParam(":contrasenia", $contrasenia);

    // Ejecutar la consulta
    $resultadoCandidato = $sentenciaCandidato->execute();

    // Verificar el resultado
    if ($resultadoCandidato) {
        // Obtener el ID del candidato recién insertado
        $idCandidato = $conexion->lastInsertId();

        // Resto de tu código para guardar otros datos relacionados con el candidato
        // ...

        $_SESSION['registro_exitoso'] = true;
        header("Location: login.php");
        exit();
    } else {
        $mensaje = "Error: No se pudo registrar el candidato.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <br /><br />
                <div class="card">
                    <div class="card-header">
                        Registro
                    </div>
                    <div class="card-body">
                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo $mensaje; ?></strong>
                            </div>
                        <?php } ?>

                        <form action="" method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                <div class="invalid-feedback">Por favor, ingrese su nombre.</div>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos:</label>
                                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                                <div class="invalid-feedback">Por favor, ingrese sus apellidos.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                <div class="invalid-feedback">Por favor, ingrese un email válido.</div>
                            </div>
                            <div class="mb-3">
                                <label for="contrasenia" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Contraseña" required>
                                <div class="invalid-feedback">Por favor, ingrese una contraseña.</div>
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">CV (formato PDF):</label>
                                <input type="file" class="form-control" name="cv" id="cv" accept=".pdf">
                            </div>
                            <button type="submit" class="btn btn-primary btn-center">Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script
