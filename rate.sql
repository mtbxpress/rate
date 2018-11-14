-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2018 a las 23:30:16
-- Versión del servidor: 5.7.24-0ubuntu0.16.04.1
-- Versión de PHP: 7.2.7-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `activo` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_titulacion`
--

CREATE TABLE `curso_titulacion` (
  `curso_id` int(11) NOT NULL,
  `titulacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_pregunta`
--

CREATE TABLE `encuesta_pregunta` (
  `encuesta_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `orden` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `valor` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `resultado`
--

INSERT INTO `resultado` (`id`, `valor`) VALUES
(1, 0),
(2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulacion`
--

CREATE TABLE `titulacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaAlta` datetime NOT NULL,
  `avatar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `roles` enum('ROLE_PROFE','ROLE_PROFI','ROLE_ALU','ROLE_ADMIN') COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `email`, `fechaAlta`, `avatar`, `roles`, `telefono`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'JJ', 'DR', 'a@g.com', '2018-11-12 00:00:00', 'fiyfiy', 'ROLE_ADMIN', 0),
(9, 'adminx', 'f5cb5fd0b3bd86d92c3982f5c27174ec', 'czcz', 'czxczx', 'zczx@gmail.com', '2018-11-04 11:06:50', 'img.jpg', 'ROLE_ALU', NULL),
(11, 'ffsf', 'ed35e4fac311eb3ddaac043e0bf12a39', 'sdsds', 'dsds', 'n@ffffff.com', '2018-11-04 11:13:45', 'img.jpg', 'ROLE_PROFI', 443322345),
(13, 'adminGBDFG', '4943c668497795bb894ca5bfd8526ccd', 'FDFF', 'fdfdfd', 'nF@hotmail.com', '2018-11-04 19:21:49', 'img.jpg', 'ROLE_PROFE', 222),
(14, 'admin2Q22', '1cd3f7c4095fb55de1d50f0fce236fb5', '323', '2323', '2@aaaaaaaaa.com', '2018-11-04 19:22:00', 'img.jpg', 'ROLE_PROFI', 3232),
(15, 'adminTRTRE', '21232f297a57a5a743894a0e4a801fc3', 'HFGF', 'dddddddddddddR', 'jjdelrom2012@gmail.com', '2018-11-04 19:22:41', 'img.jpg', 'ROLE_PROFI', 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_titulacion`
--

CREATE TABLE `usuario_titulacion` (
  `usuario_id` int(11) NOT NULL,
  `titulacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CA3B40ECA02A2F00` (`descripcion`);

--
-- Indices de la tabla `curso_titulacion`
--
ALTER TABLE `curso_titulacion`
  ADD PRIMARY KEY (`curso_id`,`titulacion_id`),
  ADD KEY `IDX_10E0DB6C87CB4A1F` (`curso_id`),
  ADD KEY `IDX_10E0DB6CF471CF55` (`titulacion_id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B25B6841F471CF55` (`titulacion_id`),
  ADD KEY `IDX_B25B6841DB38439E` (`usuario_id`);

--
-- Indices de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  ADD PRIMARY KEY (`encuesta_id`,`pregunta_id`),
  ADD KEY `IDX_3C1707EE46844BA6` (`encuesta_id`),
  ADD KEY `IDX_3C1707EE31A5801E` (`pregunta_id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_873C18243A909126` (`nombre`),
  ADD UNIQUE KEY `UNIQ_873C182420332D99` (`codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DF85E0677` (`username`);

--
-- Indices de la tabla `usuario_titulacion`
--
ALTER TABLE `usuario_titulacion`
  ADD PRIMARY KEY (`usuario_id`,`titulacion_id`),
  ADD KEY `IDX_740C5286DB38439E` (`usuario_id`),
  ADD KEY `IDX_740C5286F471CF55` (`titulacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso_titulacion`
--
ALTER TABLE `curso_titulacion`
  ADD CONSTRAINT `FK_10E0DB6C87CB4A1F` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_10E0DB6CF471CF55` FOREIGN KEY (`titulacion_id`) REFERENCES `titulacion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `FK_B25B6841DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_B25B6841F471CF55` FOREIGN KEY (`titulacion_id`) REFERENCES `titulacion` (`id`);

--
-- Filtros para la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  ADD CONSTRAINT `FK_3C1707EE31A5801E` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3C1707EE46844BA6` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_titulacion`
--
ALTER TABLE `usuario_titulacion`
  ADD CONSTRAINT `FK_740C5286DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_740C5286F471CF55` FOREIGN KEY (`titulacion_id`) REFERENCES `titulacion` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
