-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Mar 2024 pada 18.18
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `data_golongan`
--

CREATE TABLE `data_golongan` (
  `id_golongan` int(4) NOT NULL,
  `golongan` varchar(20) NOT NULL,
  `tmt` date NOT NULL,
  `jumlah_gaji` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_golongan`
--

INSERT INTO `data_golongan` (`id_golongan`, `golongan`, `tmt`, `jumlah_gaji`, `id_pegawai`) VALUES
(9, 'IV/c', '2020-10-01', 8259400, 1314),
(10, 'Iv/b', '2011-10-01', 1, 1315),
(11, 'IV/b', '2011-04-01', 6173500, 1316),
(12, 'IV/b', '2014-04-01', 1, 1317),
(13, 'IV/b', '2016-04-01', 5962400, 1318),
(14, 'III/d', '2013-04-01', 5336400, 1319),
(17, 'III-A', '2024-02-27', 2500000, 1328);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `eselon` varchar(20) NOT NULL,
  `tmt` varchar(20) NOT NULL,
  `id_pegawai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama`, `eselon`, `tmt`, `id_pegawai`) VALUES
(1, 'Kabit', '3', '2023-11-10', 1306),
(3, 'Kepala Bidang Tanaman Pangan dan Hortikultura', 'IV-B', '2023-11-10', 1308),
(4, 'Kabit', 'IV-A', '2024-01-05', 1308),
(5, 'Kepala Dinas Pertanian dan Ketahanan Pangan NTT', 'II-a', '2020-08-03', 1314),
(6, 'Fungsional Umum', '-', '2024-01-01', 1315),
(7, 'Kepala Bidang Perkebunan ', 'III-a', '0001-01-01', 1317),
(8, 'Kepala UPTD Perbenihan Kebun Dinas dan Lab Hayati', 'III-b ', '2023-09-01', 1318),
(9, 'Analis Keuangan Pusat/Daerah Ahli Muda ', '-', '2021-12-31', 1319),
(10, 'Pengemudi Bidang KPP', '-', '2005-01-06', 1324),
(11, 'Kabit', 'IV-B', '2009-02-02', 1328);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mutasi`
--

CREATE TABLE `data_mutasi` (
  `id_mutasi` int(5) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tempat_mutasi` varchar(255) NOT NULL,
  `jenis_mutasi` enum('Dinas Baru','Dinas Lama') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_mutasi`
--

INSERT INTO `data_mutasi` (`id_mutasi`, `id_pegawai`, `tempat_mutasi`, `jenis_mutasi`) VALUES
(14, 1314, 'Bepelitbangda Provinsi NTT', 'Dinas Lama'),
(15, 1317, 'Dinas Kearsipan dan Pusat Provinsi NTT', 'Dinas Lama'),
(16, 1316, 'Bepelitbangda Provinsi NTT', 'Dinas Lama'),
(17, 1319, 'DP3A Provinsi NTT', 'Dinas Lama'),
(18, 1328, 'Kefa', 'Dinas Lama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `masa_kerja` varchar(20) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('Laki-Laki','Perempuan','Tidak diketahui') NOT NULL,
  `agama` enum('Kristen','Islam','Katolik','Hindu','Buddha','Khonghucu') NOT NULL,
  `status` enum('Tetap','Honor') NOT NULL,
  `id_periode` int(11) NOT NULL,
  `skpp` date DEFAULT NULL,
  `skpt` date DEFAULT NULL,
  `f_id_unit` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nip`, `nama`, `alamat`, `masa_kerja`, `tempat_lahir`, `tanggal_lahir`, `jk`, `agama`, `status`, `id_periode`, `skpp`, `skpt`, `f_id_unit`) VALUES
(1314, '194602101986031029', 'Lucky Frederich Koli, S.TP', '-', '34 Tahun 10 Bulan', 'TTS', '1964-02-10', 'Laki-Laki', 'Kristen', 'Tetap', 13, '1986-03-01', '2024-03-01', 2),
(1315, '196508191993032006', 'Ir. Agustina W. Soewarni ', '-', '28 Tahun 10 Bulan', 'Kupang', '1965-08-19', 'Perempuan', '', 'Tetap', 13, '1993-03-01', '2028-05-01', 2),
(1316, '1970042919940310005', 'Nixon M. Balukh, SP. M.Si', '', '32 Tahun 0 Bulan ', 'Kupang', '1970-04-24', 'Laki-Laki', 'Kristen', 'Tetap', 13, '1933-03-01', '2028-05-01', 2),
(1317, '196506031996031001', 'Ir. Robertus Ongo, MM', '-', '26 Tahun 10 Bulan ', 'Bajawa', '1965-06-03', 'Laki-Laki', '', 'Tetap', 13, '1996-03-01', '2023-07-01', 2),
(1318, '196812041994032007', 'Ir. Maria I.R.D. Manek, M.Sc', '', '28 Tahun 10 Bulan ', 'Atambua ', '1968-12-04', 'Perempuan', '', 'Tetap', 13, '1994-03-01', '2027-01-01', 2),
(1319, '196605281986032005', 'Sofia A.T. Djari, S.Sos', '', '31 Tahun 10 Bulan ', 'Kupang ', '1966-05-28', 'Perempuan', '', 'Tetap', 13, '1986-03-01', '2024-06-01', 2),
(1321, '196506211992032008', 'Ir. Johana M.L.Fanggidae ', '', '30 Tahun 10 Bulan ', 'Kupang', '1965-06-21', 'Perempuan', '', 'Tetap', 13, '1992-03-01', '2023-07-01', 2),
(1322, '196710041989032009', 'Hartati Djamaludin, A.Md', '-', '-', 'TTU', '1967-10-04', 'Perempuan', 'Kristen', 'Tetap', 13, '0001-01-01', '0001-01-01', 2),
(1323, '196606101997032003', 'Hendrika Bhiju', '-', '-', 'Sadha ', '1966-06-01', 'Perempuan', 'Katolik', 'Tetap', 13, '0001-01-01', '0001-01-01', 2),
(1326, '-', 'Josephus Pignatelly Longa ', 'Jln. Gualodres ', '-', 'Kupang', '2005-01-06', 'Laki-Laki', '', 'Honor', 13, '2005-01-06', '2022-01-25', 2),
(1327, '-', 'Adonia Nubatonis', 'Desa wolofeo', '-', 'Kupang', '1981-03-08', 'Laki-Laki', '', 'Honor', 13, '2006-01-02', '2022-01-25', 2),
(1328, '-', 'Albinus Ku ', '', '-', 'Rai', '1971-01-21', 'Laki-Laki', '', 'Honor', 13, '2006-06-02', '2022-01-25', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pendidikan`
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
-- Dumping data untuk tabel `data_pendidikan`
--

INSERT INTO `data_pendidikan` (`id_pendidikan`, `id_pegawai`, `tahun_lulus`, `jurusan`, `pendidikan_terakhir`, `lembaga_pendidikan`, `kursus_diklat`, `pend_perjenjangan`) VALUES
(2, 1302, 2008, 'Kimia', 'S1', 'Undana', '', ''),
(3, 1303, 2008, 'Kimia', 'S1', 'Undana', '', ''),
(4, 1306, 2012, 'Kimia', 'S1', 'Undana', '', ''),
(6, 1309, 2009, 'Pertanian', 'SMA', 'Undana', '', ''),
(7, 1308, 2018, 'Ilmu Komputer', 'S1', 'Universitas Nusa Cendana', 'Kursus Bahasa Inggris, Kursus Bahasa Jerman dan Kursus Komputer', 'Pra Identifikasi Klpk sasaran PPL, Agribisnis Ternak Potong dan Teknologi  Lahan'),
(8, 1314, 2000, 'Sarjana Teknologi Pertanian', 'S1', 'Universitas Kristen Artha Wacana', '1. Pelatihan Asistensi Pemitra (2001)\r\n2. Diklat Laporan Akuntabilitas Kinerja Pemerintah Daerah (2003)\r\n3. Diklat Telaahan Staf Paripurna di Lingkungan Pemerintah Provinsi (2003)\r\n4. Pelatihan Pengaadaan Barang dan Jasa pemerintah (2004) \r\n5. Diklat Penyusun Anggaran Kinerja dan Keuangan Pemerintah Daerah (2005)\r\n6. PIM IV  ( 2008)\r\n7. PIM III (2012)', '-'),
(9, 1315, 1989, 'Pertanian', 'S1', 'Unbraq malang', '1. Pra Identifikasi Klpk Sasaran PPL (2001)\r\n2. Agribisnis Ternak Potong dan Teknologi Lahan (2006)', ''),
(10, 1316, 2000, '-', 'S2', '-', '1. PIM III (2006)\r\n2. ADUM (1996)\r\n3. Latihan Analisis Kebutuhan Komsumsi Pangan Wilayah (2006)\r\n4. Latihan Analisis Kebutuhan Komsumsi Pangan (2004)\r\n5. Latihan Pagadaan Barang dan Jasa Pemerintah (2004)\r\n6. Latihan Perencanaan Pembangunan Pertanian Secara Partisipasi (2003)\r\n7. Latihan Neraca Bahan Makanan dan Pola Pangan Harapan (2002) \r\n8. Latihan Sistem Komunikasi (1997)\r\n9. Latihan Perencanaan Program Bimas (1996) \r\n10. Latihan Manajemen Proyek( 1996) \r\n11. Latihan Jagung Hibrida (1996) \r\n12. Latihan Perencanaan Diverifikasi Pangan Gizi (1995) \r\n13. Narasumber dalam Pelatihan Peran UPTD Pengawasan dan Sertifikasi Benih Provinsi NTT dalam rangka In House  Training Kompetensi Teknis Petugas Pengambil contoh Benih (PPC) (2021)\r\n14. Narasumber dalam Pengembangan Diri, Intelektual Sosial, Peningkatan Integritas, Kempetensi dan Anti Korupsi PBT dalam melaksanakan tupoksi dan penangan kasus Pembenihan dalam rangka Kegiatan In House Training Kompetensi Teknis Pengawas Benih Tanaman (2021)', ''),
(11, 1317, 2010, 'Anggaran Pemasaran ', 'S2', 'UNWIRA Kupang', '1. Diklat Teknologi Efektif Micro Organisme (2003)\r\n2. PLTHN Sistim Informasi Perbenihan (2005)\r\n3. TOT Perbanyakan Benih Hortikultura (2006)\r\n4. Magang Permurnian Varietas Sayuran (2006)\r\n5. Magang Perbenihan Tan. Jeruk,Apeldan Tanaman Hias (2006)\r\n6. PIM IV (2003)\r\n7. PIM III (2014) ', ''),
(12, 1318, 2011, 'Teknoligi Hasil Pertanian ', 'S1', 'UGM', '1. PIM III \r\n2. PIM IV ', ''),
(13, 1319, 0000, 'Ilmu Sosial dan Ilmu Politik ', 'S1', 'Undana Kupang', '1. Bimtek Pemantauan dan Pertanggung jawaban APBD sesuai PP No 58 Tahun 2005 (2007)\r\n2. Diklatpim IV (2011)', ''),
(14, 1321, 2007, 'Sarjana Pertanian', 'S1', '-', '1. Pelatihan PL.1-SL_mutu pengolahan pemasaran hasil pertanian \r\n2. pelatihan pengawasan mutu kakao\r\n3. Pelatihan teknis otoritas kompeten keamanan pangan', '-'),
(15, 1328, 2011, 'Kimia', 'S1', 'Universitas Nusa Cendana', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pensiun`
--

CREATE TABLE `data_pensiun` (
  `id_pensiun` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tahun_pensiun` year(4) NOT NULL,
  `jabatan_terakhir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_pensiun`
--

INSERT INTO `data_pensiun` (`id_pensiun`, `id_pegawai`, `tahun_pensiun`, `jabatan_terakhir`) VALUES
(11, 1314, 2024, 'Kepala Dinas'),
(12, 1315, 2023, 'Fungsional Umum'),
(13, 1316, 2028, 'Kepala Bidang Tan Pangan dan Holtikultural'),
(14, 1317, 2023, 'Kepala Bidang Perkebunan'),
(15, 1318, 2027, 'Kepala UPTD'),
(16, 1319, 2024, 'Analis Keuangan Pusat/Daerah Ahli Muda '),
(17, 1321, 2023, 'Kasie Pengendalian Hama Terpadu pada UPT Proteksi'),
(18, 1328, 2019, 'Kepala Dinas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id_periode`, `tahun`) VALUES
(13, 2023),
(17, 2024);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `pangkat_diajukan` varchar(255) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `status` enum('tunggu','tolak','terima') NOT NULL DEFAULT 'tunggu',
  `pesan_penolakan` text DEFAULT NULL,
  `f_id_pegawai` int(11) NOT NULL,
  `verifikasi` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `pangkat_diajukan`, `dokumen`, `keterangan`, `tanggal_pengajuan`, `status`, `pesan_penolakan`, `f_id_pegawai`, `verifikasi`, `created_at`, `updated_at`) VALUES
(10, 'Reguler (Fungsional Umum)', 'CETAK DATA PEGAWAI.pdf', '', '2024-03-11', 'terima', '', 1328, '1', '2024-03-10 17:08:03', '2024-03-10 17:17:11'),
(11, 'Reguler (Fungsional Umum)', 'CETAK DATA PEGAWAI.pdf', '', '2024-03-11', 'tunggu', '', 1315, '0', '2024-03-10 17:14:21', '2024-03-10 17:14:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Administrator','Operator','Kadis') NOT NULL,
  `f_id_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`, `f_id_unit`) VALUES
(1, 'Isabela Eka Putri', 'admin', '123456', 'Administrator', 1),
(2, 'Pengguna', 'pengguna', '1', 'Operator', 2),
(3, 'Kepala Dinas', 'kadis', '1234', 'Kadis', 1),
(6, 'Dia', 'dia', 'd', 'Operator', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int(11) NOT NULL,
  `nama_profil` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_profil`
--

INSERT INTO `tb_profil` (`id_profil`, `nama_profil`, `alamat`, `bidang`) VALUES
(1, 'DINAS PERTANIAN DAN KETAHANAN PANGAN PROVINSI NTT', 'KOTA KUPANG', 'PEMERINTAHAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `nama_unit`) VALUES
(1, 'umum'),
(2, 'SUB BAGIAN PERENCAAN DATA DAN EVALUASI'),
(3, 'BIDANG TANAMAN PANGAN DAN HORTIKULTURA'),
(4, 'BIDANG PRODUKSI PERKEBUNAN'),
(5, 'BIDANG PRASARANA, SARANA  PENGOLAHAN DAN PEMASARAN HASIL PERTANIAN'),
(6, 'BIDANG KETAHANAN PANGAN DAN PENYULUHAN');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_golongan`
--
ALTER TABLE `data_golongan`
  ADD PRIMARY KEY (`id_golongan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `data_mutasi`
--
ALTER TABLE `data_mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `f_id_unit` (`f_id_unit`);

--
-- Indeks untuk tabel `data_pendidikan`
--
ALTER TABLE `data_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `data_pensiun`
--
ALTER TABLE `data_pensiun`
  ADD PRIMARY KEY (`id_pensiun`),
  ADD UNIQUE KEY `id_pegawai_2` (`id_pegawai`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `f_id_pegawai` (`f_id_pegawai`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `f_id_unit` (`f_id_unit`);

--
-- Indeks untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_golongan`
--
ALTER TABLE `data_golongan`
  MODIFY `id_golongan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `data_mutasi`
--
ALTER TABLE `data_mutasi`
  MODIFY `id_mutasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1332;

--
-- AUTO_INCREMENT untuk tabel `data_pendidikan`
--
ALTER TABLE `data_pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `data_pensiun`
--
ALTER TABLE `data_pensiun`
  MODIFY `id_pensiun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_golongan`
--
ALTER TABLE `data_golongan`
  ADD CONSTRAINT `data_golongan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_mutasi`
--
ALTER TABLE `data_mutasi`
  ADD CONSTRAINT `data_mutasi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD CONSTRAINT `data_pegawai_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_pegawai_ibfk_2` FOREIGN KEY (`f_id_unit`) REFERENCES `tb_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_pensiun`
--
ALTER TABLE `data_pensiun`
  ADD CONSTRAINT `data_pensiun_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD CONSTRAINT `tb_pengajuan_ibfk_1` FOREIGN KEY (`f_id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD CONSTRAINT `tb_pengguna_ibfk_1` FOREIGN KEY (`f_id_unit`) REFERENCES `tb_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
