-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 12:02:12
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rhapshody_burger`
--
CREATE DATABASE IF NOT EXISTS `rhapshody_burger` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rhapshody_burger`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hamburguesas`
--

CREATE TABLE `hamburguesas` (
  `IdHamburguesa` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Descripcion_corta` varchar(255) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Precio` decimal(5,2) DEFAULT NULL,
  `Ingredientes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `hamburguesas`
--

INSERT INTO `hamburguesas` (`IdHamburguesa`, `Nombre`, `Descripcion_corta`, `Descripcion`, `Precio`, `Ingredientes`) VALUES
(1, 'Funky Burger', 'Una explosión de sabores que te transporta al ritmo vibrante de la música funk.', 'Sumérgete en un viaje de sabores audaces y creativos con nuestra Funky Burger, una combinación única que despierta tus sentidos con cada bocado. ¡Déjate llevar por el ritmo del sabor!', '12.00', 'Pan brioche, Bacon, Queso paddano madurado, Carne de buey con 45 días de maduración, Nuestra salsa carbonara de la casa'),
(2, 'La Rockera', 'Una hamburguesa con carácter, perfecta para los amantes del rock más auténtico.', 'Con la esencia rebelde del rock, nuestra Rockera te invita a disfrutar de una explosión de sabores intensos y auténticos. Déjate llevar por el espíritu libre de esta hamburguesa vibrante.', '13.00', 'Pan brioche, Pulled pork, Carne de buey con 30 días de maduración, Cheddar, Bacon, Cebolla frita, Salsa de mostaza y miel'),
(3, 'Pop Burger', 'Un estallido de sabor y color que te hará vibrar al ritmo de la música pop.', 'Vive una experiencia pop de sabor con nuestra Pop Burger, donde los contrastes y la diversión se encuentran en cada capa. Un estallido de sabores que te sorprenderá en cada mordisco.', '9.00', 'Pan brioche, Carne de vaca vieja, Queso brie, Bacon, Mayonesa de cebollino'),
(4, 'Hip-Hop Style', 'Una hamburguesa con un toque urbano y moderno, al ritmo del hip-hop.', 'Entra en el ritmo urbano con nuestra Hip-Hop Style Burger, una fusión de ingredientes frescos y deliciosos que te transportarán al corazón de la cultura urbana. ¡Siente la energía en cada sabor!', '9.00', 'Pan brioche, Patatas paja, Chistorra, Huevo frito, Queso cheddar ahumado, Carne de vaca vieja, Nuestra mayonesa de la casa'),
(5, 'The Classical', 'Una delicia clásica que te lleva de vuelta a los sabores tradicionales.', 'La elegancia atemporal se combina con la excelencia gastronómica en nuestra The Classical Burger, una creación que celebra la tradición y el buen gusto en cada detalle. Disfruta de la grandeza en cada bocado.', '14.00', 'Pan brioche, Mayo chipotle, Pico de gallo, Mermelada de jalapeño, Bacon, Queso cheddar, Carne de chuletón madurado 45 días'),
(6, 'Soul Burger', 'Déjate llevar por los sabores profundos y la autenticidad de este clásico reinventado.', 'Descubre el alma de la gastronomía en nuestra Soul Burger, una experiencia culinaria que despierta emociones profundas y sabores inolvidables. Déjate llevar por la pasión y el sabor auténtico.', '14.00', 'Pan brioche, Mayonesa de chimichurri, Pulled pork, Cebolla blanca a la plancha, Queso provolone, Carne de chuletón madurado 45 días, Mermelada de jalapeños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedido` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Nombre_Cliente` varchar(255) NOT NULL,
  `Pedido` varchar(512) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT 0,
  `ID_Repartidor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID_Pedido`, `ID_Usuario`, `Nombre_Cliente`, `Pedido`, `Direccion`, `Estado`, `ID_Repartidor`) VALUES
