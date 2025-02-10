<?php
include 'C:\xampp\htdocs\hueyel\conexion.php';

$message = "";
$id = $_GET['id'] ?? '';

// Verificar si se ha enviado la confirmación para eliminar
if (isset($_POST['confirmar'])) {
    $sqlDelete = "DELETE FROM integrantes WHERE NumeroInscripcion='$id'";
    if ($conn->query($sqlDelete) === TRUE) {
        $message = "El integrante ha sido eliminado correctamente. Redireccionando...";
        echo "<meta http-equiv='refresh' content='3;url=http://localhost/hueyel/Integrantes/admin_integrantes.php'>";
    } else {
        $message = "Error al eliminar el integrante: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Integrante</title>
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
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="submit"] {
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

<h2>¿Estás seguro de eliminar este integrante?</h2>

<?php if (!empty($message)): ?>
    <div style="color: green; text-align: center; margin-bottom: 20px;"><?php echo $message; ?></div>
<?php endif; ?>

<form action="eliminar.php?id=<?php echo $id; ?>" method="post">
    <input type="submit" name="confirmar" value="Sí, eliminar">
</form>

</body>
</html>
