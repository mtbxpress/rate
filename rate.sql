-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2018 a las 21:26:18
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
(62, '2015/18', 0),
(73, '2016/36', 0),
(74, '2014/44', 0),
(75, '2015/12', 1),
(77, '2015/98', 0),
(78, '2015/90', 0),
(79, '2015/14', 0),
(80, '2015/11', 0);

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
(62, 22),
(62, 23),
(74, 24),
(74, 37),
(74, 43),
(75, 1),
(75, 24),
(75, 25),
(75, 27),
(75, 37),
(75, 44),
(75, 46),
(75, 47),
(75, 49),
(75, 50),
(75, 51),
(75, 52),
(78, 33),
(78, 34);

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
(75, 1),
(75, 20),
(75, 36);

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
(72, 23, 1, 33, NULL, 'SI'),
(74, 1, 1, 20, 'FDFF g', 'SI'),
(75, 44, 33, 26, 'x fdfdfd', 'NO'),
(76, 29, 26, 30, NULL, 'NO'),
(80, 1, 35, 30, 'ghf fgh', 'NO'),
(82, 1, 1, 35, 'cvcv vcv', 'SI'),
(83, 1, 21, 35, 'cvcv vcv', 'NO'),
(84, 1, 34, 35, 'cvcv vcv', 'NO'),
(92, 25, 21, 9, 'czcz czxczx', 'NO'),
(93, 25, 21, 9, 'czcz czxczx', 'NO'),
(94, 25, 21, 9, 'czcz czxczx', 'NO'),
(95, 25, 21, 9, 'czcz czxczx', 'NO');

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
(51, 74, 67, 4),
(52, 72, 68, 6),
(53, 75, 68, NULL),
(60, 72, 67, 5),
(62, 72, 65, 5),
(65, 80, 65, NULL),
(66, 80, 66, NULL),
(67, 80, 67, NULL),
(71, 82, 68, 5),
(73, 83, 68, 2),
(75, 84, 65, NULL),
(76, 84, 66, NULL),
(77, 84, 67, NULL),
(78, 72, 70, 4),
(79, 75, 70, NULL),
(80, 76, 71, NULL),
(81, 80, 71, NULL);

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
  `orden` smallint(6) NOT NULL,
  `descripcionIngles` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `tipo`, `orden`, `descripcionIngles`) VALUES
(65, '111', NULL, 1, '115'),
(66, '22', 'ALUMNO', 2, '22'),
(67, 'gdfdf', 'ALUMNO', 4, 'fdfgd'),
(68, 'hhhhhhhhhhhh', 'PROFESOR_INTERNO', 1, 'hhhhhhhhhh'),
(70, 'bbb', 'PROFESOR_INTERNO', 1, 'bbb'),
(71, 'adsdd', 'PROFESOR_EXTERNO', 111, 'sdadss');

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
(23, 'tttttttt', '0'),
(24, 'fisica', 'FIS'),
(25, 'ugibk', 'lihli'),
(27, 'ugibkggd', 'lihligdffd'),
(28, 'ggggg', 'dfdfd'),
(29, 'ggggghij', 'dfdfdhgh'),
(31, 'ggggghijrrrrrrr', 'dfdfdhghr'),
(33, 'rtttr', 'wew'),
(34, 'rtttrfgf', 'wewfff'),
(37, 'rtttrfgfdsa', 'dsdb'),
(43, 'gfgh', 'len'),
(44, 'nueva', 'nvvvvvvvvv'),
(46, 'fsfsd', 'dsfd'),
(47, 'fgs', 'fdsdd'),
(49, 'nfgsbgg', 'fdsngg'),
(50, 'nfgsbgghh', 'fdsnggf'),
(51, 'nfgsbff', 'fdssr'),
(52, 'sfsdf', 'sfds');

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
  `media` decimal(4,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `email`, `fechaAlta`, `avatar`, `roles`, `telefono`, `media`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'JJ', 'Delgado Romero', 'a@g.com', '2018-11-12 00:00:00', 'fiyfiy', 'ROLE_ADMIN', 0, '0.0'),
