<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrupacionhueyel";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los integrantes para obtener nombres y números de inscripción
$sql = "SELECT Nombre, NumeroInscripcion FROM integrantes";
$result = $conn->query($sql);
$integrantes = [];
while ($row = $result->fetch_assoc()) {
    $integrantes[] = $row;
}

// Obtener el último IdTransaccion y generar el nuevo
$sql = "SELECT MAX(IdTransaccion) AS max_id FROM mensualidades";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$lastId = $row['max_id'];
$newId = $lastId ? str_pad($lastId + 1, 6, '0', STR_PAD_LEFT) : '000001';

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroInscripcion = $_POST['numeroInscripcion'];
    $nombre = $_POST['nombre'];
    $fechaPago = $_POST['fechaPago'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    $monto = $_POST['monto'];
    $medioPago = $_POST['medioPago'];

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO mensualidades (IdTransaccion, NumeroInscripcion, Nombre, FechaPago, Mes, año, Monto, MedioPago) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $newId, $numeroInscripcion, $nombre, $fechaPago, $mes, $ano, $monto, $medioPago);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registro insertado correctamente');
                window.location.href = 'http://localhost/hueyel/mensualidades/registros_mensualidades.php';
              </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de Mensualidad</title>
    <script>
        function actualizarNumeroInscripcion() {
            var select = document.getElementById("nombre");
            var selectedOption = select.options[select.selectedIndex];
            var numeroInscripcion = selectedOption.getAttribute("data-numeroInscripcion");
            document.getElementById("numeroInscripcion").value = numeroInscripcion;
        }
    </script>
</head>
<body>
    <h2>Formulario de Ingreso de Mensualidad</h2>
    <form action="ingresar_mensualidad.php" method="POST">
        <!-- Campo oculto para IdTransaccion -->
        <input type="hidden" id="idTransaccion" name="idTransaccion" value="<?php echo $newId; ?>">

        <label for="nombre">Nombre:</label><br>
        <select id="nombre" name="nombre" onchange="actualizarNumeroInscripcion()" required>
            <option value="">Seleccione un nombre</option>
            <?php foreach ($integrantes as $integrante): ?>
                <option value="<?php echo $integrante['Nombre']; ?>" data-numeroInscripcion="<?php echo $integrante['NumeroInscripcion']; ?>">
                    <?php echo $integrante['Nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="numeroInscripcion">Número de Inscripción:</label><br>
        <input type="text" id="numeroInscripcion" name="numeroInscripcion" readonly><br><br>

        <label for="fechaPago">Fecha de Pago:</label><br>
        <input type="date" id="fechaPago" name="fechaPago" required><br><br>

        <label for="mes">Mes:</label><br>
        <input type="text" id="mes" name="mes" required><br><br>

        <label for="ano">Año:</label><br>
        <input type="number" id="ano" name="ano" required><br><br>

        <label for="monto">Monto:</label><br>
        <input type="number" id="monto" name="monto" required><br><br>

        <label for="medioPago">Medio de Pago:</label><br>
        <select id="medioPago" name="medioPago" required>
            <option value="Transferencia" selected>Transferencia</option>
            <option value="Efectivo">Efectivo</option>
            <option value="Deposito">Depósito</option>
        </select><br><br>

        <input type="submit" value="Registrar Mensualidad">
    </form>
</body>
</html>
