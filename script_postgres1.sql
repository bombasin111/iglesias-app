-- Tabla iglesias
CREATE TABLE iglesias (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL
);

-- Tabla feligreses
CREATE TABLE feligreses (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ci VARCHAR(15),
    fecha_nacimiento DATE NOT NULL,
    bautizo BOOLEAN DEFAULT FALSE,
    confirmacion BOOLEAN DEFAULT FALSE,
    matrimonio BOOLEAN DEFAULT FALSE,
    pag INTEGER,
    id_iglesia INTEGER REFERENCES iglesias(id)
);

-- Insertar datos de iglesias
INSERT INTO iglesias (id, nombre, usuario, contraseña) VALUES
(1, 'Iglesia Santiago', 'Romulo', '$2y$10$7vsvKyzkJONPkoOrI/D9dOxFKmhlDASCYFbEZybiYirm8eVu7hmVe');

-- Insertar datos de feligreses
INSERT INTO feligreses (id, nombre, ci, fecha_nacimiento, bautizo, confirmacion, matrimonio, pag, id_iglesia) VALUES
(2, 'fabiana rocabado', NULL, '2010-04-07', TRUE, FALSE, FALSE, 0, 1),
(4, 'iga swiantek', NULL, '2020-09-15', TRUE, TRUE, FALSE, 0, 1),
(7, 'diego wallpa', '1248575', '1992-02-25', FALSE, TRUE, FALSE, 0, 1),
(9, 'fabiana rocabado llanos', NULL, '2000-05-23', FALSE, TRUE, TRUE, 1, 1),
(10, 'cisca del campo del valle', '1145871', '1989-08-12', TRUE, TRUE, FALSE, 0, 1);