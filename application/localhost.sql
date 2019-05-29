-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2019 a las 05:29:36
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wm0XJYFDWM`
--
CREATE DATABASE IF NOT EXISTS `wm0XJYFDWM` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `wm0XJYFDWM`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuestas_de_horario`
--

CREATE TABLE `propuestas_de_horario` (
  `idPropuesta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL COMMENT 'un usuario solo puede proponer un horario por reunión que este en proceso',
  `idReunion` int(11) NOT NULL,
  `fechaPropuesta` date NOT NULL,
  `horaPropuesta` time NOT NULL,
  `lugarPropuesta` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `propuestas_de_horario`
--

INSERT INTO `propuestas_de_horario` (`idPropuesta`, `idUsuario`, `idReunion`, `fechaPropuesta`, `horaPropuesta`, `lugarPropuesta`) VALUES
(5, 1, 1, '2019-05-15', '16:41:00', 'Salón Quinta Elisa'),
(6, 3, 1, '2019-05-09', '15:22:00', 'Salón Quinta Elisa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rangoFechas`
--

CREATE TABLE `rangoFechas` (
  `idRangoFechas` int(11) NOT NULL,
  `idReunion` int(3) NOT NULL,
  `fechaInicial` date NOT NULL,
  `horaInicial` time NOT NULL,
  `fechaFinal` date NOT NULL,
  `horaFinal` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rangoFechas`
--

INSERT INTO `rangoFechas` (`idRangoFechas`, `idReunion`, `fechaInicial`, `horaInicial`, `fechaFinal`, `horaFinal`) VALUES
(1, 2, '2019-05-08', '12:00:00', '2019-05-16', '18:00:00'),
(2, 1, '2019-05-14', '12:00:00', '2019-05-29', '11:59:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relReunionUsuario`
--

CREATE TABLE `relReunionUsuario` (
  `idRelRU` int(11) NOT NULL,
  `idReunion` int(3) NOT NULL COMMENT 'id de reunion',
  `idUsuario` int(11) NOT NULL COMMENT 'usuarios convocados a la reunion',
  `confirma` int(11) NOT NULL COMMENT '0 no lo ha hecho, 1 ya confirmo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `relReunionUsuario`
--

INSERT INTO `relReunionUsuario` (`idRelRU`, `idReunion`, `idUsuario`, `confirma`) VALUES
(1, 1, 3, 1),
(2, 1, 1, 0),
(3, 2, 4, 0),
(4, 2, 7, 0),
(5, 3, 8, 0),
(6, 1, 2, 0),
(7, 6, 7, 0),
(8, 1, 9, 0),
(9, 4, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reuniones`
--

CREATE TABLE `reuniones` (
  `idReunion` int(3) NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Agregar titulo de la reunion',
  `asunto` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'descripción del tema a tratar',
  `fecha` date NOT NULL COMMENT 'fecha final de la reunión',
  `lugar` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'lugar final de la reunión',
  `hora` time NOT NULL COMMENT 'hora final de la reunión',
  `estatus` int(2) NOT NULL COMMENT '1 planeación y 0 termin/cancel, 2 en proceso',
  `idUsuario` int(11) NOT NULL COMMENT 'cuando se asigna un usuario se envía la invitación en automático'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reuniones`
--

INSERT INTO `reuniones` (`idReunion`, `titulo`, `asunto`, `fecha`, `lugar`, `hora`, `estatus`, `idUsuario`) VALUES
(1, 'mi primer reunion', 'reunion para comenzar empresa', '2019-05-09', 'Oaxaca', '32:10:00', 1, 1),
(2, 'mi proyecto', 'hola mundo', '2019-05-21', 'oaxaca mexico', '01:00:00', 2, 1),
(3, 'mi reunion', 'este, es una prueba', '2019-05-21', 'oaxaca mexico', '02:00:00', 0, 1),
(4, 'mi proyecto', 'hola, mundo', '2019-05-21', 'oaxaca,oax', '16:00:00', 0, 1),
(5, 'reunion hoy', 'nuev reunionn', '2019-05-26', 'mexico', '01:00:00', 1, 1),
(6, 'popo', 'poposita', '2019-05-26', 'popo', '12:00:00', 1, 1),
(7, 'ghgh', 'fgdfgfhg', '2019-05-27', 'cgfhgfh', '01:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Socio'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `confirmar` int(2) NOT NULL COMMENT '0 rechazó 1 confirmó participación',
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `password`, `confirmar`, `idRol`) VALUES
(1, 'admin', 'admin', 0, 1),
(2, 'juan', 'juanito', 0, 3),
(3, 'prueba1', '123', 0, 3),
(4, 'prueba2', '123', 0, 3),
(5, 'prueba3', '123', 0, 3),
(6, 'prueba4', '123', 0, 3),
(7, 'prueba5', '123', 0, 3),
(8, 'root', 'root', 0, 3),
(9, 'pp', 'pp', 0, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propuestas_de_horario`
--
ALTER TABLE `propuestas_de_horario`
  ADD PRIMARY KEY (`idPropuesta`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idReunion` (`idReunion`);

--
-- Indices de la tabla `rangoFechas`
--
ALTER TABLE `rangoFechas`
  ADD PRIMARY KEY (`idRangoFechas`),
  ADD KEY `relReunion` (`idReunion`);

--
-- Indices de la tabla `relReunionUsuario`
--
ALTER TABLE `relReunionUsuario`
  ADD PRIMARY KEY (`idRelRU`),
  ADD KEY `idReunion` (`idReunion`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD PRIMARY KEY (`idReunion`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `foránea roles` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propuestas_de_horario`
--
ALTER TABLE `propuestas_de_horario`
  MODIFY `idPropuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rangoFechas`
--
ALTER TABLE `rangoFechas`
  MODIFY `idRangoFechas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `relReunionUsuario`
--
ALTER TABLE `relReunionUsuario`
  MODIFY `idRelRU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `idReunion` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propuestas_de_horario`
--
ALTER TABLE `propuestas_de_horario`
  ADD CONSTRAINT `foranea reunion-propuesta` FOREIGN KEY (`idReunion`) REFERENCES `reuniones` (`idreunion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foránea usuarios-propuesta-de-horario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rangoFechas`
--
ALTER TABLE `rangoFechas`
  ADD CONSTRAINT `relReunion` FOREIGN KEY (`idReunion`) REFERENCES `reuniones` (`idreunion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `relReunionUsuario`
--
ALTER TABLE `relReunionUsuario`
  ADD CONSTRAINT `reunion` FOREIGN KEY (`idReunion`) REFERENCES `reuniones` (`idreunion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD CONSTRAINT `foránea usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `foránea roles` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
