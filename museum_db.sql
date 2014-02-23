-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2014 at 08:38 PM
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
(19, 'a', '2014-02-14 06:15:11', 1, 1, 'a', '<p><img alt="" src="/museum/image_upload/images/window_smaller.png" />a</p>\n', '');

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
  `koordinat_rute` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `menu_admin`
--

INSERT INTO `menu_admin` (`id`, `nama`, `url`, `icon`) VALUES
(2, 'User', 'admin/user', 'fa-users'),
(3, 'Museum', 'admin/museum', 'fa-building-o'),
(4, 'Rute Trans Jogja', 'admin/trans', 'fa-truck'),
(5, 'Artikel', 'admin/artikel', 'fa-archive'),
(6, 'Shelter', 'admin/shelter', 'fa-arrow-down'),
(7, 'Home Slide', 'admin/slide', 'fa-desktop'),
(8, 'Relasi Shelter', 'admin/relasi_shelter', 'fa-road');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `menu_user_privileges`
--

INSERT INTO `menu_user_privileges` (`id`, `user_id`, `menu_admin_id`) VALUES
(24, 1, 2),
(25, 1, 3),
(26, 1, 4),
(27, 1, 5),
(28, 1, 6),
(29, 1, 7),
(30, 1, 8),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `museum`
--

INSERT INTO `museum` (`id`, `nama`, `alamat`, `longitude`, `latitude`, `keterangan`, `image`, `url`) VALUES
(1, 'Affandi Museum', 'Jalan Affandi no. 18', -7.782939, 110.396335, '<p>Mengunjungi Museum Affandi yang terletak di Jalan Raya Yogyakarta-Solo, atau tepatnya tepi barat Sungai Gajah Wong, memberi kesempatan bagi anda untuk menjejaki seluruh bagian berarti dari kehidupan Affandi. Anda bisa melihat karya-karya agung semasa sang maestro hidup, karya para pelukis lain yang ditampungnya, alat transportasi yang dipakainya dahulu, rumah yang ditinggali hingga sebuah sanggar yang kini dipakai untuk membina bakat melukis anak.</p>\n\n<p>Kompleks museum terdiri dari 3 buah galeri dengan galeri I sebagai tempat pembelian tiket dan permulaan tur. Galeri I yang dibuka secara pribadi oleh affandi sejak tahun 1962 dan diresmikan tahun 1974 ini memuat sejumlah lukisan Affandi dari awal berkarya hingga masa akhir hidupnya. Lukisan yang umumnya berupa lukisan sktesa dan karya reproduksi ini ditempatkan dalam 2 larik atas bawah dan memanjang memenuhi ruangan berbentuk lengkung.</p>\n\n<p>Masih di Galeri I, anda bisa melihat sejumlah barang berharga semasa Affandi hidup. Di ujung ruangan, anda bisa melihat mobil Colt Gallan tahun 1976 yang berwarna kuning kehijauan yang dimodifikasi sehingga menyerupai bentuk ikan, juga sebuah sepeda onthel kuno yang tampak mengkilap sebagai alat transportasi. Anda juga bisa melihat reproduksi patung karyanya berupa potret diri bersama putrinya, Kartika.</p>\n\n<p>Menuju Galeri II, anda bisa melihat sejumlah lukisan para pelukis, baik pemula maupun senior, yang ditampungnya dalam museum. Galeri yang diresmikan tahun 1988 ini terdiri dari dua lantai dengan lukisan yang dapat dilihat dari sudut pandang berbeda. Lantai pertama banyak berisi lukisan-lukisan yang bersifat abstrak, sementara lantai 2 memuat lukisan dengan corak realis namun memiliki ketegasan.</p>\n\n<p>Galeri III yang menjadi tujuan selanjutnya merupakan bangunan berbentuk garis melengkung dengan atap membentuk pelepah daun pisang. Bisa dikatakan, galeri berlantai 3 ini multifungsi, lantai pertama berfungsi sebagai ruang pameran sekaligus lokasi</p>\n', 'museum-affandi.jpg', 'affandi-museum'),
(3, 'Museum Diponegoro', 'Jalan Diponegoro no. 1', 110.35351429134607, -7.781049533840773, '<p>Museum Diponegoro</p>\n', 'museum-diponegoro.jpg', 'museum-diponegoro'),
(7, 'Museum Monjali', 'b', 110.36809477955103, -7.774628933187241, '<p>', '', 'museum-monjali'),
(8, 'Museum Sasmitaloka', 'aaa', 22, 22, '<p>aaaaa</p>\n', '', 'museum-sasmitaloka');

