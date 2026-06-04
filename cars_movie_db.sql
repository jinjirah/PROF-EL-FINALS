-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2026 at 04:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars_movie_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `character_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`character_id`, `movie_id`, `name`, `description`, `image`) VALUES
(1, 1, 'Lightning McQueen', 'A professional racer on the Piston Cup circuit who learns humility over fame.', 'images/mcqueen.jpg'),
(2, 1, 'Mater', 'A friendly, rust-covered tow truck from Radiator Springs.', 'images/mater.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_year` int(4) NOT NULL,
  `description` text DEFAULT NULL,
  `poster_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`movie_id`, `title`, `release_year`, `description`, `poster_image`) VALUES
(1, 'Cars', 2006, 'A hotshot race-car named Lightning McQueen gets lost in Radiator Springs, where he finds the true meaning of friendship and family.', 'images/cars1.jpg'),
(2, 'Cars 2', 2011, 'Star race car Lightning McQueen and his pal Mater head overseas to compete in the World Grand Prix race. But the road to the championship becomes rocky as Mater gets caught up in an intriguing adventure of his own: international espionage.', 'images/cars2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `overview`
--

CREATE TABLE `overview` (
  `scene_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `video_file` varchar(100) NOT NULL,
  `scene_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `overview`
--

INSERT INTO `overview` (`scene_id`, `movie_id`, `character_id`, `title`, `video_file`, `scene_description`) VALUES
(1, 1, 1, 'The Final Lap', 'videos/final_lap.mp4', 'Lightning McQueen sacrifices his Piston Cup win to help The King cross the finish line safely.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`admin_id`, `username`, `password`, `last_login`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', '2026-06-04 10:25:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`character_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `overview`
--
ALTER TABLE `overview`
  ADD PRIMARY KEY (`scene_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `character_id` (`character_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `character_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `overview`
--
ALTER TABLE `overview`
  MODIFY `scene_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `fk_characters_movie` FOREIGN KEY (`movie_id`) REFERENCES `home` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `overview`
--
ALTER TABLE `overview`
  ADD CONSTRAINT `fk_overview_character` FOREIGN KEY (`character_id`) REFERENCES `characters` (`character_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_overview_movie` FOREIGN KEY (`movie_id`) REFERENCES `home` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
