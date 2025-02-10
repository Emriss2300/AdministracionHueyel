-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2024 a las 22:33:33
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agrupacionhueyel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrantes`
--

CREATE TABLE `integrantes` (
  `NumeroInscripcion` varchar(15) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Rut` varchar(12) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Celular` varchar(20) DEFAULT NULL,
  `Cargo` varchar(100) DEFAULT NULL,
  `NumeroEmergencia` varchar(20) DEFAULT NULL,
  `ContactoEmergencia` varchar(255) DEFAULT NULL,
  `AlergiaEnfermedad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `integrantes`
--

INSERT INTO `integrantes` (`NumeroInscripcion`, `Nombre`, `Rut`, `Direccion`, `Celular`, `Cargo`, `NumeroEmergencia`, `ContactoEmergencia`, `AlergiaEnfermedad`) VALUES
('000001', 'Fernanda Catalina Nuñez Ortiz', '19262779-6', 'Pasaje Socoroma 2300, villa San Nicolas, rancagua', '+569 8888 8888', 'Bailarina', '+569 44445555', 'Lucila', 'Ninguna'),
('000003', 'Luis Alfonzo Bernay Hernández', '33533374-4', 'Pasaje Socoroma #2300, Villa San Nicolas, Rancagua.', '+56 9 56283656', 'Bailarín', '+569 66375931', 'Francisco Nuñez', 'Alergia al Sol.'),
('000005', 'Francisco Enrique Nuñez Aravena', '10169698-7', 'Socoroma #2300, Villa San Nicolas, Rancagua', '+56966375931', 'Coordinador de Piso', '+56966375931', 'Francisco Nuñez ', 'Diabetes'),
('000006', 'Francisco Jesús Núñez Ortiz', '17507715-4', 'Pasaje Socoroma #2300, villa San Nicolás, Rancagua.', '+56966375931', 'Director Artístico', '56922222222', 'Lucila Ortiz', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensualidades`
--

CREATE TABLE `mensualidades` (
  `IdTransaccion` varchar(6) NOT NULL,
  `Rut` varchar(12) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `FechaPago` date NOT NULL,
  `Mes` varchar(11) NOT NULL,
  `año` int(11) NOT NULL,
  `Monto` decimal(10,0) NOT NULL,
  `MedioPago` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensualidades`
--

INSERT INTO `mensualidades` (`IdTransaccion`, `Rut`, `Nombre`, `FechaPago`, `Mes`, `año`, `Monto`, `MedioPago`) VALUES
('000001', 'A-021', 'IGNACIO SEPULVEDA', '2024-05-01', 'JUNIO', 2024, 5000, 'Transferencia'),
('000002', 'A-020', 'GABRIELA VERGARA', '2024-04-28', 'ABRIL', 2024, 5000, 'Transferencia'),
('000003', 'A-004', 'GRACE', '2024-04-30', 'ABRIL', 2024, 5000, 'Transferencia'),
('000004', 'A-002', 'MONSERRAT ARROS', '2024-05-05', 'MARZO', 2024, 5000, 'Transferencia'),
('000005', 'A-002', 'MONSERRAT ARROS', '2024-05-05', 'ABRIL', 2024, 5000, 'Transferencia'),
('000006', 'A-002', 'MONSERRAT ARROS', '2024-05-05', 'MAYO', 2024, 5000, 'Transferencia'),
('000007', 'A-002', 'MONSERRAT ARROS', '2024-05-05', 'JUNIO', 2024, 5000, 'Transferencia'),
('000008', 'A-012', 'CRISTOBAL', '2024-05-05', 'MAYO', 2024, 5000, 'Transferencia'),
('000009', 'A-020', 'GABRIELA VERGARA', '2024-05-05', 'MAYO', 2024, 5000, 'Transferencia'),
('000010', 'A-018', 'AMAYA URIBE', '2024-05-11', 'MAYO', 2024, 5000, 'Transferencia'),
('000011', 'A-016', 'PALOMA URIBE', '2024-05-11', 'MAYO', 2024, 5000, 'Transferencia'),
('000012', 'A-019', 'MARIA VASQUEZ', '2024-05-12', 'MAYO', 2024, 5000, 'Transferencia'),
('000013', 'A-001', 'CLAUDIA ARROS', '2024-05-12', 'JULIO', 2024, 5000, 'Transferencia'),
('000014', 'A-001', 'CLAUDIA ARROS', '2024-05-12', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000015', 'A-001', 'CLAUDIA ARROS', '2024-05-12', 'SEPTIEMBRE', 2024, 5000, 'Transferencia'),
('000016', 'A-001', 'CLAUDIA ARROS', '2024-05-12', 'OCTUBRE', 2024, 5000, 'Transferencia'),
('000017', 'A-004', 'GRACE', '2024-05-12', 'MAYO', 2024, 5000, 'Transferencia'),
('000018', 'A-011', 'HECTOR', '2024-05-12', 'MAYO', 2024, 5000, 'Transferencia'),
('000019', 'A-013', 'ENRIQUE RIVERA', '2024-05-12', 'MAYO', 2024, 5000, 'Transferencia'),
('000020', 'A-003', 'FERNANDA CANALES', '2024-05-12', 'MAYO', 2004, 5000, 'Transferencia'),
('000021', 'A-009', 'MACARENA LOPEZ', '2024-05-24', 'JUNIO', 2024, 5000, 'Transferencia'),
('000022', 'A-009', 'MACARENA LOPEZ', '2024-05-24', 'JULIO', 2024, 5000, 'Transferencia'),
('000023', 'A-006', 'TOMAS CRUZ', '2024-06-01', 'ENERO', 2024, 5000, 'Transferencia'),
('000024', 'A-006', 'TOMAS CRUZ', '2024-06-01', 'MAYO', 2024, 5000, 'Transferencia'),
('000025', 'A-008', 'SOFIA JERIA', '2024-06-07', 'JUNIO', 2024, 5000, 'Transferencia'),
('000026', 'A-008', 'SOFIA JERIA', '2024-06-07', 'JULIO', 2024, 5000, 'Transferencia'),
('000027', 'A-005', 'TRINIDAD COFRE', '2024-06-07', 'MAYO', 2024, 5000, 'Transferencia'),
('000028', 'A-005', 'TRINIDAD COFRE', '2024-06-07', 'JUNIO', 2024, 5000, 'Transferencia'),
('000029', 'A-019', 'MARIA VASQUEZ', '2024-06-04', 'JUNIO', 2024, 5000, 'Transferencia'),
('000030', 'A-019', 'MARIA VASQUEZ', '2024-06-07', 'JULIO', 2024, 5000, 'Transferencia'),
('000031', 'A-019', 'MARIA VASQUEZ', '2024-06-07', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000032', 'A-019', 'MARIA VASQUEZ', '2024-06-07', 'SEPT', 2024, 5000, 'Transferencia'),
('000033', 'A-019', 'MARIA VASQUEZ', '2024-06-07', 'OCTUBRE', 2024, 5000, 'Transferencia'),
('000034', 'A-013', 'ENRIQUE RIVERA', '2024-06-11', 'JUNIO', 2024, 5000, 'Transferencia'),
('000035', 'A-013', 'ENRIQUE RIVERA', '2024-06-11', 'JULIO', 2024, 5000, 'Transferencia'),
('000036', 'A-014', 'KATHERINE SOTO', '2024-06-12', 'MAYO', 2024, 5000, 'Transferencia'),
('000037', 'A-014', 'KATHERINE SOTO', '2024-06-12', 'JUNIO', 2024, 5000, 'Transferencia'),
('000038', 'A-015', 'GUILLERMO SOTO', '2024-06-12', 'MAYO', 2024, 5000, 'Transferencia'),
('000039', 'A-015', 'GUILLERMO SOTO', '2024-06-12', 'JUNIO', 2024, 5000, 'Transferencia'),
('000040', 'A-020', 'GABRIELA VERGARA', '2024-06-15', 'JUNIO', 2024, 5000, 'Transferencia'),
('000041', 'A-003', 'FERNANDA CANALES', '2024-06-23', 'JUNIO', 2024, 5000, 'Transferencia'),
('000042', 'A-016', 'PALOMA URIBE', '2024-06-26', 'JUNIO', 2024, 5000, 'Transferencia'),
('000043', 'A-018', 'AMAYA URIBE', '2024-06-26', 'JUNIO', 2024, 5000, 'Transferencia'),
('000044', 'A-008', 'SOFIA JERIA', '2024-07-14', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000045', 'A-002', 'MONSERRAT ARROS', '2024-07-14', 'JULIO', 2024, 5000, 'Transferencia'),
('000046', 'A-002', 'MONSERRAT ARROS', '2024-07-14', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000047', 'A-002', 'MONSERRAT ARROS', '2024-07-14', 'SEPTIEMBRE', 2024, 5000, 'Transferencia'),
('000048', 'A-022', 'LILIAN GARCES', '2024-07-14', 'JUNIO', 2024, 5000, 'Transferencia'),
('000049', 'A-022', 'LILIAN GARCES', '2024-07-14', 'JULIO', 2024, 5000, 'Transferencia'),
('000050', 'A-023', 'JUAN GARCES', '2024-07-14', 'JUNIO', 2024, 5000, 'Transferencia'),
('000051', 'A-003', 'FERNANDA CANALES', '2024-07-11', 'JULIO', 2024, 5000, 'Transferencia'),
('000052', 'A-021', 'IGNACIO SEPULVEDA', '2024-07-15', 'JULIO', 2024, 5000, 'Transferencia'),
('000053', 'A-010', 'IVAN', '2024-07-17', 'JUNIO', 2024, 5000, 'Transferencia'),
('000054', 'A-010', 'IVAN', '2024-07-17', 'JULIO', 2024, 5000, 'Transferencia'),
('000055', 'A-009', 'MACARENA LOPEZ', '0024-08-05', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000056', 'A-009', 'MACARENA LOPEZ', '2024-08-05', 'SEPTIEMBRE', 2024, 5000, 'Transferencia'),
('000057', 'A-013', 'ENRIQUE RIVERA', '2024-08-10', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000058', 'A-013', 'ENRIQUE RIVERA', '2024-08-10', 'SEPTIEMBRE', 2024, 5000, 'Transferencia'),
('000059', 'A-016', 'PALOMA URIBE', '2024-07-27', 'JULIO', 2024, 5000, 'Transferencia'),
('000060', 'A-018', 'AMAYA URIBE', '2024-07-27', 'JULIO', 2024, 5000, 'Transferencia'),
('000061', 'A-022', 'LILIAN GARCES', '2024-08-06', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000062', 'A-022', 'LILIAN GARCES', '2024-08-06', 'SEPTIEMBRE', 2024, 5000, 'Transferencia'),
('000063', 'A-018', 'AMAYA URIBE', '2024-08-15', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000064', 'A-016', 'PALOMA URIBE', '2024-08-15', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000065', 'A-014', 'KATHERINE SOTO', '2024-07-23', 'JULIO', 2024, 5000, 'Transferencia'),
('000066', 'A-015', 'GUILLERMO SOTO', '2024-07-23', 'JULIO', 2024, 5000, 'Transferencia'),
('000067', 'A-017', 'LUCAS ', '0001-01-01', 'JULIO', 2024, 5000, 'Transferencia'),
('000068', 'A-021', 'IGNACIO SEPULVEDA', '2024-03-10', 'MARZO', 2024, 5000, 'Transferencia'),
('000069', 'A-021', 'IGNACIO SEPULVEDA', '2024-03-15', 'ABRIL', 2024, 5000, 'Transferencia'),
('000070', 'A-021', 'IGNACIO SEPULVEDA', '2024-03-15', 'MAYO', 2024, 5000, 'Transferencia'),
('000071', 'A-020', 'GABRIELA VERGARA', '2024-07-18', 'JULIO', 2024, 5000, 'Transferencia'),
('000072', 'A-020', 'GABRIELA VERGARA', '2024-08-18', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000073', 'A-005', 'TRINIDAD COFRE', '2024-08-13', 'JULIO', 2024, 5000, 'Transferencia'),
('000074', 'A-005', 'TRINIDAD COFRE', '2024-08-13', 'AGOSTO', 2024, 5000, 'Transferencia'),
('000075', 'A-010', 'IVAN ', '2024-08-20', 'AGOSTO', 2024, 5000, 'Transferencia'),
("000076","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000077","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000078","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000079","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000080","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000081","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000082","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000083","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000084","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000085","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000086","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000087","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000088","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000089","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000090","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000091","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000092","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000093","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000094","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000095","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000096","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia"),
("000097","A-Info","Sin Información","09-02-2025","enero","2024","5000","Transferencia");

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `integrantes`
--
ALTER TABLE `integrantes`
  ADD PRIMARY KEY (`NumeroInscripcion`);

--
-- Indices de la tabla `mensualidades`
--
ALTER TABLE `mensualidades`
  ADD PRIMARY KEY (`IdTransaccion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
