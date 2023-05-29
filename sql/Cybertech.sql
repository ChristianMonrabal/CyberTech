CREATE DATABASE Cybertech;

USE Cybertech;

CREATE TABLE TB_DEPARTAMENTO (
IdDepartamento INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Nombredepartamento VARCHAR(50) NULL,
Descripciondepartamento VARCHAR(90) NULL
);

CREATE TABLE TB_PROFESOR (
IdProfesor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
DNI VARCHAR(9) NULL,
Nombreprofesor VARCHAR(15) NULL,
Apellidoprofesor VARCHAR(30) NULL,
Apellido2profesor VARCHAR(30) NULL,
Email VARCHAR(30) NULL,
Telfprofe VARCHAR(9) NULL,
IdDepartamento INT NULL,
CONSTRAINT IdDepartamento1 FOREIGN KEY (IdDepartamento)
REFERENCES TB_DEPARTAMENTO (IdDepartamento)
);

CREATE TABLE TB_CICLO (
IdCiclo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Nombreciclo VARCHAR(50) NULL,
Etapa VARCHAR(15) NULL
);

CREATE TABLE TB_AULA (
IdAula INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Nombreaula VARCHAR(20) NULL,
Tipoaula VARCHAR(30) NULL,
IdCiclo INT NULL,
CONSTRAINT IdCiclo3 FOREIGN KEY (IdCiclo)
REFERENCES TB_CICLO (IdCiclo)
);

CREATE TABLE TB_CLASE (
IdClase INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Nombreclase VARCHAR(50) NULL,
IdCiclo INT NULL,
Tutor INT NULL,
CONSTRAINT IdProfesor1 FOREIGN KEY (Tutor)
REFERENCES TB_PROFESOR (IdProfesor),
CONSTRAINT IdCiclo1 FOREIGN KEY (IdCiclo)
REFERENCES TB_CICLO (IdCiclo)
);

CREATE TABLE TB_MODULOS (
IdModulos INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Nombremodulos VARCHAR(20) NULL,
IdClase INT NULL,
IdProfesor INT NULL,
IdCiclo INT NULL,
CONSTRAINT IdClase2 FOREIGN KEY (IdClase)
REFERENCES TB_CLASE (IdClase),
CONSTRAINT IdProfesor2 FOREIGN KEY (IdProfesor)
REFERENCES TB_PROFESOR (IdProfesor),
CONSTRAINT IdCiclo FOREIGN KEY (IdCiclo)
REFERENCES TB_CICLO (IdCiclo)
);

CREATE TABLE TB_ALUMNOS (
Matricula INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
DNI VARCHAR(9) NULL,
Nombre VARCHAR(15) NULL,
Apellidoalumno VARCHAR(30) NULL,
Apellido2alumno VARCHAR(30) NULL,
FechaNacimiento DATE NULL,
Dirección VARCHAR(30) NULL,
Telefono VARCHAR(9) NULL,
Email VARCHAR(50) NULL,
IdClase INT NULL,
CONSTRAINT IdClase1 FOREIGN KEY (IdClase)
REFERENCES TB_CLASE (IdClase)
);

CREATE TABLE TB_CICLO_AULA (
IdCicloAula INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
IdCiclo INT NULL,
IdAula INT NULL,
CONSTRAINT IdCiclo2 FOREIGN KEY (IdCiclo)
REFERENCES TB_CICLO (IdCiclo),
CONSTRAINT IdAula1 FOREIGN KEY (IdAula)
REFERENCES TB_AULA (IdAula)
);

CREATE TABLE TB_NOTAS (
IdNotas INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Matricula INT NULL,
IdModulo INT NULL,
CONSTRAINT Matricula1 FOREIGN KEY (Matricula)
REFERENCES TB_ALUMNOS (Matricula)
);

