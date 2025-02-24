-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2025 a las 07:12:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iglesias_localidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feligreses`
--

CREATE TABLE `feligreses` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ci` varchar(15) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `bautizo` tinyint(1) DEFAULT 0,
  `confirmacion` tinyint(1) DEFAULT 0,
  `matrimonio` tinyint(1) DEFAULT 0,
  `pag` int(11) DEFAULT NULL,
  `id_iglesia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `feligreses`
--

INSERT INTO `feligreses` (`id`, `nombre`, `ci`, `fecha_nacimiento`, `bautizo`, `confirmacion`, `matrimonio`, `pag`, `id_iglesia`) VALUES
(2, 'fabiana rocabado', '', '2010-04-07', 1, 1, 1, 0, 1),
(4, 'iga swiantek', '', '2020-09-15', 1, 1, 0, 0, 1),
(9, 'fabiana rocabado llanos', '', '2000-05-23', 0, 1, 1, 1, 1),
(10, 'cisca del campo del valle', '1145871', '1989-08-12', 1, 1, 0, 0, 1),
(11, 'juancho sandoval', '', '1988-12-28', 1, 1, 1, 0, 2),
(12, 'clay miranda', '', '1990-07-05', 1, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iglesias`
--

CREATE TABLE `iglesias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `iglesias`
--

INSERT INTO `iglesias` (`id`, `nombre`, `usuario`, `contraseña`) VALUES
(1, 'Iglesia Santiago', 'Romulo', '$2y$10$7vsvKyzkJONPkoOrI/D9dOxFKmhlDASCYFbEZybiYirm8eVu7hmVe'),
(2, 'Catedral - St. Guadalupe', 'St.Guadalupe', '$2y$10$nmq6PO.6lDqdne/4qdQJ/edFv6xLS6O.DQq6gqDotG1hBX67LAnDW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `feligreses`
--
ALTER TABLE `feligreses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_iglesia` (`id_iglesia`);

--
-- Indices de la tabla `iglesias`
--
ALTER TABLE `iglesias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `feligreses`
--
ALTER TABLE `feligreses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `iglesias`
--
ALTER TABLE `iglesias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `feligreses`
--
ALTER TABLE `feligreses`
  ADD CONSTRAINT `feligreses_ibfk_1` FOREIGN KEY (`id_iglesia`) REFERENCES `iglesias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
