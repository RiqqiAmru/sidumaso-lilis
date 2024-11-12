-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 07:07 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidumaso`
--

-- --------------------------------------------------------

--
-- Table structure for table `sarans`
--

CREATE TABLE `sarans` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `saran` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sarans`
--

INSERT INTO `sarans` (`id`, `nama`, `no_hp`, `saran`, `created_at`) VALUES
(1, 'Lilis', '09877', 'Tolong dipercepat', '2024-10-21 08:24:40'),
(2, 'asdasda', 'adsfasfasfasfas', 'asfasfa', '2024-10-23 00:44:40'),
(3, 'Lilis', '082918191899', 'Ini isi sarannya', '2024-10-23 07:47:55'),
(4, 'fara', '09877', 'hei', '2024-10-23 07:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_ktp` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Kepala_dusun','Masyarakat') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `row_status` enum('Menunggu','Aktif','Non-aktif') DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `username`, `no_hp`, `password`, `user_ktp`, `role`, `created_at`, `updated_at`, `deleted_at`, `row_status`) VALUES
(1, 'LILIS ROYANI', 'wert', '09089098909', '$2y$10$k97XnGH7izfQGrirU82sle8Mle1ZBh/8FFSxrRVB2CpcEYDRsMTDS', '1729653446_7317f5335b371170b939.png', 'Admin', '2024-10-23 03:17:26', '2024-10-23 03:17:26', NULL, 'Menunggu'),
(2, 'FELISA', 'felisa', '09876543211', '$2y$10$0BaXdCbR1snz2el45z4dWuIoUkcJGyyFuvB5hTHgOxEcCmMX1rZw6', '1729653555_31c57a2ab1bc87219e87.png', 'Admin', '2024-10-23 03:19:16', '2024-10-23 03:19:16', NULL, 'Menunggu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sarans`
--
ALTER TABLE `sarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sarans`
--
ALTER TABLE `sarans`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
