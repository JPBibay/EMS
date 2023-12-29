-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2023 at 04:19 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21723269_employee_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `e_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `e_fname` varchar(255) NOT NULL,
  `e_lname` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`e_id`, `user_id`, `e_fname`, `e_lname`, `age`, `birthday`, `gender`, `contact`, `address`, `jobtitle`, `image`) VALUES
(1, 1, 'Monkey', 'Luffy', '20', '2023-12-14', 'Male', '0912437832', 'Prk. Bougainvilla Brgy. Camingawan Kabankalan City Negros Occidental', 'IT Manager', '1703818079_Premium Vector _ Full moon and stars over mountain peaks.jfif'),
(2, 2, 'Paulyn', 'Bito-on', '20', '2023-12-13', 'Female ', '05858854', 'Brgy. Camingawan', 'Programmer ', '1703820072_IMG_20231222_162947.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_pass`) VALUES
(1, 'John Paul', 'Bibay', 'johnpaulbibay@gmail.com', '$2y$10$WpYj6D.uM3wP8H5wtHHIWOqY9.62OKiWSkUvd24rHSxKa.rLXa.nm'),
(2, 'Paulyn Joy ', 'Bito-on ', 'paulynjoybitoon@gmail.com', '$2y$10$zGun86QDOdIfXA5kuSg5Vu4iozADYidAfJ5dqZAHZUr/psorgjaVa'),
(3, 'Monkey', 'Luffy', 'luffy@gmail.com', '$2y$10$9NfxB71pD2ggv092wpRR8.DMMiu14uSONQgtU60jF7RYEjcAyklIG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `employees_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
