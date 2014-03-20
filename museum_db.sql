-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 10:02 AM
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
  `hit` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `museum`
--

INSERT INTO `museum` (`id`, `nama`, `alamat`, `longitude`, `latitude`, `keterangan`, `image`, `url`, `link_youtube`, `folder_gallery`, `hit`) VALUES
(9, 'Museum Sonobudoyo', 'Jl. Trikora No. 6 , Yogyakarta', 110.363953, -7.802431, '<p>Museum Sonobudoyo</p>\n <p><img alt="" src="/museum/image_upload/images/Museum_Sonobudoyo.jpg"  /></p>\n\n<p>Museum Negeri Sonobudoyo merupakan Unit Pelaksana Teknis Daerah pada Dinas Kebudayaan Provinsi DIY, mempunyai fungsi pengelolaan benda museum yang memiliki nilai budaya ilmiah, meliputi koleksi pengembangan dan bimbingan edukatif cultural. Sedangkan tugasnya adalah mengumpulkan, merawat, pengawetan, melaksanakan penelitian, pelayanan pustaka, bimbingan edukatif cultural serta penyajian benda koleksi Museum Negeri Sonobudoyo.</p>\n\n<p>', '', 'museum-sonobudoyo', NULL, NULL, 0),
(10, 'Museum Affandi', 'Jl. Laksda Adisucipto 167, Yogyakarta 55281', 110.396359, -7.782724, '<p><strong>MUSEUM AFFANDI</strong></p>\r\n\r\n<p>Museum Affandi terletak di Jalan Laksda Adisucipto 167, yaitu jalan utama yang menghubungkan kota Yogyakarta dan Solo, di tepi barat Sungai Gajahwong. Letaknya sangat strategis sebagai salah satu kompleks museum seni lukis di Yogyakarta. Kompleks museum menempati tanah seluas 3.500 meter persegi terdiri atas bangunan museum beserta bangunan pelengkap, dan bangunan rumah tempat tinggal pelukis Affandi dan keluarganya. Lahan yang berteras tidak menghambat Affandi dalam menciptakan tata letak bangunan beserta lingkungannya. Pembangunan kompleks museum ini dilakukan secara bertahap dan dirancang sendiri oleh Affandi.</p>\r\n\r\n<p><strong>GALERI I</strong><br />\r\nPada tahun 1962 Affandi selesai membangun Galeri I dengan luas bangunan 314,6 meter persegi sebagai ruang pameran bagi sejumlah hasil karya lukisnya. Bangunan Galeri I ini kemudian diresmikan oleh Direktur Jenderal Kebudayaan, Prof.Ida Bagus Mantra, pada tahun 1974.</p>\r\n\r\n<p>Pada Galeri I dapat disaksikan hasil karya Affandi yang berupa lukisan dari tahun-tahun awal hingga tahun terakhir semasa hidupnya. Lukisan tersebut terdiri atas sketsa-sketsa di atas kertas, lukisan cat air, pastel, serta cat minyak di atas kanvas.</p>\r\n\r\n<p>Hasil karya dua buah patung potret diri yang terbuat dari tanah liat dan semen, serta sebuah reproduksi patung karyanya berupa potret diri bersama putrinya, Kartika, yang aslinya menjadi koleksi Taman Siswa Jakarta.</p>\r\n\r\n<p>Sebuah mobil Colt Gallant tahun 1976 adalah mobil kesayangan semasa hidupnya yang telah dimodifikasi sehingga menyerupai bentuk ikan yang terpajang di dalam ruangan ini pula. Selain itu terdapat sepedanya dan sejumlah reproduksi di atas kanvas dan kertas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>GALERI III</strong></p>\r\n\r\n<p><strong>GALERI II</strong><br />\r\nPada tahun 1987, Presiden Soeharto memberikan bantuan berupa pendirian sebuah bangunan Galeri II, yang menempati areal tanah seluas 351,5 meter persegi. Bangunan Galeri II ini kemudian diresmikan oleh Menteri Pendidikan dan Kebudayaan, Prof. Dr. Fuad Hassan, pada tanggal 9 Juni 1988.</p>\r\n\r\n<p><br />\r\n<strong>GALERI III</strong><br />\r\nGaleri III didirikan pada tahun 1997 dan diresmikan oleh Sri Sultan HB X pada tanggal 26 Mei 2000 dan dibangun atas ide dasar yang sama dengan bangunan lainnya antara kompleks museum yang menggunakan bentuk garis melengkung dengan atap yang membentuk pelepah daun pisang.</p>\r\n\r\n<p>Galeri III mempunyai tiga lantai bangunan, lantai I digunakan untuk ruang pameran, lantai II untuk ruang perawatan/perbaikan lukisan, dan ruang bawah tanah sebagai ruang penyimpanan lukisan.</p>\r\n\r\n<p>Di dalam Galeri III dipajang karya keluarga Affandi, sulaman Maryati, lukisan Kartika dan Rukmini.</p>\r\n\r\n<p>Sebagai bagian dari kompleks Museum Affandi, rumah tinggal Affandi dan keluarganya berbentuk rumah panggung dengan konstruksi tiang penyangga utama dari beton dan tiang-tiang kayu, dan atap dari bahan sirap yang membentuk sebuah pelepah daun pisang. Bangunan yang ada di kompleks museum ini seluruhnya spiral lengkung dan bagian atap membentuk pelepah daun pisang. Bagian atas rumah panggung merupakan kamar pribadi Affandi, sedangkan bagian bawah digunakan sebagai ruang duduk tamu serta garasi mobil.</p>\r\n\r\n<p><strong>GEROBAK</strong></p>\r\n\r\n<p>Sebuah gerobak telah dimodifikasi menjadi sebuah kamar, lengkap dengan dapur dan kamar kecilnya, dibangun Affandi atas permintaan Maryati, istrinya sebagai tempat istirahat di siang hari dan tempat meyulam karya-karyanya. Bentuk gerobak menjadi ide pilihan Affandi, ketika semula Maryati menginginkan karavan (yang banyak digunakan masyarakat Amerika sebagai sarana tempat tinggal yang mudah berpindah tempat).</p>\r\n\r\n<p>Bangunan lain yang terdapat di kompleks Museum Affandi ini merupakan bangunan pelengkap, yang dahulu difungsikan Affandi sebagai bangunan keluarga, yang direncanakan sebagai ruang untuk konservasi lukisan,<em>guesthouse</em>, dan lain sebagainya. Kolam renang keluarga tempat berkumpulnya Affandi beserta anak cucu pada saat tertentu.</p>\r\n\r\n<p>Sebagai tempat peristirahatannya yang terakhir, Affandi wafat pada tanggal 23 Mei 1990 dan telah memilih tempat pemakamannya di antara dua bangunan Galeri I dan Galeri II, berdampingan dengan istrina Maryati, dikelilingi lukisan hasil karyanya, serta rimbunan tanaman dan mawar di sekitarnya.</p>\r\n\r\n<p><br />\r\n<strong>STUDIO SORRANDU</strong><br />\r\nStudio Sorrandu adalah sebagai tempat ruang pamer dan sanggar kreatif seni Gajah Wong dimana anak-anak maupun dewasa dapat belajar mengembangkan inovasi, kreativitas, dan bakatnya di bidang seni rupa.</p>\r\n\r\n<p>Sumber: Biography dan Museum Affandi (Penerbit Museum Affandi. Cetakan ke-2, Tahun 2008)</p>\r\n\r\n<p><br />\r\n<strong>Alamat:</strong><br />\r\nMUSEUM AFFANDI<br />\r\nJl. Laksda Adisucipto 167<br />\r\nYogyakarta 55281</p>\r\n\r\n<p>Telp. 0274-562 593</p>\r\n\r\n<p><strong>Laman:</strong><br />\r\nhttp://www.affandi.org</p>\r\n\r\n<p><strong>Jam Kunjungan:</strong><br />\r\nSenin-Minggu 09.00-16.00<br />\r\nHari libur nasional tutup<br />\r\nNote: Untuk hari Minggu kami menyarankan pengunjung menghubungi museum terlebih dahulu karena terdapat kemungkinan museum tidak buka.</p>\r\n\r\n<p><strong>Tiket:</strong><br />\r\nTiket Rp 20.000 (bonus pensil dan kupon <em>soft drink</em>di Cafe Loteng)</p>\r\n\r\n<p>Note: Dulu kamera dikenakan biaya Rp 10.000, sekarang tidak diperbolehkan memotret di dalam galeri.</p>\r\n', '', 'museum-affandi', '//www.youtube.com/embed/vgMA1lxd5xw', 'museum_affandi', 5),
(11, 'Museum Wayang Kekayon', 'Jl. Raya Yogya-Wonosari Km. 7', 110.412975, -7.815136, 'Museum Wayang Kekayon', '', 'museum-wayang-kekayon', NULL, NULL, 0),
(12, 'Museum Ullen Sentalu', 'Jl. Boyong Kaliurang Donoharjo Ngaglik Sleman Daerah Istimewa Yogyakarta, Indonesia', 110.420987, -7.609669, 'Museum Ullen Sentalu', '', 'museum-ullen-sentalu', NULL, NULL, 0),
(13, 'Museum Pusat TNI AU Dirgantara Mandala Yogyakarta', 'Bandara Adi Sucipto, Maguworejo, Depok, Yogyakarta', 110.416383, -7.789745, 'Museum Pusat TNI AU Dirgantara Mandala Yogyakarta', '', 'museum-pusat-tni-au-dirgantara-mandala-yogyakarta', NULL, NULL, 0),
(14, 'Museum Benteng Vrederbug', 'Jl. Jenderal A. Yani No. 6, Yogyakarta', 110.366028, -7.800289, 'Museum Benteng Vrederbug', '', 'museum-benteng-vrederbug', NULL, NULL, 1),
(15, 'Museum Keraton Yogyakarta', 'Jl. Rotowijayan 1, Yogyakarta 55133', 110.364057, -7.806553, 'Museum Keraton Yogyakarta', '', 'museum-keraton-yogyakarta', NULL, NULL, 0),
(16, 'Museum Batik Yogyakarta', 'Jl. Dr Sutomo 13 A RT 049 RW 12 Bausasran Danurejan, Yogyakarta', 110.377589, -7.796165, '<p>Museum Batik Yogyakarta</p>\n', '', 'museum-batik-yogyakarta', '', '', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
