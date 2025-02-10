<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Obtener el ID de la transacción desde la URL
$id = $_GET['id'];

// Consultar los detalles de la transacción
$sql = "SELECT * FROM mensualidades WHERE IdTransaccion = '$id'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
} else {
    echo "No se encontró el registro.";
    exit;
}

// Obtener la lista de integrantes
$sql_integrantes = "SELECT NumeroInscripcion, Nombre FROM integrantes";
$resultado_integrantes = $conn->query($sql_integrantes);

// Actualizar el registro si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeroInscripcion = $_POST['NumeroInscripcion'];
    $nombre = $_POST['Nombre'];
    $fechaPago = $_POST['FechaPago'];
    $mes = $_POST['Mes'];
    $anio = $_POST['Año'];
    $monto = $_POST['Monto'];
    $medioPago = $_POST['MedioPago'];

    $sql = "UPDATE mensualidades SET NumeroInscripcion = '$numeroInscripcion', Nombre = '$nombre', FechaPago = '$fechaPago', Mes = '$mes', Año = '$anio', Monto = '$monto', MedioPago = '$medioPago' WHERE IdTransaccion = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente.";
        // Redirigir a la página de listados
        header("Location: registros_mensualidades.php");
        exit;
    } else {
        echo "Error actualizando el registro: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mensualidad</title>
    <script>
        function actualizarNumeroInscripcion() {
            var select = document.getElementById("Nombre");
            var numeroInscripcion = select.options[select.selectedIndex].getAttribute("data-numero");
            document.getElementById("NumeroInscripcion").value = numeroInscripcion;
        }
    </script>
</head>
<body>
    <h1>Editar Mensualidad</h1>
    <form method="POST">
        <label for="Nombre">Nombre:</label>
        <select id="Nombre" name="Nombre" onchange="actualizarNumeroInscripcion()" required>
            <option value="">Seleccione un nombre</option>
            <?php while ($row = $resultado_integrantes->fetch_assoc()) { ?>
                <option value="<?php echo htmlspecialchars($row['Nombre']); ?>" data-numero="<?php echo htmlspecialchars($row['NumeroInscripcion']); ?>" <?php echo ($fila['Nombre'] == $row['Nombre']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['Nombre']); ?>
                </option>
            <?php } ?>
        </select><br>
        
        <label for="NumeroInscripcion">N° Inscripción:</label>
        <input type="text" id="NumeroInscripcion" name="NumeroInscripcion" value="<?php echo isset($fila['NumeroInscripcion']) ? htmlspecialchars($fila['NumeroInscripcion']) : ''; ?>" readonly required><br>
        
        <label for="FechaPago">Fecha de Pago:</label>
        <input type="date" id="FechaPago" name="FechaPago" value="<?php echo isset($fila['FechaPago']) ? htmlspecialchars($fila['FechaPago']) : ''; ?>" required><br>
        
        <label for="Mes">Mes:</label>
        <input type="text" id="Mes" name="Mes" value="<?php echo isset($fila['Mes']) ? htmlspecialchars($fila['Mes']) : ''; ?>" required><br>
        
        <label for="Año">Año:</label>
        <input type="number" id="Año" name="Año" value="<?php echo isset($fila['Año']) ? htmlspecialchars($fila['Año']) : ''; ?>" required><br>
        
        <label for="Monto">Monto:</label>
        <input type="text" id="Monto" name="Monto" value="<?php echo isset($fila['Monto']) ? htmlspecialchars($fila['Monto']) : ''; ?>" required><br>
        
        <label for="MedioPago">Medio de Pago:</label>
        <input type="text" id="MedioPago" name="MedioPago" value="<?php echo isset($fila['MedioPago']) ? htmlspecialchars($fila['MedioPago']) : ''; ?>"><br>
        
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
