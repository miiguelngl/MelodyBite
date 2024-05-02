-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2024 a las 14:50:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hamburguesas`
--

INSERT INTO `hamburguesas` (`IdHamburguesa`, `Nombre`, `Descripcion_corta`, `Descripcion`, `Precio`, `Ingredientes`) VALUES
(1, 'Funky Burger', 'Una explosión de sabores que te transporta al ritmo vibrante de la música funk.', 'Sumérgete en un viaje de sabores audaces y creativos con nuestra Funky Burger, una combinación única que despierta tus sentidos con cada bocado. ¡Déjate llevar por el ritmo del sabor!', 12.00, 'Pan brioche, Bacon, Queso paddano madurado, Carne de buey con 45 días de maduración, Nuestra salsa carbonara de la casa'),
(2, 'La Rockera', 'Una hamburguesa con carácter, perfecta para los amantes del rock más auténtico.', 'Con la esencia rebelde del rock, nuestra Rockera te invita a disfrutar de una explosión de sabores intensos y auténticos. Déjate llevar por el espíritu libre de esta hamburguesa vibrante.', 13.00, 'Pan brioche, Pulled pork, Carne de buey con 30 días de maduración, Cheddar, Bacon, Cebolla frita, Salsa de mostaza y miel'),
(3, 'Pop Burger', 'Un estallido de sabor y color que te hará vibrar al ritmo de la música pop.', 'Vive una experiencia pop de sabor con nuestra Pop Burger, donde los contrastes y la diversión se encuentran en cada capa. Un estallido de sabores que te sorprenderá en cada mordisco.', 9.00, 'Pan brioche, Carne de vaca vieja, Queso brie, Bacon, Mayonesa de cebollino'),
(4, 'Hip-Hop Style', 'Una hamburguesa con un toque urbano y moderno, al ritmo del hip-hop.', 'Entra en el ritmo urbano con nuestra Hip-Hop Style Burger, una fusión de ingredientes frescos y deliciosos que te transportarán al corazón de la cultura urbana. ¡Siente la energía en cada sabor!', 9.00, 'Pan brioche, Patatas paja, Chistorra, Huevo frito, Queso cheddar ahumado, Carne de vaca vieja, Nuestra mayonesa de la casa'),
(5, 'The Classical', 'Una delicia clásica que te lleva de vuelta a los sabores tradicionales.', 'La elegancia atemporal se combina con la excelencia gastronómica en nuestra The Classical Burger, una creación que celebra la tradición y el buen gusto en cada detalle. Disfruta de la grandeza en cada bocado.', 14.00, 'Pan brioche, Mayo chipotle, Pico de gallo, Mermelada de jalapeño, Bacon, Queso cheddar, Carne de chuletón madurado 45 días'),
(6, 'Soul Burger', 'Déjate llevar por los sabores profundos y la autenticidad de este clásico reinventado.', 'Descubre el alma de la gastronomía en nuestra Soul Burger, una experiencia culinaria que despierta emociones profundas y sabores inolvidables. Déjate llevar por la pasión y el sabor auténtico.', 14.00, 'Pan brioche, Mayonesa de chimichurri, Pulled pork, Cebolla blanca a la plancha, Queso provolone, Carne de chuletón madurado 45 días, Mermelada de jalapeños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `Apodo` varchar(255) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Contrasena` varchar(255) DEFAULT NULL,
  `Tipo_usuario` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Apodo`, `Nombre`, `Apellidos`, `Correo`, `Contrasena`, `Tipo_usuario`) VALUES
(7, 'miiguelngl', 'Miguel Angel', 'Garcia Perez', '04mangel@gmail.com', '1234', 1),
(8, 'miguel', 'miguel', 'angel', 'prueba@gmail.com', '$2y$10$7oSowzZ6cOxFnxzU62CIF.aKCQdxto.n0g5uTfKBatKjY2aYpNZtC', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hamburguesas`
--
ALTER TABLE `hamburguesas`
  ADD PRIMARY KEY (`IdHamburguesa`);

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
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
