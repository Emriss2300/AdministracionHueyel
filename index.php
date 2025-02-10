<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portada</title>
    <style>
        /* Estilos para la página de portada */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        /* Video de fondo */
        video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .title {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: white;
            z-index: 1;
        }
        .menu {
            display: flex;
            justify-content: center;
            gap: 20px;
            z-index: 1;
        }
        .btn {
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .logo-container img {
            width: 320px;  /* Imagen del logo más grande (el doble de tamaño) */
            height: auto;
            margin-bottom: 20px;
            z-index: 1;
        }
    </style>
</head>
<body>

    <!-- Video de fondo -->
    <video autoplay muted loop>
        <source src="imagenes/video1.mp4" type="video/mp4">
        Tu navegador no soporta el formato de video.
    </video>

    <!-- Contenedor del logo -->
    <div class="logo-container">
        <img src="imagenes/imagen1.png" alt="Logo de la agrupación">
    </div>

    <!-- Título principal -->
    <div class="title">
        <h1>Bienvenido al Sistema de Administración</h1>
    </div>

    <!-- Menú de navegación -->
    <div class="menu">
        <a href="http://localhost/hueyel/Mensualidades/registros_mensualidades.php" class="btn">Administración de Mensualidades</a>
        <a href="http://localhost/hueyel/Integrantes/admin_integrantes.php" class="btn">Administración de Integrantes</a>
    </div>

</body>
</html>
