-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2014 at 07:52 AM
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `jalur`
--

INSERT INTO `jalur` (`id`, `nama`, `rute`) VALUES
(13, '2A', 'Terminal Jombor');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `koordinat_rute`
--

INSERT INTO `koordinat_rute` (`id`, `id_jalur`, `id_shelter`) VALUES
(9, 13, 15),
(4, 13, 17),
(13, 13, 25),
(10, 13, 48),
(16, 13, 50),
(14, 13, 56),
(15, 13, 60),
(7, 13, 62),
(8, 13, 63),
(5, 13, 64),
(6, 13, 65),
(12, 13, 71),
(3, 13, 83),
(11, 13, 100),
(2, 13, 111),
(17, 13, 114);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `relasi_shelter`
--

INSERT INTO `relasi_shelter` (`id`, `id_shelter_awal`, `id_shelter_tujuan`, `jalur`) VALUES
(14, 111, 83, '[{"d":"-7.747471","e":"110.36171"},{"d":-7.747471,"e":110.36171},{"d":-7.7477123669319,"e":110.36238268018},{"d":-7.7489455490074,"e":110.36257579923},{"d":-7.7493069982417,"e":110.36279037595},{"d":-7.7500724191253,"e":110.36448553205},{"d":-7.7504551290452,"e":110.36680296063},{"d":"-7.750479","e":"110.367584"}]'),
(15, 83, 17, '[{"d":"-7.750479","e":"110.367584"},{"d":-7.750479,"e":110.367584},{"d":-7.7507102687985,"e":110.36961391568},{"d":-7.7511992862269,"e":110.37124469876},{"d":-7.7535380573755,"e":110.37032201886},{"d":-7.7544735621956,"e":110.37002161145},{"d":-7.7619362647844,"e":110.36931350827},{"d":-7.7650403698724,"e":110.36912038922},{"d":-7.7678255405354,"e":110.36894872785},{"d":-7.7733320449686,"e":110.36813333631},{"d":"-7.775742","e":"110.367952"}]'),
(16, 17, 64, '[{"d":"-7.775742","e":"110.367952"},{"d":-7.775742,"e":110.367952},{"d":-7.7781794099337,"e":110.36761835217},{"d":-7.7826865586788,"e":110.36708191037},{"d":"-7.784749","e":"110.366859"}]'),
(17, 64, 65, '[{"d":"-7.784749","e":"110.366859"},{"d":-7.784749,"e":110.366859},{"d":-7.7861944475181,"e":110.36656692624},{"d":"-7.787645","e":"110.366468"}]'),
(18, 65, 62, '[{"d":"-7.787645","e":"110.366468"},{"d":-7.787645,"e":110.366468},{"d":-7.7892345940918,"e":110.36620214581},{"d":-7.7895322296335,"e":110.36643818021},{"d":-7.7897660859822,"e":110.36899164319},{"d":-7.7904463946178,"e":110.36901310086},{"d":-7.7905952119845,"e":110.36841228604},{"d":-7.7904038753604,"e":110.3678329289},{"d":-7.7902125386489,"e":110.36753252149},{"d":-7.7900849807927,"e":110.36650255322},{"d":-7.7900212018501,"e":110.36615923047},{"d":"-7.79084","e":"110.366087"}]'),
(19, 62, 63, '[{"d":"-7.79084","e":"110.366087"},{"d":-7.79084,"e":110.366087},{"d":-7.7926786495653,"e":110.3657515347},{"d":"-7.795209","e":"110.365561"}]'),
(20, 63, 15, '[{"d":"-7.795209","e":"110.365561"},{"d":-7.795209,"e":110.365561},{"d":-7.7963352700467,"e":110.36549404263},{"d":-7.7979934943868,"e":110.36525800824},{"d":"-7.799907","e":"110.364992"}]'),
(21, 15, 48, '[{"d":"-7.799907","e":"110.364992"},{"d":-7.799907,"e":110.364992},{"d":-7.8013099233487,"e":110.36489322782},{"d":-7.8015650321797,"e":110.36945968866},{"d":-7.8037334509588,"e":110.36933094263},{"d":-7.8042011476524,"e":110.36954551935},{"d":"-7.808719","e":"110.369143"}]'),
(22, 48, 100, '[{"d":"-7.808719","e":"110.369143"},{"d":-7.808719,"e":110.369143},{"d":-7.8147029264729,"e":110.36868721247},{"d":"-7.814775","e":"110.370028"}]'),
(23, 100, 71, '[{"d":"-7.814775","e":"110.370028"},{"d":-7.814775,"e":110.370028},{"d":-7.815638294775,"e":110.37611156702},{"d":-7.8178916734405,"e":110.39070278406},{"d":"-7.818933","e":"110.395097"}]'),
(24, 71, 25, '[{"d":"-7.818933","e":"110.395097"},{"d":-7.818933,"e":110.395097},{"d":-7.8205489439675,"e":110.4009206593},{"d":"-7.819491","e":"110.401147"}]'),
(25, 25, 56, '[{"d":"-7.819491","e":"110.401147"},{"d":-7.819491,"e":110.401147},{"d":-7.8189226964143,"e":110.40138401091},{"d":-7.8173177007843,"e":110.40192045271},{"d":-7.8142777583701,"e":110.4020062834},{"d":-7.8107594757056,"e":110.40203846991},{"d":-7.8024153938255,"e":110.40216118097},{"d":"-7.80228","e":"110.398805"}]'),
(26, 56, 60, '[{"d":"-7.80228","e":"110.398805"},{"d":-7.80228,"e":110.398805},{"d":-7.8022028035762,"e":110.3956977278},{"d":-7.8021815445453,"e":110.39508618414},{"d":-7.8022028035762,"e":110.39417423308},{"d":"-7.802152","e":"110.393366"}]'),
(27, 60, 50, '[{"d":"-7.802152","e":"110.393366"},{"d":-7.802152,"e":110.393366},{"d":-7.802149655997,"e":110.39064444602},{"d":-7.802096508411,"e":110.38906730711},{"d":-7.8020646198561,"e":110.38801588118},{"d":-7.8019902132188,"e":110.38531221449},{"d":-7.8019583246558,"e":110.3841535002},{"d":-7.8009804075451,"e":110.38429297507},{"d":-7.8000875247079,"e":110.38444317877},{"d":-7.7988013448896,"e":110.38466848433},{"d":-7.7977383833776,"e":110.3849259764},{"d":-7.7975683092851,"e":110.38418568671},{"d":-7.7975789389179,"e":110.38363851607},{"d":"-7.797502","e":"110.383198"}]'),
(28, 50, 114, '[{"d":"-7.797502","e":"110.383198"},{"d":-7.797502,"e":110.383198},{"d":-7.7974620129421,"e":110.38229741156},{"d":-7.7975045314825,"e":110.38064517081},{"d":-7.797430124034,"e":110.37898220122},{"d":-7.7972706794568,"e":110.37768401206},{"d":-7.7959738613056,"e":110.37775911391},{"d":-7.7949108926109,"e":110.37768401206},{"d":-7.7938054023047,"e":110.37780202925},{"d":-7.7923278674331,"e":110.37782348692},{"d":-7.7920621231979,"e":110.37781275809},{"d":-7.791615672503,"e":110.37778057158},{"d":-7.7907546591044,"e":110.37780202925},{"d":-7.7902444281069,"e":110.37800587714},{"d":-7.7897129368235,"e":110.37812389433},{"d":-7.7887775105266,"e":110.37827409804},{"d":-7.7883204264627,"e":110.3782633692},{"d":-7.7882460173818,"e":110.37815608084},{"d":-7.7882353875121,"e":110.37797369063},{"d":-7.7883416861977,"e":110.37764746696},{"d":-7.7884692445848,"e":110.37724513561},{"d":-7.7884958192439,"e":110.37708420306},{"d":-7.7885808581417,"e":110.37639755756},{"d":-7.7885861730722,"e":110.376172252},{"d":-7.7884798744486,"e":110.37543196231},{"d":-7.7882938517925,"e":110.3749223426},{"d":-7.7886074327937,"e":110.37449754775},{"d":-7.7886499522334,"e":110.37415422499},{"d":-7.7885861730722,"e":110.37382163107},{"d":-7.7884160952615,"e":110.3734139353},{"d":-7.7882141277717,"e":110.37315644324},{"d":-7.7878739717792,"e":110.37309207022},{"d":-7.7874487764003,"e":110.37308134139},{"d":-7.7868853918584,"e":110.37313498557},{"d":-7.7867790928033,"e":110.37322081625},{"d":-7.7868109825227,"e":110.37359632552},{"d":-7.78678972271,"e":110.37407912314},{"d":-7.7868428722396,"e":110.37440098822},{"d":-7.7869704310831,"e":110.37466920912},{"d":-7.7871511393782,"e":110.37500180304},{"d":"-7.787268","e":"110.375313"}]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`id`, `nama`, `longitude`, `latitude`) VALUES
(15, 'HALTE AHMAD YANI', 110.364992, -7.799907),
(16, 'HALTE AM SANGAJI 1', 110.371444, -7.778291),
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
(114, 'HALTE YOS SUDARSO', 110.375313, -7.787268);

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
