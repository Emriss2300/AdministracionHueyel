<?php
// Configuración de la base de datos
$servidor = 'localhost'; // O la dirección de tu servidor de base de datos
$usuario = 'root'; // Tu nombre de usuario de MySQL
$contrasena = ''; // Tu contraseña de MySQL
$baseDeDatos = 'agrupacionhueyel'; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $baseDeDatos);

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Configurar el juego de caracteres a utf8mb4
$conn->set_charset('utf8mb4');
?>
