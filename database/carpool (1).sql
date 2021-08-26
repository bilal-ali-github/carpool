-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 09:13 PM
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
-- Table structure for table `driver_profile`
--

CREATE TABLE `driver_profile` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `profile_img` varchar(512) NOT NULL,
  `car_name` varchar(128) NOT NULL,
  `reg_num` varchar(8) NOT NULL,
  `car_img` varchar(512) NOT NULL,
  `car_color` varchar(128) NOT NULL,
  `car_seats` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver_profile`
--

INSERT INTO `driver_profile` (`id`, `driver_id`, `profile_img`, `car_name`, `reg_num`, `car_img`, `car_color`, `car_seats`, `status`) VALUES
(1, 6, './images/drivers/6picture.jpg', 'Honda City', 'PS-763', './images/drivers/car_images/6car.jpg', 'White', 4, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `departure_city` varchar(128) NOT NULL,
  `arrival_city` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fare` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `driver_id`, `departure_city`, `arrival_city`, `date`, `time`, `fare`, `status`) VALUES
(1, 6, 'Islamabad', 'Lahore', '2021-08-26', '12:08:00', 1000, 'Accepted'),
(2, 6, 'Rawalpinidi', 'Lahore', '2021-08-28', '21:08:00', 800, 'Pending'),
(3, 6, 'Lahore', 'Rawalpindi', '2021-08-29', '12:08:00', 1000, 'Pending'),
(4, 6, 'Lahore', 'Islamabad', '2021-08-30', '12:00:00', 1000, 'Pending');

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
(6, 'Driver1', 'driver1@email.com', '03005343215', '$2y$10$gIFe4xgAomc6zaW/tc8evOWaHjCtJFeQwEJhQHlKDxy4Z7.Cy1xeK', 'Driver'),
(7, 'Driver2', 'driver2@email.com', '03005345471', '$2y$10$biTrkVUa8v13PQCTD2.oZ.YwpbDQELaBxStrj0mZl.YP3THBSMba2', 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_img` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `profile_img`) VALUES
(1, 1, './images/users/1picture.jpg'),
(2, 2, './images/users/2picture.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver_profile`
--
ALTER TABLE `driver_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign-up`
--
ALTER TABLE `sign-up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver_profile`
--
ALTER TABLE `driver_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sign-up`
--
ALTER TABLE `sign-up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
