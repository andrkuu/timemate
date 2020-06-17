-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Loomise aeg: Juuni 17, 2020 kell 02:16 PL
-- Serveri versioon: 10.3.22-MariaDB-0+deb10u1
-- PHP versioon: 7.3.11-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `timemate`
--
CREATE DATABASE IF NOT EXISTS `timemate` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `timemate`;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Andmete tõmmistamine tabelile `activities`
--

INSERT INTO `activities` (`id`, `name`) VALUES
(1, 'Täpsustamata õpimeetod'),
(2, 'Õppematerjali lugemine'),
(3, 'Kodutööde lahendamine'),
(4, 'Akadeemiline õppetöö'),
(5, 'Harjutamine'),
(6, 'Teiste õpetamine'),
(7, 'Rühmatöö'),
(8, 'Õppevideote vaatamine');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Andmete tõmmistamine tabelile `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`) VALUES
(10, 'Üldotstarbelised arendusplatvormid', 'IFI6208.DT'),
(11, 'Objektorienteeritud programmeerimine', 'IFI6226.DT'),
(12, 'Tarkvaraarenduse projekt', 'IFI6231.DT'),
(13, 'Programmeerimise põhikursus', 'IFI6069.DT'),
(14, 'Tarkvaraarenduse praktika', 'IFI6213.DT'),
(15, 'Veeb ja meedia elemendid', 'IFI6214.DT');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `time_reportings`
--

CREATE TABLE `time_reportings` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `report_date` datetime NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `uid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `user_subjects`
--

CREATE TABLE `user_subjects` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `subject_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indeksid tabelile `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indeksid tabelile `time_reportings`
--
ALTER TABLE `time_reportings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksid tabelile `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksid tabelile `user_subjects`
--
ALTER TABLE `user_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT tabelile `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT tabelile `time_reportings`
--
ALTER TABLE `time_reportings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabelile `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabelile `user_subjects`
--
ALTER TABLE `user_subjects`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- Tõmmistatud tabelite piirangud
--

--
-- Piirangud tabelile `time_reportings`
--
ALTER TABLE `time_reportings`
  ADD CONSTRAINT `time_reportings_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `time_reportings_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `time_reportings_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Piirangud tabelile `user_subjects`
--
ALTER TABLE `user_subjects`
  ADD CONSTRAINT `user_subjects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
