-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2020 pada 05.03
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
('ADM000001', 'ABADI CAHAYA PERKASA', 'admin@abadicahaya.com', '0821412990', '(0331)412990', 'Jl. Kauman 312 RT 04, Mangli, \r\nKecamatan Kaliwates, Jember, Jawa Timur\r\n68131 ', '685e299eee690c49.78293303.png', '745e29a0178ebd27.97050740.jpg', 'Didirikan  pada tahun 2000 oleh pemilik yang bernama Abdul Madjid. Selain sebagai pendiri CV Abadi Cahaya Perkasa Abdul Madjid juga merupakan Pimpinan sekaligus pemilik CV ini. Perusahaan  percetakan milik Pak majid tergolong perusahaan percetakaan yang sederhana, tempat proses produksi cukup luas dan berdampingan dengan  tempat  tinggal. Saat ini terdapat 5 orang yang bekerja untuk menyelesaikan proses produksi.  Berbagai produk yang dijual antara lain: buku tulis, buku LKS, tabloid, packaging, brosur, kalender, map ijazah, raport, dan lain-lain.', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
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
  `HARGA_BAHAN` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`ID_BAHAN`, `ID_SATUAN`, `ID_KAT_BAHAN`, `NAMA_BAHAN`, `HARGA_BAHAN`) VALUES
('BHN000001', 'SBN000001', 'KBN000001', 'HVS 70 gr', 300000),
('BHN000002', 'SBN000001', 'KBN000002', 'AP 100 gr', 450000),
('BHN000003', 'SBN000001', 'KBN000002', 'AP 110 gr', 430000),
('BHN000004', 'SBN000001', 'KBN000001', 'HVS 80gr', 355000);

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
  `STATUS_DESAIN` int(1) NOT NULL,
  `ISI_PRODUK` int(6) NOT NULL DEFAULT '1',
  `KET_PEMBAYARAN` int(1) NOT NULL DEFAULT '1',
  `CATATAN` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`ID_PRODUK`, `ID_PESANAN`, `JUMLAH_PRODUK`, `SUB_TOTAL`, `UPLOAD_DESAIN`, `STATUS_DESAIN`, `ISI_PRODUK`, `KET_PEMBAYARAN`, `CATATAN`) VALUES
