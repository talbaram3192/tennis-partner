-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: אוגוסט 02, 2020 בזמן 04:22 PM
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
('roy', 'my names roy'),
('<h1>fdfdf</h1>', 'dsds'),
('gfgf', 'fgfg'),
('fdsf', 'sdfsd'),
('ds', 'sd'),
('roy', 'im roy. hi\r\n'),
('admin', 'im the admin'),
('heloo', 'im the admin\r\n'),
('diego', 'im diego guys');

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
('roger_federer', 'john_servsner', '2020-08-03', '19:10:00', 131, 0, 0, 0, 0),
('diego_shortsman', 'none', '2020-08-05', '17:18:00', 133, 0, 0, 0, 0),
('marin_cilic', 'admin', '0000-00-00', '00:00:00', 134, 0, 0, 0, 0);

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
-- מבנה טבלה עבור טבלה `messages`
--

CREATE TABLE `messages` (
  `sending` varchar(25) NOT NULL,
  `receiving` varchar(25) NOT NULL,
  `content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `messages`
--

INSERT INTO `messages` (`sending`, `receiving`, `content`) VALUES
('loser', 'roger_federer', 'hi roger! it was great playing with you! \r\ncheck out this cool website i just found: <a href=\"http://192.168.179.1/tennis-partner/myGames.php?lostgame=121\">cool tennis website</a>'),
('loser', 'roger_federer', 'hi roger! it was great playing with you!\r\ncheck out this cool website i just found:\r\n<a href=\"http://192.168.179.1/tennis-partner/myGames.php?lostgame=125\">cool tennis website</a>'),
('john_servsner', 'roger_federer', 'hi rog'),
('roger_federer', 'john_servsner', 'hi john whats up?'),
('admin', 'diego_shortsman', 'youre short man..'),
('diego_shortsman', 'admin', 'screw you!');

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
  `fb` varchar(600) NOT NULL,
  `ranking` int(11) NOT NULL,
  `voted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `admin`, `level`, `won`, `loss`, `pic`, `fb`, `ranking`, `voted`) VALUES
(204001366, 'admin', 'admin@admin.com', '12345', 1, 0, 12, 19, 'images/admin.gif', 'https://www.facebook.com/tal.baram', 90, 0),
(2147483647, 'alex_zverev', 'alex@gmailcom', '12345', 0, 4, 0, 0, '', '', 0, 0),
(2147483647, 'diego_shortsman', 'diego@gmail.com', '12345', 0, 3, 1, 0, 'images/diego.jpg', '', 10, 1),
(0, 'djokobitch', 'djoko@gmail.com', '000000', 0, 0, 0, 0, '', '', 0, 0),
(2147483647, 'john_servsner', 'john@serving.com', '12345', 0, 3, 2, 1, 'images/john.jpg', '', 20, 1),
(12345, 'loser', 'loser@gmail.com', '12345', 0, 0, 2, 0, '', '', 20, 0),
(2147483647, 'marin_cilic', 'marincilic@gmail.com', '12345', 0, 3, 0, 0, 'images/marin.jpg', '', 0, 0),
(121212, 'nadull', 'nad@ull.net', '1234567890', 0, 0, 0, 0, '', '', 0, 0),
(34653, 'roy', 'roy@gmail.com', 'roy', 0, 3, 3, 5, 'images/roy.png', '', 10, 0),
(204489333, 'sarah', 'sarah@gmail.com', '12345', 0, 0, 3, 1, 'images/PASSPORT.jpg', '', 20, 0),
(203546678, 'roger_federer', 'tako@gmail.com', '123', 0, 5, 14, 8, 'images/fed.jpg', 'http://127.0.0.1/tennis-partner/changepassword.php?newpasswd', 100, 1),
(12345, 'tal', 'tal@gmail.com', '1234', 0, 5, 0, 0, '', 'http://127.0.0.1/tennis-partner/changepassword.php?newpasswd=1234&newpasswdagain=1234&changepasswd=change%21&%3Cscript%3Ealert(%22hi%22);%3C/script%3E', 0, 0),
(204001366, 'talbaram', 'talbaram@gmail.com', '1234', 0, 4, 2, 1, 'images/profpic.jpg', 'http://127.0.0.1/tennis-partner/changepassword.php?newpasswd=123&newpasswdagain=123&changepasswd=change%21&%3Cscript%3Ewindow,location.href(%22127.0.0.1/tennis-partner/index.php%22);%3C/script%3E', 30, 0),
(2365435, 'toby', 'toby@gmail.com', '00000', 0, 3, 0, 0, '', '', 0, 0),
(6546546, 'troy', 'troy@gmail.com', 'troy', 0, 4, 2, 3, '', '', 35, 0);

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
('roger', 17),
('nole', 1),
('nadal', 1),
('cilic', 4),
('isner', 8),
('diego', 3),
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
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
