<?php
include("./db.php");

// Verificar si el ofertante ha iniciado sesión
session_start();
if (!isset($_SESSION['idOfertante'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión de ofertante
    header("Location: login_ofertante.php");
    exit();
}

// Cerrar sesión al hacer clic en el enlace "Cerrar Sesión"
if (isset($_GET['cerrar_sesion'])) {
    session_destroy();
    header("Location: login_ofertante.php");
    exit();
}

// Obtener el ID del ofertante desde la sesión
$idOfertante = $_SESSION['idOfertante'];

// Consultar las ofertas publicadas por el ofertante
$sqlOfertas = "SELECT * FROM Empleos WHERE idOfertante = :idOfertante";
$stmtOfertas = $conexion->prepare($sqlOfertas);
$stmtOfertas->bindParam(':idOfertante', $idOfertante);
$stmtOfertas->execute();
$ofertas = $stmtOfertas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Dashboard - Ofertante</title>
    <!-- Enlaces a tus estilos CSS y Bootstrap CSS -->
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <header>
        <!-- Enlace para cerrar sesión -->
        <div style="text-align: right; padding: 10px;">
            <a href="?cerrar_sesion=true">Cerrar Sesión</a>
        </div>
        <!-- ... (código del encabezado, puede incluir un enlace a la página principal) ... -->
    </header>

    <main class="container mt-5">
        <h2>Ofertas Publicadas</h2>

        <?php if (empty($ofertas)) : ?>
            <p class="mt-3">No has publicado ninguna oferta aún.</p>
        <?php else : ?>
            <ul class="list-group mt-3">
                <?php foreach ($ofertas as $oferta) : ?>
                    <li class="list-group-item">
                        <h5 class="mb-3"><?php echo $oferta['titulo']; ?> (ID: <?php echo $oferta['idOferta']; ?>)</h5>
                        <p><?php echo $oferta['descripcion']; ?></p>

                        <!-- Lista de candidatos inscritos en esta oferta -->
                        <h6>Candidatos Inscritos:</h6>
                        <ul>
                            <?php
                            $sqlCandidatos = "SELECT * FROM Candidaturas WHERE idOferta = :idOferta";
                            $stmtCandidatos = $conexion->prepare($sqlCandidatos);
                            $stmtCandidatos->bindParam(':idOferta', $oferta['idOferta']);
                            $stmtCandidatos->execute();
                            $candidatos = $stmtCandidatos->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($candidatos as $candidato) {
                                // Obtener el nombre del candidato directamente de la tabla de Candidatos
                                $sqlNombreCandidato = "SELECT nombre, apellido, email, estado FROM Candidato INNER JOIN Candidaturas ON Candidato.idCandidato = Candidaturas.idCandidato WHERE Candidaturas.idAplicacion = :idCandidatura";
                                $stmtNombreCandidato = $conexion->prepare($sqlNombreCandidato);
                                $stmtNombreCandidato->bindParam(':idCandidatura', $candidato['idAplicacion']);
                                $stmtNombreCandidato->execute();
                                $datosCandidato = $stmtNombreCandidato->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <li>
                                    <?php echo $datosCandidato['nombre'] . ' ' . $datosCandidato['apellido'] . ' (' . $datosCandidato['email'] . ') - Estado: ' . $datosCandidato['estado']; ?>
                                    <!-- Botones de aceptar y rechazar -->
                                    <form action="actualizar_candidatura.php" method="post" class="d-inline">
                                        <input type="hidden" name="idCandidatura" value="<?php echo $candidato['idAplicacion']; ?>">
                                        <button type="submit" name="aceptar" class="btn btn-success btn-sm">Aceptar</button>
                                    </form>
                                    <form action="actualizar_candidatura.php" method="post" class="d-inline">
                                        <input type="hidden" name="idCandidatura" value="<?php echo $candidato['idAplicacion']; ?>">
                                        <button type="submit" name="rechazar" class="btn btn-danger btn-sm">Rechazar</button>
                                    </form>
                                </li>
                            <?php } ?>
                        </ul>
                        
                        <!-- Botón para eliminar la oferta -->
                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="confirmarEliminar(<?php echo $oferta['idOferta']; ?>)">Eliminar Oferta</button>
                        <div id="confirmacionEliminar_<?php echo $oferta['idOferta']; ?>" style="display: none;">
                            <p>¿Estás seguro de que deseas eliminar esta oferta?</p>
                            <form action="eliminar_oferta.php" method="post">
                                <input type="hidden" name="idOfertaEliminar" value="<?php echo $oferta['idOferta']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Sí, eliminar oferta</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="cancelarEliminar(<?php echo $oferta['idOferta']; ?>)">Cancelar</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>

    <footer>
        <!-- ... (código del pie de página) ... -->
    </footer>

    <!-- Enlaces a Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>

    <!-- Script para confirmar eliminación -->
    <script>
        function confirmarEliminar(idOferta) {
            document.getElementById('confirmacionEliminar_' + idOferta).style.display = 'block';
        }

        function cancelarEliminar(idOferta) {
            document.getElementById('confirmacionEliminar_' + idOferta).style.display = 'none';
        }
    </script>
</body>

</html>
