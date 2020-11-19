-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2017 at 04:22 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp_bukulapak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(40) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `isbn` bigint(20) NOT NULL,
  `judul` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `idpenulis` int(10) DEFAULT NULL,
  `idpenerbit` int(10) NOT NULL,
  `tgl_terbit` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `gambar_buku` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `deskripsi_buku` text COLLATE latin1_general_ci,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`isbn`, `judul`, `idpenulis`, `idpenerbit`, `tgl_terbit`, `gambar_buku`, `deskripsi_buku`, `harga`) VALUES
(9786021135105, 'Beginilah Para Nabi dan Orang Saleh Berdoa', 1, 6, 'Mei - 2016', '00011-big.jpg', 'Berdoa kepada Allah merupakan wujud keimanan. Dengan berdoa seseorang mengakui bahwa dirinya lemah; yang mempunyai kuasa dan kekuatan hanyalah Allah. Karena itu, orang yang beriman mempersembahkan seluruh hidupnya hanya untuk beribadah kepada Allah. Setiap gerak hidupnya selalu diiringi dengan zikir dan munajat doa kepada Allah. Tiada hari tanpa zikir dan doa.\r\n\r\nHal seperti itu dapat kita lihat dalam kehidupan para nabi dan orang saleh terdahulu. Hidup mereka selalu dihiasi dengan zikir  dan doa. Mereka juga mengajarkan bagaimana cara dan adab seorang mukmin dalam berdoa kepada Allah.\r\n\r\nDoa para nabi dan orang saleh terdahulu dapat kita baca dalam Al-Qur\'an. Banyak hikmah yang dapat kita peroleh melalui doa para nabi dan orang saleh tersebut, sebagaimana yang dikupas oleh Imam asy-Sya\'rawi melalui buku ini. Hikmah dari doa-doa tersebut mengajarkan kepada kita tentang keimanan, rasa syukur, adab berdoa, apa yang sepantasnya dipanjatkan oleh seorang hamba kepada Allah, dan sebagainya. menyegarkan keimanan kita dan mengikatkan diri kita selalu kepada Allah.', 33150),
(9786021139233, 'Sedekah Membabi Buta 2', 2, 10, 'Juli - 2014', '00006-big.jpg', 'Setelah sukses dengan buku pertama, Sedekah Membabi Buta, kini Edi Sutisna merilis lagi buku kedua berjudul Sedekah Membabi Buta 2.\r\n\r\nBuku ini memang dinanti oleh banyak orang. Tulisan Edi Sutisna memang membuat ketagihan setiap orang yang sudah membacanya. Apa Sebab? Karena tulisannya mampu mengaduk-aduk perasaan, membuat orang terharu, menangis, dan kemudian tersadar akan arti hidup di dunia. Tulisan Edi Sutisna juga mampu menjawab inti persoalan kehidupan.', 59075),
(9786021258286, 'Nabi Adam dan Peradaban Nusantara', 3, 10, 'November - 2013', '00008-big.jpg', 'Kita semua sepakat dan yakin bahwa Adam diciptakan oleh Allah SWT. Pertanyaannya, bagaimana Adam diciptakan? Apakah Adam diturunkan dari langit atau dilahirkan sebagaimana manusia biasa? Jika dilahirkan, dimana ia dilahirkan? Kapan dan bagaimana prosesnya?\r\n\r\nBerdasarkan bukti-bukti sains dan ayat-ayat Al-Quran, penulis buku ini membuat beberapa kesimpulan mencengangkan, bahwa Adam bukanlah manusia pertama yang diciptakan Allah, ada manusia yang lebih cerdas sebelum Adam. Yang paling menggetarkan, penulis membuat kesimpulan bahwa, \"Nabi Adam Lahir di Nusantara\"\r\n\r\nLebih jauh, penulis meyakini bahwa bani (spesies) Adam akan musnah dari bumi. Pasalnya, spesies Adam yang hampir mencapai lima milyar ini, kini berada di ambang kehancurannya. Kerusakan yang diakibatkan spesies ini sudah sangat kentara di depan mata. Kerusakan moral, perang nuklir, global warning, dan kerusakan dahsyat lain yang dibuat spesies Adam.\r\n\r\nKetika spesies Adam, anak-cucu kita sudah musnah, maka lahirlah spesies pengganti; khalifah baru yang mengganti bani Adam sebagaimana dulu Adam menggantikan pendahulunya. Saat itu, kita yang sudah menjadi tulang belulang itu akan juga digali dan ditemukan oleh khalifah selanjutnya, entah spesies apa dan bagaimana. Kita pun dianggap sebagai makhluk purbakala oleh khalifah yang akan datang.', 65450),
(9786022492832, 'Kumpulan Doa Sepanjang Hari', 4, 5, '2013', '00012-big.jpg', 'Berdoa tidak bisa dilepaskan dari kehidupan sehari-hari umat Muslim. Bahkan, dalam bacaan shalat pun kita melafalkan doa. Hal ini menunjukkan bahwa Allah SWT adalah tempat kita memohon dun memasrahkan segala suatu yang lerjadi dalam kehidupan. Dengan berdoa, hati akan menjadi tenang, pikiran lebih terbuka, dan tindakan selalu terarah ke jalan yang diridhai uleh-Nya? Berdoa juga membangun kcikhlasan yang insya Allah selalu melingkupi setiap langkah dan keputusan yang kira ambil dalam kehidupan sehari-hari. Buku kumpulan doa ini terdiri dari empat seri, yaitu:\r\n<br><br>\r\n1. Kumpulan Doa Sepanjang Hari<br>\r\n2. Kumpulan Doa Nabi & Rasul<br>\r\n3. Kumpulan Doa Ibadah Wajib & Sunnah<br>\r\n4. Kurnpulan Doa dalam Suka dan Duka', 21250),
(9786024410469, 'Novel Baswedan: Biarlah Malaikat yang Menjaga Saya', 5, 8, 'Desember - 2017', '00004-big.jpg', '<b>Catatan Najwa</b>\r\n<br><br>\r\nMata penyidik Novel Baswedan yang rusak menjadi simbol pemberantasan korupsi yang terbajak.\r\n<br><br>\r\nPenyelesaian hukum kasus Novel Baswedan menjadi ujian keras Presiden untuk berlaku transparan.\r\n<br><br>\r\nJika warga dan negara sekeras baja memberantas korupsi, tak akan mungkin kita biarkan teror ke Novel Baswedan terjadi berkali-kali.\r\n<br><br>\r\nDemi moral kita bersama, Presiden harus turun tangan langsung, memastikan hukum masih bisa tegak membusung.\r\n<br><br>\r\nKita perlu membentuk tim independen pengusutan fakta, demi jaminan keseriusan penyelesaian masalah.\r\n<br><br>\r\nApa kata anak-cucu kita sekarang dan nanti, jika negara bungkam melihat KPK hendak diinjak mati?\r\n<br><br>\r\nKita tahu ada begitu banyak pejabat murka, melihat operasi korupsi mereka diusik KPK.\r\n<br><br>\r\nKepada publik, Polri harus membuktikan, utang kasus Novel Baswedan yang menuntut penuntasan.', 63750),
(9786026673022, 'Pejuang Tahajud: Menelisik Rahasia Shalat Tahajud', 6, 2, 'November - 2017', '00014-big.jpg', 'Sering mendengar ayam berkokok pada sepertiga malam terakhir? Kenapa yah? Benar tidak ya kalau ternyata si ayam melihat malaikat? Allah mengingatkan berulang kali untuk melakukan shalat sepertiga malam terakhir. Ketika Allah memerintahkan atau melarang sesuatu perbuatan maka pasti akan ada alasan besar dibalik hal tersebut. Ya kan?\r\n<br><br>\r\nIngat! Misalnya saja larangan makan daging babi. Tahu kan kalau daging babi cocok sebagai inang cacing pita dan berdasar penelitian ternyata babi dapat memakan kotorannya sendiri.\r\n<br><br>\r\n1. Buku pertama yang telah berhasil ditulis oleh penulis yaitu berjudul Casual Hypnosis (2017), kemudian artikel pertamanya dimuat di Mimbar Mahasiswa Koran Solopos berjudul Belajar Melalui Sinetron.<br>\r\n2. Buku ini dibuat untuk menyampaikan keistimewaan rahasia yang tersembunyi dalam sepertiga malam terakhir, yaitu khususnya shalat tahajud.<br>\r\n3. Cover dan layout di dalam buku tersebut menarik, bagus dan dapat merepresentasikan dari judul buku tersebut.', 31025),
(9786026673527, 'Jangan Asal Nikah: Nikah itu Nggak Sekedar Nyebar Undangan', 7, 2, 'November - 2017', '00013-big.jpg', 'Menikah ternyata tidak se-simple apa yang diimpikan setiap orang. Mereka yang berlimpah harta berlomba-lomba menciptakan impian pernikahan mereka, selayaknya negeri dongeng. Sementara mereka yang memberikan asupan makanan tiga kali sehari saja kesulitan, hanya bisa menyimpan impian pernikahan dalam tidur lelap mereka.\r\n<br><br>\r\nDibalik keributan masalah pernikahan impian, ada segelintir orang yang tidak bisa terlepas dari penyakit kebelet nikah, yang sering kali menjadi momok bagi mereka yang merasa telah memasuki fase telat nikah. Pada dasarnya mereka yang kebelet nikah, tidak benar-benar memiliki keinginan untuk menikah. Ada alasan lain, yang tidak bisa mereka ungkapkan melalui perkataan, sehingga hanya menjadikan sebagai sebuah luka atau penyakit hati.\r\n<br><br>\r\n1. Penulis dari buku ini telah berpengalaman untuk menulis buku-buku tentang motivasi Islam.<br>\r\n2. Buku ini ditulis karena kepedulian penulis terhadap kondisi masyarakat yang dirasa mulai mabuk dengan segala urusan pernikahan yang menjadi salah satu sunnah Nabi Muhammad SAW. Hadirnya buku ini diharapkan membuat pembaca lebih mengerti apa arti dari sebuah penantian dan pernikahan yang tepat yang menjadi idaman setiap pasangan.<br>\r\n3. Buku ini dikemas dengan perpaduan warna yang menarik, baik dari segi cover dan layout', 59075),
(9786027720022, 'Tangga Menuju Kesempurnaan Ibadah (Harbolnas)', 8, 7, 'Desember - 2012', '00007-big.jpg', 'Tujuan penciptaan manusia adalah beribadah kepada Allah swt, demikian penjelasan Tuhan dalam al-Qur\'an. Berarti manusia yang baik adalah manusia yang beribadah dan manusia yang buruk adalah manusia yang tidak beribadah. Ibadah banyak ragam dan macamnya. Pertanyaannya, ibadah yang bagaimanakah yang bisa mengantarkan manusia kepada derajat terpuji sebagai makhluk?\r\n\r\nBuku Tangga Menuju Kesempurnaan Ibadah ini adalah terjemahan dari kitab Syarh Maraqa al-\'Ubadiyah \'ala Matni Bidayati al-Hidayah karya Syaikh Nawawi al-Bantani.  Adapun kitab Bidayati al-Hidayah sendiri merupakan karya Hujjatul Islam Imam al-Ghazali. Maka, kitab ini merupakan penjelasan (syarah) dari Bidayatu al-Hidayah.\r\n\r\nBuku ini ditulis untuk memberikan tuntunan dalam mewujudkan ketakwaan lahir dan ketakwaan batin melalui tiga uraian pokok; Tuntunan menjalankan ibadah, Tuntunan Meninggalkan Perbuatan Maksiat, dan Tuntunan berakhlak kepada Allah dan Makhluk.  Buku ini sangat cocok buat mereka yang mengalami kesulitan dalam menjaga kontinuitas ibadahnya. Buat yang sudah kontinu, buku ini juga sangat bermanfaat untuk meningkatkan kualitas ibadah hingga teraih derajat kesempurnaan ibadah.', 42000),
(9786029215489, 'Kemana Kaki Melangkah Mencapai Kehidupan yang Menyenangkan', 9, 1, 'November - 2017', '00003-big.jpg', 'Pembaca yang budiman, pernahkah Anda berpikir bahwa hidup ini adalah sebuah perjalanan, sebagai sebuah perjalanan tentu ada banyak lika-liku yang harus dilewati, bahkan terkadang seperti roda, kadang di atas kadang pula di bawah. Namun pernahkah Anda berpikir bahwa perjalanan hidup Anda ini suatu saat akan berakhir?\r\n\r\nMaka kemanakah Anda akan melangkahkan kaki Anda? Apakah Anda yakin bahwa tujuan Anda adalah benar?\r\n\r\nKebahagiaan yang menjadi tujuan banyak manusia itu sesungguhnya bukan hanya milik orang kaya dan besar saja tapi juga miliki orang-orang kecil yang terpinggirkan.\r\n\r\nBuku ini didedikasikan untuk mereka yang hidup dalam kesempitan, berada dalam kebingungan yang menyakitkan, mereka yang tengah ditimpa oleh musibah, ataupun tidak dapat tidur dengan tenang. Ingatlah kebahagiaan Anda sangat tergantung pada kemana Anda melangkahkan kaki Anda.', 21250),
(9786029215496, 'Mau Sukses Atau Gagal? Pilihanmu Menentukan Kebahagiaanmu', 10, 1, 'November - 2017', '00002-big.jpg', 'Percaya atau tidak, hidup manusia sebenarnya sangat bergantung pada keinginan-keinginan yang ada dalam pikiran mereka, sebab manusia adalah makhluk yang diberi kehendak bebas oleh Allah dan diberi pula potensi untuk mewujudkannya. Tinggal bagaimana mereka saja, bila mereka ingin maka mereka bisa saja mendapatkannya; cepat tidaknya bergantung pada tinggi rendah tingkat usahanya dan bila ia tidak ingin maka ia pun tidak mendapatkan apa-apa.\r\n\r\nNamun bagaimana bila ia gagal? Sebenarnya setiap orang, siapapun dia, tidak pernah dilahirkan untuk gagal dan menjadi pecundang, ia tidak akan terus menjadi pecundang dan tetap menjadi pecundang, kecuali jika ia sendiri yang menginginkan hal tersebut.\r\n\r\nMaka dari itu perlu disadari bahwa sesungguhnya Allah tidak merubah nasib seseorang sampai ia sendiri yang merubahnya. Dan jangan berharap perubahan kalau Anda sendiri tidak menginginkan sebab hidup adalah pilihan, Anda mau jadi apa tergantung pilihan dan keinginan Anda. Anda mau sukses adalah pilihan Anda, Anda mau \"tetap gagal\" itu juga adalah pilihan Anda. Oleh karenanya pilihlah (paradigma) yang benar karena pilihan yang benar sangat menentukan hidup Anda ke depan!\r\n\r\nDan orang-orang yang digambarkan dalam buku ini adalah orang yang memiliki paradigma (jalan) yang benar sehingga mereka selalu sampai pada tujuannya; sesulit apapun aral yang melintang itu tidak akan pernah membuat mereka mudah menyerah, karena mereka menempuh jalan yang benar. Belajarlah dari mereka agar Anda bisa seperti mereka.', 25500),
(9786029215564, 'Tuntunan Shalat Rasulullah Saw Edisi Terbaru', 11, 1, 'November - 2017', '00001-big.jpg', 'Buku ini merupakan buku paling lengkap dan paling detil yang membahas tata cara shalat Rasulullah Saw. Lewat buku ini pula, \'ulama besar Ibnu Qayyim al-Jauziyah ini membuktikan penguasaan beliau yang sangat mendalam terhadap ilmu hadits dan ilmu fiqih. Imam Ibnu Qayyim selama ini lebih banyak tiikenal di negeri ini lewat karya-karyanya yang bertema penyucian hati (tazkiyatun nafs), meski sebetulnya beliau menguasai banyak bidang keilmuan.\r\n\r\nKarya ini lahir dari penelitian atas literatur hadits yang lama dan intensif, ditambah bimbingan guru utama beliau, Syaikhul Islam ibnu Taimiyah. Tak heran kalau dalam buku ini kita menemukan ulasan yang sangat rinci terhadap berbagai aspek tata cara shalat Nabi berdasarkan literatur hadits-hadits shahih, dan pengambilan hukum yang cerdas.\r\n\r\nDi buku ini kita juga menemukan banyak jawaban atas praktek shalat kaum muslimin saat ini, yang beberapa diantaranya tidak sesuai dengan tuntunan shalat dari Rasulullah Saw.\r\n\r\nSemoga buku ini bisa makin mendekatkan shalat kita dengan shalat yang dilakukan Nabi dan para sahabatnya. Sebab kita memang tegas diperintah untuk menunaikan shalat sesuai dengan shalatnya Rasulullah Saw.', 50575),
(9786029574180, 'Pahamilah Firman-Firman-Ku', 12, 9, 'Juni - 2014', '00009-big.jpg', 'Buku yang sangat luar biasa. Menarik sekali untuk kita baca dengan seksama agar kita mendapatkan kebenaran yang hakiki, kembali kepada fitrah, dan terhindar dari kesalahpahaman yang selama in! diyakini oleh sebagian orang.', 39600),
(9789790390256, 'Wahai Anakku Mana Baktimu?', 13, 4, 'November - 2015', '00010-big.jpg', 'Seorang laki-laki mendatangi Umar bin Khaththab. la memberi tahu Umar bahwa ibunya telah lumpuh. la selalu menggendongnya ke kamar kecil dan merawatnya, Hal itu ia tanyakan kepada Umar, \"Apakah dengan hal itu aku telah memenuhi haknya?\" Umar menjawab, \"Belum.\" Orang itu bertanya, \"Mengapa?\" Umar menjawab, \"Karena kamu merawatnya, namun kamu mengharapkan kematiannya, sedangkan ibumu dulu merawatmu dan ia mengharapkanmu tetaphidup.\"\r\n\r\nItulah potret sekilas bagaimana perilaku anak saat merawat orang tuanya dan sebaliknya. Bedanya sangat jauh, seperti timur dan barat. Bahkan, hanya dengan beberapa kali berbuat baik kepada orang tua, si anak sudah merasa sangat berjasa.\r\n\r\nPadahal, ketika Ibnu Umar ditanya oleh seorang anak yang menggendong ibunya yang lumpuh selama sebulan saat berhaji: apakah dengan hal itu aku telah memenuhi haknya? la menjawab, \"Demi Allah, befunvroeskipun sekadar satu erangan ibumu ketika melahirkanmu....\"', 31450),
(9789790393653, 'Debat Islam VS Non-Islam [Hard Cover]', 19, 4, 'Juli - 2016', '94982_f.jpg', 'Dr. Zakir Naik. Nama yang demikian \"ditakuti\" sehingga ia dicekal tak boleh masuk ke Amerika dan Eropa. Murid dari Ahmad Deedat ini lebih ditakuti daripada gurunya. Selain hafal Al-Qur\'an dan Shahih Bukhari Muslim, ia juga menguasai kitab agama non-Islam, seperti: Bibel, Weda, Tripitaka, Bhagavad Gita, dan Iain-Iain. Begitu menguasainya kitab-kitab itu, Zakir Naik pun sering mengoreksi jika ada pastor atau pendeta yang salah kutip. Selama kiprahnya dalam berdakwah, beliau juga telah mengislamkan puluhan hingga ratusan ribu orang di dunia. Zakir Naik juga telah melayangkan tantangan debat terbuka kepada Paus Yohanes Paulus II di Vatikan-Roma. Namun hingga sekarang, tantangan itu belum dijawab.\r\n\r\nBuku ini merupakan kumpulan tanya-jawab seputar keimanan, wanita, makanan dan minuman, terorisme dan jihad, kaum muslim dan non-muslim, Al-Qur\'an, serta ilmu pengetahuan yang dilontarkan kalangan non-muslim dan dijawab secara meyakinkan oleh Dr. Zakir Naik.', 60000),
(9789793862811, 'Amplop Rezeki', 14, 3, 'Mei - 2013', '00005-big.jpg', 'Para pembaca akan melihat keunikan buku ini. Anda diminta membuktikan dan praktek langsung mengamalkan isi buku ini, tidak usah menunggu waktu yang lama. Berikan amplop rezeki yang ada di dalam buku ini kepada orang lain dan sisipkan pesan bijak di dalamnya!\r\n\r\nSegeralah memberikan apa yang bisa Anda berikan! Segeralah memulai dengan apa yang Anda punya!\r\n\r\n\r\nJangan menunggu waktu. Andalah yang mengejar waktu! Pilihlah hidup Anda sendiri, jangan mau menjadi miskin. Ubahlah tadir Anda, jangan mengeluh! Yakinlah kepada Allah, dan ikut kehendak-Nya! Ingatlah pesan ini.', 46325);

