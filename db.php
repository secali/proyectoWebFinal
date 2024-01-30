<?php

$servidor = "localhost";
$baseDeDatos = "baseDeDatos";
$usuario = "root";
$contrasenia = "";

try {
    // Crear una instancia de la clase PDO para la conexión
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);

    // Configurar el modo de manejo de errores para lanzar excepciones en lugar de advertencias
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexion->exec("SET NAMES 'utf8'");
} catch (PDOException $ex) {
    // Capturar y manejar excepciones relacionadas con PDO
    echo "Error de conexión: " . $ex->getMessage();
}

?>
