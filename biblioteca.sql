-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2019 a las 23:59:38
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `prefijo` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`nombre`, `prefijo`) VALUES
('Aleman', 'AL'),
('Anatomia', 'AN'),
('Biologia', 'BI'),
('Calculo Diferencial', 'CD'),
('Espanol', 'ES'),
('Football', 'FO'),
('Frances', 'FR'),
('Geometria', 'GM'),
('Historia', 'HT'),
('Ingles', 'IN'),
('Mecanica', 'ME'),
('Quimica', 'QM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `asignatura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `existencia_t` int(11) NOT NULL,
  `existencia_a` int(10) NOT NULL,
  `existencia_p` int(10) NOT NULL,
  `editorial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ano` int(10) NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `volumen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `autor`, `asignatura`, `existencia_t`, `existencia_a`, `existencia_p`, `editorial`, `ano`, `ubicacion`, `volumen`) VALUES
('AL100.2', 'Der Deutsche und du', 'Victor Encina', 'Aleman', 6, 0, 6, 'Paracetamol INC', 2004, 'Alemania', 2),
('AN100.7', 'El Cerebro', 'Victor Encina', 'Anatomia', 22, 3, 19, 'Paracetamol INC', 2007, 'Mexico', 7),
('AN101.1', 'Los Nervios', 'Pablo Moncivaiz', 'Anatomia', 24, 2, 22, 'Guatimoc', 2020, 'Mexico', 1),
('AN102.2', 'Los Pulmones', 'Victor Encina', 'Anatomia', 5, 4, 1, 'Paracetamol INC', 2017, 'Croacia', 2),
('BI100.7', 'El Bisho', 'Carla Gonzalez', 'Biologia', 9, 1, 8, 'Starbacks', 2008, 'Lituania', 7),
('CD100.20', 'Derivadas y tu', 'Gabriela Roman Loera', 'Calculo Diferencial', 7, 1, 6, 'UAA', 2005, 'Eslovaquia', 20),
('CD101.7', 'Limites', 'Enrique Luna', 'Calculo Diferencial', 7, 4, 3, 'Paps Corp', 2017, 'Espana', 7),
('ES100.2', 'La Voz 101', 'Victor Ugarte', 'Espanol', 6, 4, 2, 'Filio Corp', 2015, 'Mexico', 2),
('ES101.1', 'Poemas Absurdos', 'Pablo Gutierrez', 'Espanol', 0, 0, 0, 'UAA', 2002, 'Mexico', 1),
('FO100.2', 'El Bisho', 'Victor Esparza', 'Football', 3, 0, 3, 'Starbacks', 2015, 'Portugal', 2),
('FR100.7', 'Le Baguette', 'El Berns', 'Frances', 5, 3, 2, 'France Corp', 1998, 'Francia', 7),
('FR101.3', 'Parle Vous', 'Pierre LePan', 'Frances', 7, 4, 3, 'France Corp', 2017, 'Inglaterra', 3),
('GM100.2', 'Parabolas y Tu', 'Gabriela Roman Loera', 'Geometria', 6, 2, 4, 'UAA', 2015, 'Mexico', 2),
('ME100.4', 'Jeep 202', 'Javier Nagore', 'Mecanica', 9, 4, 5, 'Starbacks', 2015, 'Estados Unidos', 4),
('ME101.1', 'Autos para Noobies', 'Javier Nagore', 'Mecanica', 1, 0, 1, 'Starbacks', 2010, 'Luxemburgo', 1),
('QM100.7', 'Mil y un maneras de fermentar', 'Laurangas Patas Guangas', 'Quimica', 7, 6, 1, 'Favela', 2008, 'Alemania', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `id` int(11) NOT NULL,
  `id_Prestamo_Causante` int(11) NOT NULL,
  `dias_multa` int(11) NOT NULL,
  `multa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_latvian_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(6) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_pat` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_mat` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `puesto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido_pat`, `apellido_mat`, `puesto`, `pass`) VALUES
(11111, 'Claire', 'Jones', 'Jones', 'Estudiante', 'a'),
(111111, 'Frida', 'Esparza', 'Navarro', 'Admin', 'root'),
(145839, 'Lucas', 'Garcia', 'Salas', 'Estudiante', '1q2w3e4r5t6y'),
(147896, 'Ivan', 'Shavez', 'Wilo', 'Estudiante', '1q2w3e4r5t6y'),
(175287, 'Claire', 'Jones', 'Jones', 'Estudiante', '1q2w3e4r5t6y'),
(189454, 'Greta', 'Holmes', 'Jones', 'Profesor', 'Greta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `id_Persona` int(11) NOT NULL,
  `id_Prestado` varchar(255) COLLATE utf8_german2_ci NOT NULL,
  `fecha_prestado` timestamp NULL DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `dias_restantes` int(11) NOT NULL,
  `status_libro` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `id_Persona`, `id_Prestado`, `fecha_prestado`, `fecha_fin`, `dias_restantes`, `status_libro`) VALUES
(5920, 189454, 'CD100.20', '2019-11-25 20:45:34', '2019-11-28 02:58:05', 2, 'Seguro'),
(85576, 147896, 'QM100.7', '2019-11-25 20:58:25', '2019-11-29 14:58:25', 2, 'Seguro'),
(85654, 175287, 'CD101.7', '2019-11-25 04:09:44', '2019-11-28 02:49:07', 2, 'Seguro'),
(91315, 175287, 'AL100.2', '2019-11-25 04:09:44', '2019-11-28 01:57:29', 2, 'Seguro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multas`
--
ALTER TABLE `multas`
  ADD PRIMARY KEY (`id_Prestamo_Causante`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
