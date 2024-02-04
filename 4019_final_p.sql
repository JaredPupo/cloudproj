-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2024 at 11:08 PM
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
-- Database: `4019_final_p`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`email`, `password`) VALUES
('emanuel.martinez8@upr.edu', '$2y$10$6V2416anpvHjS/5uRtyQD.gOOmzbpl8kfLsRfuCMp3rgS7iWs6Pfa'),
('jared.pupo@upr.edu', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` char(8) NOT NULL,
  `title` varchar(30) NOT NULL,
  `credits` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `title`, `credits`) VALUES
('CCOM3001', 'Programacion 1', 5),
('CCOM3002', 'Programación II', 5),
('CCOM3020', 'Matemáticas Discretas', 3);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `student_id` char(9) NOT NULL,
  `course_id` char(8) NOT NULL,
  `section_id` char(3) NOT NULL,
  `timestamp` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `course_id` char(8) NOT NULL,
  `section_id` char(3) NOT NULL,
  `capacity` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`course_id`, `section_id`, `capacity`) VALUES
('CCOM3001', 'M10', 3),
('CCOM3001', 'L10', 2),
('CCOM3002', 'LD0', 2),
('CCOM3020', 'MA0', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` char(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `year_of_study` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `password`, `email`, `year_of_study`, `name`, `lastName`) VALUES
('840181999', 'lkj', 'abimelec.roman3@upr.edu', 5, 'Abimelec', 'Roman'),
('840206745', '$2y$10$8ydjUZqxTNvP9AYqZScbSeSfvk32OjeVj0VoUl/QLn4AzmZ/wkbC6', 'Daisy3@upr.edu', 1, 'Daisy', 'Escalante'),
('840199857', '$2y$10$8ydjUZqxTNvP9AYqZScbSeSfvk32OjeVj0VoUl/QLn4AzmZ/wkbC6', 'Emanuel8@upr.edu', 4, 'Emanuel', 'Martinez');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `student_id` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
