-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: מאי 30, 2020 בזמן 04:35 PM
-- גרסת שרת: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taldb`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `comments`
--

CREATE TABLE `comments` (
  `name` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `comments`
--

INSERT INTO `comments` (`name`, `subject`) VALUES
('tal', 'comment\r\n'),
('tb', 'com'),
('fdfd', 'fdsdf'),
('admin', 'admin'),
('fd', 'sd'),
('roy', 'my names roy');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `games`
--

CREATE TABLE `games` (
  `player1` varchar(20) NOT NULL,
  `player2` varchar(20) NOT NULL,
  `gdate` date NOT NULL,
  `gtime` time NOT NULL,
  `serial` int(11) NOT NULL,
  `reportwon` tinyint(4) NOT NULL,
  `reportlost` tinyint(4) NOT NULL,
  `reportwon2` tinyint(4) NOT NULL,
  `reportlost2` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `games`
--

INSERT INTO `games` (`player1`, `player2`, `gdate`, `gtime`, `serial`, `reportwon`, `reportlost`, `reportwon2`, `reportlost2`) VALUES
('troy', 'admin', '2020-12-17', '17:17:00', 101, 0, 0, 1, 0),
('admin', 'none', '2020-12-12', '12:12:00', 103, 0, 0, 0, 0),
('admin', 'none', '2020-12-15', '15:15:00', 104, 0, 0, 0, 0),
('roger_federer', 'none', '2020-12-12', '12:12:00', 109, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `invitations`
--

CREATE TABLE `invitations` (
  `inviting` varchar(25) NOT NULL,
  `invited` varchar(25) NOT NULL,
  `invitingemail` varchar(30) NOT NULL,
  `invitedemail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `invitations`
--

INSERT INTO `invitations` (`inviting`, `invited`, `invitingemail`, `invitedemail`) VALUES
('roger_federer', 'toby', 'tako@gmail.com', 'null');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `user`
--

CREATE TABLE `user` (
  `id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `level` int(10) NOT NULL,
  `won` int(11) NOT NULL,
  `loss` int(11) NOT NULL,
  `pic` varchar(30) NOT NULL,
  `fb` varchar(60) NOT NULL,
  `ranking` int(11) NOT NULL,
  `voted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `admin`, `level`, `won`, `loss`, `pic`, `fb`, `ranking`, `voted`) VALUES
(204001366, 'admin', 'admin@admin.com', '12345', 1, 0, 8, 15, 'images/admin.gif', 'https://www.google.com', 30, 1),
(1234343, 'hi', 'hi@hi.net', '123', 0, 2, 0, 0, '', '', 0, 0),
(12345, 'loser', 'loser@gmail.com', '12345', 0, 0, 0, 0, '', '', 0, 0),
(34653, 'roy', 'roy@gmail.com', 'roy', 0, 3, 3, 3, 'images/roy.png', '', 10, 1),
(204489333, 'sarah', 'sarah@gmail.com', '12345', 0, 0, 3, 1, 'images/PASSPORT.jpg', '', 20, 0),
(203546678, 'roger_federer', 'tako@gmail.com', '12345678', 0, 5, 11, 3, 'images/fed.jpg', 'http://127.0.0.1/tennis-partner/forgedindex.php', 60, 1),
(2365435, 'toby', 'toby@gmail.com', '00000', 0, 3, 0, 0, '', '', 0, 0),
(6546546, 'troy', 'troy@gmail.com', 'troy', 0, 4, 2, 2, '', '', 35, 0);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `weeklyquestions`
--

CREATE TABLE `weeklyquestions` (
  `choice` varchar(25) NOT NULL,
  `numchoice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `weeklyquestions`
--

INSERT INTO `weeklyquestions` (`choice`, `numchoice`) VALUES
('roger', 14),
('nole', 1),
('nadal', 1),
('cilic', 4),
('isner', 8),
('diego', 2),
('stef', 1),
('medvedev', 0);

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`serial`);

--
-- אינדקסים לטבלה `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id` (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
