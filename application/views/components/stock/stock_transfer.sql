-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2021 at 12:21 AM
-- Server version: 10.3.28-MariaDB-log-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wwwdorkarshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subcategory` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `unit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `godown_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `godown_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_transfer`
--

INSERT INTO `stock_transfer` (`id`, `date`, `code`, `name`, `product_model`, `product_serial`, `category`, `subcategory`, `quantity`, `unit`, `purchase_price`, `sell_price`, `godown_from`, `godown_code`, `type`) VALUES
(1, '2020-10-25', '2334', '', 'TESTER', '', 'stationary', 'stationary', '8', 'Pcs', 18.00, 30.00, '0001', '0002', NULL),
(2, '2020-10-26', '2334', '', 'TESTER', '', 'stationary', 'stationary', '1', 'Pcs', 18.00, 30.00, '0002', '0001', NULL),
(3, '2020-10-26', '2334', '', 'TESTER', '', 'stationary', 'stationary', '7', 'Pcs', 18.00, 30.00, '0002', '0001', NULL),
(4, '2020-11-04', '1294', '', 'WINNER PENGUIN FLASK', '', 'household_plastic', 'Flask/vacuum_flask', '2', 'Pcs', 314.00, 0.00, '0002', '0001', NULL),
(5, '2020-11-04', '2381', '', 'ELEGANT FLASK 500ML', '', 'household_hardware', 'Flask/vacuum_flask', '1', 'Pcs', 200.00, 260.00, '0002', '0001', NULL),
(6, '2020-11-04', '2377', '', 'VACUUM FLASK 500ML/0.5L', '', 'household_hardware', 'Flask/vacuum_flask', '1', 'Pcs', 185.00, 240.00, '0002', '0001', NULL),
(7, '2020-11-04', '1293', '', 'HEATER JUG', '', 'electronics', 'Kettle', '5', 'Pcs', 125.52, 160.00, '0002', '0001', NULL),
(8, '2020-11-04', '1551', '', 'VISION KETTLE 1.8L VIS-EK-005,823448/SS', '', 'electronics', 'Kettle', '4', 'Pcs', 663.00, 850.00, '0002', '0001', NULL),
(9, '2020-11-07', '1294', '', 'WINNER PENGUIN FLASK', '', 'household_plastic', 'Flask/vacuum_flask', '2', 'Pcs', 314.00, 0.00, '0002', '0001', NULL),
(10, '2020-11-09', '2482', '', 'BALLOON TK5', '', 'stationary', 'stationary', '20', 'Pcs', 3.25, 5.00, '0002', '0001', NULL),
(11, '2020-11-09', '2483', '', 'BALLOON TK2', '', 'stationary', 'stationary', '400', 'Pcs', 0.70, 2.00, '0002', '0001', NULL),
(12, '2020-11-28', '2482', '', 'BALLOON TK5', '', 'stationary', 'stationary', '20', 'Pcs', 3.25, 5.00, '0002', '0001', NULL),
(13, '2020-12-12', '2309', '', 'SUNLITE BATTERY REMOTE TYPE AAA 2PCS SET', '', 'stationary', 'stationary', '4', 'Pcs', 18.00, 25.00, '0001', '0002', NULL),
(14, '2020-12-12', '2568', '', '3G PENCIL BATTERY AA TK10', '', 'electronics', 'stationary', '8', 'Pcs', 7.10, 10.00, '0001', '0002', NULL),
(15, '2020-12-15', '2498', '', 'ONE TIME LUNCH BOX', '', 'household_plastic', 'household_plastic', '500', 'Pcs', 2.86, 5.00, '0002', '0001', NULL),
(16, '2020-12-30', '1294', '', 'WINNER PENGUIN FLASK', '', 'household_plastic', 'Flask/vacuum_flask', '1', 'Pcs', 314.20, 0.00, '0002', '0001', NULL),
(17, '2020-12-30', '2382', '', 'THERMO FLASK 500ML/0.5L', '', 'household_hardware', 'Flask/vacuum_flask', '1', 'Pcs', 315.00, 395.00, '0002', '0001', NULL),
(18, '2020-12-30', '2376', '', 'VACUUM FLASK 1L', '', 'household_hardware', 'Flask/vacuum_flask', '1', 'Pcs', 255.00, 335.00, '0002', '0001', NULL),
(19, '2020-12-30', '1294', '', 'WINNER PENGUIN FLASK', '', 'household_plastic', 'Flask/vacuum_flask', '1', 'Pcs', 314.20, 0.00, '0002', '0001', NULL),
(20, '2021-01-03', '2377', '', 'VACUUM FLASK 500ML/0.5L', '', 'household_hardware', 'Flask/vacuum_flask', '3', 'Pcs', 191.67, 240.00, '0002', '0001', NULL),
(21, '2021-01-21', '1293', '', 'HEATER JUG', '', 'electronics', 'Kettle', '3', 'Pcs', 125.52, 160.00, '0002', '0001', NULL),
(22, '2021-01-29', '2689', '', 'sofa set playing', '', 'stationary', 'GAMING/PLAYING_ITEM', '2', 'Pcs', 105.00, 205.00, '0002', '0001', NULL),
(23, '2021-01-29', '2689', '', 'sofa set playing', '', 'stationary', 'GAMING/PLAYING_ITEM', '2', 'Pcs', 105.00, 205.00, '0002', '0001', NULL),
(24, '2021-01-29', '1672', '', 'DIZZY TRUCK -SMALL WITH POCKET', '', 'household_plastic', 'household_plastic', '1', 'Pcs', 69.71, 0.00, '0002', '0001', NULL),
(25, '2021-02-20', '2697', '', 'SD GOLD TORCH LIGHT 8676A', '', 'electronics', 'stationary', '1', 'Pcs', 135.00, 250.00, '0001', '0002', NULL),
(26, '2021-03-12', '1888', '', 'LUXURY LED 15W 2 YEARS GUARNTEE', '', 'electric', 'SOCKET/SWITCH/HOLDER_ETC', '2', 'Pcs', 170.00, 330.00, '0001', '0002', NULL),
(27, '2021-03-12', '1889', '', 'LUXURY LED 7W 2 YEARS GUARNTEE', '', 'electric', 'SOCKET/SWITCH/HOLDER_ETC', '1', 'Pcs', 110.00, 295.00, '0001', '0002', NULL),
(28, '2021-03-12', '1886', '', 'SUPER STAR EMERGENCY LAMP AC/DC 12W', '', 'electric', 'SOCKET/SWITCH/HOLDER_ETC', '1', 'Pcs', 440.00, 600.00, '0001', '0002', NULL),
(29, '2021-03-12', '2306', '', 'DIM LIGHT ALL', '', 'stationary', 'stationary', '1', 'Pcs', 12.00, 25.00, '0001', '0002', NULL),
(30, '2021-03-12', '1888', '', 'LUXURY LED 15W 2 YEARS GUARNTEE', '', 'electric', 'SOCKET/SWITCH/HOLDER_ETC', '2', 'Pcs', 170.00, 330.00, '0001', '0002', NULL),
(31, '2021-03-13', '2322', '', 'PENCIL BATTERY /TK10 battery AA SIZE SUNLITE', '', 'mobile_&_mobile_accesories', 'WALL_CLOCK', '10', 'Pcs', 8.06, 12.00, '0001', '0002', NULL),
(32, '2021-03-14', '2140', '', 'Supermoon Mosquito Bat SM8865', '', 'stationary', 'stationary', '1', 'Pcs', 290.00, 390.00, '0001', '0002', NULL),
(33, '2021-03-15', '2416', '', 'test prod', '', 'household_hardware', 'RECHARGE_CARD', '2', 'Pcs', 10.00, 15.00, '0001', '0002', NULL),
(34, '2021-03-17', '2687', '', 'power bekko 8020 playing', '', 'stationary', 'GAMING/PLAYING_ITEM', '2', 'Pcs', 104.00, 200.00, '0001', '0002', NULL),
(35, '2021-03-17', '2686', '', 'power truck 325 playing', '', 'stationary', 'GAMING/PLAYING_ITEM', '1', 'Pcs', 84.00, 180.00, '0001', '0002', NULL),
(36, '2021-03-17', '1293', '', 'HEATER JUG', '', 'electronics', 'Kettle', '2', 'Pcs', 125.52, 160.00, '0002', '0001', NULL),
(37, '2021-03-17', '1294', '', 'WINNER PENGUIN FLASK', '', 'household_plastic', 'Flask/vacuum_flask', '2', 'Pcs', 315.50, 410.00, '0002', '0001', NULL),
(38, '2021-03-17', '1551', '', 'VISION KETTLE 1.8L VIS-EK-005,823448/SS', '', 'electronics', 'Kettle', '2', 'Pcs', 662.54, 850.00, '0002', '0001', NULL),
(39, '2021-03-19', '2021', '', 'GOODLUCK STAR /GOLD PENCIL/TK10 PENCIL', '', 'stationary', 'stationary', '20', 'Pcs', 5.98, 10.00, '0001', '0002', NULL),
(40, '2021-03-19', '2322', '', 'PENCIL BATTERY /TK10 battery AA SIZE SUNLITE', '', 'mobile_&_mobile_accesories', 'WALL_CLOCK', '20', 'Pcs', 8.06, 12.00, '0001', '0002', NULL),
(41, '2021-03-29', '1606', '', 'HANDY BABY FEEDING BOTTLE 120L FEEDER', '', 'household_plastic', 'household_plastic', '2', 'Pcs', 62.27, 75.00, '0002', '0001', NULL),
(42, '2021-03-29', '1606', '', 'HANDY BABY FEEDING BOTTLE 120L FEEDER', '', 'household_plastic', 'household_plastic', '2', 'Pcs', 62.27, 75.00, '0002', '0001', NULL),
(43, '2021-03-29', '1606', '', 'HANDY BABY FEEDING BOTTLE 120L FEEDER', '', 'household_plastic', 'household_plastic', '2', 'Pcs', 62.27, 75.00, '0002', '0001', NULL),
(44, '2021-04-02', '2599', '', 'TABLE LAMP SM9723/7674/9614', '', 'electronics', 'Accessories', '1', 'Pcs', 560.00, 700.00, '0001', '0002', NULL),
(45, '2021-04-20', '2037', '', 'JOYKALY RECHAREABLE EMERENCY LIGHT YG-7972', '', 'stationary', 'stationary', '1', 'Pcs', 140.00, 200.00, '0001', '0002', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `godown_code` (`godown_code`),
  ADD KEY `name` (`name`),
  ADD KEY `product_model` (`product_model`),
  ADD KEY `product_serial` (`product_serial`),
  ADD KEY `type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
