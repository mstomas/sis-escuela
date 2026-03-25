-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-06-2017 a las 16:09:47
-- Versión del servidor: 5.6.21-log
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_escuela`
--
CREATE DATABASE IF NOT EXISTS `sis_escuela` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sis_escuela`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `crea_clave`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `crea_clave`(semilla int, p1 int, p2 int, p3 int, cont int, inout val varchar(30))
begin

declare modulo integer; 
declare resultado  float;
declare caracter varchar(30);
declare inicio integer;
declare whi varchar (30);
declare str varchar(30);
set whi='10';
set modulo = mod ((p1*semilla+p2),p3);
set resultado = modulo/p3;
set str = CAST(resultado AS CHAR(30));
set inicio= locate('.',str);
set max_sp_recursion_depth =15;-- para que acepte recursividad hasta 15 veces
while whi='10' do
set caracter=substring(str,inicio+1,2);
if  caracter>47 and caracter<123 then
set whi='25';
else
set inicio=inicio+1;
end if;
end while ;
if  cont<15 then
set cont=cont+1;
set val= concat(val, char(caracter));
call crea_clave(modulo , p1 , p2 , p3 , cont+1,val );
else 
select concat(val, caracter) into val;	
end if;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `cod_alumno` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `cod_grado` int(11) DEFAULT NULL,
  `cod_ciclo_escolar` int(11) DEFAULT NULL,
  `clave` int(11) DEFAULT NULL,
  `codigo_tarjeta` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`cod_alumno`, `nombre`, `direccion`, `cod_grado`, `cod_ciclo_escolar`, `clave`, `codigo_tarjeta`) VALUES
(16, 'Marcos Tomas', '7a. Av. 3-08', 1, 1, 1, 'mt100'),
(17, 'Kevin Ronaldo', '7a. Av. 3-08', 1, 1, 2, 'kr101'),
(18, 'Lopez García', '7a. Av. 3-08', 1, 1, 3, 'lg102'),
(19, 'Edwin Alfredo', '7a. Av. 3-08', 1, 1, 4, 'ea103'),
(20, 'Edy Javier Morales', '9a. Calle', 1, 1, 5, 'ej104'),
(21, 'Angel Hernandez', '7a. Av. 3-08', 1, 1, 6, 'ah105'),
(22, 'Rony Cali', '7a. Av. 3-08', 1, 1, 7, 'rc106');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

DROP TABLE IF EXISTS `aplicacion`;
CREATE TABLE IF NOT EXISTS `aplicacion` (
  `idAplicacion` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aplicacion`
--

INSERT INTO `aplicacion` (`idAplicacion`, `Nombre`) VALUES
(1, 'Ingresos'),
(2, 'Reportes'),
(3, 'Seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `codigo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`codigo`, `fecha`, `descripcion`) VALUES
(38, '2017-05-01', 'Asistencia del día 01 de Mayo 2017'),
(39, '2017-05-02', 'Asistencia del día 02 de Mayo 2017'),
(40, '2017-05-03', 'Asistencia del día 03 de Mayo 2017'),
(41, '2017-05-04', 'Asistencia del día 04 de Mayo 2017'),
(42, '2017-05-05', 'Asistencia del día 05 de Mayo 2017'),
(43, '2017-05-06', 'Asistencia del día 06 de Mayo 2017'),
(44, '2017-05-07', 'Asistencia del día 07 de Mayo 2017'),
(45, '2017-05-08', 'Asistencia del día 08 de Mayo 2017'),
(46, '2017-05-09', 'Asistencia del día 09 de Mayo 2017'),
(47, '2017-05-10', 'Asistencia del día 10 de Mayo 2017'),
(48, '2017-05-11', 'Asistencia del día 11 de Mayo 2017'),
(49, '2017-05-12', 'Asistencia del día 12 de Mayo 2017'),
(50, '2017-05-13', 'Asistencia del día 13 de Mayo 2017'),
(51, '2017-05-14', 'Asistencia del día 14 de Mayo 2017'),
(52, '2017-05-15', 'Asistencia del día 15 de Mayo 2017'),
(53, '2017-05-16', 'Asistencia del día 16 de Mayo 2017'),
(54, '2017-05-17', 'Asistencia del día 17 de Mayo 2017'),
(55, '2017-05-18', 'Asistencia del día 18 de Mayo 2017'),
(56, '2017-05-19', 'Asistencia del día 19 de Mayo 2017'),
(57, '2017-05-20', 'Asistencia del día 20 de Mayo 2017'),
(58, '2017-05-21', 'Asistencia del día 21 de Mayo 2017'),
(59, '2017-05-22', 'Asistencia del día 22 de Mayo 2017'),
(60, '2017-05-23', 'Asistencia del día 23 de Mayo 2017'),
(61, '2017-05-24', 'Asistencia del día 24 de Mayo 2017'),
(62, '2017-05-25', 'Asistencia del día 25 de Mayo 2017'),
(63, '2017-05-26', 'Asistencia del día 26 de Mayo 2017'),
(64, '2017-05-27', 'Asistencia del día 27 de Mayo 2017'),
(65, '2017-05-28', 'Asistencia del día 28 de Mayo 2017'),
(66, '2017-05-29', 'Asistencia del día 29 de Mayo 2017'),
(67, '2017-05-30', 'Asistencia del día 30 de Mayo 2017'),
(68, '2017-05-31', 'Asistencia del día 31 de Mayo 2017'),
(69, '2017-06-01', 'Asistencia del día 01 de Junio 2017'),
(70, '2017-06-02', 'Asistencia del día 02 de Junio 2017');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_detalle`
--

DROP TABLE IF EXISTS `asistencia_detalle`;
CREATE TABLE IF NOT EXISTS `asistencia_detalle` (
  `codigo` int(11) NOT NULL,
  `codigo_asistencia` int(11) NOT NULL,
  `codigo_alumno` int(11) NOT NULL,
  `hora_entrada` datetime NOT NULL,
  `hora_salida` datetime DEFAULT NULL,
  `descripcion_inasistencia` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia_detalle`
--

