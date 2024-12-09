-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 03:22 PM
-- Server version: 8.0.40-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawancovid`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL,
  `nama_department` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `nama_department`) VALUES
(5, 'FINANCE'),
(6, 'MARKETING'),
(7, 'IT'),
(8, 'PRODUKSI'),
(9, 'PURCHASING'),
(13, 'PPIC'),
(22, 'QUALITY'),
(60, 'TEST B'),
(63, 'LOGISTIK');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` varchar(9) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `kota_tinggal` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `id_department` int DEFAULT NULL,
  `kota_penempatan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `no_ktp`, `telp`, `kota_tinggal`, `tanggal_lahir`, `tanggal_masuk`, `id_department`, `kota_penempatan`) VALUES
('241201', 'John Doe', '3505180311000001', '081254789901', 'Blitar', '1998-08-16', '2023-12-03', 7, 'Surabaya'),
('241202', 'Sugeng', '3505180344770002', '081254678839', 'Malang', '1999-08-18', '2020-01-24', 6, 'Surabaya'),
('241203', 'Agus Sumaji', '3505180311000012', '081254789953', 'Pasuruan', '1998-08-16', '2023-12-03', 7, 'Surabaya'),
('241204', 'Mujianto', '3505180311000027', '081254789932', 'Magelang', '1998-12-17', '2023-12-03', 5, 'Surabaya'),
('241205', 'Mujianti', '3505180311000027', '081254789932', 'Malang', '1998-11-12', '2023-12-03', 9, 'Surabaya'),
('241206', 'Andi Sulaiman', '35041389000001', '081254678894', 'Jakarta', '1990-01-15', '2020-06-10', 5, 'Surabaya'),
('241207', 'Budi Setiawan', '35041389000002', '081254678895', 'Surabaya', '1985-03-22', '2018-07-05', 6, 'Malang'),
('241208', 'Citra Wulandari', '35041389000003', '081254678896', 'Yogyakarta', '1992-05-30', '2021-05-10', 6, 'Malang'),
('241209', 'Dwi Prasetyo', '35041389000004', '081254678897', 'Malang', '1988-12-15', '2019-08-25', 8, 'Malang'),
('241210', 'Eka Purnama', '35041389000005', '081254678898', 'Surabaya', '1994-12-28', '2022-01-18', 6, 'Malang'),
('241211', 'Fajar Hadi', '35041389000006', '081254678899', 'Jakarta', '1987-02-14', '2017-09-10', 6, 'Malang'),
('241212', 'Gita Rahayu', '35041389000007', '081254678890', 'Medan', '1995-07-28', '2023-03-21', 6, 'Malang'),
('241213', 'Didik Margono', '35051783990002', '081254678842', 'Blitar', '1998-12-03', '2021-02-08', 8, 'Malang'),
('241216', 'M. Yuda Setiawa', '3505180311000021', '081254678894', 'Malang', '1998-11-08', '2022-08-21', 6, 'Malang'),
('241217', 'Riski Setiawan', '3505180311000021', '081254678894', 'Malang', '1998-11-08', '2022-08-21', 6, 'Malang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_department` (`id_department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
