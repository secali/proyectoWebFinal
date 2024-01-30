-- Inserts actualizados para la tabla Ofertante
INSERT INTO Ofertante (nombreEmpresa, contacto, email) VALUES
    ('Empresa D', 'Contacto D', 'empresa_d@example.com'),
    ('Empresa E', 'Contacto E', 'empresa_e@example.com'),
    ('Empresa F', 'Contacto F', 'empresa_f@example.com'),
    ('Empresa G', 'Contacto G', 'empresa_g@example.com'),
    ('Empresa H', 'Contacto H', 'empresa_h@example.com'),
    ('Empresa I', 'Contacto I', 'empresa_i@example.com'),
    ('Empresa J', 'Contacto J', 'empresa_j@example.com'),
    ('Empresa K', 'Contacto K', 'empresa_k@example.com'),
    ('Empresa L', 'Contacto L', 'empresa_l@example.com'),
    ('Empresa M', 'Contacto M', 'empresa_m@example.com');

-- Inserts actualizados para la tabla Empleos (Oferta)
INSERT INTO Empleos (idOfertante, titulo, descripcion, fechaCierre, estado, categoria) VALUES
    (4, 'Ingeniero de Software', 'Descripción de la oferta para Ingeniero de Software', '2024-03-10 14:00:00', 'abierta', 'Tecnología'),
    (5, 'Especialista en Marketing', 'Descripción de la oferta para Especialista en Marketing', '2024-03-15 16:00:00', 'abierta', 'Marketing'),
    (6, 'Contador Financiero', 'Descripción de la oferta para Contador Financiero', '2024-03-20 12:00:00', 'abierta', 'Finanzas'),
    (7, 'Asistente Administrativo', 'Descripción de la oferta para Asistente Administrativo', '2024-03-25 18:00:00', 'abierta', 'Administración'),
    (8, 'Ingeniero de Redes', 'Descripción de la oferta para Ingeniero de Redes', '2024-03-30 15:00:00', 'abierta', 'Tecnología'),
    (9, 'Diseñador UX/UI', 'Descripción de la oferta para Diseñador UX/UI', '2024-04-05 11:00:00', 'abierta', 'Diseño'),
    (10, 'Analista de Recursos Humanos', 'Descripción de la oferta para Analista de Recursos Humanos', '2024-04-10 14:00:00', 'abierta', 'Recursos Humanos'),
    (1, 'Desarrollador Mobile', 'Descripción de la oferta para Desarrollador Mobile', '2024-04-15 16:00:00', 'abierta', 'Tecnología'),
    (2, 'Ingeniero de Calidad', 'Descripción de la oferta para Ingeniero de Calidad', '2024-04-20 12:00:00', 'abierta', 'Calidad'),
    (3, 'Gestor de Proyectos', 'Descripción de la oferta para Gestor de Proyectos', '2024-04-25 18:00:00', 'abierta', 'Proyectos');

-- Inserts actualizados para la tabla Candidato
INSERT INTO Candidato (nombre, apellido, email, cv) VALUES
    ('Laura', 'García', 'laura@example.com', 'Enlace al CV de Laura'),
    ('Roberto', 'Martínez', 'roberto@example.com', 'Enlace al CV de Roberto'),
    ('Isabel', 'Fernández', 'isabel@example.com', 'Enlace al CV de Isabel'),
    ('Alejandro', 'Hernández', 'alejandro@example.com', 'Enlace al CV de Alejandro'),
    ('Sofía', 'Sánchez', 'sofia@example.com', 'Enlace al CV de Sofía'),
    ('Diego', 'López', 'diego@example.com', 'Enlace al CV de Diego'),
    ('Elena', 'Díaz', 'elena@example.com', 'Enlace al CV de Elena'),
    ('Adrián', 'Gómez', 'adrian@example.com', 'Enlace al CV de Adrián'),
    ('Natalia', 'Torres', 'natalia@example.com', 'Enlace al CV de Natalia'),
    ('Javier', 'Ruíz', 'javier@example.com', 'Enlace al CV de Javier');

-- Inserts actualizados para la tabla Candidaturas
INSERT INTO Candidaturas (idCandidato, idOferta, estado) VALUES
    (4, 4, 'pendiente'),
    (5, 4, 'aceptada'),
    (6, 5, 'pendiente'),
    (7, 5, 'rechazada'),
    (8, 6, 'aceptada'),
    (9, 7, 'pendiente'),
    (10, 8, 'pendiente'),
    (1, 9, 'rechazada'),
    (2, 10, 'pendiente'),
    (3, 1, 'aceptada');

-- Inserts actualizados para la tabla Usuarios (relacionados con Candidatos)
INSERT INTO Usuarios (username, password, tipo, idRelacionado) VALUES
    ('laura_username', 'password_laura', 'candidato', 4),
    ('roberto_username', 'password_roberto', 'candidato', 5),
    ('isabel_username', 'password_isabel', 'candidato', 6),
    ('alejandro_username', 'password_alejandro', 'candidato', 7),
    ('sofia_username', 'password_sofia', 'candidato', 8),
    ('diego_username', 'password_diego', 'candidato', 9),
    ('elena_username', 'password_elena', 'candidato', 10),
    ('adrian_username', 'password_adrian', 'candidato', 1),
    ('natalia_username', 'password_natalia', 'candidato', 2),
    ('javier_username', 'password_javier', 'candidato', 3);

-- Inserts actualizados para la tabla Usuarios (relacionados con Ofertantes)
INSERT INTO Usuarios (username, password, tipo, idRelacionado) VALUES
    ('empresa_d_username', 'password_empresa_d', 'ofertante', 4),
    ('empresa_e_username', 'password_empresa_e', 'ofertante', 5),
    ('empresa_f_username', 'password_empresa_f', 'ofertante', 6),
    ('empresa_g_username', 'password_empresa_g', 'ofertante', 7),
    ('empresa_h_username', 'password_empresa_h', 'ofertante', 8),
    ('empresa_i_username', 'password_empresa_i', 'ofertante', 9),
    ('empresa_j_username', 'password_empresa_j', 'ofertante', 10),
    ('empresa_k_username', 'password_empresa_k', 'ofertante', 1),
    ('empresa_l_username', 'password_empresa_l', 'ofertante', 2),
    ('empresa_m_username', 'password_empresa_m', 'ofertante', 3);
