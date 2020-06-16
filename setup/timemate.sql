-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Loomise aeg: Juuni 08, 2020 kell 02:01 PL
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
(2, 'Interaktsioonidisain', 'IFI6207.DT'),
(3, 'Üldotstarbelised arendusplatvormid', 'IFI6208.DT'),
(4, 'Objektorienteeritud programmeerimine', 'IFI6226.DT'),
(5, 'Hulgateooria ja loogika elemendid', 'MLM6214.DT'),
(6, 'Tarkvara testimise alused', 'IFI6230.DT'),
(7, 'Eesrakenduste arendamine', 'IFI6211.DT'),
(8, 'Sissejuhatus infosüsteemidesse', 'IFI6068.DT'),
(9, 'Tarkvaraarenduse projekt', 'IFI6231.DT');

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

--
-- Andmete tõmmistamine tabelile `time_reportings`
--

INSERT INTO `time_reportings` (`id`, `subject_id`, `activity_id`, `duration`, `report_date`, `insert_date`, `user_id`) VALUES
(299, 7, 7, 45, '2020-05-31 22:50:13', '2020-05-31 22:50:13', 1),
(300, 8, 4, 20, '2020-05-31 22:51:15', '2020-05-31 22:51:15', 1),
(301, 4, 5, 210, '2020-05-31 22:58:10', '2020-05-31 22:58:10', 3),
(302, 4, 3, 625, '2020-05-31 22:58:15', '2020-05-31 22:58:15', 3),
(303, 4, 2, 560, '2020-05-31 22:58:20', '2020-05-31 22:58:20', 3),
(304, 2, 5, 585, '2020-05-31 22:58:25', '2020-05-31 22:58:25', 3),
(305, 2, 3, 610, '2020-05-30 22:58:36', '2020-05-31 22:58:36', 3),
(306, 9, 7, 775, '2020-05-31 22:58:43', '2020-05-31 22:58:43', 3),
(314, 8, 3, 325, '2020-05-30 23:34:31', '2020-05-31 23:34:31', 2),
(315, 8, 2, 190, '2020-05-31 23:34:46', '2020-05-31 23:34:46', 2),
(317, 7, 4, 360, '2020-05-31 23:35:06', '2020-05-31 23:35:06', 2),
(319, 7, 4, 515, '2020-05-31 23:46:22', '2020-05-31 23:46:22', 2),
(321, 4, 5, 75, '2020-06-07 11:38:26', '2020-06-08 11:38:26', 2),
(322, 4, 3, 370, '2020-06-06 13:39:09', '2020-06-08 13:39:09', 3),
(323, 5, 4, 75, '2020-06-08 13:40:54', '2020-06-08 13:40:54', 3);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Andmete tõmmistamine tabelile `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'andreas', 'kuuskaru', 0),
(2, 'martten', 'mitri', 0),
(3, 'robert', 'noor', 0),
(4, 'priit', 'sauer', 0),
(5, 'admin', 'admin', 0),
(6, 'demo', 'demo', 0),
(7, 'õpetaja', 'õpetaja', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT tabelile `time_reportings`
--
ALTER TABLE `time_reportings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT tabelile `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
