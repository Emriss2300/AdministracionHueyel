<?php
include 'C:\xampp\htdocs\hueyel\conexion.php';

// Obtener el último número de inscripción de la base de datos
$sql = "SELECT MAX(NumeroInscripcion) as max_id FROM integrantes";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Extraer el número correlativo y sumarle 1
$last_num = $row['max_id'];
if ($last_num) {
    $last_number = (int)substr($last_num, 2); // Obtener el número después de "A-"
    $new_number = $last_number + 1; // Incrementar el número
} else {
    $new_number = 1; // Si no hay registros previos, comenzar con 1
}

// Formatear el nuevo número de inscripción con "A-" y 3 dígitos
$new_id = "A-" . str_pad($new_number, 3, "0", STR_PAD_LEFT);

$message = "";

// Verificar y crear el directorio 'uploads' si no existe
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroInscripcion = $_POST['NumeroInscripcion'];
    $rut = $_POST['Rut'];
    $nombre = $_POST['Nombre'];
    $direccion = $_POST['Direccion'] ?? '';
    $celular = $_POST['Celular'] ?? '';
    $cargo = $_POST['Cargo'] ?? '';
    $numeroEmergencia = $_POST['NumeroEmergencia'] ?? '';
    $contactoEmergencia = $_POST['ContactoEmergencia'] ?? '';
    $alergiaEnfermedad = $_POST['AlergiaEnfermedad'] ?? '';
    $activo = $_POST['Activo'] ?? 'No'; // Valor por defecto "No" si no se selecciona
    $fotoUrl = ''; // Por defecto vacío

    // Manejo de la imagen
    if (!empty($_FILES["Foto"]["name"])) {
        $fotoNombre = basename($_FILES["Foto"]["name"]);
        $fotoExt = pathinfo($fotoNombre, PATHINFO_EXTENSION);
        $fotoNombreNuevo = "foto_" . time() . "_" . uniqid() . "." . $fotoExt;
        $directorio = "uploads/"; // Guardar en la carpeta 'uploads'
        $rutaFinal = $directorio . $fotoNombreNuevo;

        // Validar que el archivo sea una imagen
        $permitidos = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fotoExt), $permitidos)) {
            if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $rutaFinal)) {
                $fotoUrl = $rutaFinal;
            } else {
                $message = "Error al subir la imagen.";
            }
        } else {
            $message = "Formato de imagen no permitido. Usa JPG, PNG o GIF.";
        }
    }

    // Insertar en la base de datos
    $sqlInsert = "INSERT INTO integrantes (NumeroInscripcion, Rut, Nombre, Direccion, Celular, Cargo, NumeroEmergencia, ContactoEmergencia, AlergiaEnfermedad, Activo, Foto) 
                  VALUES ('$numeroInscripcion', '$rut', '$nombre', '$direccion', '$celular', '$cargo', '$numeroEmergencia', '$contactoEmergencia', '$alergiaEnfermedad', '$activo', '$fotoUrl')";

    if ($conn->query($sqlInsert) === TRUE) {
        $message = "Ingreso satisfactorio.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nuevo Integrante</title>
    <script>
        function redirect() {
            setTimeout(function() {
                window.location.href = 'http://localhost/hueyel/Integrantes/admin_integrantes.php';
            }, 3000);
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            width: 800px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        form label {
            display: block;
            margin-bottom: 15px;
            font-weight: bold;
            width: 30%;
        }
        form input[type="text"], form input[type="file"] {
            width: 65%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        form select {
            width: 65%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            width: 100%;
        }
        .btn-volver {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Agregar Nuevo Integrante</h2>

<?php if (!empty($message)): ?>
    <div id="message"><?php echo $message; ?></div>
    <script>
        redirect();
    </script>
<?php endif; ?>

<form action="agregar.php" method="post" enctype="multipart/form-data">
    <label>Número Inscripción:</label>
    <input type="text" name="NumeroInscripcion" value="<?php echo $new_id; ?>" readonly>
    
    <label>Rut:</label>
    <input type="text" name="Rut" required>

    <label>Nombre:</label>
    <input type="text" name="Nombre" required>

    <label>Dirección:</label>
    <input type="text" name="Direccion">

    <label>Celular:</label>
    <input type="text" name="Celular">

    <label>Cargo:</label>
    <input type="text" name="Cargo">

    <label>Número de Emergencia:</label>
    <input type="text" name="NumeroEmergencia">

    <label>Contacto de Emergencia:</label>
    <input type="text" name="ContactoEmergencia">

    <label>Alergia o Enfermedad:</label>
    <input type="text" name="AlergiaEnfermedad">

    <label>Activo:</label>
    <select name="Activo">
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <label>Foto:</label>
    <input type="file" name="Foto" accept="image/*">

    <input type="submit" value="Agregar">
</form>

<button class="btn-volver" onclick="window.location.href='http://localhost/hueyel/Integrantes/admin_integrantes.php'">Volver</button>

</body>
</html>
