-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 07:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postgres`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `dni` int(11) NOT NULL,
  `genero` text NOT NULL,
  `nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `dni`, `genero`, `nacimiento`) VALUES
(1, 'marco', 'polo', 1111, 'masculino', '2023-08-24'),
(2, 'agustin', 'bastos', 1234, 'masculino', '2023-08-08'),
(3, 'manuel', 'rojo', 4321, 'masculino', '2023-08-19'),
(8, 'damian', 'farias', 51323, 'masculino', '2023-08-05'),
(9, 'santiago', 'ruffini', 5123, 'masculino', '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `destino`
--

CREATE TABLE `destino` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `destino`
--

INSERT INTO `destino` (`id`, `nombre`) VALUES
(1, 'córdoba'),
(2, 'corrientes'),
(3, 'jesus maría');

-- --------------------------------------------------------

--
-- Table structure for table `origen`
--

CREATE TABLE `origen` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `origen`
--

INSERT INTO `origen` (`id`, `nombre`) VALUES
(1, 'buenos aires'),
(2, 'san miguel'),
(3, 'tres arroyos');

-- --------------------------------------------------------

--
-- Table structure for table `pasajes`
--

CREATE TABLE `pasajes` (
  `id` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_llegada` date NOT NULL,
  `origen_id` int(11) NOT NULL,
  `destino_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_llegada` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pasajes`
--

INSERT INTO `pasajes` (`id`, `fecha_salida`, `fecha_llegada`, `origen_id`, `destino_id`, `precio`, `vehiculo_id`, `hora_salida`, `hora_llegada`) VALUES
(1, '2023-08-18', '2023-08-18', 1, 1, 31153, 1, '12:31:34', '12:29:28'),
(2, '2023-08-18', '2023-08-18', 2, 2, 1353140, 4, '00:30:13', '04:30:13'),
(3, '2023-08-18', '2023-08-18', 3, 3, 13513, 2, '20:30:31', '00:30:31'),
(4, '2023-08-18', '2023-08-18', 1, 1, 165416000, 2, '06:33:28', '09:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `modelo` text NOT NULL,
  `capacidad` int(11) NOT NULL,
  `tipo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `modelo`, `capacidad`, `tipo`) VALUES
(1, 'marcopolo g8', 46, 'semi-cama'),
(2, 'volvo 9800', 36, 'cama'),
(3, 'marcopolo g7', 32, 'ejecutivo'),
(4, 'mercedes travego 15', 48, 'cama');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `pasaje_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `pasaje_id`, `cliente_id`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 1, 3),
(4, 3, 3),
(5, 3, 2),
(7, 1, 2),
(8, 1, 1),
(13, 1, 1),
(14, 1, 1),
(15, 1, 1),
(16, 1, 1),
(17, 1, 1),
(18, 1, 8),
(19, 1, 9),
(20, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indexes for table `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`) USING HASH;

--
-- Indexes for table `origen`
--
ALTER TABLE `origen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`) USING HASH;

--
-- Indexes for table `pasajes`
--
ALTER TABLE `pasajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `origen_id` (`origen_id`),
  ADD KEY `destino_id` (`destino_id`),
  ADD KEY `vehiculo_id` (`vehiculo_id`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `pasaje_id` (`pasaje_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `destino`
--
ALTER TABLE `destino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `origen`
--
ALTER TABLE `origen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasajes`
--
ALTER TABLE `pasajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pasajes`
--
ALTER TABLE `pasajes`
  ADD CONSTRAINT `destino_id` FOREIGN KEY (`destino_id`) REFERENCES `destino` (`id`),
  ADD CONSTRAINT `origen_id` FOREIGN KEY (`origen_id`) REFERENCES `origen` (`id`),
  ADD CONSTRAINT `vehiculo_id` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pasaje_id` FOREIGN KEY (`pasaje_id`) REFERENCES `pasajes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
