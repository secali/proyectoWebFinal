-- Creación de la tabla Candidato
CREATE TABLE Candidato (
    idCandidato INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    cv TEXT,
    fechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP,
    password VARCHAR(255) NOT NULL
);

-- Creación de la tabla Ofertante
CREATE TABLE Ofertante (
    idOfertante INT AUTO_INCREMENT PRIMARY KEY,
    nombreEmpresa VARCHAR(100) NOT NULL,
    contacto VARCHAR(100),
    email VARCHAR(100) NOT NULL UNIQUE,
    fechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP,
    password VARCHAR(255) NOT NULL
);

-- Creación de la tabla Oferta
CREATE TABLE Empleos (
    idOferta INT AUTO_INCREMENT PRIMARY KEY,
    idOfertante INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    categoria VARCHAR(255),
    fechaPublicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fechaCierre DATETIME,
    estado ENUM('abierta', 'cerrada') DEFAULT 'abierta',
    FOREIGN KEY (idOfertante) REFERENCES Ofertante(idOfertante)
);

CREATE TABLE Candidaturas (
    idAplicacion INT AUTO_INCREMENT PRIMARY KEY,
    idCandidato INT NOT NULL,
    idOferta INT NOT NULL,
    fechaAplicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente',
    FOREIGN KEY (idCandidato) REFERENCES Candidato(idCandidato),
    FOREIGN KEY (idOferta) REFERENCES Empleos(idOferta)
);

