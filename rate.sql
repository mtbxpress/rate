-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2018 a las 20:52:43
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
CREATE DATABASE IF NOT EXISTS `rate` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rate`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `descripcion`, `activo`) VALUES
(1, '2015/16', 0),
(62, '2015/18', 1),
(73, '2016/36', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_titulacion`
--

CREATE TABLE `curso_titulacion` (
  `curso_id` int(11) NOT NULL,
  `titulacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso_titulacion`
--

INSERT INTO `curso_titulacion` (`curso_id`, `titulacion_id`) VALUES
(62, 1),
(62, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `titulacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `evaluado_id` int(11) DEFAULT NULL,
  `naevaluado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `titulacion_id`, `usuario_id`, `evaluado_id`, `naevaluado`) VALUES
(24, 1, 1, 9, 'czcz czxczx'),
(27, 1, 1, 15, 'HFGF dddddddddddddR'),
(28, 1, 1, 15, 'HFGF dddddddddddddR'),
(29, 1, 1, 15, 'HFGF dddddddddddddR'),
(30, 23, 14, 9, 'czcz czxczx'),
(31, 23, 1, 14, '323 2323'),
(32, 23, 1, 14, '323 2323');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_pregunta`
--

CREATE TABLE `encuesta_pregunta` (
  `id` int(11) NOT NULL,
  `encuesta_id` int(11) DEFAULT NULL,
  `pregunta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('PROFESOR_INTERNO','PROFESOR_EXTERNO','ALUMNO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `orden` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `tipo`, `orden`) VALUES
(21, 'LLEGA A SU HORAO', 'PROFESOR_INTERNO', 4),
(26, 'YYYYY', 'ALUMNO', 5),
(30, 'PO', 'PROFESOR_INTERNO', 9),
(31, 'sjfsuo', 'PROFESOR_EXTERNO', 5);

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
-- Estructura de tabla para la tabla `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulacion`
--

CREATE TABLE `titulacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `titulacion`
--

INSERT INTO `titulacion` (`id`, `nombre`, `codigo`) VALUES
(1, 'Informatica', 'INF'),
(22, 'sdaa', 'GGDDT'),
(23, 'tttttttt', '0');

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'JJ', 'Delgado Romero', 'a@g.com', '2018-11-12 00:00:00', 'fiyfiy', 'ROLE_ADMIN', 0),
(9, 'adminx', 'f5cb5fd0b3bd86d92c3982f5c27174ec', 'czcz', 'czxczx', 'zczx@gmail.com', '2018-11-04 11:06:50', 'img.jpg', 'ROLE_ALU', NULL),
(11, 'ffsf', 'ed35e4fac311eb3ddaac043e0bf12a39', 'sdsds', 'dsds', 'n@ffffff.com', '2018-11-04 11:13:45', 'img.jpg', 'ROLE_PROFI', 443322345),
(13, 'adminGBDFG', '4943c668497795bb894ca5bfd8526ccd', 'FDFF', 'fdfdfd', 'nF@hotmail.com', '2018-11-04 19:21:49', 'img.jpg', 'ROLE_PROFE', 222),
(14, 'admin2Q22', '1cd3f7c4095fb55de1d50f0fce236fb5', '323', '2323', '2@aaaaaaaaa.com', '2018-11-04 19:22:00', 'img.jpg', 'ROLE_PROFI', 3232),
(15, 'adminTRTRE', '21232f297a57a5a743894a0e4a801fc3', 'HFGF', 'dddddddddddddR', 'jjdelrom2012@gmail.com', '2018-11-04 19:22:41', 'img.jpg', 'ROLE_PROFI', 44),
(16, 'ivhoiss', 'a947195af78490ae81b2e7e000579200', 'ttt', 'ttt', 'nttt@hotmail.com', '2018-11-17 11:08:10', 'img.jpg', 'ROLE_PROFI', 5443333),
(17, 'admingfgf', '3b542fdcd44331364f0dc93a88dd7f37', 'dffdf', 'fdff', 'cccn@f.com', '2018-11-18 19:15:36', 'img.jpg', 'ROLE_PROFI', 44444);

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
  ADD KEY `IDX_B25B6841DB38439E` (`usuario_id`),
  ADD KEY `IDX_B25B6841960057D3` (`evaluado_id`);

--
-- Indices de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3C1707EE46844BA6` (`encuesta_id`),
  ADD KEY `IDX_3C1707EE31A5801E` (`pregunta_id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5ACE3AF04B89032C` (`post_id`),
  ADD KEY `IDX_5ACE3AF0BAD26311` (`tag_id`);

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
-- Indices de la tabla `tag`
--
ALTER TABLE `tag`
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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
  ADD CONSTRAINT `FK_B25B6841960057D3` FOREIGN KEY (`evaluado_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_B25B6841DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_B25B6841F471CF55` FOREIGN KEY (`titulacion_id`) REFERENCES `titulacion` (`id`);

--
-- Filtros para la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  ADD CONSTRAINT `FK_3C1707EE31A5801E` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`),
  ADD CONSTRAINT `FK_3C1707EE46844BA6` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id`);

--
-- Filtros para la tabla `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `FK_5ACE3AF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_5ACE3AF0BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
