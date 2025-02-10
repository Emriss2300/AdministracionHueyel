<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Validar que se recibió el parámetro 'id' y que es numérico
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta SQL para prevenir inyección de SQL
    $stmt = $conn->prepare("DELETE FROM mensualidades WHERE IdTransaccion = ?");
    $stmt->bind_param("s", $id);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        echo "<script>alert('Registro eliminado con éxito.'); window.location.href='registros_mensualidades.php?mensaje=eliminado';</script>";
    } else {
        echo "<script>alert('Error al eliminar el registro.'); window.location.href='registros_mensualidades.php?mensaje=error';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID inválido.'); window.location.href='registros_mensualidades.php?mensaje=invalido';</script>";
}

// Cerrar la conexión
$conn->close();
exit;
?>
