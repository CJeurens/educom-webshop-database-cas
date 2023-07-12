-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 03:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `order_id`, `user_id`, `product_id`, `units`) VALUES
(1, 3, 3, 6, 1),
(2, 3, 3, 7, 3),
(3, 4, 3, 4, 1),
(4, 5, 1, 1, 4),
(5, 6, 1, 3, 1),
(6, 7, 1, 4, 3),
(7, 7, 1, 19, 4),
(8, 7, 1, 41, 2),
(9, 8, 1, 4, 2),
(10, 8, 1, 14, 3),
(11, 9, 1, 3, 1),
(12, 10, 1, 4, 1),
(13, 11, 1, 3, 1),
(14, 12, 1, 3, 1),
(15, 13, 1, 0, 0),
(16, 13, 1, 4, 1),
(17, 14, 1, 3, 3),
(18, 15, 1, 12, 1),
(19, 15, 1, 4, 1),
(20, 15, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `status`) VALUES
(1, '3', '2023-07-12', 'new'),
(2, '3', '2023-07-12', 'new'),
(3, '3', '2023-07-12', 'new'),
(4, '3', '2023-07-12', 'new'),
(5, '1', '2023-07-12', 'new'),
(6, '1', '2023-07-12', 'new'),
(7, '1', '2023-07-12', 'new'),
(8, '1', '2023-07-12', 'new'),
(9, '1', '2023-07-12', 'new'),
(10, '1', '2023-07-12', 'new'),
(11, '1', '2023-07-12', 'new'),
(12, '1', '2023-07-12', 'new'),
(13, '1', '2023-07-12', 'new'),
(14, '1', '2023-07-12', 'new'),
(15, '1', '2023-07-12', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(16) NOT NULL,
  `imgurl` varchar(128) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `unitprice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `imgurl`, `name`, `unitprice`) VALUES
(1, 'Images/thumbs/K.K._March_NH_Texture.png', 'K.K. March', 13.99),
(2, 'Images/thumbs/K.K._Waltz_NH_Texture.png', 'K.K. Waltz', 11.99),
(3, 'Images/thumbs/K.K._Swing_NH_Texture.png', 'K.K. Swing', 9.99),
(4, 'Images/thumbs/K.K._Jazz_NH_Texture.png', 'K.K. Jazz', 9.99),
(5, 'Images/thumbs/K.K._Fusion_NH_Texture.png', 'K.K. Fusion', 9.99),
(6, 'Images/thumbs/K.K._Étude_NH_Texture.png', 'K.K. Étude', 13.99),
(7, 'Images/thumbs/K.K._Lullaby_NH_Texture.png', 'K.K. Lullaby', 11.49),
(8, 'Images/thumbs/K.K._Aria_NH_Texture.png', 'K.K. Aria', 13.49),
(9, 'Images/thumbs/K.K._Samba_NH_Texture.png', 'K.K. Samba', 11.99),
(10, 'Images/thumbs/K.K._Bossa_NH_Texture.png', 'K.K. Bossa', 9.99),
(11, 'Images/thumbs/K.K._Calypso_NH_Texture.png', 'K.K. Calypso', 13.99),
(12, 'Images/thumbs/K.K._Salsa_NH_Texture.png', 'K.K. Salsa', 11.99),
(13, 'Images/thumbs/K.K._Mambo_NH_Texture.png', 'K.K. Mambo', 12.99),
(14, 'Images/thumbs/K.K._Reggae_NH_Texture.png', 'K.K. Reggae', 12.99),
(15, 'Images/thumbs/K.K._Ska_NH_Texture.png', 'K.K. Ska', 9.49),
(16, 'Images/thumbs/K.K._Tango_NH_Texture.png', 'K.K. Tango', 11.99),
(17, 'Images/thumbs/K.K._Faire_NH_Texture.png', 'K.K. Faire', 10.49),
(18, 'Images/thumbs/Aloha_K.K._NH_Texture.png', 'Aloha K.K.', 13.99),
(19, 'Images/thumbs/Lucky_K.K._NH_Texture.png', 'Lucky K.K.', 12.99),
(20, 'Images/thumbs/K.K._Condor_NH_Texture.png', 'K.K. Condor', 13.49),
(21, 'Images/thumbs/K.K._Steppe_NH_Texture.png', 'K.K. Steppe', 11.99),
(22, 'Images/thumbs/Imperial_K.K._NH_Texture.png', 'Imperial K.K.', 13.99),
(23, 'Images/thumbs/K.K._Casbah_NH_Texture.png', 'K.K. Casbah', 13.49),
(24, 'Images/thumbs/K.K._Safari_NH_Texture.png', 'K.K. Safari', 13.49),
(25, 'Images/thumbs/K.K._Folk_NH_Texture.png', 'K.K. Folk', 12.99),
(26, 'Images/thumbs/K.K._Rock_NH_Texture.png', 'K.K. Rock', 11.99),
(27, 'Images/thumbs/Rockin\'_K.K._NH_Texture.png', 'Rockin\' K.K.', 13.99),
(28, 'Images/thumbs/K.K._Ragtime_NH_Texture.png', 'K.K. Ragtime', 13.49),
(29, 'Images/thumbs/K.K._Gumbo_NH_Texture.png', 'K.K. Gumbo', 11.99),
(30, 'Images/thumbs/The_K._Funk_NH_Texture.png', 'The K. Funk', 9.99),
(31, 'Images/thumbs/K.K._Blues_NH_Texture.png', 'K.K. Blues', 10.99),
(32, 'Images/thumbs/Soulful_K.K._NH_Texture.png', 'Soulful K.K.', 10.99),
(33, 'Images/thumbs/K.K._Soul_NH_Texture.png', 'K.K. Soul', 12.99),
(34, 'Images/thumbs/K.K._Cruisin\'_NH_Texture.png', 'K.K. Cruisin\'', 9.99),
(35, 'Images/thumbs/K.K._Love_Song_NH_Texture.png', 'K.K. Love Song', 13.99),
(36, 'Images/thumbs/K.K._D&B_NH_Texture.png', 'K.K. D&B', 12.99),
(37, 'Images/thumbs/K.K._Technopop_NH_Texture.png', 'K.K. Technopop', 10.99),
(38, 'Images/thumbs/DJ_K.K._NH_Texture.png', 'DJ K.K.', 13.49),
(39, 'Images/thumbs/Only_Me_NH_Texture.png', 'Only Me', 11.99),
(40, 'Images/thumbs/K.K._Country_NH_Texture.png', 'K.K. Country', 10.99),
(41, 'Images/thumbs/Surfin\'_K.K._NH_Texture.png', 'Surfin\' K.K.', 13.99),
(42, 'Images/thumbs/K.K._Ballad_NH_Texture.png', 'K.K. Ballad', 13.49),
(43, 'Images/thumbs/Comrade_K.K._NH_Texture.png', 'Comrade K.K.', 13.49),
(44, 'Images/thumbs/K.K._Lament_NH_Texture.png', 'K.K. Lament', 13.99),
(45, 'Images/thumbs/Go_K.K._Rider_NH_Texture.png', 'Go K.K. Rider', 13.99),
(46, 'Images/thumbs/K.K._Dirge_NH_Texture.png', 'K.K. Dirge', 13.49),
(47, 'Images/thumbs/K.K._Western_NH_Texture.png', 'K.K. Western', 13.49),
(48, 'Images/thumbs/Mr._K.K._NH_Texture.png', 'Mr. K.K.', 13.99),
(49, 'Images/thumbs/Café_K.K._NH_Texture.png', 'Café K.K.', 11.99),
(50, 'Images/thumbs/K.K._Parade_NH_Texture.png', 'K.K. Parade', 10.99),
(51, 'Images/thumbs/K.K._Mariachi_NH_Texture.png', 'K.K. Mariachi', 10.99),
(52, 'Images/thumbs/K.K._Song_NH_Texture.png', 'K.K. Song', 13.49),
(53, 'Images/thumbs/I_Love_You_NH_Texture.png', 'I Love You', 13.49),
(54, 'Images/thumbs/Two_Days_Ago_NH_Texture.png', 'Two Days Ago', 12.99),
(55, 'Images/thumbs/My_Place_NH_Texture.png', 'My Place', 12.99),
(56, 'Images/thumbs/Forest_Life_NH_Texture.png', 'Forest Life', 12.99),
(57, 'Images/thumbs/To_The_Edge_NH_Texture.png', 'To The Edge', 12.99),
(58, 'Images/thumbs/Pondering_NH_Texture.png', 'Pondering', 13.49),
(59, 'Images/thumbs/K.K._Dixie_NH_Texture.png', 'K.K. Dixie', 10.99),
(60, 'Images/thumbs/K.K._Marathon_NH_Texture.png', 'K.K. Marathon', 12.49),
(61, 'Images/thumbs/King_K.K._NH_Texture.png', 'King K.K.', 13.49),
(62, 'Images/thumbs/Mountain_Song_NH_Texture.png', 'Mountain Song', 10.49),
(63, 'Images/thumbs/Marine_Song_2001_NH_Texture.png', 'Marine Song 2001', 13.49),
(64, 'Images/thumbs/Neapolitan_NH_Texture.png', 'Neapolitan', 13.49),
(65, 'Images/thumbs/Steep_Hill_NH_Texture.png', 'Steep Hill', 12.99),
(66, 'Images/thumbs/K.K._Rockabilly_NH_Texture.png', 'K.K. Rockabilly', 13.49),
(67, 'Images/thumbs/Agent_K.K._NH_Texture.png', 'Agent K.K.', 13.99),
(68, 'Images/thumbs/K.K._Rally_NH_Texture.png', 'K.K. Rally', 12.99),
(69, 'Images/thumbs/K.K._Metal_NH_Texture.png', 'K.K. Metal', 10.49),
(70, 'Images/thumbs/Stale_Cupcakes_NH_Texture.png', 'Stale Cupcakes', 12.99),
(71, 'Images/thumbs/Spring_Blossoms_NH_Texture.png', 'Spring Blossoms', 10.99),
(72, 'Images/thumbs/Wandering_NH_Texture.png', 'Wandering', 13.99),
(73, 'Images/thumbs/K.K._House_NH_Texture.png', 'K.K. House', 13.99),
(74, 'Images/thumbs/K.K._Sonata_NH_Texture.png', 'K.K. Sonata', 10.99),
(75, 'Images/thumbs/Hypno_K.K._NH_Texture.png', 'Hypno K.K.', 13.49),
(76, 'Images/thumbs/K.K._Stroll_NH_Texture.png', 'K.K. Stroll', 12.99),
(77, 'Images/thumbs/K.K._Island_NH_Texture.png', 'K.K. Island', 11.99),
(78, 'Images/thumbs/Space_K.K._NH_Texture.png', 'Space K.K.', 10.49),
(79, 'Images/thumbs/K.K._Adventure_NH_Texture.png', 'K.K. Adventure', 12.99),
(80, 'Images/thumbs/K.K._Oasis_NH_Texture.png', 'K.K. Oasis', 12.49),
(81, 'Images/thumbs/K.K._Bazaar_NH_Texture.png', 'K.K. Bazaar', 11.99),
(82, 'Images/thumbs/K.K._Milonga_NH_Texture.png', 'K.K. Milonga', 10.99),
(83, 'Images/thumbs/K.K._Groove_NH_Texture.png', 'K.K. Groove', 9.99),
(84, 'Images/thumbs/K.K._Jongara_NH_Texture.png', 'K.K. Jongara', 12.99),
(85, 'Images/thumbs/K.K._Flamenco_NH_Texture.png', 'K.K. Flamenco', 11.99),
(86, 'Images/thumbs/K.K._Moody_NH_Texture.png', 'K.K. Moody', 10.99),
(87, 'Images/thumbs/Bubblegum_K.K._NH_Texture.png', 'Bubblegum K.K.', 13.99),
(88, 'Images/thumbs/K.K._Synth_NH_Texture.png', 'K.K. Synth', 12.99),
(89, 'Images/thumbs/K.K._Disco_NH_Texture.png', 'K.K. Disco', 13.99),
(90, 'Images/thumbs/K.K._Birthday_NH_Texture.png', 'K.K. Birthday', 13.99),
(91, 'Images/thumbs/Animal_City_NH_Texture.png', 'Animal City', 13.99),
(92, 'Images/thumbs/Drivin\'_NH_Texture.png', 'Drivin\'', 9.99),
(93, 'Images/thumbs/Farewell_NH_Texture.png', 'Farewell', 13.99),
(94, 'Images/thumbs/Welcome_Horizons_NH_Texture.png', 'Welcome Horizons', 13.99),
(95, 'Images/thumbs/K.K._Fugue_NH_Texture.png', 'K.K. Fugue', 13.99),
(96, 'Images/thumbs/K.K._Polka_NH_Texture.png', 'K.K. Polka', 11.99),
(97, 'Images/thumbs/K.K._Slack-Key_NH_Texture.png', 'K.K. Slack-Key', 11.99),
(98, 'Images/thumbs/K.K._Chorinho_NH_Texture.png', 'K.K. Chorinho', 13.99),
(99, 'Images/thumbs/Chillwave_NH_Texture.png', 'Chillwave', 13.99),
(100, 'Images/thumbs/K.K._Dub_NH_Texture.png', 'K.K. Dub', 13.99),
(101, 'Images/thumbs/K.K._Lovers_NH_Texture.png', 'K.K. Lovers', 13.99),
(102, 'Images/thumbs/K.K._Bashment_NH_Texture.png', 'K.K. Bashment', 13.99),
(103, 'Images/thumbs/K.K._Hop_NH_Texture.png', 'K.K. Hop', 9.99),
(104, 'Images/thumbs/K.K._Break_NH_Texture.png', 'K.K. Break', 13.99),
(105, 'Images/thumbs/K.K._Khoomei_NH_Texture.png', 'K.K. Khoomei', 11.99),
(106, 'Images/thumbs/K.K._Robot_Synth_NH_Texture.png', 'K.K. Robot Synth', 13.99),
(107, 'Images/thumbs/K.K._Chorale_NH_Texture.png', 'K.K. Chorale', 11.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
