<?php
// Incluir el archivo de conexión a la base de datos
include("./db.php");

// Verificar si el ofertante ha iniciado sesión
session_start();
if (!isset($_SESSION['idOfertante'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión de ofertante
    header("Location: login_ofertante.php");
    exit();
}

// Verificar si se ha enviado el formulario para eliminar la oferta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idOfertaEliminar'])) {
    // Obtener el idOferta a eliminar desde el formulario
    $idOfertaEliminar = $_POST['idOfertaEliminar'];

    // Eliminar candidatos asociados a la oferta de la base de datos
    $sqlEliminarCandidaturas = "DELETE FROM Candidaturas WHERE idOferta = :idOferta";
    $stmtEliminarCandidaturas = $conexion->prepare($sqlEliminarCandidaturas);
    $stmtEliminarCandidaturas->bindParam(':idOferta', $idOfertaEliminar);

    try {
        $stmtEliminarCandidaturas->execute();
    } catch (PDOException $ex) {
        // Manejar cualquier error durante la eliminación de candidatos
        echo "<script>alert('Error al eliminar candidatos asociados: {$ex->getMessage()}');</script>";
        // Puedes redirigir a una página de error si es necesario
        header("Location: dashboard_ofertante.php");
        exit();
    }

    // Eliminar la oferta de la base de datos
    $sqlEliminar = "DELETE FROM Empleos WHERE idOferta = :idOferta AND idOfertante = :idOfertante";
    $stmtEliminar = $conexion->prepare($sqlEliminar);
    $stmtEliminar->bindParam(':idOferta', $idOfertaEliminar);
    $stmtEliminar->bindParam(':idOfertante', $_SESSION['idOfertante']);

    try {
        $stmtEliminar->execute();
        // Redirigir al dashboard después de la eliminación
        header("Location: dashboard_ofertante.php");
        exit();
    } catch (PDOException $ex) {
        // Manejar cualquier error durante la eliminación de la oferta
        echo "<script>alert('Error al eliminar la oferta: {$ex->getMessage()}');</script>";
        // Puedes redirigir a una página de error si es necesario
        header("Location: dashboard_ofertante.php");
        exit();
    }
} else {
    // Si no se ha enviado el formulario, redirigir al dashboard
    header("Location: dashboard_ofertante.php");
    exit();
}
?>