INSERT INTO TB_DEPARTAMENTO (Nombredepartamento, Descripciondepartamento) VALUES
('Departamento de Informática', 'Encargado de los cursos de programación y sistemas.'),
('Departamento de Matemáticas', 'Encargado de los cursos de matemáticas y cálculo'),
('Departamento de Ciencias Sociales', 'Encargado de los cursos de historia y geografía'),
('Departamento de Idiomas', 'Encargado de los cursos de idiomas extranjeros'),
('Departamento de Arte', 'Encargado de los cursos de arte y música'),
('Departamento de Educación Física', 'Encargado de los cursos de educación física');


INSERT INTO TB_PROFESOR (DNI, Nombreprofesor, Apellidoprofesor, Apellido2profesor, Email, Telfprofe, IdDepartamento) VALUES
('31345678A', 'Juan', 'Pérez', 'Gómez', 'jperez@example.com', '123456789', 1),
('32345678A', 'Luis', 'González', 'Martínez', 'lgonzalez@example.com', '987654321', 1),
('33345678A', 'Ana', 'Sánchez', 'Hernández', 'asanchez@example.com', '654321987', 2),
('34345678A', 'Carlos', 'Martínez', 'Pérez', 'cmartinez@example.com', '123456789', 3),
('35345678A', 'Laura', 'Hernández', 'Gómez', 'lhernandez@example.com', '789456123', 4),
('36345678A', 'Pedro', 'Gómez', 'Vargas', 'pgomez@example.com', '987321654', 5);


INSERT INTO TB_CICLO (Nombreciclo, Etapa) VALUES
('ESO', 'Ciclo 2023-2024'),
('BACHILLERATO', 'Ciclo 2024-2025'),
('GRADO MEDIO', 'Ciclo 2024-2025'),
('GRADO SUPERIOR', 'Ciclo 2024-2025'),
('ESO', 'Ciclo 2024-2025'),
('BACHILLERATO', 'Ciclo 2025-2026'),
('ESO', 'Ciclo 2025-2026'),
('GRADO MEDIO', 'Ciclo 2025-2026'),
('GRADO SUPERIOR', 'Ciclo 2025-2026');


INSERT INTO TB_AULA (Nombreaula, Tipoaula, IdCiclo) VALUES
('Aula 101', 'Laboratorio', 1),
('Aula 102', 'Sala de Conferencias', 2),
('Aula 103', 'Laboratorio', 3),
('Aula 104', 'Taller', 4),
('Aula 105', 'Sala de Música', 5),
('Aula 201', 'Laboratorio', 6),
('Aula 202', 'Sala de Conferencias', 7),
('Aula 203', 'Taller', 8),
('Aula 204', 'Sala de Arte', 9);


INSERT INTO TB_CLASE (Nombreclase, IdCiclo, Tutor) VALUES
('SMX1', 1, 1),
('SMX2', 2, 2),
('ASIX1', 3, 3),
('ASIX2', 4, 4),
('DAW1', 5, 5),
('DAW2', 6, 1),
('EAS1', 7, 2),
('EAS2', 8, 3),
('INFANT', 9, 4);


INSERT INTO TB_MODULOS (Nombremodulos, IdClase, IdProfesor, IdCiclo) VALUES
('Módulo 1', 1, 1, 1),
('Módulo 2', 1, 1, 2),
('Módulo 3', 2, 2, 3),
('Módulo 4', 3, 3, 4),
('Módulo 5', 4, 4, 5),
('Módulo 6', 5, 5, 6),
('Módulo 7', 6, 1, 7),
('Módulo 8', 7, 2, 8),
('Módulo 9', 8, 3, 9);


INSERT INTO TB_CICLO_AULA (IdCiclo, IdAula) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