INSERT INTO `asistencia_detalle` (`codigo`, `codigo_asistencia`, `codigo_alumno`, `hora_entrada`, `hora_salida`, `descripcion_inasistencia`) VALUES
(13, 38, 16, '2017-05-01 07:45:00', '2017-05-01 18:18:00', ''),
(14, 38, 17, '2017-05-01 08:35:00', '2017-05-01 17:40:00', ''),
(15, 38, 18, '2017-05-01 07:12:00', '2017-05-01 17:37:00', ''),
(16, 38, 19, '2017-05-01 07:17:00', '2017-05-01 17:13:00', ''),
(17, 38, 20, '2017-05-01 08:42:00', '2017-05-01 17:39:00', ''),
(18, 38, 21, '2017-05-01 08:15:00', '2017-05-01 17:43:00', ''),
(19, 38, 22, '2017-05-01 08:35:00', '2017-05-01 18:43:00', ''),
(20, 39, 16, '2017-05-02 08:14:00', '2017-05-02 17:37:00', ''),
(21, 39, 17, '2017-05-02 08:13:00', '2017-05-02 18:40:00', ''),
(22, 39, 18, '2017-05-02 08:28:00', '2017-05-02 17:23:00', ''),
(23, 39, 19, '2017-05-02 07:26:00', '2017-05-02 18:48:00', ''),
(24, 39, 20, '2017-05-02 07:40:00', '2017-05-02 18:56:00', ''),
(25, 39, 21, '2017-05-02 08:47:00', '2017-05-02 17:58:00', ''),
(26, 39, 22, '2017-05-02 08:12:00', '2017-05-02 17:16:00', ''),
(27, 40, 16, '2017-05-03 08:24:00', '2017-05-03 18:38:00', ''),
(28, 40, 17, '2017-05-03 08:30:00', '2017-05-03 18:58:00', ''),
(29, 40, 18, '2017-05-03 08:30:00', '2017-05-03 18:30:00', ''),
(30, 40, 19, '2017-05-03 07:56:00', '2017-05-03 18:11:00', ''),
(31, 40, 20, '2017-05-03 08:14:00', '2017-05-03 17:51:00', ''),
(32, 40, 21, '2017-05-03 08:24:00', '2017-05-03 18:29:00', ''),
(33, 40, 22, '2017-05-03 07:50:00', '2017-05-03 18:43:00', ''),
(34, 41, 16, '2017-05-04 07:46:00', '2017-05-04 17:44:00', ''),
(35, 41, 17, '2017-05-04 07:36:00', '2017-05-04 17:24:00', ''),
(36, 41, 18, '2017-05-04 08:57:00', '2017-05-04 17:59:00', ''),
(37, 41, 19, '2017-05-04 08:45:00', '2017-05-04 17:36:00', ''),
(38, 41, 20, '2017-05-04 07:20:00', '2017-05-04 18:53:00', ''),
(39, 41, 21, '2017-05-04 08:26:00', '2017-05-04 17:46:00', ''),
(40, 41, 22, '2017-05-04 08:19:00', '2017-05-04 18:32:00', ''),
(41, 42, 16, '2017-05-05 07:52:00', '2017-05-05 17:46:00', ''),
(42, 42, 17, '2017-05-05 07:15:00', '2017-05-05 18:26:00', ''),
(43, 42, 18, '2017-05-05 08:22:00', '2017-05-05 18:53:00', ''),
(44, 42, 19, '2017-05-05 08:45:00', '2017-05-05 17:39:00', ''),
(45, 42, 20, '2017-05-05 07:58:00', '2017-05-05 18:10:00', ''),
(46, 42, 21, '2017-05-05 08:20:00', '2017-05-05 17:50:00', ''),
(47, 42, 22, '2017-05-05 08:11:00', '2017-05-05 17:34:00', ''),
(49, 43, 17, '2017-05-06 07:52:00', '2017-05-06 18:16:00', ''),
(50, 43, 18, '2017-05-06 08:21:00', '2017-05-06 18:13:00', ''),
(51, 43, 19, '2017-05-06 08:31:00', '2017-05-06 18:25:00', ''),
(52, 43, 20, '2017-05-06 07:44:00', '2017-05-06 18:49:00', ''),
(53, 43, 21, '2017-05-06 07:20:00', '2017-05-06 17:51:00', ''),
(54, 43, 22, '2017-05-06 08:56:00', '2017-05-06 18:52:00', ''),
(55, 44, 16, '2017-05-07 07:19:00', '2017-05-07 17:14:00', ''),
(56, 44, 17, '2017-05-07 08:41:00', '2017-05-07 17:28:00', ''),
(57, 44, 18, '2017-05-07 07:51:00', '2017-05-07 17:53:00', ''),
(58, 44, 19, '2017-05-07 07:12:00', '2017-05-07 18:55:00', ''),
(59, 44, 20, '2017-05-07 07:13:00', '2017-05-07 18:38:00', ''),
(60, 44, 21, '2017-05-07 07:54:00', '2017-05-07 17:39:00', ''),
(61, 44, 22, '2017-05-07 08:31:00', '2017-05-07 18:10:00', ''),
(62, 45, 16, '2017-05-08 08:27:00', '2017-05-08 17:59:00', ''),
(63, 45, 17, '2017-05-08 07:51:00', '2017-05-08 18:35:00', ''),
(64, 45, 18, '2017-05-08 07:19:00', '2017-05-08 17:20:00', ''),
(65, 45, 19, '2017-05-08 08:48:00', '2017-05-08 17:58:00', ''),
(66, 45, 20, '2017-05-08 08:39:00', '2017-05-08 18:51:00', ''),
(67, 45, 21, '2017-05-08 07:19:00', '2017-05-08 17:44:00', ''),
(68, 45, 22, '2017-05-08 08:25:00', '2017-05-08 18:58:00', ''),
(69, 46, 16, '2017-05-09 08:39:00', '2017-05-09 17:35:00', ''),
(70, 46, 17, '2017-05-09 08:35:00', '2017-05-09 18:20:00', ''),
(71, 46, 18, '2017-05-09 07:56:00', '2017-05-09 18:50:00', ''),
(72, 46, 19, '2017-05-09 07:58:00', '2017-05-09 17:41:00', ''),
(73, 46, 20, '2017-05-09 07:43:00', '2017-05-09 18:29:00', ''),
(74, 46, 21, '2017-05-09 07:53:00', '2017-05-09 18:52:00', ''),
(75, 46, 22, '2017-05-09 07:49:00', '2017-05-09 18:41:00', ''),
(76, 47, 16, '2017-05-10 07:56:00', '2017-05-10 18:57:00', ''),
(77, 47, 17, '2017-05-10 07:47:00', '2017-05-10 18:28:00', ''),
(78, 47, 18, '2017-05-10 08:29:00', '2017-05-10 17:36:00', ''),
(79, 47, 19, '2017-05-10 08:35:00', '2017-05-10 17:56:00', ''),
(80, 47, 20, '2017-05-10 08:57:00', '2017-05-10 17:43:00', ''),
(81, 47, 21, '2017-05-10 08:37:00', '2017-05-10 17:18:00', ''),
(82, 47, 22, '2017-05-10 07:52:00', '2017-05-10 18:58:00', ''),
(83, 48, 16, '2017-05-11 08:52:00', '2017-05-11 17:31:00', ''),
(84, 48, 17, '2017-05-11 08:49:00', '2017-05-11 17:36:00', ''),
(85, 48, 18, '2017-05-11 07:52:00', '2017-05-11 18:38:00', ''),
(86, 48, 19, '2017-05-11 07:59:00', '2017-05-11 18:56:00', ''),
(87, 48, 20, '2017-05-11 08:37:00', '2017-05-11 18:54:00', ''),
(88, 48, 21, '2017-05-11 08:18:00', '2017-05-11 17:24:00', ''),
(89, 48, 22, '2017-05-11 08:30:00', '2017-05-11 17:24:00', ''),
(90, 49, 16, '2017-05-12 08:37:00', '2017-05-12 18:18:00', ''),
(91, 49, 17, '2017-05-12 08:28:00', '2017-05-12 17:13:00', ''),
(92, 49, 18, '2017-05-12 07:52:00', '2017-05-12 17:44:00', ''),
(93, 49, 19, '2017-05-12 08:56:00', '2017-05-12 17:15:00', ''),
(94, 49, 20, '2017-05-12 08:24:00', '2017-05-12 17:32:00', ''),
(95, 49, 21, '2017-05-12 07:13:00', '2017-05-12 18:45:00', ''),
(96, 49, 22, '2017-05-12 08:39:00', '2017-05-12 17:35:00', ''),
(98, 50, 17, '2017-05-13 07:58:00', '2017-05-13 17:34:00', ''),
(99, 50, 18, '2017-05-13 08:28:00', '2017-05-13 18:38:00', ''),
(100, 50, 19, '2017-05-13 07:17:00', '2017-05-13 18:33:00', ''),
(101, 50, 20, '2017-05-13 08:59:00', '2017-05-13 18:59:00', ''),
(102, 50, 21, '2017-05-13 07:26:00', '2017-05-13 18:12:00', ''),
(103, 50, 22, '2017-05-13 08:12:00', '2017-05-13 17:28:00', ''),
(104, 51, 16, '2017-05-14 08:22:00', '2017-05-14 17:25:00', ''),
(105, 51, 17, '2017-05-14 08:10:00', '2017-05-14 18:37:00', ''),
(106, 51, 18, '2017-05-14 08:15:00', '2017-05-14 18:53:00', ''),
(107, 51, 19, '2017-05-14 07:51:00', '2017-05-14 17:54:00', ''),
(108, 51, 20, '2017-05-14 07:42:00', '2017-05-14 18:50:00', ''),
(109, 51, 21, '2017-05-14 07:10:00', '2017-05-14 17:20:00', ''),
(110, 51, 22, '2017-05-14 08:13:00', '2017-05-14 18:46:00', ''),
(111, 52, 16, '2017-05-15 08:34:00', '2017-05-15 17:53:00', ''),
(112, 52, 17, '2017-05-15 08:15:00', '2017-05-15 17:45:00', ''),
(113, 52, 18, '2017-05-15 07:47:00', '2017-05-15 18:45:00', ''),
(114, 52, 19, '2017-05-15 07:58:00', '2017-05-15 17:28:00', ''),
(115, 52, 20, '2017-05-15 07:48:00', '2017-05-15 18:13:00', ''),
(116, 52, 21, '2017-05-15 07:28:00', '2017-05-15 18:48:00', ''),
(117, 52, 22, '2017-05-15 08:59:00', '2017-05-15 18:49:00', ''),
(118, 53, 16, '2017-05-16 08:37:00', '2017-05-16 17:36:00', ''),
(119, 53, 17, '2017-05-16 07:30:00', '2017-05-16 17:20:00', ''),
(120, 53, 18, '2017-05-16 07:19:00', '2017-05-16 17:45:00', ''),
(121, 53, 19, '2017-05-16 07:33:00', '2017-05-16 18:20:00', ''),
(122, 53, 20, '2017-05-16 07:37:00', '2017-05-16 17:57:00', ''),
(123, 53, 21, '2017-05-16 08:18:00', '2017-05-16 18:14:00', ''),
(124, 53, 22, '2017-05-16 07:26:00', '2017-05-16 18:25:00', ''),
(125, 54, 16, '2017-05-17 08:57:00', '2017-05-17 17:45:00', ''),
(126, 54, 17, '2017-05-17 07:46:00', '2017-05-17 17:30:00', ''),
(127, 54, 18, '2017-05-17 08:49:00', '2017-05-17 17:30:00', ''),
(128, 54, 19, '2017-05-17 08:34:00', '2017-05-17 17:25:00', ''),
(129, 54, 20, '2017-05-17 07:18:00', '2017-05-17 18:11:00', ''),
(130, 54, 21, '2017-05-17 08:52:00', '2017-05-17 18:41:00', ''),
(131, 54, 22, '2017-05-17 07:11:00', '2017-05-17 18:57:00', ''),
(132, 55, 16, '2017-05-18 07:34:00', '2017-05-18 17:32:00', ''),
(133, 55, 17, '2017-05-18 08:53:00', '2017-05-18 18:58:00', ''),
(134, 55, 18, '2017-05-18 07:41:00', '2017-05-18 18:28:00', ''),
(135, 55, 19, '2017-05-18 08:42:00', '2017-05-18 18:31:00', ''),
(136, 55, 20, '2017-05-18 08:11:00', '2017-05-18 18:34:00', ''),
(137, 55, 21, '2017-05-18 08:51:00', '2017-05-18 18:20:00', ''),
(138, 55, 22, '2017-05-18 08:52:00', '2017-05-18 18:29:00', ''),
(139, 56, 16, '2017-05-19 08:28:00', '2017-05-19 18:42:00', ''),
(140, 56, 17, '2017-05-19 07:53:00', '2017-05-19 17:19:00', ''),
(141, 56, 18, '2017-05-19 08:48:00', '2017-05-19 18:38:00', ''),
(142, 56, 19, '2017-05-19 08:23:00', '2017-05-19 18:32:00', ''),
(143, 56, 20, '2017-05-19 08:58:00', '2017-05-19 17:25:00', ''),
(144, 56, 21, '2017-05-19 08:48:00', '2017-05-19 18:23:00', ''),
(145, 56, 22, '2017-05-19 08:32:00', '2017-05-19 17:47:00', ''),
(146, 57, 16, '2017-05-20 08:39:00', '2017-05-20 17:23:00', ''),
(147, 57, 17, '2017-05-20 07:19:00', '2017-05-20 17:19:00', ''),
(148, 57, 18, '2017-05-20 08:33:00', '2017-05-20 17:35:00', ''),
(149, 57, 19, '2017-05-20 08:41:00', '2017-05-20 18:35:00', ''),
(150, 57, 20, '2017-05-20 07:40:00', '2017-05-20 17:40:00', ''),
(151, 57, 21, '2017-05-20 08:48:00', '2017-05-20 17:11:00', ''),
(152, 57, 22, '2017-05-20 07:46:00', '2017-05-20 17:42:00', ''),
(153, 58, 16, '2017-05-21 08:12:00', '2017-05-21 18:40:00', ''),
(154, 58, 17, '2017-05-21 08:12:00', '2017-05-21 17:21:00', ''),
(155, 58, 18, '2017-05-21 08:33:00', '2017-05-21 17:39:00', ''),
(156, 58, 19, '2017-05-21 07:24:00', '2017-05-21 17:31:00', ''),
(157, 58, 20, '2017-05-21 07:33:00', '2017-05-21 17:50:00', ''),
(158, 58, 21, '2017-05-21 07:43:00', '2017-05-21 17:53:00', ''),
(159, 58, 22, '2017-05-21 08:11:00', '2017-05-21 17:39:00', ''),
(160, 59, 16, '2017-05-22 08:55:00', '2017-05-22 17:40:00', ''),
(161, 59, 17, '2017-05-22 08:40:00', '2017-05-22 18:51:00', ''),
(162, 59, 18, '2017-05-22 08:20:00', '2017-05-22 18:23:00', ''),
(163, 59, 19, '2017-05-22 08:20:00', '2017-05-22 17:51:00', ''),
(164, 59, 20, '2017-05-22 08:26:00', '2017-05-22 17:57:00', ''),
(165, 59, 21, '2017-05-22 08:23:00', '2017-05-22 17:31:00', ''),
(166, 59, 22, '2017-05-22 07:32:00', '2017-05-22 18:20:00', ''),
(167, 60, 16, '2017-05-23 08:47:00', '2017-05-23 18:10:00', ''),
(168, 60, 17, '2017-05-23 08:25:00', '2017-05-23 18:18:00', ''),
(169, 60, 18, '2017-05-23 07:17:00', '2017-05-23 18:29:00', ''),
(170, 60, 19, '2017-05-23 07:15:00', '2017-05-23 17:30:00', ''),
(171, 60, 20, '2017-05-23 07:31:00', '2017-05-23 17:55:00', ''),
(172, 60, 21, '2017-05-23 07:39:00', '2017-05-23 18:12:00', ''),
(173, 60, 22, '2017-05-23 08:11:00', '2017-05-23 17:30:00', ''),
(174, 61, 16, '2017-05-24 08:57:00', '2017-05-24 18:42:00', ''),
(175, 61, 17, '2017-05-24 08:57:00', '2017-05-24 17:22:00', ''),
(176, 61, 18, '2017-05-24 08:55:00', '2017-05-24 17:26:00', ''),
(177, 61, 19, '2017-05-24 08:42:00', '2017-05-24 18:24:00', ''),
(178, 61, 20, '2017-05-24 08:45:00', '2017-05-24 18:42:00', ''),
(179, 61, 21, '2017-05-24 08:15:00', '2017-05-24 18:51:00', ''),
(180, 61, 22, '2017-05-24 07:12:00', '2017-05-24 18:47:00', ''),
(181, 62, 16, '2017-05-25 07:48:00', '2017-05-25 18:46:00', ''),
(182, 62, 17, '2017-05-25 07:18:00', '2017-05-25 18:19:00', ''),
(183, 62, 18, '2017-05-25 08:41:00', '2017-05-25 18:27:00', ''),
(184, 62, 19, '2017-05-25 08:47:00', '2017-05-25 17:13:00', ''),
(185, 62, 20, '2017-05-25 08:16:00', '2017-05-25 18:36:00', ''),
(186, 62, 21, '2017-05-25 07:12:00', '2017-05-25 18:59:00', ''),
(187, 62, 22, '2017-05-25 08:22:00', '2017-05-25 17:39:00', ''),
(188, 63, 16, '2017-05-26 08:47:00', '2017-05-26 18:12:00', ''),
(189, 63, 17, '2017-05-26 07:33:00', '2017-05-26 17:30:00', ''),
(190, 63, 18, '2017-05-26 08:15:00', '2017-05-26 18:50:00', ''),
(191, 63, 19, '2017-05-26 07:48:00', '2017-05-26 18:24:00', ''),
(192, 63, 20, '2017-05-26 08:50:00', '2017-05-26 18:30:00', ''),
(193, 63, 21, '2017-05-26 07:38:00', '2017-05-26 17:15:00', ''),
(194, 63, 22, '2017-05-26 08:14:00', '2017-05-26 18:30:00', ''),
(195, 64, 16, '2017-05-27 08:53:00', '2017-05-27 17:20:00', ''),
(196, 64, 17, '2017-05-27 08:43:00', '2017-05-27 18:56:00', ''),
(197, 64, 18, '2017-05-27 08:17:00', '2017-05-27 17:30:00', ''),
(198, 64, 19, '2017-05-27 07:47:00', '2017-05-27 18:37:00', ''),
(199, 64, 20, '2017-05-27 08:28:00', '2017-05-27 17:13:00', ''),
(200, 64, 21, '2017-05-27 08:14:00', '2017-05-27 17:27:00', ''),
(201, 64, 22, '2017-05-27 07:59:00', '2017-05-27 17:12:00', ''),
(202, 65, 16, '2017-05-28 08:52:00', '2017-05-28 18:57:00', ''),
(203, 65, 17, '2017-05-28 08:58:00', '2017-05-28 17:42:00', ''),
(204, 65, 18, '2017-05-28 08:49:00', '2017-05-28 17:30:00', ''),
(205, 65, 19, '2017-05-28 08:49:00', '2017-05-28 18:48:00', ''),
(206, 65, 20, '2017-05-28 08:16:00', '2017-05-28 18:28:00', ''),
(207, 65, 21, '2017-05-28 08:31:00', '2017-05-28 18:45:00', ''),
(208, 65, 22, '2017-05-28 07:38:00', '2017-05-28 18:53:00', ''),
(209, 66, 16, '2017-05-29 08:27:00', '2017-05-29 17:25:00', ''),
(210, 66, 17, '2017-05-29 07:26:00', '2017-05-29 18:37:00', ''),
(211, 66, 18, '2017-05-29 08:36:00', '2017-05-29 17:57:00', ''),
(212, 66, 19, '2017-05-29 08:17:00', '2017-05-29 17:34:00', ''),
(213, 66, 20, '2017-05-29 07:30:00', '2017-05-29 17:33:00', ''),
(214, 66, 21, '2017-05-29 08:21:00', '2017-05-29 18:23:00', ''),
(215, 66, 22, '2017-05-29 07:59:00', '2017-05-29 17:18:00', ''),
(216, 67, 16, '2017-05-30 08:24:00', '2017-05-30 17:59:00', ''),
(217, 67, 17, '2017-05-30 08:45:00', '2017-05-30 18:56:00', ''),
(218, 67, 18, '2017-05-30 07:37:00', '2017-05-30 17:23:00', ''),
(219, 67, 19, '2017-05-30 08:37:00', '2017-05-30 18:14:00', ''),
(220, 67, 20, '2017-05-30 07:46:00', '2017-05-30 18:17:00', ''),
(221, 67, 21, '2017-05-30 07:59:00', '2017-05-30 18:35:00', ''),
(222, 67, 22, '2017-05-30 07:11:00', '2017-05-30 17:23:00', ''),
(223, 68, 16, '2017-05-31 07:59:00', '2017-05-31 18:34:00', ''),
(224, 68, 17, '2017-05-31 07:20:00', '2017-05-31 18:45:00', ''),
(225, 68, 18, '2017-05-31 07:11:00', '2017-05-31 17:55:00', ''),
(226, 68, 19, '2017-05-31 08:33:00', '2017-05-31 18:13:00', ''),
(227, 68, 20, '2017-05-31 08:12:00', '2017-05-31 17:14:00', ''),
(228, 68, 21, '2017-05-31 07:35:00', '2017-05-31 18:31:00', ''),
(229, 68, 22, '2017-05-31 08:37:00', '2017-05-31 18:54:00', ''),
(230, 69, 16, '2017-06-01 21:06:02', NULL, ''),
(231, 69, 17, '2017-06-01 21:06:12', NULL, ''),
(232, 69, 18, '2017-06-01 21:06:18', NULL, ''),
(233, 69, 19, '2017-06-01 21:06:25', NULL, ''),
(234, 70, 19, '2017-06-02 01:06:38', '2017-06-02 15:13:45', ''),
(236, 70, 16, '2017-06-02 01:06:58', '2017-06-02 01:06:40', ''),
(238, 70, 20, '2017-06-02 01:25:08', '2017-06-02 15:13:55', ''),
(239, 70, 17, '2017-06-02 16:01:33', NULL, ''),
(240, 70, 18, '2017-06-02 16:02:58', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

DROP TABLE IF EXISTS `ciclo`;
CREATE TABLE IF NOT EXISTS `ciclo` (
  `cod_ciclo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciclo`
--

INSERT INTO `ciclo` (`cod_ciclo`, `nombre`) VALUES
(1, 'Fundamental'),
(2, 'Básico Complementario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo_escolar`
--

DROP TABLE IF EXISTS `ciclo_escolar`;
CREATE TABLE IF NOT EXISTS `ciclo_escolar` (
  `cod_ciclo_escolar` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciclo_escolar`
--

INSERT INTO `ciclo_escolar` (`cod_ciclo_escolar`, `descripcion`, `anio`) VALUES
(1, 'Ciclo Escolar 2014', 2014),
(2, 'Ciclo Escolar 2015', 2015),
(3, 'Ciclo escolar 2017', 2017);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `cod_curso` int(11) NOT NULL,
  `nombre` varchar(120) DEFAULT NULL,
  `cod_ciclo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`cod_curso`, `nombre`, `cod_ciclo`) VALUES
(15, 'Comunicación y Lenguaje', 1),
(16, 'Idioma Materno', 1),
(17, 'Idioma Extranjero', 1),
(18, 'Matématicas', 1),
(19, 'Medio Social y Natural', 1),
(20, 'Expresión Artística', 1),
(21, 'Formación Ciudadana', 1),
(22, 'Educación Física', 1),
(23, 'Comunicación y Lenguaje', 2),
(24, 'Idioma Materno', 2),
(25, 'Idioma Extranjero', 2),
(26, 'Matemáticas', 2),
(27, 'Ciencias Naturales y Teconología', 2),
(28, 'Ciencias Sociales', 2),
(29, 'Expresión Artistica', 2),
(30, 'Productividad y Desarrollo', 2),
(31, 'Eduación Física', 2),
(32, 'Formación Ciudadana', 2),
(33, 'marcos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
  `cod_docente` int(11) NOT NULL,
  `nombre` varchar(160) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`cod_docente`, `nombre`, `telefono`, `email`) VALUES
(6, 'Carlos Cifuentes', 43369764, 'ccifuentes@gmail.com'),
(7, 'Noe Blandon', 98768976, 'nblandon@gmail.com'),
(8, 'Alicia Lopez', 43377644, 'alopez@gmail.com'),
(9, 'Karla Ordoñez', 54564564, 'kordonez@gmail.com'),
(10, 'Gladis Solis', 50199679, 'gsolis@gmail.com'),
(11, 'Nery Mazariegos', 98768976, 'nmazariegos@gmail.com'),
(12, 'Jorge Molina', 54564564, 'jmolina@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_cursos`
--

DROP TABLE IF EXISTS `docente_cursos`;
CREATE TABLE IF NOT EXISTS `docente_cursos` (
  `codigo` int(11) NOT NULL,
  `cod_docente` int(11) DEFAULT NULL,
  `cod_grado` int(11) DEFAULT NULL,
  `cod_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente_cursos`
--

INSERT INTO `docente_cursos` (`codigo`, `cod_docente`, `cod_grado`, `cod_curso`) VALUES
(12, 6, 1, 15),
(13, 6, 1, 16),
(14, 6, 1, 17),
(15, 6, 1, 18),
(16, 6, 1, 19),
(17, 6, 1, 20),
(18, 6, 1, 21),
(19, 6, 1, 22),
(20, 7, 2, 15),
(21, 7, 2, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatususuario`
--

DROP TABLE IF EXISTS `estatususuario`;
CREATE TABLE IF NOT EXISTS `estatususuario` (
  `idEstatusUsuario` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatususuario`
--

INSERT INTO `estatususuario` (`idEstatusUsuario`, `Descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_seccion`
--

DROP TABLE IF EXISTS `grado_seccion`;
CREATE TABLE IF NOT EXISTS `grado_seccion` (
  `cod_grado` int(11) NOT NULL,
  `grado` int(11) DEFAULT NULL,
  `seccion` varchar(2) DEFAULT NULL,
  `cod_ciclo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grado_seccion`
--

INSERT INTO `grado_seccion` (`cod_grado`, `grado`, `seccion`, `cod_ciclo`) VALUES
(1, 1, 'A', 1),
(2, 1, 'B', 1),
(3, 1, 'C', 1),
(4, 1, 'D', 1),
(5, 2, 'A', 1),
(6, 2, 'B', 1),
(7, 2, 'C', 1),
(8, 2, 'D', 1),
(9, 3, 'A', 1),
(10, 3, 'B', 1),
(11, 3, 'C', 1),
(12, 3, 'D', 1),
(13, 4, 'A', 2),
(14, 4, 'B', 2),
(15, 4, 'C', 2),
(16, 4, 'D', 2),
(17, 5, 'A', 2),
(18, 5, 'B', 2),
(19, 5, 'C', 2),
(20, 5, 'D', 2),
(21, 6, 'A', 2),
(22, 6, 'B', 2),
(23, 6, 'C', 2),
(24, 6, 'D', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `idAplicacion` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Pagina` varchar(150) NOT NULL,
  `Icono` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idAplicacion`, `idMenu`, `Nombre`, `Pagina`, `Icono`) VALUES
(1, 1, 'Inicio', 'principal', 'home'),
(1, 2, 'Ciclo', 'ciclo', 'repeat'),
(1, 3, 'Ciclo Escolar', 'ciclo_escolar', 'repeat'),
(1, 4, 'Curso', 'curso', 'book'),
(1, 5, 'Maestros', 'maestro', 'user'),
(1, 6, 'Grados', 'grado', 'user'),
(1, 7, 'Docentes y cursos', 'docentecursos', 'briefcase'),
(1, 8, 'Alumnos', 'alumno', 'briefcase'),
(1, 9, 'Notas', 'notas', 'pencil'),
(1, 10, 'Marcar entrada', 'marcarentrada', 'import'),
(1, 11, 'Marcar salida', 'marcarsalida', 'export'),
(2, 1, 'Alumnos por Cursos', 'alumnocursos', 'sort-by-alphabet-alt'),
(2, 2, 'Asistencia por alumno', 'asistenciareporte', 'check'),
(2, 3, 'Asistencia por día', 'asistenciareportedia', 'check'),
(2, 4, 'Indicador puntualidad general', 'indicadores', 'stats'),
(2, 5, 'Indicador puntualidad alumno', 'indicadorpuntualidadalumno', 'stats'),
(2, 6, 'Indicador asistencia alumno', 'indicadorasistenciaalumno', 'stats'),
(3, 1, 'Usuarios', 'usuario', 'lock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_alumno`
--

DROP TABLE IF EXISTS `notas_alumno`;
CREATE TABLE IF NOT EXISTS `notas_alumno` (
  `codigo` int(11) NOT NULL,
  `cod_alumno` int(11) DEFAULT NULL,
  `cod_curso` int(11) DEFAULT NULL,
  `cod_ciclo_escolar` int(11) DEFAULT NULL,
  `bimestre_1` decimal(5,0) DEFAULT NULL,
  `bimestre_2` decimal(5,0) DEFAULT NULL,
  `bimestre_3` decimal(5,0) DEFAULT NULL,
  `bimestre_4` decimal(5,0) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notas_alumno`
--

INSERT INTO `notas_alumno` (`codigo`, `cod_alumno`, `cod_curso`, `cod_ciclo_escolar`, `bimestre_1`, `bimestre_2`, `bimestre_3`, `bimestre_4`) VALUES
(71, 16, 15, 1, '0', '0', '0', '0'),
(72, 17, 15, 1, '0', '0', '0', '0'),
(73, 18, 15, 1, '0', '0', '0', '0'),
(74, 19, 15, 1, '0', '0', '0', '0'),
(75, 20, 15, 1, '0', '0', '0', '0'),
(76, 21, 15, 1, '0', '0', '0', '0'),
(77, 16, 15, 2, '90', '90', '90', '90'),
(78, 17, 15, 2, '80', '80', '80', '90'),
(79, 18, 15, 2, '90', '90', '90', '40'),
(80, 19, 15, 2, '90', '89', '89', '78'),
(81, 20, 15, 2, '79', '99', '88', '89'),
(82, 21, 15, 2, '88', '88', '89', '87'),
(83, 22, 15, 2, '99', '89', '93', '60'),
(84, 16, 16, 2, '0', '0', '0', '0'),
(85, 17, 16, 2, '0', '0', '0', '0'),
(86, 18, 16, 2, '0', '0', '0', '0'),
(87, 19, 16, 2, '0', '0', '0', '0'),
(88, 20, 16, 2, '0', '0', '0', '0'),
(89, 21, 16, 2, '0', '0', '0', '0'),
(90, 22, 16, 2, '0', '0', '0', '0'),
(91, 16, 17, 2, '60', '90', '0', '0'),
(92, 17, 17, 2, '48', '56', '0', '0'),
(93, 18, 17, 2, '58', '90', '0', '0'),
(94, 19, 17, 2, '90', '76', '0', '0'),
(95, 20, 17, 2, '55', '0', '0', '0'),
(96, 21, 17, 2, '55', '0', '0', '0'),
(97, 22, 17, 2, '89', '0', '0', '0'),
(98, 16, 19, 2, '0', '0', '0', '0'),
(99, 17, 19, 2, '0', '0', '0', '0'),
(100, 18, 19, 2, '0', '0', '0', '0'),
(101, 19, 19, 2, '0', '0', '0', '0'),
(102, 20, 19, 2, '0', '0', '0', '0'),
(103, 21, 19, 2, '0', '0', '0', '0'),
(104, 22, 19, 2, '0', '0', '0', '0'),
(105, 16, 20, 1, '0', '0', '0', '0'),
(106, 17, 20, 1, '0', '0', '0', '0'),
(107, 18, 20, 1, '0', '0', '0', '0'),
(108, 19, 20, 1, '0', '0', '0', '0'),
(109, 20, 20, 1, '0', '0', '0', '0'),
(110, 21, 20, 1, '0', '0', '0', '0'),
(111, 22, 20, 1, '0', '0', '0', '0'),
(112, 16, 17, 1, '0', '0', '0', '0'),
(113, 17, 17, 1, '0', '0', '0', '0'),
(114, 18, 17, 1, '0', '0', '0', '0'),
(115, 19, 17, 1, '0', '0', '0', '0'),
(116, 20, 17, 1, '0', '0', '0', '0'),
(117, 21, 17, 1, '0', '0', '0', '0'),
(118, 22, 17, 1, '0', '0', '0', '0'),
(119, 16, 16, 1, '0', '0', '0', '0'),
(120, 17, 16, 1, '0', '0', '0', '0'),
(121, 18, 16, 1, '0', '0', '0', '0'),
(122, 19, 16, 1, '0', '0', '0', '0'),
(123, 20, 16, 1, '0', '0', '0', '0'),
(124, 21, 16, 1, '0', '0', '0', '0'),
(125, 22, 16, 1, '0', '0', '0', '0'),
(126, 16, 15, 3, '10', '0', '0', '0'),
(127, 17, 15, 3, '0', '0', '0', '0'),
(128, 18, 15, 3, '0', '0', '0', '0'),
(129, 19, 15, 3, '0', '0', '0', '0'),
(130, 20, 15, 3, '0', '0', '0', '0'),
(131, 21, 15, 3, '0', '0', '0', '0'),
(132, 22, 15, 3, '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcion`
--

DROP TABLE IF EXISTS `opcion`;
CREATE TABLE IF NOT EXISTS `opcion` (
  `idAplicacion` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `idOpcion` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Pagina` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`idRole`, `Nombre`, `Descripcion`) VALUES
(1, 'Administrador', 'Administrador de la aplicación'),
(2, 'Maestro', 'Role para los maestros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roleopcion`
--

DROP TABLE IF EXISTS `roleopcion`;
CREATE TABLE IF NOT EXISTS `roleopcion` (
  `idRole` int(11) NOT NULL,
  `idAplicacion` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roleopcion`
--

INSERT INTO `roleopcion` (`idRole`, `idAplicacion`, `idMenu`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 1, 4),
(1, 1, 5),
(1, 1, 6),
(1, 1, 7),
(1, 1, 8),
(1, 1, 9),
(1, 1, 10),
(1, 1, 11),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(1, 2, 5),
(1, 2, 6),
(1, 3, 1),
(2, 1, 1),
(2, 1, 8),
(2, 1, 9),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` varchar(20) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `idEstatusUsuario` int(11) NOT NULL,
  `UltimaFechaIngreso` datetime DEFAULT NULL,
  `idRole` int(11) NOT NULL,
  `cod_docente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Nombre`, `Password`, `idEstatusUsuario`, `UltimaFechaIngreso`, `idRole`, `cod_docente`) VALUES
('1', 'admin', 'admin', 1, '2014-10-02 00:00:00', 1, NULL),
('2', 'ccifuentes', 'admin', 1, NULL, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioopcion`
--

DROP TABLE IF EXISTS `usuarioopcion`;
CREATE TABLE IF NOT EXISTS `usuarioopcion` (
  `idUsuario` varchar(20) NOT NULL,
  `idAplicacion` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `idOpcion` int(11) NOT NULL,
  `Altas` tinyint(1) DEFAULT NULL,
  `Bajas` tinyint(1) DEFAULT NULL,
  `Cambios` tinyint(1) DEFAULT NULL,
  `Impresion` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`cod_alumno`),
  ADD KEY `fk_alumno_grado_idx` (`cod_grado`),
  ADD KEY `fk_alumno_ciclo_escolar_idx` (`cod_ciclo_escolar`);

--
-- Indices de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  ADD PRIMARY KEY (`idAplicacion`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `asistencia_detalle`
--
ALTER TABLE `asistencia_detalle`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ciclo`
--
ALTER TABLE `ciclo`
  ADD PRIMARY KEY (`cod_ciclo`);

--
-- Indices de la tabla `ciclo_escolar`
--
ALTER TABLE `ciclo_escolar`
  ADD PRIMARY KEY (`cod_ciclo_escolar`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod_curso`),
  ADD KEY `fk_curso_ciclo_idx` (`cod_ciclo`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`cod_docente`);

--
-- Indices de la tabla `docente_cursos`
--
ALTER TABLE `docente_cursos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_docente_docente_idx` (`cod_docente`),
  ADD KEY `fk_docente_grado_idx` (`cod_grado`),
  ADD KEY `fk_docente_curso_idx` (`cod_curso`);

--
-- Indices de la tabla `estatususuario`
--
ALTER TABLE `estatususuario`
  ADD PRIMARY KEY (`idEstatusUsuario`);

--
-- Indices de la tabla `grado_seccion`
--
ALTER TABLE `grado_seccion`
  ADD PRIMARY KEY (`cod_grado`),
  ADD KEY `fk_grado_ciclo_idx` (`cod_ciclo`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idAplicacion`,`idMenu`),
  ADD KEY `fk_menu_aplicacion` (`idAplicacion`);

--
-- Indices de la tabla `notas_alumno`
--
ALTER TABLE `notas_alumno`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_notas_alumno_idx` (`cod_alumno`),
  ADD KEY `fk_notas_curso_idx` (`cod_curso`),
  ADD KEY `fk_notas_ciclo_escolar_idx` (`cod_ciclo_escolar`);

--
-- Indices de la tabla `opcion`
--
ALTER TABLE `opcion`
  ADD PRIMARY KEY (`idAplicacion`,`idMenu`,`idOpcion`),
  ADD KEY `fk_opcion_menu` (`idAplicacion`,`idMenu`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Indices de la tabla `roleopcion`
--
ALTER TABLE `roleopcion`
  ADD PRIMARY KEY (`idRole`,`idAplicacion`,`idMenu`),
  ADD KEY `fk_RoleOpcion_Role1` (`idRole`),
  ADD KEY `fk_roleopcion_opcion` (`idAplicacion`,`idMenu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_usuario_estatususuario` (`idEstatusUsuario`),
  ADD KEY `fk_usuario_role` (`idRole`),
  ADD KEY `fk_usuario_docente_idx` (`cod_docente`);

--
-- Indices de la tabla `usuarioopcion`
--
ALTER TABLE `usuarioopcion`
  ADD PRIMARY KEY (`idUsuario`,`idAplicacion`,`idMenu`,`idOpcion`),
  ADD KEY `fk_usuarioopcion_usuario` (`idUsuario`),
  ADD KEY `fk_usuarioopcion_opcion` (`idAplicacion`,`idMenu`,`idOpcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `cod_alumno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  MODIFY `idAplicacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT de la tabla `asistencia_detalle`
--
ALTER TABLE `asistencia_detalle`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT de la tabla `ciclo`
--
ALTER TABLE `ciclo`
  MODIFY `cod_ciclo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ciclo_escolar`
--
ALTER TABLE `ciclo_escolar`
  MODIFY `cod_ciclo_escolar` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cod_curso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `cod_docente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `docente_cursos`
--
ALTER TABLE `docente_cursos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `grado_seccion`
--
ALTER TABLE `grado_seccion`
  MODIFY `cod_grado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `notas_alumno`
--
ALTER TABLE `notas_alumno`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=133;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_ciclo_escolar` FOREIGN KEY (`cod_ciclo_escolar`) REFERENCES `ciclo_escolar` (`cod_ciclo_escolar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_grado` FOREIGN KEY (`cod_grado`) REFERENCES `grado_seccion` (`cod_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_ciclo` FOREIGN KEY (`cod_ciclo`) REFERENCES `ciclo` (`cod_ciclo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente_cursos`
--
ALTER TABLE `docente_cursos`
  ADD CONSTRAINT `fk_docente_curso` FOREIGN KEY (`cod_curso`) REFERENCES `curso` (`cod_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docente_docente` FOREIGN KEY (`cod_docente`) REFERENCES `docente` (`cod_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docente_grado` FOREIGN KEY (`cod_grado`) REFERENCES `grado_seccion` (`cod_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado_seccion`
--
ALTER TABLE `grado_seccion`
  ADD CONSTRAINT `fk_grado_ciclo` FOREIGN KEY (`cod_ciclo`) REFERENCES `ciclo` (`cod_ciclo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_aplicacion` FOREIGN KEY (`idAplicacion`) REFERENCES `aplicacion` (`idAplicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas_alumno`
--
ALTER TABLE `notas_alumno`
  ADD CONSTRAINT `fk_notas_alumno` FOREIGN KEY (`cod_alumno`) REFERENCES `alumno` (`cod_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_ciclo_escolar` FOREIGN KEY (`cod_ciclo_escolar`) REFERENCES `ciclo_escolar` (`cod_ciclo_escolar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_curso` FOREIGN KEY (`cod_curso`) REFERENCES `curso` (`cod_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `opcion`
--
ALTER TABLE `opcion`
  ADD CONSTRAINT `fk_opcion_menu` FOREIGN KEY (`idAplicacion`, `idMenu`) REFERENCES `menu` (`idAplicacion`, `idMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `roleopcion`
--
ALTER TABLE `roleopcion`
  ADD CONSTRAINT `fk_RoleOpcion_Role` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roleopcion_aplicacion` FOREIGN KEY (`idAplicacion`) REFERENCES `aplicacion` (`idAplicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roleopcion_menu` FOREIGN KEY (`idAplicacion`, `idMenu`) REFERENCES `menu` (`idAplicacion`, `idMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_docente` FOREIGN KEY (`cod_docente`) REFERENCES `docente` (`cod_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_estatususuario` FOREIGN KEY (`idEstatusUsuario`) REFERENCES `estatususuario` (`idEstatusUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_role` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarioopcion`
--
ALTER TABLE `usuarioopcion`
  ADD CONSTRAINT `fk_usuarioopcion_opcion` FOREIGN KEY (`idAplicacion`, `idMenu`, `idOpcion`) REFERENCES `opcion` (`idAplicacion`, `idMenu`, `idOpcion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarioopcion_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
