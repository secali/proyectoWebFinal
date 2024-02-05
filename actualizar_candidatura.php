<?php
include("./plantillas/header.php");
include("./db.php");

// Verificar si el ofertante ha iniciado sesión
session_start();
if (!isset($_SESSION['idOfertante'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión de ofertante
    echo "<script>alert('Inicia sesión como ofertante para procesar las inscripciones.');</script>";
    echo '<script>window.location.href = "login_ofertante.php";</script>';
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el idCandidatura desde el formulario
    $idCandidatura = $_POST['idCandidatura'];
    $accion = isset($_POST['aceptar']) ? 'aceptada' : (isset($_POST['rechazar']) ? 'rechazada' : '');

    if (!empty($accion)) {
        // Actualizar el estado de la candidatura en la tabla Candidaturas
        $sql = "UPDATE Candidaturas SET estado = :estado WHERE idAplicacion = :idCandidatura";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':estado', $accion);
        $stmt->bindParam(':idCandidatura', $idCandidatura);

        try {
            $stmt->execute();
            echo "<script>alert('La inscripción ha sido $accion con éxito.');</script>";
        } catch (PDOException $ex) {
            // Manejar errores en caso de fallo en la actualización
            echo "Error al procesar la inscripción: " . $ex->getMessage();
        }
    } else {
        echo "<script>alert('Acción no válida.');</script>";
    }

    // Redirige a dashboard_ofertante.php después de procesar la inscripción
    echo '<script>window.location.href = "dashboard_ofertante.php";</script>';
    exit();
} else {
    // Si no se ha enviado el formulario, redirige a dashboard_ofertante.php
    echo '<script>window.location.href = "dashboard_ofertante.php";</script>';
    exit();
}
?>
