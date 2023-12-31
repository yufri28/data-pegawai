-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20231112.f9ab9d15ac
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 02:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datapegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_golongan`
--

CREATE TABLE `data_golongan` (
  `id_golongan` int(4) NOT NULL,
  `golongan` varchar(20) NOT NULL,
  `tmt` date NOT NULL,
  `jumlah_gaji` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_golongan`
--

INSERT INTO `data_golongan` (`id_golongan`, `golongan`, `tmt`, `jumlah_gaji`, `id_pegawai`) VALUES
(7, 'iv/e', '2023-11-10', 2147483647, 1308),
(8, 'iv/a', '2023-11-10', 2147483647, 1309);

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `eselon` varchar(20) NOT NULL,
  `tmt` varchar(20) NOT NULL,
  `id_pegawai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama`, `eselon`, `tmt`, `id_pegawai`) VALUES
(1, 'Kabit', '3', '2023-11-10', 1306),
(3, 'Kepala Bidang Tanaman Pangan dan Hortikultura', 'IV-B', '2023-11-10', 1308),
(4, 'Kabit', 'IV-A', '2024-01-05', 1308);

-- --------------------------------------------------------

--
-- Table structure for table `data_mutasi`
--

CREATE TABLE `data_mutasi` (
  `id_mutasi` int(5) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tempat_mutasi` varchar(255) NOT NULL,
  `jenis_mutasi` enum('Keluar','Masuk') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_mutasi`
--

INSERT INTO `data_mutasi` (`id_mutasi`, `id_pegawai`, `tempat_mutasi`, `jenis_mutasi`) VALUES
(7, 1308, 'Bidang TPH', 'Masuk');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('Laki-Laki','Perempuan','Tidak diketahui') NOT NULL,
  `agama` enum('Kristen','Islam','Katolik','Hindu','Buddha','Khonghucu') NOT NULL,
  `status` enum('Tetap','Honor') NOT NULL,
  `id_periode` int(11) NOT NULL,
  `skpp` date DEFAULT NULL,
  `skpt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nip`, `nama`, `alamat`, `no_hp`, `tempat_lahir`, `tanggal_lahir`, `jk`, `agama`, `status`, `id_periode`, `skpp`, `skpt`) VALUES
(1308, '197004291994031005', 'Nixon M Balukh', 'wadgjuk', '1234567890', 'kupang', '2023-11-10', 'Laki-Laki', 'Kristen', 'Tetap', 17, NULL, NULL),
(1309, '111111111111111123', 'adit', 'awesrdgtfhygjukh', '099786654', 'tdejetde', '2023-11-10', 'Perempuan', 'Khonghucu', 'Honor', 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_pendidikan`
--

CREATE TABLE `data_pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `pendidikan_terakhir` varchar(5) NOT NULL,
  `lembaga_pendidikan` varchar(100) NOT NULL,
  `kursus_diklat` text DEFAULT NULL,
  `pend_perjenjangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pendidikan`
--

INSERT INTO `data_pendidikan` (`id_pendidikan`, `id_pegawai`, `tahun_lulus`, `jurusan`, `pendidikan_terakhir`, `lembaga_pendidikan`, `kursus_diklat`, `pend_perjenjangan`) VALUES
(2, 1302, '2008', 'Kimia', 'S1', 'Undana', '', ''),
(3, 1303, '2008', 'Kimia', 'S1', 'Undana', '', ''),
(4, 1306, '2012', 'Kimia', 'S1', 'Undana', '', ''),
(6, 1309, '2009', 'Pertanian', 'SMA', 'Undana', '', ''),
(7, 1308, '2018', 'Ilmu Komputer', 'S1', 'Universitas Nusa Cendana', 'Kursus Bahasa Inggris, Kursus Bahasa Jerman dan Kursus Komputer', 'Pra Identifikasi Klpk sasaran PPL, Agribisnis Ternak Potong dan Teknologi  Lahan');

-- --------------------------------------------------------

--
-- Table structure for table `data_pensiun`
--

CREATE TABLE `data_pensiun` (
  `id_pensiun` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tahun_pensiun` year(4) NOT NULL,
  `jabatan_terakhir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pensiun`
--

INSERT INTO `data_pensiun` (`id_pensiun`, `id_pegawai`, `tahun_pensiun`, `jabatan_terakhir`) VALUES
(10, 1308, '2028', 'Kabid TPH');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `tahun`) VALUES
(13, '2023'),
(17, '2024');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Administrator','Sekretaris') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`) VALUES
(1, 'Isabela Eka Putri', 'admin', '123456', 'Administrator'),
(2, 'Pengguna', 'pengguna', '1', 'Sekretaris'),
(3, 'Kepala Dinas', 'kadis', '1234', 'Sekretaris');

-- --------------------------------------------------------

--
-- Table structure for table `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int(11) NOT NULL,
  `nama_profil` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_profil`
--

INSERT INTO `tb_profil` (`id_profil`, `nama_profil`, `alamat`, `bidang`) VALUES
(1, 'DINAS PERTANIAN DAN KETAHANAN PANGAN PROVINSI NTT', 'KOTA KUPANG', 'PEMERINTAHAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_golongan`
--
ALTER TABLE `data_golongan`
  ADD PRIMARY KEY (`id_golongan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `data_mutasi`
--
ALTER TABLE `data_mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `data_pendidikan`
--
ALTER TABLE `data_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `data_pensiun`
--
ALTER TABLE `data_pensiun`
  ADD PRIMARY KEY (`id_pensiun`),
  ADD UNIQUE KEY `id_pegawai_2` (`id_pegawai`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_golongan`
--
ALTER TABLE `data_golongan`
  MODIFY `id_golongan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_mutasi`
--
ALTER TABLE `data_mutasi`
  MODIFY `id_mutasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1314;

--
-- AUTO_INCREMENT for table `data_pendidikan`
--
ALTER TABLE `data_pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_pensiun`
--
ALTER TABLE `data_pensiun`
  MODIFY `id_pensiun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_golongan`
--
ALTER TABLE `data_golongan`
  ADD CONSTRAINT `data_golongan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_mutasi`
--
ALTER TABLE `data_mutasi`
  ADD CONSTRAINT `data_mutasi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD CONSTRAINT `data_pegawai_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pensiun`
--
ALTER TABLE `data_pensiun`
  ADD CONSTRAINT `data_pensiun_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
