-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2019 a las 14:08:32
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vuelosviajes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `usuarioCarrito` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clase` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha_ida` date NOT NULL,
  `fecha_vuelta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `cantidad`, `usuarioCarrito`, `pais`, `clase`, `precio`, `fecha_ida`, `fecha_vuelta`) VALUES
(4, 1, 'pepe', 'portugal', 'turista', 54, '2019-12-21', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `nombreVuelo` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `nombreUsuario`, `nombreVuelo`, `fecha`) VALUES
(1, '1', '1', '2019-11-26'),
(2, '2', '1', '2019-11-18'),
(3, 'ariadna', 'portugal', '0000-00-00'),
(4, 'ariadna', 'francia', '0000-00-00'),
(5, 'ariadna', 'portugal', '0000-00-00'),
(6, 'ariadna', 'portugal', '0000-00-00'),
(7, 'ariadna', 'portugal', '0000-00-00'),
(8, 'pepe', 'portugal', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`) VALUES
(1, 'ariadna', 'ariadna'),
(2, 'pepe', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `id` int(11) NOT NULL,
  `pais` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clase` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha_ida` date NOT NULL,
  `fecha_vuelta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`id`, `pais`, `clase`, `precio`, `fecha_ida`, `fecha_vuelta`) VALUES
(1, 'Madrid ', 'primera', 102, '2019-11-25', '2019-11-30'),
(3, 'Dubai', 'primera', 2009, '2019-12-25', '2019-12-28'),
(4, 'portugal', 'turista', 54, '2019-12-21', '2019-12-30'),
(5, 'francia', 'primera', 43, '2019-12-12', '2019-12-20'),
(6, 'portugal', 'primera', 789, '2019-12-25', '2019-12-22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
