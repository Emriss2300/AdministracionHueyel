<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha Clínica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f8f9fa;
            margin: 0;
            padding-bottom: 10px; /* Añadido para el pie de página */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden; /* Evita el desplazamiento horizontal */
        }
        .container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center; /* Centra el contenido del encabezado */
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px; /* Aumento el tamaño del logo */
            align-self: flex-start;
        }
        .title-container {
            flex-grow: 1;
            text-align: center;
        }
        h2 {
            color: #333;
            margin: 0;
        }
        .photo-container {
            margin-left: 10px;
        }
        .photo-container img {
            width: 200px;  /* Imagen más grande */
            height: 200px; /* Imagen más grande */
            object-fit: contain; /* Ajuste sin cortar */
            border-radius: 0%; /* Elimina el borde redondeado */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }
        .btn-return {
            background-color: red;
        }
        .btn-print {
            background-color: blue;
        }

        /* Estilos específicos para la impresión */
        @media print {
            body {
                padding: 0;
                background-color: white;
            }
            .container {
                width: 100%;
                margin: 0;
                box-shadow: none;
                padding: 10px;
            }
            .header {
                display: flex;
                justify-content: center; /* Centra el encabezado */
                align-items: center;
                margin-bottom: 15px;
            }
            .header img {
                width: 180px; /* Aumento aún más el tamaño del logo para centrado */
            }
            .title-container {
                text-align: center; /* Centrado del título al imprimir */
                margin-left: 0;
                flex-grow: 1;
            }
            h2 {
                font-size: 20px;
                text-align: center; /* Asegura que el título esté centrado */
            }
            .photo-container img {
                width: 200px;
                height: 200px;
                object-fit: contain;
            }
            table {
                font-size: 12px;
                margin: auto;
                width: 90%;
            }
            th, td {
                padding: 5px;
            }
            .button-container {
                display: none; /* Ocultar botones de la impresión */
            }

            /* Pie de página centrado en la impresión */
            .footer {
                position: fixed;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 12px;
                color: #666;
                text-align: center;
            }
        }

        /* Estilos del pie de página centrado en la pantalla */
        .footer {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #f1f1f1;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="imagenes/imagen1.png" alt="Logo">
        <div class="title-container">
            <h2>Ficha Personal de Inscripción</h2>
        </div>
        <div class="photo-container">
            <?php
            include 'C:\xampp\htdocs\hueyel\conexion.php';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM integrantes WHERE NumeroInscripcion = '$id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                } else {
                    die("Registro no encontrado");
                }
            } else {
                die("ID no proporcionado");
            }

            echo "<!-- Ruta de la foto: uploads/" . $row['Foto'] . " -->";
            ?>
            <img src="<?php echo $row['Foto']; ?>" alt="Imagen actual">
        </div>
    </div>

    <table>
        <tr><th>Registro</th><td><?php echo $row['NumeroInscripcion']; ?></td></tr>
        <tr><th>Nombre</th><td><?php echo $row['Nombre']; ?></td></tr>
        <tr><th>RUT</th><td><?php echo $row['Rut']; ?></td></tr>
        <tr><th>Dirección</th><td><?php echo $row['Direccion']; ?></td></tr>
        <tr><th>Celular</th><td><?php echo $row['Celular']; ?></td></tr>
        <tr><th>Cargo</th><td><?php echo $row['Cargo']; ?></td></tr>
        <tr><th>N° Emerg.</th><td><?php echo $row['NumeroEmergencia']; ?></td></tr>
        <tr><th>Contac. Emerg.</th><td><?php echo $row['ContactoEmergencia']; ?></td></tr>
        <tr><th>Patologías</th><td><?php echo $row['AlergiaEnfermedad']; ?></td></tr>
    </table>

    <div class="button-container">
        <button class="button btn-return" onclick="window.location.href='admin_integrantes.php'">Volver</button>
        <button class="button btn-print" onclick="window.print()">Imprimir</button>
    </div>
</div>

<!-- Pie de página centrado en la pantalla -->
<div class="footer">
    <?php
    echo "Fecha y hora: " . date('d-m-Y H:i:s');
    ?>
</div>

</body>
</html>
