-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-02-2025 a las 04:12:56
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elite_sport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `prod_codigo` int NOT NULL AUTO_INCREMENT,
  `prod_nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prod_categoria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prod_preciocomp` int NOT NULL,
  `prod_preciovent` int NOT NULL,
  `prod_talla` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prod_color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prod_stock` int NOT NULL,
  `prov_codigo` int NOT NULL,
  PRIMARY KEY (`prod_codigo`),
  KEY `prov_codigo` (`prov_codigo`),
  KEY `cate_codigo` (`prod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`prod_codigo`, `prod_nombre`, `prod_categoria`, `prod_preciocomp`, `prod_preciovent`, `prod_talla`, `prod_color`, `prod_stock`, `prov_codigo`) VALUES
(1, 'Camiseta Fluminense', 'Camiseta deportiva', 30000, 55000, 'S', 'Verde-Rojo-Blanco', 15, 1),
(2, 'Camisa America', 'Camiseta deportiva', 30000, 55000, 'M', 'Rojo', 15, 2),
(3, 'Camiseta Junior', 'Camiseta deportiva', 30000, 55000, 'L', 'Rojo-Blanco', 15, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `prov_codigo` int NOT NULL AUTO_INCREMENT,
  `prov_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prov_telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prov_correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prov_direccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prov_nit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prov_categoria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`prov_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`prov_codigo`, `prov_nombre`, `prov_telefono`, `prov_correo`, `prov_direccion`, `prov_nit`, `prov_categoria`) VALUES
(1, 'Arany Sport', '3183553310', 'Aranysport@gmail.com', 'avenida 2G #47 AN 04', '123456', 'Ropa Deportiva'),
(2, 'Sculpture Sport', '3183553310', 'Sculpturesport@gmail.com', 'avenida 2G #47 AN 04', '125652', 'Ropa Deportiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `user_nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_contra` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_cc` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_fechanac` date NOT NULL,
  `user_tel` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_rol` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `user_nombre`, `user_apellido`, `user_contra`, `user_cc`, `user_fechanac`, `user_tel`, `user_correo`, `user_rol`) VALUES
(1, 'Claudia', 'Bolivar', 'admin1', '34613001', '1983-03-04', '3044113543', 'claboro3@gmail.com', 'CEO'),
(2, 'Alejandro', 'Luna', 'admin2', '1109671427', '2009-09-15', '3173055541', 'alejoluna1509@gmail.com', 'Administrador'),
(3, 'Juan Sebastian', 'Lopez', 'admin3', '1105376377', '2009-11-03', '3183553310', 'juselobo7@gmail.com', 'Administrador'),
(4, 'Jeremy', 'Villacorte', 'admin4', '1105376377', '2009-07-17', '3183553310', 'jeremyv0909@gmail.com', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `vent_codigo` int NOT NULL AUTO_INCREMENT,
  `prod_codigo` int NOT NULL,
  `vent_cantidad` int NOT NULL,
  `prod_categoria` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prod_preciovent` int NOT NULL,
  `vent_metodopago` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vent_fechaventa` date NOT NULL,
  `user_codigo` int NOT NULL,
  PRIMARY KEY (`vent_codigo`),
  KEY `prod_codigo` (`prod_codigo`),
  KEY `user_codigo` (`user_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`prov_codigo`) REFERENCES `proveedor` (`prov_codigo`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`prod_codigo`) REFERENCES `productos` (`prod_codigo`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`user_codigo`) REFERENCES `usuario` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
