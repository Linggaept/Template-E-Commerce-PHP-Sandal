-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 07, 2025 at 06:01 PM
-- Server version: 11.8.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sandalminimarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(10) NOT NULL,
  `nm_admin` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nm_admin`, `username`, `email`, `password`) VALUES
(1, 'administrator', 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `id_detail_order` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `id_variasi` int(11) DEFAULT NULL,
  `nm_produk` varchar(50) NOT NULL,
  `harga` int(10) NOT NULL,
  `jml_order` int(3) NOT NULL,
  `berat` int(10) NOT NULL,
  `subberat` int(10) NOT NULL,
  `subharga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`id_detail_order`, `id_order`, `id_produk`, `id_variasi`, `nm_produk`, `harga`, `jml_order`, `berat`, `subberat`, `subharga`) VALUES
(66, 99, 2, 23, 'Sendal Jepit Swallow Classic Biru', 25000, 2, 200, 400, 50000),
(67, 99, 4, 42, 'Sendal Jepit Havaianas Top Mix', 45000, 2, 220, 440, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kat_pos`
--

CREATE TABLE `tbl_kat_pos` (
  `id_kategori` int(10) NOT NULL,
  `nm_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kat_pos`
--

INSERT INTO `tbl_kat_pos` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Tips Perawatan Sendal'),
(2, 'Tren Fashion Sendal'),
(3, 'Panduan Memilih Sendal'),
(4, 'Promo dan Diskon'),
(5, 'Review Produk'),
(6, 'Gaya Hidup Sehat'),
(7, 'Berita Toko'),
(8, 'Tutorial Style'),
(9, 'Event dan Aktivitas'),
(10, 'Kesehatan Kaki');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kat_produk`
--

CREATE TABLE `tbl_kat_produk` (
  `id_kategori` int(10) NOT NULL,
  `nm_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kat_produk`
--

INSERT INTO `tbl_kat_produk` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Sendal Jepit'),
(2, 'Sendal Gunung'),
(3, 'Sendal Selop'),
(4, 'Sendal Anak'),
(5, 'Sendal Wanita'),
(6, 'Sendal Pria'),
(7, 'Sendal Olahraga'),
(8, 'Sendal Rumah'),
(9, 'Sendal Karet'),
(10, 'Sendal Kulit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_order` int(10) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `nm_penerima` varchar(30) NOT NULL DEFAULT '',
  `telp` varchar(13) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kode_pos` int(10) NOT NULL,
  `alamat_pengiriman` varchar(50) NOT NULL,
  `tgl_order` date NOT NULL,
  `ongkir` int(10) NOT NULL,
  `total_order` int(10) NOT NULL,
  `metode_pembayaran` enum('Transfer','COD') NOT NULL DEFAULT 'Transfer',
  `status` varchar(30) DEFAULT 'Belum Dibayar',
  `no_resi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `id_pelanggan`, `nm_penerima`, `telp`, `provinsi`, `kota`, `kode_pos`, `alamat_pengiriman`, `tgl_order`, `ongkir`, `total_order`, `metode_pembayaran`, `status`, `no_resi`) VALUES
(99, 8, 'Agus Kabel', '021391823012', '12', '391', 57463, 'Burikan,Cawas,Klaten', '2025-07-07', 50000, 190000, 'COD', 'Produk Diterima', '001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(10) NOT NULL,
  `nm_pelanggan` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nm_pelanggan`, `username`, `email`, `password`) VALUES
(1, 'Arif Nur R', 'arifnur', 'arif@gmail.com', '123'),
(2, 'Arief Gilang', 'ariefgilan', 'arief@gmail.com', '123'),
(4, ' Bintang Reny', 'Bintang', 'Bintangre10@gmail.com', 'Kepo56789_'),
(5, ' Rizal Wijoyo', 'Rizal', 'Wijal16@gmail.com', 'Kambing123'),
(6, ' aris Juliyanto', 'aris', 'aris@gmail.com', '12345'),
(7, ' Wisnu', 'Ajik', 'wisnu@gmail.com', '123456'),
(8, ' user', 'user', 'user@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `nm_pembayar` varchar(30) NOT NULL,
  `nm_bank` varchar(20) NOT NULL,
  `jml_pembayaran` int(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_transfer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pos`
--

CREATE TABLE `tbl_pos` (
  `id_pos` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` longtext NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pos`
--

INSERT INTO `tbl_pos` (`id_pos`, `id_kategori`, `judul`, `isi`, `gambar`, `tgl`) VALUES
(1, 1, 'Cara Merawat Sendal Kulit Agar Awet dan Tahan Lama', '<p>Sendal kulit adalah investasi yang baik untuk kenyamanan kaki Anda. Namun, untuk menjaga agar sendal kulit tetap awet dan tahan lama, diperlukan perawatan yang tepat.</p>\r\n<p>Pertama, bersihkan sendal secara rutin dengan kain lembab dan sabun khusus kulit. Hindari penggunaan air berlebihan yang dapat merusak tekstur kulit.</p>\r\n<p>Kedua, gunakan pelembab kulit atau leather conditioner setiap 2-3 bulan untuk menjaga kelembaban dan mencegah kulit pecah-pecah.</p>\r\n<p>Ketiga, simpan sendal di tempat yang kering dan sejuk, hindari paparan sinar matahari langsung yang dapat membuat kulit menjadi kering dan pudar.</p>\r\n<p>Terakhir, gunakan shoe tree atau isian kertas untuk menjaga bentuk sendal saat tidak digunakan.</p>', '1.jpg', '2025-06-15'),
(2, 2, 'Tren Sendal Wanita 2025: Gaya yang Sedang Hits', '<p>Tahun 2025 membawa berbagai tren sendal wanita yang menarik dan stylish. Dari model minimalis hingga yang penuh dengan detail, ada banyak pilihan untuk mengekspresikan gaya pribadi Anda.</p>\n<p>Tren pertama adalah sendal dengan tali chunky atau tebal. Model ini memberikan kesan bold dan modern, cocok untuk dipadukan dengan outfit kasual maupun semi formal.</p>\n<p>Tren kedua adalah sendal dengan platform tinggi namun nyaman. Kombinasi tinggi dan kenyamanan menjadi kunci utama dalam tren ini.</p>\n<p>Warna-warna earth tone seperti beige, coklat, dan nude masih mendominasi pilihan warna. Namun, aksen metalik seperti gold dan silver juga mulai populer.</p>\n<p>Jangan lupa untuk memilih sendal yang sesuai dengan bentuk kaki dan aktivitas sehari-hari Anda!</p>', '2.jpg', '2025-06-20'),
(3, 3, 'Panduan Lengkap Memilih Sendal yang Tepat untuk Kaki Anda', '<p>Memilih sendal yang tepat bukan hanya soal penampilan, tetapi juga kenyamanan dan kesehatan kaki. Berikut panduan lengkap untuk membantu Anda memilih sendal yang ideal.</p>\r\n<p>Pertama, kenali bentuk kaki Anda. Apakah Anda memiliki kaki datar, lengkung tinggi, atau normal? Setiap bentuk kaki membutuhkan dukungan yang berbeda.</p>\r\n<p>Kedua, pertimbangkan aktivitas yang akan Anda lakukan. Sendal untuk jalan-jalan santai berbeda dengan sendal untuk hiking atau aktivitas outdoor lainnya.</p>\r\n<p>Ketiga, perhatikan material sendal. Kulit asli lebih tahan lama namun memerlukan perawatan khusus. Karet lebih mudah dibersihkan namun mungkin tidak se-breathable kulit.</p>\r\n<p>Keempat, pastikan ukuran yang pas. Sendal yang terlalu sempit dapat menyebabkan lecet, sedangkan yang terlalu longgar dapat menyebabkan kaki mudah lelah.</p>\r\n<p>Terakhir, jangan lupakan faktor budget. Investasi pada sendal berkualitas akan menghemat pengeluaran jangka panjang.</p>', '3.jpg', '2025-06-25'),
(4, 4, 'Promo Spesial Ramadan: Diskon hingga 50% untuk Semua Jenis Sendal', '<p>Menyambut bulan suci Ramadan, toko sendal kami memberikan promo spesial yang sayang untuk dilewatkan! Dapatkan diskon hingga 50% untuk semua jenis sendal.</p>\r\n<p>Promo ini berlaku untuk semua kategori sendal, mulai dari sendal jepit, sendal gunung, hingga sendal formal. Periode promo dimulai dari 1 Ramadan hingga 15 Syawal.</p>\r\n<p>Khusus untuk pembelian sendal dengan harga di atas Rp 200.000, Anda akan mendapatkan bonus tas kecil yang eksklusif dan limited edition.</p>\r\n<p>Jangan lewatkan kesempatan emas ini untuk memperbarui koleksi sendal Anda atau membelinya sebagai hadiah untuk orang tercinta.</p>\r\n<p>Syarat dan ketentuan berlaku. Promo tidak dapat digabung dengan promo lainnya. Persediaan terbatas, jadi datang sekarang juga!</p>', '4.jpg', '2025-03-01'),
(5, 5, 'Review Sendal Adidas Adilette: Kenyamanan yang Tak Tertandingi', '<p>Sendal Adidas Adilette telah menjadi pilihan favorit para atlet dan pecinta olahraga selama bertahun-tahun. Setelah menggunakan sendal ini selama 6 bulan, berikut review lengkap dari tim kami.</p>\r\n<p>Dari segi kenyamanan, sendal ini memberikan bantalan yang sangat baik untuk kaki. Material EVA yang digunakan mampu menyerap tekanan dengan sempurna, sehingga kaki tidak mudah lelah meski digunakan dalam waktu lama.</p>\r\n<p>Desain yang simpel namun iconic membuat sendal ini cocok dipadukan dengan berbagai outfit, dari pakaian olahraga hingga kasual sehari-hari.</p>\r\n<p>Kualitas material sangat baik dan tahan lama. Setelah 6 bulan penggunaan intensif, sendal masih dalam kondisi prima tanpa kerusakan berarti.</p>\r\n<p>Harga memang sedikit lebih tinggi dibanding sendal biasa, namun sebanding dengan kualitas dan kenyamanan yang diberikan. Rating: 9/10!</p>', '5.jpg', '2025-06-30'),
(6, 6, 'Manfaat Jalan Kaki dengan Sendal yang Tepat untuk Kesehatan', '<p>Jalan kaki adalah salah satu olahraga paling sederhana namun memberikan manfaat luar biasa untuk kesehatan. Namun, pemilihan sendal yang tepat sangat penting untuk memaksimalkan manfaat ini.</p>\r\n<p>Sendal yang baik untuk jalan kaki harus memiliki sol yang empuk untuk menyerap impact saat kaki menyentuh tanah. Hal ini dapat mengurangi risiko cedera pada lutut dan pinggul.</p>\r\n<p>Jalan kaki rutin selama 30 menit setiap hari dapat membantu menurunkan risiko penyakit jantung, diabetes, dan obesitas. Dengan sendal yang nyaman, Anda akan lebih termotivasi untuk berjalan kaki secara teratur.</p>\r\n<p>Pastikan sendal memiliki ventilasi yang baik untuk menjaga kaki tetap kering dan mencegah timbulnya jamur atau bakteri.</p>\r\n<p>Mulailah dengan jarak pendek dan tingkatkan secara bertahap. Dengarkan tubuh Anda dan jangan memaksakan diri jika merasa tidak nyaman.</p>', '6.jpg', '2025-07-01'),
(7, 7, 'Grand Opening Cabang Baru: Kini Hadir di Mall Central Park', '<p>Kami dengan bangga mengumumkan pembukaan cabang baru toko sendal kami di Mall Central Park! Setelah sukses melayani pelanggan selama bertahun-tahun, kini kami hadir lebih dekat dengan Anda.</p>\r\n<p>Cabang baru ini mengusung konsep modern dengan display yang lebih luas dan nyaman. Anda dapat mencoba semua produk dengan lebih leluasa dan mendapat pelayanan yang lebih personal.</p>\r\n<p>Untuk merayakan grand opening, kami memberikan promo khusus berupa diskon 30% untuk semua produk selama 2 minggu pertama. Tersedia juga door prize menarik setiap harinya.</p>\r\n<p>Lokasi strategis di lantai 2 Mall Central Park memudahkan akses dengan transportasi umum maupun kendaraan pribadi. Tersedia juga fasilitas parkir yang luas.</p>\r\n<p>Tim customer service kami siap membantu Anda menemukan sendal yang sempurna sesuai kebutuhan. Datang dan rasakan pengalaman berbelanja yang berbeda!</p>', '7.jpg', '2025-07-02'),
(8, 8, 'Tutorial Mix and Match Sendal dengan Outfit Kasual', '<p>Sendal bukan hanya alas kaki, tetapi juga aksesori fashion yang dapat mempercantik penampilan Anda. Berikut tutorial mix and match sendal dengan outfit kasual yang stylish.</p>\r\n<p>Untuk look kasual sehari-hari, padukan sendal jepit dengan celana pendek dan kaos polos. Pilih warna sendal yang senada atau kontras dengan outfit untuk tampilan yang lebih menarik.</p>\r\n<p>Sendal wedges cocok dipadukan dengan dress midi atau celana kulot untuk tampilan semi formal yang tetap nyaman. Tambahkan aksesori seperti tas selempang kecil untuk melengkapi look.</p>\r\n<p>Jika ingin tampil sporty, gunakan sendal gunung dengan celana hiking dan kaos outdoor. Gaya ini perfect untuk aktivitas alam atau traveling.</p>\r\n<p>Untuk tampilan bohemian, padukan sendal strappy dengan maxi dress dan aksesori vintage. Kombinasi ini akan memberikan kesan free-spirited yang menarik.</p>\r\n<p>Ingat, kunci utama adalah confidence. Pilih kombinasi yang membuat Anda merasa nyaman dan percaya diri!</p>', '8.jpg', '2025-07-03'),
(9, 9, 'Event Fashion Show Sendal Terbaru: Saksikan Koleksi Eksklusif Kami', '<p>Jangan lewatkan event fashion show spektakuler yang akan menampilkan koleksi sendal terbaru dari brand-brand ternama! Acara ini akan berlangsung pada tanggal 15 Juli 2025 di Grand Ballroom Hotel Mulia.</p>\r\n<p>Fashion show ini akan menampilkan lebih dari 50 model sendal terbaru dari berbagai kategori. Mulai dari sendal kasual hingga formal, semuanya akan dipamerkan dalam runway yang memukau.</p>\r\n<p>Sebagai tamu undangan, Anda akan mendapat kesempatan untuk melihat koleksi eksklusif yang belum tersedia di pasaran. Tersedia juga pre-order dengan harga spesial.</p>\r\n<p>Acara ini juga akan menghadirkan talk show dengan fashion stylist terkenal yang akan berbagi tips memilih dan memadukan sendal dengan outfit yang tepat.</p>\r\n<p>Tiket masuk gratis namun terbatas untuk 200 orang pertama. Daftar sekarang melalui website atau datang langsung ke toko kami. Jangan sampai terlewat!</p>', '9.jpg', '2025-07-04'),
(10, 10, 'Pentingnya Memilih Sendal yang Tepat untuk Kesehatan Kaki', '<p>Kesehatan kaki sering diabaikan, padahal kaki merupakan fondasi tubuh yang menopang seluruh aktivitas kita. Pemilihan sendal yang tepat berperan penting dalam menjaga kesehatan kaki jangka panjang.</p>\r\n<p>Sendal yang terlalu datar dapat menyebabkan plantar fasciitis, yaitu peradangan pada jaringan yang menghubungkan tumit dengan jari kaki. Pilih sendal dengan arch support yang adequate.</p>\r\n<p>Material yang tidak breathable dapat menyebabkan jamur dan bakteri berkembang biak. Pilih sendal dengan material yang memungkinkan sirkulasi udara yang baik.</p>\r\n<p>Heel yang terlalu tinggi dapat menyebabkan masalah pada postur tubuh dan nyeri punggung. Pilih tinggi heel yang sesuai dengan aktivitas dan durasi pemakaian.</p>\r\n<p>Konsultasikan dengan dokter kaki jika Anda memiliki kondisi khusus seperti diabetes, arthritis, atau masalah kaki lainnya. Mereka dapat memberikan rekomendasi sendal yang sesuai dengan kondisi Anda.</p>\r\n<p>Investasi pada sendal berkualitas adalah investasi untuk kesehatan kaki jangka panjang Anda.</p>', '10.jpg', '2025-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nm_produk` varchar(50) NOT NULL,
  `berat` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_kategori`, `nm_produk`, `berat`, `harga`, `gambar`, `deskripsi`) VALUES
(1, 1, 'Sendal Jepit Swallow Classic Hitam', 200, 25000, '1.jpg', 'Sendal jepit klasik dengan kualitas terbaik, nyaman digunakan sehari-hari'),
(2, 1, 'Sendal Jepit Swallow Classic Biru', 200, 25000, '2.jpg', 'Sendal jepit klasik warna biru, tahan lama dan anti slip'),
(3, 1, 'Sendal Jepit GSJ Rainbow', 180, 22000, '3.jpg', 'Sendal jepit dengan motif pelangi, cocok untuk anak muda'),
(4, 1, 'Sendal Jepit Havaianas Top Mix', 220, 45000, '4.jpg', 'Sendal jepit premium dari Brazil dengan kualitas internasional'),
(5, 2, 'Sendal Gunung Eiger Lightspeed', 450, 185000, '5.jpg', 'Sendal gunung dengan teknologi quick dry dan anti slip sole'),
(6, 2, 'Sendal Gunung Consina Amazone', 480, 165000, '6.jpg', 'Sendal gunung dengan tali webbing kuat dan bantalan empuk'),
(7, 2, 'Sendal Gunung Rei Granit', 520, 195000, '7.jpg', 'Sendal gunung outdoor dengan grip maksimal untuk tracking'),
(8, 2, 'Sendal Gunung Outdoor Pro Adventure', 500, 175000, '8.jpg', 'Sendal gunung dengan desain sporty dan material berkualitas'),
(9, 3, 'Sendal Selop Bata Comfort', 300, 85000, '9.jpg', 'Sendal selop dengan bantalan memory foam untuk kenyamanan maksimal'),
(10, 3, 'Sendal Selop Fladeo Casual', 280, 65000, '10.jpg', 'Sendal selop kasual dengan desain modern dan elegan'),
(11, 3, 'Sendal Selop Homyped Relax', 320, 75000, '11.jpg', 'Sendal selop dengan teknologi anti bakteri dan anti bau'),
(12, 4, 'Sendal Anak Karakter Hello Kitty', 150, 35000, '12.jpg', 'Sendal anak dengan karakter Hello Kitty yang lucu dan menarik'),
(13, 4, 'Sendal Anak Cars McQueen', 160, 38000, '13.jpg', 'Sendal anak dengan karakter Cars McQueen, disukai anak laki-laki'),
(14, 4, 'Sendal Anak Frozen Elsa', 150, 35000, '14.jpg', 'Sendal anak dengan karakter Frozen Elsa untuk anak perempuan'),
(15, 4, 'Sendal Anak Doraemon', 155, 32000, '15.jpg', 'Sendal anak dengan karakter Doraemon yang menggemaskan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk_variasi`
--

CREATE TABLE `tbl_produk_variasi` (
  `id_variasi` int(11) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `id_warna` int(11) DEFAULT NULL,
  `id_ukuran` int(11) DEFAULT NULL,
  `stok` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_produk_variasi`
--

INSERT INTO `tbl_produk_variasi` (`id_variasi`, `id_produk`, `id_warna`, `id_ukuran`, `stok`) VALUES
(11, 1, 1, 1, 15),
(12, 1, 1, 2, 20),
(13, 1, 1, 3, 25),
(14, 1, 1, 4, 18),
(15, 1, 4, 1, 12),
(16, 1, 4, 2, 16),
(17, 1, 4, 3, 22),
(18, 1, 4, 4, 14),
(19, 2, 2, 1, 18),
(20, 2, 2, 2, 24),
(21, 2, 2, 3, 28),
(22, 2, 2, 4, 20),
(23, 2, 1, 1, 8),
(24, 2, 1, 2, 15),
(25, 2, 1, 3, 19),
(26, 2, 1, 4, 13),
(27, 2, 4, 2, 8),
(28, 2, 4, 3, 12),
(29, 3, 3, 1, 22),
(30, 3, 3, 2, 26),
(31, 3, 3, 3, 30),
(32, 3, 2, 1, 16),
(33, 3, 2, 2, 20),
(34, 3, 2, 3, 24),
(35, 3, 5, 1, 14),
(36, 3, 5, 2, 18),
(37, 3, 5, 3, 21),
(38, 4, 1, 2, 12),
(39, 4, 1, 3, 16),
(40, 4, 1, 4, 14),
(41, 4, 1, 5, 10),
(42, 4, 2, 2, 6),
(43, 4, 2, 3, 12),
(44, 4, 2, 4, 9),
(45, 4, 4, 2, 6),
(46, 4, 4, 3, 10),
(47, 4, 4, 4, 7),
(48, 5, 1, 3, 15),
(49, 5, 1, 4, 18),
(50, 5, 1, 5, 20),
(51, 5, 1, 6, 16),
(52, 5, 6, 3, 12),
(53, 5, 6, 4, 14),
(54, 5, 6, 5, 16),
(55, 5, 6, 6, 13),
(56, 5, 5, 4, 10),
(57, 5, 5, 5, 12),
(58, 5, 5, 6, 9),
(59, 6, 6, 3, 14),
(60, 6, 6, 4, 17),
(61, 6, 6, 5, 19),
(62, 6, 6, 6, 15),
(63, 6, 1, 3, 11),
(64, 6, 1, 4, 13),
(65, 6, 1, 5, 15),
(66, 6, 1, 6, 12),
(67, 6, 5, 4, 8),
(68, 6, 5, 5, 10),
(69, 7, 1, 4, 16),
(70, 7, 1, 5, 19),
(71, 7, 1, 6, 21),
(72, 7, 1, 7, 17),
(73, 7, 6, 4, 13),
(74, 7, 6, 5, 15),
(75, 7, 6, 6, 17),
(76, 7, 6, 7, 14),
(77, 7, 2, 5, 9),
(78, 7, 2, 6, 11),
(79, 8, 1, 3, 13),
(80, 8, 1, 4, 16),
(81, 8, 1, 5, 18),
(82, 8, 1, 6, 15),
(83, 8, 6, 3, 10),
(84, 8, 6, 4, 12),
(85, 8, 6, 5, 14),
(86, 8, 2, 4, 8),
(87, 8, 2, 5, 10),
(88, 8, 2, 6, 7),
(89, 9, 1, 2, 20),
(90, 9, 1, 3, 24),
(91, 9, 1, 4, 22),
(92, 9, 1, 5, 18),
(93, 9, 6, 2, 15),
(94, 9, 6, 3, 18),
(95, 9, 6, 4, 16),
(96, 9, 6, 5, 13),
(97, 9, 2, 3, 12),
(98, 9, 2, 4, 14),
(99, 10, 1, 2, 18),
(100, 10, 1, 3, 22),
(101, 10, 1, 4, 20),
(102, 10, 6, 2, 14),
(103, 10, 6, 3, 17),
(104, 10, 6, 4, 15),
(105, 10, 4, 2, 11),
(106, 10, 4, 3, 13),
(107, 10, 4, 4, 12),
(108, 11, 1, 1, 16),
(109, 11, 1, 2, 20),
(110, 11, 1, 3, 23),
(111, 11, 1, 4, 19),
(112, 11, 2, 1, 12),
(113, 11, 2, 2, 15),
(114, 11, 2, 3, 18),
(115, 11, 2, 4, 14),
(116, 11, 6, 2, 10),
(117, 11, 6, 3, 13),
(118, 12, 3, 1, 25),
(119, 12, 3, 2, 28),
(120, 12, 4, 1, 20),
(121, 12, 4, 2, 22),
(122, 12, 1, 1, 15),
(123, 12, 1, 2, 18),
(124, 13, 3, 1, 30),
(125, 13, 3, 2, 32),
(126, 13, 3, 3, 26),
(127, 13, 2, 1, 22),
(128, 13, 2, 2, 25),
(129, 13, 2, 3, 20),
(130, 13, 1, 1, 18),
(131, 13, 1, 2, 21),
(132, 14, 2, 1, 28),
(133, 14, 2, 2, 30),
(134, 14, 2, 3, 24),
(135, 14, 4, 1, 22),
(136, 14, 4, 2, 26),
(137, 14, 4, 3, 20),
(138, 14, 1, 1, 16),
(139, 14, 1, 2, 19),
(140, 15, 2, 1, 26),
(141, 15, 2, 2, 29),
(142, 15, 2, 3, 23),
(143, 15, 4, 1, 20),
(144, 15, 4, 2, 23),
(145, 15, 4, 3, 18),
(146, 15, 3, 1, 15),
(147, 15, 3, 2, 17),
(148, 15, 1, 1, 12),
(149, 15, 1, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ukuran`
--

CREATE TABLE `tbl_ukuran` (
  `id_ukuran` int(11) NOT NULL,
  `nm_ukuran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_ukuran`
--

INSERT INTO `tbl_ukuran` (`id_ukuran`, `nm_ukuran`) VALUES
(1, '38'),
(2, '39'),
(3, '40'),
(4, '41'),
(5, '42'),
(6, '43'),
(7, '44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warna`
--

CREATE TABLE `tbl_warna` (
  `id_warna` int(11) NOT NULL,
  `nm_warna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_warna`
--

INSERT INTO `tbl_warna` (`id_warna`, `nm_warna`) VALUES
(1, 'Hitam'),
(2, 'Biru'),
(3, 'Merah'),
(4, 'Putih'),
(5, 'Hijau'),
(6, 'Coklat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_variasi` (`id_variasi`);

--
-- Indexes for table `tbl_kat_pos`
--
ALTER TABLE `tbl_kat_pos`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kat_produk`
--
ALTER TABLE `tbl_kat_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_order2` (`id_order`);

--
-- Indexes for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  ADD PRIMARY KEY (`id_pos`),
  ADD KEY `id_kat_pos` (`id_kategori`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tbl_produk_variasi`
--
ALTER TABLE `tbl_produk_variasi`
  ADD PRIMARY KEY (`id_variasi`),
  ADD KEY `id_produk_variasi_fk` (`id_produk`),
  ADD KEY `id_warna_fk` (`id_warna`),
  ADD KEY `id_ukuran_fk` (`id_ukuran`);

--
-- Indexes for table `tbl_ukuran`
--
ALTER TABLE `tbl_ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indexes for table `tbl_warna`
--
ALTER TABLE `tbl_warna`
  ADD PRIMARY KEY (`id_warna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `id_detail_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_kat_pos`
--
ALTER TABLE `tbl_kat_pos`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_kat_produk`
--
ALTER TABLE `tbl_kat_produk`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  MODIFY `id_pos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_produk_variasi`
--
ALTER TABLE `tbl_produk_variasi`
  MODIFY `id_variasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tbl_ukuran`
--
ALTER TABLE `tbl_ukuran`
  MODIFY `id_ukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_warna`
--
ALTER TABLE `tbl_warna`
  MODIFY `id_warna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `id_order` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_produk` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `id_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `id_order2` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  ADD CONSTRAINT `id_kat_pos` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kat_pos` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kat_produk` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_produk_variasi`
--
ALTER TABLE `tbl_produk_variasi`
  ADD CONSTRAINT `id_produk_variasi_fk` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_ukuran_fk` FOREIGN KEY (`id_ukuran`) REFERENCES `tbl_ukuran` (`id_ukuran`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `id_warna_fk` FOREIGN KEY (`id_warna`) REFERENCES `tbl_warna` (`id_warna`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