(9, 'adminx', 'f5cb5fd0b3bd86d92c3982f5c27174ec', 'czcz', 'czxczx', 'zczx@gmail.com', '2018-11-04 11:06:50', 'img.jpg', 'ROLE_ALU', NULL, '0.0'),
(11, 'ffsf', 'ed35e4fac311eb3ddaac043e0bf12a39', 'sdsds', 'dsds', 'n@ffffff.com', '2018-11-04 11:13:45', 'img.jpg', 'ROLE_PROFI', 443322345, '0.0'),
(13, 'adminGBDFG', '4943c668497795bb894ca5bfd8526ccd', 'FDFF', 'fdfdfd', 'nF@hotmail.com', '2018-11-04 19:21:49', 'img.jpg', 'ROLE_PROFE', 222, '0.0'),
(14, 'admin2Q22', '1cd3f7c4095fb55de1d50f0fce236fb5', '323', '2323', '2@aaaaaaaaa.com', '2018-11-04 19:22:00', 'img.jpg', 'ROLE_ALU', 3232, '0.0'),
(15, 'adminTRTRE', '21232f297a57a5a743894a0e4a801fc3', 'HFGF', 'dddddddddddddR', 'jjdelrom2012@gmail.com', '2018-11-04 19:22:41', 'img.jpg', 'ROLE_PROFI', 44, '0.0'),
(16, 'ivhoiss', 'a947195af78490ae81b2e7e000579200', 'ttt', 'ttt', 'nttt@hotmail.com', '2018-11-17 11:08:10', 'img.jpg', 'ROLE_PROFI', 5443333, '0.0'),
(17, 'admingfgf', '3b542fdcd44331364f0dc93a88dd7f37', 'dffdf', 'fdff', 'cccn@f.com', '2018-11-18 19:15:36', 'img.jpg', 'ROLE_PROFI', 44444, '0.0'),
(18, 'adminhg5e', '21232f297a57a5a743894a0e4a801fc3', 'h', 'h', 'nff@ffffff.com', '2018-11-21 19:49:59', 'img.jpg', 'ROLE_PROFI', 34, '0.0'),
(19, 'trhtht', '80a5aababc3324446fbfac54178a8c10', 'dftr', 'ddddddddddddd', 'jjdelrdfom2012@gmail.com', '2018-11-21 19:51:01', 'img.jpg', 'ROLE_ADMIN', 66, '0.0'),
(20, 'adhfhfmin', '61973640c8edd4220badd367b719d564', 'FDFF', 'g', 'nfgf@hotmail.com', '2018-11-21 19:51:51', 'img.jpg', 'ROLE_ALU', 66, '3.6'),
(21, 'admingg', '03442cc18f1b5b2e8791d5f977d508f3', 'ghf', 'fgh', 'gfggfgfg@gmail.com', '2018-11-21 19:54:47', 'img.jpg', 'ROLE_PROFE', 666, '0.0'),
(23, 'admingggd', '36eba1e1e343279857ea7f69a597324e', 'ghf', 'fgh', 'gfggfgfg@gmail.com', '2018-11-21 19:55:58', 'img.jpg', 'ROLE_PROFE', 666, '0.0'),
(25, 'admingggdhg', 'b6e6e16890f6be1c4785f03d92acf177', 'ghf', 'fgh', 'gfggfgfg@gmail.com', '2018-11-21 19:57:21', 'img.jpg', 'ROLE_PROFE', 666, '0.0'),
(26, 'admingfsw', '21232f297a57a5a743894a0e4a801fc3', 'x', 'fdfdfd', 'skddin@gmail.com', '2018-11-21 19:58:01', 'img.jpg', 'ROLE_PROFI', 4, '0.0'),
(30, 'admingcsdhg', '8eab34801b8f05644302ecacb5eadc49', 'ghf', 'fgh', 'gfggfgfg@gmail.com', '2018-11-21 20:04:57', 'img.jpg', 'ROLE_PROFE', 666, '0.0'),
(31, 'adminoiuio', '21232f297a57a5a743894a0e4a801fc3', 'dgddf', 'sfds', 'dsdsdadn@hotmail.com', '2018-11-21 20:05:34', 'img.jpg', 'ROLE_PROFI', 33, '0.0'),
(33, 'admisdfsdn', '8e1e02ca3401f4667cd586cdf03758fd', 'df', 'sa', 'nsad@ffffff.com', '2018-11-21 20:08:04', 'img.jpg', 'ROLE_PROFI', 33, '0.0'),
(34, 'fsdsdadmin', '2f3a8d1dea6b2aa2bf221684e3c6540a', 'sds', 'ew', 'ndsds@f.com', '2018-11-21 20:10:17', 'img.jpg', 'ROLE_ALU', 33, '0.0'),
(35, 'admingf', '670da91be64127c92faac35c8300e814', 'estudiantenss', 'vcv', 'jjdelrtrreom2012@gmail.com', '2018-11-21 20:13:42', 'img.jpg', 'ROLE_ALU', 455, '0.0'),
(36, 'admingfdfd', '9a967103c4cb00cdc7a03099baa6148a', 'dsd', 'dsd', 'ncxcxc@f.com', '2018-11-26 20:34:18', 'img.jpg', 'ROLE_PROFI', 333, '0.0');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT de la tabla `encuesta_pregunta`
--
ALTER TABLE `encuesta_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `titulacion`
--
ALTER TABLE `titulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
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

--
-- Filtros para la tabla `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `FK_5ACE3AF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_5ACE3AF0BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
