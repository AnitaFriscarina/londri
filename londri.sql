-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 04:15 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `londri`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE IF NOT EXISTS `tb_log` (
`id` int(11) NOT NULL,
  `log_time` datetime DEFAULT NULL,
  `log_user` varchar(100) DEFAULT '',
  `log_tipe` varchar(100) DEFAULT NULL,
  `log_aksi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id`, `log_time`, `log_user`, `log_tipe`, `log_aksi`) VALUES
(1, NULL, '0', 'Login', 'adminTelah Login'),
(2, NULL, 'admin', 'Login', 'admin Telah Login'),
(3, NULL, 'admin', 'Login', 'admin Telah Login'),
(4, NULL, 'admin', 'Logout', 'admin Telah Logout'),
(5, '2020-04-23 01:56:46', 'admin', 'Login', 'admin Telah Login'),
(6, '2020-04-23 01:56:58', 'admin', 'Logout', 'admin Telah Logout'),
(7, '2020-04-23 01:59:26', 'kasir', 'Login', 'kasir Telah Login'),
(8, '2020-04-23 01:59:48', 'kasir', 'Logout', 'kasir Telah Logout'),
(9, '2020-04-23 01:59:51', 'admin', 'Login', 'admin Telah Login'),
(10, '2020-04-23 02:00:32', 'admin', 'Outlet', 'admin Menambahkan Outlet Laundy Bu Surti'),
(11, '2020-04-23 02:02:56', 'admin', 'Delete', 'admin Menghapus Outlet 6'),
(12, '2020-04-23 02:03:21', 'admin', 'Edit', 'admin Mengapdate Outlet Laundy Bu Surti'),
(13, '2020-04-23 02:07:09', 'admin', 'Insert', 'admin Menambahkan Paket Paket Sepatu'),
(14, '2020-04-23 02:07:34', 'admin', 'Update', 'admin Mengedit Paket Paket Sepatu Murah'),
(15, '2020-04-23 02:07:44', 'admin', 'Delete', 'admin Menghapus Pakett 5'),
(16, '2020-04-23 02:10:01', 'admin', 'Insert', 'admin Menambahkan Pelanggan Yazid'),
(17, '2020-04-23 02:10:11', 'admin', 'Delete', 'admin Menghapus Pelanggan 9'),
(18, '2020-04-23 02:10:32', 'admin', 'Update', 'admin Mengedit Pelanggan Yazid Zikra'),
(19, '2020-04-23 02:23:37', 'admin', 'Insert', 'admin Menambahkan Transaksi Invoice - 13'),
(20, '2020-04-23 02:23:53', 'admin', 'Update', 'admin Mengubah Status Transaksi 13 Menjadi selesai'),
(21, '2020-04-23 02:24:11', 'admin', 'Update', 'admin Melakukan Pembayaran Transaksi 13'),
(22, '2020-04-23 02:24:28', 'admin', 'Delete', 'admin Menghapus Transaksi 13'),
(23, '2020-04-23 02:29:02', 'admin', 'Insert', 'admin Menambahkan Transaksi Invoice - 13'),
(24, '2020-04-23 02:29:38', 'admin', 'Update', 'admin Mengubah Status Transaksi 14 Menjadi selesai'),
(25, '2020-04-23 02:29:52', 'admin', 'Update', 'admin Melakukan Pembayaran Transaksi 12'),
(26, '2020-04-23 02:30:25', 'admin', 'Update', 'admin Melakukan Pembayaran Transaksi 14'),
(27, '2020-04-23 02:37:21', 'admin', 'Insert', 'admin Menambahkan User Sumiyati'),
(28, '2020-04-23 02:37:50', 'admin', 'Update', 'admin Mengedit Data User 5'),
(29, '2020-04-23 02:38:00', 'admin', 'Update', 'admin Menghapus Data User 5'),
(30, '2020-04-23 02:42:06', 'admin', 'Logout', 'admin Telah Logout'),
(31, '2020-04-23 02:42:11', 'kasir', 'Login', 'kasir Telah Login'),
(32, '2020-04-23 02:42:53', 'kasir', 'Logout', 'kasir Telah Logout'),
(33, '2020-04-23 02:42:59', 'owner', 'Login', 'owner Telah Login'),
(34, '2020-04-23 06:08:22', 'owner', 'Logout', 'owner Telah Logout'),
(35, '2020-04-23 06:26:55', 'admin', 'Login', 'admin Telah Login'),
(36, '2020-04-23 06:52:24', 'admin', 'Logout', 'admin Telah Logout'),
(37, '2020-04-23 06:52:31', 'owner', 'Login', 'owner Telah Login'),
(38, '2020-04-23 07:53:23', 'owner', 'Logout', 'owner Telah Logout'),
(39, '2020-04-23 08:14:48', NULL, 'Logout', ' Telah Logout'),
(40, '2020-04-23 08:14:51', NULL, 'Logout', ' Telah Logout'),
(41, '2020-04-24 11:04:36', 'admin', 'Login', 'admin Telah Login'),
(42, '2020-04-24 02:18:21', 'admin', 'Login', 'admin Telah Login'),
(43, '2020-04-24 02:19:22', 'admin', 'Update', 'admin Mengedit Pelanggan dirma'),
(44, '2020-04-24 02:20:00', 'admin', 'Update', 'admin Mengedit Pelanggan zahra'),
(45, '2020-04-24 02:20:30', 'admin', 'Update', 'admin Mengedit Pelanggan alpi'),
(46, '2020-04-24 02:21:14', 'admin', 'Edit', 'admin Mengedit Outlet Laundry Pak Tejo'),
(47, '2020-04-24 02:21:30', 'admin', 'Edit', 'admin Mengedit Outlet Laundry Pak Tejo 2'),
(48, '2020-04-24 02:22:37', 'admin', 'Logout', 'admin Telah Logout');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE IF NOT EXISTS `tb_member` (
`id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `jenis_kelamin` enum('P','L') DEFAULT NULL,
  `tlp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(1, 'dirma', 'jl.baros', 'P', '08122000000'),
(2, 'zahra', 'jl.karamat   ', 'P', '080000000'),
(5, 'alpi', 'jl.pemuda', 'L', '080002100'),
(6, 'Sudrajat', 'Cibitung', 'L', '08122512'),
(7, 'Yazid Zikra', 'Tambun ', 'L', '02561561'),
(10, 'Yazid', 'Tidak Tahu', 'L', '0909890');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE IF NOT EXISTS `tb_outlet` (
`id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `tlp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id`, `nama`, `alamat`, `tlp`) VALUES
(1, 'Laundry Pak Tejo', 'Jl.surya kencana', '081111222'),
(2, 'Laundry Pak Tejo 2', 'jl.stadion', '08121202020'),
(5, 'Laundy Bu Surti', 'Jalan Yang Lurus ', '081213123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE IF NOT EXISTS `tb_paket` (
`id` int(11) NOT NULL,
  `id_outlet` int(11) DEFAULT NULL,
  `jenis` enum('selimut','kiloan','bed_cover','kaos','lain') DEFAULT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
(1, 1, 'selimut', 'Paket Kilo Selimut', 100000),
(2, 1, 'kaos', 'Paket Kiloan Kaos', 12000),
(4, 1, 'lain', 'Jaket Kulit', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
`id` int(11) NOT NULL,
  `id_outlet` int(11) DEFAULT NULL,
  `kode_invoice` varchar(100) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `pembeli_nonmember` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `batas_waktu` date DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` enum('baru','proses','selesai','diambil') DEFAULT NULL,
  `status_pembayaran` enum('dibayar','belum dibayar') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_outlet`, `kode_invoice`, `id_member`, `pembeli_nonmember`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `total_harga`, `status`, `status_pembayaran`, `id_user`) VALUES
(10, 2, 'Invoice - 10', 2, '', '2020-04-22', '2020-04-23', '2020-04-29', 2000, 10, 10, 102000, 'baru', 'dibayar', 1),
(11, 2, 'Invoice - 11', 5, '', '2020-04-22', '2020-04-29', '0000-00-00', 0, 0, 0, 24000, 'baru', 'belum dibayar', 1),
(12, 2, 'Invoice - 12', 2, '', '2020-04-22', '2020-04-23', '2020-04-23', 9000, 20, 10, 108900, 'baru', 'dibayar', 3),
(14, 1, 'Invoice - 13', 5, '', '2020-04-02', '2020-04-10', '2020-04-23', 9000, 30, 10, 58920, 'selesai', 'dibayar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_detail` (
`id` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id`, `id_transaksi`, `id_paket`, `qty`, `subtotal`, `keterangan`) VALUES
(16, 10, 1, 1, 100000, ''),
(17, 11, 2, 2, 24000, ''),
(18, 12, 2, 1, 12000, ''),
(19, 12, 4, 2, 30000, ''),
(20, 12, 4, 3, 45000, ''),
(21, 12, 2, 2, 24000, ''),
(23, 14, 2, 2.1, 25200, ''),
(24, 14, 2, 0.5, 6000, ''),
(25, 14, 2, 2.6, 31200, '');

--
-- Triggers `tb_transaksi_detail`
--
DELIMITER //
CREATE TRIGGER `totalharga_transaksi` AFTER INSERT ON `tb_transaksi_detail`
 FOR EACH ROW begin
update tb_transaksi
set total_harga = (select sum(subtotal) from tb_transaksi_detail where id_transaksi = new.id_transaksi )
where id = new.id_transaksi ;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `role` enum('owner','kasir','admin') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `password`, `id_outlet`, `role`) VALUES
(1, 'admin', '$2y$10$x8jwae4.lTGev15IN62wfulnaeGwY51l/zsBLgIZ3jrEbCdLDIM2O', 1, 'admin'),
(2, 'owner', '$2y$10$vHKF36m8lvSNAAXHzFEnqOc2K17/H94vlXP9YiJCy08KVy0LE2SUi', 1, 'owner'),
(3, 'kasir', '$2y$10$fIKDQgerNAPsW6NTa6o9y.tgq8hU0cEI2P8vP6KH11gFx9ApIYmuq', 1, 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
 ADD PRIMARY KEY (`id`), ADD KEY `id_outlet` (`id_outlet`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
 ADD PRIMARY KEY (`id`), ADD KEY `id_outlet` (`id_outlet`), ADD KEY `id_member` (`id_member`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `id_transaksi` (`id_transaksi`), ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id`), ADD KEY `id_outlet` (`id_outlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_paket`
--
ALTER TABLE `tb_paket`
ADD CONSTRAINT `tb_paket_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`),
ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id`),
ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);

--
-- Constraints for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
ADD CONSTRAINT `tb_transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id`),
ADD CONSTRAINT `tb_transaksi_detail_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
