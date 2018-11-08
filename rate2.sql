-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-11-2018 a las 19:53:09
-- Versión del servidor: 5.7.24-0ubuntu0.16.04.1
-- Versión de PHP: 7.2.7-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rate2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `activo`) VALUES
(1, '2015/16', 0),
(2, '2016/17', 0),
(3, '2017/18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `titulacion_id` int(11) NOT NULL,
  `tipo` enum('alumno','profe','profi','') NOT NULL,
  `evaluado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `titulacion_id`, `tipo`, `evaluado_id`) VALUES
(11, 1, 'alumno', 9),
(12, 1, 'profe', 9),
(13, 1, 'profi', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_pregunta`
--

CREATE TABLE `encuesta_pregunta` (
  `id` int(11) NOT NULL,
  `encuesta_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `tipo` enum('alumno','profe','profi','') NOT NULL,
  `orden` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `tipo`, `orden`) VALUES
(1, 'alumno p1', 'alumno', 1),
(2, 'alumno p2', 'alumno', 2),
(3, 'porfi p1', 'profi', 1),
(4, 'profi p2', 'profi', 2),
(5, 'profe p1', 'profe', 1),
(6, 'profe p2', 'profe', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulacion`
--

CREATE TABLE `titulacion` (
  `id` int(11) NOT NULL,
  `nombre_titulacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `titulacion`
--

INSERT INTO `titulacion` (`id`, `nombre_titulacion`) VALUES
(4, 'CTMA'),
(2, 'GSII'),
(1, 'ITG'),
(5, 'ITIG'),
(3, 'MATEQ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulacion_curso`
--

CREATE TABLE `titulacion_curso` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `titulacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `titulacion_curso`
--

INSERT INTO `titulacion_curso` (`id`, `curso_id`, `titulacion_id`) VALUES
(37, 1, 1),
(38, 1, 2),
(39, 1, 3),
(40, 1, 4),
(41, 1, 5),
(43, 2, 1),
(42, 2, 2),
(44, 2, 5),
(48, 3, 1),
(47, 3, 2),
(46, 3, 4),
(45, 3, 5);

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
-- Estructura de tabla para la tabla `usuario_encuesta`
--

CREATE TABLE `usuario_encuesta` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `encuesta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_titulacion`
--

CREATE TABLE `usuario_titulacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_titulacion`
--

INSERT INTO `usuario_titulacion` (`id`, `usuario_id`, `titulacion_id`) VALUES
(1, 9, 1),
(2, 9, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tit_eva_tipo_unicos` (`titulacion_id`,`tipo`,`evaluado_id`) USING BTREE,
  ADD KEY `fk_eval` (`evaluado_id`);

--
-- Indices de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `encu_preg_unicos` (`encuesta_id`,`pregunta_id`),
  ADD KEY `pk_pregunta` (`pregunta_id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B63E2EC73A909126` (`nombre`);

--
-- Indices de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desc_unica` (`nombre_titulacion`);

--
-- Indices de la tabla `titulacion_curso`
--
ALTER TABLE `titulacion_curso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `curso_titulacion_unico` (`curso_id`,`titulacion_id`),
  ADD KEY `pk_tit` (`titulacion_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DF85E0677` (`username`);

--
-- Indices de la tabla `usuario_encuesta`
--
ALTER TABLE `usuario_encuesta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_encuesta_evaluado_unicos` (`usuario_id`,`encuesta_id`) USING BTREE,
  ADD KEY `pk_encuesta_` (`encuesta_id`);

--
-- Indices de la tabla `usuario_titulacion`
--
ALTER TABLE `usuario_titulacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_titulacion` (`usuario_id`,`titulacion_id`),
  ADD KEY `pk_titulacion` (`titulacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `titulacion_curso`
--
ALTER TABLE `titulacion_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuario_encuesta`
--
ALTER TABLE `usuario_encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario_titulacion`
--
ALTER TABLE `usuario_titulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `fk_eval` FOREIGN KEY (`evaluado_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tit` FOREIGN KEY (`titulacion_id`) REFERENCES `titulacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  ADD CONSTRAINT `pk_encuesta` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_pregunta` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `titulacion_curso`
--
ALTER TABLE `titulacion_curso`
  ADD CONSTRAINT `pk_curso__` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `pk_tit` FOREIGN KEY (`titulacion_id`) REFERENCES `titulacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_encuesta`
--
ALTER TABLE `usuario_encuesta`
  ADD CONSTRAINT `pk_encuesta_` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_usuario_` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_titulacion`
--
ALTER TABLE `usuario_titulacion`
  ADD CONSTRAINT `pk_titulacion` FOREIGN KEY (`titulacion_id`) REFERENCES `titulacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