(1, 1, 'Miguel Ángel', 'La Rockera - {EXTRAS: Extra de salsa, Extra de queso, Que chorree [Extra salsa + Doble queso]}, The Classical - {EXTRAS: }, Hip-Hop Style - {EXTRAS: Extra de salsa, Extra de queso}', 'C/ Juan Fabregat 9, Piso: 5, Puerta: 12', 2, 3),
(2, 1, 'Miguel Ángel', 'La Rockera - {EXTRAS: }, La Rockera - {EXTRAS: Extra de salsa, Extra de queso}, La Rockera - {EXTRAS: }', 'C/ Juan Fabregat 9, Piso: 5, Puerta: 12', 1, 1),
(3, 1, 'Miguel Ángel', 'Funky Burger - {EXTRAS: Extra de salsa, Que chorree [Extra salsa + Doble queso]}, La Rockera - {EXTRAS: Extra de queso}', 'C/ Juan Fabregat 9, Piso: 5, Puerta: 12', 0, NULL),
(4, 1, 'Miguel Ángel', 'La Rockera - {EXTRAS: Extra de salsa}, La Rockera - {EXTRAS: Que chorree [Extra salsa + Doble queso]}', 'C/ Juan Fabregat 9, Piso: , Puerta: ', 2, 3),
(5, 1, 'Miguel Ángel', 'La Rockera - {EXTRAS: Extra de queso, Que chorree [Extra salsa + Doble queso]}, Funky Burger - {EXTRAS: }', 'C/ Juan Fabregat 9, Piso: 5, Puerta: 12', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidores`
--

CREATE TABLE `repartidores` (
  `ID_Repartidor` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `repartidores`
--

INSERT INTO `repartidores` (`ID_Repartidor`, `ID_Usuario`) VALUES
(3, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `Apodo` varchar(255) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Contrasena` varchar(255) DEFAULT NULL,
  `Tipo_usuario` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Apodo`, `Nombre`, `Apellidos`, `Direccion`, `Correo`, `Contrasena`, `Tipo_usuario`) VALUES
(1, 'miguelngl', 'Miguel Ángel', 'García Pérez', 'C/ Juan Fabregat 9', '04mangel@gmail.com', '$2y$10$QUwszQj4GVYO70TnlgX66uZqcLz6SNINYbdmfdIhWiriXseFAHOba', 1),
(2, 'pablitoUsuario', 'Pablo', 'El usuario', '', 'pablito@gmail.com', '$2y$10$kN/VCmz8UFqfER4eHjajveMGuqETQG3/4AE4zkGBeR4zc5t0leqwC', 0),
(3, 'pabloCocinero', 'Pablo', 'Cocinero', '', 'pablococinero@gmail.com', '$2y$10$da0gDXv9DnLgQxW6MGThnOBMCjpmtzBxOeUXtF4optzlIwdhywABS', 2),
(4, 'davidRepartidor', 'David', 'Orts', 'Calle Manolo Lama', 'davorts@gmail.com', '$2y$10$ODbM631rcn4OZFGyRoh4q.EBfmkr3VsgTYr4Xf8z4lDs6LzqjOLvG', 3),
(5, 'pabloRepartidor', 'Pablo', 'El Repartidor', 'C/ Machado Mil', 'pabloRepartidor@gmail.com', '$2y$10$XTrjAHFCK17UF0dQvtqznO99AO4hoqDsVgLh7NqkIYZSRvpwQ329K', 3),
(6, 'miguelMemoria', 'Miguel', 'Ángel', 'C/ Manolo Lama', 'kayrusn1n3@gmail.com', '$2y$10$PLe7lcpK8fUuFBFn/jT8I.8t.Np2JeswdAcRNiOPQA0GR05t6e3L.', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hamburguesas`
--
ALTER TABLE `hamburguesas`
  ADD PRIMARY KEY (`IdHamburguesa`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `ID del usuario` (`ID_Usuario`),
  ADD KEY `fk_pedidos_repartidores` (`ID_Repartidor`);

--
-- Indices de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD PRIMARY KEY (`ID_Repartidor`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hamburguesas`
--
ALTER TABLE `hamburguesas`
  MODIFY `IdHamburguesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  MODIFY `ID_Repartidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `ID del usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`IdUsuario`),
  ADD CONSTRAINT `fk_pedidos_repartidores` FOREIGN KEY (`ID_Repartidor`) REFERENCES `repartidores` (`ID_Repartidor`);

--
-- Filtros para la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD CONSTRAINT `fk_repartidores_usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`IdUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
