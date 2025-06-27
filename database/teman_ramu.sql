-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 10:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teman_ramu`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_admin`
--

CREATE TABLE `akun_admin` (
  `id_admin` int(20) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  `kode_anggota` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_admin`
--

INSERT INTO `akun_admin` (`id_admin`, `email_admin`, `password_admin`, `kode_anggota`) VALUES
(1, 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 3);

-- --------------------------------------------------------

--
-- Table structure for table `akun_pengguna`
--

CREATE TABLE `akun_pengguna` (
  `id_pengguna` int(20) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `email_pengguna` varchar(100) NOT NULL,
  `password_pengguna` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_pengguna`
--

INSERT INTO `akun_pengguna` (`id_pengguna`, `nama_pengguna`, `email_pengguna`, `password_pengguna`) VALUES
(1, 'jukie', 'jukie123@gmail.com', 'juki'),
(2, 'taehyung', 'tae@gmail.com', 'd259b6f40070c961e29870e94d13e575'),
(3, 'jeykey', 'admin@bighit.com', '681eccb61887e4cb0a19c612c349a56b'),
(4, 'yoongi', 'yoongi@bighit.com', '642d1669d0cbcdbba93c77146d6086d9');

-- --------------------------------------------------------

--
-- Table structure for table `produk_kecantikan`
--

CREATE TABLE `produk_kecantikan` (
  `id_produk_kecantikan` int(20) NOT NULL,
  `nama_brand` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(20) NOT NULL,
  `manfaat_produk` text NOT NULL,
  `terlihat_produk` int(20) NOT NULL,
  `cara_pemakaian_produk` text NOT NULL,
  `link_produk` text NOT NULL,
  `gambar_produk` text NOT NULL,
  `kandungan_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_kecantikan`
--

INSERT INTO `produk_kecantikan` (`id_produk_kecantikan`, `nama_brand`, `nama_produk`, `harga_produk`, `manfaat_produk`, `terlihat_produk`, `cara_pemakaian_produk`, `link_produk`, `gambar_produk`, `kandungan_produk`) VALUES
(4, 'Makaleka', 'Masker Kunyit', 200000, 'mengangkat sel kulit mati, menutrisi kulit wajah, mengurangi minyak pada wajah', 33, 'Campur dengan air dan oleskan pada wajah', 'https://shopee.co.id/Masker-Bubuk-Organik-Kunyit-Coklat-Kopi-Beras-Greentea-10gr-by-makaleka--i.2565736.1437412701', '1750276237-f8c606c4259b32eb201dbcdf612d141f.jpeg', 'Glycolyc acid ff'),
(6, 'Bio Aqua', 'Masker Lidah Buaya', 50000, 'Baik untuk kulit kering maupun berminyak, kamu bisa memakai produk Bioaqua ini sebagai masker untuk melembabkan wajah. Kandungan didalam aloe vera yaitu zat polisakarida dan sterol dapat membantu melembabkan sekaligus menjaga kelembabannya.', 28, 'Untuk memakai masker Bioaqua Aloe Vera, pertama bersihkan wajah terlebih dahulu. Kemudian, keluarkan masker dari kemasan dan tempelkan pada wajah dengan lembut. Pastikan masker menempel rata pada seluruh area wajah. Diamkan selama 15-20 menit, lalu lepaskan masker dan pijat lembut wajah agar sisa serum meresap.', 'https://www.beautyhaul.com/product/detail/aloe-vera-nicotinamide-acne-care-brightening-essence-mask', '1750276395-BIOAQUA_Aloe_Vera_Nicotinamide_Acne_Care_Brightening_Essence_Mask.jpg', 'Aloe Vera'),
(7, 'Mustika Ratu', 'Masker Tomat', 15000, 'ahj', 11, 'sdfghj', 'https://shopee.co.id/-MUSTIKA-RATU-MASKER-TOMAT-15gr~-MASKER-BUBUK~MASKER-WAJAH-i.279058893.5541470173', '1750279193-31a643d3ab2551c70f62e1b3cde4d681.jpeg', ''),
(8, 'Herborish', 'Masker Daun Sirih', 25000, 'Membantu mengatasi masalah jerawat, mencerahkan kulit, dan menjaga kesehatan kulit secara keseluruhan. ', 2, 'Aplikasikan ke wajah', 'https://shopee.co.id/Masker-Daun-Sirih-Ramuan-Herbal-15-gr-i.174610364.13432916372', '1751022876-1532dc6b1e129efd3094e72e6f2831c7.jpeg', 'minyak atsiri, flavonoid, tanin, dan vitamin');

-- --------------------------------------------------------

--
-- Table structure for table `produk_tanaman`
--

CREATE TABLE `produk_tanaman` (
  `id_produk_kecantikan` int(20) NOT NULL,
  `id_tanaman_herbal` int(20) NOT NULL,
  `kandungan_produk` text NOT NULL,
  `status` enum('ada','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanaman_herbal`
--

CREATE TABLE `tanaman_herbal` (
  `id_tanaman_herbal` int(20) NOT NULL,
  `id_produk_kecantikan` int(20) NOT NULL,
  `nama_tanaman` varchar(100) NOT NULL,
  `nama_latin_tanaman` varchar(100) NOT NULL,
  `pemerian` varchar(100) NOT NULL,
  `taksonomi` text NOT NULL,
  `nama_simplisia` text NOT NULL,
  `bagian_digunakan` text NOT NULL,
  `kontra_indikasi` text NOT NULL,
  `zat_aktif` text NOT NULL,
  `kegunaan_tanaman` text NOT NULL,
  `cara_penggunaan` text NOT NULL,
  `cara_pengolahan` text NOT NULL,
  `takaran_pakai` text NOT NULL,
  `gambar_tanaman` text NOT NULL,
  `terlihat_tanaman` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanaman_herbal`
--

INSERT INTO `tanaman_herbal` (`id_tanaman_herbal`, `id_produk_kecantikan`, `nama_tanaman`, `nama_latin_tanaman`, `pemerian`, `taksonomi`, `nama_simplisia`, `bagian_digunakan`, `kontra_indikasi`, `zat_aktif`, `kegunaan_tanaman`, `cara_penggunaan`, `cara_pengolahan`, `takaran_pakai`, `gambar_tanaman`, `terlihat_tanaman`) VALUES
(13, 0, 'Lidah Buaya', 'Aloe vera', 'Tanaman sukulen dengan daun tebal berdaging, berwarna hijau muda hingga hijau tua, memiliki duri lun', 'Plantae', 'Aloe Vera Folium', 'Daun bagian dalam (gel) dan lateks (getah kuning di bawah kulit daun)', 'Tidak dianjurkan untuk ibu hamil dan menyusui. Konsumsi oral berlebihan dapat menyebabkan diare dan iritasi saluran cerna. Penderita gangguan ginjal sebaiknya menghindari konsumsi.\r\n\r\n', 'Aloin, emodin, barbaloin, saponin, vitamin A, C, E, enzim, dan lignin', 'Menyembuhkan luka bakar dan iritasi kulit\r\n\r\nMelembapkan kulit dan rambut\r\n\r\nMembantu mengatasi sembelit (jika digunakan secara oral)\r\n\r\nMengandung antioksidan dan antibakteri\r\n', 'Gel dapat dioleskan langsung ke kulit untuk mengobati luka atau iritasi\r\n\r\nDapat dikonsumsi dalam bentuk jus dalam dosis terbatas', 'Potong daun, kupas kulit luar, ambil gel bening di bagian dalam\r\n\r\nGel bisa langsung digunakan atau dicampur dalam minuman/jamu\r\n\r\n', 'Untuk pemakaian luar: 2–3 kali sehari  Untuk konsumsi oral: 1–2 sendok makan gel per hari (setelah k', '1750275223_Ini-Alasan-Aloe-Vera-Baik-untuk-Kulit-Kering.jpg.webp', 68),
(20, 0, 'Kunyit', 'Curcuma longa L.', 'asdfghjk', 'Plantae', 'sdfghj', 'dfghj', 'sdfg', 'sdfg', 'dfgh', 'sdfgh', 'dfgh', 'dfgh', 'Kunyit.jpg', 18),
(21, 0, 'Tomat', 'Solanum lycopersicum', 'Buah bulat merah, banyak air, tinggi antioksidan.', 'Famili: Solanaceae, Genus: Solanum, Spesies: Solanum lycopersicum', 'Lycopersici Fructus', 'Buah', 'Hindari pemakaian berlebihan pada kulit sensitif', 'Likopen, vitamin C, A', 'Antioksidan, menyegarkan kulit, mencerahkan\r\n\r\n', 'Irisan atau jus dijadikan masker\r\n\r\n', 'Hancurkan tomat, aplikasikan ke wajah\r\n\r\n', '2–3 kali seminggu', 'tomat-article-1641484612.jpg', 8),
(22, 0, 'Daun Sirih', 'Piper betle L', 'Tanaman merambat dengan batang beruas dan berakar pelekat, daun berbentuk jantung berwarna hijau men', 'iperaceae, Genus: Piper, Spesies: Piper betle', 'Piperis Betle Folium', 'Daun', 'Tidak dianjurkan digunakan secara berlebihan oleh penderita sembelit kronis, karena sifat astringennya dapat memperburuk kondisi.', 'Eugenol, kavikol, karvakrol, flavonoid, saponin, tanin, minyak atsiri', 'Mengatasi bau badan dan bau mulut\r\n\r\nMembersihkan dan menjaga kesehatan area kewanitaan\r\n\r\nMenyembuhkan jerawat dan iritasi kulit ringan\r\n\r\nAntiseptik alami untuk kulit\r\n\r\n', 'Direbus untuk air basuhan atau rendaman\r\n\r\nDijadikan masker wajah alami untuk kulit berjerawat\r\n\r\nDiminum air rebusannya secara rutin dalam jumlah kecil\r\n\r\n', 'Rebus 5–10 lembar daun sirih dalam 500 ml air hingga tersisa separuhnya\r\n\r\nGunakan air rebusan untuk cuci muka, berkumur, atau perawatan area tubuh tertentu', 'Pemakaian luar: 1–2 kali sehari  Pemakaian dalam (minum): 1 gelas kecil per hari (tidak lebih dari 7 hari berturut-turut)', 'X-Manfaat-Daun-Sirih-Merah-bagi-Kesehatan-Wanita.jpg.webp', 4),
(23, 0, 'Pegagan', 'Centella asiatica', 'Tanaman menjalar dengan daun bundar dan batang tipis, tumbuh di tempat lembap.\r\n\r\n', 'Apiaceae, Genus: Centella, Spesies: Centella asiatica', 'Centellae Herba', 'Daun dan batang', 'Dapat menyebabkan sakit kepala jika dikonsumsi berlebihan', 'Asiaticoside, madecassoside', 'Regenerasi kulit, anti-aging, menghilangkan bekas luka\r\n\r\n', 'Ekstrak pegagan dalam krim/serum/topikal', 'Rebus daun atau olah jadi masker', '1–2 kali sehari pada area luka/bekas jerawat', 'images.jpeg', 2),
(24, 0, 'Jahe', 'Zingiber officinale', 'Rimpang bercabang, aroma pedas hangat.\r\n\r\n', 'ili: Zingiberaceae, Genus: Zingiber, Spesies: Zingiber officinale', 'Zingiberis Rhizoma', 'Rimpang', 'Gangguan lambung akut.', 'Gingerol, shogaol', 'Menghangatkan, antioksidan, antiinflamasi\r\n\r\n', 'Air rebusan/minuman', 'Kupas, iris, rebus', '1–2 gelas per hari', 'images (1).jpeg', 0),
(25, 0, 'Temulawak', 'Curcuma xanthorrhiza', 'Rimpang besar kekuningan, rasa pahit.\r\n\r\n', 'Famili: Zingiberaceae, Genus: Curcuma, Spesies: Curcuma xanthorrhiza ', 'Curcumae Rhizoma', 'Rimpang', 'Batu empedu berat.\r\n\r\n', 'Kurkumin, xanthorrhizol', 'Antioksidan, antiinflamasi, liver tonic\r\n\r\n', 'Rebusan/jamu\r\n\r\n', 'Iris rimpang, rebus\r\n\r\n', '1–2 kali sehari', 'images (2).jpeg', 1),
(26, 0, 'Kencur', 'Kaempferia galanga', 'Rimpang pendek aromatik.\r\n\r\n', 'Famili: Zingiberaceae, Genus: Kaempferia, Spesies: Kaempferia galanga', 'Kaempferiae Rhizoma', 'Rimpang', 'Hindari konsumsi berlebihan.\r\n\r\n', 'Etil p-metoksisinamat', 'Pengharum kulit, antiinflamasi', 'Jamu, lulur\r\n\r\n', 'Parut/campur bahan lain\r\n\r\n', '1–2 kali seminggu', 'tipsmengolahkencuruntukatasipenyakithalodoc.jpg', 0),
(27, 0, 'Bengkoang', 'Pachyrhizus erosus', 'Umbi putih manis renyah.\r\n\r\n', 'Famili: Fabaceae, Genus: Pachyrhizus, Spesies: Pachyrhizus erosus', 'Pachyrhizi Tuber', 'Umbi', 'Biji beracun.', 'Vitamin C, flavonoid', 'Mencerahkan kulit', 'Masker parutan', 'Parut umbi', '2–3 kali seminggu', 'manfaat-bengkoang-yang-kaya-serat.jpg', 1),
(28, 0, 'Kemuning', 'Murraya paniculata', 'Semak perdu dengan daun majemuk hijau mengilap', 'Famili: Rutaceae, Genus: Murraya, Spesies: Murraya paniculata', 'Murrayae Folium', 'Daun, kulit batang', 'Tidak untuk ibu hamil.', 'Alkaloid, flavonoid', 'Menghaluskan kulit, mengatasi jerawat\r\n\r\n', 'Air rebusan, masker', 'Rebus, tumbuk halus', ' 1–2 kali sehari', 'Flora-Kemuning-Tidak-Sekadar-Harum.jpg', 0),
(29, 0, 'Jeruk Nipis', 'Citrus aurantiifolia', 'Pohon kecil berduri, buah bulat hijau asam harum.', 'Famili: Rutaceae, Genus: Citrus, Spesies: Citrus aurantiifolia', 'Citri Fructus', 'Buah', 'Kulit sensitif menyebabkan iritasi.\r\n\r\n', 'Vitamin C, flavonoid', 'Mencerahkan kulit, mengontrol minyak', 'Perasan masker', 'Iris, peras, aplikasikan', '1–2 kali seminggu', 'images (3).jpeg', 0),
(30, 0, 'Belimbing Wuluh', 'Averrhoa bilimbi', 'Pohon kecil, buah lonjong hijau asam.', 'Famili: Oxalidaceae, Genus: Averrhoa, Spesies: Averrhoa bilimbi', 'Bilimbi Fructus', 'Buah', 'Kulit sangat sensitif.\r\n\r\n', 'Asam oksalat, vitamin C', 'Mengurangi jerawat, mengontrol minyak', 'Masker jus', 'Hancurkan buah', '1–2 kali seminggu', 'images (4).jpeg', 14),
(31, 0, 'Pandan Wangi', 'Pandanus amaryllifolius', 'Daun panjang wangi khas.', 'Famili: Pandanaceae, Genus: Pandanus, Spesies: P. amaryllifolius', 'Pandani Folium', 'Daun', 'Tidak ada signifikan.', 'Alkaloid, tanin', 'Pewangi, perawatan rambut\r\n\r\n', 'Air rebusan, masker rambut\r\n\r\n', 'Rebus, tumbuk halus\r\n\r\n', '1–2 kali seminggu', 'Cara-Mengolah-Daun-Pandan-dan-Manfaatnya-untuk-Kesehatan-01-1.jpg.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(20) NOT NULL,
  `id_pengguna` int(20) NOT NULL,
  `id_tanaman_herbal` int(20) NOT NULL,
  `isi_ulasan` text NOT NULL,
  `tanggal_ulasan` date NOT NULL,
  `efektifitas_tanaman_herbal` int(100) NOT NULL,
  `tipe_kulit` varchar(100) NOT NULL,
  `permasalahan_kecantikan` varchar(100) NOT NULL,
  `umur_pengguna` int(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_pengguna`, `id_tanaman_herbal`, `isi_ulasan`, `tanggal_ulasan`, `efektifitas_tanaman_herbal`, `tipe_kulit`, `permasalahan_kecantikan`, `umur_pengguna`, `is_deleted`) VALUES
(15, 2, 30, 'sbberfbnesRNBe4anerner', '2025-06-27', 3, 'Dry', 'svsb', 23, 0),
(16, 2, 30, 'herhbeh', '2025-06-27', 3, 'bsrb', 'cvbnm,', 20, 0),
(17, 2, 30, 'werfgtyhu', '2025-06-27', 1, 'sdfghjk', 'sdfghj', 30, 0),
(18, 2, 30, 'fghjk', '2025-06-27', 3, 'dfghj', 'fghj', 35, 0),
(19, 2, 30, 'sdfg', '2025-06-27', 2, 'fghjkl;', 'sdfghjkl', 17, 0),
(20, 2, 30, 'nhrej', '2025-06-27', 1, 'ertgyh', 'dfghjk', 32, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `produk_kecantikan`
--
ALTER TABLE `produk_kecantikan`
  ADD PRIMARY KEY (`id_produk_kecantikan`);

--
-- Indexes for table `produk_tanaman`
--
ALTER TABLE `produk_tanaman`
  ADD KEY `id_tanaman_herbal` (`id_tanaman_herbal`),
  ADD KEY `id_produk_kecantikan` (`id_produk_kecantikan`);

--
-- Indexes for table `tanaman_herbal`
--
ALTER TABLE `tanaman_herbal`
  ADD PRIMARY KEY (`id_tanaman_herbal`),
  ADD KEY `id_produk_kecantikan` (`id_produk_kecantikan`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_pengguna` (`id_pengguna`,`id_tanaman_herbal`),
  ADD KEY `id_tanaman_herbal` (`id_tanaman_herbal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_admin`
--
ALTER TABLE `akun_admin`
  MODIFY `id_admin` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  MODIFY `id_pengguna` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk_kecantikan`
--
ALTER TABLE `produk_kecantikan`
  MODIFY `id_produk_kecantikan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tanaman_herbal`
--
ALTER TABLE `tanaman_herbal`
  MODIFY `id_tanaman_herbal` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk_tanaman`
--
ALTER TABLE `produk_tanaman`
  ADD CONSTRAINT `produk_tanaman_ibfk_1` FOREIGN KEY (`id_produk_kecantikan`) REFERENCES `produk_kecantikan` (`id_produk_kecantikan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_tanaman_ibfk_2` FOREIGN KEY (`id_tanaman_herbal`) REFERENCES `tanaman_herbal` (`id_tanaman_herbal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `akun_pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_tanaman_herbal`) REFERENCES `tanaman_herbal` (`id_tanaman_herbal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
