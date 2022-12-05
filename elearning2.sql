-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 11:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning2`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `nim` int(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `matkul` int(20) NOT NULL,
  `pertemuan` int(2) NOT NULL,
  `tanggal` int(20) NOT NULL,
  `status_absen` enum('Hadir','Tidak Hadir') NOT NULL DEFAULT 'Tidak Hadir',
  `status` enum('Belum Selesai','Sudah Selesai') NOT NULL DEFAULT 'Belum Selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `nim`, `kelas`, `matkul`, `pertemuan`, `tanggal`, `status_absen`, `status`) VALUES
(16, 15200318, '15.5B.01', 1, 1, 1669434323, 'Hadir', 'Sudah Selesai'),
(17, 15200318, '15.5B.01', 4, 1, 1669606100, 'Hadir', 'Sudah Selesai'),
(18, 15200318, '15.5B.01', 1, 2, 1670130167, 'Tidak Hadir', 'Sudah Selesai'),
(19, 15200318, '15.5B.01', 1, 3, 1670139476, 'Hadir', 'Sudah Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` int(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempatlahir` varchar(100) NOT NULL,
  `tanggallahir` varchar(100) NOT NULL,
  `jkel` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `tempatlahir`, `tanggallahir`, `jkel`, `email`, `alamat`) VALUES
(122, 'debay', 'Bekasi', '01 Januari 2000', 'Pria', 'debay@gmail.com', 'asd'),
(123, 'Fadhil', 'Bekasi', '01 Januari 2000', 'Pria', 'fadhil@gmail.com', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempatlahir` varchar(100) NOT NULL,
  `tanggallahir` varchar(100) NOT NULL,
  `jkel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `semester` int(2) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `tempatlahir`, `tanggallahir`, `jkel`, `email`, `fakultas`, `prodi`, `semester`, `kelas`, `alamat`) VALUES
(15200318, 'Muhamad Al Fadhil Satria', 'Bekasi', '01 Januari 2000', 'Pria', 'fadhilsatria789@gmail.com', 'Teknik dan Informatika', 'Ilmu Komputer', 5, '15.5B.01', 'Klapanunggal'),
(15200319, 'Debay', 'Bekasi', '01 Januari 2000', 'Pria', 'debay@gmail.com', 'Komunikasi dan Bahasa', 'Ilmu Komunikasi', 5, '15.5A.01', ''),
(15200320, 'Tommy', 'Bekasi', '01 Januari 2000', 'Pria', '15200320@gmail.com', 'Teknik dan Informatika', 'Ilmu Komputer', 3, '15.3B.01', '');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `matakuliah` varchar(50) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `nip` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id`, `prodi`, `matakuliah`, `kelas`, `nip`) VALUES
(1, 'Ilmu Komputer', 'Web Programming', '15.5B.01', 123),
(2, 'Ilmu Komunikasi', 'Komunikasi Tradisional', '14.5B.01', 123),
(3, 'Ilmu Komputer', 'Web Programming', '15.5A.01', 123),
(4, 'Ilmu Komputer', 'Mobile', '15.5B.01', 123),
(5, 'Ilmu Komputer', 'Pemrograman Berbasis Obyek', '15.5B.01', 122);

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `nip` int(50) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `matakuliah` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `pertemuan` varchar(100) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `nip`, `prodi`, `matakuliah`, `kelas`, `tanggal`, `pertemuan`, `judul`, `deskripsi`, `link`) VALUES
(11, 123, 'Ilmu Ekonomi', 'Komunikasi Tradisional', '14.5B.01', '1669337030', '1', 'pt 1', 'tes', 'asdsad'),
(16, 123, 'Ilmu Komputer', 'Web Programming', '15.5B.01', '1669638317', '2', 'tessis', 'silakan disimak video berikut!!!aa', 'https://google.com'),
(18, 122, 'Ilmu Komputer', 'Pemrograman Berbasis Obyek', '15.5B.01', '1670159905', '1', 'testing', 'baca', 'pbo.com');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(100) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `nim` int(100) NOT NULL,
  `nip` int(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `matakuliah` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `pertemuan` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `komentar` varchar(100) NOT NULL,
  `nilai` int(10) NOT NULL,
  `is_nilai` int(10) NOT NULL DEFAULT 0,
  `tugas_created` int(20) NOT NULL,
  `created` int(20) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_tugas`, `nim`, `nip`, `prodi`, `matakuliah`, `kelas`, `pertemuan`, `judul`, `link`, `komentar`, `nilai`, `is_nilai`, `tugas_created`, `created`, `updated`) VALUES
(25, 12, 15200318, 123, 'Ilmu Komputer', 'Mobile', '15.5B.01', '1', 'Pertemuan 1', 'asdasdasdasd', 'ok deh', 75, 1, 1669682996, 1670138253, 1670145068),
(26, 13, 15200318, 122, 'Ilmu Komputer', 'Pemrograman Berbasis Obyek', '15.5B.01', '1', 'Tugas Pertemuan 1', 'yak', 'wokey', 99, 1, 1670159927, 1670160729, 1670160762),
(27, 11, 15200318, 123, 'Ilmu Komputer', 'Web Programming', '15.5B.01', '1', 'Pertemuan 1', 'https://drive.google.com', '', 0, 0, 1669682996, 1670214876, 1670214876);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(5) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'dosen'),
(3, 'mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(100) NOT NULL,
  `nip` int(100) NOT NULL,
  `prodi` varchar(200) NOT NULL,
  `matakuliah` varchar(200) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `pertemuan` int(10) NOT NULL,
  `tanggal` int(20) NOT NULL,
  `link` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nip`, `prodi`, `matakuliah`, `kelas`, `judul`, `deskripsi`, `pertemuan`, `tanggal`, `link`) VALUES
