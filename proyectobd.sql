-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2023 a las 04:02:26
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL DEFAULT 1,
  `rtn` int(11) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `estadocivil` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `rtn`, `cliente`, `direccion`, `estadocivil`, `telefono`) VALUES
(1, 1807200, 'jenci', 'crucete', 'soltero', 8989899);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleusuario`
--

CREATE TABLE `detalleusuario` (
  `iddetalleusuario` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleusuario`
--

INSERT INTO `detalleusuario` (`iddetalleusuario`, `idusuario`, `idpermiso`) VALUES
(1, 3, 1),
(2, 3, 3),
(3, 3, 5),
(4, 3, 7),
(5, 3, 9),
(6, 3, 10),
(7, 3, 8),
(8, 3, 11),
(9, 3, 6),
(10, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(11) NOT NULL,
  `codigocliente` varchar(250) NOT NULL,
  `cliente` varchar(250) NOT NULL,
  `rtn` varchar(250) NOT NULL,
  `vendedor` varchar(250) NOT NULL,
  `tipofactura` varchar(250) NOT NULL,
  `tipopago` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `cargo` float NOT NULL,
  `total` float NOT NULL,
  `fecha` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfactura`, `codigocliente`, `cliente`, `rtn`, `vendedor`, `tipofactura`, `tipopago`, `telefono`, `cargo`, `total`, `fecha`) VALUES
(1, '01', 'Carlos alvare', '0101200421921', 'Carlos alvare', 'Credito', 'Efectivo', '33621421', 200, 22705.4, '9/12/2023'),
(2, '02', 'Pedro', '0101199193121', 'Jenci Lemus', 'Credito', 'Efectivo', '98212312', 200, 12344, '9/12/2023'),
(3, '232323', 'Marlon Puerto', '134º14º234', 'Greco Pavon', 'Credito', 'Efectivo', '8382314', 1, 1, '3/3/2023'),
(4, '232323', 'Marlon Puerto', '134º14º234', 'Jenci Lemus', 'Credito', 'Efectivo', '8382314', 1, 1, '3/3/2023'),
(5, '234123', 'Milton', '423423', 'Carlos Alvare', 'Credito', 'Efectivo', '524245', 0, 0, '8/3/2023'),
(6, '234123', 'rigo', '423423', 'jenci lemus', 'Credito', 'Efectivo', '524245', 0, 0, '8/3/2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `idlugar` int(11) NOT NULL,
  `lugar` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`idlugar`, `lugar`, `estado`) VALUES
(1, 'La Ceiba', 1),
(2, 'San Pedro Sula', 1),
(3, 'Siguatepeque', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermisos` int(11) NOT NULL,
  `permisos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermisos`, `permisos`) VALUES
(1, 'CRUD lugar'),
(2, 'Proveedor crear'),
(3, 'Proveedor editar'),
(4, 'Proveedor anular'),
(5, 'Producto crear'),
(6, 'Producto editar'),
(7, 'Producto anular'),
(8, 'Usuario crear'),
(9, 'Usuario editar'),
(10, 'Usuario anular'),
(11, 'Escritorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `codigo` varchar(250) NOT NULL,
  `producto` varchar(250) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `costo` float NOT NULL,
  `existencia` int(11) NOT NULL,
  `porcentaje1` float NOT NULL,
  `porcentaje2` float NOT NULL,
  `porcentaje3` float NOT NULL,
  `precio1` float NOT NULL,
  `precio2` float NOT NULL,
  `precio3` float NOT NULL,
  `clasificacion` varchar(250) NOT NULL,
  `unidad` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `fechacreacion` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `codigo`, `producto`, `idproveedor`, `costo`, `existencia`, `porcentaje1`, `porcentaje2`, `porcentaje3`, `precio1`, `precio2`, `precio3`, `clasificacion`, `unidad`, `imagen`, `fechacreacion`, `estado`) VALUES
(1, 'A6000', 'Microhonda A6000', 5, 330, 120, 60, 50, 45, 528, 495, 478.5, 'gris\r\n', 'mt.2', '1669829404.PNG', '22/11/2022', 1),
(2, 'NO01', 'Estufa', 2, 145, 45, 80, 75, 70, 261, 253.75, 246.5, 'blanca', 'mt.2', '1669829341.jpg', '22/11/2023', 1),
(3, 'EB01', 'Chifoniere', 2, 135, 24, 110, 100, 95, 283.5, 270, 263.25, 'madera', 'mt.2', '1670346710.jpg', '22/11/2023', 0),
(4, 'NAOS2', 'Cama Olimpia', 3, 460, 21, 80, 75, 60, 828, 805, 736, 'quin', 'mt.2', '1670347836.jpg', '23/11/2023', 1),
(5, 'TM01', 'Plancha', 4, 135, 38, 110, 100, 95, 283.5, 270, 263.25, 'electrica', 'mt.2', '1670347418.jpg', '9/12/2023', 1),
(6, 'PC01', 'Lapton', 2, 90, 25, 120, 100, 90, 198, 180, 171, 'pc lenovo', 'saco', '1670607319.jpg', '9/12/2022', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `proveedor` varchar(250) NOT NULL,
  `rtn` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `contacto` varchar(250) NOT NULL,
  `telecontacto` varchar(250) NOT NULL,
  `idlugar` int(11) NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `proveedor`, `rtn`, `telefono`, `direccion`, `contacto`, `telecontacto`, `idlugar`, `condicion`) VALUES
(1, 'Diunsa', '1604200108541', '2298-1011', 'Bo. Concepcion, 2 Calle SE', 'Cristian', 'Juan', 3, 0),
(2, 'Mabe', '0101197704596', '2295-9121', 'Bo. Mejia', 'César', 'Hamal', 1, 1),
(3, 'frigedaire', '0108199901301', '3298-3659', 'Bo. Los Andes, 8 Calle NO', 'Guillermo', 'Hugo', 2, 1),
(4, 'La maderia', '0101197812301', '3198-2191', 'Bo. Santa Ana, Plaza 501', 'Luis', 'Wilfredo', 2, 1),
(5, 'Honda', '0402198612101', '9872-1621', 'Colonia 1 de Mayo, a lado de Hotel Maya Colonial', 'Jenci', 'Selvin', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `cargo` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `login`, `clave`, `cargo`, `imagen`, `estado`) VALUES
(1, 'Adilson Cruz\r\n', 'cruz', '1234', 'Vendedor', '1669254574.jpg', 0),
(2, 'Carlos Alvares', 'alvares', '12345', 'Vendedor', '1669418650.jpg', 1),
(3, 'Greco Pavon', 'pavon', '777', 'Administrador', '1669428053.jpg', 1),
(4, 'Jenci Lemus', 'lemus', '5000', 'Administrador', '1677787747.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalleusuario`
--
ALTER TABLE `detalleusuario`
  ADD PRIMARY KEY (`iddetalleusuario`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`idlugar`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermisos`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idproveedor` (`idproveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`),
  ADD KEY `idlugar` (`idlugar`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalleusuario`
--
ALTER TABLE `detalleusuario`
  MODIFY `iddetalleusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `idlugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`idlugar`) REFERENCES `lugar` (`idlugar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
