-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2024 at 04:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ndrshoop`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_input_service`
--

CREATE TABLE `dashboard_input_service` (
  `id` int NOT NULL,
  `kategori_service` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ket_service` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kontak_service` varchar(15) NOT NULL,
  `gambar` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dashboard_input_service`
--

INSERT INTO `dashboard_input_service` (`id`, `kategori_service`, `ket_service`, `kontak_service`, `gambar`) VALUES
(28, 'Payment Method', 'Metode pembayaran online mau pun oflline', '271874634383', '65e4530f7039c.jpg'),
(29, 'Free Delivery', 'Gratis Ongkir di wilayah Kabupaten karimun', '081275669055', '65e453622fcb7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `input_alamat`
--

CREATE TABLE `input_alamat` (
  `id` int NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `url_alamat` varchar(300) NOT NULL,
  `gambar_alamat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `input_alamat`
--

INSERT INTO `input_alamat` (`id`, `alamat`, `url_alamat`, `gambar_alamat`) VALUES
(5, '2C6G+8XJ, Jl. MT. Haryono, Kapling, Kec. Tebing, Kabupaten Karimun, Kepulauan Riau 29663', 'https://maps.app.goo.gl/Jq7SnqAaXzFstQN49', '65e9a6c9a67cb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `input_kontak`
--

CREATE TABLE `input_kontak` (
  `id` int NOT NULL,
  `nomor_wa` varchar(15) NOT NULL,
  `nama_kontak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `input_kontak`
--

INSERT INTO `input_kontak` (`id`, `nomor_wa`, `nama_kontak`) VALUES
(14, '6281275669055', 'Adi supiansyah');

-- --------------------------------------------------------

--
-- Table structure for table `logo_hero`
--

CREATE TABLE `logo_hero` (
  `id` int NOT NULL,
  `logo` varchar(200) NOT NULL,
  `nama_logo` varchar(200) NOT NULL,
  `ket_company` varchar(200) NOT NULL,
  `gambar_profil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `logo_hero`
--

INSERT INTO `logo_hero` (`id`, `logo`, `nama_logo`, `ket_company`, `gambar_profil`) VALUES
(18, '65e89ded6d113.png', 'Retri Taylor', 'Produk berkualitas, nyaman dan murah', '65e89ded6e68e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `price`) VALUES
(46, 'Baju Distro Pria', '65e2c019f3725.jpg', '45000'),
(49, 'Kemeja Flanel ', '65e2c32b1a557.jpg', '70000'),
(50, 'Kaos Pendek Eiger', '65e2c3725ce1d.jpg', '150000'),
(51, 'T-shirt Timberland', '65e2c49ea9e57.jpg', '315000'),
(52, 'T-shirt Erigo 330s', '65e2c6beeaebc.jpg', '100000'),
(53, 'Jacket Semi Parka', '65e2c830d1c95.jpg', '100000'),
(54, 'Chinos Premium', '65e7a9d93b1ee.jpg', '120000'),
(55, 'Jaket Coach Erigo', '65e8844fadf18.jpg', '120000'),
(71, 'Sepatu All Star Grey', '65ebe94ca6316.jpg', '120000'),
(72, 'Sepatu Ventela Basic low', '65ebe96957569.jpg', '120000'),
(73, 'kemeja coklat', '65ebea2f5592d.jpg', '120000'),
(74, 'Kemeja Flanel', '65ebea74abb06.jpg', '110000');

-- --------------------------------------------------------

--
-- Table structure for table `tbkomentar`
--

CREATE TABLE `tbkomentar` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `komentar` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gambar_komentar` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbkomentar`
--

INSERT INTO `tbkomentar` (`id`, `nama`, `komentar`, `kategori`, `gambar_komentar`, `rating`) VALUES
(57, 'tster', 'keren', 'Jacket Cosch', '65ebd80d46ecc.jpg', '★★★'),
(58, 'andika', 'bahannya lembut', 'Chinos premium', '65ebd8d250710.jpg', '★★'),
(59, 'Andika', 'Ngoding lur', 'Ex', '65ebdadccd485.jpg', '★★★★★'),
(60, 'Kartika putri', 'Kualitias bahannya sangat cantik2 di toko ini', 'Semua produk', '65ebdc39ed859.jpeg', '★★★★★'),
(63, 'Pian', 'Lu bisa backend lu punya kuasa💪', 'Coding PHP', '65ebddba19516.jpg', '★★★★'),
(64, 'Andika', 'Terlalu bnyak koyak koyak', 'Baju seken', '65ebde418e1ba.jpeg', '★★★★'),
(65, 'aca', 'bagus baju nya', 'all', '65ebde5eadcd8.png', '★★★★★'),
(69, 'ad', 'ad', '12', '65ebe22065c73.jpg', '★★'),
(70, 'jelita', 'baguss baguss ', 'baju ', '65ebe75753d0f.jpeg', '★★★★★'),
(71, 'Mokhammad Syaiful Rohman', 'Barang bagus', 'Customer', '65ebe7df33bc6.jpeg', '★★★★★'),
(72, 'Anonim ', 'Good👍', 'Cust', '65ebeaa162fb6.jpg', '★★★★★');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(27, 'nurul', '$2y$10$3oEwFocdTHDAhzlnr0/gC.sruGfpGBVlUy87yw4avm0qlTbra5dbO'),
(28, 'andika ', '$2y$10$3RiW7yxhVwB9RX/FzV1r0eq7G9kxw/qK6Y8JjdT55VunDN2KRfp/u'),
(29, 'adi', '$2y$10$fh.C66hOnFFL8OakSuxOO.LIm81FtcC6BOAlL3ESC3fwkBwz4vbS2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashboard_input_service`
--
ALTER TABLE `dashboard_input_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `input_alamat`
--
ALTER TABLE `input_alamat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `input_kontak`
--
ALTER TABLE `input_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_hero`
--
ALTER TABLE `logo_hero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashboard_input_service`
--
ALTER TABLE `dashboard_input_service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `input_alamat`
--
ALTER TABLE `input_alamat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `input_kontak`
--
ALTER TABLE `input_kontak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `logo_hero`
--
ALTER TABLE `logo_hero`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
