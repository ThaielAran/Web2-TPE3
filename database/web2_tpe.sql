-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 08:18 AM
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
-- Database: `web2_tpe`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `director` varchar(150) NOT NULL,
  `synopsis` varchar(400) NOT NULL,
  `release_date` year(4) NOT NULL,
  `runtime` int(11) NOT NULL,
  `genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `director`, `synopsis`, `release_date`, `runtime`, `genre`) VALUES
(1, 'The Lord of the Rings: The Fellowship of the Ring', 'Peter Jackson', 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', '2001', 178, 'Adventure'),
(2, 'The Lord of the Rings: The Two Towers', 'Peter Jackson', 'The Fellowship is broken, and the remaining members must unite against the dark forces of Sauron.', '2002', 179, 'Adventure'),
(3, 'The Lord of the Rings: The Return of the King', 'Peter Jackson', 'The epic conclusion of the Lord of the Rings saga where Frodo and Sam reach Mount Doom.', '2003', 201, 'Adventure'),
(4, 'Alien', 'Ridley Scott', 'In deep space, the crew of the commercial spaceship Nostromo encounters a deadly alien creature after responding to a distress signal on an unknown planet.', '1979', 117, 'Sci-Fi');
-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `body` varchar(500) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id_review`, `id_movie`, `body`, `rating`) VALUES
(1, 1, 'Elijah Wood should wear wigs', 4),
(2, 1, 'An incredible journey with stunning visuals.', 5),
(3, 2, 'A gripping continuation of the saga.', 5),
(4, 2, 'Dark and intense, it keeps you on the edge of your seat.', 4),
(5, 3, 'A perfect ending to a legendary trilogy.', 5),
(6, 3, 'Epic and emotional, a must-watch.', 5),
(7, 4, 'A terrifying masterpiece of sci-fi horror.', 5),
(8, 4, 'The atmosphere is incredibly tense and claustrophobic.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'webadmin', '$2y$10$.2RKdlLgv2uHWtFS7Dp1guCiVsovKghfuXDTJVWNYJQPi0r1MXPKe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `fk_Reviews_Movies` (`id_movie`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_Reviews_Movies` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;