-- --------------------------------------------------------

--
-- Table structure for table `relasi_shelter`
--

CREATE TABLE IF NOT EXISTS `relasi_shelter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shelter_awal` int(11) NOT NULL,
  `id_shelter_tujuan` int(11) NOT NULL,
  `jalur` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shelter_awal` (`id_shelter_awal`,`id_shelter_tujuan`),
  KEY `shelter_tujuan` (`id_shelter_tujuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `relasi_shelter`
--

INSERT INTO `relasi_shelter` (`id`, `id_shelter_awal`, `id_shelter_tujuan`, `jalur`) VALUES
(2, 5, 6, '[{"d":-7.74679279346486,"e":110.36224731244147},{"d":-7.746819370760853,"e":110.36264453083277},{"d":-7.748754193404859,"e":110.36255870014429},{"d":-7.749392045075268,"e":110.36292348057032},{"d":-7.750114942466894,"e":110.36461863666773},{"d":-7.750370082426404,"e":110.36646399646997},{"d":-7.750625222231289,"e":110.36826644092798}]'),
(3, 6, 4, '[{"d":-7.7504551290452115,"e":110.36891017109156},{"d":-7.751092978138607,"e":110.37058420479298},{"d":-7.751305594288292,"e":110.37118501961231},{"d":-7.7542396861855325,"e":110.37006922066212},{"d":-7.756153213357084,"e":110.36981172859669},{"d":-7.762106353328158,"e":110.36933965981007}]'),
(4, 4, 7, '[{"d":-7.774628933187241,"e":110.36809477955103},{"d":-7.77813688943187,"e":110.36760125309229},{"d":-7.782686558678752,"e":110.36710772663355}]'),
(5, 7, 8, '[{"d":-7.78438735693418,"e":110.36700043827295}]'),
(6, 8, 9, '[{"d":-7.787470036179453,"e":110.36663565784693},{"d":-7.789404671570122,"e":110.36624941974878},{"d":-7.789787345643812,"e":110.36906037479639},{"d":-7.790510173495701,"e":110.36899600178003},{"d":-7.79048891387082,"e":110.3682878986001},{"d":-7.79048891387082,"e":110.36781582981348},{"d":-7.790233798287868,"e":110.36762271076441},{"d":-7.790074350969641,"e":110.3667856939137},{"d":-7.789946793071337,"e":110.36615269258618}]'),
(7, 9, 10, '[{"d":-7.790616471604001,"e":110.3661635890603}]'),
(9, 10, 11, '[{"d":-7.794719557959129,"e":110.36573443561792},{"d":-7.796335270046735,"e":110.3654769435525}]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`id`, `nama`, `longitude`, `latitude`) VALUES
(3, 'Tugu', 110.36760125309229, -7.783069238887897),
(4, 'Jetis', 110.36809477955103, -7.774628933187241),
(5, 'Jombor', 110.36224731244147, -7.74679279346486),
(6, 'Monjali', 110.36891017109156, -7.7504551290452115),
(7, 'Mangkubumi 1', 110.36700043827295, -7.78438735693418),
(8, 'Mangkubumi 2', 110.36663565784693, -7.787470036179453),
(9, 'Malioboro 1', 110.3661635890603, -7.790616471604001),
(10, 'Malioboro 2', 110.36573443561792, -7.794719557959129),
(11, 'Ahmad Yani', 110.36517653614283, -7.799672971314071),
(12, 'Taman Pintar (JL Senopati)', 110.36665711551905, -7.80137370057108),
(13, 'Brigjen Katamso', 110.36927495151758, -7.808282842037881),
(14, 'Kolonel Sugiono', 110.36910329014063, -7.814490342475656);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'staff', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, 'joko', '81dc9bdb52d04dc20036dbd8313ed055'),
(9, 'sasti', '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'budi', '81dc9bdb52d04dc20036dbd8313ed055'),
(27, 'ali', '81dc9bdb52d04dc20036dbd8313ed055'),
(29, 'arga', '81dc9bdb52d04dc20036dbd8313ed055'),
(31, 'wawan', '81dc9bdb52d04dc20036dbd8313ed055');

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

--
-- Constraints for table `relasi_shelter`
--
ALTER TABLE `relasi_shelter`
  ADD CONSTRAINT `relasi_shelter_ibfk_1` FOREIGN KEY (`id_shelter_awal`) REFERENCES `shelter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relasi_shelter_ibfk_2` FOREIGN KEY (`id_shelter_tujuan`) REFERENCES `shelter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
