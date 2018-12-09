-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-12-2018 a las 18:53:02
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
(1, '2016/17', 0),
(2, '2017/18', 1),
(3, '2018/19', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_preguntas`
--

CREATE TABLE `curso_preguntas` (
  `curso_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso_preguntas`
--

INSERT INTO `curso_preguntas` (`curso_id`, `pregunta_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(2, 1),
(2, 10),
(2, 11);

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
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_usuario`
--

CREATE TABLE `curso_usuario` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `media` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso_usuario`
--

INSERT INTO `curso_usuario` (`id`, `curso_id`, `usuario_id`, `media`) VALUES
(1, 1, 37, NULL),
(2, 1, 38, '6.0'),
(3, 1, 39, NULL),
(4, 1, 40, NULL),
(5, 1, 41, NULL),
(6, 1, 42, NULL),
(7, 1, 43, NULL),
(8, 2, 37, NULL),
(9, 2, 38, '3.0'),
(10, 2, 39, NULL),
(11, 2, 40, NULL),
(12, 2, 41, NULL),
(13, 2, 42, NULL),
(14, 2, 43, NULL),
(15, 1, 44, NULL);

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
  `completada` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `titulacion_id`, `usuario_id`, `evaluado_id`, `naevaluado`, `completada`, `curso_id`) VALUES
