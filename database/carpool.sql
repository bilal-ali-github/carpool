-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 07:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `sign-up`
--

CREATE TABLE `sign-up` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(126) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sign-up`
--

INSERT INTO `sign-up` (`id`, `name`, `email`, `phone_no`, `password`, `role`) VALUES
(1, 'User1', 'user1@email.com', '03005345471', '$2y$10$CxwaQ1t2MkYvBZxed0r/QelUydG66Vt3JZ2DrgT4saQPqilQjWLKi', 'User'),
(2, 'User2', 'user2@email.com', '0335547689', '$2y$10$rHRA63sAZKhgf3gQGGmXMOkFCy8cq/pIyN3XmPcEmWta179HzdSta', 'User'),
(3, 'User3', 'user3@email.com', '03023458907', '$2y$10$n3LYJnB7zBJUYUHCCXKCHOZTb2tY1TnKY0QM0dphvzdQWnXvi72EO', 'User'),
(4, 'User4', 'user4@email.com', '03021237890', '$2y$10$ku0rCjO33UOOwwkqX5hV1O7KbPem0bfL4n0KPgsTL/3Vi6Kn35gby', 'User'),
(5, 'User5', 'user5@email.com', '03235947890', '$2y$10$XOAdrSQ3y5huaazAt7OJWOueMxp3OCH41TqKDm9PJjp9PWXn.oEmq', 'User'),
(6, 'Driver1', 'driver1@email.com', '03005343215', '$2y$10$gIFe4xgAomc6zaW/tc8evOWaHjCtJFeQwEJhQHlKDxy4Z7.Cy1xeK', 'Driver');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sign-up`
--
ALTER TABLE `sign-up`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sign-up`
--
ALTER TABLE `sign-up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
