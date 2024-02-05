<?php
include("./../plantillas/header.php");
include("./../db.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['idCandidato'])) {
    echo "<script>alert('Inicia sesión');</script>";
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el idOferta y idCandidato desde el formulario
    $idOferta = $_POST['idOferta'];
    $idCandidato = $_SESSION['idCandidato'];  // Asegúrate de tener este valor almacenado en tus sesiones

    // Insertar la candidatura en la tabla Candidaturas
    $sql = "INSERT INTO Candidaturas (idOferta, idCandidato, fechaAplicacion, estado) VALUES (:idOferta, :idCandidato, NOW(), 'pendiente')";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idOferta', $idOferta);
    $stmt->bindParam(':idCandidato', $idCandidato);

    try {
        $stmt->execute();

        // Muestra el mensaje de alerta
        echo "<script>alert('Te has inscrito con éxito. Nos pondremos en contacto contigo pronto.');</script>";
    } catch (PDOException $ex) {
        // Manejar errores en caso de fallo en la inserción
        echo "Error al procesar la inscripción: " . $ex->getMessage();
    }

    // Redirige a index.php después de procesar la inscripción
    echo '<script>window.location.href = "index.php";</script>';
    exit();
} else {
    // Si no se ha enviado el formulario, redirige a index.php
    //header("Location: index.php");
    exit();
}
?>