(34, 1, 38, 40, 'Fran Jerez Garrido', 'SI', 1),
(35, 1, 40, 38, 'Luis Merino Cabañas', 'SI', 1),
(36, 1, 37, 38, 'Luis Merino Cabañas', 'SI', 2),
(38, 1, 38, 40, 'Fran Jerez Garrido', 'SI', 2);

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
(179, 34, 1, 4),
(180, 34, 2, 4),
(181, 34, 3, 4),
(182, 34, 4, 3),
(183, 34, 5, 3),
(184, 34, 6, 3),
(185, 34, 8, 3),
(186, 34, 9, 3),
(187, 34, 25, 3),
(188, 34, 28, 3),
(189, 35, 10, 5),
(190, 35, 12, 5),
(191, 35, 14, 5),
(192, 35, 16, 3),
(193, 35, 18, 3),
(194, 35, 20, 4),
(195, 35, 26, 3),
(196, 35, 27, 4),
(197, 36, 10, 3),
(198, 38, 1, 5),
(199, 34, 29, NULL),
(200, 38, 29, NULL);

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
(1, '¿El alumno es puntual?', 'ALUMNO', 1, 'Is the student punctual?'),
(2, '¿El alumno se integra con los compañeros?', 'ALUMNO', 2, 'Is the student integrated with the classmates?'),
(3, '¿El alumno realiza todas las tareas que se le asignan?', 'ALUMNO', 3, 'Does the student perform all the tasks assigned to him?'),
(4, '¿El alumno pregunta las dudas a sus responsables?', 'ALUMNO', 4, 'Does the student ask questions of those responsible?'),
(5, '¿El alumno presenta los conocimientos exigidos por su puesto?', 'ALUMNO', 5, 'Does the student present the knowledge required for his position?'),
(6, '¿El alumno aporta nuevas ideas?', 'ALUMNO', 6, 'Does the student bring new ideas?'),
(8, '¿El alumno acaba su horario laboral puntualmente?', 'ALUMNO', 7, 'Does the student finish his work schedule on time?'),
(9, '¿El alumno asiste regularmente a su puesto?', 'ALUMNO', 8, 'Does the student attend regularly to his position?'),
(10, '¿El tutor responde las dudas correctamente?', 'PROFESOR_INTERNO', 5, 'Does the tutor answer the questions correctly?'),
(11, '¿El tutor responde las dudas correctamente?', 'PROFESOR_EXTERNO', 5, 'Does the tutor answer the questions correctly?'),
(12, '¿El tutor asiste regularmente a su puesto?', 'PROFESOR_INTERNO', 2, 'Does the tutor regularly attend your position?'),
(13, '¿El tutor asiste regularmente a su puesto?', 'PROFESOR_EXTERNO', 2, 'Does the tutor regularly attend your position?'),
(14, '¿El tutor tiene conocimientos necesarios para ayudar al alumno?', 'PROFESOR_INTERNO', 3, 'Does the tutor have the necessary knowledge to help the student?'),
(15, '¿El tutor tiene conocimientos necesarios para ayudar al alumno?', 'PROFESOR_EXTERNO', 3, 'Does the tutor have the necessary knowledge to help the student?'),
(16, '¿El tutor aporta nuevas ideas al alumno?', 'PROFESOR_INTERNO', 4, 'Does the tutor bring new ideas to the student?'),
(17, '¿El tutor aporta nuevas ideas al alumno?', 'PROFESOR_EXTERNO', 4, 'Does the tutor bring new ideas to the student?'),
(18, '¿El tutor ayuda a la integración en el grupo?', 'PROFESOR_INTERNO', 5, 'Does the tutor help with the integration in the group?'),
(19, '¿El tutor ayuda a la integración en el grupo?', 'PROFESOR_EXTERNO', 5, 'Does the tutor help with the integration in the group?'),
(20, '¿El tutor aporta el material necesario?', 'PROFESOR_INTERNO', 6, 'Does the tutor provide the necessary material?'),
(21, '¿El tutor aporta el material necesario?', 'PROFESOR_EXTERNO', 6, 'Does the tutor provide the necessary material?'),
(22, 'rrrrrrrrr', 'PROFESOR_EXTERNO', 5, 'rrrrrrrrrr'),
(25, 'nueva pregunta', 'ALUMNO', 1, 'ihoasioa n'),
(26, 'fffffffff', 'PROFESOR_INTERNO', 1, 'ffffffffff'),
(27, 'gggggggggg', 'PROFESOR_INTERNO', 2, 'ggggggggggg'),
(28, 'alummm', 'ALUMNO', 2, 'alummm'),
(29, 'dddddd', 'ALUMNO', 3, 'dddd');

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
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5');

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
(1, 'Ingeniería Informática', 'INF'),
(2, 'Biología', 'BIO'),
(3, 'Física', 'FIS'),
(4, 'Derecho', 'DER');

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'JJ', 'Delgado Romero', 'a@g.com', '2018-11-12 00:00:00', 'avatar_default.jpeg', 'ROLE_ADMIN', 0),
(37, '11111111', '21232f297a57a5a743894a0e4a801fc3', 'Lola', 'Fernandez Ruiz', 'lola@gmail.com', '2018-11-28 20:43:14', 'avatar_11111111_1543953333.png', 'ROLE_ALU', 658965874),
(38, '222222222', '21232f297a57a5a743894a0e4a801fc3', 'Luis', 'Merino Cabañas', 'lmercab@hotmail.com', '2018-11-28 20:46:31', 'avatar_default.jpeg', 'ROLE_PROFI', 635214789),
(39, '333333333', '21232f297a57a5a743894a0e4a801fc3', 'Fernando', 'Pareja Solo', 'fe@gmail.com', '2018-11-28 20:47:12', 'avatar_659852147_1543523229.png', 'ROLE_PROFE', 652358749),
(40, '444444444', '21232f297a57a5a743894a0e4a801fc3', 'Fran', 'Jerez Garrido', 'dsdsddsn@hotmail.com', '2018-11-29 21:34:38', 'avatar_nuevo333_1543947423.png', 'ROLE_ALU', 22222121),
(41, '555555555', '21232f297a57a5a743894a0e4a801fc3', 'Marta', 'Fernandez Guillen', 'dsdsdasddn@hotmail.com', '2018-11-29 21:38:07', 'avatar_nuevo222_1543523887.png', 'ROLE_ALU', 232332),
(42, '666666666', '21232f297a57a5a743894a0e4a801fc3', 'Susana', 'Pan Lopez', 's@gmail.com', '2018-12-07 20:11:29', 'avatar_666666666_1544209889.png', 'ROLE_PROFE', 635986574),
(43, 'pruebaaa', '21232f297a57a5a743894a0e4a801fc3', 'prueba', 'prueba', 'prueba@gmail.com', '2018-12-08 19:23:24', 'avatar_default.jpeg', 'ROLE_PROFE', 222222222),
(44, '777777777', '21232f297a57a5a743894a0e4a801fc3', 'Lucia', 'Pan Corrales', 'lll@gmail.com', '2018-12-09 17:56:23', 'avatar_default.jpeg', 'ROLE_ALU', 222221111);

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
-- Indices de la tabla `curso_preguntas`
--
ALTER TABLE `curso_preguntas`
  ADD PRIMARY KEY (`curso_id`,`pregunta_id`),
  ADD KEY `IDX_3663885E87CB4A1F` (`curso_id`),
  ADD KEY `IDX_3663885E31A5801E` (`pregunta_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B41136387CB4A1F` (`curso_id`),
  ADD KEY `IDX_B411363DB38439E` (`usuario_id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usu_tit_eva_unicos` (`titulacion_id`,`usuario_id`,`evaluado_id`,`curso_id`),
  ADD KEY `IDX_B25B6841F471CF55` (`titulacion_id`),
  ADD KEY `IDX_B25B6841DB38439E` (`usuario_id`),
  ADD KEY `IDX_B25B6841960057D3` (`evaluado_id`),
  ADD KEY `IDX_B25B684187CB4A1F` (`curso_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `curso_usuario`
--
ALTER TABLE `curso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso_preguntas`
--
ALTER TABLE `curso_preguntas`
  ADD CONSTRAINT `FK_3663885E31A5801E` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3663885E87CB4A1F` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `FK_B41136387CB4A1F` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `FK_B411363DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `FK_B25B684187CB4A1F` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
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
