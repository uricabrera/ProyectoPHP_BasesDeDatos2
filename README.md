# ProyectoPHP_BasesDeDatos2
Proyecto PHP base de datos 2 - Establecimiento de Base De Datos Triggers, Procedimientos, Vistas y Funciones en SQL

# Codigo SQL para poder establecer Base De Datos

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ropa_online`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerProveedores` ()   BEGIN
    SELECT nombre, id_proveedor
    FROM proveedor;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(10) UNSIGNED NOT NULL,
  `id_orden` varchar(100) NOT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `id_prenda` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(10) UNSIGNED DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_orden`, `id_usuario`, `id_prenda`, `cantidad`, `fecha`) VALUES
(22, '202407226924', 1, 9, 4, '2024-07-22 18:01:15'),
(23, '20240723EE47', 1, 9, 3, '2024-07-22 22:24:58'),
(24, '20240723EE47', 1, 10, 5, '2024-07-22 22:24:58'),
(25, '2024072378F3', 5, 9, 6, '2024-07-22 22:27:05'),
(26, '2024072378F3', 5, 10, 4, '2024-07-22 22:27:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre`, `descripcion`) VALUES
(1, 'Nike', 'Epica nike'),
(2, 'Adidas', 'Ejemplo Adidas'),
(3, 'Supreme', 'Una buena marca de ejemplo');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `marcanombreidvista`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `marcanombreidvista` (
`nombre` varchar(30)
,`id_marca` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `marcanombresvista`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `marcanombresvista` (
`nombre` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prenda`
--

CREATE TABLE `prenda` (
  `id_prenda` int(10) UNSIGNED NOT NULL,
  `id_marca` int(10) UNSIGNED DEFAULT NULL,
  `id_proveedor` int(10) UNSIGNED DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `talle` varchar(30) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `precio` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(200) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prenda`
--

INSERT INTO `prenda` (`id_prenda`, `id_marca`, `id_proveedor`, `nombre`, `descripcion`, `color`, `talle`, `imagen`, `precio`, `cantidad`) VALUES
(9, 2, 1, 'Prenda de ejemplo azul modificada de nuevo', 'Una prenda azul modificada de nuevo', 'Verde', 'S', 'remeraazul1.jpg397', 2500, 15),
(10, 3, 3, 'Producto ejemplo remera marron', 'Descripcion de remera', 'Marron', 'L', 'remeramarron.png855', 544324, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `telefono` int(10) UNSIGNED DEFAULT NULL,
  `correo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `telefono`, `correo`) VALUES
(1, 'MendoProveedor', 261535335, 'losmejores@gmail.com'),
(2, 'Adidas', 2615151513, 'proveedoradidas@gmail.com'),
(3, 'MendozaPrendas', 5424141, 'proveedormendozaprendas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `tipo_de_usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `contrasena`, `tipo_de_usuario`) VALUES
(1, 'uriel', 'cabrera', 'urimartin@hola123.com', '07defbc96400f5b9e6a61eadd4058251030a460f', '1'),
(5, 'cuentaejemplo', 'ejemplo', 'cuentaejemplo@gmail.com', '88118b6710928622c807a92b3834a87d677bc535', '0');

-- --------------------------------------------------------

--
-- Estructura para la vista `marcanombreidvista`
--
DROP TABLE IF EXISTS `marcanombreidvista`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `marcanombreidvista`  AS SELECT `marca`.`nombre` AS `nombre`, `marca`.`id_marca` AS `id_marca` FROM `marca` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `marcanombresvista`
--
DROP TABLE IF EXISTS `marcanombresvista`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `marcanombresvista`  AS SELECT `marca`.`nombre` AS `nombre` FROM `marca` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_prenda` (`id_prenda`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `prenda`
--
ALTER TABLE `prenda`
  ADD PRIMARY KEY (`id_prenda`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prenda`
--
ALTER TABLE `prenda`
  MODIFY `id_prenda` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_prenda`) REFERENCES `prenda` (`id_prenda`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prenda`
--
ALTER TABLE `prenda`
  ADD CONSTRAINT `prenda_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE,
  ADD CONSTRAINT `prenda_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