(11, 123, 'Ilmu Komputer', 'Web Programming', '15.5B.01', 'Pertemuan 1', 'Silakan dibaca y', 1, 1669682996, 'https://drive.google.com'),
(12, 123, 'Ilmu Komputer', 'Mobile', '15.5B.01', 'Pertemuan 1', 'Silakan dibacaa', 1, 1669682996, 'https://drive.google.com'),
(13, 122, 'Ilmu Komputer', 'Pemrograman Berbasis Obyek', '15.5B.01', 'Tugas Pertemuan 1', 'goodluck', 1, 1670159927, 'pbo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) CHARACTER SET latin1 NOT NULL,
  `password` varchar(256) CHARACTER SET latin1 NOT NULL,
  `image` varchar(128) CHARACTER SET latin1 NOT NULL DEFAULT 'default.jpg',
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `image`, `role_id`, `is_active`, `tanggal_input`) VALUES
(1, 'admin', '704b037a97fa9b25522b7c014c300f8a', 'default.jpg', 1, 1, 0),
(16, '123', '202cb962ac59075b964b07152d234b70', 'default.jpg', 2, 1, 1664178185),
(17, '15200318', '202cb962ac59075b964b07152d234b70', '1669603687_214ee9dd40967e787311.jpg', 3, 1, 1669281078),
(18, '15200319', '202cb962ac59075b964b07152d234b70', 'default.jpg', 3, 1, 1669285765),
(19, '122', '202cb962ac59075b964b07152d234b70', 'default.jpg', 2, 1, 1664178185),
(21, '15200320', '202cb962ac59075b964b07152d234b70', 'default.jpg', 3, 1, 1670210678);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim_absen` (`nim`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip_matkul` (`nip`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip_materi` (`nip`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim_nilai` (`nim`),
  ADD KEY `nip_nilai` (`nip`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_user` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `nim_absen` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `nip_matkul` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `nip_materi` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nim_nilai` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `nip_nilai` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role_user` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
