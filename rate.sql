-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-11-2018 a las 19:58:57
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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B63E2EC73A909126` (`nombre`);

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
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