-- --------------------------------------------------------

--
-- Table structure for table `order_buku`
--

CREATE TABLE `order_buku` (
  `idorder` int(20) NOT NULL,
  `isbn` bigint(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga` int(20) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `idpelanggan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_buku`
--

INSERT INTO `order_buku` (`idorder`, `isbn`, `jumlah`, `harga`, `total_harga`, `idpelanggan`) VALUES
(124, 9786021139233, 2, 59075, 118150, 73),
(125, 9786021139233, 2, 59075, 118150, 74),
(126, 9786021139233, 1, 59075, 59075, 75),
(127, 9786021139233, 1, 59075, 59075, 76),
(128, 9786026673022, 1, 31025, 31025, 76),
(129, 9786021139233, 1, 59075, 59075, 77),
(130, 9786027720022, 1, 42000, 42000, 78),
(131, 9786021139233, 1, 59075, 59075, 79),
(132, 9786026673527, 1, 59075, 59075, 80),
(133, 9786021139233, 1, 59075, 59075, 83),
(134, 9786021139233, 1, 59075, 59075, 84);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(10) UNSIGNED NOT NULL,
  `nama` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `kota` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `postal_kode` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `provinsi` varchar(60) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `email`, `alamat`, `kota`, `postal_kode`, `provinsi`) VALUES
(72, 'Riky Ahmad', 'ricky.fatony@gmail.com', 'Sragen', 'Sragen', '57281', 'Jawa Tengah'),
(77, 'Riky Ahmad Fathoni', 'ricky.fatony@gmail.com', 'Sragen', 'Sragen', '57281', 'Jawa Tengah'),
(78, 'Mahasiswa', 'ricky.fatony@gmail.com', 'Solo', 'Solo', '57517', 'Jawa Tengah'),
(79, 'Puput ulvia', 'ricky.fatony@gmail.com', 'Sragen', 'Sragen', '57212', 'Jawa Tengah'),
(80, 'Riky', 'ricky.fatony@gmail.com', 'Test', 'Test', '67654', 'Test'),
(83, 'Riky Ahmad', 'ricky.fatony@gmail.com', 'Sragen', 'Sragen', '57212', 'Jawa Tengah'),
(84, 'Ricky Fathoni', 'ricky.fatony@gmail.com', 'Sragen', 'Sragen', '57218', 'Jawa Tengah');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `idpenerbit` int(10) UNSIGNED NOT NULL,
  `nama_penerbit` varchar(60) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`idpenerbit`, `nama_penerbit`) VALUES
(1, 'Akbar Media'),
(2, 'Anak Hebat Indonesia'),
(3, 'Al Mawardi'),
(4, 'Aqwam Medika'),
(5, 'Bhuana Ilmu Populer'),
(6, 'Khatulistiwa Press'),
(7, 'Lentera Hati'),
(8, 'Mizan'),
(9, 'Pustaka Al-Fadhilah'),
(10, 'Zahira'),
(12, 'Al Mawardi ko'),
(13, 'uiyiuyiuyiy e'),
(23, 'Oke');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `idpenulis` int(10) NOT NULL,
  `nama_penulis` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`idpenulis`, `nama_penulis`) VALUES
(1, 'Imam Asy-Sya\'rawi'),
(2, 'Edi Sutisna'),
(3, 'Yusep Rafiqi'),
(4, 'Hj Afin Murtiningsih'),
(5, 'Zaenuddin HM'),
(6, 'Raina Up'),
(7, 'Anna Mutmainah'),
(8, 'Syaikh Nawawi al-Bantani'),
(9, 'Hamd Shalih Asy-Syatiwi'),
(10, 'Salwa Al Adhihan'),
(11, 'Ibnu Qayyim AL-Jauziyah'),
(12, 'Drs. H. Asep A Sofyan'),
(13, 'Hani Saad Ghunaim'),
(14, 'Ust. Saifuddin Aman'),
(15, 'Master limbad'),
(19, 'Dr. Zakir Naik'),
(21, 'Riky Ahmad');

-- --------------------------------------------------------

--
-- Table structure for table `status_order`
--

CREATE TABLE `status_order` (
  `no_tagihan` int(20) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `tgl_order` varchar(60) NOT NULL,
  `tgl_kirim` varchar(60) NOT NULL,
  `status` varchar(20) NOT NULL,
  `kode_konfirmasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_order`
--

INSERT INTO `status_order` (`no_tagihan`, `id_pelanggan`, `tgl_order`, `tgl_kirim`, `status`, `kode_konfirmasi`) VALUES
(1000000000, 72, '20:21, 22-12-2017', '-', 'Selesai', ''),
(1000000001, 77, '12:36, 23-12-2017', '-', 'Selesai', 'weee'),
(1000000002, 78, '20:43, 25-12-2017', '-', 'Barang Diterima', ''),
(1000000003, 79, '21:16, 25-12-2017', '-', 'Order Diproses', ''),
(1000000004, 80, '21:19, 25-12-2017', '20:00, 28-12-2017', 'Selesai', ''),
(1000000005, 83, '21:25, 26-12-2017', '-', 'Belum Diproses', 'gDzNFgCj'),
(1000000006, 84, '21:27, 26-12-2017', '-', 'Selesai', 'cCk7PvQg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user`,`password`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `order_buku`
--
ALTER TABLE `order_buku`
  ADD PRIMARY KEY (`idorder`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`idpenerbit`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`idpenulis`);

--
-- Indexes for table `status_order`
--
ALTER TABLE `status_order`
  ADD PRIMARY KEY (`no_tagihan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `isbn` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT for table `order_buku`
--
ALTER TABLE `order_buku`
  MODIFY `idorder` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `idpenerbit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `idpenulis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `status_order`
--
ALTER TABLE `status_order`
  MODIFY `no_tagihan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000007;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
