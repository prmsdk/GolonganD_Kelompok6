-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Des 2019 pada 01.44
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cap`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `ADM_ID` varchar(9) NOT NULL,
  `ADM_NAMA_USAHA_ADM` varchar(50) NOT NULL,
  `ADM_EMAIL` varchar(50) NOT NULL,
  `ADM_NO_HP` varchar(13) NOT NULL,
  `ADM_NO_TELP` varchar(13) DEFAULT NULL,
  `ADM_ALAMAT` text NOT NULL,
  `ADM_PROFIL` varchar(32) DEFAULT 'no_profil.jpg',
  `ADM_COVER` varchar(32) DEFAULT 'betak.jpg',
  `ADM_DESC` text,
  `ADM_USERNAME` varchar(50) NOT NULL,
  `ADM_PASSWORD` varchar(32) NOT NULL,
  `ADM_STATUS` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ADM_ID`, `ADM_NAMA_USAHA_ADM`, `ADM_EMAIL`, `ADM_NO_HP`, `ADM_NO_TELP`, `ADM_ALAMAT`, `ADM_PROFIL`, `ADM_COVER`, `ADM_DESC`, `ADM_USERNAME`, `ADM_PASSWORD`, `ADM_STATUS`) VALUES
('ADM000001', 'CAHAYA ABADI PERKASA', 'admin@cahayaabadi.com', '0821412990', '(0331)412990', 'Karang Miuwo, Mangli, Kec. Kaliwates, \r\nKabupaten Jember, Jawa Timur\r\n68131', '465df1038489f5b5.76370692.jpg', 'betak.jpg', 'CV. Cahaya Abadi Perkasa Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam libero et iusto. Perspiciatis tempora ad unde iure reiciendis consequatur cupiditate quaerat animi ullam accusantium, voluptatum voluptatibus facilis. Voluptas, repellendus nisi.', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
('ADM000002', 'Saiful Rizal', 'rizal776@gmail.com', '083847008485', '(0331)660111', 'Gg. Klinik Pratama Jatimulyo, Jember, Bondowoso', 'no_profil.jpg', 'betak.jpg', 'Saiful Rizal Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam libero et iusto. Perspiciatis tempora ad unde iure reiciendis consequatur cupiditate quaerat animi ullam accusantium, voluptatum voluptatibus facilis. Voluptas, repellendus nisi.', 'saiful', '4eeccab0e8c08e16a1d08296265e38fa', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `ID_BAHAN` varchar(9) NOT NULL,
  `ID_SATUAN` varchar(9) NOT NULL,
  `ID_KAT_BAHAN` varchar(9) NOT NULL,
  `NAMA_BAHAN` varchar(30) NOT NULL,
  `HARGA_BAHAN` int(10) NOT NULL,
  `ISI_PER_BAHAN` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`ID_BAHAN`, `ID_SATUAN`, `ID_KAT_BAHAN`, `NAMA_BAHAN`, `HARGA_BAHAN`, `ISI_PER_BAHAN`) VALUES
('BHN000001', 'SBN000001', 'KBN000001', 'HVS 70 gr', 300000, 1),
('BHN000002', 'SBN000001', 'KBN000002', 'AP 100 gr', 450000, 1),
('BHN000003', 'SBN000001', 'KBN000002', 'AP 110 gr', 430000, 1),
('BHN000004', 'SBN000001', 'KBN000001', 'HVS 80gr', 355000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `ID_PRODUK` varchar(9) NOT NULL,
  `ID_PESANAN` varchar(9) NOT NULL,
  `JUMLAH_PRODUK` int(11) NOT NULL,
  `SUB_TOTAL` int(11) NOT NULL,
  `UPLOAD_DESAIN` varchar(32) DEFAULT NULL,
  `STATUS_DESAIN` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`ID_PRODUK`, `ID_PESANAN`, `JUMLAH_PRODUK`, `SUB_TOTAL`, `UPLOAD_DESAIN`, `STATUS_DESAIN`) VALUES
('PRD000003', 'PSN000002', 645, 703000, NULL, 0),
('PRD000001', 'PSN000001', 125, 300000, NULL, 0),
('PRD000002', 'PSN000001', 250, 156000, NULL, 1),
('PRD000004', 'PSN000003', 450, 320000, NULL, 1),
('PRD000005', 'PSN000003', 200, 240000, 'kalender.jpg', 0),
('PRD000006', 'PSN000004', 631, 560000, NULL, 1),
('PRD000007', 'PSN000005', 400, 350000, 'design.zip', 0),
('PRD000009', 'PSN000007', 209, 94700, NULL, 1),
('PRD000010', 'PSN000008', 312, 352800, NULL, 1),
('PRD000011', 'PSN000009', 44, 71600, 'Penulisan Laporan.zip', 0),
('PRD000012', 'PSN000010', 12, 43400, '', 1),
('PRD000013', 'PSN000011', 77, 161300, '', 1),
('PRD000014', 'PSN000012', 66, 28300, 'DesainLombaWEB.zip', 0),
('PRD000015', 'PSN000013', 880, 822800, '', 1),
('PRD000016', 'PSN000014', 44, 62350, '595dfd68e20332c9.40265457.zip', 0),
('PRD000017', 'PSN000014', 77, 123200, '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_produk`
--

CREATE TABLE `gambar_produk` (
  `GBR_ID` varchar(9) NOT NULL,
  `ID_TAMPIL_PRODUK` varchar(9) NOT NULL,
  `GBR_FILE_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gambar_produk`
--

INSERT INTO `gambar_produk` (`GBR_ID`, `ID_TAMPIL_PRODUK`, `GBR_FILE_NAME`) VALUES
('GBR000001', 'PRD000001', 'brosur-1.jpg'),
('GBR000002', 'PRD000001', 'brosur-2.jpg'),
('GBR000003', 'PRD000001', 'kartunama-3.jpg'),
('GBR000004', 'PRD000002', 'brosur-2.jpg'),
('GBR000005', 'PRD000003', 'kartunama-1.jpg'),
('GBR000006', 'PRD000003', 'kartunama-3.jpg'),
('GBR000007', 'PRD000003', 'kartunama-2.jpg'),
('GBR000008', 'PRD000004', 'kalender-01.jpg'),
('GBR000009', 'PRD000005', 'Free-Hanging-Over-Wall-Poster-Mockup-PSD.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_bahan`
--

CREATE TABLE `kategori_bahan` (
  `ID_KAT_BAHAN` varchar(9) NOT NULL,
  `NAMA_KAT_BAHAN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_bahan`
--

INSERT INTO `kategori_bahan` (`ID_KAT_BAHAN`, `NAMA_KAT_BAHAN`) VALUES
('KBN000001', 'HVS'),
('KBN000002', 'AP'),
('KBN000003', 'IVORY'),
('KBN000004', 'DUPLEX'),
('KBN000005', 'BONTAX');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `ID_KATEGORI` varchar(9) NOT NULL,
  `NAMA_KAT_PRODUK` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`ID_KATEGORI`, `NAMA_KAT_PRODUK`) VALUES
('KPD000001', 'OFFSET'),
('KPD000002', 'LASER A3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_ukuran`
--

CREATE TABLE `kategori_ukuran` (
  `ID_KAT_UKURAN` varchar(9) NOT NULL,
  `NAMA_KAT_UKURAN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_ukuran`
--

INSERT INTO `kategori_ukuran` (`ID_KAT_UKURAN`, `NAMA_KAT_UKURAN`) VALUES
('KUN000001', 'Seri A'),
('KUN000002', 'Seri F'),
('KUN000003', 'Seri B'),
('KUN000004', 'Seri C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `ID_MSG` varchar(9) NOT NULL,
  `MSG_NAMA` varchar(50) NOT NULL,
  `MSG_EMAIL` varchar(50) NOT NULL,
  `MSG_NO_HP` varchar(13) NOT NULL,
  `MSG_SUBJECT` varchar(100) NOT NULL,
  `MSG_MESSAGE` text NOT NULL,
  `MSG_TGL` datetime NOT NULL,
  `MSG_STATUS` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`ID_MSG`, `MSG_NAMA`, `MSG_EMAIL`, `MSG_NO_HP`, `MSG_SUBJECT`, `MSG_MESSAGE`, `MSG_TGL`, `MSG_STATUS`) VALUES
('MSG000001', 'Dini Vega Safitri', 'dinivegas@gmail.com', '082430119989', 'Produk Tidak Kunjung Datang', 'Maaf, pesanan saya tidak kunjung datang seperti yang telah dijadwalkan, bagaimana ini?', '2019-12-19 03:00:00', 0),
('MSG000002', 'Raziki Gforce', 'hackjones001@gmail.com', '082430119989', 'Komplain Produk', 'Saya ingin komplain, produk saya tidak sesuai pesanan, ID Pesanan Saya PSN000006, apakah bisa saya ambil kembali uang yang telah saya bayar?', '2019-12-20 06:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nego`
--

CREATE TABLE `nego` (
  `ID_NEGO` varchar(9) NOT NULL,
  `ID_PRODUK` varchar(9) NOT NULL,
  `ID_UKURAN` varchar(9) NOT NULL,
  `ID_WARNA` varchar(9) NOT NULL,
  `ID_BAHAN` varchar(9) NOT NULL,
  `NAMA_PRODUK` varchar(30) NOT NULL,
  `JUMLAH_PRODUK` int(11) NOT NULL,
  `SUB_TOTAL` int(11) NOT NULL,
  `UPLOAD_DESAIN` varchar(32) NOT NULL,
  `STATUS_DESAIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `ID_PESANAN` varchar(9) NOT NULL,
  `ADM_ID` varchar(9) NOT NULL,
  `USER_ID` varchar(9) NOT NULL,
  `TANGGAL_PESANAN` datetime NOT NULL,
  `TOTAL_HARGA` int(11) DEFAULT NULL,
  `STATUS_PESANAN` int(1) NOT NULL,
  `BUKTI_TRANSFER` varchar(32) DEFAULT NULL,
  `KET_PEMBAYARAN` int(1) NOT NULL,
  `ADMIN_NOTIF` int(1) NOT NULL DEFAULT '0',
  `USER_NOTIF` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`ID_PESANAN`, `ADM_ID`, `USER_ID`, `TANGGAL_PESANAN`, `TOTAL_HARGA`, `STATUS_PESANAN`, `BUKTI_TRANSFER`, `KET_PEMBAYARAN`, `ADMIN_NOTIF`, `USER_NOTIF`) VALUES
('PSN000001', 'ADM000001', 'USR000001', '2019-12-16 09:00:00', 456000, 6, NULL, 1, 0, 0),
('PSN000002', 'ADM000002', 'USR000002', '2019-12-19 07:00:00', 703000, 4, NULL, 2, 0, 0),
('PSN000003', 'ADM000002', 'USR000002', '2019-12-17 16:00:00', 354000, 1, NULL, 1, 0, 0),
('PSN000004', 'ADM000002', 'USR000004', '2019-12-17 00:00:00', 560000, 3, 'bukti_tf.jpg', 1, 0, 0),
('PSN000005', 'ADM000001', 'USR000003', '2019-12-16 00:00:00', 350000, 3, 'bukti.jpg', 2, 0, 0),
('PSN000007', 'ADM000001', 'USR000001', '2019-12-17 16:40:14', 94700, 1, NULL, 2, 0, 1),
('PSN000008', 'ADM000001', 'USR000001', '2019-12-20 21:57:28', 352800, 5, 'bukti_tf.jpg', 1, 0, 0),
('PSN000009', 'ADM000001', 'USR000001', '2019-12-18 05:57:06', 71600, 1, NULL, 1, 0, 0),
('PSN000010', 'ADM000001', 'USR000001', '2019-12-18 06:10:51', 43400, 1, NULL, 2, 0, 0),
('PSN000011', 'ADM000001', 'USR000002', '2019-12-18 09:18:34', 161300, 1, NULL, 1, 0, 0),
('PSN000012', 'ADM000001', 'USR000002', '2019-12-19 10:19:01', 28300, 1, NULL, 2, 0, 0),
('PSN000013', 'ADM000001', 'USR000002', '2019-12-18 10:22:43', 822800, 6, NULL, 1, 0, 1),
('PSN000014', 'ADM000001', 'USR000002', '2019-12-21 07:17:53', 185550, 1, '755dfd64bbd60af3.64367438.png', 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `portfolio`
--

CREATE TABLE `portfolio` (
  `ID_PORTFOLIO` varchar(9) NOT NULL,
  `JUDUL` varchar(30) NOT NULL,
  `DESKRIPSI` text NOT NULL,
  `GAMBAR` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `portfolio`
--

INSERT INTO `portfolio` (`ID_PORTFOLIO`, `JUDUL`, `DESKRIPSI`, `GAMBAR`) VALUES
('PFL000001', 'Swiwings Packaging Product', 'Swiwings menghemat biaya produksi packaging produknya dengan mencetak di CV. Cahaya Abadi Perkasa.', '245dfb3e147cda16.90510151.jpg'),
('PFL000002', 'Brosur Telkom Indonesia', 'Mencetak brosur Telkom pasang baru setiap bulan di Cahaya Abadi Perkasa lebih murah!', '525dfb54c69272b9.28932165.jpg'),
('PFL000003', 'Kalender Meja Mandiri', 'Cetak Kalender Meja untuk Mandiri, lebih mudah di CV. Cahaya Abadi Perkasa', '485dfb594546f8d9.86398261.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `ID_PRODUK` varchar(9) NOT NULL,
  `ID_UKURAN` varchar(9) NOT NULL,
  `ID_BAHAN` varchar(9) NOT NULL,
  `ID_WARNA` varchar(9) NOT NULL,
  `NAMA_PRODUK` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`ID_PRODUK`, `ID_UKURAN`, `ID_BAHAN`, `ID_WARNA`, `NAMA_PRODUK`) VALUES
('PRD000001', 'UKN000001', 'BHN000001', 'WRN000001', 'Brosur'),
('PRD000002', 'UKN000002', 'BHN000001', 'WRN000002', 'Banner'),
('PRD000003', 'UKN000006', 'BHN000003', 'WRN000003', 'Kartu Nama'),
('PRD000004', 'UKN000004', 'BHN000002', 'WRN000005', 'Banner'),
('PRD000005', 'UKN000005', 'BHN000001', 'WRN000004', 'Kalender'),
('PRD000006', 'UKN000009', 'BHN000001', 'WRN000002', 'Kalender'),
('PRD000007', 'UKN000007', 'BHN000003', 'WRN000004', 'Brosur'),
('PRD000009', 'UKN000002', 'BHN000001', 'WRN000002', 'Brosur'),
('PRD000010', 'UKN000005', 'BHN000002', 'WRN000003', 'Poster'),
('PRD000011', 'UKN000006', 'BHN000002', 'WRN000002', 'Banner'),
('PRD000012', 'UKN000004', 'BHN000002', 'WRN000001', 'Poster'),
('PRD000013', 'UKN000006', 'BHN000002', 'WRN000001', 'Banner'),
('PRD000014', 'UKN000003', 'BHN000001', 'WRN000004', 'Kartu Nama'),
('PRD000015', 'UKN000004', 'BHN000003', 'WRN000002', 'Poster'),
('PRD000016', 'UKN000001', 'BHN000002', 'WRN000001', 'Brosur'),
('PRD000017', 'UKN000005', 'BHN000001', 'WRN000004', 'Kartu Nama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_bank`
--

CREATE TABLE `rekening_bank` (
  `ID_REKENING` varchar(9) NOT NULL,
  `ADM_ID` varchar(9) NOT NULL,
  `NAMA_REKENING` varchar(50) NOT NULL,
  `NOMOR_REKENING` varchar(50) NOT NULL,
  `STATUS_REKENING` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening_bank`
--

INSERT INTO `rekening_bank` (`ID_REKENING`, `ADM_ID`, `NAMA_REKENING`, `NOMOR_REKENING`, `STATUS_REKENING`) VALUES
('NRK000001', 'ADM000001', 'BRI', '93872981', 1),
('NRK000002', 'ADM000002', 'MANDIRI', '008735621', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_bahan`
--

CREATE TABLE `satuan_bahan` (
  `ID_SATUAN` varchar(9) NOT NULL,
  `SATUAN` varchar(30) NOT NULL,
  `JUMLAH_SATUAN` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan_bahan`
--

INSERT INTO `satuan_bahan` (`ID_SATUAN`, `SATUAN`, `JUMLAH_SATUAN`) VALUES
('SBN000001', 'RIM', 500),
('SBN000002', 'LUSIN', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `ID_SLIDER` varchar(9) NOT NULL,
  `TOMBOL` varchar(20) NOT NULL,
  `LINK` varchar(50) NOT NULL,
  `DESKRIPSI` tinytext NOT NULL,
  `GAMBAR` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`ID_SLIDER`, `TOMBOL`, `LINK`, `DESKRIPSI`, `GAMBAR`) VALUES
('SLD000001', 'Pesan', 'index.php#produkbtn', 'Mau Cetak Brosur? Kalender? Kartu Nama? <br>\r\ntidak perlu ribet! Pesan disini Sekarang!', '345dfb3e8b10f177.56062642.jpg'),
('SLD000002', 'Daftar Produk', 'register_user.php', 'Udah deh, tunggu apa lagi? <br> Pesan semua kebutuhan kantor, kebutuhan kuliah, dll. Langsung disini!', '935df6323597a577.52906237.jpg'),
('SLD000003', 'Pesan', 'index.php#produkbtn', 'Cetak Buku? Notes? LKS? Gift Book?<br> kok masih wira wiri? <br> Ayo Segera Pesan disini saja!', '125dfb3eb8b8ff86.77914521.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tampil_bahan`
--

CREATE TABLE `tampil_bahan` (
  `ID_TAMPIL_PRODUK` varchar(9) NOT NULL,
  `ID_BAHAN` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tampil_bahan`
--

INSERT INTO `tampil_bahan` (`ID_TAMPIL_PRODUK`, `ID_BAHAN`) VALUES
('PRD000001', 'BHN000001'),
('PRD000001', 'BHN000002'),
('PRD000002', 'BHN000001'),
('PRD000002', 'BHN000002'),
('PRD000003', 'BHN000001'),
('PRD000004', 'BHN000001'),
('PRD000005', 'BHN000001'),
('PRD000005', 'BHN000002'),
('PRD000005', 'BHN000003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tampil_produk`
--

CREATE TABLE `tampil_produk` (
  `ID_TAMPIL_PRODUK` varchar(9) NOT NULL,
  `ID_KATEGORI` varchar(9) NOT NULL,
  `NAMA_TAMPIL_PRODUK` varchar(30) NOT NULL,
  `DESC_TAMPIL_PRODUK` text NOT NULL,
  `KET_TAMPIL_PRODUK` varchar(200) NOT NULL,
  `STATUS_TAMPIL_PRODUK` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tampil_produk`
--

INSERT INTO `tampil_produk` (`ID_TAMPIL_PRODUK`, `ID_KATEGORI`, `NAMA_TAMPIL_PRODUK`, `DESC_TAMPIL_PRODUK`, `KET_TAMPIL_PRODUK`, `STATUS_TAMPIL_PRODUK`) VALUES
('PRD000001', 'KPD000001', 'Brosur', 'Cetak brosur merupakan salah satu langkah yang bisa Anda lakukan untuk mempromosikan sebuah bisnis. Sebab, di dalam brosur terdapat berbagai macam informasi mengenai produk Anda. Oleh karena itu, untuk merancang sebuah brosur, tidak bisa sembarangan. Dibutuhkan beberapa tips agar fungsi dari keberadaan brosur dapat maksimal. Berikut ini beberapa hal yang perlu Anda ketahui terkait cetak brosur, mulai dari fungsi brosur, tips membuat brosur, hingga langkah-langkah penting sebelum mencetak brosur.', 'ket_harga.htm', 1),
('PRD000002', 'KPD000001', 'Banner', 'Banner digunakan untuk Banner', 'ket_harga.htm', 1),
('PRD000003', 'KPD000002', 'Kartu Nama', 'Kartu Nama adalah sebuah kartu yang menyampaikan informasi tentang sebuah perusahaan ataupun individu yang disampaikan hanya sebagai pengingat dalam sebuah perkenalan formal. Pada umumnya kartu nama berisi tentang nama perusahaan (termasuk logo perusahaan) dan alamat pos, nomor telepon, nomor fax dan email, situs web.', 'coba.htm', 1),
('PRD000004', 'KPD000001', 'Kalender', 'Kalender, tarikh, atau penanggalan adalah sebuah sistem untuk memberi nama pada sebuah periode waktu (seperti hari sebagai contohnya). Nama-nama ini dikenal sebagai tanggal kalender. Tanggal ini bisa didasarkan dari gerakan-gerakan benda angkasa seperti matahari dan bulan. Kalender juga dapat mengacu kepada alat yang mengilustrasikan sistem tersebut (sebagai contoh, sebuah kalender dinding).', 'coba.htm', 1),
('PRD000005', 'KPD000001', 'Poster', 'Poster atau plakat adalah karya seni atau desain grafis yang memuat komposisi gambar dan huruf di atas kertas berukuran besar atau kecil. Pengaplikasiannya dengan ditempel di dinding atau permukaan datar lainnya dengan sifat mencari perhatian mata sekuat mungkin.', 'ket_harga.htm', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tampil_ukuran`
--

CREATE TABLE `tampil_ukuran` (
  `ID_TAMPIL_PRODUK` varchar(9) NOT NULL,
  `ID_UKURAN` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tampil_ukuran`
--

INSERT INTO `tampil_ukuran` (`ID_TAMPIL_PRODUK`, `ID_UKURAN`) VALUES
('PRD000001', 'UKN000001'),
('PRD000001', 'UKN000002'),
('PRD000002', 'UKN000004'),
('PRD000002', 'UKN000006'),
('PRD000002', 'UKN000009'),
('PRD000003', 'UKN000002'),
('PRD000003', 'UKN000003'),
('PRD000003', 'UKN000005'),
('PRD000003', 'UKN000006'),
('PRD000003', 'UKN000009'),
('PRD000004', 'UKN000003'),
('PRD000004', 'UKN000005'),
('PRD000005', 'UKN000001'),
('PRD000005', 'UKN000004'),
('PRD000005', 'UKN000005'),
('PRD000005', 'UKN000007');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tampil_warna`
--

CREATE TABLE `tampil_warna` (
  `ID_TAMPIL_PRODUK` varchar(9) NOT NULL,
  `ID_WARNA` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tampil_warna`
--

INSERT INTO `tampil_warna` (`ID_TAMPIL_PRODUK`, `ID_WARNA`) VALUES
('PRD000001', 'WRN000001'),
('PRD000001', 'WRN000002'),
('PRD000002', 'WRN000001'),
('PRD000002', 'WRN000002'),
('PRD000003', 'WRN000001'),
('PRD000003', 'WRN000004'),
('PRD000003', 'WRN000005'),
('PRD000004', 'WRN000001'),
('PRD000004', 'WRN000002'),
('PRD000005', 'WRN000001'),
('PRD000005', 'WRN000002'),
('PRD000005', 'WRN000003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonial`
--

CREATE TABLE `testimonial` (
  `ID_TESTI` varchar(9) NOT NULL,
  `TESTI_NAMA` varchar(50) NOT NULL,
  `TESTI_PROFESI` varchar(50) NOT NULL,
  `TESTI_DESC` text NOT NULL,
  `TESTI_FOTO` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `testimonial`
--

INSERT INTO `testimonial` (`ID_TESTI`, `TESTI_NAMA`, `TESTI_PROFESI`, `TESTI_DESC`, `TESTI_FOTO`) VALUES
('TST000001', 'Raziki Gforce', 'Manager Swiwings Corporation', 'Saya sangat senang dengan pelayanan CV. Cahaya Abadi Perkasa yang ramah dan tidak bertele tele hehe', '255dfbae301c8d15.45126439.jpg'),
('TST000002', 'Juk-Yung Lim', 'Manager Korean Food', 'Cahaya Abadi Perkasa memang percetakan yang menyajikan kemudahan dan kecepatan untuk produk semisal brosur, pamflet, poster dan media promosi lainnya', '505dfbb0ed8edd30.20088395.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukuran`
--

CREATE TABLE `ukuran` (
  `ID_UKURAN` varchar(9) NOT NULL,
  `ID_KAT_UKURAN` varchar(9) NOT NULL,
  `JENIS_UKURAN` varchar(30) NOT NULL,
  `HARGA_UKURAN` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ukuran`
--

INSERT INTO `ukuran` (`ID_UKURAN`, `ID_KAT_UKURAN`, `JENIS_UKURAN`, `HARGA_UKURAN`) VALUES
('UKN000001', 'KUN000001', 'A4 (21 x 29,7)', 2750),
('UKN000002', 'KUN000002', 'F4 (21 x 33)', 4000),
('UKN000003', 'KUN000001', 'A5 (14,8 x 21)', 2000),
('UKN000004', 'KUN000001', 'A3 (29,7 x 42)', 6000),
('UKN000005', 'KUN000001', 'A2 (42 x 59,4)', 12000),
('UKN000006', 'KUN000001', 'A1 (59,4 x 84,1)', 22000),
('UKN000007', 'KUN000001', 'A0 (84,1 x 118,9)', 38000),
('UKN000008', 'KUN000003', 'B0 (100 x 141,4)', 48000),
('UKN000009', 'KUN000004', 'C0 (91,7 x 129,7)', 44000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `USER_ID` varchar(9) NOT NULL,
  `USER_NAMA_LENGKAP` varchar(50) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_NO_HP` varchar(13) NOT NULL,
  `USER_ALAMAT` text,
  `USER_PROFIL` varchar(100) DEFAULT 'no_profil.jpg',
  `USER_COVER` varchar(100) DEFAULT 'betak.jpg',
  `USER_USERNAME` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(32) NOT NULL,
  `USER_HASH` varchar(32) NOT NULL,
  `USER_ACTIVE` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`USER_ID`, `USER_NAMA_LENGKAP`, `USER_EMAIL`, `USER_NO_HP`, `USER_ALAMAT`, `USER_PROFIL`, `USER_COVER`, `USER_USERNAME`, `USER_PASSWORD`, `USER_HASH`, `USER_ACTIVE`) VALUES
('USR000001', 'Primasdika Yunia Putra', 'dickayunia1@gmail.com', '083847008485', 'Gg. Klinik Pratama No 99\r\nMaesan, Bondowoso, Jawa Timur', 'dika.jpg', 'coverdika.jpg', '@prmsdk', 'cfbd0bd15c81301cbabe30143fd80b1a', 'c0f168ce8900fa56e57789e2a2f2c9d0', 1),
('USR000002', 'Siti Nurlaeli Agustin', 'lelyagstn@gmail.com', '085885566770', 'Jl. Brigpol Soedarlan RT05 RW02 No.2, Petung, Curahdami, Bondowoso', 'noprofil.jpg', 'betak.jpg', '@lely_agstn', 'bce95752c0ebda21194e3a80b732ac92', 'abd815286ba1007abfbb8415b83ae2cf', 1),
('USR000003', 'Aldion', 'aldion819@gmail.com', '083853000123', NULL, NULL, NULL, '@aldion.anjay_', 'a0792fe69cc316d4188ac2c71d1635e0', 'ec8ce6abb3e952a85b8551ba726a1227', 1),
('USR000004', 'Dyta', 'dytashofia32@gmail.com', '083853000123', NULL, NULL, NULL, '@dyta', '65f14443215834271c1ad576630df067', 'cc1aa436277138f61cda703991069eaf', 0),
('USR000005', 'Raziki', 'jekiyudi15@gmail.com', '082233120146', 'Pakuwesi, Curahdami ', 'no_profil.jpg', 'betak.jpg', '@raziki', '67fab04a48e028732fab845d0ac58954', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warna`
--

CREATE TABLE `warna` (
  `ID_WARNA` varchar(9) NOT NULL,
  `JENIS_WARNA` varchar(30) NOT NULL,
  `WARNA_DESC` text,
  `HARGA_WARNA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `warna`
--

INSERT INTO `warna` (`ID_WARNA`, `JENIS_WARNA`, `WARNA_DESC`, `HARGA_WARNA`) VALUES
('WRN000001', 'Full Color (Dua Muka)', 'Deskripsi Full Color', 20000),
('WRN000002', 'Satu Warna (Dua Muka)', 'Ini Satu Warna Dua Muka', 10000),
('WRN000003', 'Full Color (Satu Muka)', 'Untuk Satu Muka saja tapi fullcolor', 10000),
('WRN000004', 'Full Color & Satu Warna ', 'Full Color & Satu Warna (Dua Muka)', 15000),
('WRN000005', 'Satu Warna (Satu Muka)', 'Satu Warna (Satu Muka)', 5300);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADM_ID`);

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`ID_BAHAN`),
  ADD KEY `FK_MEMILIKIKATEGORIBAHAN` (`ID_KAT_BAHAN`),
  ADD KEY `FK_MEMILIKISATUAN` (`ID_SATUAN`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD KEY `AK_IDENTIFIER_1` (`ID_PRODUK`,`ID_PESANAN`),
  ADD KEY `FK_MEMILIKI2` (`ID_PESANAN`);

--
-- Indeks untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD PRIMARY KEY (`GBR_ID`),
  ADD KEY `FK_MEMILIKIGAMBAR` (`ID_TAMPIL_PRODUK`);

--
-- Indeks untuk tabel `kategori_bahan`
--
ALTER TABLE `kategori_bahan`
  ADD PRIMARY KEY (`ID_KAT_BAHAN`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indeks untuk tabel `kategori_ukuran`
--
ALTER TABLE `kategori_ukuran`
  ADD PRIMARY KEY (`ID_KAT_UKURAN`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID_MSG`);

--
-- Indeks untuk tabel `nego`
--
ALTER TABLE `nego`
  ADD PRIMARY KEY (`ID_NEGO`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`ID_PESANAN`),
  ADD KEY `FK_MELAYANI` (`ADM_ID`),
  ADD KEY `FK_MEMESAN` (`USER_ID`);

--
-- Indeks untuk tabel `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`ID_PORTFOLIO`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ID_PRODUK`),
  ADD KEY `FK_MEMILIKIBAHAN` (`ID_BAHAN`),
  ADD KEY `FK_MEMILIKIUKURAN` (`ID_UKURAN`),
  ADD KEY `FK_MEMILIKIWARNA` (`ID_WARNA`);

--
-- Indeks untuk tabel `rekening_bank`
--
ALTER TABLE `rekening_bank`
  ADD PRIMARY KEY (`ID_REKENING`),
  ADD KEY `FK_MEMILIKI_REKENING` (`ADM_ID`);

--
-- Indeks untuk tabel `satuan_bahan`
--
ALTER TABLE `satuan_bahan`
  ADD PRIMARY KEY (`ID_SATUAN`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`ID_SLIDER`);

--
-- Indeks untuk tabel `tampil_bahan`
--
ALTER TABLE `tampil_bahan`
  ADD KEY `AK_IDENTIFIER_1` (`ID_TAMPIL_PRODUK`,`ID_BAHAN`),
  ADD KEY `FK_TAMPIL_BAHAN2` (`ID_BAHAN`);

--
-- Indeks untuk tabel `tampil_produk`
--
ALTER TABLE `tampil_produk`
  ADD PRIMARY KEY (`ID_TAMPIL_PRODUK`),
  ADD KEY `FK_MEMILIKIKATEGORI` (`ID_KATEGORI`);

--
-- Indeks untuk tabel `tampil_ukuran`
--
ALTER TABLE `tampil_ukuran`
  ADD KEY `AK_IDENTIFIER_1` (`ID_TAMPIL_PRODUK`,`ID_UKURAN`),
  ADD KEY `FK_TAMPIL_UKURAN2` (`ID_UKURAN`);

--
-- Indeks untuk tabel `tampil_warna`
--
ALTER TABLE `tampil_warna`
  ADD KEY `AK_IDENTIFIER_1` (`ID_TAMPIL_PRODUK`,`ID_WARNA`),
  ADD KEY `FK_TAMPIL_WARNA2` (`ID_WARNA`);

--
-- Indeks untuk tabel `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`ID_TESTI`);

--
-- Indeks untuk tabel `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`ID_UKURAN`),
  ADD KEY `FK_MEMILIKIKATEGORIUKURAN` (`ID_KAT_UKURAN`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indeks untuk tabel `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`ID_WARNA`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD CONSTRAINT `FK_MEMILIKIKATEGORIBAHAN` FOREIGN KEY (`ID_KAT_BAHAN`) REFERENCES `kategori_bahan` (`ID_KAT_BAHAN`),
  ADD CONSTRAINT `FK_MEMILIKISATUAN` FOREIGN KEY (`ID_SATUAN`) REFERENCES `satuan_bahan` (`ID_SATUAN`);

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`),
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`ID_PESANAN`) REFERENCES `pesanan` (`ID_PESANAN`);

--
-- Ketidakleluasaan untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD CONSTRAINT `FK_MEMILIKIGAMBAR` FOREIGN KEY (`ID_TAMPIL_PRODUK`) REFERENCES `tampil_produk` (`ID_TAMPIL_PRODUK`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `FK_MELAYANI` FOREIGN KEY (`ADM_ID`) REFERENCES `admin` (`ADM_ID`),
  ADD CONSTRAINT `FK_MEMESAN` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `FK_MEMILIKIBAHAN` FOREIGN KEY (`ID_BAHAN`) REFERENCES `bahan` (`ID_BAHAN`),
  ADD CONSTRAINT `FK_MEMILIKIUKURAN` FOREIGN KEY (`ID_UKURAN`) REFERENCES `ukuran` (`ID_UKURAN`),
  ADD CONSTRAINT `FK_MEMILIKIWARNA` FOREIGN KEY (`ID_WARNA`) REFERENCES `warna` (`ID_WARNA`);

--
-- Ketidakleluasaan untuk tabel `rekening_bank`
--
ALTER TABLE `rekening_bank`
  ADD CONSTRAINT `FK_MEMILIKI_REKENING` FOREIGN KEY (`ADM_ID`) REFERENCES `admin` (`ADM_ID`);

--
-- Ketidakleluasaan untuk tabel `tampil_bahan`
--
ALTER TABLE `tampil_bahan`
  ADD CONSTRAINT `FK_TAMPIL_BAHAN` FOREIGN KEY (`ID_TAMPIL_PRODUK`) REFERENCES `tampil_produk` (`ID_TAMPIL_PRODUK`),
  ADD CONSTRAINT `FK_TAMPIL_BAHAN2` FOREIGN KEY (`ID_BAHAN`) REFERENCES `bahan` (`ID_BAHAN`);

--
-- Ketidakleluasaan untuk tabel `tampil_produk`
--
ALTER TABLE `tampil_produk`
  ADD CONSTRAINT `FK_MEMILIKIKATEGORI` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori_produk` (`ID_KATEGORI`);

--
-- Ketidakleluasaan untuk tabel `tampil_ukuran`
--
ALTER TABLE `tampil_ukuran`
  ADD CONSTRAINT `FK_TAMPIL_UKURAN` FOREIGN KEY (`ID_TAMPIL_PRODUK`) REFERENCES `tampil_produk` (`ID_TAMPIL_PRODUK`),
  ADD CONSTRAINT `FK_TAMPIL_UKURAN2` FOREIGN KEY (`ID_UKURAN`) REFERENCES `ukuran` (`ID_UKURAN`);

--
-- Ketidakleluasaan untuk tabel `tampil_warna`
--
ALTER TABLE `tampil_warna`
  ADD CONSTRAINT `FK_TAMPIL_WARNA` FOREIGN KEY (`ID_TAMPIL_PRODUK`) REFERENCES `tampil_produk` (`ID_TAMPIL_PRODUK`),
  ADD CONSTRAINT `FK_TAMPIL_WARNA2` FOREIGN KEY (`ID_WARNA`) REFERENCES `warna` (`ID_WARNA`);

--
-- Ketidakleluasaan untuk tabel `ukuran`
--
ALTER TABLE `ukuran`
  ADD CONSTRAINT `FK_MEMILIKIKATEGORIUKURAN` FOREIGN KEY (`ID_KAT_UKURAN`) REFERENCES `kategori_ukuran` (`ID_KAT_UKURAN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
