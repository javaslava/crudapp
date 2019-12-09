-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2019 at 02:08 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_app`
--
CREATE DATABASE IF NOT EXISTS `crud_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `crud_app`;

-- --------------------------------------------------------

--
-- Table structure for table `auto_data`
--

CREATE TABLE `auto_data` (
  `auto_id` int(9) NOT NULL,
  `vin_nr` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_nr` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufact_year` int(4) DEFAULT NULL,
  `brand_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auto_data`
--

INSERT INTO `auto_data` (`auto_id`, `vin_nr`, `reg_nr`, `manufact_year`, `brand_name`, `model_name`, `owner_id`) VALUES
(47, 'WVGZZZ1TZ8WO23825', 'MA7954', 2007, 'VW', 'TOURAN', 39),
(48, 'AUGZZZ1TZ8WO23825', 'AU7954', 2008, 'AUDI', 'Q7', 39),
(49, 'AUGZZZ1TZ8WO23800', 'AU7954', 2008, 'AUDI', '100', 39),
(50, 'AUGZZZ1TZ8WO238ZZ', 'AU7954', 2008, 'AUDI', 'ZZ', 39),
(51, 'AUGZZZ1TZ8WO238QU', 'AU7954', 2010, 'AUDI', 'QUATRO', 39),
(52, 'TOYOTA1TZ8WO238QU', 'RK7754', 2012, 'TOYOTA', 'RAV4', 40),
(53, 'TOYOTA1TZ8WO456QU', 'RK7755', 2013, 'TOYOTA', 'RAV4', 40),
(54, 'TOYOTA1TZ8CO456QU', 'RK7133', 2005, 'TOYOTA', 'COROLLA', 40),
(55, 'LAMB1TZ8CO456QU', 'AB45', 2015, 'LAMBORGINI', '7777', 41),
(56, 'FER1TZ8CO456QU', 'AB4545', 2015, 'FERRARI', 'DIABLO', 41),
(57, 'BUG1TZ8CO987QU', 'AB1111', 2016, 'BUGATTI', 'VERON', 41),
(58, 'ZAZ1TZ8CO987QU', 'AB666', 1965, 'ZAZ', 'ZHUK965', 41),
(59, 'MAZ1TZ8CO111VA', 'VA1111', 1985, 'MAZ', 'HYBRYD', 42),
(60, 'KAM1TZ8CO133VA', 'VA9999', 1990, 'KAMAZ', 'T34', 42),
(61, 'BELZ8CO666VA', 'VA9009', 1990, 'BELAZ', 'MONSTER', 42),
(62, 'WVZZZZ8CO666VA123', 'VT1234', 1999, 'VW', 'MULTIVAN', 43),
(63, 'WVZZZZ8CO666VA321', 'VT1235', 2007, 'VW', 'CARAVELLE', 43),
(64, 'WVZZZZ8CO666VA333', 'VT1236', 2008, 'VW', 'TUAREG', 43),
(65, 'WVZZZZ8CO666VA344', 'VT1237', 2008, 'VW', 'TUAREG', 43),
(66, 'WVZZZZ8CO666VA444', 'VT1237', 2010, 'VW', 'TOURAN', 43),
(67, 'WVZZZZ8CO666VA555', 'VT3237', 2010, 'VW', 'CAEFER', 43),
(68, 'WVZZZZ8CO666VA678', 'VT0023', 2011, 'VW', 'GOLF', 43),
(69, 'WVZZZZ8CO666VA987', 'VT0231', 2011, 'VW', 'CADDY', 43),
(70, 'BMZZZZ8CO673VA987', 'OS2222', 2016, 'BMW', 'X5', 44),
(71, 'BMZZZZ8CO673VA333', 'OS2223', 2016, 'BMW', 'X3', 44),
(72, 'BMZZZZ8CO673VA666', 'OS2224', 2015, 'BMW', 'X6', 44),
(73, 'ZILZZZ8CO673VA666', 'OS2224', 1976, 'ZIL', 'DIESEL', 44),
(74, 'RENLZZZ8REN73VA000', 'OS3334', 1999, 'RENAULT', 'TWINGO', 44),
(75, 'IKARZZZ8REN73VA001', 'OS4444', 2003, 'IKARUS', 'CRAFT', 44),
(76, 'OPZZZ83EN73VA031', 'OS4554', 2005, 'OPEL', 'ASTRA', 44),
(77, 'VWZZZ83EN73VA888', 'OS4566', 2007, 'VW', 'GOLF', 44),
(78, 'VWZZZ83EN73VA777', 'OS4577', 2009, 'VW', 'JETTA', 44),
(79, 'HYZZZ83EN73VA000', 'NI2873', 2011, 'HYNDAI', 'TUCSON', 45),
(80, 'POR83EN73VA000', 'NI6666', 2015, 'PORSCHE', 'DEVIL', 45),
(81, 'VOL83EN73VA000', 'SL6600', 2011, 'VOLVO', 'X70', 46),
(82, 'VOL83EN73VA111', 'SL1000', 2016, 'VOLVO', 'X60', 46),
(83, 'VOL83EN73VA11100', 'SL4851', 2007, 'VOLVO', 'V70', 46),
(84, 'AU83EN73VA111AU', 'SL4852', 2000, 'AUDI', 'A6', 46),
(85, 'AU83EN73VA222AU', 'SL4852', 2016, 'AUDI', 'A7', 46),
(86, 'BM83EN73VA333AU', 'SL4852', 2016, 'BMW', 'HYBRYD', 46);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(2, 'title', 'My CRUD App'),
(3, 'logo', 'CRUD App');

-- --------------------------------------------------------

--
-- Table structure for table `logo_slides`
--

CREATE TABLE `logo_slides` (
  `id` int(5) NOT NULL,
  `pict_src` varchar(255) DEFAULT NULL,
  `pict_width` int(5) DEFAULT NULL,
  `pict_height` int(5) DEFAULT NULL,
  `text` text NOT NULL,
  `visible` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `logo_slides`
--

INSERT INTO `logo_slides` (`id`, `pict_src`, `pict_width`, `pict_height`, `text`, `visible`) VALUES
(1, 'images/logo_slides/slide1.jpg', 704, 528, 'Коротко обо мне.\r\nЗвать меня Вячеслав. Мне 41 год. Женат уж как 15 лет. Две дочки наполняют жизнь разнообразием. ', 1),
(2, 'images/logo_slides/slide2.jpg', 704, 528, 'По профессии - столяр-мебельщик. С 1994 года по 2012 год целиком посвятил себя ремеслу. Большая часть моего творчества - проектирование, расчет и изготовление лестниц.', 1),
(3, 'images/logo_slides/slide3.jpg', 704, 528, 'Разработал собственную методику проектирования лестниц на основе тригонометрии, что позволило реализовать более 300 проектов. ', 1),
(4, 'images/logo_slides/slide4.jpg', 704, 528, 'Однако, с 2013 года сменил индивидуальное производство на массовое. 5 лет работал оператором CNC машины. Работа тесно связана с програмным кодом, но не столь интересна как работа с WEB.', 1),
(5, 'images/logo_slides/slide5.jpg', 704, 528, 'В то же время с нуля самостоятельно прогрызал HTML, CSS, PHP, MySQL. И вот это оказалось весьма увлекательным. В 2018 - 2019 прошел курсы по Java и базам данных в учебном центре Java_Guru.   ', 1),
(6, 'images/logo_slides/slide6.jpg', 704, 528, 'В настоящее время готов продолжать обучаться в выбранном направлении. Хотелось бы свои теоретические знания развивать на практике на основе реальных проектов. Что и является моей целью.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `owner_data`
--

CREATE TABLE `owner_data` (
  `owner_id` int(9) NOT NULL,
  `owner_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owner_data`
--

INSERT INTO `owner_data` (`owner_id`, `owner_name`, `owner_surname`, `owner_number`) VALUES
(39, 'VJACESLAVS', 'BOHANS', '06077811854'),
(40, 'ROMANS', 'KAIROVS', '07127711881'),
(41, 'AGNESE', 'BOHANE', '25052010654'),
(42, 'VANESA', 'BOHANE', '05020545271'),
(43, 'VLADIMIR', 'TARASOV', '27057311776'),
(44, 'OLGA', 'SERGEEVA', '22077911861'),
(45, 'NATALY', 'IVANOVA', '06050511835'),
(46, 'SERGIO', 'LEVITS', '22127611888'),
(49, 'PETR', 'ANITKO', '23046911956');

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Slava', 'bohanv@gmail.com', '1234'),
(26, 'Petr', 'petr@gmail.com', 'STORM'),
(31, 'Serg', 'serg@gmail.com', 'SERGIO'),
(32, 'Вячеслав', 'bohan@gmail.com', '1234'),
(33, 'Anatoliy', 'tolik@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_data`
--
ALTER TABLE `auto_data`
  ADD PRIMARY KEY (`auto_id`),
  ADD KEY `FK_owner_id` (`owner_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_slides`
--
ALTER TABLE `logo_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner_data`
--
ALTER TABLE `owner_data`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_data`
--
ALTER TABLE `auto_data`
  MODIFY `auto_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logo_slides`
--
ALTER TABLE `logo_slides`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `owner_data`
--
ALTER TABLE `owner_data`
  MODIFY `owner_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auto_data`
--
ALTER TABLE `auto_data`
  ADD CONSTRAINT `FK_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `owner_data` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