('PRD000003', 'PSN000002', 645, 703000, NULL, 0, 1, 1, ''),
('PRD000001', 'PSN000001', 125, 300000, NULL, 0, 1, 2, ''),
('PRD000002', 'PSN000001', 250, 156000, NULL, 1, 1, 2, ''),
('PRD000004', 'PSN000003', 450, 320000, NULL, 1, 1, 2, ''),
('PRD000005', 'PSN000003', 200, 240000, 'kalender.jpg', 0, 1, 2, ''),
('PRD000006', 'PSN000004', 631, 560000, NULL, 1, 1, 1, ''),
('PRD000007', 'PSN000005', 400, 350000, 'design.zip', 0, 1, 2, ''),
('PRD000009', 'PSN000007', 209, 94700, NULL, 1, 1, 2, ''),
('PRD000010', 'PSN000008', 312, 352800, NULL, 1, 1, 1, ''),
('PRD000011', 'PSN000009', 44, 71600, 'Penulisan Laporan.zip', 0, 1, 2, ''),
('PRD000012', 'PSN000010', 12, 43400, '', 1, 1, 1, ''),
('PRD000013', 'PSN000011', 77, 161300, '', 1, 1, 1, ''),
('PRD000014', 'PSN000012', 66, 28300, 'DesainLombaWEB.zip', 0, 1, 1, ''),
('PRD000015', 'PSN000013', 880, 822800, '', 1, 1, 2, ''),
('PRD000016', 'PSN000014', 44, 62350, '595dfd68e20332c9.40265457.zip', 0, 1, 1, ''),
('PRD000017', 'PSN000014', 77, 123200, '', 1, 1, 1, ''),
('PRD000019', 'PSN000016', 780, 740000, 'Poster', 1, 1, 2, ''),
('PRD000020', 'PSN000017', 600, 350000, '655e02b4c74a3d89.40078969.zip', 0, 1, 1, ''),
('PRD000021', 'PSN000018', 203, 279600, '', 1, 4, 1, ''),
('PRD000022', 'PSN000019', 25, 122000, '735e056f9e4bb233.61958790.zip', 0, 6, 1, ''),
('PRD000023', 'PSN000019', 230, 202000, '', 1, 1, 1, ''),
('PRD000026', 'PSN000022', 200, 85000, '', 1, 1, 2, ''),
('PRD000027', 'PSN000023', 18, 55200, '975e06127ae524c5.06978717.rar', 0, 4, 1, 'Red, Yellow'),
('PRD000028', 'PSN000023', 101, 106900, '', 1, 1, 1, ''),
('PRD000029', 'PSN000024', 200, 192750, '635e06196c92f6e9.46631532.pdf', 0, 1, 1, 'Black, Magenta'),
('PRD000030', 'PSN000025', 655, 306125, '975e09925fa55da2.93588732.rar', 0, 1, 2, ''),
('PRD000031', 'PSN000026', 200, 272000, '', 1, 1, 1, ''),
('PRD000032', 'PSN000027', 25, 287000, '', 1, 13, 1, ''),
('PRD000033', 'PSN000027', 201, 129900, '475e0cb4b2676411.89662236.rar', 0, 1, 1, 'Cyan'),
('PRD000034', 'PSN000028', 12, 110000, '', 1, 6, 1, 'Cyan, Cyan'),
('PRD000035', 'PSN000029', 120, 140000, '', 1, 1, 1, 'Cyan, Cyan'),
('PRD000036', 'PSN000030', 600, 382750, '945e0cc2b2768ac6.65344718.rar', 0, 1, 1, ''),
('PRD000037', 'PSN000030', 166, 261200, '', 1, 2, 1, 'Black, Green'),
('PRD000038', 'PSN000030', 56, 125600, '', 1, 1, 1, ''),
('PRD000039', 'PSN000031', 24, 301200, '', 1, 13, 1, ''),
('PRD000040', 'PSN000031', 200, 194000, '', 1, 1, 1, ''),
('PRD000041', 'PSN000032', 30, 120000, '', 1, 4, 1, 'Cyan, Cyan'),
('PRD000042', 'PSN000033', 25, 299000, '', 1, 13, 1, 'Magenta, Black'),
('PRD000043', 'PSN000034', 200, 130000, '635e0d495a4cf364.91848668.rar', 0, 1, 1, 'Cyan, Cyan'),
('PRD000044', 'PSN000035', 15, 101000, '', 1, 1, 1, ''),
('PRD000045', 'PSN000036', 25, 287000, '', 1, 13, 1, ''),
('PRD000046', 'PSN000036', 120, 90375, '', 1, 1, 2, ''),
('PRD000047', 'PSN000037', 26, 181950, '', 1, 7, 1, '');

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
('GBR000009', 'PRD000005', '45e29ae9490bcc6.16301979.jpg'),
('GBR000010', 'PRD000006', '515e07f6a4aabfc0.01200739.jpg'),
('GBR000011', 'PRD000006', '555e07f6b7516264.53529657.jpg');

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
('MSG000002', 'Raziki Gforce', 'hackjones001@gmail.com', '082430119989', 'Komplain Produk', 'Saya ingin komplain, produk saya tidak sesuai pesanan, ID Pesanan Saya PSN000006, apakah bisa saya ambil kembali uang yang telah saya bayar?', '2019-12-20 06:00:00', 1),
('MSG000003', 'Aldion Ajimasmoko', 'aldion819@gmail.com', '082430119989', 'Produk Tidak Kunjung Datang', 'Wooooyyyyy gimana ni produk yang saya pesan sejam lalu belum sampai dirumah', '2019-12-26 10:50:34', 1),
('MSG000004', 'Dini Vega Safitri', 'dinivegas@gmail.com', '082430119989', 'Komplain Produk', 'ASASSSSS SSSSSS SSSSSSS SSSSSSSSAA AAAAAA AAAAAAAAAAAA AAAAAAAAAA AAAAAA AAAAAAAAA', '2019-12-26 18:02:09', 0),
('MSG000005', 'Dini Vega Safitri', 'dinivegas@gmail.com', '082430119989', 'Komplain Produk', 'ASASSSS SSSSSSSSSSSS SSSSSSSSSSA AAAAAAAAAAAAA AAAAAAAA AAAAAAAAAA AAAAAAAAAAAAA', '2019-12-26 18:03:19', 0),
('MSG000006', 'HackJones', 'hackjones001@gmail.com', '082430119989', 'Produk Tidak Kunjung Datang', 'GGGGGGGGG GGGGGGGGG GGGGGGGGG GGGGGGGGGGG GGGGGGGGGGG GGGGGGGGGG GGGGGGGGGGGG GGGGGGGGGGGGG', '2019-12-26 18:05:57', 1),
('MSG000007', 'Dini Vega Safitri', 'dinivegas@gmail.com', '082430119989', 'Produk Tidak Kunjung Datang', 'AAAAAAAAAAAAAA AAAAA AAAAAA AAAAAAAAAA AAAAAA AAAAAAAAA AAAAAAAAAAAA AAAAAAA AAAAAAAAAAAA AAAAAAAAAAAAAAAA AAAAAAAAAAAAAA', '2019-12-29 10:08:46', 0),
('MSG000008', 'Dini Vega Safitri', 'dinivegas@gmail.com', '082430119989', 'Produk Tidak Kunjung Datang', 'AAAAAAAAAAAAA AAAAAAAAAAAAA AAAAAAAAAAAAAAAA AAAAAAAAAAAAA AAAAAAAAAAAAAAAAAA AAAAAAAAA AAAAAAAAAAAAAAAAAAA', '2019-12-29 10:10:26', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nego`
--

CREATE TABLE `nego` (
  `ID_NEGO` varchar(9) NOT NULL,
  `ID_USER` varchar(9) NOT NULL,
  `ID_PRODUK` varchar(9) NOT NULL,
  `ID_UKURAN` varchar(9) NOT NULL,
  `ID_WARNA` varchar(9) NOT NULL,
  `ID_BAHAN` varchar(9) NOT NULL,
  `NEGO_TGL` datetime NOT NULL,
  `NAMA_PRODUK` varchar(30) NOT NULL,
  `JUMLAH_PRODUK` int(11) NOT NULL,
  `SUB_TOTAL` int(11) NOT NULL,
  `UPLOAD_DESAIN` varchar(32) NOT NULL,
  `STATUS_DESAIN` int(1) NOT NULL,
  `KET_PEMBAYARAN` int(1) NOT NULL,
  `ISI_PRODUK` int(6) NOT NULL,
  `CATATAN` tinytext NOT NULL,
  `NEGO_HARGA` int(11) NOT NULL,
  `NEGO_STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nego`
--

INSERT INTO `nego` (`ID_NEGO`, `ID_USER`, `ID_PRODUK`, `ID_UKURAN`, `ID_WARNA`, `ID_BAHAN`, `NEGO_TGL`, `NAMA_PRODUK`, `JUMLAH_PRODUK`, `SUB_TOTAL`, `UPLOAD_DESAIN`, `STATUS_DESAIN`, `KET_PEMBAYARAN`, `ISI_PRODUK`, `CATATAN`, `NEGO_HARGA`, `NEGO_STATUS`) VALUES
('NEG000001', 'USR000001', 'PRD000005', 'UKN000005', 'WRN000001', 'BHN000002', '2019-12-23 23:50:48', 'Poster', 780, 784000, 'Poster', 1, 2, 1, '', 730000, 2),
('NEG000002', 'USR000006', 'PRD000002', 'UKN000006', 'WRN000001', 'BHN000001', '2019-12-25 08:01:20', 'Banner', 600, 402000, '655e02b4c74a3d89.40078969.zip', 0, 1, 1, '', 350000, 1),
('NEG000003', 'USR000006', 'PRD000003', 'UKN000003', 'WRN000004', 'BHN000001', '2019-12-27 10:19:48', 'Kartu Nama', 200, 93500, '', 1, 2, 1, '', 85000, 3),
('NEG000004', 'USR000001', 'PRD000004', 'UKN000005', 'WRN000001', 'BHN000001', '2019-12-30 13:04:33', 'Kalender', 12, 110800, '', 1, 1, 4, 'Cyan, Cyan', 100000, 1),
('NEG000005', 'USR000007', 'PRD000004', 'UKN000005', 'WRN000001', 'BHN000001', '2020-01-01 22:28:33', 'Kalender', 12, 125200, '', 1, 1, 6, 'Cyan, Cyan', 110000, 3),
('NEG000006', 'USR000006', 'PRD000005', 'UKN000005', 'WRN000001', 'BHN000001', '2020-01-01 22:38:47', 'Poster', 120, 154000, '', 1, 1, 1, 'Cyan, Cyan', 140000, 3),
('NEG000007', 'USR000006', 'PRD000004', 'UKN000003', 'WRN000001', 'BHN000001', '2020-01-02 08:31:38', 'Kalender', 30, 144000, '', 1, 1, 4, 'Cyan, Cyan', 120000, 3),
('NEG000008', 'USR000006', 'PRD000003', 'UKN000003', 'WRN000001', 'BHN000001', '2020-01-02 08:37:53', 'Kartu_Nama', 200, 142000, '635e0d495a4cf364.91848668.rar', 0, 1, 1, 'Cyan, Cyan', 130000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `ID_PESANAN` varchar(9) NOT NULL,
  `ADM_ID` varchar(9) NOT NULL,
  `USER_ID` varchar(9) NOT NULL,
  `ID_REKENING` varchar(9) NOT NULL,
  `TANGGAL_PESANAN` datetime NOT NULL,
  `TOTAL_HARGA` int(11) DEFAULT NULL,
  `STATUS_PESANAN` int(1) NOT NULL,
  `BUKTI_TRANSFER` varchar(32) DEFAULT NULL,
  `ANTRIAN` int(6) NOT NULL,
  `ADMIN_NOTIF` int(1) NOT NULL DEFAULT '0',
  `USER_NOTIF` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`ID_PESANAN`, `ADM_ID`, `USER_ID`, `ID_REKENING`, `TANGGAL_PESANAN`, `TOTAL_HARGA`, `STATUS_PESANAN`, `BUKTI_TRANSFER`, `ANTRIAN`, `ADMIN_NOTIF`, `USER_NOTIF`) VALUES
('PSN000001', 'ADM000001', 'USR000001', 'NRK000001', '2020-01-06 09:00:00', 456000, 5, NULL, 24, 0, 1),
('PSN000002', 'ADM000002', 'USR000002', 'NRK000002', '2020-01-06 07:00:00', 703000, 4, NULL, 12, 0, 0),
('PSN000003', 'ADM000002', 'USR000002', 'NRK000001', '2020-01-03 16:00:00', 354000, 4, NULL, 0, 0, 0),
('PSN000004', 'ADM000002', 'USR000004', 'NRK000001', '2020-01-05 00:00:00', 560000, 5, 'bukti_tf.jpg', 48, 0, 0),
('PSN000005', 'ADM000001', 'USR000003', 'NRK000001', '2019-12-16 00:00:00', 350000, 3, 'bukti.jpg', 12, 0, 0),
('PSN000007', 'ADM000001', 'USR000001', 'NRK000001', '2020-01-03 16:40:14', 94700, 4, NULL, 12, 0, 1),
('PSN000008', 'ADM000001', 'USR000001', 'NRK000001', '2020-01-03 21:57:28', 352800, 5, 'bukti_tf.jpg', 24, 0, 0),
('PSN000009', 'ADM000001', 'USR000001', 'NRK000001', '2019-12-18 05:57:06', 71600, 2, NULL, 12, 0, 1),
('PSN000010', 'ADM000001', 'USR000001', 'NRK000001', '2020-01-07 06:10:51', 43400, 4, NULL, 48, 0, 1),
('PSN000011', 'ADM000001', 'USR000002', 'NRK000001', '2020-01-08 05:18:34', 161300, 5, NULL, 24, 0, 1),
('PSN000012', 'ADM000001', 'USR000002', 'NRK000001', '2019-12-19 10:19:01', 28300, 6, NULL, 0, 0, 0),
('PSN000013', 'ADM000001', 'USR000002', 'NRK000001', '2019-12-18 10:22:43', 822800, 3, NULL, 24, 0, 1),
('PSN000014', 'ADM000001', 'USR000002', 'NRK000001', '2020-01-06 07:17:53', 185550, 4, '755dfd64bbd60af3.64367438.png', 12, 0, 0),
('PSN000016', 'ADM000001', 'USR000001', 'NRK000001', '2019-12-25 07:29:02', 740000, 1, '485e152ffb14f370.62510797.jpg', 0, 1, 1),
('PSN000017', 'ADM000001', 'USR000006', 'NRK000001', '2019-12-25 08:12:03', 350000, 2, '195e0d5606564929.97734256.png', 48, 1, 1),
('PSN000018', 'ADM000001', 'USR000001', 'NRK000001', '2020-01-02 23:24:22', 279600, 8, NULL, 0, 1, 1),
('PSN000019', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-03 09:59:00', 324000, 2, '795e05764384d5d2.88039215.jpg', 12, 0, 1),
('PSN000022', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-05 20:14:39', 85000, 2, '495e060481874a79.53796144.jpg', 48, 1, 0),
('PSN000023', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-04 00:00:00', 162100, 5, '705e0614b0c91c93.37912793.png', 48, 1, 1),
('PSN000024', 'ADM000001', 'USR000002', 'NRK000001', '2020-01-04 21:47:37', 192750, 5, '585e0619aea68521.54511968.png', 6, 1, 1),
('PSN000025', 'ADM000001', 'USR000001', 'NRK000002', '2020-01-07 13:02:40', 306125, 1, NULL, 0, 1, 1),
('PSN000026', 'ADM000001', 'USR000001', 'NRK000002', '2020-01-05 14:03:45', 272000, 1, NULL, 0, 1, 1),
('PSN000027', 'ADM000001', 'USR000007', 'NRK000002', '2020-01-02 22:04:21', 416900, 4, '545e0cb5be6e2dd0.67857276.jpg', 24, 1, 1),
('PSN000028', 'ADM000001', 'USR000007', 'NRK000001', '2020-01-02 22:33:43', 110000, 1, NULL, 0, 1, 1),
('PSN000029', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-02 22:45:08', 140000, 5, '15e0cbf19a58e74.67834593.jpg', 6, 1, 1),
('PSN000030', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-02 23:06:57', 769550, 4, '275e0cc499a165d6.25368514.jpg', 72, 1, 1),
('PSN000031', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-02 08:22:29', 495200, 5, '855e0d463c57d872.34834021.png', 24, 1, 1),
('PSN000032', 'ADM000001', 'USR000006', 'NRK000002', '2020-01-02 08:32:42', 120000, 1, NULL, 0, 1, 0),
('PSN000033', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-02 08:35:41', 299000, 1, NULL, 0, 0, 0),
('PSN000034', 'ADM000001', 'USR000006', 'NRK000002', '2020-01-02 08:38:30', 130000, 5, '75e0d49b5624a87.58060097.png', 12, 1, 1),
('PSN000035', 'ADM000001', 'USR000006', 'NRK000002', '2020-01-02 09:48:19', 101000, 7, NULL, 0, 1, 1),
('PSN000036', 'ADM000001', 'USR000006', 'NRK000002', '2020-01-08 06:19:09', 377375, 4, '595e1513657ee7d8.41487729.jpg', 72, 1, 1),
('PSN000037', 'ADM000001', 'USR000006', 'NRK000001', '2020-01-08 09:32:10', 181950, 5, '455e153fbdeaa276.05517176.jpg', 72, 1, 0);

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
('PRD000017', 'UKN000005', 'BHN000001', 'WRN000004', 'Kartu Nama'),
('PRD000019', 'UKN000005', 'BHN000002', 'WRN000001', 'Poster'),
('PRD000020', 'UKN000006', 'BHN000001', 'WRN000001', 'Banner'),
('PRD000021', 'UKN000005', 'BHN000001', 'WRN000002', 'Kalender'),
('PRD000022', 'UKN000005', 'BHN000001', 'WRN000001', 'Kalender'),
('PRD000023', 'UKN000002', 'BHN000001', 'WRN000002', 'Brosur'),
('PRD000026', 'UKN000003', 'BHN000001', 'WRN000004', 'Kartu Nama'),
('PRD000027', 'UKN000003', 'BHN000001', 'WRN000002', 'Kalender'),
('PRD000028', 'UKN000004', 'BHN000002', 'WRN000003', 'Poster'),
('PRD000029', 'UKN000001', 'BHN000002', 'WRN000002', 'Brosur'),
('PRD000030', 'UKN000001', 'BHN000002', 'WRN000001', 'Brosur'),
('PRD000031', 'UKN000006', 'BHN000002', 'WRN000001', 'Banner'),
('PRD000032', 'UKN000006', 'BHN000001', 'WRN000001', 'Kalender_Meja'),
('PRD000033', 'UKN000002', 'BHN000001', 'WRN000005', 'Kartu_Nama'),
('PRD000034', 'UKN000005', 'BHN000001', 'WRN000001', 'Kalender'),
('PRD000035', 'UKN000005', 'BHN000001', 'WRN000001', 'Poster'),
('PRD000036', 'UKN000001', 'BHN000001', 'WRN000001', 'Brosur'),
('PRD000037', 'UKN000003', 'BHN000001', 'WRN000002', 'Kalender'),
('PRD000038', 'UKN000006', 'BHN000001', 'WRN000001', 'Banner'),
('PRD000039', 'UKN000009', 'BHN000001', 'WRN000001', 'Kalender_Meja'),
('PRD000040', 'UKN000002', 'BHN000001', 'WRN000001', 'Kartu_Nama'),
('PRD000041', 'UKN000003', 'BHN000001', 'WRN000001', 'Kalender'),
('PRD000042', 'UKN000009', 'BHN000001', 'WRN000002', 'Kalender_Meja'),
('PRD000043', 'UKN000003', 'BHN000001', 'WRN000001', 'Kartu_Nama'),
('PRD000044', 'UKN000006', 'BHN000001', 'WRN000001', 'Banner'),
('PRD000045', 'UKN000006', 'BHN000001', 'WRN000001', 'Kalender_Meja'),
('PRD000046', 'UKN000001', 'BHN000002', 'WRN000001', 'Brosur'),
('PRD000047', 'UKN000001', 'BHN000001', 'WRN000001', 'Kalender_Meja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_bank`
--

CREATE TABLE `rekening_bank` (
  `ID_REKENING` varchar(9) NOT NULL,
  `NAMA_REKENING` varchar(50) NOT NULL,
  `NOMOR_REKENING` varchar(50) NOT NULL,
  `ATAS_NAMA` varchar(50) NOT NULL,
  `STATUS_REKENING` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening_bank`
--

INSERT INTO `rekening_bank` (`ID_REKENING`, `NAMA_REKENING`, `NOMOR_REKENING`, `ATAS_NAMA`, `STATUS_REKENING`) VALUES
('NRK000001', 'BRI', '93872981', 'Abdul Madjid', 1),
('NRK000002', 'MANDIRI', '008735621', 'Abdul Madjid', 1);

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
('PRD000005', 'BHN000003'),
('PRD000006', 'BHN000001'),
('PRD000006', 'BHN000002'),
('PRD000006', 'BHN000004');

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
  `STATUS_ISI` int(1) NOT NULL,
  `BATAS_ISI` tinytext NOT NULL,
  `MIN_JUMLAH` int(6) NOT NULL,
  `STATUS_TAMPIL_PRODUK` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tampil_produk`
--

INSERT INTO `tampil_produk` (`ID_TAMPIL_PRODUK`, `ID_KATEGORI`, `NAMA_TAMPIL_PRODUK`, `DESC_TAMPIL_PRODUK`, `KET_TAMPIL_PRODUK`, `STATUS_ISI`, `BATAS_ISI`, `MIN_JUMLAH`, `STATUS_TAMPIL_PRODUK`) VALUES
('PRD000001', 'KPD000002', 'Brosur', 'Cetak brosur merupakan salah satu langkah yang bisa Anda lakukan untuk mempromosikan sebuah bisnis. Sebab, di dalam brosur terdapat berbagai macam informasi mengenai produk Anda. Oleh karena itu, untuk merancang sebuah brosur, tidak bisa sembarangan. Dibutuhkan beberapa tips agar fungsi dari keberadaan brosur dapat maksimal. Berikut ini beberapa hal yang perlu Anda ketahui terkait cetak brosur, mulai dari fungsi brosur, tips membuat brosur, hingga langkah-langkah penting sebelum mencetak brosur.', 'ket_harga.htm', 0, '', 200, 1),
('PRD000002', 'KPD000001', 'Banner', 'Banner digunakan untuk Banner', 'ket_harga.htm', 0, '', 1, 1),
('PRD000003', 'KPD000002', 'Kartu_Nama', 'Kartu Nama adalah sebuah kartu yang menyampaikan informasi tentang sebuah perusahaan ataupun individu yang disampaikan hanya sebagai pengingat dalam sebuah perkenalan formal. Pada umumnya kartu nama berisi tentang nama perusahaan (termasuk logo perusahaan) dan alamat pos, nomor telepon, nomor fax dan email, situs web.', 'coba.htm', 0, '', 200, 1),
('PRD000004', 'KPD000001', 'Kalender', 'Kalender, tarikh, atau penanggalan adalah sebuah sistem untuk memberi nama pada sebuah periode waktu (seperti hari sebagai contohnya). Nama-nama ini dikenal sebagai tanggal kalender. Tanggal ini bisa didasarkan dari gerakan-gerakan benda angkasa seperti matahari dan bulan. Kalender juga dapat mengacu kepada alat yang mengilustrasikan sistem tersebut (sebagai contoh, sebuah kalender dinding).', 'coba.htm', 1, '1/2/3/4/6/12/24', 12, 1),
('PRD000005', 'KPD000002', 'Poster', 'Poster atau plakat adalah karya seni atau desain grafis yang memuat komposisi gambar dan huruf di atas kertas berukuran besar atau kecil. Pengaplikasiannya dengan ditempel di dinding atau permukaan datar lainnya dengan sifat mencari perhatian mata sekuat mungkin.', 'ket_harga.htm', 0, '', 100, 1),
('PRD000006', 'KPD000001', 'Kalender_Meja', 'Kalender Meja atau Desk Calendar merupakan salah satu jenis dari Kalender dimana fungsi kalender ini sebagai kalender yang ditaruh diatas meja kerja (umumnya).', '465e07f0e059d9c3.20847267.htm', 1, '7/13/25', 24, 1);

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
('PRD000005', 'UKN000007'),
('PRD000006', 'UKN000001'),
('PRD000006', 'UKN000004'),
('PRD000006', 'UKN000006'),
('PRD000006', 'UKN000009');

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
('PRD000005', 'WRN000003'),
('PRD000006', 'WRN000001'),
('PRD000006', 'WRN000002'),
('PRD000006', 'WRN000003'),
('PRD000006', 'WRN000004');

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
('USR000001', 'Primasdika Yunia Putra', 'dickayunia1@gmail.com', '083847008485', 'Gg. Klinik Pratama No 99\r\nMaesan, Bondowoso, Jawa Timur', '715e2a606babef20.64402485.jpg', '525e2a608a24c640.91776067.jpg', '@prmsdk', '6ddda6967cc69316b54fe206f1863d35', 'c0f168ce8900fa56e57789e2a2f2c9d0', 0),
('USR000002', 'Siti Nurlaeli Agustin', 'lelyagstn@gmail.com', '085885566770', 'Jl. Brigpol Soedarlan RT05 RW02 No.2, Petung, Curahdami, Bondowoso', 'no_profil.jpg', 'betak.jpg', '@lely_agstn', 'bce95752c0ebda21194e3a80b732ac92', 'abd815286ba1007abfbb8415b83ae2cf', 1),
('USR000003', 'Aldion', 'aldion819@gmail.com', '083853000123', NULL, NULL, NULL, '@aldion.anjay_', 'a0792fe69cc316d4188ac2c71d1635e0', 'ec8ce6abb3e952a85b8551ba726a1227', 1),
('USR000004', 'Dyta', 'dytashofia32@gmail.com', '083853000123', NULL, NULL, NULL, '@dyta', '65f14443215834271c1ad576630df067', 'cc1aa436277138f61cda703991069eaf', 0),
('USR000005', 'Raziki', 'jekiyudi15@gmail.com', '082233120146', 'Pakuwesi, Curahdami ', 'no_profil.jpg', 'betak.jpg', '@raziki', '67fab04a48e028732fab845d0ac58954', '202cb962ac59075b964b07152d234b70', 1),
('USR000006', 'Nur Hadi', 'hackjones001@gmail.com', '082233120146', 'Jl. Soedibyo Semboro No. 99', 'no_profil.jpg', 'betak.jpg', '@user', 'd5770f2a8c97c7fe7e97ef0bc74d16e5', 'd1f255a373a3cef72e03aa9d980c7eca', 1),
('USR000007', 'Nurhadi Aldo', 'nnuurrhhaaddii99@gmail.com', '085234777123', 'Jl. Karimata Gg. 6 No.2 Sebelah Masjid, Jember', 'no_profil.jpg', 'betak.jpg', '@nurhadi.cap', '09b16c6c49843772eaa9eb1987a25633', '140f6969d5213fd0ece03148e62e461e', 1),
('USR000008', 'Aldion Ajimasmoko', 'aldion@gmail.com', '083847008485', NULL, 'no_profil.jpg', 'betak.jpg', '', '67bfdb3b08f4dfd91548a039c78d7f79', 'ed265bc903a5a097f61d3ec064d96d2e', 0);

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
  ADD KEY `FK_MEMESAN` (`USER_ID`),
  ADD KEY `FK_REKENING` (`ID_REKENING`);

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
  ADD PRIMARY KEY (`ID_REKENING`);

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
  ADD CONSTRAINT `FK_MEMESAN` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `FK_REKENING` FOREIGN KEY (`ID_REKENING`) REFERENCES `rekening_bank` (`ID_REKENING`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `FK_MEMILIKIBAHAN` FOREIGN KEY (`ID_BAHAN`) REFERENCES `bahan` (`ID_BAHAN`),
  ADD CONSTRAINT `FK_MEMILIKIUKURAN` FOREIGN KEY (`ID_UKURAN`) REFERENCES `ukuran` (`ID_UKURAN`),
  ADD CONSTRAINT `FK_MEMILIKIWARNA` FOREIGN KEY (`ID_WARNA`) REFERENCES `warna` (`ID_WARNA`);

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
