-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2014 at 04:11 PM
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

--
-- Dumping data for table `jalur`
--

INSERT INTO `jalur` (`id`, `nama`, `rute`, `koordinat_rute`) VALUES
(7, '1A', 'Terminal Prambanan – S5. Kalasan – Bandara Adisucipto – S3. Maguwoharjo – Janti (bawah) – S3. UIN Kalijaga – S4. Demangan – S4. Gramedia – S4. Tugu – Stasiun Tugu – Malioboro – S4. Kantor Pos Besar – S4. Gondomanan – S4. Pasar Sentul – S4. SGM – Gembira Loka – S4. Babadan Gedongkuning – JEC – S4. Blok O – Janti (atas) – S3. Maguwoharjo – Bandara Adisucipto – S5. Kalasan – Terminal Prambanan.', '[{"d":-7.755217712271691,"e":110.49293652176857},{"d":-7.757258802866692,"e":110.48057690262794},{"d":-7.773161960970609,"e":110.46641483902931},{"d":-7.783792078329778,"e":110.44701710343361},{"d":-7.78336687880904,"e":110.42993679642677}]'),
(9, '1B', 'Terminal Prambanan – S5. Kalasan – Bandara Adisucipto – S3. Maguwoharjo – Janti (lewat bawah) – S4. Blok O – JEC – S4. Babadan Gedongkuning – Gembira Loka – S4. SGM – S4. Pasar Sentul – S4. Gondomanan – S4. Kantor Pos Besar – S3. RS.PKU Muhammadiyah – S3. Pasar Kembang – S4. Badran – Bundaran SAMSAT – S4. Pingit – S4. Tugu – S4. Gramedia – Bundaran UGM – S3. Colombo – S4. Demangan – S3. UIN Sunan Kalijaga – Janti – S3. Maguwoharjo – Bandra Adisucipto – S5. Kalasan – Terminal Prambanan.', NULL),
(10, '2A', 'Terminal Jombor – S4. Monjali – S4. Tugu – Stasiun Tugu – Malioboro – S4. Kantor Pos Besar – S4. Gondomanan – S4. Jokteng Wetan – S4. Tungkak – S4. Gambiran – S3 . Basen – S4. Rejowinangun – S4. Babadan Gedongkuning – Gembira Loka – S4. SGM – S3. Cendana – S4. Mandala Krida – S4. Gayam – Flyover Lempuyangan – Kridosono – S4. Duta Wacana – S4. Galeria – S4. Gramedia – Bunderan UGM – S3. Colombo – Terminal Condongcatur – S4. Kentungan – S4. Monjali – Terminal Jombor.', NULL),
(11, '2B', 'Terminal Jombor – S4. Monjali – S4. Kentungan – Terminal Condong Catur – S3. Colombo – Bundaran UGM – S4. Gramedia – Kridosono – S4. Duta Wacana – Fly-over Lempuyangan – S4. Gayam – S4. Mandala Krida – S3. Cendana – S4. SGM – Gembiraloka– S4. Babadan Gedongkuning – S4. Rejowinangun – S3. Basen – S4.Tungkak – S4. Joktengwetan – S4. Gondomanan – S4. Kantor Pos Besar – S3. RS PKU Muhammadiyah – S4. Ngabean – S4. Wirobrajan – S3. BPK – S4. Badran – Bundaran SAMSAT – S4. Pingit – S4. Tugu – S4. Monjali – Terminal Jombor.', NULL),
(12, '3A', 'Terminal Giwangan – S4. Tegalgendu – S3. HS-Silver – Jl. Nyi Pembayun – S3. Pegadaian Kotagede – S3. Basen – S4. Rejowinangun – S4. Babadan Gedongkuning – JEC – S4. Blok O – Janti (lewat atas) – S3. Janti – S3. Maguwoharjo – Bandara ADISUCIPTO – S3. Maguwoharjo – Ringroad Utara – Terminal Condongcatur – S4. Kentungan – S4. MM UGM – S4. MirotaKampus – S3. Gondolayu – S4. Tugu – S4. Pingit – Bundaran SAMSAT – S4. Badran – S3. PasarKembang – Stasiun TUGU – Malioboro – S4. Kantor Pos Besar – S3. RS PKU Muhammadiyah – S4. Ngabean – S4. Jokteng Kulon – S4. Plengkung Gading – S4. Jokteng Wetan – S4. Tungkak – S4.Wirosaban – S4. Tegalgendu – Terminal Giwangan.', NULL),
(13, '3B', 'Terminal Giwangan – S4. Tegalgendu – S4. Wirosaban – S4. Tungkak – S4.Jokteng Wetan – S4. Plengkung Gading – S4. JoktengKulon – S4. Ngabean – S3. RS PKU Muhammadiyah – S3. Pasar Kembang – S4. Badran – Bundaran SAMSAT – S4. Pingit – S4. Tugu – S3. Gondolayu – S4. Mirota Kampus – S4. MM UGM – S4. Kentungan – Terminal Condong Catur – Ringroad Utara – S3. Maguwoharjo – Bandara Adisucipto – S3. Maguwoharjo – JANTI (lewat bawah) – S4. Blok O – JEC – S4. Babadan Gedongkuning – S4. Rejowinangun – S3. Basen – S3. Pegadaian Kotagede – Jl.Nyi Pembayun – S3. HS-Silver – S4. Tegalgendu – Terminal Giwangan.', NULL);

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
(2, 'User', 'admin/user', 'fa-users'),
(3, 'Museum', 'admin/museum', 'fa-building-o'),
(4, 'Rute Trans Jogja', 'admin/trans', 'fa-truck'),
(5, 'Artikel', 'admin/artikel', 'fa-archive'),
(6, 'Shelter', 'admin/shelter', 'fa-arrow-down'),
(7, 'Home Slide', 'admin/slide', 'fa-desktop');

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
-- Table structure for table `shelter`
--

CREATE TABLE IF NOT EXISTS `shelter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`id`, `nama`, `longitude`, `latitude`) VALUES
(3, 'Tugu', 110.36760125309229, -7.783069238887897),
(4, 'Jetis', 110.36809477955103, -7.774628933187241);

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
(26, 'aan', '81dc9bdb52d04dc20036dbd8313ed055'),
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
