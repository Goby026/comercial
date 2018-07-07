-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2018 a las 20:12:12
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendapd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taccesomenu`
--

CREATE TABLE `taccesomenu` (
  `codiAcceMenu` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `codiSubMenu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCargo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiArea` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiSistema` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaAcceMenu` date DEFAULT NULL,
  `estaAcceMenu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taccesosistema`
--

CREATE TABLE `taccesosistema` (
  `codiAcceSiste` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `codiSistema` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCargo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiArea` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiEmpre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiTipoContra` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaAcceSiste` date DEFAULT NULL,
  `fechaFinAcceSiste` date DEFAULT NULL,
  `estaAcceSiste` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tacticola`
--

CREATE TABLE `tacticola` (
  `idtActiCola` int(11) NOT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `codiEstaActi` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `porcenAvanActi` double DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tactividad`
--

CREATE TABLE `tactividad` (
  `id` int(11) NOT NULL,
  `codiTipoActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `title` text COLLATE utf8_spanish2_ci,
  `body` text COLLATE utf8_spanish2_ci,
  `url` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `class` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `start` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `end` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `inicio_normal` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `horaIniActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `final_normal` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `horaFinActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `notaActi` text COLLATE utf8_spanish2_ci,
  `imporActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `aviActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ubiActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiEstaActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `porcenAvanActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiColaAsig` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fullDayActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `leido` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tactividadreporte`
--

CREATE TABLE `tactividadreporte` (
  `codiActiRepor` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id` int(11) DEFAULT NULL,
  `codiTipoActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaActiRepor` date DEFAULT NULL,
  `descripRepor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `codiArea` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreArea` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveArea` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaArea` int(11) DEFAULT NULL,
  `fechaRegisArea` date DEFAULT NULL,
  `fechaActiArea` date DEFAULT NULL,
  `fechaDesacArea` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcargo`
--

CREATE TABLE `tcargo` (
  `codiCargo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `codiArea` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreCargo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveCargo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaCargo` int(11) DEFAULT NULL,
  `fechaRegisCargo` date DEFAULT NULL,
  `fechaActiCargo` date DEFAULT NULL,
  `fechaDesacCargo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcargocontacto`
--

CREATE TABLE `tcargocontacto` (
  `codiCargoContac` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreCargoContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveCargoContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaCargoContac` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcargocontacto`
--

INSERT INTO `tcargocontacto` (`codiCargoContac`, `nombreCargoContac`, `nombreBreveCargoContac`, `estaCargoContac`) VALUES
('CC_3_5_201853136127491012811', 'Cargo Nuevo', 'CN', 1),
('cc001', 'Director Ejecutivo', 'CEO', 1),
('cc002', 'Responsable de ventas – Director Comercial', 'CSO', 1),
('cc003', 'Responsable operativo', 'COO', 1),
('cc004', 'Responsable de marketing – Director de Market', ' CMO', 1),
('cc005', 'Director de Recursos Humanos', 'CHRO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcartacola`
--

CREATE TABLE `tcartacola` (
  `idTCartaCola` int(11) NOT NULL,
  `codiCartaPresen` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaModCartaPresen` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcartapresentacion`
--

CREATE TABLE `tcartapresentacion` (
  `codiCartaPresen` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiTipoCartaPresen` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreCartaPresentacion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `conteCartaPresen` text COLLATE utf8_spanish2_ci,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcliente`
--

CREATE TABLE `tcliente` (
  `codiClien` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiTipoCliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiClienJuri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiClienNatu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcliente`
--

INSERT INTO `tcliente` (`codiClien`, `codiTipoCliente`, `codiClienJuri`, `codiClienNatu`, `codiCola`, `estado`, `fecha`) VALUES
('1', 'TC_3_5_201869111138534101227', '001', 'CN_10_5_201811410352112136879', '45068903', 1, '2018-05-22 00:00:53'),
('2', 'tc002', 'CJ_3_5_201854121231186713109', '001', '45068903', 1, '2018-05-21 23:19:39'),
('3', 'TC_3_5_201869111138534101227', '001', 'CN_21_5_201879121361841035211', '45068903', 1, '2018-05-22 00:00:33'),
('C_14_6_201811734281210195613', 'TC_3_5_201869111138534101227', '001', 'CN_14_6_201879128104311513621', '45068903', 1, '2018-06-14 23:09:34'),
('C_4_7_201857121363111109428', 'TC_3_5_201869111138534101227', '001', 'CN_4_7_201827610129313451118', '70343190', 1, '2018-07-04 14:57:08'),
('C_4_7_201894123615781011213', 'TC_3_5_201869111138534101227', '001', 'CN_4_7_201861181235213410719', '70343190', 1, '2018-07-04 15:08:10'),
('C_6_7_201812349281511710613', 'TC_3_5_201869111138534101227', '001', 'CN_6_7_201892361213111485710', '46788344', 1, '2018-07-06 21:51:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tclientejuridico`
--

CREATE TABLE `tclientejuridico` (
  `codiClienJuri` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `razonSocialClienJ` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rucClienJuri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direcClienJuri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiTipoCliJur` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `webClienJuri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaRegisClienJ` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tclientejuridico`
--

INSERT INTO `tclientejuridico` (`codiClienJuri`, `razonSocialClienJ`, `rucClienJuri`, `direcClienJuri`, `codiDistri`, `codiProvin`, `codiDepar`, `codiTipoCliJur`, `webClienJuri`, `estado`, `fechaRegisClienJ`) VALUES
('001', 'null', 'null', 'null', 'null', 'null', 'null', 'ctj002', 'null', 0, '2018-05-21 22:50:43'),
('CJ_14_6_201831121134610579812', 'ABC', '32165498721', 'Jr. Parra del riego 120', '', '', '', NULL, 'www.abc.com', 1, '2018-06-14 21:27:32'),
('CJ_3_5_201854121231186713109', 'EMPRESA 003', '59575361578', 'Jr. Amazonas 587', 'Huancayo', 'Huancayo', 'Junín', 'ctj002', 'www.empresa003.org', 1, '2018-05-03 20:53:11'),
('cj001', 'EMPRESA 001', '12345678912', 'Jr. Parra del riego 485', 'El Tambo', 'Huancayo', 'Junín', 'ctj002', 'www.empresa001.com', 1, '2018-04-28 15:23:51'),
('cj002', 'EMPRESA 002', '98765432155', 'Av. San Carlos 963', 'Huancayo', 'Huancayo', 'Junín', 'ctj002', 'www.empresa002.net', 1, '2018-04-28 16:59:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tclientenatural`
--

CREATE TABLE `tclientenatural` (
  `codiClienNatu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `apePaterClienN` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apeMaterClienN` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreClienNatu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dniClienNatu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direcClienNatu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaNaciClienN` date DEFAULT NULL,
  `correoClienNatu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tele01ClienNatu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tele02ClienNatu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaRegisClien` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tclientenatural`
--

INSERT INTO `tclientenatural` (`codiClienNatu`, `apePaterClienN`, `apeMaterClienN`, `nombreClienNatu`, `dniClienNatu`, `direcClienNatu`, `codiDistri`, `codiProvin`, `codiDepar`, `fechaNaciClienN`, `correoClienNatu`, `tele01ClienNatu`, `tele02ClienNatu`, `fechaRegisClien`, `estado`) VALUES
('001', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', '0000-00-00', 'null', 'null', 'null', '0000-00-00 00:00:00', 0),
('CN_10_5_201811410352112136879', 'Barja', 'Romero', 'Helen Jossety', '78451296', 'Jr. Concepción 584', 'Concepción ', 'Concepción ', 'Junín', '1996-05-10', 'hbarja@gmail.com', '987525263', '987516232', '2018-05-10 21:54:01', 1),
('CN_14_6_201811106133547219128', 'Torres', 'Barja', 'Ingrid', '56221541', 'Parra del riego 158', 'El tambo', 'Huancayo', 'Junín', '1994-07-20', 'ingrid@gmail.com', '987635241', '987456985', '2018-06-14 18:03:38', 1),
('CN_14_6_201851211469102131783', 'Aguilar', 'Cunyar', 'Ammy', '87542162', 'Las nubes 584', 'El Tambo', 'Huancayo', 'Junin', '1994-07-18', 'ammylenka@gmail.com', '987526354', '987526545', '2018-06-14 17:45:52', 1),
('CN_14_6_201861271101395381142', 'Romero', 'Vargas', 'Kelly', '78451296', 'Chupaca 154', 'Chupaca', 'Chupaca', 'Junin', '1998-05-12', 'kelly@chupaca.com', '987542163', '978451263', '2018-06-14 21:37:49', 1),
('CN_14_6_201879128104311513621', 'Rendich', 'Cunyar', 'Grover', '45068903', 'Jr. Ayacucho 122', 'Huancayo', 'Huancayo', 'Junin', '1986-03-02', 'grendich@perudataconsult.net', '987451263', '964524163', '2018-06-14 23:09:34', 1),
('CN_21_5_201879121361841035211', 'Ochoa', 'Romero', 'Erlin', '20065895', 'Chupaca', 'Chupaca', 'Chupaca', 'Chupaca', '1978-05-08', 'eochoa@perudataconsult.net', '948551122', '064879887', '2018-05-21 23:59:15', 1),
('CN_4_7_201827610129313451118', 'Huaynates', 'Ildefonso', 'Walter Jesus', '20088857', 'Av Centenario 382', 'Huancayo', 'Huancayo', 'Junin', '1976-10-08', 'walter.huaynates@perudataconsult.net', '964817996', '064227400', '2018-07-04 14:57:08', 1),
('CN_4_7_201861181235213410719', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '2018-07-04 15:08:10', 1),
('CN_6_7_201892361213111485710', 'Chamorro', 'Osorio', 'Diego', '78451269', 'El tambo', 'Huancayo', 'Huancayo', 'Junin', '1986-05-03', 'dchamorro@gmail.com', '964784512', '064875421', '2018-07-06 21:51:53', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcolaborador`
--

CREATE TABLE `tcolaborador` (
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `apePaterCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apeMaterCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dniCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaNaciCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correoCorpoCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correoPersoCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celuCorpoCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celuPersoCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direcCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fotoCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaRegisCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `contraCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcolaborador`
--

INSERT INTO `tcolaborador` (`codiCola`, `apePaterCola`, `apeMaterCola`, `nombreCola`, `dniCola`, `fechaNaciCola`, `correoCorpoCola`, `correoPersoCola`, `celuCorpoCola`, `celuPersoCola`, `codiDepar`, `codiProvin`, `codiDistri`, `direcCola`, `fotoCola`, `fechaRegisCola`, `contraCola`, `estado`) VALUES
('20073303', 'Gonzales', 'Franco', 'Beatriz Carolina', '20073303', '30/10/75', 'gerencia@perudataconsult.net', 'NULL', '0', '954021108', '1', '1', '1', 'Av. Leoncio Prado N° 1368 - Pilcomayo', 'default-user.png', '30/01/17 18:29', '20073303', 0),
('20074461', 'Merlo', 'Gutiérrez', 'Enrique Martín', '20074461', '01/01/00', 'emerlo@perudataconsult.net', 'enrique.merlo@hotmail.com', '960963210', '960963210', '1', '1', '1', 'Jr. Grau N° 1285 - El Tambo - Huancayo', 'img02-Enrique.png', '04/01/17 12:21', '20074461', 0),
('20088857', 'Huaynates', 'Ildefonso', 'Walter Jesús', '20088857', '08/10/76', 'walter.huaynates@perudataconsult.net', 'NULL', '0', '964817996', '1', '1', '1', 'Av. Leoncio Prado N° 1368 - Pilcomayo', 'walter.png', '30/01/17 18:06', '20088857', 0),
('20091413', 'Ochoa', 'Aliaga', 'Erlin', '20091413', '05/11/76', 'eochoa@perudataconsult.net', 'NULL', '0', '964439440', '1', '1', '1', 'Jr. Francisco Bolognesi S/N Barrio Vista Aleg', 'default-user.png', '04/01/17 11:34', '20091413', 0),
('21298486', 'Chavez', 'Yauri', 'Horler Job', '21298486', '29/03/72', '0', 'NULL', '0', '989738972', '1', '1', '1', 'Av. Circunvalación N° 587 El Tambo - Huancayo', 'default-user.png', '04/01/17 12:51', '21298486', 1),
('40573020', 'Huaynates', 'Ildefonso', 'Annie Consuelo', '40573020', '25/10/79', 'annie.huaynates@perudataconsult.net', 'NULL', '0', '964969478', '1', '1', '1', 'Prolong. Atalaya Mz “B” Lote 16 – El Tambo -', 'img01-EjeCuentas_Annie.png', '05/01/17 12:07', '40573020', 0),
('42456895', 'Huaynates', 'Ildefonso', 'Paolo', '42456895', '18/08/83', 'paolo.huaynates@perudataconsult.net', 'phuaynatesi@gmail.com', '0', '983968070', '1', '1', '1', 'Asent. H. Santa Anita Mz. B Lt. 22 Lima - Lim', 'img06-paolo.png', '01/02/17 12:02', '42456895', 1),
('42754461', 'Espinal', 'Tufino', 'Christ Dennys', '42754461', '28/10/84', 'cespinal@perudataconsult.net', 'NULL', '22', '995647439', '1', '1', '1', 'Av. Mariátegui Mz. K Lt. 16 El Tambo - Huanca', 'default-user.png', '04/01/17 11:46', '42754461', 0),
('42958077', 'Córdova', 'Hinostroza', 'Denysse Mireya', '42958077', '19/03/84', 'administracion@perudataconsult.net', 'NULL', '0', '950507794', '1', '1', '1', 'Jr. El Tambo', 'default-user.png', '03/01/17 18:11', '42958077', 0),
('44168804', 'Huaynates', 'Ildefonso', 'Pedro Enrique', '44168804', '02/08/86', 'pedro.huaynates@perudataconsult.net', 'NULL', '0', '998893350', '1', '1', '1', 'Jr. Jose Manuel Ugarteche 652 - PUEBLO LIBRE', 'default-user.png', '06/05/17 10:39', '44168804', 1),
('44264832', 'Melo', 'Ramírez', 'Jordan Fernando', '44264832', '08/04/87', 'almacen@perudataconsult.net', 'almacen@perudataconsult.net', '939746136', '939746136', 'D12', 'P104', 'DI1020', 'Prolg. Piura N°851 Huancayo - Huancayo - Juní', 'default-user.png', '15/03/18', '44264832', 1),
('45068903', 'Rendich', 'Cunyar', 'George Grover', '45068903', '02/03/86', 'grendich@perudataconsult.net', 'george.rendich@gmail.com', '944556688', '944560230', '1', '1', '1', 'Ayacucho 122', 'Grover.png', '20/02/18', '45068903', 0),
('45087781', 'Vila', 'Lagos', 'Lucía Antonia', '45087781', '25/05/88', 'lucia.vila@perudataconsult.net', 'NULL', '0', '998890321', '1', '1', '1', 'Av. Taylor N°1369, Huancayo – Huancayo - Juní', 'img04-lucia.png', '04/01/17 12:15', '45087781', 0),
('45486297', 'Moya', 'Chavez', 'Angiolo Eduardo', '45486297', '15/08/88', 'amoya@perudataconsullt.net', 'NULL', '0', '954405507', '1', '1', '1', 'Pje. Los Alamos N°123', 'default-user.png', '26/04/17 19:45', '45486297', 0),
('46063490', 'Quiñones', 'Huacho', 'Ketty Evelin', '46063490', '12/03/89', 'ventas02@perudataconsul.net', 'evi_4007@hotmail.com', '9926686953', '992065019', 'D12', 'P104', 'DI1029', 'PSJE LOS GIRASOLES 368 EL TAMBO HUANCAYO', 'Ketty.png', '19/03/18', '34904606', 1),
('46788344', 'Vera', 'Abad', 'Ingrid Noelia', '46788344', '22/12/90', 'ventas04@perudataconsult.net', 'NULL', '0', '922285258', '1', '1', '1', 'Jr. Sucre Nº 257- La Florida- El Tambo- Huanc', 'Ingrid.png', '06/02/17 18:19', '46788344', 1),
('46959026', 'Velapatiño', 'Romero', 'Luis Eduardo', '46959026', '05/02/91', 'contabilidad@perudataconsult.net', 'eduluis1991@gmail.com', '0', '990335941', '1', '1', '1', 'Jr. Húsares de Junín N° 502 Huancayo – Huanca', 'Eduardo.png', '05/01/17 12:20', '46959026', 1),
('46972836', 'Torres', 'López', 'Abel Edu', '46972836', '10/05/92', 'soporte01@perudataconsult.net', 'systorres@gmail.com', '947241345', '947241345', 'D12', 'P104', 'DI1024', 'Jr. La Mar 278 Chilca', 'Abel.png', '13/03/18', '46972836', 1),
('47370632', 'Oré', 'Loayza', 'Ameth Franco', '47370632', '04/11/89', 'compras@perudataconsult.net', 'NULL', '0', '950508205', '1', '1', '1', 'Jr. Unión N° 516 – Urb. Goyzueta – Huancayo -', 'default-user.png', '03/01/17 18:08', '47370632', 1),
('47988281', 'Huaynates', 'Ildefonso', 'Miguel Ángel', '47988281', '30/03/92', 'miguel.huaynates@perudataconsult.net', 'NULL', '0', '950508265', '1', '1', '1', 'Av. Guindales N° 189 - Huancayo', 'img05-miguelHuaynates.png', '03/01/17 18:14', '47988281', 1),
('48049883', 'Berrocal', 'Jumpa', 'Angel', '48049883', 'NULL', 'aberrocal@perudataconsult.net', 'angel.berrocal.jumpa@outlook.com', 'NULL', '962821719 ', '1', '1', '1', 'NULL', 'default-user.png', '2018-04-09', '48049883', 1),
('61596972', 'Barja', 'Espinoza', 'Helen Jossety', '61596972', '13/05/97', 'soporte02@perudataconsult.net', 'NULL', '0', '938664692', '1', '1', '1', 'Jr. Bolívar  #1035 Concepción', 'Helen.png', '05/01/17 12:26', '61596972', 1),
('70343190', 'Sanchez', 'Huaman', 'Kelly Karina', '70343190', '12/05/95', 'ventas01@perudataconsult.net', 'kelly.sanchez.125@gmail.com', '998890322', '988738024', 'D12', 'P112', 'DI1139', 'AV LOS HEROES S/N DISTRITO DE HUAMANCACA CHIC', 'Kelly.png', '19/03/18', '70343190', 1),
('72459709', 'Murga', 'Medina', 'Shirley Katterine', '72459709', '04/12/92', 'ventas03@perudataconsult.net', 'NULL', '0', '964101451', '1', '1', '1', 'Jr. Piura 156 Huancayo – Huancayo- Junín', 'Shirley.png', '05/01/17 11:52', '72459709', 1),
('72709740', 'Solís', 'Anchiraico', 'Ricardo Xavier', '72709740', '14/12/91', 'ventas01@perudataconsult.net', 'NULL', '0', '934650735', '1', '1', '1', 'Av. Los Andes 1081 - El Tambo- Huancayo - Jun', 'img07-Ricardo.png', '04/01/17 12:21', '72709740', 1),
('72773059', 'Aguilar', 'Cunyar', 'Ammy Jholenka', '72773059', '19/07/94', 'publicidad@perudataconsult.net', 'ammycun@gmail.com', '987542121', '978653212', '1', '1', '1', 'Jr. Mariscal Caceres 120', 'Ammy.png', '04/01/17 12:21', '72773059', 1),
('75175456', 'Molina', 'Ponce', 'Yolanda Evelin', '75175456', '14/03/96', 'cobranzas@perudataconsult.ne', 'ponce14evelin@gmail.com', '982292795', '982292795', 'D12', 'P104', 'DI1029', 'Jr. amazonita #105 - El Tambo', 'default-user.png', '13/03/18', '75175456', 1),
('76519030', 'Cerbera', 'Vives', 'Augusto Daniel', '76519030', 'NULL', 'augusto.cerbera@perudataconsult.net', 'augustocerbera@gmail.com', '934896249', '934896249', '1', '1', '1', 'NULL', 'default-user.png', '04/01/17 12:21', '76519030', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcondicionescomerciales`
--

CREATE TABLE `tcondicionescomerciales` (
  `codiCondiComer` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripCondiComer` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `defecCondiComer` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcondicionescomerciales`
--

INSERT INTO `tcondicionescomerciales` (`codiCondiComer`, `descripCondiComer`, `defecCondiComer`, `estado`) VALUES
('CC_10_5_201851611281013124739', 'Precio incluye IGV.', 'Si', 1),
('CC_10_5_201868413121110513972', 'Precio en moneda nacional (soles).', 'Si', 1),
('CC_3_7_201812111586391321047', 'Entrega en almacenes de la institución.', 'Si', 1),
('CC_3_7_201813116245121038179', 'Precio especial valido por 07 dias calendarios y/o hasta agotar stock.', 'Si', 1),
('CC_3_7_201834218956711101213', 'Plazo de entrega: 35 días de recibida orden de compra (producto a importación).', 'Si', 1),
('CC_3_7_201882935674121011113', 'Garantía de fabricante: 36 meses en mano de obra y repuestos a domicilio.', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcontactocliente`
--

CREATE TABLE `tcontactocliente` (
  `codiContacClien` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `apePaterContacC` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apeMaterContacC` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correoContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direcContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celu01ContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celu02ContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `teleContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `aneContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaRegisContacClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiClienJuri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcontactocliente`
--

INSERT INTO `tcontactocliente` (`codiContacClien`, `apePaterContacC`, `apeMaterContacC`, `nombreContacClien`, `correoContacClien`, `direcContacClien`, `codiDistri`, `codiProvin`, `codiDepar`, `celu01ContacClien`, `celu02ContacClien`, `teleContacClien`, `aneContacClien`, `fechaRegisContacClien`, `codiClienJuri`, `codiCola`, `estado`) VALUES
('CC_14_6_201845612133117281109', 'Perez', 'Flores', 'Juan', 'juan@flores.com', 'asd', 'asd', 'asd', 'asd', '987653252', '978451263', '064879856', '45', '2018-06-14 18:57:06', 'CJ_14_6_201831121134610579812', '45068903', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcontrato`
--

CREATE TABLE `tcontrato` (
  `codiContrato` int(11) NOT NULL,
  `codiArea` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCargo` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiEmpre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiTipoContra` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaContra` int(11) DEFAULT NULL,
  `fechaIniContra` date DEFAULT NULL,
  `fechaFinaContra` date DEFAULT NULL,
  `fechaFinaExpoContra` date DEFAULT NULL,
  `motiFinaContra` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcosteo`
--

CREATE TABLE `tcosteo` (
  `codiCosteo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaIniCosteo` date DEFAULT NULL,
  `fechaFinCosteo` date DEFAULT NULL,
  `costoTotalDolares` double DEFAULT NULL,
  `costoTotalSoles` double DEFAULT NULL,
  `totalVentaSoles` double DEFAULT NULL,
  `utilidadVentaSoles` double DEFAULT NULL,
  `margenCosto` double DEFAULT NULL,
  `margenVenta` double DEFAULT NULL,
  `codiCosteoEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiIgv` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDolar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcosteo`
--

INSERT INTO `tcosteo` (`codiCosteo`, `fechaIniCosteo`, `fechaFinCosteo`, `costoTotalDolares`, `costoTotalSoles`, `totalVentaSoles`, `utilidadVentaSoles`, `margenCosto`, `margenVenta`, `codiCosteoEsta`, `codiCola`, `codiIgv`, `codiDolar`, `fechaSistema`) VALUES
('COS_1_6_201813391168125101724', '2018-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-01 16:45:45'),
('COS_1_6_201821081117129341365', '2018-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-01 16:07:23'),
('COS_1_6_201891161218137103245', '2018-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-01 16:08:55'),
('COS_12_6_201810183975131161224', '2018-06-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:29:06'),
('COS_12_6_201812236971105481311', '2018-06-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-12 23:05:02'),
('COS_12_6_201812941571028611133', '2018-06-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:27:56'),
('COS_12_6_201813118110721236549', '2018-06-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:14:29'),
('COS_12_6_201851191261013832471', '2018-06-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-12 23:04:03'),
('COS_12_6_201857416111213981023', '2018-06-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:02:13'),
('COS_12_6_201884161232135791110', '2018-06-12', NULL, 1200, 4038, 4038, 0.3, 0.01, 0.03, 'CE_10_5_201891310112387125416', '45068903', 'IGV_5_5_201812513910413826117', 'D_7_5_201826481910111213573', '2018-06-13 16:05:27'),
('COS_14_6_201825416912101138137', '2018-06-14', NULL, 32, 106, 106, 17, 0.1, 0.3, 'CE_10_5_201891310112387125416', '46788344', 'IGV_5_5_201812513910413826117', 'D_7_5_201826481910111213573', '2018-07-04 01:09:18'),
('COS_18_5_201831151221104813769', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_19_5_201894728101631213511', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_20_6_201811354610279812131', '2018-06-20', NULL, 90, 297, 297, 56, 0.01, 0.03, 'CE_10_5_201891310112387125416', '46788344', 'IGV_5_5_201812513910413826117', 'D_7_5_201826481910111213573', '2018-06-20 20:54:42'),
('COS_20_6_201884791121513123610', '2018-06-20', NULL, 19060, 62898, 62898, 0.3, 0.0135, 0.03, 'CE_10_5_201891310112387125416', '46788344', 'IGV_5_5_201812513910413826117', 'D_7_5_201826481910111213573', '2018-06-29 00:20:35'),
('COS_22_5_201841013951232671118', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_22_5_201891334121158106712', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_23_5_201812131117648593210', '2018-05-25', NULL, 1200, 3800, 3800, 0.3, 0.01, 0.03, 'CE_10_5_201810118246512711339', '45068903', 'IGV_5_5_201812513910413826117', 'D_7_5_201826481910111213573', '2018-06-12 23:03:20'),
('COS_23_5_201823513121119761048', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_23_5_201853610122119134187', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_23_5_201873482129116110513', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201810111384396275112', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201810367121158134129', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201810911528713121364', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201812135109628111374', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 01:33:05'),
('COS_25_5_201812394213518116107', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:44:19'),
('COS_25_5_201812710951186341213', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201813129113210875461', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:00:09'),
('COS_25_5_201813629811012451137', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201823112611910758413', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201827341105986131112', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201832658101311141297', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201832749128113510611', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201839810651241321711', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:53:07'),
('COS_25_5_201859123104111613728', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201861574112310891213', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201864811013539712211', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201871231192641013518', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:45:09'),
('COS_25_5_201874958211101261313', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:02:16'),
('COS_25_5_201875416982121113310', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:54:50'),
('COS_25_5_201881256937111012413', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201887391131256104112', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201891264821171051313', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_25_5_201895761281411210133', '2018-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:59:02'),
('COS_28_5_201811936128451131072', '2018-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 15:08:33'),
('COS_28_5_201889531312761110124', '2018-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 16:45:51'),
('COS_28_5_201896101382345117112', '2018-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 16:23:07'),
('COS_30_5_201810187139125114632', '2018-05-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 16:42:49'),
('COS_30_5_201811310429635711128', '2018-05-30', NULL, 2890, 6600, 6600, 0.05, 0.01, 0.3, 'CE_10_5_201810118246512711339', '45068903', 'IGV_5_5_201812513910413826117', 'D_7_5_201826481910111213573', '2018-06-12 17:47:44'),
('COS_30_5_201861213941181210537', '2018-05-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 22:56:51'),
('COS_30_5_201891161710321358412', '2018-05-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 22:43:13'),
('COS_30_5_201891361085413127211', '2018-05-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 22:32:43'),
('COS_4_7_201813611129832104751', '2018-07-04', NULL, 0, 0, 0, 0, 0, 0, 'CE_10_5_201891310112387125416', '70343190', 'IGV_5_5_201812513910413826117', 'D_7_5_201826481910111213573', '2018-07-04 15:44:43'),
('COS_4_7_201813618251210931147', '2018-07-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-04 15:44:46'),
('COS_4_7_201859281371110461213', '2018-07-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-04 14:41:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcosteoestado`
--

CREATE TABLE `tcosteoestado` (
  `codiCosteoEsta` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreCosteoEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveCosteoEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ordenCosteoEsta` int(11) DEFAULT NULL,
  `estaCosteoEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcosteoestado`
--

INSERT INTO `tcosteoestado` (`codiCosteoEsta`, `nombreCosteoEsta`, `nombreBreveCosteoEsta`, `ordenCosteoEsta`, `estaCosteoEsta`) VALUES
('CE_10_5_201810118246512711339', 'Activo', 'Activo', 1, '1'),
('CE_10_5_201810132485971113126', 'Anulado', 'Anulado', 2, '1'),
('CE_10_5_201891310112387125416', 'En construcción', 'En construcción', 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcosteoitem`
--

CREATE TABLE `tcosteoitem` (
  `idCosteoItem` int(11) NOT NULL,
  `codiCosteo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idTPrecioProductoProveedor` int(11) DEFAULT NULL,
  `itemCosteo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descCosteoItem` text COLLATE utf8_spanish2_ci,
  `fechaCosteoIni` date DEFAULT NULL,
  `cantiCoti` int(11) DEFAULT NULL,
  `precioProducDolar` double DEFAULT NULL,
  `costoUniIgv` double DEFAULT NULL,
  `costoTotalIgv` double DEFAULT NULL,
  `costoUniSolesIgv` double DEFAULT NULL,
  `costoTotalSolesIgv` double DEFAULT NULL,
  `margenCoti` double DEFAULT NULL,
  `utiCoti` double DEFAULT NULL,
  `margenVentaCoti` double DEFAULT NULL,
  `fechaCosteoActu` date DEFAULT NULL,
  `numPack` int(11) DEFAULT NULL,
  `codiProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcosteoitem`
--

INSERT INTO `tcosteoitem` (`idCosteoItem`, `codiCosteo`, `idTPrecioProductoProveedor`, `itemCosteo`, `descCosteoItem`, `fechaCosteoIni`, `cantiCoti`, `precioProducDolar`, `costoUniIgv`, `costoTotalIgv`, `costoUniSolesIgv`, `costoTotalSolesIgv`, `margenCoti`, `utiCoti`, `margenVentaCoti`, `fechaCosteoActu`, `numPack`, `codiProveeContac`, `estado`, `fechaSistema`) VALUES
(9, 'COS_18_5_201831151221104813769', 1, 'Some product', NULL, '2018-05-19', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-19', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(10, 'COS_19_5_201894728101631213511', 1, 'Some product', NULL, '2018-05-19', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-19', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(11, 'COS_22_5_201891334121158106712', 1, 'Some product', NULL, '2018-05-22', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-22', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(12, 'COS_22_5_201841013951232671118', 1, 'Some product', NULL, '2018-05-22', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-22', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(13, 'COS_23_5_201812131117648593210', 1, 'Z1 All In One', NULL, '2018-06-12', 1, 1000, 1200, 1200, 3800, 3800, 0.01, 0.3, 0.03, '2018-06-12', 1, 'pc001', 1, '2018-06-12 23:03:20'),
(14, 'COS_23_5_201873482129116110513', 1, 'Some product', NULL, '2018-05-23', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-23', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(15, 'COS_23_5_201823513121119761048', 2, 'Some product', NULL, '2018-05-23', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-23', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(16, 'COS_23_5_201853610122119134187', 2, 'Some product', NULL, '2018-05-23', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-23', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(17, 'COS_25_5_201810367121158134129', 2, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(18, 'COS_25_5_201813629811012451137', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(19, 'COS_25_5_201810111384396275112', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(20, 'COS_25_5_201832658101311141297', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(21, 'COS_25_5_201832749128113510611', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(22, 'COS_25_5_201823112611910758413', 2, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(23, 'COS_25_5_201861574112310891213', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(24, 'COS_25_5_201812710951186341213', 2, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(25, 'COS_25_5_201864811013539712211', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(26, 'COS_25_5_201810911528713121364', 2, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(27, 'COS_25_5_201881256937111012413', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(28, 'COS_25_5_201827341105986131112', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(29, 'COS_25_5_201887391131256104112', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(30, 'COS_25_5_201859123104111613728', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(31, 'COS_25_5_201874958211101261313', 2, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(32, 'COS_25_5_201812394213518116107', 2, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(33, 'COS_25_5_201871231192641013518', 2, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(34, 'COS_25_5_201839810651241321711', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(35, 'COS_25_5_201875416982121113310', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(36, 'COS_25_5_201812135109628111374', 1, 'Some product', NULL, '2018-05-25', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-25', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(37, 'COS_28_5_201811936128451131072', 1, 'Some product', NULL, '2018-05-28', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-28', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(38, 'COS_28_5_201896101382345117112', 2, 'Some product', NULL, '2018-05-28', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-28', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(39, 'COS_28_5_201889531312761110124', 1, 'Some product', NULL, '2018-05-28', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-28', 1, 'pc001', 1, '2018-05-29 16:02:23'),
(40, 'COS_30_5_201810187139125114632', 1, 'Some product', NULL, '2018-05-30', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-30', 1, 'pc001', 1, '2018-05-30 16:42:49'),
(41, 'COS_30_5_201891361085413127211', 1, 'Some product', NULL, '2018-05-30', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-30', 1, 'pc001', 1, '2018-05-30 22:32:43'),
(42, 'COS_30_5_201891161710321358412', 1, 'Some product', NULL, '2018-05-30', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-30', 1, 'pc001', 1, '2018-05-30 22:43:13'),
(43, 'COS_30_5_201861213941181210537', 1, 'Some product', NULL, '2018-05-30', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-05-30', 1, 'pc001', 1, '2018-05-30 22:56:51'),
(44, 'COS_30_5_201811310429635711128', 1, 'Z1 All In One', 'Factor de forma 2U Controlador de almacenamiento (1) Smart Array P440ar / FBWC de 2 GB Incluido Capacidad: - SATA Interno de 240 GB de capacidad bruta, unidad SATA internas para el SO preinstalado incluidas. - HPE 64TB (8X8TB) SAS LFF SC HDD Bndl instalados. - Soporte hasta 120 TB de capacidad máxima para unidades internas de datos compatibles. - Windows@ Storage Server 2016 instalado Dimensiones mínimas (anch. x prof .x alt.) 44,55 x 73,02 x 8,73 cm (sin bisel)Peso 23,6 kg máximo (sin unidades traseras)GARANTIA PREDICTIVA U8KG7E HPE 3 Year Proactive Care 24x7 StoreEasy 1650/1850 Service', '2018-06-12', 2, 2600, 2890, 2890, 7449, 6600, 0.01, 0.05, 0.3, '2018-06-12', 1, 'pc002', 1, '2018-06-12 15:38:01'),
(45, 'COS_1_6_201821081117129341365', 1, 'Some product', NULL, '2018-06-01', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-01', 1, 'pc001', 1, '2018-06-01 16:07:23'),
(46, 'COS_1_6_201891161218137103245', 1, 'Some product', NULL, '2018-06-01', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-01', 1, 'pc001', 1, '2018-06-01 16:08:55'),
(47, 'COS_1_6_201813391168125101724', 1, 'Some product', NULL, '2018-06-01', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-01', 1, 'pc001', 1, '2018-06-01 16:45:45'),
(48, 'COS_12_6_201851191261013832471', 1, 'Some product', NULL, '2018-06-12', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-12', 1, 'pc001', 1, '2018-06-12 23:04:03'),
(49, 'COS_12_6_201812236971105481311', 1, 'Some product', NULL, '2018-06-12', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-12', 1, 'pc001', 1, '2018-06-12 23:05:02'),
(50, 'COS_12_6_201857416111213981023', 1, 'Some product', NULL, '2018-06-12', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-12', 1, 'pc001', 1, '2018-06-13 00:02:13'),
(51, 'COS_12_6_201813118110721236549', 1, 'Some product', NULL, '2018-06-12', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-12', 1, 'pc001', 1, '2018-06-13 00:14:29'),
(52, 'COS_12_6_201812941571028611133', 1, 'Some product', NULL, '2018-06-12', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-12', 1, 'pc001', 1, '2018-06-13 00:27:56'),
(53, 'COS_12_6_201810183975131161224', 1, 'Some product', NULL, '2018-06-12', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-06-12', 1, 'pc001', 1, '2018-06-13 00:29:06'),
(54, 'COS_12_6_201884161232135791110', 2, 'All in one touch 23\' Lenovo', '<p><strong>Caracter&iacute;sticas</strong></p>\r\n<p style=\"padding-left: 30px;\">Procesador core i7 7600 14nm</p>\r\n<p style=\"padding-left: 30px;\">Ram 8gb ddr 5</p>\r\n<p style=\"padding-left: 30px;\">Video 2gb 2.6 ghz</p>', '2018-06-13', 1, 1001, 1200, 1200, 3920, 4038, 0.01, 0.3, 0.03, '2018-06-13', 1, 'pc001', 1, '2018-06-13 16:05:27'),
(55, 'COS_14_6_201825416912101138137', 2, '', '<p style=\"box-sizing: inherit; margin: 0px; font-family: Lato, sans-serif; font-weight: 400; font-size: 1.4rem; line-height: 2.1rem; text-align: left; color: #333333; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"font-size: 10pt;\">Imprima en casa a un costo accesible con los cartuchos de tinta m&aacute;s econ&oacute;micos de HP. Esta impresora, dise&ntilde;ada para espacios y presupuestos limitados, es simple de instalar y comenzar a usar en un instante. Tambi&eacute;n ahorrar&aacute; energ&iacute;a con una impresora certificada por ENERGY STAR.</span></p>\r\n<h3 style=\"box-sizing: inherit; margin: 0px 0px 1.5em; font-family: Lato, sans-serif; font-weight: bold; font-size: 1.6rem; line-height: 2.4rem;\"><span style=\"font-size: 10pt;\">CARACTER&Iacute;STICAS DEL PRODUCTO</span></h3>\r\n<h3 style=\"box-sizing: inherit; margin: 0px 0px 1.5em; font-family: Lato, sans-serif; font-weight: bold; font-size: 1.6rem; line-height: 2.4rem;\"><span style=\"font-size: 10pt;\">Marca: HP</span></h3>\r\n<ul style=\"box-sizing: inherit; font-family: Lato, sans-serif; font-weight: 400; font-size: 1.4rem; line-height: 2.1rem; margin: 0px; padding: 0px; color: #333333; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">\r\n<ul style=\"box-sizing: inherit; font-family: Lato, sans-serif; font-weight: 400; font-size: 1.4rem; line-height: 2.1rem; margin: 0px; padding: 0px; color: #333333; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Modelo: Advantage 1115</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Velocidad de impresi&oacute;n: Negro (ISO): Hasta 7,5 ppm / Color (ISO): Hasta 5,5 ppm</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Resoluci&oacute;n de impresi&oacute;n: Negro (&oacute;ptima): Hasta 1.200 x 1.200 ppp</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Tecnolog&iacute;a de impresi&oacute;n: Inyecci&oacute;n t&eacute;rmica de tinta HP</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Cantidad de cartuchos de impresi&oacute;n: 2</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Conectividad est&aacute;ndar USB 2.0</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Ciclo de trabajo mensual A4: hasta 1000 p&aacute;g. (es un aproximado, la cifra puede variar)</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Volumen de p&aacute;ginas mensuales recomendado: 50 a 200</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Tipos de papel admitidos: Papel com&uacute;n, papel fotogr&aacute;fico, papel para folletos</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Bandeja entrada 60 hojas</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Bandeja salida de 25 hojas</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Conformidad de eficiencia de energ&iacute;a: certificaci&oacute;n Energy Star</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Peso: 2 kg</span></li>\r\n</ul>\r\n</ul>\r\n<h3 style=\"box-sizing: inherit; margin: 0px 0px 1.5em; font-family: Lato, sans-serif; font-weight: bold; font-size: 1.6rem; line-height: 2.4rem;\"><span style=\"font-size: 10pt;\">DIMENSIONES</span></h3>\r\n<ul style=\"box-sizing: inherit; font-family: Lato, sans-serif; font-weight: 400; font-size: 1.4rem; line-height: 2.1rem; margin: 0px; padding: 0px; color: #333333; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">\r\n<ul style=\"box-sizing: inherit; font-family: Lato, sans-serif; font-weight: 400; font-size: 1.4rem; line-height: 2.1rem; margin: 0px; padding: 0px; color: #333333; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Alto: 12,4 cm</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Ancho: 42,5 cm</span></li>\r\n<li style=\"box-sizing: inherit; margin-bottom: 0.25em; display: block; list-style: none; margin-top: 0px; padding-left: 20px; position: relative;\"><span style=\"font-size: 10pt;\">Profundidad: 21,5 cm</span></li>\r\n</ul>\r\n</ul>', '2018-07-03', 1, 27, 32, 32, 106, 106, 0.1, 17, 0.3, '2018-07-03', 1, 'pc001', 1, '2018-07-04 01:09:18'),
(56, 'COS_20_6_201811354610279812131', 2, 'Thermaltake VIEW 27', '<p><span style=\"box-sizing: inherit; color: rgba(0, 0, 0, 0.87); font-family: Roboto, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">C&oacute;digo interno:&nbsp;<span style=\"box-sizing: inherit; color: #ff5d2b;\">100709</span></span></p>\r\n<div class=\"li-style\" style=\"box-sizing: inherit; color: rgba(0, 0, 0, 0.87); font-family: Roboto, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">\r\n<p style=\"box-sizing: inherit;\">El panel con ventana alargada posee un dise&ntilde;o envolvente que permite a la View 27 dar un paso m&aacute;s all&aacute;, y permitir a los usuarios hacer gala de su dedicaci&oacute;n, as&iacute; como de sus habilidades como ninguna otra torre lo ha permitido en el mercado.</p>\r\n</div>', '2018-06-25', 1, 73, 90, 90, 297, 297, 0.01, 56, 0.03, '2018-06-25', 1, 'pc001', 1, '2018-06-25 16:07:09'),
(57, 'COS_20_6_201884791121513123610', 2, '', '<p><strong><span style=\"font-size: 10pt;\">Factor de forma 2U</span></strong></p>\r\n<p><span style=\"font-size: 10pt;\">Controlador de almacenamiento (1) Smart Array P440ar/FBWC de <strong>2 GB</strong> Incluido</span></p>\r\n<p><span style=\"font-size: 10pt;\">Capacidad:</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;- SATA interno de <strong>240 GB</strong> de capacidad bruta, unidad SATA internas para el SO preinstalado incluidas.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;- HPE 64TB (8X8TB) SAS LFF SC HDD Bndl instalados.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;- Soporte hasta <strong>120 TB</strong> de capacidad m&aacute;xima para unidades internas de datos compatibles.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;- Windows@ Storage Server 2016 instalado.</span></p>\r\n<p><span style=\"font-size: 10pt;\">Dimensiones minimas (anch. x prof. x alt.) 44,55 x 73,02 x 8,73 cm (sin bisel).</span></p>\r\n<p><span style=\"font-size: 10pt;\">Peso 23,6 kg m&aacute;ximo (sin unidades traseras).</span></p>\r\n<p><span style=\"font-size: 10pt;\"><strong>GARANTIA PREDICTIVA</strong></span></p>\r\n<p><span style=\"font-size: 10pt;\">U8KG7E HPE 3 year Proactive Care 24x7 StoreEasy 1650/1850 Service</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;* M&eacute;todo de servicio: HW a domicilio.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;* Tiempo de respuesta: 4 horas de respuesta HW.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;* Opciones Elegibles: Administrador de asistencia t&eacute;cnica.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;* Duraci&oacute;n: 3 a&ntilde;os.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;* Tipo de servicio: Ciudado proactivo.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;* Cobertura de la garant&iacute;a: En garant&iacute;a.</span></p>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;* Cobertura 24 horas al d&iacute;a, 7 d&iacute;as a la semana.</span></p>', '2018-07-03', 1, 15630, 19060, 19060, 62898, 62898, 0.0135, 0.3, 0.03, '2018-07-03', 1, 'pc001', 1, '2018-07-04 01:01:42'),
(58, 'COS_4_7_201859281371110461213', 1, 'Some product', NULL, '2018-07-04', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-07-04', 1, 'pc001', 1, '2018-07-04 14:41:28'),
(59, 'COS_4_7_201813611129832104751', 1, 'Some product', NULL, '2018-07-04', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-07-04', 1, 'pc001', 1, '2018-07-04 15:08:20'),
(60, 'COS_4_7_201813618251210931147', 1, 'Some product', NULL, '2018-07-04', 1, 0, 0, 0, 0, 0, 0.01, 0.3, 0.03, '2018-07-04', 1, 'pc001', 1, '2018-07-04 15:44:46'),
(62, 'COS_20_6_201884791121513123610', 2, '', 'otra descripcion', '2018-07-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', NULL, NULL, 1, '2018-07-06 15:56:06'),
(63, 'COS_14_6_201825416912101138137', 1, 'Descripción', 'asd', '2018-07-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', 2, NULL, 1, '2018-07-07 17:12:07'),
(64, 'COS_4_7_201813611129832104751', 1, 'Descripción', '', '2018-07-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', 1, NULL, 1, '2018-07-06 23:31:29'),
(65, 'COS_4_7_201813611129832104751', 1, 'Descripción', '', '2018-07-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', 1, NULL, 1, '2018-07-06 23:31:29'),
(66, 'COS_14_6_201825416912101138137', 1, 'Descripción', 'asd', '2018-07-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', 3, NULL, 1, '2018-07-07 17:12:07'),
(67, 'COS_20_6_201811354610279812131', 1, 'Descripción', 'asd', '2018-07-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', 1, NULL, 1, '2018-07-06 23:28:38'),
(68, 'COS_12_6_201884161232135791110', 1, 'Descripción', '', '2018-07-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', 1, NULL, 1, '2018-07-07 00:39:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcoticondiciones`
--

CREATE TABLE `tcoticondiciones` (
  `idTCotiCondiciones` int(11) NOT NULL,
  `codiCondiComer` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCoti` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaSistema` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcoticosteo`
--

CREATE TABLE `tcoticosteo` (
  `idTCotiCosteo` int(11) NOT NULL,
  `codiCosteo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCoti` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcoticosteo`
--

INSERT INTO `tcoticosteo` (`idTCotiCosteo`, `codiCosteo`, `codiCoti`, `codiCola`, `estado`, `fechaSistema`) VALUES
(3, NULL, NULL, NULL, 1, '2018-05-18 23:56:53'),
(4, NULL, NULL, NULL, 1, '2018-05-18 23:59:05'),
(5, NULL, NULL, NULL, 1, '2018-05-19 00:14:32'),
(6, NULL, NULL, NULL, 1, '2018-05-19 01:12:52'),
(8, NULL, NULL, NULL, 1, '2018-05-19 18:09:31'),
(9, NULL, NULL, NULL, 1, '2018-05-23 00:52:00'),
(10, 'COS_22_5_201841013951232671118', 'COT_22_5_201837265941211101813', NULL, 1, '2018-05-23 00:55:00'),
(11, 'COS_23_5_201812131117648593210', 'COD_0256151321_123', NULL, 1, '2018-05-30 15:59:09'),
(12, 'COS_23_5_201873482129116110513', 'COT_23_5_201837629131158410121', NULL, 1, '2018-05-23 15:48:38'),
(13, 'COS_23_5_201823513121119761048', 'COT_23_5_201878210115934611312', NULL, 1, '2018-05-23 15:48:46'),
(14, 'COS_23_5_201853610122119134187', 'COT_23_5_201812511313410728196', NULL, 1, '2018-05-23 17:58:02'),
(15, 'COS_25_5_201810367121158134129', 'COT_25_5_201812106827341115913', NULL, 1, '2018-05-25 14:11:43'),
(16, 'COS_25_5_201813629811012451137', 'COT_25_5_201837119561813102124', NULL, 1, '2018-05-25 18:08:31'),
(17, 'COS_25_5_201810111384396275112', 'COT_25_5_201881125613910341127', NULL, 1, '2018-05-25 18:08:41'),
(18, 'COS_25_5_201832658101311141297', 'COT_25_5_201812109831375116214', NULL, 1, '2018-05-25 20:45:16'),
(19, 'COS_25_5_201832749128113510611', 'COT_25_5_201838261374591011211', NULL, 1, '2018-05-25 20:46:37'),
(20, 'COS_25_5_201823112611910758413', 'COT_25_5_201811057291331112468', NULL, 1, '2018-05-25 20:51:49'),
(21, 'COS_25_5_201861574112310891213', 'COT_25_5_201841711212536108139', NULL, 1, '2018-05-25 20:53:09'),
(22, 'COS_25_5_201812710951186341213', 'COT_25_5_201851031292411813176', NULL, 1, '2018-05-25 21:14:47'),
(23, 'COS_25_5_201864811013539712211', 'COT_25_5_201817611513381210924', NULL, 1, '2018-05-25 21:29:09'),
(24, 'COS_25_5_201810911528713121364', 'COT_25_5_201811710512481313962', NULL, 1, '2018-05-25 21:31:10'),
(25, 'COS_25_5_201881256937111012413', 'COT_25_5_201811161384921051237', NULL, 1, '2018-05-25 21:38:02'),
(26, 'COS_25_5_201827341105986131112', 'COT_25_5_201813112125710849361', NULL, 1, '2018-05-25 21:41:15'),
(27, 'COS_25_5_201887391131256104112', 'COT_25_5_201875311082411129613', NULL, 1, '2018-05-25 21:42:39'),
(28, 'COS_25_5_201859123104111613728', 'COT_25_5_201831228136111749105', NULL, 1, '2018-05-25 21:43:03'),
(29, 'COS_25_5_201891264821171051313', 'COT_25_5_201811122415867101393', '45068903', 1, '2018-05-25 21:45:09'),
(30, 'COS_25_5_201813129113210875461', 'COT_25_5_201811287110391345126', '45068903', 1, '2018-05-26 00:00:09'),
(31, 'COS_25_5_201874958211101261313', 'COT_25_5_201821143139187651210', '45068903', 1, '2018-05-26 00:02:16'),
(32, 'COS_25_5_201812394213518116107', 'COT_25_5_201861292138101147351', '45068903', 1, '2018-05-26 00:44:19'),
(33, 'COS_25_5_201871231192641013518', 'COT_25_5_201885631213111074912', '45068903', 1, '2018-05-26 00:45:09'),
(34, 'COS_25_5_201839810651241321711', 'COT_25_5_201865101197313241281', '45068903', 1, '2018-05-26 00:53:07'),
(35, 'COS_25_5_201875416982121113310', 'COT_25_5_201871153942810131126', '45068903', 1, '2018-05-26 00:54:50'),
(36, 'COS_25_5_201812135109628111374', 'COT_25_5_201816485131011129273', NULL, 1, '2018-05-26 01:33:05'),
(37, 'COS_28_5_201811936128451131072', 'COT_28_5_201810792151181246133', '45068903', 1, '2018-05-28 15:08:33'),
(38, 'COS_28_5_201896101382345117112', 'COT_19_5_201810641113712139582', '45068903', 1, '2018-05-30 16:01:19'),
(39, 'COS_28_5_201889531312761110124', 'COT_22_5_201811837124659131102', '45068903', 1, '2018-05-30 16:00:44'),
(40, 'COS_30_5_201810187139125114632', 'COT_30_5_201813481251792116310', '45068903', 1, '2018-05-30 16:42:49'),
(41, 'COS_30_5_201891361085413127211', 'COT_30_5_201881210231613579411', '45068903', 1, '2018-05-30 22:32:43'),
(42, 'COS_30_5_201891161710321358412', 'COT_30_5_201881339101124117265', '45068903', 1, '2018-05-30 22:43:13'),
(43, 'COS_30_5_201861213941181210537', 'COT_30_5_201829511123813610174', '45068903', 1, '2018-05-30 22:56:51'),
(44, 'COS_30_5_201811310429635711128', 'COT_30_5_201811135841327126910', '45068903', 1, '2018-05-30 23:00:25'),
(45, 'COS_1_6_201821081117129341365', 'COT_1_6_201813469212101118573', '45068903', 1, '2018-06-01 16:07:23'),
(46, 'COS_1_6_201891161218137103245', 'COT_1_6_201851224811109161337', '45068903', 1, '2018-06-01 16:08:55'),
(47, 'COS_1_6_201813391168125101724', 'COT_1_6_201812911710132536418', '45068903', 1, '2018-06-01 16:45:45'),
(48, 'COS_12_6_201851191261013832471', 'COT_12_6_201831041371126591218', '45068903', 1, '2018-06-12 23:04:03'),
(49, 'COS_12_6_201812236971105481311', 'COT_12_6_201831265911341181027', '45068903', 1, '2018-06-12 23:05:02'),
(50, 'COS_12_6_201857416111213981023', 'COT_12_6_201851110618133274912', '45068903', 1, '2018-06-13 00:02:13'),
(51, 'COS_12_6_201813118110721236549', 'COT_12_6_201872631210113841195', '45068903', 1, '2018-06-13 00:14:29'),
(52, 'COS_12_6_201812941571028611133', 'COT_12_6_201811814127361091325', '45068903', 1, '2018-06-13 00:27:56'),
(53, 'COS_12_6_201810183975131161224', 'COT_12_6_201813291267810314115', '45068903', 1, '2018-06-13 00:29:06'),
(54, 'COS_12_6_201884161232135791110', 'COT_12_6_201813910846312751211', '45068903', 1, '2018-06-13 00:45:46'),
(55, 'COS_14_6_201825416912101138137', 'COT_14_6_201892121011568113347', '45068903', 1, '2018-06-15 00:01:06'),
(56, 'COS_20_6_201811354610279812131', 'COT_20_6_201861131278510139124', '46788344', 1, '2018-06-20 15:56:01'),
(57, 'COS_20_6_201884791121513123610', 'COT_20_6_201812481191032161357', '45087781', 1, '2018-06-20 22:33:54'),
(58, 'COS_4_7_201859281371110461213', 'COT_4_7_201871041265111138392', '70343190', 1, '2018-07-04 14:41:28'),
(59, 'COS_4_7_201813611129832104751', 'COT_4_7_201861211105113429873', '70343190', 1, '2018-07-04 15:08:20'),
(60, 'COS_4_7_201813618251210931147', 'COT_4_7_201813682951211103714', '70343190', 1, '2018-07-04 15:44:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcotizacion`
--

CREATE TABLE `tcotizacion` (
  `codiCoti` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaCoti` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `asuntoCoti` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiClien` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiTipoCliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tiemCoti` time DEFAULT NULL,
  `codiCotiEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(11) DEFAULT NULL,
  `numCoti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcotizacion`
--

INSERT INTO `tcotizacion` (`codiCoti`, `fechaCoti`, `asuntoCoti`, `codiClien`, `codiTipoCliente`, `codiCola`, `tiemCoti`, `codiCotiEsta`, `fechaSistema`, `estado`, `numCoti`) VALUES
('COD_0256151321_123', '2018-05-25', NULL, '2', NULL, '45068903', NULL, 'CE_17_5_201881295764310211311', '2018-06-12 23:03:20', 1, 1),
('COD_0512651321', '2018-05-25', 'Some thing', '1', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COD_0512651321_123', '2018-05-25', 'Some thing', '3', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_1_6_201812911710132536418', '2018-06-01 11:45:45', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-01 16:45:45', 1, NULL),
('COT_1_6_201813469212101118573', '2018-06-01 11:07:23', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-01 16:07:23', 1, NULL),
('COT_1_6_201851224811109161337', '2018-06-01 11:08:55', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-01 16:08:55', 1, NULL),
('COT_12_6_201811814127361091325', '2018-06-12 19:27:56', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:27:56', 1, NULL),
('COT_12_6_201813291267810314115', '2018-06-12 19:29:06', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:29:06', 1, NULL),
('COT_12_6_201813910846312751211', '2018-06-12 19:45:46', 'Cotización de All in one', '3', NULL, '45068903', NULL, 'CE_17_5_201838412102111951367', '2018-06-13 16:05:27', 1, NULL),
('COT_12_6_201831041371126591218', '2018-06-12 18:04:03', NULL, NULL, NULL, NULL, NULL, 'CE_17_5_201881295764310211311', '2018-06-12 23:09:01', 1, NULL),
('COT_12_6_201831265911341181027', '2018-06-12 18:05:02', NULL, NULL, NULL, NULL, NULL, 'CE_17_5_201881295764310211311', '2018-06-12 23:09:01', 1, NULL),
('COT_12_6_201851110618133274912', '2018-06-12 19:02:13', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:02:13', 1, NULL),
('COT_12_6_201872631210113841195', '2018-06-12 19:14:29', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 00:14:29', 1, NULL),
('COT_14_6_201892121011568113347', '2018-06-14 19:01:06', 'Cotizacion de impresora hp', 'C_14_6_201811734281210195613', NULL, '46788344', NULL, 'CE_17_5_201838412102111951367', '2018-07-04 01:09:18', 1, NULL),
('COT_17_5_201811361012879511234', '17-5-2018', NULL, '2', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_17_5_201813641289571102311', '17-5-2018', NULL, '1', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_17_5_201841139852126110137', '17-5-2018', NULL, '3', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_17_5_201867124311128109135', '17-5-2018', NULL, '2', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_18_5_201811241381710512639', '2018-05-18 18:59:05', NULL, '1', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_18_5_201813510136741182912', '2018-05-18 20:12:52', NULL, '3', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_18_5_201813697581104212113', '2018-05-18 19:14:32', NULL, '2', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_19_5_201810641113712139582', '2018-05-19 13:09:31', NULL, '1', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_20_6_201812481191032161357', '2018-06-20 17:33:54', 'Cotización de SERVIDOR NAS', '1', NULL, '46788344', NULL, 'CE_17_5_201838412102111951367', '2018-06-29 00:20:35', 1, NULL),
('COT_20_6_201861131278510139124', '2018-06-20 10:56:01', 'Gabinete', '2', NULL, '46788344', NULL, 'CE_17_5_201838412102111951367', '2018-06-20 20:54:53', 1, NULL),
('COT_22_5_201811837124659131102', '2018-05-22 19:52:00', NULL, '3', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:32:03', 1, 1),
('COT_22_5_201837265941211101813', '2018-05-22 19:54:59', 'XYZ', '2', NULL, '45068903', NULL, 'CE_10_5_201871211813103659412', '2018-05-30 14:46:00', 1, 1),
('COT_23_5_201810311121278941365', '2018-05-23 10:44:37', '', NULL, NULL, NULL, NULL, NULL, '2018-05-23 15:44:37', 1, NULL),
('COT_23_5_201812511313410728196', '2018-05-23 12:58:02', '', NULL, NULL, NULL, NULL, NULL, '2018-05-23 17:58:02', 1, NULL),
('COT_23_5_201837629131158410121', '2018-05-23 10:48:38', '', NULL, NULL, NULL, NULL, NULL, '2018-05-23 15:48:38', 1, NULL),
('COT_23_5_201878210115934611312', '2018-05-23 10:48:46', '', NULL, NULL, NULL, NULL, NULL, '2018-05-23 15:48:46', 1, NULL),
('COT_25_5_201810114912132563187', '2018-05-25 16:46:59', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:46:59', 1, NULL),
('COT_25_5_201811057291331112468', '2018-05-25 15:51:49', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 20:51:49', 1, NULL),
('COT_25_5_201811122415867101393', '2018-05-25 16:45:08', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:45:08', 1, NULL),
('COT_25_5_201811161384921051237', '2018-05-25 16:38:01', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:38:01', 1, NULL),
('COT_25_5_201811287110391345126', '2018-05-25 19:00:09', 'Some thing', '2', NULL, NULL, NULL, NULL, '2018-05-26 00:00:09', 1, NULL),
('COT_25_5_201811710512481313962', '2018-05-25 16:31:10', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:31:10', 1, NULL),
('COT_25_5_201812106827341115913', '2018-05-25 09:11:43', '', NULL, NULL, NULL, NULL, NULL, '2018-05-25 14:11:43', 1, NULL),
('COT_25_5_201812109831375116214', '2018-05-25 15:45:16', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 20:45:16', 1, NULL),
('COT_25_5_201813112125710849361', '2018-05-25 16:41:15', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:41:15', 1, NULL),
('COT_25_5_201816112481312957103', '2018-05-25 17:19:05', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 22:19:05', 1, NULL),
('COT_25_5_201816485131011129273', '2018-05-25 20:33:05', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 01:33:05', 1, NULL),
('COT_25_5_201817611513381210924', '2018-05-25 16:29:09', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:29:09', 1, NULL),
('COT_25_5_201821143139187651210', '2018-05-25 19:02:16', 'Some thing', '2', NULL, NULL, NULL, NULL, '2018-05-26 00:02:16', 1, NULL),
('COT_25_5_201821211137134598106', '2018-05-25 17:32:03', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 22:32:03', 1, NULL),
('COT_25_5_201824961813121135710', '2018-05-25 18:43:25', 'Some thing', NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:43:25', 1, NULL),
('COT_25_5_201831228136111749105', '2018-05-25 16:43:03', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:43:03', 1, NULL),
('COT_25_5_201837119561813102124', '2018-05-25 13:08:31', '', NULL, NULL, NULL, NULL, NULL, '2018-05-25 18:08:30', 1, NULL),
('COT_25_5_201838261374591011211', '2018-05-25 15:46:37', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 20:46:37', 1, NULL),
('COT_25_5_201841711212536108139', '2018-05-25 15:53:09', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 20:53:09', 1, NULL),
('COT_25_5_201851031292411813176', '2018-05-25 16:14:47', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:14:47', 1, NULL),
('COT_25_5_201856127981132131014', '2018-05-25 18:55:37', 'Some thing', '2', NULL, NULL, NULL, NULL, '2018-05-25 23:55:37', 1, NULL),
('COT_25_5_201861013351211482179', '2018-05-25 18:00:22', 'Some thing', NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:00:22', 1, NULL),
('COT_25_5_201861292138101147351', '2018-05-25 19:44:19', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:44:19', 1, NULL),
('COT_25_5_201862912131078431115', '2018-05-25 16:48:17', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:48:17', 1, NULL),
('COT_25_5_201865101197313241281', '2018-05-25 19:53:07', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:53:07', 1, NULL),
('COT_25_5_201871063582112913411', '2018-05-25 18:24:05', 'Some thing', NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:24:05', 1, NULL),
('COT_25_5_201871110121352934186', '2018-05-25 18:30:52', 'Some thing', NULL, NULL, NULL, NULL, NULL, '2018-05-25 23:30:52', 1, NULL),
('COT_25_5_201871153942810131126', '2018-05-25 19:54:50', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:54:50', 1, NULL),
('COT_25_5_201875311082411129613', '2018-05-25 16:42:39', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 21:42:39', 1, NULL),
('COT_25_5_201881125613910341127', '2018-05-25 13:08:41', '', NULL, NULL, NULL, NULL, NULL, '2018-05-25 18:08:41', 1, NULL),
('COT_25_5_201885631213111074912', '2018-05-25 19:45:09', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-26 00:45:09', 1, NULL),
('COT_25_5_201891175310412613812', '2018-05-25 18:53:34', 'Some thing', '2', NULL, NULL, NULL, NULL, '2018-05-25 23:53:34', 1, NULL),
('COT_28_5_201810792151181246133', '2018-05-28 10:08:33', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 15:08:33', 1, NULL),
('COT_28_5_201813597311641122810', '2018-05-28 11:23:07', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 16:23:07', 1, NULL),
('COT_28_5_201815631228139711104', '2018-05-28 11:45:51', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 16:45:51', 1, NULL),
('COT_30_5_201811135841327126910', '2018-05-30 18:00:25', 'Asunto de prueba', '1', NULL, '45068903', NULL, 'CE_17_5_201881295764310211311', '2018-06-12 17:47:44', 1, NULL),
('COT_30_5_201813481251792116310', '2018-05-30 11:42:49', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 16:42:49', 1, NULL),
('COT_30_5_201829511123813610174', '2018-05-30 17:56:51', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 22:56:51', 1, NULL),
('COT_30_5_201881210231613579411', '2018-05-30 17:32:43', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 22:32:43', 1, NULL),
('COT_30_5_201881339101124117265', '2018-05-30 17:43:13', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 22:43:13', 1, NULL),
('COT_4_7_201813682951211103714', '2018-07-04 10:44:46', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-04 15:44:46', 1, NULL),
('COT_4_7_201861211105113429873', '2018-07-04 10:08:20', 'COTIZACION DE SERVIDORES DELL R740', 'C_4_7_201857121363111109428', NULL, '70343190', NULL, 'CE_17_5_201838412102111951367', '2018-07-04 15:44:42', 1, NULL),
('COT_4_7_201871041265111138392', '2018-07-04 09:41:28', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-04 14:41:28', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcotizacionestado`
--

CREATE TABLE `tcotizacionestado` (
  `codiCotiEsta` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreCotiEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveCotiEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ordenCotiEsta` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaCotiEsta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tcotizacionestado`
--

INSERT INTO `tcotizacionestado` (`codiCotiEsta`, `nombreCotiEsta`, `nombreBreveCotiEsta`, `ordenCotiEsta`, `estaCotiEsta`) VALUES
('CE_10_5_201841389271110653121', 'Anulado', 'Anulado', '2', 1),
('CE_10_5_201871211813103659412', 'Activo', 'Activo', '1', 1),
('CE_14_6_201811032135127611498', 'Asistido', 'Asistido', '5', 1),
('CE_17_5_201838412102111951367', 'En construccion', 'Dev', '4', 1),
('CE_17_5_201881295764310211311', 'Finalizado', 'Fin', '3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdepartamento`
--

CREATE TABLE `tdepartamento` (
  `codiDepar` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ordenPresenDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdistrito`
--

CREATE TABLE `tdistrito` (
  `codiDistri` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `codiProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ordenPresenDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdolar`
--

CREATE TABLE `tdolar` (
  `codiDolar` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `dolarCompra` double DEFAULT NULL,
  `dolarVenta` double DEFAULT NULL,
  `fechaCambio` date DEFAULT NULL,
  `codiDolarProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tdolar`
--

INSERT INTO `tdolar` (`codiDolar`, `dolarCompra`, `dolarVenta`, `fechaCambio`, `codiDolarProveedor`, `codiCola`, `estado`) VALUES
('D_5_5_201816271013123894511', 3.15, 3.26, '2018-05-05', 'DP_5_5_201879412611251133108', '70343190', 1),
('D_7_5_201826481910111213573', 3.16, 3.3, '2018-05-07', 'DP_5_5_201810236897411131251', '72709740', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdolarproveedor`
--

CREATE TABLE `tdolarproveedor` (
  `codiDolarProveedor` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreDolarProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveDolarProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaDolarProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `defectoDolarProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tdolarproveedor`
--

INSERT INTO `tdolarproveedor` (`codiDolarProveedor`, `nombreDolarProveedor`, `nombreBreveDolarProveedor`, `estaDolarProveedor`, `defectoDolarProveedor`, `estado`) VALUES
('DP_5_5_201810236897411131251', 'Banco Central del Perú', 'BCP', '1', '3.25', 1),
('DP_5_5_201829384151013121167', 'InterBank', 'IB', '1', '3.28', 1),
('DP_5_5_201879412611251133108', 'ScotiaBank', 'SB', '1', '3.26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempresa`
--

CREATE TABLE `tempresa` (
  `codiEmpre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreEmpre` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveEmpre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rucEmpre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direcEmpre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tele01Empre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tele02Empre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `webEmpre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaEmpre` int(11) DEFAULT NULL,
  `fechaRegisEmpre` date DEFAULT NULL,
  `fechaActiEmpre` date DEFAULT NULL,
  `fechaDesacEmpre` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testaacti`
--

CREATE TABLE `testaacti` (
  `codiEstaActi` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreEstaActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveEstaActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `colorEstaActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfamilia`
--

CREATE TABLE `tfamilia` (
  `codiFamilia` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreFamilia` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveFamilia` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tfamilia`
--

INSERT INTO `tfamilia` (`codiFamilia`, `nombreFamilia`, `nombreBreveFamilia`, `estado`, `fechaSistema`) VALUES
('F_28_5_201813427119108112536', 'Servidores', 'Servidores', 1, '2018-05-28 23:31:52'),
('F_28_5_201876101851293211413', 'Procesadores', 'CPU\'s', 1, '2018-05-28 21:29:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tigv`
--

CREATE TABLE `tigv` (
  `codiIgv` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `valorIgv` double DEFAULT NULL,
  `fechaInIgv` date DEFAULT NULL,
  `fechaFinalIgv` date DEFAULT NULL,
  `estaIgv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tigv`
--

INSERT INTO `tigv` (`codiIgv`, `codiCola`, `valorIgv`, `fechaInIgv`, `fechaFinalIgv`, `estaIgv`) VALUES
('IGV_5_5_201812513910413826117', '46959026', 18, '2018-05-05', '2018-12-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tjerarquiacargo`
--

CREATE TABLE `tjerarquiacargo` (
  `codiJerarCargo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiCargo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiArea` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCargoRespon` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmarcaproducto`
--

CREATE TABLE `tmarcaproducto` (
  `codiMarca` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreMarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveMarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagenMarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaMarca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tmarcaproducto`
--

INSERT INTO `tmarcaproducto` (`codiMarca`, `nombreMarca`, `nombreBreveMarca`, `imagenMarca`, `estaMarca`) VALUES
('MP_3_5_201825113712410381196', 'Nexys', 'NEX', 'Nexsys.png', 1),
('mp001', 'DELLEMC', 'DMC', 'Dell-EMC.png', 1),
('mp002', 'INTEL', 'INTEL', 'Intel-2018.png', 1),
('mp003', 'LEXMARK', 'LEXMARK', 'Lexmark-Partner.png', 1),
('mp004', 'HP PARTNER', 'HP', 'Hp-Partner.png', 1),
('mp005', 'AUTODESK', 'AD', 'Autodesk.png', 1),
('mp006', 'HEWLLET PACKARD', 'HP', 'HPE.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmenusistema`
--

CREATE TABLE `tmenusistema` (
  `codiMenuSiste` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiSistema` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreMenuSiste` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveMenuSiste` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tprecioproductoproveedor`
--

CREATE TABLE `tprecioproductoproveedor` (
  `idTPrecioProductoProveedor` int(11) NOT NULL,
  `codiCola` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProducProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precioProducDolar` double DEFAULT NULL,
  `stockProduc` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tiempoEntreProduc` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaConsulProduc` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tprecioproductoproveedor`
--

INSERT INTO `tprecioproductoproveedor` (`idTPrecioProductoProveedor`, `codiCola`, `codiProducProveedor`, `codiProveedor`, `precioProducDolar`, `stockProduc`, `tiempoEntreProduc`, `fechaConsulProduc`, `estado`) VALUES
(1, '45068903', 'PP_15_5_201887641159121013123', 'p002', 2550, '10', '00:30', NULL, 0),
(2, '45068903', 'PP_15_5_201887641159121013123', 'p001', 2600, '6', '23:00', '2018-05-19', 1),
(3, '46788344', 'PP_15_5_201817651112824313910', 'p001', 1200, '10', '01:00', '2018-06-28', 1),
(4, '46788344', 'PP_15_5_201846133117185109212', '14', 560, '11', '02:00', '2018-06-28', 1),
(5, '46788344', 'PP_15_5_201851319712104382611', '12', 980, '2', '05:00', '2018-06-28', 1),
(6, '46788344', 'PP_15_5_201852871113191263104', '15', 3200, '5', '02:00', '2018-06-28', 1),
(7, '46788344', 'PP_3_5_201886511312103711924', '1', 650, '15', '02:00', '2018-06-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tprodcarta`
--

CREATE TABLE `tprodcarta` (
  `idtProdCarta` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tprodcarta`
--

INSERT INTO `tprodcarta` (`idtProdCarta`, `descripcion`, `estado`, `fechaSistema`) VALUES
(1, 'Servidores en general. Storage Rack y Gabinetes', 1, '2018-06-26 16:38:23'),
(2, 'Sistema de video vigilancia. DVR, cámaras HD y PTZ', 1, '2018-06-26 16:38:23'),
(3, 'Linea de audio y video profesional. Cámaras y filmadoras', 1, '2018-06-26 16:38:23'),
(4, 'Pizarras interactivas. Proyectores de tiro corto.', 1, '2018-06-26 16:38:23'),
(5, 'Suministros de impresion (Toner, tintas, cintas, papel térmico, etc)', 1, '2018-06-26 16:38:23'),
(6, 'Sistema de alimentacion ininterrumpida - UPS', 1, '2018-06-27 00:48:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproductoproveedor`
--

CREATE TABLE `tproductoproveedor` (
  `codiProducProveedor` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiMarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreProducProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveProducP` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProducMarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codInterno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripProduc` text COLLATE utf8_spanish2_ci,
  `estado` int(11) DEFAULT NULL,
  `codiFamilia` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tproductoproveedor`
--

INSERT INTO `tproductoproveedor` (`codiProducProveedor`, `codiMarca`, `nombreProducProveedor`, `nombreBreveProducP`, `codiProducMarca`, `codInterno`, `descripProduc`, `estado`, `codiFamilia`) VALUES
('PP_15_5_201817651112824313910', 'MP_3_5_201825113712410381196', 'Lexmark X864dhe 4', 'Lexmark X864dhe 4', '115588', 'PD156', 'Monochrome Laser', 1, NULL),
('PP_15_5_201846133117185109212', 'mp003', 'Lexmark MX812dme', 'Lexmark MX812dme', 'MX812dme', 'PDMX812dme', 'Tipo de dispositivos\r\nMonochrome Laser\r\nTamaño del Grupo de Trabajo\r\nLarge Workgroup\r\nVelocidad de Impresión: Hasta\r\n70 ppm', 1, NULL),
('PP_15_5_201851319712104382611', 'mp003', 'Lexmark MX910de', 'Lexmark MX910de', 'MX910de', 'PDMX910de', 'Tipo de dispositivos\r\nMonochrome Laser\r\nTamaño del Grupo de Trabajo\r\nGrupo de Trabajo Departamental\r\nVelocidad de Impresión: Hasta\r\n45 ppm', 1, NULL),
('PP_15_5_201852871113191263104', 'MP_3_5_201825113712410381196', 'Notebook Ln Y720-15Ikb', 'Notebook Ln Y720-15Ikb', '80VR00A9LM', 'PD8795', 'Notebook Ln Y720-15Ikb I7 16G', 1, NULL),
('PP_15_5_201887641159121013123', 'MP_3_5_201825113712410381196', 'Z1 All In One', 'Z1 All In One', 'W5Y08LA#ABM', 'PD1548', 'Workstation Hp Z1 G3 Aio (Todo En Uno 23.6). ', 1, NULL),
('PP_3_5_201886511312103711924', 'mp002', 'Procesador Core i7 - 7548 3.40 Ghz', 'Core i7 - 3.40', 'IN-2018-2102', 'PD-0125-2018', 'Procesador de séptima generación para juegos.', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproveedor`
--

CREATE TABLE `tproveedor` (
  `codiProveedor` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `RucProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direcProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `webProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaProveedor` int(11) DEFAULT NULL,
  `codiDistri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tproveedor`
--

INSERT INTO `tproveedor` (`codiProveedor`, `nombreProveedor`, `nombreBreveProveedor`, `RucProveedor`, `direcProveedor`, `webProveedor`, `estaProveedor`, `codiDistri`, `codiProvin`, `codiDepar`, `estado`) VALUES
('1', 'ANIXTER PERU S.A.C.', 'null', '20418354781', 'CALLE ONTARIO NRO. 157 URB. LA CAMPINA CHORRI', 'www.anixter.com', 1, 'null', 'null', 'null', 1),
('10', 'DISTECNA PERU SAC', 'null', '20565624351', 'AV. ARAMBURU NRO. 675 SAN ISIDRO - LIMA - LIM', 'www.distecna.com', 1, 'null', 'null', 'null', 1),
('11', 'EXPORTADORA IMPORTADORA IGARASHI ASCENCIO S.R', 'null', '20252011910', 'AV. PETIT THOUARS NRO. 1529 LINCE - LIMA - LI', 'www.grupoigarashi.com', 1, 'null', 'null', 'null', 1),
('12', 'GRUPO DELTRON S.A.', 'null', '20212331377', 'CALLE RAUL REBAGLIATI NRO. 170 URB. SANTA CAT', 'www.deltron.com.pe', 1, 'null', 'null', 'null', 1),
('13', 'GRUPO IMPORTEK SAC', 'null', '20516973324', 'AV. REPUBLICA DE PANAMA NRO. 1757 URB. BALCON', 'www.grupoimportek.com', 1, 'null', 'null', 'null', 1),
('14', 'HALION INTERNACIONAL S.A.', 'null', '20505970323', 'AV. IGNACIO MERINO NRO. 2488 INT. 401 LINCE -', 'www.halion.com.pe', 1, 'null', 'null', 'null', 1),
('15', 'INGRAM MICRO S.A.C.', 'null', '20267163228', 'AV. JAVIER PRADO ESTE NRO. 157 DPTO. 903 SAN ', 'pe.ingrammicro.com', 1, 'null', 'null', 'null', 1),
('16', 'INTCOMEX PERU S.A.C', 'null', '20254507874', 'CALLE LOS NEGOCIOS NRO. 448 URB. LIMATAMBO SU', 'www.intcomex.com', 1, 'null', 'null', 'null', 1),
('17', 'KROTON S.A.C.', 'null', '20346833280', 'AV. PETIT THOUARS NRO. 3460 SAN ISIDRO - LIMA', 'www.kroton.com.pe', 1, 'null', 'null', 'null', 1),
('18', 'LATIN PARTS S.A.C.', 'null', '20492374211', 'AV. PETIT THOUARS NRO. 5356 INT. 4001 MIRAFLO', 'www.latinparts.com', 1, 'null', 'null', 'null', 1),
('19', 'MACRO WORK S.A.C.', 'null', '20474136991', 'CALLE LA HABANA NRO. 280 SAN ISIDRO - LIMA - ', 'www.macrowork.com.pe', 1, 'null', 'null', 'null', 1),
('2', 'BRANDED NET S.A', 'null', '20520772813', 'JR. MIGUEL CERVANTES NRO. 205 LIMA - LIMA - L', 'www.brandednet.com', 1, 'null', 'null', 'null', 1),
('20', 'MAQUINARIAS JAAM S.A.', 'null', '20193696920', 'JR. LAMPA NRO. 990 URB. CERCADO DE LIMA - LIM', 'www.jaamsa.com', 1, 'null', 'null', 'null', 1),
('21', 'MAXIMA INTERNACIONAL S.A.', 'null', '20127745910', 'AV. REPUBLICA DE PANAMA NRO. 3852 SURQUILLO -', 'www.maximainternacional.com.pe', 1, 'null', 'null', 'null', 1),
('22', 'NEXSYS DEL PERU SAC', 'null', '20470145901', 'JR JORGE BASADRE NRO. 233 INT 401 SAN ISIDRO ', 'www.nexsysla.com', 1, 'null', 'null', 'null', 1),
('23', 'NEXUS TECHNOLOGY S.A.C.', 'null', '20267178331', 'AV. RICARDO PALMA NRO. 693 URB. SAN ANTONIO M', 'www.nexus.com.pe', 1, 'null', 'null', 'null', 1),
('24', 'PANASHOP S.A.C.', 'null', '20292528583', 'AV. JAVIER PRADO ESTE NRO. 1402 INT. 301 SAN ', 'www.panashopsa.com', 1, 'null', 'null', 'null', 1),
('25', 'PCLINK S.A.C.', 'null', '20469317855', 'AV CUBA NRO. 254 - JESUS MARIA - LIMA', 'www.pclink.com.pe', 1, 'null', 'null', 'null', 1),
('26', 'PERU OFFICE S.A.', 'null', '20376321712', 'AV. VICTOR ANDRÉS BELAUNDE NRO. 147 SAN ISIDR', 'www.ricoh-la.com', 1, 'null', 'null', 'null', 1),
('27', 'REPRODATA S.A.C.', 'null', '20100340438', 'AV. REPÚBLICA DE PANAMA NRO. 3517 INT. PI.8 U', 'www.reprodata.com.pe', 1, 'null', 'null', 'null', 1),
('28', 'SATRA PERU SAC', 'null', '20267049361', 'JR DOMINGO MARTINEZ LUJAN NRO. 935 SURQUILLO ', 'www.satranet.com', 1, 'null', 'null', 'null', 1),
('29', 'SCHROTH CORPORACION PAPELERA S.A.C.', 'null', '20101085199', 'JR. LUIS FELIPE VILLARAN NRO. 315 SAN ISIDRO ', 'www.scpcorp.com.pe', 1, 'null', 'null', 'null', 1),
('3', 'BUY SCAN PERU S.R.L.', 'null', '20544020073', 'CALLE CHINCHON 155 - SAN ISIDRO - LIMA - LIMA', 'www.buyscan.com', 1, 'null', 'null', 'null', 1),
('30', 'SONDA DEL PERU S.A.', 'null', '20383773378', 'AV. CANAVAL Y MOREYRA NRO. 480 DPTO. 1001 SAN', 'www.sonda.com', 1, 'null', 'null', 'null', 1),
('31', 'SUDAMERICA THERMAL SOLUTIONS S.A.C', 'null', '20536196570', 'JR WASHINTON 1308 LIMA - LIMA - LIMA', 'www.deepcool.pe', 1, 'null', 'null', 'null', 1),
('32', 'SUMINISTROS TECNOLOGICOS E.I.R.L', 'null', '20117779379', 'CALLE CESAR VALLEJO  NRO. 225 - LINCE - LIMA ', 'www.sumteccorp.com', 1, 'null', 'null', 'null', 1),
('33', 'SUPERTEC SAC', 'null', '20434327611', 'CALLE RICARDO FLORES 358  LA VICTORIA - LIMA ', 'www.supertec.com.pe', 1, 'null', 'null', 'null', 1),
('34', 'TAI HENG S A', 'null', '20100274621', 'JR. UCAYALI NRO. 706 CERCADO DE LIMA - LIMA -', 'www.taiheng.com.pe', 1, 'null', 'null', 'null', 1),
('4', 'CISTRONIX PERU S.A.C.', 'null', '20256498422', 'AV. VÍA DE EVITAMIENTO NRO. 1615 URB. SAN FRA', 'www.cistronixperu.com', 1, 'null', 'null', 'null', 1),
('5', 'CODIGO DE BARRAS PERU E.I.R.L.', 'CODIGO DE BARRAS', '20506996253', 'AV. PERSHING NRO. 182 MAGDALENA DEL MAR - LIM', 'www.codbarperu.com', 1, 'null', 'null', 'null', 1),
('6', 'COMPUDISKETT S.R.L.', 'null', '20123053037', 'AV. REPUBLICA DE CHILE NRO. 504 JESUS MARIA -', 'www.compudiskett.com.pe', 1, 'null', 'null', 'null', 1),
('7', 'DAT & NET DEL PERU S.A', 'null', '20308572081', 'AV. OSCAR R. BENAVIDES NRO. 5771 PROV. CONST.', 'www.datanetsa.com', 1, 'null', 'null', 'null', 1),
('8', 'DATACONT S.A.C.', 'null', '20100131359', 'AV. REPUBLICA DE PANAMA NRO. 3517 INT. 9 URB.', 'www.datacont.com', 1, 'null', 'null', 'null', 1),
('9', 'DEFEMAC DATA & VOZ S.A.C.', 'null', '20600430565', 'AV. ARGENTINA 215 PASAJE NRO. 3 INT. AP8 LIMA', 'www.defemac.com', 1, 'null', 'null', 'null', 1),
('p001', 'DELTRON', 'DEL', '12345678912', 'Jr. Atalaya 589', 'www.proveedor001.net', 1, 'El tambo', 'Huancayo', 'Junin', 1),
('p002', 'AMERICA', 'AMERICA', '96385274112', 'Jr. Amazonas 698', 'www.proveedor002.org', 1, 'Huancayo', 'Huancayo', 'Junin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproveedorcontacto`
--

CREATE TABLE `tproveedorcontacto` (
  `codiProveeContac` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `apePaterProveeC` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apeMaterProveeC` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dniProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celu01ProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celu02ProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tele01ProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `anexoProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo01ProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo02ProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `skypeProveeContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiProveedor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiMarca` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codiCargoContac` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `detalle` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tproveedorcontacto`
--

INSERT INTO `tproveedorcontacto` (`codiProveeContac`, `apePaterProveeC`, `apeMaterProveeC`, `nombreProveeContac`, `dniProveeContac`, `celu01ProveeContac`, `celu02ProveeContac`, `tele01ProveeContac`, `anexoProveeContac`, `correo01ProveeContac`, `correo02ProveeContac`, `skypeProveeContac`, `codiProveedor`, `codiMarca`, `codiCargoContac`, `detalle`, `estado`, `fechaSistema`) VALUES
('pc001', 'Rendich', 'Cunyar', 'George Grover', '45068903', '944560253', 'NULL', '584878', 'NULL', 'grendich@perudataconsult.net', 'george.rendich@gmail.com', 'grendich', 'p002', 'mp002', 'cc003', 'Analista programador Perú Data', 1, '2018-05-28 23:58:52'),
('pc002', 'Torres', 'Estrella', 'Abel', '78945612', '968457896', '954226688', '064878999', 'NULL', 'soporte01@perudataconsult.net', 'abel.torres@gmail.com', 'abelito@torres', 'p001', 'mp001', 'cc004', 'SAC', 1, '2018-05-28 23:58:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tprovincia`
--

CREATE TABLE `tprovincia` (
  `codiProvin` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `codiDepar` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ordenPresenProvin` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trazon`
--

CREATE TABLE `trazon` (
  `idTRazon` int(11) NOT NULL,
  `idActi` int(11) DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsedejuridico`
--

CREATE TABLE `tsedejuridico` (
  `codiSedeJur` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiClienJuri` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descSedeJur` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estadoSedeJur` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tservcarta`
--

CREATE TABLE `tservcarta` (
  `idtServCarta` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tservcarta`
--

INSERT INTO `tservcarta` (`idtServCarta`, `descripcion`, `estado`, `fechaSistema`) VALUES
(1, 'Cableado estructurado certificado UTP, Fibra, Óptica.', 1, '2018-06-26 16:42:33'),
(2, 'Licenciamiento de software (Microsoft, Adobe, AutoDesk, Corel, Antivirus).', 1, '2018-06-26 16:42:33'),
(3, 'Asesoría en proyectos de Tecnologías de la Información y Comunicación.', 1, '2018-06-26 16:42:33'),
(4, 'Sistemas de protección eléctrica y respaldo de energía.', 1, '2018-06-26 16:42:33'),
(5, 'Mantenimiento y reparación de equipos informáticos.', 1, '2018-06-27 00:47:16'),
(6, 'Implementación central telefónicas (Asterisk)', 1, '2018-06-27 00:47:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsistema`
--

CREATE TABLE `tsistema` (
  `codiSistema` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreSiste` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveSiste` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaCreaSiste` date DEFAULT NULL,
  `estaSiste` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsubfamilia`
--

CREATE TABLE `tsubfamilia` (
  `codiSubFamilia` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiFamilia` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreSubFamilia` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveSubFamilia` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tsubfamilia`
--

INSERT INTO `tsubfamilia` (`codiSubFamilia`, `codiFamilia`, `nombreSubFamilia`, `nombreBreveSubFamilia`, `estado`, `fechaSistema`) VALUES
('SF_28_5_201811295310128134176', 'F_28_5_201876101851293211413', '8 núcleos', 'x8', 1, '2018-05-28 23:33:26'),
('SF_28_5_201811813512213496710', 'F_28_5_201876101851293211413', '2 Nucleos', 'x2', 1, '2018-05-28 23:31:26'),
('SF_28_5_201814107125863119213', 'F_28_5_201813427119108112536', 'Cuchilla', 'Blade', 1, '2018-05-28 23:32:38'),
('SF_28_5_201841216795108321311', 'F_28_5_201813427119108112536', 'Rackeable', 'Rack', 1, '2018-05-28 23:32:19'),
('SF_28_5_201874111231015298613', 'F_28_5_201813427119108112536', 'Torre', 'Torre', 1, '2018-05-28 23:32:50'),
('SF_28_5_201886972313411112510', 'F_28_5_201876101851293211413', '4 Núcleos', 'x4', 1, '2018-05-28 23:33:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsubmenusistema`
--

CREATE TABLE `tsubmenusistema` (
  `codiSubMenu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codiMenuSiste` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreSubMenu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveSubMenu` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipoactividad`
--

CREATE TABLE `ttipoactividad` (
  `codiTipoActi` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreTipoActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveTipoActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `colorActi` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaActi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipocartapresen`
--

CREATE TABLE `ttipocartapresen` (
  `codiTipoCartaPresen` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `tipoCartaPresen` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreTipoCartaP` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveTipoCartaP` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaTipoCartaPresen` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ttipocartapresen`
--

INSERT INTO `ttipocartapresen` (`codiTipoCartaPresen`, `tipoCartaPresen`, `nombreTipoCartaP`, `nombreBreveTipoCartaP`, `estaTipoCartaPresen`) VALUES
('TCP_10_5_201884133125117101296', 'Juridico', 'Juridico', 'Juridico', '1'),
('TCP_7_5_201851112489312761310', 'Gobierno', 'Tipo de carta para Gobierno', 'GOB', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipocliente`
--

CREATE TABLE `ttipocliente` (
  `codiTipoCliente` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreTipoCliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveTipoCliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `entidad` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaTipoCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ttipocliente`
--

INSERT INTO `ttipocliente` (`codiTipoCliente`, `nombreTipoCliente`, `nombreBreveTipoCliente`, `entidad`, `estaTipoCliente`) VALUES
('TC_3_5_201869111138534101227', 'Natural', 'NAT', 'ClienteNatural', 1),
('TC_3_5_201881354976101321112', 'Tipo 003', 'T003', NULL, 1),
('tc001', 'Jurídico', 'JUR', 'ClienteJuridico', 1),
('tc002', 'Gobierno', 'GOB', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipoclientejuridico`
--

CREATE TABLE `ttipoclientejuridico` (
  `codiTipoCliJur` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descTipoCliJur` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estadoTipoCliJur` int(11) DEFAULT NULL,
  `fechaSistema` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ttipoclientejuridico`
--

INSERT INTO `ttipoclientejuridico` (`codiTipoCliJur`, `descTipoCliJur`, `estadoTipoCliJur`, `fechaSistema`) VALUES
('ctj001', 'Gobierno', 1, '2018-04-28 15:20:22'),
('ctj002', 'Privado', 1, '2018-04-28 15:20:49'),
('TCJ_3_5_201832416118712135910', 'Prueba 01', 1, '2018-05-03 20:44:38'),
('TCJ_3_5_201891311124675210138', 'Extranjero', 1, '2018-05-03 17:59:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipocontrato`
--

CREATE TABLE `ttipocontrato` (
  `codiTipoContra` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreTipoContra` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombreBreveTipoContra` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estaTipoContra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codiCola` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codiCargo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `codiCola`, `codiCargo`) VALUES
(1, 'admin', 'grendich@perudataconsult.net', '$2y$10$H0.jC4T6s4uPCAKFBapztOOdul/iZJ6b8UXKejwrpTDf42MycZqge', 'n5rXvzukQqKvoGoGLqK0HrOPkuhnlqrVXdKZWnLGPTWY98968MzwDAcUQPIJ', '2018-05-12 17:10:03', '2018-06-20 15:39:19', '45068903', NULL),
(2, 'Ingrid', 'ingrid@perudataconsult.net', '$2y$10$iNCbQu7MtyzUQCoB.Q6TweX3I/Bee0N8gzMaN8mtlsgajdqCz.Tnq', 'jEZlh7UEB0CQNpVIzeE5MyrpVWCXcp9FROJuLGsWmXx7MRH2uD2hVM6kTYF8', '2018-06-20 15:39:54', '2018-07-06 17:58:37', '46788344', NULL),
(3, 'Lucía Vila', 'lucia@perudataconsult.net', '$2y$10$ZSBTZHs1N6enDNj8kQXWvuKkArieV0DQe/YoFZvq9JkA1cb8W0Kmu', NULL, '2018-06-20 22:33:23', '2018-06-20 22:33:23', '45087781', NULL),
(4, 'Kelly', 'kelly@perudataconsult.net', '$2y$10$ryoCcygXg50NdfPueqXRquYmOt0Zs8kJaYaTmGI.Bmiw9e9FFqqe.', 'yoTBaPHraS1Y7XtiDBbwtcjEgz0B2bKHfUEERaOLwLSlZPtVjPeOTpmmuB8P', '2018-07-04 13:57:11', '2018-07-04 13:57:29', '70343190', NULL),
(5, 'Shirley', 'shirley@perudataconsult.net', '$2y$10$iR8lylVXbcYirnLFeOK9Q.aK8X6wXWmbOSHq/JhFFjzWVujY4IR3W', NULL, '2018-07-04 13:58:06', '2018-07-04 13:58:06', '72459709', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `taccesomenu`
--
ALTER TABLE `taccesomenu`
  ADD PRIMARY KEY (`codiAcceMenu`),
  ADD KEY `submenu.acceso_idx` (`codiSubMenu`);

--
-- Indices de la tabla `taccesosistema`
--
ALTER TABLE `taccesosistema`
  ADD PRIMARY KEY (`codiAcceSiste`),
  ADD KEY `acceso.sistema_idx` (`codiSistema`),
  ADD KEY `acceso.contrato_idx` (`codiTipoContra`);

--
-- Indices de la tabla `tacticola`
--
ALTER TABLE `tacticola`
  ADD PRIMARY KEY (`idtActiCola`),
  ADD KEY `tCola.tActiCola_idx` (`codiCola`),
  ADD KEY `tActi.tActiCola_idx` (`id`);

--
-- Indices de la tabla `tactividad`
--
ALTER TABLE `tactividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acti.tipoacti_idx` (`codiTipoActi`),
  ADD KEY `acti.estaacti_idx` (`codiEstaActi`);

--
-- Indices de la tabla `tactividadreporte`
--
ALTER TABLE `tactividadreporte`
  ADD PRIMARY KEY (`codiActiRepor`),
  ADD KEY `actiRepo.acti_idx` (`id`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`codiArea`);

--
-- Indices de la tabla `tcargo`
--
ALTER TABLE `tcargo`
  ADD PRIMARY KEY (`codiCargo`),
  ADD KEY `cargo.area_idx` (`codiArea`);

--
-- Indices de la tabla `tcargocontacto`
--
ALTER TABLE `tcargocontacto`
  ADD PRIMARY KEY (`codiCargoContac`);

--
-- Indices de la tabla `tcartacola`
--
ALTER TABLE `tcartacola`
  ADD PRIMARY KEY (`idTCartaCola`),
  ADD KEY `CartaPresentacion.Colaborador_idx` (`codiCartaPresen`),
  ADD KEY `Colaborador.CartaPresentacion_idx` (`codiCola`);

--
-- Indices de la tabla `tcartapresentacion`
--
ALTER TABLE `tcartapresentacion`
  ADD PRIMARY KEY (`codiCartaPresen`),
  ADD KEY `CartaPresentacion.TipoCartaPresentacion_idx` (`codiTipoCartaPresen`);

--
-- Indices de la tabla `tcliente`
--
ALTER TABLE `tcliente`
  ADD PRIMARY KEY (`codiClien`),
  ADD KEY `Cliente.TipoCliente_idx` (`codiTipoCliente`),
  ADD KEY `Cliente.ClienteJuridico_idx` (`codiClienJuri`),
  ADD KEY `Cliente.ClienteNatural_idx` (`codiClienNatu`);

--
-- Indices de la tabla `tclientejuridico`
--
ALTER TABLE `tclientejuridico`
  ADD PRIMARY KEY (`codiClienJuri`),
  ADD KEY `ClienteJuridico.TipoClienteJuridico_idx` (`codiTipoCliJur`);

--
-- Indices de la tabla `tclientenatural`
--
ALTER TABLE `tclientenatural`
  ADD PRIMARY KEY (`codiClienNatu`);

--
-- Indices de la tabla `tcolaborador`
--
ALTER TABLE `tcolaborador`
  ADD PRIMARY KEY (`codiCola`),
  ADD UNIQUE KEY `codiCola_UNIQUE` (`codiCola`);

--
-- Indices de la tabla `tcondicionescomerciales`
--
ALTER TABLE `tcondicionescomerciales`
  ADD PRIMARY KEY (`codiCondiComer`);

--
-- Indices de la tabla `tcontactocliente`
--
ALTER TABLE `tcontactocliente`
  ADD PRIMARY KEY (`codiContacClien`),
  ADD KEY `ContactoCliente.ClienteJuridico_idx` (`codiClienJuri`),
  ADD KEY `ContactoCliente.Colaborador_idx` (`codiCola`);

--
-- Indices de la tabla `tcontrato`
--
ALTER TABLE `tcontrato`
  ADD PRIMARY KEY (`codiContrato`),
  ADD KEY `cont.empre_idx` (`codiEmpre`),
  ADD KEY `cont.tipocontra_idx` (`codiTipoContra`),
  ADD KEY `cont.cola_idx` (`codiCola`),
  ADD KEY `cargo.contrato_idx` (`codiCargo`);

--
-- Indices de la tabla `tcosteo`
--
ALTER TABLE `tcosteo`
  ADD PRIMARY KEY (`codiCosteo`),
  ADD KEY `Costeo.CosteoEstado_idx` (`codiCosteoEsta`),
  ADD KEY `Costeo.Colaborador_idx` (`codiCola`);

--
-- Indices de la tabla `tcosteoestado`
--
ALTER TABLE `tcosteoestado`
  ADD PRIMARY KEY (`codiCosteoEsta`);

--
-- Indices de la tabla `tcosteoitem`
--
ALTER TABLE `tcosteoitem`
  ADD PRIMARY KEY (`idCosteoItem`),
  ADD KEY `CosteoItem.ProveedorContacto_idx` (`codiProveeContac`),
  ADD KEY `CosteoItem.Costeo_idx` (`codiCosteo`),
  ADD KEY `CosteoItem.PrecioProductoProveedor_idx` (`idTPrecioProductoProveedor`);

--
-- Indices de la tabla `tcoticondiciones`
--
ALTER TABLE `tcoticondiciones`
  ADD PRIMARY KEY (`idTCotiCondiciones`),
  ADD KEY `Cotizacion.CotiCondiciones_idx` (`codiCoti`),
  ADD KEY `TCondicionesComerciales.CotiCondiciones_idx` (`codiCondiComer`);

--
-- Indices de la tabla `tcoticosteo`
--
ALTER TABLE `tcoticosteo`
  ADD PRIMARY KEY (`idTCotiCosteo`),
  ADD KEY `coti.costeo_idx` (`codiCoti`),
  ADD KEY `costeo.coti_idx` (`codiCosteo`);

--
-- Indices de la tabla `tcotizacion`
--
ALTER TABLE `tcotizacion`
  ADD PRIMARY KEY (`codiCoti`),
  ADD KEY `Cotizacion.CotizacionEstado_idx` (`codiCotiEsta`),
  ADD KEY `Cotizacion.Colaborador_idx` (`codiCola`),
  ADD KEY `Cotizacion.Cliente_idx` (`codiClien`);

--
-- Indices de la tabla `tcotizacionestado`
--
ALTER TABLE `tcotizacionestado`
  ADD PRIMARY KEY (`codiCotiEsta`);

--
-- Indices de la tabla `tdepartamento`
--
ALTER TABLE `tdepartamento`
  ADD PRIMARY KEY (`codiDepar`);

--
-- Indices de la tabla `tdistrito`
--
ALTER TABLE `tdistrito`
  ADD PRIMARY KEY (`codiDistri`),
  ADD KEY `dist.prov_idx` (`codiProvin`);

--
-- Indices de la tabla `tdolar`
--
ALTER TABLE `tdolar`
  ADD PRIMARY KEY (`codiDolar`),
  ADD KEY `Dolar.Colaborador_idx` (`codiCola`),
  ADD KEY `Dolar.DolarProveedor_idx` (`codiDolarProveedor`);

--
-- Indices de la tabla `tdolarproveedor`
--
ALTER TABLE `tdolarproveedor`
  ADD PRIMARY KEY (`codiDolarProveedor`);

--
-- Indices de la tabla `tempresa`
--
ALTER TABLE `tempresa`
  ADD PRIMARY KEY (`codiEmpre`),
  ADD KEY `emp.dist_idx` (`codiDistri`);

--
-- Indices de la tabla `testaacti`
--
ALTER TABLE `testaacti`
  ADD PRIMARY KEY (`codiEstaActi`);

--
-- Indices de la tabla `tfamilia`
--
ALTER TABLE `tfamilia`
  ADD PRIMARY KEY (`codiFamilia`);

--
-- Indices de la tabla `tigv`
--
ALTER TABLE `tigv`
  ADD PRIMARY KEY (`codiIgv`),
  ADD KEY `Igv.Colaborador_idx` (`codiCola`);

--
-- Indices de la tabla `tjerarquiacargo`
--
ALTER TABLE `tjerarquiacargo`
  ADD PRIMARY KEY (`codiJerarCargo`),
  ADD KEY `jer.cargo_idx` (`codiCargo`);

--
-- Indices de la tabla `tmarcaproducto`
--
ALTER TABLE `tmarcaproducto`
  ADD PRIMARY KEY (`codiMarca`);

--
-- Indices de la tabla `tmenusistema`
--
ALTER TABLE `tmenusistema`
  ADD PRIMARY KEY (`codiMenuSiste`),
  ADD KEY `menusis.sistema_idx` (`codiSistema`);

--
-- Indices de la tabla `tprecioproductoproveedor`
--
ALTER TABLE `tprecioproductoproveedor`
  ADD PRIMARY KEY (`idTPrecioProductoProveedor`),
  ADD KEY `PrecioProductoProveedor.Colaborador_idx` (`codiCola`),
  ADD KEY `PrecioProductoProveedor.ProductoProveedor_idx` (`codiProducProveedor`),
  ADD KEY `PrecioProductoProveedor.Proveedor_idx` (`codiProveedor`);

--
-- Indices de la tabla `tprodcarta`
--
ALTER TABLE `tprodcarta`
  ADD PRIMARY KEY (`idtProdCarta`);

--
-- Indices de la tabla `tproductoproveedor`
--
ALTER TABLE `tproductoproveedor`
  ADD PRIMARY KEY (`codiProducProveedor`),
  ADD KEY `ProductoProveedor.MarcaProducto_idx` (`codiMarca`),
  ADD KEY `ProductoProveedor.Familia_idx` (`codiFamilia`);

--
-- Indices de la tabla `tproveedor`
--
ALTER TABLE `tproveedor`
  ADD PRIMARY KEY (`codiProveedor`);

--
-- Indices de la tabla `tproveedorcontacto`
--
ALTER TABLE `tproveedorcontacto`
  ADD PRIMARY KEY (`codiProveeContac`),
  ADD KEY `ProveedorContacto.MarcaProducto_idx` (`codiMarca`),
  ADD KEY `ProveedorContacto.CargoContacto_idx` (`codiCargoContac`),
  ADD KEY `ProveedorContacto.Proveedor_idx` (`codiProveedor`);

--
-- Indices de la tabla `tprovincia`
--
ALTER TABLE `tprovincia`
  ADD PRIMARY KEY (`codiProvin`),
  ADD KEY `dep.prov_idx` (`codiDepar`);

--
-- Indices de la tabla `trazon`
--
ALTER TABLE `trazon`
  ADD PRIMARY KEY (`idTRazon`),
  ADD KEY `acti.razon_idx` (`idActi`);

--
-- Indices de la tabla `tsedejuridico`
--
ALTER TABLE `tsedejuridico`
  ADD PRIMARY KEY (`codiSedeJur`),
  ADD KEY `Sede.ClienteJuridico_idx` (`codiClienJuri`);

--
-- Indices de la tabla `tservcarta`
--
ALTER TABLE `tservcarta`
  ADD PRIMARY KEY (`idtServCarta`);

--
-- Indices de la tabla `tsistema`
--
ALTER TABLE `tsistema`
  ADD PRIMARY KEY (`codiSistema`);

--
-- Indices de la tabla `tsubfamilia`
--
ALTER TABLE `tsubfamilia`
  ADD PRIMARY KEY (`codiSubFamilia`),
  ADD KEY `SubFamilia.Familia_idx` (`codiFamilia`);

--
-- Indices de la tabla `tsubmenusistema`
--
ALTER TABLE `tsubmenusistema`
  ADD PRIMARY KEY (`codiSubMenu`),
  ADD KEY `menu.submenu_idx` (`codiMenuSiste`);

--
-- Indices de la tabla `ttipoactividad`
--
ALTER TABLE `ttipoactividad`
  ADD PRIMARY KEY (`codiTipoActi`);

--
-- Indices de la tabla `ttipocartapresen`
--
ALTER TABLE `ttipocartapresen`
  ADD PRIMARY KEY (`codiTipoCartaPresen`);

--
-- Indices de la tabla `ttipocliente`
--
ALTER TABLE `ttipocliente`
  ADD PRIMARY KEY (`codiTipoCliente`);

--
-- Indices de la tabla `ttipoclientejuridico`
--
ALTER TABLE `ttipoclientejuridico`
  ADD PRIMARY KEY (`codiTipoCliJur`);

--
-- Indices de la tabla `ttipocontrato`
--
ALTER TABLE `ttipocontrato`
  ADD PRIMARY KEY (`codiTipoContra`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tacticola`
--
ALTER TABLE `tacticola`
  MODIFY `idtActiCola` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tactividad`
--
ALTER TABLE `tactividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tcartacola`
--
ALTER TABLE `tcartacola`
  MODIFY `idTCartaCola` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tcontrato`
--
ALTER TABLE `tcontrato`
  MODIFY `codiContrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tcosteoitem`
--
ALTER TABLE `tcosteoitem`
  MODIFY `idCosteoItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `tcoticondiciones`
--
ALTER TABLE `tcoticondiciones`
  MODIFY `idTCotiCondiciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tcoticosteo`
--
ALTER TABLE `tcoticosteo`
  MODIFY `idTCotiCosteo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `tprecioproductoproveedor`
--
ALTER TABLE `tprecioproductoproveedor`
  MODIFY `idTPrecioProductoProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tprodcarta`
--
ALTER TABLE `tprodcarta`
  MODIFY `idtProdCarta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `trazon`
--
ALTER TABLE `trazon`
  MODIFY `idTRazon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tservcarta`
--
ALTER TABLE `tservcarta`
  MODIFY `idtServCarta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `taccesomenu`
--
ALTER TABLE `taccesomenu`
  ADD CONSTRAINT `submenu.acceso` FOREIGN KEY (`codiSubMenu`) REFERENCES `tsubmenusistema` (`codiSubMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `taccesosistema`
--
ALTER TABLE `taccesosistema`
  ADD CONSTRAINT `acceso.contrato` FOREIGN KEY (`codiTipoContra`) REFERENCES `tcontrato` (`codiTipoContra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acceso.sistema` FOREIGN KEY (`codiSistema`) REFERENCES `tsistema` (`codiSistema`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tacticola`
--
ALTER TABLE `tacticola`
  ADD CONSTRAINT `tActi.tActiCola` FOREIGN KEY (`id`) REFERENCES `tactividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tCola.tActiCola` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tactividad`
--
ALTER TABLE `tactividad`
  ADD CONSTRAINT `acti.estaacti` FOREIGN KEY (`codiEstaActi`) REFERENCES `testaacti` (`codiEstaActi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acti.tipoacti` FOREIGN KEY (`codiTipoActi`) REFERENCES `ttipoactividad` (`codiTipoActi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tactividadreporte`
--
ALTER TABLE `tactividadreporte`
  ADD CONSTRAINT `actiRepo.acti` FOREIGN KEY (`id`) REFERENCES `tactividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcargo`
--
ALTER TABLE `tcargo`
  ADD CONSTRAINT `cargo.area` FOREIGN KEY (`codiArea`) REFERENCES `tarea` (`codiArea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcartacola`
--
ALTER TABLE `tcartacola`
  ADD CONSTRAINT `CartaPresentacion.Colaborador` FOREIGN KEY (`codiCartaPresen`) REFERENCES `tcartapresentacion` (`codiCartaPresen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Colaborador.CartaPresentacion` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcartapresentacion`
--
ALTER TABLE `tcartapresentacion`
  ADD CONSTRAINT `CartaPresentacion.TipoCartaPresentacion` FOREIGN KEY (`codiTipoCartaPresen`) REFERENCES `ttipocartapresen` (`codiTipoCartaPresen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcliente`
--
ALTER TABLE `tcliente`
  ADD CONSTRAINT `Cliente.ClienteJuridico` FOREIGN KEY (`codiClienJuri`) REFERENCES `tclientejuridico` (`codiClienJuri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cliente.ClienteNatural` FOREIGN KEY (`codiClienNatu`) REFERENCES `tclientenatural` (`codiClienNatu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cliente.TipoCliente` FOREIGN KEY (`codiTipoCliente`) REFERENCES `ttipocliente` (`codiTipoCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tclientejuridico`
--
ALTER TABLE `tclientejuridico`
  ADD CONSTRAINT `ClienteJuridico.TipoClienteJuridico` FOREIGN KEY (`codiTipoCliJur`) REFERENCES `ttipoclientejuridico` (`codiTipoCliJur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcontactocliente`
--
ALTER TABLE `tcontactocliente`
  ADD CONSTRAINT `ContactoCliente.ClienteJuridico` FOREIGN KEY (`codiClienJuri`) REFERENCES `tclientejuridico` (`codiClienJuri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ContactoCliente.Colaborador` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcontrato`
--
ALTER TABLE `tcontrato`
  ADD CONSTRAINT `cargo.contrato` FOREIGN KEY (`codiCargo`) REFERENCES `tcargo` (`codiCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cont.cola` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cont.empre` FOREIGN KEY (`codiEmpre`) REFERENCES `tempresa` (`codiEmpre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cont.tipocontra` FOREIGN KEY (`codiTipoContra`) REFERENCES `ttipocontrato` (`codiTipoContra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcosteo`
--
ALTER TABLE `tcosteo`
  ADD CONSTRAINT `Costeo.Colaborador` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Costeo.CosteoEstado` FOREIGN KEY (`codiCosteoEsta`) REFERENCES `tcosteoestado` (`codiCosteoEsta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcosteoitem`
--
ALTER TABLE `tcosteoitem`
  ADD CONSTRAINT `CosteoItem.Costeo` FOREIGN KEY (`codiCosteo`) REFERENCES `tcosteo` (`codiCosteo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CosteoItem.PrecioProductoProveedor` FOREIGN KEY (`idTPrecioProductoProveedor`) REFERENCES `tprecioproductoproveedor` (`idTPrecioProductoProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CosteoItem.ProveedorContacto` FOREIGN KEY (`codiProveeContac`) REFERENCES `tproveedorcontacto` (`codiProveeContac`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcoticondiciones`
--
ALTER TABLE `tcoticondiciones`
  ADD CONSTRAINT `Cotizacion.CotiCondiciones` FOREIGN KEY (`codiCoti`) REFERENCES `tcotizacion` (`codiCoti`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TCondicionesComerciales.CotiCondiciones` FOREIGN KEY (`codiCondiComer`) REFERENCES `tcondicionescomerciales` (`codiCondiComer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcoticosteo`
--
ALTER TABLE `tcoticosteo`
  ADD CONSTRAINT `costeo.coti` FOREIGN KEY (`codiCosteo`) REFERENCES `tcosteo` (`codiCosteo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `coti.costeo` FOREIGN KEY (`codiCoti`) REFERENCES `tcotizacion` (`codiCoti`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcotizacion`
--
ALTER TABLE `tcotizacion`
  ADD CONSTRAINT `Cotizacion.Cliente` FOREIGN KEY (`codiClien`) REFERENCES `tcliente` (`codiClien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cotizacion.Colaborador` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cotizacion.CotizacionEstado` FOREIGN KEY (`codiCotiEsta`) REFERENCES `tcotizacionestado` (`codiCotiEsta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tdistrito`
--
ALTER TABLE `tdistrito`
  ADD CONSTRAINT `dist.prov` FOREIGN KEY (`codiProvin`) REFERENCES `tprovincia` (`codiProvin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tdolar`
--
ALTER TABLE `tdolar`
  ADD CONSTRAINT `Dolar.Colaborador` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Dolar.DolarProveedor` FOREIGN KEY (`codiDolarProveedor`) REFERENCES `tdolarproveedor` (`codiDolarProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tempresa`
--
ALTER TABLE `tempresa`
  ADD CONSTRAINT `emp.dist` FOREIGN KEY (`codiDistri`) REFERENCES `tdistrito` (`codiDistri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tigv`
--
ALTER TABLE `tigv`
  ADD CONSTRAINT `Igv.Colaborador` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tjerarquiacargo`
--
ALTER TABLE `tjerarquiacargo`
  ADD CONSTRAINT `jer.cargo` FOREIGN KEY (`codiCargo`) REFERENCES `tcargo` (`codiCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tmenusistema`
--
ALTER TABLE `tmenusistema`
  ADD CONSTRAINT `menusis.sistema` FOREIGN KEY (`codiSistema`) REFERENCES `tsistema` (`codiSistema`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tprecioproductoproveedor`
--
ALTER TABLE `tprecioproductoproveedor`
  ADD CONSTRAINT `PrecioProductoProveedor.Colaborador` FOREIGN KEY (`codiCola`) REFERENCES `tcolaborador` (`codiCola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PrecioProductoProveedor.ProductoProveedor` FOREIGN KEY (`codiProducProveedor`) REFERENCES `tproductoproveedor` (`codiProducProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PrecioProductoProveedor.Proveedor` FOREIGN KEY (`codiProveedor`) REFERENCES `tproveedor` (`codiProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tproductoproveedor`
--
ALTER TABLE `tproductoproveedor`
  ADD CONSTRAINT `ProductoProveedor.Familia` FOREIGN KEY (`codiFamilia`) REFERENCES `tfamilia` (`codiFamilia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ProductoProveedor.MarcaProducto` FOREIGN KEY (`codiMarca`) REFERENCES `tmarcaproducto` (`codiMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tproveedorcontacto`
--
ALTER TABLE `tproveedorcontacto`
  ADD CONSTRAINT `ProveedorContacto.CargoContacto` FOREIGN KEY (`codiCargoContac`) REFERENCES `tcargocontacto` (`codiCargoContac`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ProveedorContacto.MarcaProducto` FOREIGN KEY (`codiMarca`) REFERENCES `tmarcaproducto` (`codiMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ProveedorContacto.Proveedor` FOREIGN KEY (`codiProveedor`) REFERENCES `tproveedor` (`codiProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tprovincia`
--
ALTER TABLE `tprovincia`
  ADD CONSTRAINT `dep.prov` FOREIGN KEY (`codiDepar`) REFERENCES `tdepartamento` (`codiDepar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trazon`
--
ALTER TABLE `trazon`
  ADD CONSTRAINT `acti.razon` FOREIGN KEY (`idActi`) REFERENCES `tactividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tsedejuridico`
--
ALTER TABLE `tsedejuridico`
  ADD CONSTRAINT `Sede.ClienteJuridico` FOREIGN KEY (`codiClienJuri`) REFERENCES `tclientejuridico` (`codiClienJuri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tsubfamilia`
--
ALTER TABLE `tsubfamilia`
  ADD CONSTRAINT `SubFamilia.Familia` FOREIGN KEY (`codiFamilia`) REFERENCES `tfamilia` (`codiFamilia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tsubmenusistema`
--
ALTER TABLE `tsubmenusistema`
  ADD CONSTRAINT `menu.submenu` FOREIGN KEY (`codiMenuSiste`) REFERENCES `tmenusistema` (`codiMenuSiste`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
