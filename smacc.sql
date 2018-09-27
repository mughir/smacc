-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2018 at 04:13 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smacc`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambilmat`
--

CREATE TABLE `ambilmat` (
  `noreq` int(11) NOT NULL,
  `idjadwal` int(11) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ambilmat`
--

INSERT INTO `ambilmat` (`noreq`, `idjadwal`, `waktu`) VALUES
(1, 1, '2017-10-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idbarang` varchar(20) NOT NULL,
  `katbarang` varchar(30) NOT NULL,
  `segment1` varchar(100) NOT NULL,
  `segment2` varchar(100) NOT NULL,
  `segment3` varchar(100) NOT NULL,
  `nbarang` varchar(45) NOT NULL,
  `satbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `cbarang` decimal(20,2) NOT NULL,
  `hjualbarang` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `katbarang`, `segment1`, `segment2`, `segment3`, `nbarang`, `satbarang`, `jumlah`, `cbarang`, `hjualbarang`) VALUES
('B000001', 'Barang Dagang', '', '', '', 'Tes', 'kg', '5.00', '310000.00', '500000.00'),
('B000002', 'Barang Dagang', '', '', '', 'Barang dagang 2', 'kg', '0.00', '0.00', '75000.00'),
('B000003', 'Barang Dagang', '', '', '', 'Meja', 'unit', '0.00', '500000.00', '1500000.00'),
('B000004', 'Barang Dagang', '', '', '', 'Komputer', 'unit', '50.00', '4000000.00', '4000000.00'),
('B000005', 'Material', '', '', '', 'Material 1', 'unit', '0.00', '500000.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `barangditerima`
--

CREATE TABLE `barangditerima` (
  `idbarang` varchar(20) NOT NULL,
  `idterimabarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangditerima`
--

INSERT INTO `barangditerima` (`idbarang`, `idterimabarang`, `jumlah`) VALUES
('B000001', 'T0000001', '1.00'),
('B000004', 'T0000000001', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `barangkasir`
--

CREATE TABLE `barangkasir` (
  `idbarang` varchar(20) NOT NULL,
  `hbarangkasir` decimal(20,2) NOT NULL,
  `sbarangkasir` int(11) NOT NULL,
  `disbarangkasir` decimal(20,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangkasir`
--

INSERT INTO `barangkasir` (`idbarang`, `hbarangkasir`, `sbarangkasir`, `disbarangkasir`) VALUES
('B000001', '120000.00', 1, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `barangpengajuan`
--

CREATE TABLE `barangpengajuan` (
  `idbarang` varchar(20) NOT NULL,
  `idpengajuan` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangpengajuan`
--

INSERT INTO `barangpengajuan` (`idbarang`, `idpengajuan`, `jumlah`) VALUES
('B000001', '1617357401894316', '1.00'),
('B000003', 'PS000000001', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `barangrnd`
--

CREATE TABLE `barangrnd` (
  `idbarang` varchar(20) NOT NULL,
  `srnd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangrnd`
--

INSERT INTO `barangrnd` (`idbarang`, `srnd`) VALUES
('B000001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `barispesanan`
--

CREATE TABLE `barispesanan` (
  `idbarang` varchar(20) NOT NULL,
  `idpesanan` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `subtotal` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barispesanan`
--

INSERT INTO `barispesanan` (`idbarang`, `idpesanan`, `jumlah`, `subtotal`) VALUES
('B000001', 'P00001', '2.00', '100000.00'),
('B000002', 'S000000001', '5.00', '375000.00'),
('B000002', 'S000000002', '1.00', '75000.00'),
('B000003', 'P00002', '1.00', '1500000.00'),
('B000003', 'S000000002', '1.00', '1500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `catatankontak`
--

CREATE TABLE `catatankontak` (
  `idcatatankontak` int(11) NOT NULL,
  `idkontak` varchar(20) NOT NULL,
  `wcatatankontak` datetime NOT NULL,
  `icatatankontak` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `noakun` varchar(30) NOT NULL,
  `nakun` varchar(45) NOT NULL,
  `lakun` int(11) NOT NULL,
  `posakun` varchar(6) NOT NULL DEFAULT 'debit',
  `katakun` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`noakun`, `nakun`, `lakun`, `posakun`, `katakun`) VALUES
('10000', 'AKTIVA', 1, 'D', NULL),
('10100', 'Kas', 2, 'D', '10000'),
('10200', 'Bank', 2, 'D', '10000'),
('10300', 'Deposito', 2, 'D', '10000'),
('10400', 'Piutang Usaha', 2, 'D', '10000'),
('10500', 'Persediaan Barang Dagangan', 2, 'D', '10000'),
('10600', 'Uang Muka', 2, 'D', '10000'),
('10700', 'Pendapatan yang masih harus diterima', 2, 'D', '10000'),
('10800', 'Pajak dibayar dimuka', 2, 'D', '10000'),
('10900', 'Biaya dibayar dimuka', 2, 'D', '10000'),
('11000', 'Investasi Jangka Panjang', 2, 'D', '10000'),
('11100', 'Aktiva tetap', 2, 'D', '10000'),
('11200', 'Akumulasi Penyusutan Aktiva Tetap', 2, 'D', '10000'),
('11300', 'Aktiva tidak berwujud', 2, 'D', '10000'),
('11400', 'Aktiva lain-lain', 2, 'D', '10000'),
('20000', 'Kewajiban', 1, 'K', NULL),
('20100', 'Hutang Usaha', 2, 'K', '20000'),
('21100', 'Hutang Bank', 2, 'K', '20000'),
('22100', 'Kewajiban Gaji', 2, 'K', '20000'),
('23100', 'Pendapatan Belum Terealisasi', 2, 'K', '20000'),
('30000', 'Ekuitas', 1, 'K', NULL),
('31000', 'Modal Disetor', 2, 'K', '30000'),
('32000', 'Laba Rugi Ditahan', 2, 'K', '30000'),
('40000', 'Pendapatan', 1, 'K', NULL),
('41000', 'Penjualan', 2, 'K', '40000'),
('42000', 'Pendapatan Jasa', 2, 'K', '41000'),
('50000', 'Beban', 1, 'D', NULL),
('51000', 'Beban Pokok Penj', 2, 'D', '50000'),
('52000', 'Beban Gaji', 2, 'D', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `djurnal`
--

CREATE TABLE `djurnal` (
  `kdjurnal` int(11) NOT NULL,
  `kjurnal` int(11) NOT NULL,
  `noakun` varchar(20) NOT NULL,
  `debit` decimal(20,2) NOT NULL,
  `kredit` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `djurnal`
--

INSERT INTO `djurnal` (`kdjurnal`, `kjurnal`, `noakun`, `debit`, `kredit`) VALUES
(47, 50, '10100', '120000.00', '0.00'),
(48, 50, '41000', '0.00', '120000.00'),
(49, 51, '10100', '480000.00', '0.00'),
(50, 51, '41000', '0.00', '480000.00'),
(51, 52, '10400', '50000.00', '0.00'),
(52, 52, '41000', '0.00', '50000.00'),
(53, 53, '10100', '50000.00', '0.00'),
(54, 53, '10400', '0.00', '50000.00'),
(55, 54, '10500', '50000.00', '0.00'),
(56, 54, '20100', '0.00', '50000.00'),
(57, 55, '20100', '50000.00', '0.00'),
(58, 55, '10100', '0.00', '50000.00'),
(59, 56, '10500', '50000.00', '0.00'),
(60, 56, '20100', '0.00', '50000.00'),
(61, 57, '20100', '50000.00', '0.00'),
(62, 57, '10100', '0.00', '50000.00'),
(63, 58, '10100', '550000.00', '0.00'),
(64, 59, '10500', '100000.00', '0.00'),
(65, 60, '32000', '0.00', '650000.00'),
(66, 61, '10100', '120000.00', '0.00'),
(67, 61, '41000', '0.00', '120000.00'),
(68, 62, '10100', '480000.00', '0.00'),
(69, 62, '41000', '0.00', '480000.00'),
(70, 63, '10400', '50000.00', '0.00'),
(71, 63, '41000', '0.00', '50000.00'),
(72, 64, '10400', '1500000.00', '0.00'),
(73, 64, '41000', '0.00', '1500000.00'),
(74, 65, '10100', '50000.00', '0.00'),
(75, 65, '10400', '0.00', '50000.00'),
(76, 66, '10100', '1500000.00', '0.00'),
(77, 66, '10400', '0.00', '1500000.00'),
(78, 67, '10500', '50000.00', '0.00'),
(79, 67, '20100', '0.00', '50000.00'),
(80, 68, '20100', '50000.00', '0.00'),
(81, 68, '10100', '0.00', '50000.00'),
(82, 69, '10500', '50000.00', '0.00'),
(83, 69, '20100', '0.00', '50000.00'),
(84, 70, '20100', '50000.00', '0.00'),
(85, 70, '10100', '0.00', '50000.00'),
(88, 72, '52000', '3500000.00', '0.00'),
(89, 72, '10100', '0.00', '3500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `djurnalm`
--

CREATE TABLE `djurnalm` (
  `kdjurnalm` int(11) NOT NULL,
  `kjurnalm` int(11) NOT NULL,
  `noakun` varchar(30) NOT NULL,
  `debit` decimal(20,2) NOT NULL,
  `kredit` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eksperimen_peserta`
--

CREATE TABLE `eksperimen_peserta` (
  `peserta_id` bigint(20) NOT NULL,
  `peserta_nav` int(11) NOT NULL,
  `peserta_prev` int(11) NOT NULL,
  `peserta_selesai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eksperimen_peserta`
--

INSERT INTO `eksperimen_peserta` (`peserta_id`, `peserta_nav`, `peserta_prev`, `peserta_selesai`) VALUES
(1, 1, 0, 1),
(2, 0, 1, 1),
(3, 0, 0, 1),
(4, 1, 0, 1),
(5, 0, 1, 1),
(6, 0, 1, 1),
(7, 1, 0, 1),
(8, 0, 0, 1),
(9, 0, 0, 1),
(10, 1, 1, 1),
(11, 0, 1, 1),
(12, 0, 1, 1),
(13, 1, 1, 1),
(14, 1, 0, 1),
(15, 0, 0, 1),
(16, 1, 0, 1),
(17, 0, 0, 1),
(18, 0, 0, 1),
(19, 0, 0, 1),
(20, 0, 0, 1),
(21, 1, 1, 1),
(22, 0, 0, 1),
(23, 1, 1, 1),
(24, 0, 1, 1),
(25, 1, 0, 1),
(26, 0, 1, 1),
(27, 0, 1, 1),
(28, 1, 1, 1),
(29, 1, 0, 1),
(30, 1, 1, 1),
(31, 0, 0, 1),
(32, 1, 0, 1),
(33, 0, 1, 1),
(34, 1, 1, 1),
(35, 1, 1, 1),
(36, 1, 0, 1),
(37, 0, 1, 1),
(38, 0, 0, 1),
(39, 1, 0, 1),
(40, 0, 0, 1),
(41, 0, 0, 1),
(42, 0, 1, 1),
(43, 1, 1, 1),
(44, 0, 0, 1),
(45, 1, 1, 1),
(46, 1, 1, 1),
(47, 0, 0, 1),
(48, 0, 1, 1),
(49, 0, 1, 1),
(50, 0, 0, 1),
(51, 1, 0, 1),
(52, 1, 0, 1),
(53, 0, 0, 1),
(54, 1, 1, 1),
(55, 1, 0, 1),
(56, 1, 1, 1),
(57, 1, 0, 1),
(58, 1, 0, 1),
(59, 0, 0, 1),
(60, 0, 1, 1),
(61, 0, 0, 1),
(62, 1, 1, 1),
(63, 0, 1, 1),
(64, 0, 1, 1),
(65, 0, 0, 1),
(66, 1, 1, 1),
(67, 1, 0, 1),
(68, 1, 0, 1),
(69, 0, 1, 1),
(70, 0, 0, 1),
(71, 1, 1, 1),
(72, 1, 1, 1),
(73, 1, 0, 1),
(74, 1, 0, 1),
(75, 1, 0, 1),
(76, 1, 0, 1),
(77, 1, 0, 1),
(78, 1, 1, 1),
(79, 0, 1, 1),
(80, 0, 0, 1),
(81, 1, 1, 1),
(82, 0, 1, 1),
(83, 0, 1, 1),
(84, 0, 1, 1),
(85, 0, 0, 1),
(86, 0, 1, 1),
(87, 1, 0, 1),
(88, 0, 0, 1),
(89, 0, 1, 1),
(90, 1, 1, 1),
(91, 0, 0, 1),
(92, 0, 1, 1),
(93, 1, 1, 1),
(94, 0, 1, 1),
(95, 1, 1, 1),
(96, 0, 0, 1),
(97, 0, 1, 1),
(98, 0, 1, 1),
(99, 1, 1, 1),
(100, 0, 1, 1),
(101, 1, 0, 1),
(102, 1, 1, 1),
(103, 1, 1, 1),
(104, 0, 0, 1),
(105, 0, 1, 1),
(106, 1, 0, 1),
(107, 0, 1, 1),
(108, 1, 1, 1),
(109, 1, 1, 1),
(110, 1, 0, 1),
(111, 0, 1, 1),
(112, 1, 1, 1),
(113, 0, 0, 1),
(114, 0, 0, 1),
(115, 0, 1, 1),
(116, 1, 0, 1),
(117, 1, 0, 1),
(118, 0, 0, 1),
(119, 1, 1, 1),
(120, 0, 1, 1),
(121, 0, 0, 1),
(122, 0, 0, 1),
(123, 1, 0, 1),
(124, 1, 1, 1),
(125, 1, 0, 1),
(126, 0, 0, 1),
(127, 1, 0, 1),
(128, 0, 1, 1),
(129, 1, 0, 1),
(130, 0, 1, 1),
(131, 1, 1, 1),
(132, 0, 0, 1),
(133, 0, 0, 1),
(134, 1, 0, 1),
(135, 0, 0, 1),
(136, 0, 0, 1),
(137, 1, 1, 1),
(138, 0, 1, 1),
(139, 1, 1, 1),
(140, 1, 0, 1),
(141, 0, 0, 1),
(142, 1, 0, 1),
(143, 1, 0, 1),
(144, 1, 0, 1),
(145, 1, 0, 1),
(146, 1, 1, 1),
(147, 0, 1, 1),
(148, 1, 1, 1),
(149, 0, 1, 1),
(150, 1, 1, 1),
(151, 0, 0, 1),
(152, 0, 1, 1),
(153, 0, 0, 1),
(154, 1, 0, 1),
(155, 0, 0, 1),
(156, 1, 1, 1),
(157, 0, 1, 1),
(158, 0, 0, 1),
(159, 0, 1, 1),
(160, 0, 0, 1),
(161, 1, 1, 1),
(162, 1, 1, 1),
(163, 1, 1, 1),
(164, 1, 0, 1),
(165, 1, 0, 1),
(166, 1, 0, 1),
(167, 1, 0, 1),
(168, 1, 0, 1),
(169, 0, 0, 1),
(170, 1, 0, 1),
(171, 1, 1, 1),
(172, 1, 0, 1),
(173, 1, 1, 1),
(174, 0, 0, 1),
(175, 0, 1, 1),
(176, 0, 1, 1),
(177, 0, 0, 1),
(178, 1, 1, 1),
(179, 0, 0, 1),
(180, 0, 0, 1),
(181, 1, 1, 1),
(182, 0, 1, 1),
(183, 1, 1, 1),
(184, 1, 1, 1),
(185, 0, 1, 1),
(186, 0, 0, 1),
(187, 0, 0, 1),
(188, 1, 0, 1),
(189, 1, 0, 1),
(190, 0, 0, 1),
(191, 0, 1, 1),
(192, 1, 1, 1),
(193, 0, 1, 1),
(194, 0, 0, 1),
(195, 0, 1, 1),
(196, 0, 0, 1),
(197, 1, 1, 1),
(198, 1, 1, 1),
(199, 0, 1, 1),
(200, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fungsi`
--

CREATE TABLE `fungsi` (
  `idfungsi` int(11) NOT NULL,
  `nfungsi` varchar(45) NOT NULL,
  `sfungsi` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fungsi`
--

INSERT INTO `fungsi` (`idfungsi`, `nfungsi`, `sfungsi`) VALUES
(10000, 'Admin', 1),
(20000, 'pos', 1),
(30000, 'penjualan', 1),
(40000, 'pembelian', 1),
(50000, 'produksi', 1),
(60000, 'hrd', 1),
(70000, 'akuntansi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fungsiakun`
--

CREATE TABLE `fungsiakun` (
  `noakun` varchar(30) NOT NULL,
  `idfungsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fungsirole`
--

CREATE TABLE `fungsirole` (
  `idrole` int(11) NOT NULL,
  `idfungsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fungsirole`
--

INSERT INTO `fungsirole` (`idrole`, `idfungsi`) VALUES
(1, 10000),
(1, 20000),
(1, 30000),
(1, 40000),
(1, 50000),
(1, 60000),
(1, 70000),
(7, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `idgaji` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `idpegawai` varchar(20) NOT NULL,
  `gaji` decimal(20,2) NOT NULL,
  `pajak` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`idgaji`, `tahun`, `bulan`, `tanggal`, `idpegawai`, `gaji`, `pajak`) VALUES
(4, 2017, 6, '2017-10-04', 'P000001', '3500000.00', '0.00'),
(10, 2018, 1, '2018-09-28', 'P000001', '8500000.00', '143750.00');

-- --------------------------------------------------------

--
-- Table structure for table `isiambilmat`
--

CREATE TABLE `isiambilmat` (
  `noreq` int(11) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `cost` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isiambilmat`
--

INSERT INTO `isiambilmat` (`noreq`, `idbarang`, `jumlah`, `cost`) VALUES
(1, 'B000005', '1.00', '500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `isikwitansi`
--

CREATE TABLE `isikwitansi` (
  `idkwitansi` varchar(20) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `subtotal` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isikwitansi`
--

INSERT INTO `isikwitansi` (`idkwitansi`, `idbarang`, `jumlah`, `subtotal`) VALUES
('K00001', 'B000001', '1.00', '50000.00'),
('K00002', 'B000003', '1.00', '1500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `isipengiriman`
--

CREATE TABLE `isipengiriman` (
  `idpengiriman` varchar(20) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `tcost` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isipengiriman`
--

INSERT INTO `isipengiriman` (`idpengiriman`, `idbarang`, `jumlah`, `tcost`) VALUES
('D000001', 'B000001', '3.00', '0.00'),
('D000002', 'B000003', '2.00', '0.00'),
('K0000000001', 'B000002', '2.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `isipesan_beli`
--

CREATE TABLE `isipesan_beli` (
  `idbarang` varchar(20) NOT NULL,
  `idpesan_beli` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `subtotal` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isipesan_beli`
--

INSERT INTO `isipesan_beli` (`idbarang`, `idpesan_beli`, `jumlah`, `subtotal`) VALUES
('B000002', '1617357401894316', '1.00', '75000.00'),
('B000004', 'P0000000001', '50.00', '200000000.00');

-- --------------------------------------------------------

--
-- Table structure for table `isitagihan`
--

CREATE TABLE `isitagihan` (
  `idtagihan` varchar(20) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `subtotal` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isitagihan`
--

INSERT INTO `isitagihan` (`idtagihan`, `idbarang`, `jumlah`, `subtotal`) VALUES
('PI000000001', 'B000004', '50.00', '200000000.00'),
('TG000001', 'B000001', '1.00', '50000.00');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `idjabatan` varchar(20) NOT NULL,
  `njabatan` varchar(100) NOT NULL,
  `gapok` decimal(20,2) NOT NULL,
  `tunjangan` decimal(20,2) NOT NULL,
  `periode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`idjabatan`, `njabatan`, `gapok`, `tunjangan`, `periode`) VALUES
('KRY01', 'Karyawan', '8000000.00', '500000.00', 'bulan');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `kjurnal` int(11) NOT NULL,
  `uraian` text NOT NULL,
  `njurnal` varchar(100) NOT NULL,
  `tjurnal` date NOT NULL,
  `sref` varchar(20) NOT NULL,
  `kref` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`kjurnal`, `uraian`, `njurnal`, `tjurnal`, `sref`, `kref`) VALUES
(50, '', 'Jurnal Pendapatan POS', '2017-08-27', 'pos', '2'),
(51, '', 'Jurnal Pendapatan POS', '2017-09-19', 'pos', '4'),
(52, '', 'Jurnal Pendapatan Penjualan', '2017-08-28', 'penagihan', 'K00001'),
(53, '', 'Jurnal Penerimaan Pembayaran', '2017-08-28', 'pembayaran', 'B00001'),
(54, '', 'Jurnal Pembelian Barang Dagang', '2017-08-29', 'tagihan', 'TG000001'),
(55, '', 'Jurnal pembayaran hutang dagang', '2017-08-25', 'pembtagihan', 'B000001'),
(56, '', 'Jurnal Pembelian Barang Dagang', '2017-08-29', 'tagihan', 'TG000001'),
(57, '', 'Jurnal pembayaran hutang dagang', '2017-08-25', 'pembtagihan', 'B000001'),
(58, '', 'balance awal', '2018-01-01', 'periode', '2017-12-31'),
(59, '', 'balance awal', '2018-01-01', 'periode', '2017-12-31'),
(60, '', 'balance awal', '2018-01-01', 'periode', '2017-12-31'),
(61, '', 'Jurnal Pendapatan POS', '2017-08-27', 'pos', '2'),
(62, '', 'Jurnal Pendapatan POS', '2017-09-19', 'pos', '4'),
(63, '', 'Jurnal Pendapatan Penjualan', '2017-08-28', 'penagihan', 'K00001'),
(64, '', 'Jurnal Pendapatan Penjualan', '2017-09-20', 'penagihan', 'K00002'),
(65, '', 'Jurnal Penerimaan Pembayaran', '2017-08-28', 'pembayaran', 'B00001'),
(66, '', 'Jurnal Penerimaan Pembayaran', '2017-09-20', 'pembayaran', 'B00002'),
(67, '', 'Jurnal Pembelian Barang Dagang', '2017-08-29', 'tagihan', 'TG000001'),
(68, '', 'Jurnal pembayaran hutang dagang', '2017-08-25', 'pembtagihan', 'B000001'),
(69, '', 'Jurnal Pembelian Barang Dagang', '2017-08-29', 'tagihan', 'TG000001'),
(70, '', 'Jurnal pembayaran hutang dagang', '2017-08-25', 'pembtagihan', 'B000001'),
(72, '', 'Jurnal Pembayaran Gaji', '2017-10-04', 'gaji', '4');

-- --------------------------------------------------------

--
-- Table structure for table `jurnalm`
--

CREATE TABLE `jurnalm` (
  `kjurnalm` int(11) NOT NULL,
  `tjurnalm` date NOT NULL,
  `uraian` text NOT NULL,
  `njurnalm` varchar(100) NOT NULL,
  `sref` varchar(20) NOT NULL,
  `kref` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `idkasir` int(11) NOT NULL,
  `nmesin` varchar(20) NOT NULL,
  `skasir` int(11) NOT NULL,
  `ipkasir` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`idkasir`, `nmesin`, `skasir`, `ipkasir`) VALUES
(3, 'Epson', 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `keranjangpos`
--

CREATE TABLE `keranjangpos` (
  `idkeranjangpos` int(11) NOT NULL,
  `idtranspos` int(11) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `subtotal` decimal(20,2) NOT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(20,2) NOT NULL,
  `cogs` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjangpos`
--

INSERT INTO `keranjangpos` (`idkeranjangpos`, `idtranspos`, `idbarang`, `jumlah`, `subtotal`, `discount`, `tax`, `cogs`) VALUES
(1, 2, 'B000001', '1.00', '0.00', '0.00', '0.00', '0.00'),
(2, 3, 'B000001', '1.00', '120000.00', '0.00', '0.00', '0.00'),
(3, 4, 'B000001', '1.00', '120000.00', '0.00', '0.00', '0.00'),
(4, 5, 'B000001', '3.00', '360000.00', '0.00', '0.00', '0.00'),
(5, 6, 'B000001', '1.00', '120000.00', '0.00', '0.00', '0.00'),
(6, 7, 'B000001', '1.00', '120000.00', '0.00', '0.00', '310000.00');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `idkontak` varchar(20) NOT NULL,
  `jkontak` int(11) NOT NULL,
  `nkontak` varchar(45) NOT NULL,
  `npwd` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `kodepos` varchar(20) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `alkontak` varchar(200) DEFAULT NULL,
  `telkontak` varchar(30) DEFAULT NULL,
  `stkontak` varchar(20) NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`idkontak`, `jkontak`, `nkontak`, `npwd`, `email`, `kodepos`, `provinsi`, `kota`, `kecamatan`, `alkontak`, `telkontak`, `stkontak`) VALUES
('V000001', 1, 'Test', '', '', '', '', '', '', 'Bandung', '081321668555', 'aktif'),
('V000002', 2, 'Test pembeli', '', '', '', '', '', '', 'Bandung', '081321668555', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE `kwitansi` (
  `idkwitansi` varchar(20) NOT NULL,
  `idpengiriman` varchar(20) DEFAULT NULL,
  `tkwitansi` date NOT NULL,
  `termpengiriman` varchar(20) NOT NULL,
  `dp` decimal(20,2) NOT NULL,
  `bpengiriman` decimal(20,2) NOT NULL,
  `idkontak` varchar(20) NOT NULL,
  `stkwitansi` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kwitansi`
--

INSERT INTO `kwitansi` (`idkwitansi`, `idpengiriman`, `tkwitansi`, `termpengiriman`, `dp`, `bpengiriman`, `idkontak`, `stkwitansi`) VALUES
('K00001', NULL, '2017-08-28', 'fob_shipping_point', '0.00', '0.00', 'V000002', 0),
('K00002', 'D000002', '2017-09-20', 'fob_shipping_point', '0.00', '0.00', 'V000002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `listoperasirnd`
--

CREATE TABLE `listoperasirnd` (
  `idbarang` varchar(20) NOT NULL,
  `namaoperasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listoperasirnd`
--

INSERT INTO `listoperasirnd` (`idbarang`, `namaoperasi`) VALUES
('B000001', 'Cutting'),
('B000001', 'Finishing');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `idlog` int(11) NOT NULL,
  `wlog` datetime NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `idfungsi` int(11) DEFAULT NULL,
  `deslog` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matrnd`
--

CREATE TABLE `matrnd` (
  `idbarang_rnd` varchar(20) NOT NULL,
  `idbarang_mat` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matrnd`
--

INSERT INTO `matrnd` (`idbarang_rnd`, `idbarang_mat`, `jumlah`) VALUES
('B000001', 'B000005', '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `operasiproduksi`
--

CREATE TABLE `operasiproduksi` (
  `nokartu` int(11) NOT NULL,
  `idjadwal` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `namaoperasi` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operasiproduksi`
--

INSERT INTO `operasiproduksi` (`nokartu`, `idjadwal`, `waktu`, `namaoperasi`, `status`) VALUES
(1, 1, '2017-10-16 00:00:00', 'Cutting', 0),
(2, 1, '2017-10-17 00:00:00', 'Finishing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` varchar(20) NOT NULL,
  `npegawai` varchar(100) NOT NULL,
  `alpegawai` varchar(100) NOT NULL,
  `telpegawai` varchar(50) NOT NULL,
  `stpegawai` int(11) NOT NULL,
  `idjabatan` varchar(20) NOT NULL,
  `stnikah` int(11) NOT NULL,
  `tanggungan` int(11) NOT NULL,
  `gabung` int(11) NOT NULL,
  `vartambahan` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `npegawai`, `alpegawai`, `telpegawai`, `stpegawai`, `idjabatan`, `stnikah`, `tanggungan`, `gabung`, `vartambahan`) VALUES
('P000001', 'Budi', 'Bandung', '12345', 1, 'KRY01', 1, 0, 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` varchar(20) NOT NULL,
  `tglbayar` date NOT NULL,
  `jmbayar` decimal(20,2) NOT NULL,
  `via` varchar(20) NOT NULL,
  `ket` text,
  `idkwitansi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembtagihan`
--

CREATE TABLE `pembtagihan` (
  `idpembayaran` varchar(20) NOT NULL,
  `tglbayar` date NOT NULL,
  `jmbayar` decimal(20,2) NOT NULL,
  `via` varchar(20) NOT NULL,
  `ket` text,
  `idtagihan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembtagihan`
--

INSERT INTO `pembtagihan` (`idpembayaran`, `tglbayar`, `jmbayar`, `via`, `ket`, `idtagihan`) VALUES
('B000001', '2017-08-25', '50000.00', 'Cash', '', 'TG000001');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `idpengajuan` varchar(20) NOT NULL,
  `tpengajuan` date NOT NULL,
  `prioritas` varchar(20) NOT NULL,
  `username` varchar(45) NOT NULL,
  `stpengajuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`idpengajuan`, `tpengajuan`, `prioritas`, `username`, `stpengajuan`) VALUES
('1617357401894316', '2017-08-28', '1', 'admin', 0),
('PS000000001', '2018-09-17', '1', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `idpengiriman` varchar(20) NOT NULL,
  `tpengiriman` date NOT NULL,
  `bpengiriman` decimal(20,2) NOT NULL,
  `idpesanan` varchar(20) DEFAULT NULL,
  `termpengiriman` varchar(20) NOT NULL,
  `idkontak` varchar(20) NOT NULL,
  `stpengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`idpengiriman`, `tpengiriman`, `bpengiriman`, `idpesanan`, `termpengiriman`, `idkontak`, `stpengiriman`) VALUES
('D000001', '2017-08-27', '0.00', NULL, 'fob_shipping_point', 'V000002', 0),
('D000002', '2017-09-20', '0.00', 'P00002', 'fob_shipping_point', 'V000002', 1),
('K0000000001', '2018-09-28', '0.00', 'S000000001', 'fob_shipping_point', 'V000002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjadwalan`
--

CREATE TABLE `penjadwalan` (
  `idjadwal` int(11) NOT NULL,
  `idorder` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `namaoperasi` varchar(200) NOT NULL,
  `tcmat` decimal(20,2) NOT NULL,
  `tclab` decimal(20,2) NOT NULL,
  `tcfoh` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjadwalan`
--

INSERT INTO `penjadwalan` (`idjadwal`, `idorder`, `waktu`, `jumlah`, `namaoperasi`, `tcmat`, `tclab`, `tcfoh`, `status`) VALUES
(1, 2, '2017-10-16 00:00:00', '5.00', 'Finishing', '0.00', '0.00', '0.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `penyesuaianprod`
--

CREATE TABLE `penyesuaianprod` (
  `idjadwal` int(11) NOT NULL,
  `cmaterial` decimal(20,2) NOT NULL,
  `clabor` decimal(20,2) NOT NULL,
  `cfoh` decimal(20,2) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `cunit` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyesuaianprod`
--

INSERT INTO `penyesuaianprod` (`idjadwal`, `cmaterial`, `clabor`, `cfoh`, `idbarang`, `jumlah`, `cunit`) VALUES
(1, '500000.00', '1000000.00', '50000.00', 'B000001', '5.00', '310000.00');

-- --------------------------------------------------------

--
-- Table structure for table `perintah_prod`
--

CREATE TABLE `perintah_prod` (
  `idorder` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL,
  `prioritas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perintah_prod`
--

INSERT INTO `perintah_prod` (`idorder`, `tanggal`, `idbarang`, `jumlah`, `status`, `prioritas`) VALUES
(2, '2017-10-16', 'B000001', '10.00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `kperiode` varchar(20) NOT NULL,
  `nperiode` varchar(100) NOT NULL,
  `dperiode` date NOT NULL,
  `speriode` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`kperiode`, `nperiode`, `dperiode`, `speriode`, `status`) VALUES
('FY0001', 'Full year 2017-2018', '2017-01-01', '2017-12-31', 0),
('FY0002', 'Full year 2018-2019', '2018-01-01', '2018-12-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` varchar(20) NOT NULL,
  `tpesanan` date NOT NULL,
  `idkontak` varchar(20) NOT NULL,
  `stpesanan` int(11) NOT NULL,
  `dp` decimal(20,2) NOT NULL,
  `termpengiriman` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `tpesanan`, `idkontak`, `stpesanan`, `dp`, `termpengiriman`) VALUES
('P00001', '2017-08-23', 'V000002', 0, '0.00', 'fob_shipping_point'),
('P00002', '2017-09-20', 'V000002', 1, '0.00', 'fob_shipping_point'),
('S000000001', '2018-09-17', 'V000002', 1, '0.00', 'fob_shipping_point'),
('S000000002', '2018-09-28', 'V000002', 0, '0.00', 'fob_shipping_point');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_beli`
--

CREATE TABLE `pesan_beli` (
  `idpesan_beli` varchar(20) NOT NULL,
  `tglpesan` date NOT NULL,
  `idkontak` varchar(20) NOT NULL,
  `stpesan` int(11) NOT NULL,
  `idpengajuan` varchar(20) DEFAULT NULL,
  `term` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan_beli`
--

INSERT INTO `pesan_beli` (`idpesan_beli`, `tglpesan`, `idkontak`, `stpesan`, `idpengajuan`, `term`) VALUES
('1617357401894316', '2017-08-29', 'V000001', 0, NULL, 'fob_shipping_point'),
('P0000000001', '2018-09-17', 'V000001', 0, 'PS000000001', 'fob_shipping_point');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL,
  `nrole` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `nrole`) VALUES
(1, 'admin'),
(7, 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `idtagihan` varchar(20) NOT NULL,
  `tgltagihan` date NOT NULL,
  `idterimabarang` varchar(20) NOT NULL,
  `term` varchar(40) NOT NULL,
  `biayapengiriman` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sttagihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`idtagihan`, `tgltagihan`, `idterimabarang`, `term`, `biayapengiriman`, `sttagihan`) VALUES
('PI000000001', '2018-09-17', 'T0000000001', 'fob_shipping_point', '0.00', 0),
('TG000001', '2017-08-29', 'T0000001', '', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `terimabarang`
--

CREATE TABLE `terimabarang` (
  `idterimabarang` varchar(20) NOT NULL,
  `tglterimabarang` date NOT NULL,
  `idpesan_beli` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terimabarang`
--

INSERT INTO `terimabarang` (`idterimabarang`, `tglterimabarang`, `idpesan_beli`) VALUES
('T0000000001', '2018-09-17', 'P0000000001'),
('T0000001', '2017-08-29', '1617357401894316');

-- --------------------------------------------------------

--
-- Table structure for table `transpos`
--

CREATE TABLE `transpos` (
  `idtranspos` int(11) NOT NULL,
  `wtranspos` datetime NOT NULL,
  `stranspos` int(11) NOT NULL DEFAULT '0',
  `username` varchar(45) NOT NULL,
  `idkasir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transpos`
--

INSERT INTO `transpos` (`idtranspos`, `wtranspos`, `stranspos`, `username`, `idkasir`) VALUES
(2, '2017-08-27 06:14:11', 1, 'admin', 3),
(3, '2017-08-27 06:18:35', 1, 'admin', 3),
(4, '2017-09-19 04:45:29', 1, 'admin', 3),
(5, '2017-09-19 04:47:00', 1, 'admin', 3),
(6, '2017-10-16 03:32:46', 1, 'admin', 3),
(7, '2018-09-28 00:06:28', 1, 'admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nuser` varchar(45) NOT NULL,
  `suser` int(11) NOT NULL DEFAULT '1',
  `idrole` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nuser`, `suser`, `idrole`) VALUES
('admin', 'c3284d0f94606de1fd2af172aba15bf3', 'Administrator', 1, 1),
('kasir', '59b8f19e2e140a1f7829b116219b6497', 'kasir', 1, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambilmat`
--
ALTER TABLE `ambilmat`
  ADD PRIMARY KEY (`noreq`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `barangditerima`
--
ALTER TABLE `barangditerima`
  ADD PRIMARY KEY (`idbarang`,`idterimabarang`),
  ADD KEY `fk_barang_has_terimabarang_terimabarang1_idx` (`idterimabarang`),
  ADD KEY `fk_barang_has_terimabarang_barang1_idx` (`idbarang`);

--
-- Indexes for table `barangkasir`
--
ALTER TABLE `barangkasir`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `fk_barangkasir_barang1_idx` (`idbarang`);

--
-- Indexes for table `barangpengajuan`
--
ALTER TABLE `barangpengajuan`
  ADD PRIMARY KEY (`idbarang`,`idpengajuan`),
  ADD KEY `fk_barang_has_pengajuan_pengajuan1_idx` (`idpengajuan`),
  ADD KEY `fk_barang_has_pengajuan_barang1_idx` (`idbarang`);

--
-- Indexes for table `barangrnd`
--
ALTER TABLE `barangrnd`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `barispesanan`
--
ALTER TABLE `barispesanan`
  ADD PRIMARY KEY (`idbarang`,`idpesanan`),
  ADD KEY `fk_barang_has_pesanan_pesanan1_idx` (`idpesanan`),
  ADD KEY `fk_barang_has_pesanan_barang1_idx` (`idbarang`);

--
-- Indexes for table `catatankontak`
--
ALTER TABLE `catatankontak`
  ADD PRIMARY KEY (`idcatatankontak`),
  ADD KEY `fk_catatankontak_kontak1_idx` (`idkontak`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`noakun`),
  ADD KEY `fk_coa_coa1_idx` (`katakun`);

--
-- Indexes for table `djurnal`
--
ALTER TABLE `djurnal`
  ADD PRIMARY KEY (`kdjurnal`),
  ADD KEY `kjurnal` (`kjurnal`);

--
-- Indexes for table `djurnalm`
--
ALTER TABLE `djurnalm`
  ADD PRIMARY KEY (`kdjurnalm`),
  ADD KEY `djurnalm_ibfk_1` (`kjurnalm`);

--
-- Indexes for table `eksperimen_peserta`
--
ALTER TABLE `eksperimen_peserta`
  ADD PRIMARY KEY (`peserta_id`);

--
-- Indexes for table `fungsi`
--
ALTER TABLE `fungsi`
  ADD PRIMARY KEY (`idfungsi`);

--
-- Indexes for table `fungsiakun`
--
ALTER TABLE `fungsiakun`
  ADD PRIMARY KEY (`noakun`,`idfungsi`),
  ADD KEY `fk_fungsiakun_fungsi1_idx` (`idfungsi`);

--
-- Indexes for table `fungsirole`
--
ALTER TABLE `fungsirole`
  ADD PRIMARY KEY (`idrole`,`idfungsi`),
  ADD KEY `fk_role_has_fungsi_fungsi1_idx` (`idfungsi`),
  ADD KEY `fk_role_has_fungsi_role1_idx` (`idrole`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`idgaji`);

--
-- Indexes for table `isiambilmat`
--
ALTER TABLE `isiambilmat`
  ADD PRIMARY KEY (`noreq`,`idbarang`);

--
-- Indexes for table `isikwitansi`
--
ALTER TABLE `isikwitansi`
  ADD PRIMARY KEY (`idkwitansi`,`idbarang`),
  ADD KEY `fk_kwitansi_has_barang_barang1_idx` (`idbarang`),
  ADD KEY `fk_kwitansi_has_barang_kwitansi1_idx` (`idkwitansi`);

--
-- Indexes for table `isipengiriman`
--
ALTER TABLE `isipengiriman`
  ADD PRIMARY KEY (`idpengiriman`,`idbarang`),
  ADD KEY `fk_pengiriman_has_barang_barang1_idx` (`idbarang`),
  ADD KEY `fk_pengiriman_has_barang_pengiriman1_idx` (`idpengiriman`);

--
-- Indexes for table `isipesan_beli`
--
ALTER TABLE `isipesan_beli`
  ADD PRIMARY KEY (`idbarang`,`idpesan_beli`),
  ADD KEY `fk_barang_has_pesan_beli_pesan_beli1_idx` (`idpesan_beli`),
  ADD KEY `fk_barang_has_pesan_beli_barang1_idx` (`idbarang`);

--
-- Indexes for table `isitagihan`
--
ALTER TABLE `isitagihan`
  ADD PRIMARY KEY (`idtagihan`,`idbarang`),
  ADD KEY `fk_tagihan_has_barang_barang1_idx` (`idbarang`),
  ADD KEY `fk_tagihan_has_barang_tagihan1_idx` (`idtagihan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`idjabatan`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`kjurnal`);

--
-- Indexes for table `jurnalm`
--
ALTER TABLE `jurnalm`
  ADD PRIMARY KEY (`kjurnalm`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`idkasir`);

--
-- Indexes for table `keranjangpos`
--
ALTER TABLE `keranjangpos`
  ADD PRIMARY KEY (`idkeranjangpos`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`idkontak`);

--
-- Indexes for table `kwitansi`
--
ALTER TABLE `kwitansi`
  ADD PRIMARY KEY (`idkwitansi`),
  ADD KEY `fk_kwitansi_kontak1_idx` (`idkontak`);

--
-- Indexes for table `listoperasirnd`
--
ALTER TABLE `listoperasirnd`
  ADD PRIMARY KEY (`idbarang`,`namaoperasi`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `fk_log_fungsi1_idx` (`idfungsi`),
  ADD KEY `fk_log_user1_idx` (`username`);

--
-- Indexes for table `matrnd`
--
ALTER TABLE `matrnd`
  ADD PRIMARY KEY (`idbarang_rnd`,`idbarang_mat`);

--
-- Indexes for table `operasiproduksi`
--
ALTER TABLE `operasiproduksi`
  ADD PRIMARY KEY (`nokartu`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `fk_pembayaran_kwitansi1_idx` (`idkwitansi`);

--
-- Indexes for table `pembtagihan`
--
ALTER TABLE `pembtagihan`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `fk_pembtagihan_tagihan1_idx` (`idtagihan`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`idpengajuan`),
  ADD KEY `fk_pengajuan_user1_idx` (`username`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`idpengiriman`),
  ADD KEY `fk_pengiriman_pesanan1_idx` (`idpesanan`),
  ADD KEY `fk_pengiriman_kontak1_idx` (`idkontak`);

--
-- Indexes for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  ADD PRIMARY KEY (`idjadwal`);

--
-- Indexes for table `penyesuaianprod`
--
ALTER TABLE `penyesuaianprod`
  ADD PRIMARY KEY (`idjadwal`);

--
-- Indexes for table `perintah_prod`
--
ALTER TABLE `perintah_prod`
  ADD PRIMARY KEY (`idorder`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`kperiode`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`),
  ADD KEY `fk_pesanan_kontak1_idx` (`idkontak`);

--
-- Indexes for table `pesan_beli`
--
ALTER TABLE `pesan_beli`
  ADD PRIMARY KEY (`idpesan_beli`),
  ADD KEY `fk_pesan_beli_kontak1_idx` (`idkontak`),
  ADD KEY `fk_pesan_beli_pengajuan1_idx` (`idpengajuan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`idtagihan`),
  ADD KEY `fk_tagihan_terimabarang1_idx` (`idterimabarang`);

--
-- Indexes for table `terimabarang`
--
ALTER TABLE `terimabarang`
  ADD PRIMARY KEY (`idterimabarang`),
  ADD KEY `fk_terimabarang_pesan_beli1_idx` (`idpesan_beli`);

--
-- Indexes for table `transpos`
--
ALTER TABLE `transpos`
  ADD PRIMARY KEY (`idtranspos`),
  ADD KEY `fk_transpos_user1_idx` (`username`),
  ADD KEY `fk_transpos_kasir1_idx` (`idkasir`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_user_role_idx` (`idrole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatankontak`
--
ALTER TABLE `catatankontak`
  MODIFY `idcatatankontak` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `djurnal`
--
ALTER TABLE `djurnal`
  MODIFY `kdjurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `djurnalm`
--
ALTER TABLE `djurnalm`
  MODIFY `kdjurnalm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `eksperimen_peserta`
--
ALTER TABLE `eksperimen_peserta`
  MODIFY `peserta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT for table `fungsi`
--
ALTER TABLE `fungsi`
  MODIFY `idfungsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70001;
--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `idgaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `kjurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `jurnalm`
--
ALTER TABLE `jurnalm`
  MODIFY `kjurnalm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `idkasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `keranjangpos`
--
ALTER TABLE `keranjangpos`
  MODIFY `idkeranjangpos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  MODIFY `idjadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `perintah_prod`
--
ALTER TABLE `perintah_prod`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transpos`
--
ALTER TABLE `transpos`
  MODIFY `idtranspos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangditerima`
--
ALTER TABLE `barangditerima`
  ADD CONSTRAINT `fk_barang_has_terimabarang_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_terimabarang_terimabarang1` FOREIGN KEY (`idterimabarang`) REFERENCES `terimabarang` (`idterimabarang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `barangkasir`
--
ALTER TABLE `barangkasir`
  ADD CONSTRAINT `fk_barangkasir_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `barangpengajuan`
--
ALTER TABLE `barangpengajuan`
  ADD CONSTRAINT `fk_barang_has_pengajuan_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_pengajuan_pengajuan1` FOREIGN KEY (`idpengajuan`) REFERENCES `pengajuan` (`idpengajuan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `barispesanan`
--
ALTER TABLE `barispesanan`
  ADD CONSTRAINT `fk_barang_has_pesanan_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_pesanan_pesanan1` FOREIGN KEY (`idpesanan`) REFERENCES `pesanan` (`idpesanan`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `catatankontak`
--
ALTER TABLE `catatankontak`
  ADD CONSTRAINT `fk_catatankontak_kontak1` FOREIGN KEY (`idkontak`) REFERENCES `kontak` (`idkontak`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `coa`
--
ALTER TABLE `coa`
  ADD CONSTRAINT `fk_coa_coa1` FOREIGN KEY (`katakun`) REFERENCES `coa` (`noakun`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `djurnal`
--
ALTER TABLE `djurnal`
  ADD CONSTRAINT `djurnal_ibfk_1` FOREIGN KEY (`kjurnal`) REFERENCES `jurnal` (`kjurnal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `djurnalm`
--
ALTER TABLE `djurnalm`
  ADD CONSTRAINT `djurnalm_ibfk_1` FOREIGN KEY (`kjurnalm`) REFERENCES `jurnalm` (`kjurnalm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fungsiakun`
--
ALTER TABLE `fungsiakun`
  ADD CONSTRAINT `fk_fungsiakun_coa1` FOREIGN KEY (`noakun`) REFERENCES `coa` (`noakun`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fungsiakun_fungsi1` FOREIGN KEY (`idfungsi`) REFERENCES `fungsi` (`idfungsi`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `fungsirole`
--
ALTER TABLE `fungsirole`
  ADD CONSTRAINT `fk_role_has_fungsi_fungsi1` FOREIGN KEY (`idfungsi`) REFERENCES `fungsi` (`idfungsi`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role_has_fungsi_role1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `isikwitansi`
--
ALTER TABLE `isikwitansi`
  ADD CONSTRAINT `fk_kwitansi_has_barang_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kwitansi_has_barang_kwitansi1` FOREIGN KEY (`idkwitansi`) REFERENCES `kwitansi` (`idkwitansi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `isipengiriman`
--
ALTER TABLE `isipengiriman`
  ADD CONSTRAINT `fk_pengiriman_has_barang_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `isipesan_beli`
--
ALTER TABLE `isipesan_beli`
  ADD CONSTRAINT `fk_barang_has_pesan_beli_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_pesan_beli_pesan_beli1` FOREIGN KEY (`idpesan_beli`) REFERENCES `pesan_beli` (`idpesan_beli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `isitagihan`
--
ALTER TABLE `isitagihan`
  ADD CONSTRAINT `fk_tagihan_has_barang_barang1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tagihan_has_barang_tagihan1` FOREIGN KEY (`idtagihan`) REFERENCES `tagihan` (`idtagihan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kwitansi`
--
ALTER TABLE `kwitansi`
  ADD CONSTRAINT `fk_kwitansi_kontak1` FOREIGN KEY (`idkontak`) REFERENCES `kontak` (`idkontak`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_fungsi1` FOREIGN KEY (`idfungsi`) REFERENCES `fungsi` (`idfungsi`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_user1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_kwitansi1` FOREIGN KEY (`idkwitansi`) REFERENCES `kwitansi` (`idkwitansi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pembtagihan`
--
ALTER TABLE `pembtagihan`
  ADD CONSTRAINT `fk_pembtagihan_tagihan1` FOREIGN KEY (`idtagihan`) REFERENCES `tagihan` (`idtagihan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `fk_pengajuan_user1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `fk_pengiriman_kontak1` FOREIGN KEY (`idkontak`) REFERENCES `kontak` (`idkontak`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengiriman_pesanan1` FOREIGN KEY (`idpesanan`) REFERENCES `pesanan` (`idpesanan`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_kontak1` FOREIGN KEY (`idkontak`) REFERENCES `kontak` (`idkontak`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pesan_beli`
--
ALTER TABLE `pesan_beli`
  ADD CONSTRAINT `fk_pesan_beli_kontak1` FOREIGN KEY (`idkontak`) REFERENCES `kontak` (`idkontak`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pesan_beli_pengajuan1` FOREIGN KEY (`idpengajuan`) REFERENCES `pengajuan` (`idpengajuan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `fk_tagihan_terimabarang1` FOREIGN KEY (`idterimabarang`) REFERENCES `terimabarang` (`idterimabarang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `terimabarang`
--
ALTER TABLE `terimabarang`
  ADD CONSTRAINT `fk_terimabarang_pesan_beli1` FOREIGN KEY (`idpesan_beli`) REFERENCES `pesan_beli` (`idpesan_beli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transpos`
--
ALTER TABLE `transpos`
  ADD CONSTRAINT `fk_transpos_kasir1` FOREIGN KEY (`idkasir`) REFERENCES `kasir` (`idkasir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transpos_user1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
