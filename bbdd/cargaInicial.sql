-- Inserción en la tabla Candidato
INSERT INTO Candidato (nombre, apellido, email, cv)
VALUES ('Juan', 'Pérez', 'juan@example.com', 'Experiencia en desarrollo web.');

-- Inserción en la tabla Ofertante
INSERT INTO Ofertante (nombreEmpresa, contacto, email)
VALUES ('Empresa XYZ', 'John Doe', 'info@empresa-xyz.com');

-- Inserción en la tabla Empleos (Oferta)
INSERT INTO Empleos (idOfertante, titulo, descripcion, categoria, fechaCierre)
VALUES (1, 'Desarrollador Web', 'Se busca desarrollador con experiencia en PHP y MySQL.', 'Tecnología', '2024-02-10 00:00:00');

-- Inserción en la tabla Candidaturas
INSERT INTO Candidaturas (idCandidato, idOferta, estado)
VALUES (1, 1, 'pendiente');

-- Inserción en la tabla Usuarios (Candidato)
INSERT INTO Usuarios (username, password, tipo, idRelacionado)
VALUES ('juan_candidato', 'clave123', 'candidato', 1);

-- Inserción en la tabla Usuarios (Ofertante)
INSERT INTO Usuarios (username, password, tipo, idRelacionado)
VALUES ('empresa_xyz', 'clave456', 'ofertante', 1);
