<?php
include 'C:\xampp\htdocs\hueyel\conexion.php';

$message = "";
$id = $_GET['id'] ?? '';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $rut = $_POST['Rut'];
    $nombre = $_POST['Nombre'];
    $direccion = $_POST['Direccion'] ?? '';
    $celular = $_POST['Celular'] ?? '';
    $cargo = $_POST['Cargo'] ?? '';
    $numeroEmergencia = $_POST['NumeroEmergencia'] ?? '';
    $contactoEmergencia = $_POST['ContactoEmergencia'] ?? '';
    $alergiaEnfermedad = $_POST['AlergiaEnfermedad'] ?? '';
    $activo = $_POST['Activo']; // Obtener el valor de "Activo" de la lista desplegable

    // Manejo de la imagen
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == 0) {
        $foto = $_FILES['Foto'];
        $rutaDestino = 'uploads/' . basename($foto['name']);
        
        // Mover la imagen al directorio de destino
        if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
            $fotoURL = $rutaDestino; // Ruta relativa de la imagen subida
        } else {
            $fotoURL = $row['Foto']; // Mantener la foto actual si la carga falla
        }
    } else {
        $fotoURL = $row['Foto']; // Si no se cargó una nueva imagen, mantener la actual
    }

    // Consulta para actualizar los datos del integrante, incluyendo la URL de la imagen
    $sqlUpdate = "UPDATE integrantes SET
                    Rut = '$rut',
                    Nombre = '$nombre',
                    Direccion = '$direccion',
                    Celular = '$celular',
                    Cargo = '$cargo',
                    NumeroEmergencia = '$numeroEmergencia',
                    ContactoEmergencia = '$contactoEmergencia',
                    AlergiaEnfermedad = '$alergiaEnfermedad',
                    Activo = '$activo',
                    Foto = '$fotoURL' -- Actualiza el campo de la foto
                  WHERE NumeroInscripcion = '$id'";

    if ($conn->query($sqlUpdate) === TRUE) {
        $message = "Integrante actualizado correctamente.";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'http://localhost/hueyel/Integrantes/admin_integrantes.php';
                }, 2000); // Redirige después de 2 segundos
              </script>";
    } else {
        $message = "Error al actualizar: " . $conn->error;
    }
}

// Obtener datos del integrante para editar
$sql = "SELECT * FROM integrantes WHERE NumeroInscripcion='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Integrante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Editar Integrante</h2>

<?php if (!empty($message)): ?>
    <div style="color: green; text-align: center; margin-bottom: 20px;"><?php echo $message; ?></div>
<?php endif; ?>

<form action="editar.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <label>Número Inscripción:</label>
    <input type="text" name="NumeroInscripcion" value="<?php echo $row['NumeroInscripcion']; ?>" readonly>
    
    <label>Rut:</label>
    <input type="text" name="Rut" value="<?php echo $row['Rut']; ?>" required>

    <label>Nombre:</label>
    <input type="text" name="Nombre" value="<?php echo $row['Nombre']; ?>" required>

    <label>Dirección:</label>
    <input type="text" name="Direccion" value="<?php echo $row['Direccion'] ?? ''; ?>">

    <label>Celular:</label>
    <input type="text" name="Celular" value="<?php echo $row['Celular'] ?? ''; ?>">

    <label>Cargo:</label>
    <input type="text" name="Cargo" value="<?php echo $row['Cargo'] ?? ''; ?>">

    <label>Número de Emergencia:</label>
    <input type="text" name="NumeroEmergencia" value="<?php echo $row['NumeroEmergencia'] ?? ''; ?>">

    <label>Contacto de Emergencia:</label>
    <input type="text" name="ContactoEmergencia" value="<?php echo $row['ContactoEmergencia'] ?? ''; ?>">

    <label>Alergia o Enfermedad:</label>
    <input type="text" name="AlergiaEnfermedad" value="<?php echo $row['AlergiaEnfermedad'] ?? ''; ?>">

    <label>Imagen:</label>
    <input type="file" name="Foto" accept="image/*">
    <p>Imagen actual: <img src="<?php echo $row['Foto']; ?>" alt="Imagen actual" width="100"></p>

    <!-- Lista desplegable para seleccionar si el integrante está activo -->
    <label>Activo:</label>
    <select name="Activo">
        <option value="Si" <?php echo ($row['Activo'] == 1) ? 'selected' : ''; ?>>Sí</option>
        <option value="No" <?php echo ($row['Activo'] == 0) ? 'selected' : ''; ?>>No</option>
    </select>

    <input type="submit" value="Actualizar">
</form>

<button onclick="window.location.href='http://localhost/hueyel/Integrantes/admin_integrantes.php'">Volver</button>

</body>
</html>
