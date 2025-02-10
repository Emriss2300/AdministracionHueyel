<?php
$servername = "localhost";
$username = "root";
$password = "";  // Sin contraseña según tus especificaciones
$dbname = "agrupacionhueyel";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si deseas establecer el juego de caracteres a UTF-8, puedes descomentar la siguiente línea
// $conn->set_charset("utf8");
?>
