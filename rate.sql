-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-12-2018 a las 21:14:12
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
  `descripcion` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `descripcion`, `activo`) VALUES
(81, '2015/16', 0),
(82, '2016/17', 0),
(83, '2017/18', 1);

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
(83, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_usuario`
--

CREATE TABLE `curso_usuario` (
  `curso_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso_usuario`
--

INSERT INTO `curso_usuario` (`curso_id`, `usuario_id`) VALUES
(83, 1),
(83, 37),
(83, 38),
(83, 39),
(83, 40),
(83, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `titulacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `evaluado_id` int(11) DEFAULT NULL,
  `naevaluado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `completada` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `titulacion_id`, `usuario_id`, `evaluado_id`, `naevaluado`, `completada`) VALUES
(96, 55, 38, 37, 'Lola Fernandez Ruiz', 'NO'),
(102, 55, 39, 37, 'Lola Fernandez Ruiz', 'SI'),
(103, 55, 37, 38, 'Luis Merino Cabañas', 'SI'),
(107, 55, 39, 40, 'nuevooooo oucvo', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_pregunta`
--

CREATE TABLE `encuesta_pregunta` (
  `id` int(11) NOT NULL,
  `encuesta_id` int(11) DEFAULT NULL,
  `pregunta_id` int(11) DEFAULT NULL,
  `resultado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `encuesta_pregunta`
--

INSERT INTO `encuesta_pregunta` (`id`, `encuesta_id`, `pregunta_id`, `resultado_id`) VALUES
(100, 107, 74, 3),
(101, 107, 75, 5),
(103, 102, 74, 5),
(104, 102, 75, 6),
(105, 103, 74, 6),
(106, 103, 75, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('PROFESOR_INTERNO','PROFESOR_EXTERNO','ALUMNO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `orden` smallint(6) NOT NULL,
  `descripcionIngles` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `tipo`, `orden`, `descripcionIngles`) VALUES
(74, 'El alumno llega a su hora?', 'ALUMNO', 1, 'Studen hour'),
(75, 'pregunta 1', 'ALUMNO', 2, 'question 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `valor` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `resultado`
--

INSERT INTO `resultado` (`id`, `valor`) VALUES
(2, '1'),
(3, '2'),
(4, '3'),
(5, '4'),
(6, '5');

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
(55, 'Informatica', 'INF');

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
  `telefono` int(11) DEFAULT NULL,
  `media` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `email`, `fechaAlta`, `avatar`, `roles`, `telefono`, `media`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'JJ', 'Delgado Romero', 'a@g.com', '2018-11-12 00:00:00', 'avatar_default.jpeg', 'ROLE_ADMIN', 0, NULL),
(37, '11111111', '21232f297a57a5a743894a0e4a801fc3', 'Lola', 'Fernandez Ruiz', 'lola@gmail.com', '2018-11-28 20:43:14', 'avatar_11111111_1543953333.png', 'ROLE_ALU', 658965874, '4.5'),
(38, '965896523', '21232f297a57a5a743894a0e4a801fc3', 'Luis', 'Merino Cabañas', 'lmercab@hotmail.com', '2018-11-28 20:46:31', 'avatar_default.jpeg', 'ROLE_PROFI', 635214789, '4.0'),
(39, '659852147', '21232f297a57a5a743894a0e4a801fc3', 'Fernando', 'Pareja Solo', 'fe@gmail.com', '2018-11-28 20:47:12', 'avatar_659852147_1543523229.png', 'ROLE_PROFE', 652358749, NULL),
(40, 'nuevo333', '21232f297a57a5a743894a0e4a801fc3', 'nuevooooo', 'oucvo', 'dsdsddsn@hotmail.com', '2018-11-29 21:34:38', 'avatar_nuevo333_1543947423.png', 'ROLE_ALU', 22222121, '3.0'),
(41, 'nuevo222', '21232f297a57a5a743894a0e4a801fc3', 'ddddsd', 'dsdsd', 'dsdsdasddn@hotmail.com', '2018-11-29 21:38:07', 'avatar_nuevo222_1543523887.png', 'ROLE_ALU', 232332, NULL);

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
-- Indices de la tabla `curso_usuario`
--
ALTER TABLE `curso_usuario`
  ADD PRIMARY KEY (`curso_id`,`usuario_id`),
  ADD KEY `IDX_B41136387CB4A1F` (`curso_id`),
  ADD KEY `IDX_B411363DB38439E` (`usuario_id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usu_tit_eva_unicos` (`titulacion_id`,`usuario_id`,`evaluado_id`),
  ADD KEY `IDX_B25B6841F471CF55` (`titulacion_id`),
  ADD KEY `IDX_B25B6841DB38439E` (`usuario_id`),
  ADD KEY `IDX_B25B6841960057D3` (`evaluado_id`);

--
-- Indices de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3C1707EE46844BA6` (`encuesta_id`),
  ADD KEY `IDX_3C1707EE31A5801E` (`pregunta_id`),
  ADD KEY `IDX_3C1707EEFF51ECB6` (`resultado_id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion_tipo_unicos` (`descripcion`,`tipo`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B2ED91C2E892728` (`valor`);

--
-- Indices de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_873C182420332D99` (`codigo`),
  ADD UNIQUE KEY `UNIQ_873C18243A909126` (`nombre`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
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
-- Filtros para la tabla `curso_usuario`
--
ALTER TABLE `curso_usuario`
  ADD CONSTRAINT `FK_B41136387CB4A1F` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B411363DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `FK_3C1707EE46844BA6` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id`),
  ADD CONSTRAINT `FK_3C1707EEFF51ECB6` FOREIGN KEY (`resultado_id`) REFERENCES `resultado` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
