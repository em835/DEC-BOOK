-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql1.njit.edu
-- Generation Time: Nov 12, 2020 at 01:55 AM
-- Server version: 8.0.17
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cll27`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(6, 62, 51, 'Hi there', '2020-11-01 12:14:30'),
(7, 62, 53, 'Hello There ', '2020-11-01 12:16:35'),
(8, 62, 53, 'dddeded', '2020-11-01 12:20:10'),
(9, 62, 53, 'sdsdsds3rr4r4', '2020-11-01 12:25:45'),
(10, 61, 53, 'another ', '2020-11-01 12:27:13'),
(11, 61, 53, 'another ', '2020-11-01 12:27:20'),
(12, 63, 51, 'Where are you ? ', '2020-11-01 16:17:25'),
(13, 63, 51, 'sdsssds', '2020-11-01 16:18:40'),
(14, 63, 51, 'dsdsdsdss', '2020-11-01 16:18:54'),
(15, 63, 51, 'asasasasasa', '2020-11-01 16:19:04'),
(16, 63, 51, 'sasasasa', '2020-11-01 16:19:51'),
(17, 63, 51, 'sdsds', '2020-11-01 16:20:07'),
(18, 63, 51, 'ewewew', '2020-11-01 16:20:26'),
(19, 63, 51, 'sdsdsdsdsd', '2020-11-01 16:21:03'),
(20, 64, 53, 'test comment', '2020-11-02 02:18:40'),
(21, 65, 51, 'hbhjbhjbkuj', '2020-11-02 02:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `message_body` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=288 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `reciever_id`, `message_body`, `created_at`) VALUES
(276, 51, 53, 'Hello', '2020-11-02 02:31:48'),
(277, 51, 53, 'wdwdw', '2020-11-02 02:34:31'),
(278, 53, 51, 'Hey John', '2020-11-02 02:36:25'),
(279, 51, 53, 'hi\n', '2020-11-10 12:03:04'),
(280, 53, 51, 'hello', '2020-11-10 12:03:09'),
(281, 53, 51, '', '2020-11-10 12:03:12'),
(282, 53, 51, 'yooooo\n', '2020-11-10 12:03:38'),
(283, 51, 53, 'hello\n', '2020-11-10 12:05:04'),
(284, 51, 53, 'hello', '2020-11-10 12:05:59'),
(285, 53, 51, 'hello\n', '2020-11-10 12:06:36'),
(286, 51, 53, 'hello', '2020-11-10 12:06:38'),
(287, 51, 53, 'hello\n', '2020-11-11 19:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` longblob,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `body`, `created_at`) VALUES
(61, 51, 0x3c703e6465646564653c2f703e0a, '2020-11-01 12:12:44'),
(62, 51, 0x3c703e77727772777277773c696d6720616c743d2222207372633d222e2e2f6261636b656e642f75706c6f6164732f3538343330333836332e6a706722207374796c653d226865696768743a34303070783b2077696474683a323735707822202f3e3c2f703e0a, '2020-11-01 12:13:17'),
(63, 51, 0x3c68313e3c696d6720616c743d2222207372633d222e2e2f6261636b656e642f75706c6f6164732f3834313934333334362e706e6722207374796c653d226865696768743a37363870783b2077696474683a31333636707822202f3e266e6273703b3c2f68313e0a0a3c7461626c6520626f726465723d2231222063656c6c70616464696e673d2231222063656c6c73706163696e673d223122207374796c653d2277696474683a3530307078223e0a093c74626f64793e0a09093c74723e0a0909093c74643e266e6273703b3c2f74643e0a0909093c74643e266e6273703b3c2f74643e0a09093c2f74723e0a09093c74723e0a0909093c74643e266e6273703b3c2f74643e0a0909093c74643e266e6273703b3c2f74643e0a09093c2f74723e0a09093c74723e0a0909093c74643e266e6273703b3c2f74643e0a0909093c74643e266e6273703b3c2f74643e0a09093c2f74723e0a093c2f74626f64793e0a3c2f7461626c653e0a0a3c703e266e6273703b3c2f703e0a, '2020-11-01 16:16:47'),
(64, 51, 0x3c68313e68676a686a68623c2f68313e0a, '2020-11-02 02:17:06'),
(65, 51, 0x3c6831207374796c653d22666f6e742d7374796c653a206974616c69633b223e3c696d6720616c743d2222207372633d222e2e2f6261636b656e642f75706c6f6164732f313234373935323732362e706e6722207374796c653d226865696768743a37363870783b2077696474683a31333636707822202f3e3c7374726f6e673e48656c6c6f3c2f7374726f6e673e3c2f68313e0a, '2020-11-02 02:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `body` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `userName` varchar(16) NOT NULL,
  `password` varchar(128) NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `userName`, `password`, `firstName`, `lastName`, `email`) VALUES
(51, 'john', '123', 'john', 'smith', 'john@gmail.com'),
(52, 'larryfash', '123', 'Lanre', 'Fasuyi', 'lanre@gmail.com'),
(53, 'andyuser', '123', 'Andy', 'Josh', 'josh@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`comment_id`), ADD UNIQUE KEY `comment_id` (`comment_id`), ADD KEY `post_id` (`post_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
 ADD KEY `User_id1` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=288;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
ADD CONSTRAINT `User1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
