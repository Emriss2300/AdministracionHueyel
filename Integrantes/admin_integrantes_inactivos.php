<?php
// Incluimos el archivo de conexión a la base de datos.
include 'C:\xampp\htdocs\hueyel\conexion.php';

// Consulta SQL para obtener los registros de integrantes con estado "No"
$sql = "SELECT * FROM integrantes WHERE Activo = 'No'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Integrantes</title>
    <style>
        /* Estilos CSS para el cuerpo y los elementos de la página */
        body {
            font-family: Arial, sans-serif;
            position: relative;
            margin: 50px;
        }
        td {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .center-title {
            text-align: center;
            margin-top: 20px;
        }
        .logo-container {
            position: absolute; /* Posiciona el logo */
            top: 10px; /* Espacio desde la parte superior */
            left: 10px; /* Espacio desde la izquierda */
        }
        /* Contenedor para los botones */
        .buttons-container {
            display: flex;
            justify-content: flex-end; /* Alinea los botones a la derecha */
            gap: 10px; /* Espacio entre los botones */
            margin-top: 20px;
        }
        .add-button {
            background-color: #007bff; /* Color azul para agregar */
        }
        .volver-button {
            background-color: #dc3545; /* Color rojo para volver */
        }
        .inicio-button {
            background-color: #28a745; /* Color verde para inicio */
        }
        form {
            margin-top: 120px; /* Ajusta el margen superior según lo necesites */
            text-align: center;
        }
        form input[type="text"] {
            padding: 10px;
            width: 200px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        /* Nueva modificación para la imagen y la tabla */
        .logo-container img {
            width: 130px; /* Ancho de la imagen incrementado en 1 cm */
            height: auto;
        }
        .table-container {
            margin-top: 120px; /* Ajustado para mover la tabla más abajo */
        }
    </style>
</head>
<body>
<div class="logo-container">
    <img src="imagenes/imagen1.png" alt="Logo de la agrupación">
</div>

<!-- Sección principal de la página -->
<div>
    <h1 class="center-title">Lista de Integrantes</h1>
    
    <!-- Contenedor para los botones -->
    <div class="buttons-container">
        <!-- Botón para agregar nuevo integrante -->
        <a href="agregar.php" class="btn add-button">Agregar Nuevo Integrante</a>
        
        <!-- Botón para volver -->
        <a href="http://localhost/hueyel/Integrantes/admin_integrantes.php" class="btn volver-button">Volver</a>
        
        <!-- Botón para ir al inicio -->
        <a href="http://localhost/hueyel/index.php" class="btn inicio-button">Inicio</a>
    </div>

    <!-- Tabla para mostrar los integrantes -->
    <div class="table-container" style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Registro</th>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                    <th>N° Emerg.</th>
                    <th>Contac. Emerg.</th>
                    <th>Patologías</th>
                    <th>Activo</th> <!-- Nueva columna -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar registros si existen
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='detalle_registro.php?id=" . $row['NumeroInscripcion'] . "'>" . $row['NumeroInscripcion'] . "</a></td>";
                        echo "<td>" . $row['Nombre'] . "</td>";
                        echo "<td>" . $row['Rut'] . "</td>";
                        echo "<td>" . $row['Direccion'] . "</td>";
                        echo "<td>" . $row['Celular'] . "</td>";
                        echo "<td>" . $row['Cargo'] . "</td>";
                        echo "<td>" . $row['NumeroEmergencia'] . "</td>";
                        echo "<td>" . $row['ContactoEmergencia'] . "</td>";
                        echo "<td>" . $row['AlergiaEnfermedad'] . "</td>";
                        // Mostrar el estado de "Activo"
                        echo "<td>" . $row['Activo'] . "</td>";
                        echo "<td>";
                        echo "<a href='editar.php?id=" . $row['NumeroInscripcion'] . "'>Editar</a> | ";
                        echo "<a href='eliminar.php?id=" . $row['NumeroInscripcion'] . "' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Mostrar mensaje si no hay registros
                    echo "<tr><td colspan='11'>No hay registros de integrantes.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