INSERT INTO TB_PROFESOR (DNI, Nombreprofesor, Apellidoprofesor, Apellido2profesor, Email, Telfprofe, IdDepartamento) VALUES
('21345678A', 'Pedro', 'González', 'López', 'pgonzalez@example.com', '987654321', 1),
('22345678A', 'María', 'Sánchez', 'Martínez', 'msanchez@example.com', '123456789', 2),
('23345678A', 'Carlos', 'Hernández', 'Gómez', 'chernandez@example.com', '456789123', 3),
('24345678A', 'Laura', 'López', 'García', 'llopez@example.com', '321654987', 4),
('25345678A', 'David', 'Gómez', 'Vargas', 'dgomez@example.com', '789123456', 5),
('26345678A', 'Ana', 'Pérez', 'Sánchez', 'aperez@example.com', '654987321', 1),
('27345678A', 'Sara', 'García', 'López', 'sgarcia@example.com', '321654987', 2),
('28345678A', 'Javier', 'Martínez', 'Hernández', 'jmartinez@example.com', '987321654', 3),
('29345678A', 'Pablo', 'Hernández', 'González', 'phernandez@example.com', '654789321', 4),
('30345678A', 'Elena', 'González', 'López', 'egonzalez@example.com', '321987654', 5);

INSERT INTO TB_ALUMNOS (DNI, Nombre, Apellidoalumno, Apellido2alumno, FechaNacimiento, Dirección, Telefono, Email, IdClase) VALUES
('12345678Y', 'María', 'López', 'García', '2000-01-01','Calle Principal 123', '987654321', 'mlopez@example.com', 1),
('22345678A', 'Carlos','García', 'López', '2001-03-15', 'Calle Secundaria 456', '654987321', 'cgarcia@example.com', 2),
('32345678A', 'Ana', 'Martínez', 'Sánchez', '2002-07-20', 'Calle Principal 789', '987654987', 'amartinez@example.com', 3),
('32345678F', 'Javier', 'López', 'Hernández', '2001-09-10', 'Calle Secundaria 789', '789654321', 'jlopez@example.com', 4),
('42345678A', 'Sara', 'Hernández', 'Gómez', '2003-01-25', 'Calle Principal 123', '321456987', 'shernandez@example.com', 5),
('52345678A', 'David', 'Gómez', 'Vargas', '2002-05-05', 'Calle Secundaria 321', '456789654', 'dgomez@example.com', 6),
('62345678A', 'Laura', 'Pérez', 'García', '2001-08-12', 'Calle Principal 456', '987654321', 'lperez@example.com', 7),
('72345678A', 'Elena', 'Sánchez', 'Martínez', '2003-04-18', 'Calle Secundaria 123', '654987321', 'esanchez@example.com', 8),
('82345678A', 'Pablo', 'González', 'López', '2002-02-08', 'Calle Principal 987', '789654321', 'pgonzalez@example.com', 9),
('92345678A', 'Luis', 'García', 'Hernández', '2002-04-03', 'Calle Principal 789', '987321654', 'lgarcia@example.com', 2),
('11345678A', 'Marta', 'Hernández', 'Gómez', '2003-06-15',  'Calle Secundaria 123', '654789321', 'mhernandez@example.com', 3),
('12345678B', 'Alberto', 'Gómez', 'Martínez', '2001-10-20',  'Calle Principal 456', '321654987', 'agomez@example.com', 4),
('13345678A', 'Clara', 'Martínez', 'López', '2002-02-25',  'Calle Secundaria 456', '789321654', 'cmartinez@example.com', 5),
('14345678A', 'Manuel', 'López', 'García', '2003-07-05',  'Calle Principal 123', '654987321', 'mlopez@example.com', 6),
('15345678A', 'Isabel', 'García', 'Hernández', '2001-05-12',  'Calle Secundaria 789', '321654987', 'igarcia@example.com', 7),
('16345678A', 'Sergio', 'Hernández', 'Gómez', '2002-09-18',  'Calle Principal 789', '987321654', 'shernandez@example.com', 8),
('17345678A', 'Cristina', 'Gómez', 'Martínez', '2003-11-30',  'Calle Secundaria 123', '654789321', 'cgomez@example.com', 3),
('18345678A', 'Marcos', 'Martínez', 'López', '2001-12-08',  'Calle Principal 456', '321654987', 'mmartinez@example.com', 1),
('19345678A', 'Laura', 'López', 'García', '2002-03-28',  'Calle Secundaria 456', '789321654', 'llopez@example.com', 1),
('12245678A', 'Carlos', 'González', 'Sánchez', '2001-05-10', 'Calle Secundaria 456', '987654321', 'cgonzalez@example.com', 1),
('12445678A', 'Laura', 'Martínez', 'Fernández', '2002-09-15', 'Avenida Central 789', '654321987', 'lmartinez@example.com', 2),
('12545678A', 'Pablo', 'Rodríguez', 'López', '2000-11-20', 'Calle Principal 321', '123456789', 'prodriguez@example.com', 3),
('12645678A', 'Ana', 'Hernández', 'Gómez', '2003-02-25', 'Avenida Central 654', '789456123', 'ahernandez@example.com', 4),
('12745678A', 'Sergio', 'Torres', 'Vargas', '2001-07-08', 'Calle Secundaria 987', '321654987', 'storres@example.com', 5),
('12845678A', 'Lucía', 'Jiménez', 'Moreno', '2002-03-12', 'Avenida Principal 456', '654987321', 'ljimenez@example.com', 6),
('12945678A', 'Pedro', 'Díaz', 'Ramírez', '2000-12-18', 'Calle Secundaria 654', '987321654', 'pdiaz@example.com', 7),
('12345678C', 'Marta', 'Sánchez', 'Pérez', '2003-06-23', 'Avenida Central 789', '321987654', 'msanchez@example.com', 8),
('12315678A', 'Alejandro', 'López', 'García', '2001-09-28', 'Calle Principal 987', '654789321', 'alopez@example.com', 1),
('12325678A', 'Isabel', 'Gómez', 'Martínez', '2002-04-03', 'Avenida Principal 321', '987321654', 'igomez@example.com', 2),
('12335678A', 'Javier', 'Fernández', 'Rodríguez', '2000-08-08', 'Calle Secundaria 654', '321654987', 'jfernandez@example.com', 3),
('12345678A', 'Elena', 'Vargas', 'Hernández', '2003-01-13', 'Avenida Central 987', '654987321', 'evargas@example.com', 4),
('12355678A', 'Andrés', 'Moreno', 'Torres', '2001-04-18', 'Calle Principal 654', '987321654', 'amoreno@example.com', 5),
('12365678A', 'Carolina', 'Ramírez', 'Jiménez', '2002-09-23', 'Avenida Secundaria 789', '321987654', 'cramirez@example.com', 6),
('12375678A', 'Daniel', 'Pérez', 'Díaz', '2000-12-28', 'Calle Principal 321', '654789321', 'dperez@example.com', 7),
('12385678A', 'Sara', 'Martínez', 'Sánchez', '2003-05-05', 'Avenida Central 654', '987654321', 'smartinez@example.com', 1),
('12395678A', 'Hugo', 'González', 'López', '2001-08-10', 'Calle Secundaria 987', '321654987', 'hgonzalez@example.com', 2),
('12345678D', 'Valeria', 'Hernández', 'Fernández', '2002-01-15', 'Avenida Principal 456', '654987321', 'vhernandez@example.com', 3),
('12341678A', 'Marcos', 'Rodríguez', 'Torres', '2000-06-20', 'Calle Principal 789', '987321654', 'mrodriguez@example.com', 4),
('12342678A', 'Carmen', 'López', 'Gómez', '2003-09-25', 'Avenida Secundaria 321', '321654987', 'clopez@example.com', 5),
('12343678A', 'Diego', 'Sánchez', 'Moreno', '2001-02-28', 'Calle Principal 654', '987654321', 'dsanchez@example.com', 6),
('12344678A', 'Marina', 'Jiménez', 'Ramírez', '2002-07-05', 'Avenida Central 987', '654321987', 'mjimenez@example.com', 7),
('23445678A', 'Gonzalo', 'Torres', 'Pérez', '2000-10-10', 'Calle Secundaria 654', '321987654', 'gtorres@example.com', 8),
('12346678A', 'Natalia', 'Díaz', 'García', '2003-01-15', 'Avenida Principal 789', '654789321', 'ndiaz@example.com', 1),
('12347678A', 'Gabriel', 'Gómez', 'Martínez', '2001-04-20', 'Calle Central 321', '987321654', 'ggomez@example.com', 2),
('12348678A', 'Valentina', 'Fernández', 'Rodríguez', '2002-09-25', 'Avenida Principal 654', '321654987', 'vfernandez@example.com', 3),
('12349678A', 'Jorge', 'Vargas', 'Hernández', '2000-12-28', 'Calle Secundaria 987', '654987321', 'jvargas@example.com', 4),
('12349678E', 'Camila', 'Moreno', 'Torres', '2003-03-05', 'Avenida Central 456', '987321654', 'cmoreno@example.com', 5),
('12345178A', 'Santiago', 'Ramírez', 'Jiménez', '2001-06-10', 'Calle Principal 789', '321987654', 'sramirez@example.com', 6),
('12345278A', 'Alicia', 'Pérez', 'Díaz', '2002-11-15', 'Avenida Secundaria 321', '654789321', 'aperez@example.com', 7),
('12345378A', 'Lucas', 'Martínez', 'Sánchez', '2000-02-20', 'Calle Principal 987', '987654321', 'lmartinez@example.com', 8),
('12345478A', 'Emma', 'González', 'López', '2003-05-25', 'Avenida Central 654', '321654987', 'egonzalez@example.com', 1),
('12345578A', 'Mateo', 'Hernández', 'Fernández', '2001-10-01', 'Calle Principal 456', '654987321', 'mhernandez@example.com', 3),
('12345778A', 'Julia', 'Rodríguez', 'Torres', '2002-01-05', 'Avenida Secundaria 789', '987321654', 'jrodriguez@example.com', 4),
('12345878A', 'Benjamín', 'López', 'Gómez', '2000-04-10', 'Calle Central 321', '321654987', 'blopez@example.com', 5),
('12345978A', 'Martina', 'Sánchez', 'Moreno', '2003-07-15', 'Avenida Principal 654', '987654321', 'msanchez@example.com', 6),
('12345678F', 'Juan', 'Jiménez', 'Ramírez', '2001-10-20', 'Calle Secundaria 987', '654321987', 'jjimenez@example.com', 7),
('12345671A', 'Olivia', 'Torres', 'Pérez', '2002-01-25', 'Avenida Central 456', '321987654', 'otorres@example.com', 8),
('12345672A', 'Leo', 'Díaz', 'García', '2000-05-01', 'Calle Principal 789', '654789321', 'ldiaz@example.com', 2),
('12345673A', 'Mía', 'Gómez', 'Martínez', '2003-08-05', 'Avenida Secundaria 321', '987321654', 'mgomez@example.com', 3),
('12345674A', 'Emilia', 'Fernández', 'Rodríguez', '2001-01-10', 'Calle Principal 654', '321654987', 'efernandez@example.com', 4),
('12345675A', 'Nicolás', 'Vargas', 'Hernández', '2002-04-15', 'Avenida Central 987', '654987321', 'nvargas@example.com', 6),
('12345676A', 'Renata', 'Moreno', 'Torres', '2000-07-20', 'Calle Secundaria 654', '987321654', 'rmoreno@example.com', 8),
('12345677A', 'Juan Pablo', 'Ramírez', 'Jiménez', '2003-10-25', 'Avenida Principal 789', '321987654', 'jpramirez@example.com', 2),
('12345687A', 'Valentino', 'Pérez', 'Díaz', '2001-02-01', 'Avenida Secundaria 321', '654789321', 'vperez@example.com', 3);

INSERT INTO TB_NOTAS (Matricula, IdModulo) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);