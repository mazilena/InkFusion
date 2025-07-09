-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 10:35 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inkfusion_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `subtitle`, `author`, `genre`, `description`, `image`) VALUES
(2, 'Life''s Mosaic', 'A Collection Of Poetic Musings', 'Shekh Mazida Khatun', 'Self-help', '"Life''s Mosaic: A Collection of Poetic Musings" is a collection of poetry that explores human emotions and experiences through evocative language and imagery. It delves into themes of love, hope, and resilience, offering a fresh perspective on the beauty and pain of life. This honest and relatable exploration of the human experience will touch your heart.', 'upload/lf.jpg'),
(3, 'The Glimmer''s Of Hope', 'From Struggle To Strength', 'Shekh Mazida Khatun', 'Self-help', '\r\n"The Glimmer''s of Hope: From Struggle to Strength" is a collection of powerful and inspiring quotes that will help you find hope and strength in the face of adversity. These quotes will encourage you to persevere through difficult times and remind you that there is always light in the darkness. This book is a source of inspiration and motivation that will help you to see the glimmers of hope and the strength to overcome any obstacle that comes in your way.', 'uploads/glms.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('draft','published') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `uname`, `title`, `content`, `status`) VALUES
(1, 'amie', 'Intro', 'Hello! I''m Amie', 'published'),
(2, 'amie', 'It''s my 2nd Post', 'Am A Fictional Character', 'draft'),
(3, 'amie', '3rd One', 'Protect Your Peace.&nbsp;', 'published'),
(7, 'amie', 'Quote Of The Day', 'You''re Born To Be Real,&nbsp;<div>Not To Be Perfect</div>', 'draft'),
(8, 'mkics', 'Welcome', 'Welcome! to MKICS&nbsp;', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE IF NOT EXISTS `queries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `name`, `user_email`, `message`, `submitted_at`) VALUES
(2, 'Anonymous', '', 'Is There Any Registration Fee?', '2024-09-29 07:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` tinyblob NOT NULL,
  `role` enum('admin','user') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `email`, `password`, `img`, `role`) VALUES
(1, 'ved', 'x@mail.com', '$2y$10$AVHwz5zzCL.B5PwNEWWTGOKD82xJwKpaRzLiIzeD8bseUWXDE8Lq2', '', 'admin'),
(2, 'amie', 'm@mail.com', '$2y$10$yHDtz79S7tpkAPBOIygGou9xp4DArnrqUOb2zeoHoTE0vYIRnIbGS', '', 'user'),
(3, 'mkics', 'mkics@mail.com', '$2y$10$BPoAYDVz.taD0NHmsCzCfOysI1uDaFIww8o1OWInBKOEgyFrDePH.', '', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
