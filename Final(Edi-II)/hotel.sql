-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2025 a las 22:59:33
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
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costs`
--

CREATE TABLE `costs` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `idroom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserves`
--

CREATE TABLE `reserves` (
  `id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `total` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idroom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserves`
--

INSERT INTO `reserves` (`id`, `fechaInicio`, `fechaFinal`, `total`, `iduser`, `idroom`) VALUES
(29, '2025-07-27', '2025-08-07', 0, 40, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `features` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id`, `number`, `type`, `features`) VALUES
(21, 1, 'Personal', 'Vista al mar'),
(25, 4, 'Matrimonial', 'Sin vista al mar'),
(26, 3, 'Matrimonial', 'Con vista al mar'),
(27, 9, 'Doble', 'Esta en perfecto estado'),
(33, 10, 'as', 'sds');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `type` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `dni`, `telephone`, `email`, `pass`, `type`) VALUES
(29, 'agustin', 'morales', '4456979', 22316958, 'yoelagusto@gmail.com', '123456', 'Administrador'),
(31, 'Roberto', 'Lopez', '33698123', 2147483647, 'robert@gmail.com', '123', 'Cliente'),
(32, 'yoel', 'alonso', '44417350', 2147483647, 'yoel@gmail.co', '1234', 'Administrador'),
(33, 'Pedro', 'Lopez', '89745111', 223659874, 'pl@gmail.com', '123', 'Cliente'),
(40, 'Eduardo', 'Lopez', '444444', 2147483647, 'edu@gmail.com', '12345', 'Cliente'),
(42, 'Alan', 'Lopez', '42333699', 223460566, 'alan@gmail.com', '123', 'Cliente'),
(43, 'Florencia', 'Cores', '44200369', 2147483647, 'flopicores@yahoo.com.ar', 'lamascapa', 'Cliente'),
(44, '', '', '', 0, '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idroom` (`idroom`);

--
-- Indices de la tabla `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`) USING BTREE,
  ADD KEY `idroom` (`idroom`) USING BTREE;

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `costs`
--
ALTER TABLE `costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserves`
--
ALTER TABLE `reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_ibfk_1` FOREIGN KEY (`idroom`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `reserves_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserves_ibfk_2` FOREIGN KEY (`idroom`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
