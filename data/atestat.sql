-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: oct. 25, 2022 la 09:01 PM
-- Versiune server: 10.4.24-MariaDB
-- Versiune PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `atestat`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `chatuser2user1`
--

CREATE TABLE `chatuser2user1` (
  `uid` varchar(256) DEFAULT NULL,
  `mesaj` varchar(1024) DEFAULT NULL,
  `timp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `chatuser2user1`
--

INSERT INTO `chatuser2user1` (`uid`, `mesaj`, `timp`) VALUES
('user1', 'Cf', 1),
('user2', 'BN tu?', 2),
('user2', 'iesi afara?', 3),
('user1', 'da', 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `test`
--

CREATE TABLE `test` (
  `id` int(9) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `mesaj` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `test`
--

INSERT INTO `test` (`id`, `sender`, `mesaj`) VALUES
(1, 'first', 'Primul mesaj al lui first'),
(2, 'second', 'Primul mesaj al lui second'),
(3, 'second', 'Al doilea mesaj al lui second'),
(4, 'first', 'Al doilea mesaj al lui first');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tokens`
--

CREATE TABLE `tokens` (
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `tokens`
--

INSERT INTO `tokens` (`data`) VALUES
(1666688488),
(1666688563),
(2147483647);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `uid` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`uid`, `pass`) VALUES
('user1', 'pass1'),
('user2', 'pass2');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`data`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `test`
--
ALTER TABLE `test`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
