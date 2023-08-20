-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 20-08-2023 a las 14:52:40
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
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre`) VALUES
(1, 'administrativo'),
(2, 'docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `nombre`) VALUES
(1, 'ing sistemas'),
(2, 'ing industrial'),
(3, 'psicologia');

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
  `telefono` varchar(25) NOT NULL,
  `estado_colaborador` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nombre`, `apellido`, `documento`, `cargo`, `telefono`, `estado_colaborador`) VALUES
(1, 'juan camilo', 'ortiz mena', '1278912328', 1, '573007405540', 0),
(3, 'esteven', 'mendez mena', '1208962328', 1, '3226430341', 1),
(4, 'juan', 'ortiz mena', '1278912329', 2, '3235662346', 1),
(5, 'gimena', 'herrera mena', '1278912307', 2, '3135662346', 1),
(6, 'laura', 'perez hinestrosa', '1273912320', 2, '3245662340', 1),
(7, 'Jhonatan Smith', 'Mena Urrutia', '1000007891', 2, '3212557264', 1);

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
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `estado_estudiante` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `nombre`, `apellido`, `identificacion`, `carrera`, `correo`, `telefono`, `estado_estudiante`) VALUES
(1, 'juan esteba', 'mena mena', '1277819328', 1, 'jemena@miuniclaretian.edu.co', '3225432346', 1),
(2, 'juan camilo', 'aguirre cortes', '1189023439', 1, 'jcaguirre@miuniclaretian.edu.co', '573227128189', 0),
(3, 'maria camilo', 'mena urrego', '1092876288', 1, 'mcmena@miuniclaretian.edu.co', '3145678902', 1),
(4, 'esteban', 'urrego mena', '1890897223', 1, 'esurrego@miuniclaretian.edu.co', '3156728909', 1),
(5, 'paola ', 'cortes velasques', '1278912307', 1, 'pacortes@miuniclaretian.edu.co', '3146752890', 1),
(6, 'esperanza ', 'gomez mena', '1234567890', 2, 'esgomez@miuniclaretian.edu.co', '3124567890', 1),
(7, 'juan ', 'perez cortes', '1342541230', 2, 'juperez@miuniclaretian.edu.co', '3167893212', 1),
(8, 'camila fernanda', 'inestrosa guebara', '22222222', 2, 'cfinestrosa@miuniclaretian.edu.co', '3224567890', 1),
(9, 'miguel', 'cataño perez', '1987654321', 2, 'micataño@miuniclaretian.edu.co', '3008792134', 1),
(10, 'nathaly yineth ', 'cortes mena', '1209098910', 2, 'nycortes@miuniclaretian.edu.co', '3136662200', 1),
(11, 'judith ', 'gomez mena', '1982323112', 3, 'jugomez@miuniclaretian.edu.co', '3009876534', 1),
(12, 'milena ster ', 'muñoz cortes', '1022678902', 3, 'msmuñoz@miuniclaretian.edu.co', '3042139033', 1),
(13, 'fernanda', 'sepulveda guebara', '1067878980', 3, 'fesepulveda@miuniclaretian.edu.co', '3224567891', 1),
(14, 'miguel angel', 'cataño suarez', '1977654321', 3, 'micataño@miuniclaretian.edu.co', '3008792136', 1),
(15, 'paolo ', 'zuñiga mena', '1309098910', 3, 'pasuñiga@miuniclaretian.edu.co', '3136662201', 1),
(17, 'Jhonatan Smith', 'Mena Urrutia', '1000000214', 1, 'jhsmu123@hotmail.com', '3212557264', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `id_ingreso` int(11) NOT NULL,
  `id_colaboradores` int(11) DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `fechaingreso` datetime DEFAULT NULL,
  `fechasalida` datetime DEFAULT NULL,
  `ingresoEstado` tinyint(1) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`id_ingreso`, `id_colaboradores`, `id_estudiante`, `fechaingreso`, `fechasalida`, `ingresoEstado`, `token`) VALUES
(1, NULL, 4, '2023-08-19 15:40:51', '2023-08-19 15:41:39', 0, 'fe5d9d'),
(2, NULL, 4, '2023-08-19 15:41:49', '2023-08-19 15:43:16', 0, '241e4a'),
(3, NULL, 4, '2023-08-19 15:43:31', '2023-08-19 15:44:12', 0, '21b4ed'),
(4, NULL, 4, '2023-08-19 15:44:24', '2023-08-19 15:59:53', 0, 'a6ce3d'),
(5, NULL, 4, '2023-08-19 16:07:05', '2023-08-19 16:07:43', 0, '0ea43d'),
(6, NULL, 4, '2023-08-19 16:22:35', '2023-08-19 16:24:11', 0, '34f32d'),
(7, NULL, 1, '2023-08-19 16:25:42', '2023-08-19 16:26:58', 0, '43fd90'),
(8, 3, NULL, '2023-08-19 17:20:10', '2023-08-19 17:28:17', 0, '19ef61'),
(10, NULL, 2, '2023-08-19 18:28:04', '2023-08-19 18:32:20', 0, '3d2c24'),
(11, NULL, 2, '2023-08-19 18:33:08', '2023-08-19 18:33:56', 0, '26fbce'),
(17, NULL, 1, '2023-08-20 00:37:36', NULL, 1, '2c170c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_a`
--

CREATE TABLE `ingreso_a` (
  `id` int(11) NOT NULL,
  `cedula` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingreso_a`
--

INSERT INTO `ingreso_a` (`id`, `cedula`) VALUES
(1, '1919191919'),
(2, '1818181818');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitados`
--

CREATE TABLE `invitados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `documento` varchar(11) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `genero` int(5) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invitados`
--

INSERT INTO `invitados` (`id`, `nombre`, `apellido`, `documento`, `telefono`, `genero`, `descripcion`, `fecha`) VALUES
(1, 'Jhonatan Smith', 'Mena Urrutia', '1078912328', '3212557264', 1, 'Me dirijo asi donde el rector para una entrevista de trabajo', '2023-08-20 03:53:40'),
(2, 'juan David', 'Sanchez', '35603593', '3156078921', 1, 'Vengo a solicitar un certificado', '2023-08-19 22:55:05'),
(3, 'Jose Alirio', 'Cabrera', '1234567890', '3214567890', 1, 'Vengo a renunciar de la universidad', '2023-08-19 22:57:52'),
(4, 'Luz Marina', 'Arias', '1245576849', '3128291234', 2, 'Me dirijo a una entrevista con el rector.', '2023-08-19 23:10:48');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD KEY `cargo` (`cargo`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id_colaboradores` (`id_colaboradores`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `ingreso_a`
--
ALTER TABLE `ingreso_a`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invitados`
--
ALTER TABLE `invitados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitados` (`genero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ingreso_a`
--
ALTER TABLE `ingreso_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `invitados`
--
ALTER TABLE `invitados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `colaboradores_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id_cargo`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`id_colaboradores`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id`);

--
-- Filtros para la tabla `invitados`
--
ALTER TABLE `invitados`
  ADD CONSTRAINT `invitados` FOREIGN KEY (`genero`) REFERENCES `genero` (`id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
