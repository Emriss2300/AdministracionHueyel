CREATE TABLE mensualidades (
    IdTransaccion VARCHAR(6) PRIMARY KEY,
    Rut VARCHAR(12) NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    FechaPago DATE NOT NULL,
    Mes INT NOT NULL,
    Año INT NOT NULL,
    Monto DECIMAL(10, 2) NOT NULL,
    MedioPago VARCHAR(100)
);
