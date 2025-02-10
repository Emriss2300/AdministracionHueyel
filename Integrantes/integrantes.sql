CREATE TABLE integrantes (
    NumeroInscripcion VARCHAR(15) PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Rut VARCHAR(12) NOT NULL,
    Direccion VARCHAR(255),
    Celular VARCHAR(20),
    Cargo VARCHAR(100),
    NumeroEmergencia VARCHAR(20),
    ContactoEmergencia VARCHAR(255),
    AlergiaEnfermedad VARCHAR(255)
);
