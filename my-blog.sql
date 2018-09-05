-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2018 at 07:10 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my-blog`
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
(27, 'lara13', 'lara13', 29),
(28, 'lara2', 'lara2', 23),
(29, 'jquery', 'jquery', 22),
(30, 'phalcon78', 'phalcon78', 1),
(31, 'yii', 'yii', 1),
(54, 'laravel', 'laravel', 0),
(55, 'vue', 'vue', 0),
(56, 'react', 'react', 0);

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
(48, 'cvgdfg', 'cvgdfg', '<p>fdgdfgdf</p>\r\n'),
(49, 'fgdfgdf', 'fgdfgdf', '<p>fdgdfgdf</p>\r\n'),
(50, 'fgdfgdfg', 'fgdfgdfg', '<p>gfgdfgdfg</p>\r\n'),
(54, 'weqwew', 'weqwew', '<p>wqewewq</p>\r\n'),
(55, 'fdf', 'fdf', '<p>hghgfhgfhgf</p>\r\n'),
(56, 'dbcvbcvbcv', 'dbcvbcvbcv', '<p>bvcbcvbcvb</p>\r\n'),
(57, 'gdfdggh', 'gdfdggh', '<p>gfhghgfhgfg</p>\r\n'),
(58, 'ghgfhgfhg', 'ghgfhgfhg', '<p>ghgfh</p>\r\n'),
(61, 'dadasfsd', 'dadasfsd', '<p>fsdfsdfsd</p>\r\n'),
(62, 'dadasfsd', 'dadasfsd_1673949252', '<p>fsdfsdfsd</p>\r\n');

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
(16, 'dfsdfsf', '', '2018-08-12 05:46:10', '2018-08-12 04:45:00', 'user-medium.png', '<p>dsffsdfsd</p>\r\n'),
(17, 'sddasdas', '', '2018-08-12 05:53:36', '2018-08-12 04:53:00', '', '<p>sdasdas</p>\r\n'),
(18, 'dsfsdf', '56,31', '2018-08-12 06:15:59', '2018-08-12 05:15:00', 'user4.png', '<p>sfsdfsd</p>\r\n');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
