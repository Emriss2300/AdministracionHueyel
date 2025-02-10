<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si se recibió el ID de la transacción
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los detalles de la transacción
    $sql = "SELECT * FROM mensualidades WHERE IdTransaccion = '$id'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "No se encontró la transacción.";
        exit;
    }
} else {
    echo "ID de transacción no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Transacción</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .details-container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-top: 20px;
        }

        .barcode-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .barcode-container img {
            max-width: 250px; /* Reduce el tamaño del código de barras */
        }

        .logo {
            width: 120px;
            margin-bottom: 10px; /* Añade espacio entre el logo y el código de barras */
        }

        .bank-details {
            flex: 1;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .print-button, .back-button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            margin: 0 10px; /* Espaciado entre los botones */
        }

        .print-button {
            background-color: #007bff;
        }

        .back-button {
            background-color: #dc3545;
        }

        .back-button:hover {
            background-color: #c82333;
        }

        .confirmation-text {
            margin-top: 10px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Registro de Pago de Mensualidades</h1>
<h2>Fraternidad Artística & Folclórica Hueyel Chile</h2>

<table>
    <tr>
        <th>ID Transacción</th>
        <td><?php echo htmlspecialchars($fila['IdTransaccion']); ?></td>
    </tr>
    <tr>
        <th>Número de Registro</th>
        <td><?php echo htmlspecialchars($fila['NumeroInscripcion']); ?></td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><?php echo htmlspecialchars($fila['Nombre']); ?></td>
    </tr>
    <tr>
        <th>Fecha de Pago</th>
        <td><?php echo date('d-m-Y', strtotime($fila['FechaPago'])); ?></td>
    </tr>
    <tr>
        <th>Mes</th>
        <td><?php echo htmlspecialchars($fila['Mes']); ?></td>
    </tr>
    <tr>
        <th>Año</th>
        <td><?php echo isset($fila['año']) ? htmlspecialchars($fila['año']) : 'N/A'; ?></td>
    </tr>
    <tr>
        <th>Monto</th>
        <td><?php echo "CLP $" . htmlspecialchars($fila['Monto']); ?></td>
    </tr>
    <tr>
        <th>Medio de Pago</th>
        <td><?php echo htmlspecialchars($fila['MedioPago']); ?></td>
    </tr>
</table>

<div class="details-container">
    <div class="bank-details">
        <p><strong>FRANCISCO JESUS NUÑEZ ORTIZ</strong></p>
        <p>17.507.715-4</p>
        <p>Banco - Mercado Pago</p>
        <p>Tipo de Cuenta "Vista"</p>
        <p>N° de Cuenta: 1092353575</p>
        <p>hueyel@me.com</p>
    </div>

    <div class="barcode-container">
        <img src="imagenes/icono1.png" alt="Logo de la agrupación" class="logo">
        <?php
        // Concatenar los valores para el código de barras
        $barcodeData = $fila['IdTransaccion'] . ' ' . $fila['Rut'] . ' ' . date('d-m-Y', strtotime($fila['FechaPago']));
        ?>
        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo urlencode($barcodeData); ?>&code=Code128&dpi=96" alt="Código de barras">
        
        <!-- Frase debajo del código de barras -->
        <p class="confirmation-text">Pago Ingresado Correctamente por: Francisco Núñez O. el <?php echo date('d-m-Y', strtotime($fila['FechaPago'])); ?></p>
    </div>
</div>

<div class="buttons-container">
    <a href="javascript:window.print()" class="print-button">Imprimir</a>
    <a href="http://localhost/hueyel/mensualidades/registros_mensualidades.php" class="back-button">Volver</a>
</div>

</body>
</html>
