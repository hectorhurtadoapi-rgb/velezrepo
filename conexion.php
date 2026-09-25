<?php
$servidor = 'mysql-hectorapi.alwaysdata.net';
$usuario = 'roothectorapi';
$contrasena = 'clase1234';
$base_datos = 'hectorapi_sistema_envios';

$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die('Error de conexión con MySQL: ' . $conexion->connect_error);
}

$conexion->set_charset('utf8mb4');

$conexion->query("
    CREATE TABLE IF NOT EXISTS envios (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        correo VARCHAR(120) NOT NULL,
        telefono VARCHAR(20) NOT NULL,
        destinatario VARCHAR(100) NOT NULL,
        fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");
?>
