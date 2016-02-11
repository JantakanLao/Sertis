-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2016 at 12:37 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sertis`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `name`, `status`, `content`, `category`, `author`, `user_id`) VALUES
(2, 'card1', 'public', 'The human fingertip is a finely tuned sensory machine, and even slight touches convey a great deal of information about our physical environment. It turns out some fish use', 'biology', 'Jantakan', 1),
(3, 'card1', 'public', 'how atoms form chemical bonds to create chemical compounds, the interactions of substances through intermolecular forces that give matter its general properties', 'chemistry', 'First', 2),
(21, 'card2', 'private', 'Chemistry is a branch of physical science that studies the composition, structure, propert is and change of matter. \nChemistry includes topics such as the properties of individual atoms.', 'chemistry', 'Jantakan', 1),
(22, 'card3', 'public', 'Yellen testified for over three hours before the House Financial Services Committee Wednesday and lawmakers heavily criticized the Fed''s monetary policy, the state of the economy', 'finance', 'Jantakan', 1),
(23, 'card2', 'public', 'Boxer Muhammad Ali famously declared his intent to ''float like a butterfly and sting like a bee,'' but perhaps boxers should look to another type of insect for inspiration: ', 'biology', 'first', 2),
(24, 'card4', 'draft', 'Engineering is the application of mathematics, empirical evidence and scientific, economic, social, and practical knowledge in order to invent, innovate, design, build, maintain, ', 'engineering', 'Jantakan', 1),
(26, 'card3', 'draft', 'Health is the level of functional or metabolic efficiency of a living organism. In humans it is the ability of individuals or communities to adapt and self-manage when facing physical, mental or social challenges.The World Health Organization (WHO) defined health in its broader sense in its 1948', 'health', 'first', 2),
(27, 'card1', 'public', 'A society is a group of people involved in persistent social interaction, or a large social grouping sharing the same geographical or social territory, typically subject to the same political ', 'society', 'fern', 3),
(29, 'card1', 'public', 'Space is the boundless three-dimensional extent in which objects and events have relative position and direction. Physical space is often conceived in three linear dimensions', 'space', 'joe', 4),
(30, 'card5', 'public', 'The discipline of engineering is extremely broad, and encompasses a range of more specialized fields of engineering, each with a more specific emphasis on particular areas of apply', 'engineering', 'Jantakan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_session`
--

CREATE TABLE `ci_session` (
  `id` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_session`
--

INSERT INTO `ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('2aae020edce84a8768fd5c85261c43827b41f6e7', '::1', 1455188076, '__ci_last_regenerate|i:1455188076;username|s:8:"jantakan";email|s:18:"jantakan@gmail.com";password|s:4:"1234";logged_in|b:1;user_id|s:1:"1";'),
('6e6342b548dce25e1454cf9a9822f0b8dec8f744', '::1', 1455190659, '__ci_last_regenerate|i:1455190370;username|s:8:"jantakan";'),
('70e674812bd37304ee488a96754caef41b3590b5', '::1', 1455187935, '__ci_last_regenerate|i:1455187657;username|s:8:"jantakan";email|s:18:"jantakan@gmail.com";password|s:4:"1234";logged_in|b:1;user_id|s:1:"1";'),
('8716bdbd64814816de2c1a6fae28b23dd9822517', '::1', 1455187004, '__ci_last_regenerate|i:1455186936;username|s:8:"jantakan";email|s:18:"jantakan@gmail.com";password|s:4:"1234";logged_in|b:1;user_id|s:1:"1";'),
('a6897db1921b51f0bda6aeb6fca7fcaeb8c11af0', '::1', 1455189528, '__ci_last_regenerate|i:1455189528;username|s:3:"aaa";'),
('c35d3773a84e2cb770c73cd447469f2ef69a62c0', '::1', 1455188784, '__ci_last_regenerate|i:1455188601;username|s:3:"aaa";'),
('d725b23c0ae445b22165eeb0bf4b0d69caae3ae3', '::1', 1455187566, '__ci_last_regenerate|i:1455187273;username|s:8:"jantakan";email|s:18:"jantakan@gmail.com";password|s:4:"1234";logged_in|b:1;user_id|s:1:"1";');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'jantakan', 'jantakan@gmail.com', '1234'),
(2, 'first', 'first@gmail.com', '123'),
(3, 'fern', 'fern@gmail.com', '12345'),
(4, 'joe', 'joe@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `card_id` (`card_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ci_session`
--
ALTER TABLE `ci_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_activity_idx` (`timestamp`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
