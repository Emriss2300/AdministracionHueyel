<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Definir la consulta base
$sql = "SELECT * FROM mensualidades";

// Verificar y aplicar los filtros si se enviaron por GET
if (isset($_GET['rut']) && !empty($_GET['rut'])) {
    $rut = $_GET['rut'];
    $sql .= " WHERE Rut LIKE '%$rut%'";
}

if (isset($_GET['anio']) && !empty($_GET['anio'])) {
    $anio = $_GET['anio'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND año = $anio"; 
    } else {
        $sql .= " WHERE año = $anio";
    }
}

if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND Nombre LIKE '%$nombre%'";
    } else {
        $sql .= " WHERE Nombre LIKE '%$nombre%'";
    }
}

if (isset($_GET['fecha_pago']) && !empty($_GET['fecha_pago'])) {
    $fecha_pago = $_GET['fecha_pago'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND FechaPago = '$fecha_pago'";
    } else {
        $sql .= " WHERE FechaPago = '$fecha_pago'";
    }
}

if (isset($_GET['mes']) && !empty($_GET['mes'])) {
    $mes = $_GET['mes'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND Mes LIKE '%$mes%'";
    } else {
        $sql .= " WHERE Mes LIKE '%$mes%'";
    }
}

if (isset($_GET['monto_min']) && !empty($_GET['monto_min'])) {
    $monto_min = $_GET['monto_min'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND Monto >= $monto_min";
    } else {
        $sql .= " WHERE Monto >= $monto_min";
    }
}

if (isset($_GET['monto_max']) && !empty($_GET['monto_max'])) {
    $monto_max = $_GET['monto_max'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND Monto <= $monto_max";
    } else {
        $sql .= " WHERE Monto <= $monto_max";
    }
}

if (isset($_GET['medio_pago']) && !empty($_GET['medio_pago'])) {
    $medio_pago = $_GET['medio_pago'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND MedioPago LIKE '%$medio_pago%'";
    } else {
        $sql .= " WHERE MedioPago LIKE '%$medio_pago%'";
    }
}

// Añadir la cláusula ORDER BY para ordenar por IdTransaccion en orden descendente
$sql .= " ORDER BY IdTransaccion DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Mensualidades</title>
    <!-- Incluir Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .btn-container {
            margin-top: 60px;
        }

        .btn-container::after {
            content: '';
            display: table;
            clear: both;
        }

        .btn-custom {
            margin: 5px;
        }

        .eliminar-btn {
            padding: 6px 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .eliminar-btn:hover {
            background-color: #c82333;
        }
        
        .editar-btn {
            padding: 6px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .editar-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="logo-container">
    <img src="imagenes/icono1.png" alt="Logo de la agrupación" width="120px">
</div>

<h1>Listado de Mensualidades</h1>

<div class="btn-container">
    <a href="../mensualidades/ingresar_mensualidad.php" class="btn btn-primary btn-custom">Ingresar Mensualidades</a>
    <a href="http://localhost/hueyel/Integrantes/admin_integrantes.php" class="btn btn-primary btn-custom">Ver Integrantes</a>
</div>

<form action="" method="GET" class="container mt-4">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="rut">Filtrar por N° Registro Inscripción:</label>
            <input type="text" class="form-control" id="rut" name="rut" value="<?php echo isset($_GET['rut']) ? htmlspecialchars($_GET['rut']) : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="anio">Filtrar por Año:</label>
            <input type="number" class="form-control" id="anio" name="anio" value="<?php echo isset($_GET['anio']) ? htmlspecialchars($_GET['anio']) : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="nombre">Filtrar por Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="fecha_pago">Filtrar por Fecha de Pago:</label>
            <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" value="<?php echo isset($_GET['fecha_pago']) ? htmlspecialchars($_GET['fecha_pago']) : ''; ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="mes">Filtrar por Mes:</label>
            <input type="text" class="form-control" id="mes" name="mes" value="<?php echo isset($_GET['mes']) ? htmlspecialchars($_GET['mes']) : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="monto_min">Monto Mínimo:</label>
            <input type="number" class="form-control" id="monto_min" name="monto_min" step="0.01" value="<?php echo isset($_GET['monto_min']) ? htmlspecialchars($_GET['monto_min']) : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="monto_max">Monto Máximo:</label>
            <input type="number" class="form-control" id="monto_max" name="monto_max" step="0.01" value="<?php echo isset($_GET['monto_max']) ? htmlspecialchars($_GET['monto_max']) : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="medio_pago">Filtrar por Medio de Pago:</label>
            <input type="text" class="form-control" id="medio_pago" name="medio_pago" value="<?php echo isset($_GET['medio_pago']) ? htmlspecialchars($_GET['medio_pago']) : ''; ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>

<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>ID Transacción</th>
            <th>Numero de Inscripción</th>
            <th>Nombre</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Fecha de Pago</th>
            <th>Monto</th>
            <th>Medio de Pago</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='detalle_de_transaccion_pagada.php?id=" . urlencode($fila['IdTransaccion']) . "'>" . htmlspecialchars($fila['IdTransaccion']) . "</a></td>";
                echo "<td>" . htmlspecialchars($fila['NumeroInscripcion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['Nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['Mes']) . "</td>";
                echo "<td>" . (isset($fila['año']) ? htmlspecialchars($fila['año']) : 'N/A') . "</td>";
                echo "<td>" . date('d-m-Y', strtotime($fila['FechaPago'])) . "</td>";
                echo "<td>CLP $" . number_format($fila['Monto'], 0, ',', '.') . "</td>";
                echo "<td>" . htmlspecialchars($fila['MedioPago']) . "</td>";
                echo "<td>
                        <a href='editar_mensualidad.php?id=" . urlencode($fila['IdTransaccion']) . "' class='editar-btn'>Editar</a>
                        <a href='eliminar_mensualidad.php?id=" . urlencode($fila['IdTransaccion']) . "' class='eliminar-btn' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta transacción?\")'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Incluir jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>



