-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2014 at 08:09 PM
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
(2, 'Chapter 376 Tujuan Fujitora', '2014-02-06 06:52:27', 1, NULL, 'chapter-376-tujuan-fujitora', '<p>Chapter 376 dfdfff dfffffffffff dffffffffff dffffffffffffffffffffffffffffffffffffff dfffffffffff dfffffffffffff dffffffffffvdf fdddddddddddd dfffffffffffff fdddddddddddddd dfffffffffffff</p>\n', 'museum-affandi.jpg'),
(7, 'Chapter 376 Tujuan Fujitora', '2014-02-06 06:51:43', 1, NULL, 'chapter-376-tujuan-fujitora', '<p>Chapter 376 dfdfff dfffffffffff dffffffffff dffffffffffffffffffffffffffffffffffffff dfffffffffff dfffffffffffff dffffffffffvdf fdddddddddddd dfffffffffffff fdddddddddddddd dfffffffffffff</p>\n', 'museum-affandi.jpg'),
(19, 'a', '2014-02-14 06:15:11', 1, NULL, 'a', '<p><img alt="" src="/museum/image_upload/images/window_smaller.png" />a</p>\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_museum` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_museum` (`id_museum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `id_museum`, `judul`, `url`) VALUES
(1, 10, 'Museum Affandi', 'affandi-1.jpg'),
(2, 10, 'Museum Affandi', 'affandi-2.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `jalur`
--

INSERT INTO `jalur` (`id`, `nama`, `rute`) VALUES
(16, 'JALUR 1A', 'HALTE PRAMBANAN - Jl. Raya Yogya-Solo - HALTE JL. SOLO (KR 1) - Bandara Adisutjipto - HALTE BANDARA ADISUTJIPTO - Jl. Laksda Adisucipto - HALTE JL. SOLO (JAYAKARTA) - Jl. Janti - HALTE JL. SOLO (JANTI FLYOVER) - Jl. Laksda Adisucipto - HALTE JL. SOLO (JOGJA BISNIS) - HALTE JL. SOLO (GEDUNG WANITA) - Jl. Urip Sumoharjo - HALTE URIP SUMOHARJO - Jl. Jend. Sudirman -HALTE SUDIRMAN 1 - HALTE SUDIRMAN 2 - Tugu Jogja - Jl. P. Mangkubumi -HALTE MANGKUBUMI 1 - HALTE MANGKUBUMI 2 - Stasiun Tugu - Jl. Malioboro -HALTE MALIOBORO 1 - HALTE MALIOBORO 2 - Jl. Jend. Ahmad Yani - HALTE AHMAD YANI - Jl. Senopati - HALTE SENOPATI 2 - Jl. Sultan Agung - HALTE PURO PAKUALAMAN - Jl. Kusumanegara - HALTE KUSUMANEGARA 1 - HALTE KUSUMANEGARA 3 - Gembiraloka - HALTE KUSUMANEGARA (GEDUNG JUANG 45) - Jl. Janti - HALTE GEDONG KUNING (JEC) - JEC - Jl. Laksda Adisucipto -HALTE JL. SOLO (JANTI) - HALTE JL. SOLO (ALFA) - HALTE JL. SOLO (MAGUWO) - Bandara Adisutjipto - HALTE BANDARA ADISUTJIPTO - Jl. Raya Yogya-Solo - HALTE JL. SOLO (KR 2) - HALTE JL. SOLO (KALASAN) - Terminal Prambanan (istirahat 15 menit) - HALTE PRAMBANAN'),
(17, 'JALUR 1B', 'Bandara Adisutjipto - HALTE BANDARA ADISUTJIPTO - Jl. Laksda Adisucipto - HALTE JL. SOLO (JAYAKARTA) - Jl. Janti - HALTE JL. SOLO (JANTI FLYOVER) - HALTE RS. AU DR.S. HARDJOLUKITO -HALTE GEDONG KUNING (WONOCATUR) - JEC - Jl. Kusumanegara - HALTE KUSUMANEGARA (GEMBIRALOKA) - Gembiraloka - HALTE KUSUMANEGARA 4 - HALTE KUSUMANEGARA 2 - Jl. Sultan Agung - HALTE MUSEUM BIOLOGI - Jl. Senopati - HALTE SENOPATI 1 - Jl. KHA Dahlan - Jl. Bhayangkara - Jl. Jogonegaran - Jl. Gandekan Lor - Jl. Jlagran Lor - Jl. Tentara Rakyat Mataram - Jl. Tentara Pelajar - HALTE TENTARA PELAJAR 1 - Jl. Diponegoro - Tugu Jogja - Jl. Jend. Sudirman - HALTE SUDIRMAN 3 - Jl. Cik Di Tiro - HALTE CIK DI TIRO 2 - UGM - Jl. Terban - HALTE JL. COLOMBO (KOSUDGAMA) - Jl. Colombo - HALTE JL. COLOMBO (UNY) - Jl. Gejayan (Jl. Affandi) - Jl. Laksda Adisucipto - HALTE JL. SOLO (DEBRITO) - HALTE JL. SOLO (AMBARUKMO) - Jl. Janti - HALTE JL. SOLO (JANTI FLYOVER) - Jl. Laksda Adisucipto - HALTE JL. SOLO (JANTI) - HALTE JL. SOLO (ALFA) - HALTE JL. SOLO (MAGUWO) - Bandara Adisutjipto (istirahat 15 menit)'),
(18, 'JALUR 2A', 'Terminal Jombor - HALTE TERMINAL JOMBOR - Jl. Magelang - Jl. Ring Road Utara - HALTE RING ROAD UTARA (MONJALI 1) - Jl. Monjali - Jl. AM Sangaji - HALTE AM SANGAJI 2 - Tugu Jogja - Jl. P. Mangkubumi -HALTE MANGKUBUMI 1 - HALTE MANGKUBUMI 2 - Jl. Malioboro - HALTE MALIOBORO 1 - HALTE MALIOBORO 2 - Jl. Jend. Ahmad Yani - HALTE AHMAD YANI - Jl. Senopati - HALTE SENOPATI 2 - Jl. Brigjend. Katamso - HALTE KATAMSO 1 - Jl. Kolonel Sugiyono - HALTE SUGIONO 1 - Jl. Menteri Supeno - Jl. Veteran - HALTE RSI HIDAYATULLAH - Jl. Gambiran - Jl. Perintis Kemerdekaan - Jl. Ngeksigondo - HALTE NGEKSIGONDO (DIKLAT PU) - Jl. Gedong Kuning - HALTE GEDONG KUNING (DEP. KEHUTANAN) - Jl. Janti - Jl. Kusumanegara - HALTE KUSUMANEGARA (GEMBIRALOKA) - Gembiraloka - HALTE KUSUMANEGARA 4 - Jl. Cendana - Jl. Gayam - HALTE KENARI 1 - Jl. Dr. Sutomo - Jl. Krasak - Jl. Laksda Yos Sudarso - HALTE YOS SUDARSO - Jl. Trimo - Jl. Dr. Wahidin Sudirohusodo - Jl. Jend. Sudirman - HALTE SUDIRMAN 1 - Jl. Cik Di Tiro - HALTE CIK DI TIRO 2 - UGM - Jl. Terban - HALTE JL. COLOMBO (KOSUDGAMA) - Jl. Colombo -HALTE JL. COLOMBO (UNY) - Jl. Gejayan (Jl. Affandi) - HALTE UNY - HALTE SANTREN - Jl. Anggajaya - Terminal Condongcatur - HALTE TERMINAL CONDONGCATUR - Jl. Anggajaya - Jl. Ring Road Utara - HALTE RING ROAD UTARA (MANGGUNG) - HALTE RING ROAD UTARA (MONJALI 2) - Jl. Magelang - Terminal Jombor (istirahat 15 menit)'),
(19, 'JALUR 2B', 'Terminal Jombor - HALTE TERMINAL JOMBOR - Jl. Magelang - Jl. Ring Road Utara - HALTE RING ROAD UTARA (MONJALI 1) - HALTE RING ROAD UTARA (KENTUNGAN) - Jl. Anggajaya - Terminal Condongcatur -HALTE TERMINAL CONDONGCATUR - Jl. Anggajaya - Jl. Gejayan (Jl. Affandi) - HALTE SUSTERAN NOVISIAT -HALTE SANATA DHARMA - Jl. Colombo - HALTE JL. COLOMBO (SAMIRONO) - Jl. Terban - HALTE JL. COLOMBO (PANTI RAPIH) - UGM - Jl. Cik Di Tiro - HALTE CIK DI TIRO 1 - Jl. Suroto - Jl. Laksda Yos Sudarso - HALTE YOS SUDARSO - Jl. Trimo - Jl. Dr. Sutomo - Jl. Gayam - HALTE KENARI 2 - Jl. Cendana - Jl. Kusumanegara - HALTE KUSUMANEGARA 3 - Gembiraloka - HALTE KUSUMANEGARA (GEDUNG JUANG 45)- Jl. Gedong Kuning - HALTE GEDONG KUNING (BANGUNTAPAN) - Jl. Ngeksigondo - HALTE NGEKSIGONDO (BASEN) - Jl. Perintis Kemerdekaan - Jl. Gambiran - Jl. Veteran - HALTE PASAR SENI KERAJINAN YOGYAKARTA - Jl. Menteri Supeno - Jl. Kolonel Sugiyono - HALTE SUGIONO 2 - Jl. Brigjend. Katamso -HALTE KATAMSO 2 - Jl. Senopati - HALTE SENOPATI 1 - Jl. KHA Dahlan - HALTE KHA DAHLAN 1 - Jl. Kyai Haji Wahid Hasyim - Taman Parkir Ngabean - HALTE NGABEAN - Jl. Kyai Haji Wahid Hasyim - Jl. RE Martadinata - Jl. HOS Cokroaminoto - HALTE COKROAMINOTO (SMA 1) - HALTE SMPN 11 - Jl. Pembela Tanah Air - Jl. Tentara Rakyat Mataram - Jl. Tentara Pelajar - HALTE TENTARA PELAJAR 1 - Jl. Diponegoro - Tugu - Jl. AM Sangaji - HALTE AM SANGAJI 1 - Jl. Monjali - HALTE KARANGJATI - Jl. Ring Road Utara -HALTE RING ROAD UTARA (MONJALI 2) - Jl. Magelang - Terminal Jombor (istirahat 15 menit)'),
(20, 'JALUR 3A', 'Terminal Giwangan - HALTE GIWANGAN - Jl. Kyai Gunomrico - Jl. Imogiri Timur - Jl. Tegalgendu - HALTE TEGAL GENDU 1 - Jl. Mondorakan - Jl. Nyi Pembayun - Jl. Kemasan - Jl. Gedong Kuning - HALTE GEDONG KUNING (DEP. KEHUTANAN) - Jl. Janti - HALTE GEDONG KUNING (JEC) - Jl. Laksda Adisucipto - HALTE JL. SOLO (JANTI) - HALTE JL. SOLO (ALFA) - HALTE JL. SOLO (MAGUWO) - Bandara Adisutjipto - HALTE BANDARA ADISUTJIPTO - Jl. Raya Laksda Adisucipto - Jl. Ring Road Utara - HALTE RING ROAD UTARA (DISNAKER) - HALTE RING ROAD UTARA (INSTIPER 2) - HALTE RING ROAD UTARA (UPN) - Jl. Anggajaya - Terminal Condongcatur - HALTE TERMINAL CONDONGCATUR - Jl. Anggajaya - Jl. Ring Road Utara - HALTE RING ROAD UTARA (MANGGUNG) - Jl. Kaliurang - Jl. Teknika Selatan - Jl. Kesehatan - HALTE FK-UGM - Jl. Bhineka Tunggal Ika - Jl. Persatuan - HALTE JL. KALIURANG (KOPMA UGM) - Jl. Terban - UGM - Jl. Cik Di Tiro - HALTE CIK DI TIRO 1 - Jl. Suroto - Jl. Laksda Yos Sudarso - HALTE YOS SUDARSO - Jl. FM Noto -HALTE KOTABARU - Jl. Jend. Sudirman - HALTE SUDIRMAN 2 - Tugu - Jl. Diponegoro - HALTE DIPONEGORO - Jl. Tentara Pelajar - HALTE TENTARA PELAJAR 2 - Jl. Tentara Rakyat Mataram - Jl. Jlagran Lor - HALTE JLAGRAN - Jl. Pasar Kembang - Jl. Malioboro - HALTE MALIOBORO 1 - HALTE MALIOBORO 2 - Jl. Jenderal Ahmad Yani - HALTE AHMAD YANI - Jl. KHA Dahlan - HALTE KHA DAHLAN 1 - Jl. Kyai Haji Wahid Hasyim - Taman Parkir Ngabean - HALTE NGABEAN - Jl. Kyai Haji Wahid Hasyim - Jl. Letnan Jenderal MT Haryono - HALTE MT HARYONO 1 - Jl. Mayjend. Sutoyo - Jl. Kolonel Sugiyono - HALTE SUGIONO 1 - Jl. Lowanu - HALTE LOWANU - Jl. Sorogenen - HALTE SOROGENEN - Jl. Tegal Turi - HALTE TEGAL TURI 1 - Jl. Imogiri Timur - Terminal Giwangan (istirahat 15 menit)'),
(21, 'JALUR 3B', 'Terminal Giwangan - HALTE GIWANGAN - Jl. Kyai Gunomrico - Jl. Imogiri Timur - Jl. Tegal Turi - HALTE TEGAL TURI 2 - Jl. Sorogenen - HALTE SOROGENEN (NITIKAN) - Jl. Lowanu - HALTE PA MUHAMMADIYAH - Jl. Kolonel Sugiyono - HALTE SUGIONO 2 - Jl. Mayjend. Sutoyo - Jl. Letjend. MT Haryono - HALTE MT HARYONO 2 - Jl. Kyai Haji Wahid Hasyim - HALTE TEJOKUSUMAN - Taman Parkir Ngabean - HALTE NGABEAN - Jl. Kyai Haji Wahid Hasyim - Jl. KHA Dahlan - HALTE KHA DAHLAN 2 - Jl. Bhayangkara - Jl. Jogonegaran - Jl. Gandekan Lor - Jl. Jlagran Lor - Jl. Tentara Rakyat Mataram - Jl. Tentara Pelajar - HALTE TENTARA PELAJAR 1 - Jl. Diponegoro - Tugu Jogja - Jl. Jenderal Sudirman - HALTE SUDIRMAN 3 - Jl. Cik Di Tiro - HALTE CIK DI TIRO 2 - Jl. Terban - UGM - Jl. Persatuan - HALTE JL. KALIURANG (PERTANIAN UGM) - Jl. Bhineka Tunggal Ika - Jl. Kesehatan - HALTE RSUP DR. SARDJITO - Jl. Teknika Utara - Jl. Kaliurang - Jl. Ring Road Utara - HALTE RING ROAD UTARA (KENTUNGAN) - Jl. Anggajaya - Terminal Condongcatur -HALTE TERMINAL CONDONGCATUR - Jl. Anggajaya - Jl. Ring Road Utara - HALTE RING ROAD UTARA (JIH) -HALTE RING ROAD UTARA (STIKES GUNA BANGSA) - HALTE RING ROAD UTARA (INSTIPER 1) - HALTE RING ROAD UTARA (BINAMARGA) - Jl. Laksda Adisucipto - HALTE JL. SOLO (MAGUWO) - Bandara Adisutjipto -HALTE BANDARA ADISUTJIPTO - Jl. Laksda Adisucipto - HALTE JL. SOLO (JAYAKARTA) - Jl. Janti - HALTE JL. SOLO (JANTI FLYOVER) - HALTE RS. AU DR.S. HARDJOLUKITO - HALTE GEDONG KUNING (WONOCATUR) - JEC - Jl. Gedong Kuning - HALTE GEDONG KUNING (BANGUNTAPAN) - Jl. Kemasan - Jl. Nyi Pembayun - Jl. Mondorakan - Jl. Tegal Gendu - HALTE TEGAL GENDU 2 - Jl. Imogiri Timur - Terminal Giwangan (istirahat 15 menit)');

-- --------------------------------------------------------

--
-- Table structure for table `koordinat_rute`
--

CREATE TABLE IF NOT EXISTS `koordinat_rute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jalur` int(11) NOT NULL,
  `id_shelter` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jalur` (`id_jalur`,`id_shelter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=218 ;

--
-- Dumping data for table `koordinat_rute`
--

INSERT INTO `koordinat_rute` (`id`, `id_jalur`, `id_shelter`) VALUES
(64, 16, 15),
(52, 16, 18),
(74, 16, 18),
(70, 16, 26),
(72, 16, 34),
(56, 16, 37),
(54, 16, 38),
(71, 16, 39),
(53, 16, 40),
(55, 16, 41),
(49, 16, 42),
(76, 16, 42),
(51, 16, 43),
(75, 16, 44),
(73, 16, 45),
(69, 16, 55),
(67, 16, 57),
(68, 16, 59),
(62, 16, 62),
(63, 16, 63),
(60, 16, 64),
(61, 16, 65),
(50, 16, 74),
(77, 16, 74),
(66, 16, 75),
(65, 16, 93),
(58, 16, 97),
(59, 16, 98),
(57, 16, 113),
(78, 17, 18),
(99, 17, 18),
(90, 17, 20),
(82, 17, 27),
(91, 17, 28),
(92, 17, 31),
(97, 17, 34),
(94, 17, 35),
(93, 17, 36),
(80, 17, 38),
(95, 17, 38),
(96, 17, 39),
(79, 17, 40),
(98, 17, 45),
(83, 17, 56),
(85, 17, 58),
(84, 17, 60),
(86, 17, 68),
(81, 17, 87),
(87, 17, 92),
(89, 17, 99),
(88, 17, 108),
(107, 18, 15),
(102, 18, 17),
(119, 18, 20),
(113, 18, 25),
(120, 18, 28),
(121, 18, 31),
(109, 18, 48),
(116, 18, 50),
(114, 18, 56),
(115, 18, 60),
(105, 18, 62),
(106, 18, 63),
(103, 18, 64),
(104, 18, 65),
(112, 18, 71),
(125, 18, 82),
(101, 18, 83),
(126, 18, 84),
(111, 18, 88),
(123, 18, 91),
(108, 18, 93),
(118, 18, 97),
(110, 18, 100),
(124, 18, 110),
(100, 18, 111),
(127, 18, 111),
(122, 18, 112),
(117, 18, 114),
(136, 19, 19),
(149, 19, 21),
(141, 19, 24),
(135, 19, 29),
(134, 19, 30),
(153, 19, 47),
(145, 19, 49),
(138, 19, 51),
(147, 19, 52),
(140, 19, 55),
(139, 19, 59),
(148, 19, 69),
(142, 19, 70),
(143, 19, 73),
(130, 19, 81),
(129, 19, 83),
(154, 19, 84),
(133, 19, 90),
(146, 19, 92),
(150, 19, 94),
(144, 19, 101),
(132, 19, 102),
(151, 19, 108),
(131, 19, 110),
(128, 19, 111),
(155, 19, 111),
(137, 19, 114),
(152, 19, 115),
(180, 20, 15),
(163, 20, 18),
(171, 20, 19),
(175, 20, 22),
(169, 20, 23),
(158, 20, 25),
(159, 20, 26),
(170, 20, 32),
(161, 20, 34),
(160, 20, 39),
(162, 20, 45),
(177, 20, 46),
(181, 20, 52),
(173, 20, 54),
(185, 20, 61),
(178, 20, 62),
(179, 20, 63),
(183, 20, 66),
(182, 20, 69),
(164, 20, 77),
(165, 20, 79),
(168, 20, 82),
(166, 20, 86),
(186, 20, 95),
(174, 20, 98),
(184, 20, 100),
(157, 20, 103),
(187, 20, 105),
(176, 20, 109),
(167, 20, 110),
(172, 20, 114),
(156, 20, 116),
(188, 20, 116),
(210, 21, 18),
(200, 21, 20),
(215, 21, 24),
(214, 21, 27),
(201, 21, 33),
(212, 21, 38),
(211, 21, 40),
(209, 21, 45),
(197, 21, 53),
(194, 21, 67),
(196, 21, 69),
(192, 21, 72),
(208, 21, 76),
(207, 21, 78),
(205, 21, 80),
(203, 21, 81),
(206, 21, 85),
(213, 21, 87),
(202, 21, 89),
(191, 21, 96),
(199, 21, 99),
(193, 21, 101),
(216, 21, 104),
(190, 21, 106),
(195, 21, 107),
(198, 21, 108),
(204, 21, 110),
(189, 21, 116),
(217, 21, 116);

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
  `link_youtube` varchar(255) DEFAULT NULL,
  `folder_gallery` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `museum`
--

INSERT INTO `museum` (`id`, `nama`, `alamat`, `longitude`, `latitude`, `keterangan`, `image`, `url`, `link_youtube`, `folder_gallery`) VALUES
(9, 'Museum Sonobudoyo', 'Jl. Trikora No. 6 , Yogyakarta', 110.363953, -7.802431, '<p>Museum Sonobudoyo</p>\n <p><img alt="" src="/museum/image_upload/images/Museum_Sonobudoyo.jpg"  /></p>\n\n<p>Museum Negeri Sonobudoyo merupakan Unit Pelaksana Teknis Daerah pada Dinas Kebudayaan Provinsi DIY, mempunyai fungsi pengelolaan benda museum yang memiliki nilai budaya ilmiah, meliputi koleksi pengembangan dan bimbingan edukatif cultural. Sedangkan tugasnya adalah mengumpulkan, merawat, pengawetan, melaksanakan penelitian, pelayanan pustaka, bimbingan edukatif cultural serta penyajian benda koleksi Museum Negeri Sonobudoyo.</p>\n\n<p>', '', 'museum-sonobudoyo', NULL, NULL),
(10, 'Museum Affandi', 'Jl. Laksda Adisucipto 167, Yogyakarta 55281', 110.396359, -7.782724, '<p>Museum Affandi</p>\r\n\r\n<p><strong>Museum Affandi</strong> yang terletak di pinggir sungai Gajah Wong, atau di Jalan Laksda Adisucipto Nomor 167 Yogyakarta (Jalan Solo Km 5,1) adalah museum yang menyimpan hasil karya pelukis legendaris Affandi. Lebih dari 300 buah lukisannya disimpan di dalam museum ini yang terdiri dari 3 galeri dan sebuah rumah yang dahulu dipakai sebagai tempat tinggal pelukis ini. Rumah ini mempunyai atap berbentuk daun pisang, dan terdiri dari dua lantai dengan lantai atas sebagai kamar pribadi Affandi yang bernuansa artistik.</p>\r\n\r\n<p>Museum tersebut berisi seluruh karya-karya sang maestro Affandi semasa hidupnya, karya-karya para pelukis lain, alat transportasi yang dipakainya dahulu, rumah yang ditinggalinya sampai sebuah sanggar yang saat ini dipakai untuk membina bakat melukis anak.</p>\r\n\r\n<p>', '', 'museum-affandi', '//www.youtube.com/embed/vgMA1lxd5xw', 'museum_affandi'),
(11, 'Museum Wayang Kekayon', 'Jl. Raya Yogya-Wonosari Km. 7', 110.412975, -7.815136, 'Museum Wayang Kekayon', '', 'museum-wayang-kekayon', NULL, NULL),
(12, 'Museum Ullen Sentalu', 'Jl. Boyong Kaliurang Donoharjo Ngaglik Sleman Daerah Istimewa Yogyakarta, Indonesia', 110.420987, -7.609669, 'Museum Ullen Sentalu', '', 'museum-ullen-sentalu', NULL, NULL),
(13, 'Museum Pusat TNI AU Dirgantara Mandala Yogyakarta', 'Bandara Adi Sucipto, Maguworejo, Depok, Yogyakarta', 110.416383, -7.789745, 'Museum Pusat TNI AU Dirgantara Mandala Yogyakarta', '', 'museum-pusat-tni-au-dirgantara-mandala-yogyakarta', NULL, NULL),
(14, 'Museum Benteng Vrederbug', 'Jl. Jenderal A. Yani No. 6, Yogyakarta', 110.366028, -7.800289, 'Museum Benteng Vrederbug', '', 'museum-benteng-vrederbug', NULL, NULL),
(15, 'Museum Keraton Yogyakarta', 'Jl. Rotowijayan 1, Yogyakarta 55133', 110.364057, -7.806553, 'Museum Keraton Yogyakarta', '', 'museum-keraton-yogyakarta', NULL, NULL),
(16, 'Museum Batik Yogyakarta', 'Jl. Dr Sutomo 13 A RT 049 RW 12 Bausasran Danurejan, Yogyakarta', 110.377589, -7.796165, '<p>Museum Batik Yogyakarta</p>\n', '', 'museum-batik-yogyakarta', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=158 ;

--
-- Dumping data for table `relasi_shelter`
--

INSERT INTO `relasi_shelter` (`id`, `id_shelter_awal`, `id_shelter_tujuan`, `jalur`) VALUES
(29, 74, 43, '[{"d":"-7.755696","e":"110.489807"},{"d":-7.755696,"e":110.489807},{"d":-7.7567910538134,"e":110.48249870539},{"d":-7.7573013254821,"e":110.48026710749},{"d":-7.7729068348443,"e":110.46653419733},{"d":"-7.781722","e":"110.450583"}]'),
(30, 43, 18, '[{"d":"-7.781722","e":"110.450583"},{"d":-7.781722,"e":110.450583},{"d":-7.7836219985732,"e":110.44705063105},{"d":-7.7834731787297,"e":110.43795660138},{"d":-7.7847912955057,"e":110.43782785535},{"d":-7.7846849959193,"e":110.43739870191},{"d":"-7.784581","e":"110.436364"}]'),
(31, 18, 40, '[{"d":"-7.784581","e":"110.436364"},{"d":-7.784581,"e":110.436364},{"d":-7.7846424760772,"e":110.43714120984},{"d":-7.7847275157571,"e":110.43778494},{"d":-7.7835156986904,"e":110.43808534741},{"d":"-7.783444","e":"110.419335"}]'),
(32, 40, 38, '[{"d":"-7.783444","e":"110.419335"},{"d":-7.783444,"e":110.419335},{"d":-7.7834731787297,"e":110.41051223874},{"d":"-7.785729","e":"110.410433"}]'),
(33, 38, 41, '[{"d":"-7.785729","e":"110.410433"},{"d":-7.785729,"e":110.410433},{"d":-7.7833881387953,"e":110.41027620435},{"d":"-7.783338","e":"110.401745"}]'),
(34, 41, 37, '[{"d":"-7.783338","e":"110.401745"},{"d":-7.783338,"e":110.401745},{"d":"-7.783215","e":"110.392746"}]'),
(35, 37, 113, '[{"d":"-7.783215","e":"110.392746"},{"d":-7.783215,"e":110.392746},{"d":"-7.783093","e":"110.386086"}]'),
(36, 113, 97, '[{"d":"-7.783093","e":"110.386086"},{"d":-7.783093,"e":110.386086},{"d":"-7.78304","e":"110.377999"}]'),
(37, 97, 98, '[{"d":"-7.78304","e":"110.377999"},{"d":-7.78304,"e":110.377999},{"d":"-7.783024","e":"110.3695"}]'),
(38, 98, 64, '[{"d":"-7.783024","e":"110.3695"},{"d":-7.783024,"e":110.3695},{"d":-7.7829629388648,"e":110.36723211408},{"d":-7.7831542788869,"e":110.36695316434},{"d":"-7.784749","e":"110.366859"}]'),
(39, 64, 65, '[{"d":"-7.784749","e":"110.366859"},{"d":-7.784749,"e":110.366859},{"d":"-7.787645","e":"110.366468"}]'),
(40, 65, 62, '[{"d":"-7.787645","e":"110.366468"},{"d":-7.787645,"e":110.366468},{"d":-7.7894684506067,"e":110.36618068814},{"d":-7.7897448263196,"e":110.36841228604},{"d":-7.7898086053043,"e":110.36892727017},{"d":-7.7905314331195,"e":110.36897018552},{"d":-7.790616471604,"e":110.36839082837},{"d":-7.7903826157301,"e":110.36774709821},{"d":-7.7901487597257,"e":110.36746814847},{"d":-7.7900424614987,"e":110.36671712995},{"d":-7.7899999422003,"e":110.36605194211},{"d":"-7.79084","e":"110.366087"}]'),
(41, 62, 63, '[{"d":"-7.79084","e":"110.366087"},{"d":-7.795209,"e":110.365561},{"d":"-7.795209","e":"110.365561"}]'),
(42, 63, 15, '[{"d":"-7.795209","e":"110.365561"},{"d":-7.795209,"e":110.365561},{"d":-7.7964628259985,"e":110.36545112729},{"d":"-7.799907","e":"110.364992"}]'),
(43, 15, 93, '[{"d":"-7.799907","e":"110.364992"},{"d":-7.799907,"e":110.364992},{"d":-7.801394959643,"e":110.36480739713},{"d":"-7.801384","e":"110.367589"}]'),
(44, 93, 75, '[{"d":"-7.801384","e":"110.367589"},{"d":-7.801384,"e":110.367589},{"d":"-7.801639","e":"110.375749"}]'),
(45, 75, 57, '[{"d":"-7.801639","e":"110.375749"},{"d":-7.801639,"e":110.375749},{"d":"-7.801849","e":"110.383474"}]'),
(46, 57, 59, '[{"d":"-7.801849","e":"110.383474"},{"d":-7.801849,"e":110.383474},{"d":"-7.802099","e":"110.393057"}]'),
(47, 59, 55, '[{"d":"-7.802099","e":"110.393057"},{"d":-7.802099,"e":110.393057},{"d":"-7.802245","e":"110.399921"}]'),
(48, 55, 26, '[{"d":"-7.802245","e":"110.399921"},{"d":-7.802245,"e":110.399921},{"d":-7.8023941348054,"e":110.4022295773},{"d":-7.7988438632939,"e":110.40237978101},{"d":"-7.798549","e":"110.402829"}]'),
(49, 26, 39, '[{"d":"-7.798549","e":"110.402829"},{"d":-7.798549,"e":110.402829},{"d":-7.7986525304405,"e":110.40609195828},{"d":-7.7985887528033,"e":110.40984705091},{"d":-7.783366878809,"e":110.41049078107},{"d":"-7.783213","e":"110.411583"}]'),
(50, 39, 34, '[{"d":"-7.783213","e":"110.411583"},{"d":-7.783213,"e":110.411583},{"d":"-7.783247","e":"110.419783"}]'),
(51, 34, 45, '[{"d":"-7.783247","e":"110.419783"},{"d":-7.783247,"e":110.419783},{"d":"-7.783385","e":"110.430919"}]'),
(52, 45, 18, '[{"d":"-7.783385","e":"110.430919"},{"d":-7.783385,"e":110.430919},{"d":-7.7834944387106,"e":110.43797805905},{"d":-7.7847700355905,"e":110.43787077069},{"d":-7.7847275157571,"e":110.43744161725},{"d":-7.7845361764532,"e":110.43673351407},{"d":"-7.784581","e":"110.436364"}]'),
(53, 18, 44, '[{"d":"-7.784581","e":"110.436364"},{"d":-7.784581,"e":110.436364},{"d":-7.7847912955057,"e":110.43744161725},{"d":-7.7847487756744,"e":110.43782785535},{"d":-7.783366878809,"e":110.43799951673},{"d":-7.7834944387106,"e":110.44692590833},{"d":"-7.782519","e":"110.448743"}]'),
(54, 44, 42, '[{"d":"-7.782519","e":"110.448743"},{"d":-7.782519,"e":110.448743},{"d":-7.7746289331872,"e":110.46336248517},{"d":-7.7730556584368,"e":110.46634510159},{"d":"-7.769912","e":"110.468969"}]'),
(55, 42, 74, '[{"d":"-7.769912","e":"110.468969"},{"d":-7.769912,"e":110.468969},{"d":-7.7573438480932,"e":110.4801812768},{"d":"-7.755696","e":"110.489807"}]'),
(56, 38, 87, '[{"d":"-7.785729","e":"110.410433"},{"d":-7.785729,"e":110.410433},{"d":"-7.797303","e":"110.410086"}]'),
(57, 87, 27, '[{"d":"-7.797303","e":"110.410086"},{"d":-7.797303,"e":110.410086},{"d":-7.7986312712292,"e":110.40993288159},{"d":"-7.798642","e":"110.40642"}]'),
(58, 27, 56, '[{"d":"-7.798642","e":"110.40642"},{"d":-7.798642,"e":110.40642},{"d":-7.7987375672751,"e":110.40235832334},{"d":-7.8023090987143,"e":110.40225103498},{"d":"-7.80228","e":"110.398805"}]'),
(59, 56, 60, '[{"d":"-7.80228","e":"110.398805"},{"d":-7.80228,"e":110.398805},{"d":"-7.802152","e":"110.393366"}]'),
(60, 60, 58, '[{"d":"-7.802152","e":"110.393366"},{"d":-7.802152,"e":110.393366},{"d":"-7.801884","e":"110.382143"}]'),
(61, 58, 68, '[{"d":"-7.801884","e":"110.382143"},{"d":-7.801884,"e":110.382143},{"d":"-7.801682","e":"110.374218"}]'),
(62, 68, 92, '[{"d":"-7.801682","e":"110.374218"},{"d":-7.801682,"e":110.374218},{"d":"-7.80153","e":"110.367002"}]'),
(63, 92, 108, '[{"d":"-7.80153","e":"110.367002"},{"d":-7.80153,"e":110.367002},{"d":-7.8013311824239,"e":110.36197498441},{"d":-7.799545416341,"e":110.36210373044},{"d":-7.7963990480275,"e":110.36212518811},{"d":-7.7955699335196,"e":110.36120250821},{"d":-7.7935928076803,"e":110.3612883389},{"d":-7.7919133063525,"e":110.36158874631},{"d":-7.7897660859822,"e":110.3620608151},{"d":-7.7895747489794,"e":110.36152437329},{"d":-7.7894471909289,"e":110.35809114575},{"d":-7.7893834118891,"e":110.35742595792},{"d":-7.7882353875121,"e":110.35746887326},{"d":-7.7876401143742,"e":110.35916402936},{"d":"-7.786564","e":"110.359895"}]'),
(64, 108, 99, '[{"d":"-7.786564","e":"110.359895"},{"d":-7.786564,"e":110.359895},{"d":-7.7849401148812,"e":110.36066606641},{"d":-7.7828141187873,"e":110.36073043942},{"d":"-7.782886","e":"110.368832"}]'),
(65, 99, 20, '[{"d":"-7.782886","e":"110.368832"},{"d":-7.782886,"e":110.368832},{"d":-7.7829841988716,"e":110.37489250302},{"d":"-7.781185","e":"110.375143"}]'),
(66, 20, 28, '[{"d":"-7.781185","e":"110.375143"},{"d":-7.781185,"e":110.375143},{"d":-7.7761862567766,"e":110.37597427145},{"d":-7.7760347767495,"e":110.37582406774},{"d":-7.7759125296702,"e":110.37583211437},{"d":-7.7758062278332,"e":110.37595549598},{"d":-7.7758168580181,"e":110.37609765306},{"d":-7.7759630230334,"e":110.37621030584},{"d":-7.7760932427314,"e":110.37618884817},{"d":-7.7761703115132,"e":110.37769088522},{"d":"-7.776168","e":"110.378584"}]'),
(67, 28, 31, '[{"d":"-7.776168","e":"110.378584"},{"d":-7.776168,"e":110.378584},{"d":-7.776276613258,"e":110.37926115096},{"d":-7.7770313548716,"e":110.38298405707},{"d":-7.7772971086377,"e":110.38420714438},{"d":-7.7779349169893,"e":110.38608469069},{"d":"-7.777741","e":"110.386725"}]'),
(68, 31, 36, '[{"d":"-7.777741","e":"110.386725"},{"d":-7.777741,"e":110.386725},{"d":-7.7776372732126,"e":110.38751162589},{"d":-7.7779136567266,"e":110.38868106902},{"d":-7.7830160888797,"e":110.38771547377},{"d":"-7.783067","e":"110.393894"}]'),
(69, 36, 35, '[{"d":"-7.783067","e":"110.393894"},{"d":-7.783067,"e":110.393894},{"d":"-7.783173","e":"110.402365"}]'),
(70, 35, 38, '[{"d":"-7.783173","e":"110.402365"},{"d":-7.783173,"e":110.402365},{"d":-7.783366878809,"e":110.41042640805},{"d":"-7.785729","e":"110.410433"}]'),
(71, 38, 39, '[{"d":"-7.785729","e":"110.410433"},{"d":-7.785729,"e":110.410433},{"d":-7.7865133450475,"e":110.41036203504},{"d":-7.7834519187477,"e":110.41034057736},{"d":"-7.783213","e":"110.411583"}]'),
(72, 111, 83, '[{"d":"-7.747471","e":"110.36171"},{"d":-7.747471,"e":110.36171},{"d":-7.7467874780055,"e":110.36180533469},{"d":-7.7468406325965,"e":110.36245979369},{"d":-7.7492644748185,"e":110.36235250533},{"d":-7.7503594515978,"e":110.36558188498},{"d":"-7.750479","e":"110.367584"}]'),
(73, 83, 17, '[{"d":"-7.750479","e":"110.367584"},{"d":-7.750479,"e":110.367584},{"d":-7.7511780246114,"e":110.37134796381},{"d":-7.7547074380756,"e":110.36988884211},{"d":-7.7618512204868,"e":110.36928802729},{"d":-7.7652104571598,"e":110.36903053522},{"d":-7.7668688046035,"e":110.36898761988},{"d":"-7.775742","e":"110.367952"}]'),
(74, 17, 64, '[{"d":"-7.775742","e":"110.367952"},{"d":-7.775742,"e":110.367952},{"d":-7.7782431906783,"e":110.36755397916},{"d":-7.7807944125111,"e":110.36729648709},{"d":"-7.784749","e":"110.366859"}]'),
(75, 93, 48, '[{"d":"-7.801384","e":"110.367589"},{"d":-7.801384,"e":110.367589},{"d":-7.8015650321797,"e":110.36939933896},{"d":-7.8036696740964,"e":110.36924913526},{"d":-7.8039885583111,"e":110.36942079663},{"d":"-7.808719","e":"110.369143"}]'),
(76, 48, 100, '[{"d":"-7.808719","e":"110.369143"},{"d":-7.808719,"e":110.369143},{"d":-7.8147454432594,"e":110.36873415112},{"d":"-7.814775","e":"110.370028"}]'),
(77, 100, 88, '[{"d":"-7.814775","e":"110.370028"},{"d":-7.814775,"e":110.370028},{"d":-7.8169137936271,"e":110.38409382105},{"d":"-7.815575","e":"110.387747"}]'),
(78, 88, 71, '[{"d":"-7.815575","e":"110.387747"},{"d":-7.815575,"e":110.387747},{"d":-7.8144478256632,"e":110.39162948728},{"d":-7.8179767063595,"e":110.39072826505},{"d":"-7.818933","e":"110.395097"}]'),
(79, 71, 25, '[{"d":"-7.818933","e":"110.395097"},{"d":-7.818933,"e":110.395097},{"d":-7.8205914601583,"e":110.4009206593},{"d":"-7.819491","e":"110.401147"}]'),
(80, 25, 56, '[{"d":"-7.819491","e":"110.401147"},{"d":-7.819491,"e":110.401147},{"d":-7.8173814755629,"e":110.40195062757},{"d":-7.8023728757843,"e":110.40216520429},{"d":"-7.80228","e":"110.398805"}]'),
(81, 60, 50, '[{"d":"-7.802152","e":"110.393366"},{"d":-7.802152,"e":110.393366},{"d":-7.8021815445453,"e":110.39188697934},{"d":-7.7996517121546,"e":110.39225175977},{"d":-7.7984611974996,"e":110.38778856397},{"d":-7.7975895685504,"e":110.38456991315},{"d":-7.7974407536703,"e":110.38364723325},{"d":"-7.797502","e":"110.383198"}]'),
(82, 50, 114, '[{"d":"-7.797502","e":"110.383198"},{"d":-7.797502,"e":110.383198},{"d":-7.7974194943974,"e":110.37881925702},{"d":-7.7972281608926,"e":110.37763908505},{"d":-7.7953360804127,"e":110.37778928876},{"d":-7.7914030767667,"e":110.37787511945},{"d":-7.7893196328396,"e":110.3782184422},{"d":-7.7881928680303,"e":110.37841156125},{"d":-7.7885968029331,"e":110.37635162473},{"d":-7.7882779069895,"e":110.37495687604},{"d":-7.788554283488,"e":110.37446334958},{"d":-7.7883416861977,"e":110.37330463529},{"d":-7.7870448403905,"e":110.37317588925},{"d":-7.7868747619541,"e":110.37405565381},{"d":"-7.787268","e":"110.375313"}]'),
(83, 114, 97, '[{"d":"-7.787268","e":"110.375313"},{"d":-7.787268,"e":110.375313},{"d":-7.7876188546036,"e":110.37600830197},{"d":-7.7870448403905,"e":110.37639454007},{"d":-7.7873637372727,"e":110.37847593427},{"d":-7.7837070384601,"e":110.37913240492},{"d":-7.7830267188819,"e":110.37922896445},{"d":"-7.78304","e":"110.377999"}]'),
(84, 97, 20, '[{"d":"-7.78304","e":"110.377999"},{"d":-7.78304,"e":110.377999},{"d":-7.7829629388648,"e":110.37488378584},{"d":"-7.781185","e":"110.375143"}]'),
(85, 31, 112, '[{"d":"-7.777741","e":"110.386725"},{"d":-7.777741,"e":110.386725},{"d":-7.7776160129347,"e":110.38750089705},{"d":-7.7779136567266,"e":110.38862742484},{"d":"-7.775134","e":"110.389088"}]'),
(86, 112, 91, '[{"d":"-7.775134","e":"110.389088"},{"d":-7.775134,"e":110.389088},{"d":-7.7711209476186,"e":110.38997322321},{"d":"-7.766964","e":"110.391679"}]'),
(87, 91, 110, '[{"d":"-7.766964","e":"110.391679"},{"d":-7.766964,"e":110.391679},{"d":-7.7634245372082,"e":110.39364650846},{"d":-7.7612346488141,"e":110.39420440793},{"d":-7.7585557407026,"e":110.39566352963},{"d":"-7.756637","e":"110.395943"}]'),
(88, 110, 82, '[{"d":"-7.756637","e":"110.395943"},{"d":-7.756637,"e":110.395943},{"d":-7.7584706957212,"e":110.39581373334},{"d":-7.7598314133606,"e":110.38967683911},{"d":-7.7595975403297,"e":110.38817480206},{"d":"-7.758059","e":"110.386387"}]'),
(89, 82, 84, '[{"d":"-7.758059","e":"110.386387"},{"d":-7.758059,"e":110.386387},{"d":-7.7537931952599,"e":110.38197353482},{"d":-7.7519859652456,"e":110.37774637341},{"d":-7.7521347962459,"e":110.37579372525},{"d":"-7.750833","e":"110.368749"}]'),
(90, 84, 111, '[{"d":"-7.750833","e":"110.368749"},{"d":-7.750833,"e":110.368749},{"d":-7.749413306781,"e":110.36225393414},{"d":-7.7479037230079,"e":110.36240413785},{"d":-7.7477017360363,"e":110.36170877516},{"d":"-7.747471","e":"110.36171"}]'),
(91, 83, 81, '[{"d":"-7.750479","e":"110.367584"},{"d":-7.750479,"e":110.367584},{"d":-7.7520922731083,"e":110.37590101361},{"d":-7.751943442093,"e":110.37759616971},{"d":-7.752666335103,"e":110.38002088666},{"d":-7.7542184247236,"e":110.38274601102},{"d":"-7.755276","e":"110.383865"}]'),
(92, 81, 110, '[{"d":"-7.755276","e":"110.383865"},{"d":-7.755276,"e":110.383865},{"d":-7.7595762791386,"e":110.38851812482},{"d":-7.7598101521814,"e":110.38991287351},{"d":-7.7584069119738,"e":110.39566352963},{"d":"-7.756637","e":"110.395943"}]'),
(93, 110, 102, '[{"d":"-7.756637","e":"110.395943"},{"d":-7.756637,"e":110.395943},{"d":-7.7584494344731,"e":110.39579227567},{"d":-7.7613409543394,"e":110.39420440793},{"d":-7.7633820152121,"e":110.39375379682},{"d":"-7.765944","e":"110.392221"}]'),
(94, 102, 90, '[{"d":"-7.765944","e":"110.392221"},{"d":-7.765944,"e":110.392221},{"d":-7.7711209476186,"e":110.39002016187},{"d":"-7.775025","e":"110.389273"}]'),
(95, 90, 30, '[{"d":"-7.775025","e":"110.389273"},{"d":-7.775025,"e":110.389273},{"d":-7.7779242868581,"e":110.38863815367},{"d":"-7.777656","e":"110.387505"}]'),
(96, 30, 29, '[{"d":"-7.777656","e":"110.387505"},{"d":-7.777656,"e":110.387505},{"d":-7.7779242868581,"e":110.38612760603},{"d":-7.7769675739427,"e":110.38314498961},{"d":-7.776414805486,"e":110.37954010069},{"d":-7.7762553529112,"e":110.3793040663},{"d":"-7.776229","e":"110.37819"}]'),
(97, 29, 19, '[{"d":"-7.776229","e":"110.37819"},{"d":-7.776229,"e":110.37819},{"d":-7.7760959002758,"e":110.37620443851},{"d":-7.7761995444957,"e":110.37604132667},{"d":"-7.782272","e":"110.375095"}]'),
(98, 19, 114, '[{"d":"-7.782272","e":"110.375095"},{"d":-7.782272,"e":110.375095},{"d":-7.7868853918584,"e":110.3743044287},{"d":"-7.787268","e":"110.375313"}]'),
(99, 114, 51, '[{"d":"-7.787268","e":"110.375313"},{"d":-7.787268,"e":110.375313},{"d":-7.7875550752855,"e":110.37609413266},{"d":-7.7870023207879,"e":110.37645891309},{"d":-7.7873849970562,"e":110.37847593427},{"d":-7.7890219971468,"e":110.37828281522},{"d":-7.7912330001,"e":110.37781074643},{"d":-7.7923172376669,"e":110.37785366178},{"d":-7.7946557797224,"e":110.37774637341},{"d":-7.7968880122236,"e":110.37774637341},{"d":-7.7972494201752,"e":110.37766054273},{"d":-7.7974620129421,"e":110.3816087544},{"d":-7.7974832722129,"e":110.38281038404},{"d":"-7.797475","e":"110.38331"}]'),
(100, 51, 59, '[{"d":"-7.797475","e":"110.38331"},{"d":-7.797475,"e":110.38331},{"d":-7.7976108278147,"e":110.38373306394},{"d":-7.7976108278147,"e":110.38441970944},{"d":-7.7977596426343,"e":110.38489177823},{"d":-7.8019051770455,"e":110.38416221738},{"d":"-7.802099","e":"110.393057"}]'),
(101, 55, 24, '[{"d":"-7.802245","e":"110.399921"},{"d":-7.802245,"e":110.399921},{"d":-7.8023941348054,"e":110.40216520429},{"d":"-7.807244","e":"110.402231"}]'),
(102, 24, 70, '[{"d":"-7.807244","e":"110.402231"},{"d":-7.807244,"e":110.402231},{"d":-7.8174239920765,"e":110.4019895196},{"d":-7.8193372307063,"e":110.40125995874},{"d":-7.8208252991306,"e":110.40095955133},{"d":"-7.81922","e":"110.395087"}]'),
(103, 70, 73, '[{"d":"-7.81922","e":"110.395087"},{"d":-7.81922,"e":110.395087},{"d":-7.8180192228124,"e":110.39074569941},{"d":-7.8146604096821,"e":110.39156109095},{"d":-7.8144371964594,"e":110.39156712592},{"d":"-7.816226","e":"110.385974"}]'),
(104, 73, 101, '[{"d":"-7.816226","e":"110.385974"},{"d":-7.816226,"e":110.385974},{"d":-7.8168925353448,"e":110.38388326764},{"d":"-7.815192","e":"110.371843"}]'),
(105, 101, 49, '[{"d":"-7.815192","e":"110.371843"},{"d":-7.815192,"e":110.371843},{"d":-7.8147029264729,"e":110.36869123578},{"d":-7.804031076188,"e":110.3694422543},{"d":-7.8036271561827,"e":110.36920621991},{"d":"-7.80275","e":"110.369194"}]'),
(106, 49, 92, '[{"d":"-7.80275","e":"110.369194"},{"d":-7.80275,"e":110.369194},{"d":-7.8015437731164,"e":110.36931350827},{"d":"-7.80153","e":"110.367002"}]'),
(107, 92, 52, '[{"d":"-7.80153","e":"110.367002"},{"d":-7.80153,"e":110.367002},{"d":"-7.801241","e":"110.36008"}]'),
(108, 52, 69, '[{"d":"-7.801241","e":"110.36008"},{"d":-7.801241,"e":110.36008},{"d":-7.8011717393337,"e":110.35640873015},{"d":-7.8028193150014,"e":110.35638827831},{"d":-7.8028193150014,"e":110.35623271018},{"d":"-7.803723","e":"110.356247"}]'),
(109, 69, 21, '[{"d":"-7.803723","e":"110.356247"},{"d":-7.803723,"e":110.356247},{"d":-7.8010760734503,"e":110.3562156111},{"d":-7.8010229257279,"e":110.35174168646},{"d":"-7.79932","e":"110.35203"}]'),
(110, 21, 94, '[{"d":"-7.79932","e":"110.35203"},{"d":-7.79932,"e":110.35203},{"d":"-7.792942","e":"110.353412"}]'),
(111, 94, 108, '[{"d":"-7.792942","e":"110.353412"},{"d":-7.792942,"e":110.353412},{"d":-7.7901912790089,"e":110.35382308066},{"d":-7.7902550579257,"e":110.35435952246},{"d":-7.7902656877442,"e":110.35535730422},{"d":-7.789362152207,"e":110.35734213889},{"d":-7.788224757642,"e":110.35753525794},{"d":-7.7875338155106,"e":110.35923041403},{"d":-7.7872999579157,"e":110.35941280425},{"d":"-7.786564","e":"110.359895"}]'),
(112, 108, 115, '[{"d":"-7.786564","e":"110.359895"},{"d":-7.786564,"e":110.359895},{"d":-7.7853227930328,"e":110.36062315106},{"d":-7.782877898827,"e":110.36077335477},{"d":-7.7829151038457,"e":110.36695132032},{"d":-7.7827715987554,"e":110.36701837555},{"d":-7.7781475195577,"e":110.36759890616},{"d":"-7.7771366","e":"110.3677134"}]'),
(113, 115, 47, '[{"d":"-7.7771366","e":"110.3677134"},{"d":-7.7771366,"e":110.3677134},{"d":-7.7694200955791,"e":110.36860540509},{"d":-7.7661671968685,"e":110.36905601621},{"d":"-7.764381","e":"110.369065"}]'),
(114, 47, 84, '[{"d":"-7.764381","e":"110.369065"},{"d":-7.764381,"e":110.369065},{"d":-7.7547924838179,"e":110.36988884211},{"d":-7.7512630710669,"e":110.37121921778},{"d":"-7.750833","e":"110.368749"}]'),
(115, 116, 106, '[{"d":"-7.833932","e":"110.391916"},{"d":-7.833932,"e":110.391916},{"d":-7.8339838444968,"e":110.39259910583},{"d":-7.8338775574268,"e":110.39309263229},{"d":-7.83253833802,"e":110.39335012436},{"d":-7.832176960617,"e":110.39092540741},{"d":-7.8320281580657,"e":110.39006710052},{"d":-7.8294772489218,"e":110.38980960846},{"d":-7.825884692061,"e":110.39004564285},{"d":-7.8257358872629,"e":110.38867235184},{"d":-7.8254382775072,"e":110.38759946823},{"d":"-7.825422","e":"110.386947"}]'),
(116, 116, 103, '[{"d":"-7.833932","e":"110.391916"},{"d":-7.833932,"e":110.391916},{"d":-7.8339838444968,"e":110.39262056351},{"d":-7.8338563000095,"e":110.39307117462},{"d":-7.83253833802,"e":110.3933930397},{"d":-7.8321557031129,"e":110.39090394974},{"d":-7.8320281580657,"e":110.39000272751},{"d":-7.8294134759931,"e":110.38980960846},{"d":-7.825119409676,"e":110.39013147354},{"d":"-7.826026","e":"110.391775"}]'),
(117, 103, 25, '[{"d":"-7.826026","e":"110.391775"},{"d":-7.826026,"e":110.391775},{"d":-7.8270326130044,"e":110.39330720901},{"d":-7.8273089638705,"e":110.39457321167},{"d":-7.8274365103623,"e":110.3969335556},{"d":-7.8275215413351,"e":110.39815664291},{"d":-7.8278404073287,"e":110.39987325668},{"d":-7.8277553764209,"e":110.4003238678},{"d":-7.8245667048576,"e":110.40036678314},{"d":-7.8221432981592,"e":110.4007101059},{"d":"-7.819491","e":"110.401147"}]'),
(118, 25, 26, '[{"d":"-7.819491","e":"110.401147"},{"d":-7.819491,"e":110.401147},{"d":-7.8176365745796,"e":110.40189027786},{"d":-7.8143627920253,"e":110.40204048157},{"d":-7.8074962686167,"e":110.40212631226},{"d":-7.7988226040923,"e":110.40238380432},{"d":"-7.798549","e":"110.402829"}]'),
(119, 18, 77, '[{"d":"-7.784581","e":"110.436364"},{"d":-7.784581,"e":110.436364},{"d":-7.784578696306,"e":110.43685555458},{"d":-7.7847700355905,"e":110.43748855591},{"d":-7.7847381457158,"e":110.43781042099},{"d":-7.7836326285601,"e":110.43797135353},{"d":-7.7835263286799,"e":110.42974233627},{"d":"-7.769324","e":"110.431067"}]'),
(120, 77, 79, '[{"d":"-7.769324","e":"110.431067"},{"d":-7.769324,"e":110.431067},{"d":-7.7671345648031,"e":110.43130874634},{"d":-7.7658270229994,"e":110.42980670929},{"d":"-7.764522","e":"110.423608"}]'),
(121, 79, 86, '[{"d":"-7.764522","e":"110.423608"},{"d":-7.764522,"e":110.423608},{"d":-7.7618405899484,"e":110.41195392609},{"d":"-7.760629","e":"110.407992"}]'),
(122, 86, 110, '[{"d":"-7.760629","e":"110.407992"},{"d":-7.760629,"e":110.407992},{"d":-7.7581517768875,"e":110.40036678314},{"d":-7.7585770019453,"e":110.39568901062},{"d":"-7.756637","e":"110.395943"}]'),
(123, 82, 23, '[{"d":"-7.758059","e":"110.386387"},{"d":-7.758059,"e":110.386387},{"d":-7.7549413138256,"e":110.38335084915},{"d":-7.7567697924805,"e":110.38225650787},{"d":-7.7658482838743,"e":110.37852287292},{"d":-7.7647320864884,"e":110.37617862225},{"d":-7.7649978480398,"e":110.37614107132},{"d":-7.7649553262028,"e":110.37596940994},{"d":-7.7648064997398,"e":110.37579774857},{"d":-7.7651891962526,"e":110.37534713745},{"d":-7.7657207186089,"e":110.37508964539},{"d":-7.7662947619984,"e":110.37502527237},{"d":-7.7667837613041,"e":110.37468194962},{"d":"-7.767802","e":"110.37425"}]'),
(124, 23, 32, '[{"d":"-7.767802","e":"110.37425"},{"d":-7.767802,"e":110.37425},{"d":-7.7706106927302,"e":110.37320137024},{"d":-7.7709083414905,"e":110.3733086586},{"d":-7.7717375047814,"e":110.37614107132},{"d":"-7.774275","e":"110.375138"}]'),
(125, 32, 19, '[{"d":"-7.774275","e":"110.375138"},{"d":-7.774275,"e":110.375138},{"d":-7.7760321192047,"e":110.37427425385},{"d":-7.7762447227374,"e":110.37504673004},{"d":-7.776079955009,"e":110.37579238415},{"d":-7.7758832966677,"e":110.37583529949},{"d":-7.7758195155643,"e":110.37593185902},{"d":-7.7758088853794,"e":110.37605524063},{"d":-7.7759205023069,"e":110.37620544434},{"d":-7.7761065304534,"e":110.37617862225},{"d":-7.7761889143205,"e":110.37604182959},{"d":"-7.782272","e":"110.375095"}]'),
(126, 114, 54, '[{"d":"-7.787268","e":"110.375313"},{"d":-7.787268,"e":110.375313},{"d":-7.7883204264627,"e":110.37483215332},{"d":-7.7885330237638,"e":110.37395238876},{"d":-7.7883204264627,"e":110.3733086586},{"d":-7.7870023207879,"e":110.3731584549},{"d":-7.7870235805897,"e":110.37240743637},{"d":"-7.784666","e":"110.371364"}]'),
(127, 54, 98, '[{"d":"-7.784666","e":"110.371364"},{"d":-7.784666,"e":110.371364},{"d":-7.784196017475,"e":110.3711950779},{"d":-7.7829841988716,"e":110.37137746811},{"d":"-7.783024","e":"110.3695"}]'),
(128, 98, 22, '[{"d":"-7.783024","e":"110.3695"},{"d":-7.783024,"e":110.3695},{"d":"-7.782878","e":"110.362537"}]'),
(129, 22, 109, '[{"d":"-7.782878","e":"110.362537"},{"d":-7.782878,"e":110.362537},{"d":-7.7828460088083,"e":110.36079883575},{"d":-7.7854290924574,"e":110.36061644554},{"d":"-7.787162","e":"110.35975"}]'),
(130, 109, 46, '[{"d":"-7.787162","e":"110.35975"},{"d":-7.787162,"e":110.35975},{"d":-7.7873531073805,"e":110.35954356194},{"d":-7.7876188546036,"e":110.35954356194},{"d":-7.7876613741437,"e":110.35927534103},{"d":-7.7882566472513,"e":110.35751581192},{"d":-7.7893834118891,"e":110.35742998123},{"d":"-7.789508","e":"110.360168"}]'),
(131, 46, 62, '[{"d":"-7.789508","e":"110.360168"},{"d":-7.789508,"e":110.360168},{"d":-7.7895960086507,"e":110.36153912544},{"d":-7.7898936439356,"e":110.36244034767},{"d":-7.7899149035907,"e":110.36415696144},{"d":-7.7898511246221,"e":110.36447882652},{"d":-7.7899042737633,"e":110.36615252495},{"d":-7.7900424614987,"e":110.36680698395},{"d":-7.7900956106156,"e":110.36752581596},{"d":-7.7902125386489,"e":110.3676867485},{"d":-7.7903613560988,"e":110.36783695221},{"d":-7.790478284058,"e":110.36771893501},{"d":-7.7903719859146,"e":110.36760091782},{"d":-7.7901912790089,"e":110.36756873131},{"d":-7.7901487597257,"e":110.36684989929},{"d":-7.7899680527237,"e":110.36616325378},{"d":"-7.79084","e":"110.366087"}]'),
(132, 15, 52, '[{"d":"-7.799907","e":"110.364992"},{"d":-7.799907,"e":110.364992},{"d":-7.8014481073182,"e":110.36477923393},{"d":"-7.801241","e":"110.36008"}]'),
(133, 69, 66, '[{"d":"-7.803723","e":"110.356247"},{"d":-7.803723,"e":110.356247},{"d":-7.8042224065806,"e":110.35633563995},{"d":-7.8071986458549,"e":110.35612106323},{"d":-7.8129172175316,"e":110.35588502884},{"d":-7.8132042069836,"e":110.35608887672},{"d":-7.8131723192765,"e":110.35644292831},{"d":"-7.813228","e":"110.357322"}]'),
(134, 66, 100, '[{"d":"-7.813228","e":"110.357322"},{"d":-7.813228,"e":110.357322},{"d":-7.8145541176862,"e":110.36599159241},{"d":-7.814809218431,"e":110.36850214005},{"d":"-7.814775","e":"110.370028"}]'),
(135, 100, 61, '[{"d":"-7.814775","e":"110.370028"},{"d":-7.814775,"e":110.370028},{"d":-7.8157658448356,"e":110.37611961365},{"d":-7.8162122697407,"e":110.37611961365},{"d":-7.8180829974838,"e":110.37588357925},{"d":"-7.819738","e":"110.376473"}]'),
(136, 61, 95, '[{"d":"-7.819738","e":"110.376473"},{"d":-7.819738,"e":110.376473},{"d":-7.8248430573584,"e":110.37850141525},{"d":"-7.824753","e":"110.379223"}]'),
(137, 95, 105, '[{"d":"-7.824753","e":"110.379223"},{"d":-7.824753,"e":110.379223},{"d":-7.8248217994802,"e":110.38135528564},{"d":-7.8250981518119,"e":110.38202047348},{"d":-7.8254170196593,"e":110.38515329361},{"d":"-7.825361","e":"110.387055"}]'),
(138, 105, 116, '[{"d":"-7.825361","e":"110.387055"},{"d":-7.825361,"e":110.387055},{"d":-7.8258209185826,"e":110.38888692856},{"d":-7.8259272077079,"e":110.39004564285},{"d":-7.8295410218408,"e":110.38978815079},{"d":-7.832687140389,"e":110.39006710052},{"d":-7.8339519583787,"e":110.39058208466},{"d":-7.8340051019076,"e":110.39069473743},{"d":-7.8339360153187,"e":110.39126873016},{"d":"-7.833932","e":"110.391916"}]'),
(139, 106, 96, '[{"d":"-7.825422","e":"110.386947"},{"d":-7.825422,"e":110.386947},{"d":-7.8252256989802,"e":110.38378000259},{"d":-7.8251619254009,"e":110.38261055946},{"d":-7.8247899126609,"e":110.38132309914},{"d":"-7.824809","e":"110.379974"}]'),
(140, 96, 72, '[{"d":"-7.824809","e":"110.379974"},{"d":-7.824809,"e":110.379974},{"d":-7.8248217994802,"e":110.37852287292},{"d":-7.8181680303638,"e":110.37590503693},{"d":"-7.816855","e":"110.37599"}]'),
(141, 72, 101, '[{"d":"-7.816855","e":"110.37599"},{"d":-7.816855,"e":110.37599},{"d":-7.8157658448356,"e":110.37614107132},{"d":"-7.815192","e":"110.371843"}]'),
(142, 101, 67, '[{"d":"-7.815192","e":"110.371843"},{"d":-7.815192,"e":110.371843},{"d":-7.8147241848667,"e":110.36878108978},{"d":-7.8148517352066,"e":110.36843776703},{"d":"-7.813459","e":"110.358167"}]'),
(143, 67, 107, '[{"d":"-7.813459","e":"110.358167"},{"d":-7.813459,"e":110.358167},{"d":-7.8132148362188,"e":110.35609960556},{"d":-7.8129172175316,"e":110.35588502884},{"d":"-7.807943","e":"110.356"}]'),
(144, 107, 69, '[{"d":"-7.807943","e":"110.356"},{"d":-7.807943,"e":110.356},{"d":-7.804434995803,"e":110.35624980927},{"d":-7.8041480003272,"e":110.35636782646},{"d":-7.8040204467192,"e":110.35627126694},{"d":"-7.803723","e":"110.356247"}]'),
(145, 69, 53, '[{"d":"-7.803723","e":"110.356247"},{"d":-7.803723,"e":110.356247},{"d":-7.8028246297512,"e":110.35623371601},{"d":-7.8028086855018,"e":110.35637319088},{"d":-7.8011451654794,"e":110.35642683506},{"d":-7.8011929984159,"e":110.35984396935},{"d":"-7.801193","e":"110.36056"}]'),
(146, 53, 108, '[{"d":"-7.801193","e":"110.36056"},{"d":-7.801193,"e":110.36056},{"d":-7.8012674051951,"e":110.36200046539},{"d":-7.7994178613291,"e":110.36211848259},{"d":-7.7962927513875,"e":110.36209702492},{"d":-7.7955274147826,"e":110.36121726036},{"d":-7.7935715482119,"e":110.36128163338},{"d":-7.7904038753604,"e":110.36192536354},{"d":-7.7897979754742,"e":110.36206483841},{"d":-7.7896066384859,"e":110.36150693893},{"d":-7.7893727820482,"e":110.35742998123},{"d":-7.7882779069895,"e":110.35748362541},{"d":-7.7875550752855,"e":110.35916805267},{"d":-7.7873956269475,"e":110.35929679871},{"d":-7.7873105878092,"e":110.35955429077},{"d":"-7.786564","e":"110.359895"}]'),
(147, 20, 33, '[{"d":"-7.781185","e":"110.375143"},{"d":-7.781185,"e":110.375143},{"d":-7.7761756266011,"e":110.3759855032},{"d":-7.7761384209845,"e":110.37589430809},{"d":-7.7760892564147,"e":110.37429437041},{"d":"-7.77448","e":"110.374923"}]'),
(148, 33, 89, '[{"d":"-7.77448","e":"110.374923"},{"d":-7.77448,"e":110.374923},{"d":-7.7716949836268,"e":110.3760766983},{"d":-7.770823299009,"e":110.37327647209},{"d":-7.7705362805071,"e":110.3731906414},{"d":"-7.769529","e":"110.373555"}]'),
(149, 89, 81, '[{"d":"-7.769529","e":"110.373555"},{"d":-7.769529,"e":110.373555},{"d":-7.7673578032409,"e":110.37433862686},{"d":-7.7667412396479,"e":110.37464976311},{"d":-7.7664754791994,"e":110.3748857975},{"d":-7.766103414289,"e":110.37506818771},{"d":-7.7651785657986,"e":110.37525057793},{"d":-7.7648171302032,"e":110.37570118904},{"d":-7.7646257818209,"e":110.37584066391},{"d":-7.7645619990074,"e":110.3760445118},{"d":-7.7647958692761,"e":110.37620544434},{"d":-7.7657632403683,"e":110.37856578827},{"d":-7.7568548378059,"e":110.38221359253},{"d":-7.7550050980985,"e":110.38330793381},{"d":"-7.755276","e":"110.383865"}]'),
(150, 110, 80, '[{"d":"-7.756637","e":"110.395943"},{"d":-7.756637,"e":110.395943},{"d":-7.7583643894702,"e":110.39575338364},{"d":-7.7581092543581,"e":110.39983034134},{"d":"-7.758822","e":"110.403062"}]'),
(151, 80, 85, '[{"d":"-7.758822","e":"110.403062"},{"d":-7.758822,"e":110.403062},{"d":"-7.760751","e":"110.408895"}]'),
(152, 85, 78, '[{"d":"-7.760751","e":"110.408895"},{"d":-7.760751,"e":110.408895},{"d":-7.7620638311987,"e":110.41221141815},{"d":"-7.764248","e":"110.423503"}]'),
(153, 78, 76, '[{"d":"-7.764248","e":"110.423503"},{"d":-7.764248,"e":110.423503},{"d":-7.7659333273631,"e":110.43036460876},{"d":-7.7674641072172,"e":110.43135166168},{"d":"-7.774443","e":"110.430782"}]'),
(154, 76, 45, '[{"d":"-7.774443","e":"110.430782"},{"d":-7.774443,"e":110.430782},{"d":-7.7835369586691,"e":110.42984962463},{"d":"-7.783385","e":"110.430919"}]'),
(155, 24, 104, '[{"d":"-7.807244","e":"110.402231"},{"d":-7.807244,"e":110.402231},{"d":-7.807244,"e":110.402231},{"d":-7.817211409465,"e":110.40199756622},{"d":-7.8205702020634,"e":110.40088176727},{"d":-7.8247367679567,"e":110.40040969849},{"d":-7.8276703454958,"e":110.40036678314},{"d":-7.8276278300267,"e":110.39830684662},{"d":-7.8273727371213,"e":110.39684772491},{"d":-7.8274577681071,"e":110.39525985718},{"d":-7.8270751285342,"e":110.39350032806},{"d":"-7.82589","e":"110.391327"}]'),
(156, 104, 116, '[{"d":"-7.82589","e":"110.391327"},{"d":-7.82589,"e":110.391327},{"d":-7.8252256989802,"e":110.3900885582},{"d":-7.829392218348,"e":110.38978815079},{"d":-7.8328359427048,"e":110.39013147354},{"d":-7.8339360153187,"e":110.3905659914},{"d":-7.8339679014381,"e":110.39070010185},{"d":"-7.833932","e":"110.391916"}]'),
(157, 27, 24, '[{"d":"-7.798642","e":"110.40642"},{"d":-7.798642,"e":110.40642},{"d":-7.798758826481,"e":110.40242671967},{"d":"-7.807244","e":"110.402231"}]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`id`, `nama`, `longitude`, `latitude`) VALUES
(15, 'HALTE AHMAD YANI', 110.364992, -7.799907),
(17, 'HALTE AM SANGAJI 2', 110.367952, -7.775742),
(18, 'HALTE BANDARA ADI SUTJIPTO', 110.436364, -7.784581),
(19, 'HALTE CIK DITIRO 1', 110.375095, -7.782272),
(20, 'HALTE CIK DITIRO 2', 110.375143, -7.781185),
(21, 'HALTE COKROAMINOTO (SMA 1)', 110.35203, -7.79932),
(22, 'HALTE DIPONEGORO', 110.362537, -7.782878),
(23, 'HALTE FK UGM', 110.37425, -7.767802),
(24, 'HALTE GEDONG KUNING (BANGUNTAPAN)', 110.402231, -7.807244),
(25, 'HALTE GEDONG KUNING (DEP. KEHUTANAN)', 110.401147, -7.819491),
(26, 'HALTE GEDONG KUNING (JEC)', 110.402829, -7.798549),
(27, 'HALTE GEDONG KUNING(WONOCATUR)', 110.40642, -7.798642),
(28, 'HALTE COLOMBO (KOSUDGAMA)', 110.378584, -7.776168),
(29, 'HALTE COLOMBO (PANTI RAPIH)', 110.37819, -7.776229),
(30, 'HALTE COLOMBO (SAMIRONO)', 110.387505, -7.777656),
(31, 'HALTE COLOMBO (UNY)', 110.386725, -7.777741),
(32, 'HALTE JL KALIURANG (KOPMA UGM)', 110.375138, -7.774275),
(33, 'HALTE JL KALIURANG (PERTANIAN UGM)', 110.374923, -7.77448),
(34, 'HALTE JL SOLO (ALFA)', 110.419783, -7.783247),
(35, 'HALTE JL SOLO (AMBARUKMO)', 110.402365, -7.783173),
(36, 'HALTE JL SOLO (DEBRITO)', 110.393894, -7.783067),
(37, 'HALTE JL SOLO (GEDUNG WANITA)', 110.392746, -7.783215),
(38, 'HALTE JL SOLO (JANTI FLYOVER)', 110.410433, -7.785729),
(39, 'HALTE JL SOLO (JANTI)', 110.411583, -7.783213),
(40, 'HALTE JL SOLO (JAYAKARTA)', 110.419335, -7.783444),
(41, 'HALTE JL SOLO (JOGJA BISNIS)', 110.401745, -7.783338),
(42, 'HALTE JL SOLO (KALASAN)', 110.468969, -7.769912),
(43, 'HALTE JL SOLO (KR 1)', 110.450583, -7.781722),
(44, 'HALTE JL SOLO (KR 2)', 110.448743, -7.782519),
(45, 'HALTE JL SOLO (MAGUWO)', 110.430919, -7.783385),
(46, 'HALTE JLAGRAN', 110.360168, -7.789508),
(47, 'HALTE KARANGJATI', 110.369065, -7.764381),
(48, 'HALTE KATAMSO 1', 110.369143, -7.808719),
(49, 'HALTE KATAMSO 2', 110.369194, -7.80275),
(50, 'HALTE KENARI 1', 110.383198, -7.797502),
(51, 'HALTE KENARI 2', 110.38331, -7.797475),
(52, 'HALTE KHA DAHLAN 1', 110.36008, -7.801241),
(53, 'HALTE KHA DAHLAN 2', 110.36056, -7.801193),
(54, 'HALTE KOTABARU', 110.371364, -7.784666),
(55, 'HALTE KUSUMANEGARA (GEDUNG JUANG 45)', 110.399921, -7.802245),
(56, 'HALTE KUSUMANEGARA (GEMBIRALOKA)', 110.398805, -7.80228),
(57, 'HALTE KUSUMANEGARA 1', 110.383474, -7.801849),
(58, 'HALTE KUSUMANEGARA 2', 110.382143, -7.801884),
(59, 'HALTE KUSUMANEGARA 3', 110.393057, -7.802099),
(60, 'HALTE KUSUMANEGARA 4', 110.393366, -7.802152),
(61, 'HALTE LOWANU', 110.376473, -7.819738),
(62, 'HALTE MALIOBORO 1', 110.366087, -7.79084),
(63, 'HALTE MALIOBORO 2', 110.365561, -7.795209),
(64, 'HALTE MANGKUBUMI 1', 110.366859, -7.784749),
(65, 'HALTE MANGKUBUMI 2', 110.366468, -7.787645),
(66, 'HALTE MT HARYONO 1', 110.357322, -7.813228),
(67, 'HALTE MT HARYONO 2', 110.358167, -7.813459),
(68, 'HALTE MUSEUM BIOLOGI', 110.374218, -7.801682),
(69, 'HALTE NGABEAN', 110.356247, -7.803723),
(70, 'HALTE NGEKSIGONDO (BASEN)', 110.395087, -7.81922),
(71, 'HALTE NGEKSIGONDO (DIKLAT PU)', 110.395097, -7.818933),
(72, 'HALTE PA MUHAMMADIYAH', 110.37599, -7.816855),
(73, 'HALTE PASAR SENI KERAJINAN YOGYAKARTA', 110.385974, -7.816226),
(74, 'HALTE PRAMBANAN', 110.489807, -7.755696),
(75, 'HALTE PURO PAKUALAMAN', 110.375749, -7.801639),
(76, 'HALTE RING ROAD UTARA (BINAMARGA)', 110.430782, -7.774443),
(77, 'HALTE RING ROAD UTARA (DISNAKER)', 110.431067, -7.769324),
(78, 'HALTE RING ROAD UTARA (INSTIPER 1)', 110.423503, -7.764248),
(79, 'HALTE RING ROAD UTARA (INSTIPER 2)', 110.423608, -7.764522),
(80, 'HALTE RING ROAD UTARA (JIH)', 110.403062, -7.758822),
(81, 'HALTE RING ROAD UTARA (KENTUNGAN)', 110.383865, -7.755276),
(82, 'HALTE RING ROAD UTARA (MANGGUNG)', 110.386387, -7.758059),
(83, 'HALTE RING ROAD UTARA (MONJALI 1)', 110.367584, -7.750479),
(84, 'HALTE RING ROAD UTARA (MONJALI 2)', 110.368749, -7.750833),
(85, 'HALTE RING ROAD UTARA (STIKES GUNA BANGSA)', 110.408895, -7.760751),
(86, 'HALTE RING ROAD UTARA (UPN)', 110.407992, -7.760629),
(87, 'HALTE RS. AU DR.S. HARDJOLUKITO', 110.410086, -7.797303),
(88, 'HALTE RSI HIDAYATULLAH', 110.387747, -7.815575),
(89, 'HALTE RSUP DR. SARDJITO', 110.373555, -7.769529),
(90, 'HALTE SANATA DHARMA', 110.389273, -7.775025),
(91, 'HALTE SANTREN', 110.391679, -7.766964),
(92, 'HALTE SENOPATI 1', 110.367002, -7.80153),
(93, 'HALTE SENOPATI 2', 110.367589, -7.801384),
(94, 'HALTE SMPN 11', 110.353412, -7.792942),
(95, 'HALTE SOROGENEN', 110.379223, -7.824753),
(96, 'HALTE SOROGENEN (NITIKAN)', 110.379974, -7.824809),
(97, 'HALTE SUDIRMAN 1', 110.377999, -7.78304),
(98, 'HALTE SUDIRMAN 2', 110.3695, -7.783024),
(99, 'HALTE SUDIRMAN 3', 110.368832, -7.782886),
(100, 'HALTE SUGIONO 1', 110.370028, -7.814775),
(101, 'HALTE SUGIONO 2', 110.371843, -7.815192),
(102, 'HALTE SUSTERAN NOVISIAT', 110.392221, -7.765944),
(103, 'HALTE TEGAL GENDU 1', 110.391775, -7.826026),
(104, 'HALTE TEGAL GENDU 2', 110.391327, -7.82589),
(105, 'HALTE TEGAL TURI 1', 110.387055, -7.825361),
(106, 'HALTE TEGAL TURI 2', 110.386947, -7.825422),
(107, 'HALTE TEJOKUSUMAN', 110.356, -7.807943),
(108, 'HALTE TENTARA PELAJAR 1', 110.359895, -7.786564),
(109, 'HALTE TENTARA PELAJAR 2', 110.35975, -7.787162),
(110, 'HALTE TERMINAL CONDONG CATUR', 110.395943, -7.756637),
(111, 'HALTE TERMINAL JOMBOR', 110.36171, -7.747471),
(112, 'HALTE UNY', 110.389088, -7.775134),
(113, 'HALTE URIP SUMOHARJO', 110.386086, -7.783093),
(114, 'HALTE YOS SUDARSO', 110.375313, -7.787268),
(115, 'HALTE AM SANGAJI 1', 110.3677134, -7.7771366),
(116, 'HALTE GIWANGAN', 110.391916, -7.833932);

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
(27, 'alia', '81dc9bdb52d04dc20036dbd8313ed055'),
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
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`id_museum`) REFERENCES `museum` (`id`) ON UPDATE CASCADE;

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
