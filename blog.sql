-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2015 at 03:02 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.6.11-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) unsigned NOT NULL COMMENT 'Post id',
  `title` varchar(255) NOT NULL COMMENT 'Post title',
  `description` text NOT NULL COMMENT 'Post text',
  `user_id` int(10) unsigned NOT NULL COMMENT 'Creator id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Post creation date',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Is post active (1 - active, 0 - deleted)'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `user_id`, `created_at`, `active`) VALUES
(6, 'Test Post (2015-08-15 15:47:58)', 'Test Description (2015-08-15 15:47:58)', 22, '2015-08-15 15:47:58', 1),
(7, 'Test Post (2015-08-15 15:48:14)', 'Test Description (2015-08-15 15:48:14)', 22, '2015-08-15 15:48:14', 1),
(8, 'Test Post (2015-08-15 15:51:18)', 'Test Description (2015-08-15 15:51:18)', 22, '2015-08-15 15:51:18', 1),
(9, 'Test Post (2015-08-15 15:51:20)', 'Test Description (2015-08-15 15:51:20)', 22, '2015-08-15 15:51:21', 1),
(10, 'Test Post (2015-08-15 15:51:22)', 'Test Description (2015-08-15 15:51:22)', 22, '2015-08-15 15:51:22', 1),
(11, 'Test Post (2015-08-15 15:51:23)', 'Test Description (2015-08-15 15:51:23)', 22, '2015-08-15 15:51:23', 1),
(12, 'Test Post (2015-08-15 15:51:24)', 'Test Description (2015-08-15 15:51:24)', 22, '2015-08-15 15:51:24', 1),
(13, 'Test Post (2015-08-15 15:51:25)', 'Test Description (2015-08-15 15:51:25)', 22, '2015-08-15 15:51:25', 1),
(14, 'Test Post (2015-08-15 15:51:26)', 'Test Description (2015-08-15 15:51:26)', 22, '2015-08-15 15:51:26', 1),
(15, 'Test Post (2015-08-15 15:51:31)', 'Test Description (2015-08-15 15:51:31)', 22, '2015-08-15 15:51:31', 1),
(16, 'Test Post (2015-08-15 15:51:33)', 'Test Description (2015-08-15 15:51:33)', 22, '2015-08-15 15:51:33', 1),
(17, 'Test Post (2015-08-15 15:51:34)', 'Test Description (2015-08-15 15:51:34)', 22, '2015-08-15 15:51:35', 1),
(18, 'Test Post (2015-08-15 15:51:36)', 'Test Description (2015-08-15 15:51:36)', 22, '2015-08-15 15:51:36', 1),
(19, 'Test Post (2015-08-15 15:51:38)', 'Test Description (2015-08-15 15:51:38)', 22, '2015-08-15 15:51:38', 1),
(20, 'Test Post (2015-08-15 15:51:39)', 'Test Description (2015-08-15 15:51:39)', 22, '2015-08-15 15:51:39', 1),
(21, 'Test Post (2015-08-15 15:51:41)', 'Test Description (2015-08-15 15:51:41)', 22, '2015-08-15 15:51:41', 1),
(22, 'changed Post (2015-08-15 23:35:35)', 'changed Description (2015-08-15 23:35:35)', 22, '1988-12-31 21:00:00', 1),
(23, 'Test Post (2015-08-15 15:51:49)', 'Test Description (2015-08-15 15:51:49)', 22, '2015-08-15 15:51:49', 1),
(24, 'Test Post (2015-08-15 15:51:50)', 'Test Description (2015-08-15 15:51:50)', 22, '2015-08-15 15:51:50', 1),
(25, 'Test Post (2015-08-15 20:38:29)', 'Test Description (2015-08-15 20:38:29)', 22, '2015-08-15 20:38:30', 1),
(26, 'Test Post (2015-08-15 20:38:52)', 'Test Description (2015-08-15 20:38:52)', 22, '2015-08-15 20:38:53', 1),
(27, 'Test Post (2015-08-15 20:39:02)', 'Test Description (2015-08-15 20:39:02)', 22, '2015-08-15 20:39:02', 1),
(28, 'Test Post (2015-08-15 20:39:03)', 'Test Description (2015-08-15 20:39:03)', 22, '2015-08-15 20:39:03', 1),
(29, 'Test Post (2015-08-15 20:39:07)', 'Test Description (2015-08-15 20:39:07)', 22, '2015-08-15 20:39:07', 1),
(30, 'Test Post (2015-08-15 20:39:09)', 'Test Description (2015-08-15 20:39:09)', 22, '2015-08-15 20:39:10', 1),
(31, 'test66', '<p>ssss</p>', 1, '2015-08-15 23:23:51', 0),
(32, 'Test Post (2015-08-15 23:36:08)', 'Test Description (2015-08-15 23:36:08)', 22, '2015-08-15 23:36:09', 1),
(33, 'Test Post (2015-08-15 23:36:10)', 'Test Description (2015-08-15 23:36:10)', 22, '2015-08-15 23:36:10', 1),
(34, 'Test Post (2015-08-15 23:36:12)', 'Test Description (2015-08-15 23:36:12)', 22, '2015-08-15 23:36:12', 1),
(35, 'Test Post (2015-08-15 23:36:14)', 'Test Description (2015-08-15 23:36:14)', 22, '2015-08-15 23:36:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL COMMENT 'Table key',
  `first_name` varchar(50) NOT NULL COMMENT 'User first name',
  `last_name` varchar(50) NOT NULL COMMENT 'User f last name',
  `email` varchar(100) NOT NULL COMMENT 'User email',
  `password` varchar(60) NOT NULL COMMENT 'User password encrypted',
  `birth_date` date DEFAULT NULL COMMENT 'User birth date',
  `avatar` varchar(100) DEFAULT NULL COMMENT 'User picture name',
  `access_token` varchar(32) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'User registration date',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Is user active (1 - active, 0 - deleted)'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `birth_date`, `avatar`, `access_token`, `registered_at`, `active`) VALUES
(1, 'Yury', 'Gugnin', 'yury.gugnin@gmail.com', '$2y$13$Wxqmr7e6YtnmUcZKTVxkC.EbUnexcnPAdY5NF.CEvFk41wmxTQgoq', '2015-08-05', '_AC4fhWA1GU', '8cc40d655a9096782833b7d5c8885d26', '2015-08-12 10:05:06', 1),
(22, 'Test', 'Gugnin', 'ygugnin@gmail.com', '$2y$13$wJo4qmYNSxkhfe1Na6xyS.2Ri9gTRDC/erxURkwQ5ohwrEB/ZMUuO', NULL, 'bgg', '7184807479ea2d012d4baca9b1154d99', '2015-08-14 18:24:32', 1),
(29, 'Vasiliy', 'Alibabaev', 'va@mail.ru', '$2y$13$LkLCB4AXuxPJou3jAOX1Ju1jsLCrLoKDgRbseVd39v5XBvuPAfG3S', NULL, '', '4d14dd2e20e4377ab4b9fea0f396d7e8', '2015-08-15 13:57:43', 1),
(34, 'test2', 'test2', 'test2@gmail.com', '$2y$13$gBOGgRSoQ3JOnqe09IGwCenmUl8t4ZGk/qm/itQjk0qsv3rZD5yra', NULL, 'av', 'e3cd4943dcb04451ba4d0898bdd2f2da', '2015-08-15 23:49:50', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Post id',AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Table key',AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
