-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 28-05-2023 a las 03:35:52
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
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ingreso` (
  `id_ingreso` int(11) NOT NULL,
  `id_colaboradores` int(11) NULL,
  `id_estudiante` int(11) NULL,
  `fechaingreso` datetime,
  `fechasalida` datetime,
  `ingresoEstado` boolean 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `nombre`) VALUES
(1, 'ing sistemas'),
(2, 'ing industrial'),
(3, 'psicologia');

INSERT INTO `cargo` (`id_cargo`, `nombre`) VALUES
(1, 'administrativo'),
(2, 'docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellido` varchar(35) NOT NULL,
  `documento` varchar(11) NOT NULL,
  `cargo` int(10) NOT NULL,
  `telefono` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nombre`, `apellido`, `documento`, `cargo`, `telefono`) VALUES
(1, 'juan', 'ortiz mena', '1278912328', 1, '3225432346'),
(2, 'felipe', 'mendoza aguilar', '1268912328', 1, '3215430346'),
(3, 'esteven', 'mendez mena', '1208962328', 1, '3226430341'),
(4, 'juan', 'ortiz mena', '1278912329', 2, '3235662346'),
(5, 'gimena', 'herrera mena', '1278912307', 2, '3135662346'),
(6, 'laura', 'perez hinestrosa', '1273912320', 2, '3245662340');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellido` varchar(35) NOT NULL,
  `identificacion` varchar(11) NOT NULL,
  `carrera` int(10) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `nombre`, `apellido`, `identificacion`, `carrera`, `correo`, `telefono`) VALUES
(1, 'juan esteban', 'mena mena', '1078912328', 1, 'jemena@miuniclaretian.edu.co', '3225432345'),
(2, 'juan camilo', 'aguirre cortes', '1189023439', 1, 'jcaguirre@miuniclaretian.edu.co', '3218928990'),
(3, 'maria camila', 'mena urrego', '1092876288', 1, 'mcmena@miuniclaretian.edu.co', '3145678902'),
(4, 'esteban', 'urrego mena', '1890897223', 1, 'esurrego@miuniclaretian.edu.co', '3156728909'),
(5, 'paola ', 'cortes velasques', '1567890213', 1, 'pacortes@miuniclaretian.edu.co', '3146752890'),
(6, 'esperanza ', 'gomez mena', '1234567890', 2, 'esgomez@miuniclaretian.edu.co', '3124567890'),
(7, 'juan ', 'perez cortes', '1342541230', 2, 'juperez@miuniclaretian.edu.co', '3167893212'),
(8, 'camila fernanda', 'inestrosa guebara', '1045678980', 2, 'cfinestrosa@miuniclaretian.edu.co', '3224567890'),
(9, 'miguel', 'cataño perez', '1987654321', 2, 'micataño@miuniclaretian.edu.co', '3008792134'),
(10, 'nathaly yineth ', 'cortes mena', '1209098910', 2, 'nycortes@miuniclaretian.edu.co', '3136662200'),
(11, 'judith ', 'gomez mena', '1982323112', 3, 'jugomez@miuniclaretian.edu.co', '3009876534'),
(12, 'milena ster ', 'muñoz cortes', '1022678902', 3, 'msmuñoz@miuniclaretian.edu.co', '3042139033'),
(13, 'fernanda', 'sepulveda guebara', '1067878980', 3, 'fesepulveda@miuniclaretian.edu.co', '3224567891'),
(14, 'miguel angel', 'cataño suarez', '1977654321', 3, 'micataño@miuniclaretian.edu.co', '3008792136'),
(15, 'paolo ', 'zuñiga mena', '1309098910', 3, 'pasuñiga@miuniclaretian.edu.co', '3136662201');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`);

ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

  ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`id_ingreso`);
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

ALTER TABLE colaboradores ADD FOREIGN KEY(cargo)
REFERENCES cargo(id_cargo);

ALTER TABLE estudiante ADD FOREIGN KEY(carrera)
REFERENCES carrera(id_carrera);

ALTER TABLE ingreso ADD FOREIGN KEY(id_colaboradores)
REFERENCES colaboradores(id);

ALTER TABLE ingreso ADD FOREIGN KEY(id_estudiante)
REFERENCES estudiante(id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;