-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 27-05-2023 a las 19:46:12
-- Versión del servidor: 5.7.34
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fucla`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usuario`, `clave`, `nombre`) VALUES
(1, 'admin', 'Admin.123', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellido` varchar(35) NOT NULL,
  `documento` varchar(11) NOT NULL,
  `cargo` varchar(25) NOT NULL,
  `telefono` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nombre`, `apellido`, `documento`, `cargo`, `telefono`) VALUES
(7, 'juan', 'ortiz mena', '1278912328', 'administrativo', '3225432346'),
(8, 'felipe', 'mendoza aguilar', '1268912328', 'administrativo', '3215430346'),
(9, 'esteven', 'mendez mena', '1208962328', 'administrativo', '3226430341'),
(10, 'juan', 'ortiz mena', '1278912329', 'profesor', '3235662346'),
(11, 'gimena', 'herrera mena', '1278912307', 'profesor', '3135662346'),
(12, 'laura', 'perez hinestrosa', '1273912320', 'profesor', '3245662340');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellido` varchar(35) NOT NULL,
  `identificacion` varchar(11) NOT NULL,
  `carrera` varchar(35) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `nombre`, `apellido`, `identificacion`, `carrera`, `correo`, `telefono`) VALUES
(1, 'juan esteban', 'mena mena', '1078912328', 'ing sistemas', 'jemena@miuniclaretian.edu.co', '3225432345'),
(2, 'juan camilo', 'aguirre cortes', '1189023439', 'ing sistemas', 'jcaguirre@miuniclaretian.edu.co', '3218928990'),
(3, 'maria camila', 'mena urrego', '1092876288', 'ing sistemas', 'mcmena@miuniclaretian.edu.co', '3145678902'),
(4, 'esteban', 'urrego mena', '1890897223', 'ing sistemas', 'esurrego@miuniclaretian.edu.co', '3156728909'),
(5, 'paola ', 'cortes velasques', '1567890213', 'ing sistemas', 'pacortes@miuniclaretian.edu.co', '3146752890'),
(6, 'esperanza ', 'gomez mena', '1234567890', 'ing industrial', 'esgomez@miuniclaretian.edu.co', '3124567890'),
(7, 'juan ', 'perez cortes', '1342541230', 'ing industrial', 'juperez@miuniclaretian.edu.co', '3167893212'),
(8, 'camila fernanda', 'inestrosa guebara', '1045678980', 'ing industrial', 'cfinestrosa@miuniclaretian.edu.co', '3224567890'),
(9, 'miguel', 'cataño perez', '1987654321', 'ing industrial', 'micataño@miuniclaretian.edu.co', '3008792134'),
(10, 'nathaly yineth ', 'cortes mena', '1209098910', 'ing industrial', 'nycortes@miuniclaretian.edu.co', '3136662200'),
(11, 'judith ', 'gomez mena', '1982323112', 'psicologia', 'jugomez@miuniclaretian.edu.co', '3009876534'),
(12, 'milena ster ', 'muñoz cortes', '1022678902', 'psicologia', 'msmuñoz@miuniclaretian.edu.co', '3042139033'),
(13, 'fernanda', 'sepulveda guebara', '1067878980', 'psicologia', 'fesepulveda@miuniclaretian.edu.co', '3224567891'),
(14, 'miguel angel', 'cataño suarez', '1977654321', 'psicologia', 'micataño@miuniclaretian.edu.co', '3008792136'),
(15, 'paolo ', 'zuñiga mena', '1309098910', 'psicologia', 'pasuñiga@miuniclaretian.edu.co', '3136662201');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
