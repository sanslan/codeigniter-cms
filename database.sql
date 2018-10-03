-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2018 at 12:17 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`) VALUES
(29, 'jquery', 'jquery', 22),
(30, 'phalcon78', 'phalcon78', 1),
(31, 'yii', 'yii', 1),
(54, 'laravel', 'laravel', 0);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mime` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `datetime`, `mime`) VALUES
(96, 'file-uploads/2018/09/girl.jpeg', '2018-09-28 11:55:41', NULL),
(99, 'file-uploads/2018/09/mansur.JPG', '2018-09-28 11:55:41', NULL),
(100, 'file-uploads/2018/09/menzere.jpeg', '2018-09-28 11:55:41', NULL),
(101, 'file-uploads/2018/09/girl_1.jpeg', '2018-09-28 14:28:37', NULL),
(104, 'file-uploads/2018/10/pswhyus_2.jpeg', '2018-10-02 06:17:33', NULL),
(105, 'file-uploads/2018/10/why.jpeg', '2018-10-02 06:18:47', NULL),
(106, 'file-uploads/2018/10/girl.jpeg', '2018-10-02 07:05:40', NULL),
(107, 'file-uploads/2018/10/girl_1.jpeg', '2018-10-02 07:43:04', NULL),
(108, 'file-uploads/2018/10/iconnew.png', '2018-10-02 07:43:04', NULL),
(109, 'file-uploads/2018/10/mansur.JPG', '2018-10-02 07:43:04', NULL),
(110, 'file-uploads/2018/10/menzere.jpeg', '2018-10-02 07:43:04', NULL),
(111, 'file-uploads/2018/10/pswhyus.jpeg', '2018-10-02 07:43:04', NULL),
(112, 'file-uploads/2018/10/why_1.jpeg', '2018-10-02 07:43:04', NULL),
(113, 'file-uploads/2018/10/girl_2.jpeg', '2018-10-02 07:43:23', NULL),
(114, 'file-uploads/2018/10/mansur_1.JPG', '2018-10-02 07:43:23', NULL),
(115, 'file-uploads/2018/10/menzere_1.jpeg', '2018-10-02 07:43:23', NULL),
(116, 'file-uploads/2018/10/pswhyus_1.jpeg', '2018-10-02 07:43:23', NULL),
(117, 'file-uploads/2018/10/torpaq.jpeg', '2018-10-02 07:43:23', NULL),
(118, 'file-uploads/2018/10/why_2.jpeg', '2018-10-02 07:43:23', NULL),
(119, 'file-uploads/2018/10/girl_3.jpeg', '2018-10-02 07:44:08', NULL),
(120, 'file-uploads/2018/10/mansur_2.JPG', '2018-10-02 07:44:09', NULL),
(121, 'file-uploads/2018/10/menzere_2.jpeg', '2018-10-02 07:44:09', NULL),
(122, 'file-uploads/2018/10/pswhyus_3.jpeg', '2018-10-02 07:44:09', NULL),
(123, 'file-uploads/2018/10/why_3.jpeg', '2018-10-02 07:44:09', NULL),
(124, 'file-uploads/2018/10/girl_4.jpeg', '2018-10-02 07:44:20', NULL),
(125, 'file-uploads/2018/10/mansur_3.JPG', '2018-10-02 07:44:21', NULL),
(126, 'file-uploads/2018/10/menzere_3.jpeg', '2018-10-02 07:44:21', NULL),
(127, 'file-uploads/2018/10/pswhyus_4.jpeg', '2018-10-02 07:44:21', NULL),
(128, 'file-uploads/2018/10/torpaq_1.jpeg', '2018-10-02 07:44:21', NULL),
(129, 'file-uploads/2018/10/why_4.jpeg', '2018-10-02 07:44:21', NULL),
(130, 'file-uploads/2018/10/girl_5.jpeg', '2018-10-02 07:44:31', NULL),
(131, 'file-uploads/2018/10/mansur_4.JPG', '2018-10-02 07:44:31', NULL),
(132, 'file-uploads/2018/10/menzere_4.jpeg', '2018-10-02 07:44:31', NULL),
(133, 'file-uploads/2018/10/pswhyus_5.jpeg', '2018-10-02 07:44:31', NULL),
(134, 'file-uploads/2018/10/why_5.jpeg', '2018-10-02 07:44:31', NULL),
(135, 'file-uploads/2018/10/girl_6.jpeg', '2018-10-02 07:44:43', NULL),
(136, 'file-uploads/2018/10/mansur_5.JPG', '2018-10-02 07:44:43', NULL),
(137, 'file-uploads/2018/10/menzere_5.jpeg', '2018-10-02 07:44:44', NULL),
(138, 'file-uploads/2018/10/pswhyus_6.jpeg', '2018-10-02 07:44:44', NULL),
(139, 'file-uploads/2018/10/why_6.jpeg', '2018-10-02 07:44:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `body`) VALUES
(48, 'cvgdfg', 'cvgdfg', '<p>tes deyil bu</p>\r\n'),
(49, 'fgdfgdf', 'fgdfgdf', '<p>fdgdfgdf</p>\r\n'),
(50, 'fgdfgdfg', 'fgdfgdfg', '<p>gfgdfgdfg</p>\r\n'),
(54, 'weqwew', 'weqwew', '<p>wqewewq</p>\r\n'),
(55, 'fdf', 'fdf', '<p>hghgfhgfhgf</p>\r\n'),
(56, 'dbcvbcvbcv', 'dbcvbcvbcv', '<p>bvcbcvbcvb</p>\r\n'),
(57, 'normal post', 'normal-post', '<p>yeah</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(300) NOT NULL,
  `categories` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thumbnail` varchar(200) DEFAULT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `categories`, `created_at`, `publish_date`, `thumbnail`, `body`) VALUES
(29, 'ytryertyert', '', '2018-10-03 08:01:25', '2018-10-03 08:01:00', '', '<p>yrtyertyert</p>\r\n'),
(30, 'tyrtytrey', '', '2018-10-03 08:01:28', '2018-10-03 08:01:00', '', '<p>rtryertyrey</p>\r\n'),
(31, 'tytrytrey', '', '2018-10-03 08:01:31', '2018-10-03 08:01:00', '', '<p>ertyerty</p>\r\n'),
(32, 'rtyrty', '', '2018-10-03 08:01:36', '2018-10-03 08:01:00', '', '<p>trytryertytrtre</p>\r\n'),
(33, 'ytryrtytr', '', '2018-10-03 08:01:39', '2018-10-03 08:01:00', '', '<p>ytreyetryter</p>\r\n'),
(34, 'tytrytrey', '', '2018-10-03 08:01:42', '2018-10-03 08:01:00', '', '<p>tryert</p>\r\n'),
(35, 'qwewqeqw', '', '2018-10-03 08:08:21', '2018-10-03 08:08:00', '', '<p>eqweqweqw</p>\r\n'),
(36, 'eqweqweqw', '', '2018-10-03 08:08:26', '2018-10-03 08:08:00', '', '<p>weqweqwe</p>\r\n'),
(37, 'eqwewqeqw', '', '2018-10-03 08:08:30', '2018-10-03 08:08:00', '', '<p>ewqewqe</p>\r\n'),
(38, 'ewqeqwew', '', '2018-10-03 08:08:33', '2018-10-03 08:08:00', '', '<p>weqwq</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`) VALUES
(1, 'admin', 'Mansur Manafov', 'sanslan@outlook.com', '$2y$12$YG3Esfffwte5GpwIRrLyRehxShwtllAghl4SMSKr8kg/qG30WS6AW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
