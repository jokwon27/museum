-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2014 at 08:24 AM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `museum`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_museum` int(11) DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_museum` (`id_museum`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `waktu`, `id_user`, `id_museum`, `url`, `isi`, `image`) VALUES
(2, 'Chapter 376 Tujuan Fujitora', '2014-02-06 06:52:27', 1, 1, 'chapter-376-tujuan-fujitora', '<p>Chapter 376 dfdfff dfffffffffff dffffffffff dffffffffffffffffffffffffffffffffffffff dfffffffffff dfffffffffffff dffffffffffvdf fdddddddddddd dfffffffffffff fdddddddddddddd dfffffffffffff</p>\n', 'museum-affandi.jpg'),
(7, 'Chapter 376 Tujuan Fujitora', '2014-02-06 06:51:43', 1, 1, 'chapter-376-tujuan-fujitora', '<p>Chapter 376 dfdfff dfffffffffff dffffffffff dffffffffffffffffffffffffffffffffffffff dfffffffffff dfffffffffffff dffffffffffvdf fdddddddddddd dfffffffffffff fdddddddddddddd dfffffffffffff</p>\n', 'museum-affandi.jpg'),
(19, 'a', '2014-02-06 06:52:42', 1, 1, 'a', '<p>a</p>\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `home_slide`
--

CREATE TABLE IF NOT EXISTS `home_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `alt` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `home_slide`
--

INSERT INTO `home_slide` (`id`, `judul`, `deskripsi`, `gambar`, `alt`) VALUES
(1, 'First Slide', 'Ini adalah First Slide', 'first_slide.png', 'first_slide.png'),
(2, 'Second Slide', 'Ini adalah Second Slide', 'second_slide.png', 'second_slide.png'),
(3, 'Third Slide', 'Ini adalah Third Slide', 'second_slide.png', 'Third_slide.png');

-- --------------------------------------------------------

--
-- Table structure for table `jalur`
--

CREATE TABLE IF NOT EXISTS `jalur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `rute` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_admin`
--

CREATE TABLE IF NOT EXISTS `menu_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `menu_admin`
--

INSERT INTO `menu_admin` (`id`, `nama`, `url`, `icon`) VALUES
(2, 'Master Data User', 'admin/master_user', 'fa-users'),
(3, 'Master Data Museum', 'admin/master_museum', 'fa-building-o'),
(4, 'Master Data Trans Jogja', 'admin/master_trans', 'fa-truck'),
(5, 'Master Data Artikel', 'admin/master_artikel', 'fa-archive'),
(6, 'Master Data Shelter', 'admin/master_shelter', NULL),
(7, 'Master Data Home Slide', 'admin/master_slide', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_user_privileges`
--

CREATE TABLE IF NOT EXISTS `menu_user_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `menu_admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`menu_admin_id`),
  KEY `menu_admin_id` (`menu_admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `menu_user_privileges`
--

INSERT INTO `menu_user_privileges` (`id`, `user_id`, `menu_admin_id`) VALUES
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(23, 8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `museum`
--

CREATE TABLE IF NOT EXISTS `museum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `keterangan` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `museum`
--

INSERT INTO `museum` (`id`, `nama`, `alamat`, `longitude`, `latitude`, `keterangan`, `image`, `url`) VALUES
(1, 'Museum affandi', 'Jalan Affandi no. 18', 854645, 9654645, '<p>das65</p>\n', 'museum-affandi.jpg', 'museum-affandi'),
(3, 'Museum Diponegoro', 'Jalan Diponegoro no. 1', 9393.232, 232.32423, '<p>Museum Diponegoro</p>\n', 'museum-diponegoro.jpg', 'museum-diponegoro'),
(5, 'a', 'a', 2, 2, '<p>a</p>\n', '', ''),
(6, 'aaa', 'a', 1, 1, 'aaa', '', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

CREATE TABLE IF NOT EXISTS `shelter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`id`, `nama`, `longitude`, `latitude`) VALUES
(2, 'Tugu', 893984, 9239023.923);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'staff', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, 'joko', '81dc9bdb52d04dc20036dbd8313ed055'),
(9, 'sasti', '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'budi', '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'aaa', '81dc9bdb52d04dc20036dbd8313ed055'),
(25, 'aab', '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'aan', '81dc9bdb52d04dc20036dbd8313ed055'),
(27, 'ali', '81dc9bdb52d04dc20036dbd8313ed055'),
(28, 'sunia', '81dc9bdb52d04dc20036dbd8313ed055'),
(29, 'arga', '81dc9bdb52d04dc20036dbd8313ed055'),
(30, 'bella', '81dc9bdb52d04dc20036dbd8313ed055'),
(31, 'wawan', '81dc9bdb52d04dc20036dbd8313ed055'),
(32, 'dsds', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `artikel_ibfk_4` FOREIGN KEY (`id_museum`) REFERENCES `museum` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `menu_user_privileges`
--
ALTER TABLE `menu_user_privileges`
  ADD CONSTRAINT `menu_user_privileges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_user_privileges_ibfk_2` FOREIGN KEY (`menu_admin_id`) REFERENCES `menu_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
