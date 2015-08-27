-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Jul 2015 um 19:28
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `karteikarten`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- Tabelle bereinigen

DELETE FROM answers;

--
-- Daten für Tabelle `answers`
--

INSERT INTO `answers` (`id`, `answer`) VALUES
(1, 'answer1'),
(2, 'answer2'),
(3, 'answer3'),
(4, 'answer4'),
(5, 'answer5'),
(6, 'answer6'),
(7, 'answer7'),
(8, 'answer8'),
(9, 'answer9'),
(10, 'answer10'),
(11, 'answer11'),
(12, 'answer12'),
(13, 'answer13'),
(14, 'answer14'),
(15, 'answer15'),
(16, 'answer16'),
(17, 'answer17'),
(18, 'answer18'),
(19, 'answer19'),
(20, 'answer20'),
(21, 'answer21'),
(22, 'answer22'),
(23, 'answer23'),
(24, 'answer24'),
(25, 'answer25'),
(26, 'answer26'),
(27, 'answer27');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `karteikarten`
--

CREATE TABLE IF NOT EXISTS `karteikarten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- Tabelle bereinigen

DELETE FROM karteikarten;

--
-- Daten für Tabelle `karteikarten`
--

INSERT INTO `karteikarten` (`id`, `question`, `answer`, `user`, `topic`) VALUES
(1, 'question1', 1, 1, 1),
(2, 'question2', 2, 1, 1),
(3, 'question3', 3, 1, 1),
(4, 'question4', 4, 1, 2),
(5, 'question5', 5, 1, 2),
(6, 'question6', 6, 1, 2),
(7, 'question7', 7, 1, 3),
(8, 'question8', 8, 1, 3),
(9, 'question9', 9, 1, 3),
(10, 'question10', 10, 2, 1),
(11, 'question11', 11, 2, 1),
(12, 'question12', 12, 2, 1),
(13, 'question13', 13, 2, 2),
(14, 'question14', 14, 2, 2),
(15, 'question15', 15, 2, 2),
(16, 'question16', 16, 2, 3),
(17, 'question17', 17, 2, 3),
(18, 'question18', 18, 2, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- Tabelle bereinigen

DELETE FROM topics;

--
-- Daten für Tabelle `topics`
--

INSERT INTO `topics` (`id`, `topic`) VALUES
(1, 'topic1'),
(2, 'topic2'),
(3, 'topic3');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- Tabelle bereinigen

DELETE FROM users;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user1', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08'),
(2, 'user2', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08'),
(3, 'user3', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
