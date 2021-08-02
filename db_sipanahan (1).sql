-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 02:30 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipanahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `alat` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kondisi` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `alat`, `user_id`, `kondisi`, `jenis`, `image`) VALUES
(2, 'Busur Panah 1', 20, 2, 2, 'assets/img/alat/1624871980OIP.jpg'),
(3, 'Anak Panah', 20, 1, 1, 'assets/img/alat/1624872308vision_anak_panah_bambu_per_lusin_vanes_spon_poin_natural_-_arrow_bambu_full05_opn7fw0y.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bonus` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`id`, `user_id`, `tanggal`, `bonus`, `jumlah`, `ket`) VALUES
(2, 20, '2021-07-08', 'Bonus Menang Juara 1', 200000, 'Dompdf adalah sebuah library yang akan kita gunakan untuk mengubah sebuah dokumen HTML menjadi PDF. Untuk menggunakan dompdf kita perlu menginstalnya terlebih dahulu menggunakan composer.'),
(4, 22, '2021-07-08', 'Bonus Menang Pelatih Juara 11', 200000, 'INI BONUS'),
(5, 23, '2021-07-01', 'Bonus Menang Pelatih Juara 11', 100000, 'esfjaojfpcnebvae  woeotckemntibah einajme aejklnjale et');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(10) NOT NULL,
  `dokumen` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `dokumen`, `status`) VALUES
(4, 'Surat Pajak', 0),
(5, 'KTP', 1),
(7, 'Surat Tanah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id` int(11) NOT NULL,
  `latihan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id`, `latihan_id`, `user_id`, `nilai`) VALUES
(3, 0, 20, 0),
(5, 2, 20, 0),
(6, 4, 23, 8);

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE `lampiran` (
  `id` int(11) NOT NULL,
  `nama_dok` varchar(100) NOT NULL,
  `no_dok` int(11) NOT NULL,
  `tgl_dok` date NOT NULL,
  `id_permohonan` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lampiran`
--

INSERT INTO `lampiran` (`id`, `nama_dok`, `no_dok`, `tgl_dok`, `id_permohonan`, `status`) VALUES
(12, 'KTP', 2147483647, '2020-05-15', '15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `latihan`
--

CREATE TABLE `latihan` (
  `id` int(11) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `latihan`
--

INSERT INTO `latihan` (`id`, `tempat`, `tanggal`, `waktu`, `user_id`, `deskripsi`) VALUES
(2, 'Lapangan Pemuda 1', '2021-07-01', '19:21:00', 22, 'Latihan Untuk Tanding Cuy'),
(4, 'Lapangan Pemuda', '2021-07-09', '20:00:00', 22, 'Latihan Untuk ke turnamen Dunia');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `n1` int(11) NOT NULL,
  `n2` int(11) NOT NULL,
  `n3` int(11) NOT NULL,
  `n4` int(11) NOT NULL,
  `n5` int(11) NOT NULL,
  `n6` int(11) NOT NULL,
  `n7` int(11) NOT NULL,
  `n8` int(11) NOT NULL,
  `n9` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `penilai` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `n1`, `n2`, `n3`, `n4`, `n5`, `n6`, `n7`, `n8`, `n9`, `user_id`, `penilai`, `tanggal`) VALUES
(1, 2, 3, 7, 8, 5, 7, 6, 7, 5, 23, 5, '2021-07-22'),
(2, 10, 9, 8, 7, 8, 7, 9, 8, 8, 20, 5, '2021-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `pertandingan`
--

CREATE TABLE `pertandingan` (
  `id` int(11) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `tingkat` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertandingan`
--

INSERT INTO `pertandingan` (`id`, `tempat`, `tanggal`, `waktu`, `user_id`, `tingkat`, `deskripsi`) VALUES
(2, 'Lapangan Pemuda', '2021-07-09', '20:00:00', 22, 3, 'srgagagaga aeaegagaga aegagadga ');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id` int(11) NOT NULL,
  `prestasi` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tingkat` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id`, `prestasi`, `user_id`, `tingkat`, `tanggal`) VALUES
(2, 'Juara 1', 23, 1, '2021-07-01'),
(3, 'Juara 1', 20, 1, '2021-07-02'),
(4, 'Juara 1', 23, 1, '2021-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `app` varchar(100) NOT NULL,
  `bunga` int(11) NOT NULL,
  `ttd1` varchar(100) NOT NULL,
  `ttd2` varchar(100) NOT NULL,
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `app`, `bunga`, `ttd1`, `ttd2`, `image1`, `image2`) VALUES
(1, 'Sistem SIPSP3', 20, 'AbdullahJoe Star ', 'Muhammad Dio Ramadhan', 'assets/img/default-user.svg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `id` int(11) NOT NULL,
  `tim` varchar(50) NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `cabang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`id`, `tim`, `lokasi`, `cabang`) VALUES
(2, 'Banjar Archery', 'Jalan Alalak Utara, ', 'Alalak Utara'),
(3, 'Archery Sport Banjarmasin', 'Jalan Sutoyo S', 'Banjarmasin'),
(4, 'Tim 1', 'Jalan Blabla bla bla', 'Banjarmasin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tim_id` int(11) DEFAULT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `level`, `status`, `tim_id`, `image`) VALUES
(5, 'Administrator', 'adminku@gmail.com', 'admin', '$2y$08$mofiHIg9WLBh1F0Io58/nuqZ6mQPyNkfpwWqfwCwlObGVk.8.o.J.', 1, 1, NULL, 'assets/img/user/1589219023admin---mitra.png'),
(13, 'Tester3', 'tester3@mail.com', 'tester3', 'tester3', 1, 0, NULL, 'assets/img/user/1589110261login.png'),
(14, 'Staff 1', 'staff@gmail.com', 'staff', '$2y$08$mofiHIg9WLBh1F0Io58/nuqZ6mQPyNkfpwWqfwCwlObGVk.8.o.J.', 2, 1, NULL, 'assets/img/user/1589295844boy.svg'),
(20, 'Anggota 212', 'anggota3@gmail.com', 'anggota3', '$2a$08$YAvbM6SNX7y40bdIy/2gg.27zvhPf9T5gOJ8TjTcn8U7/iN7wQtOG', 3, 1, 2, 'assets/img/user/16256777011624349640274.png'),
(22, 'Pelatih 1', 'pelatih1@gmail.com', 'pelatih1', '$2a$08$4l9uaNZIzKWb8KgyZvPTF.mPijvV6c.pS/3KIfgBqxAuRwy0OPaki', 2, 1, 2, 'assets/img/user/16248689751624340409827.png'),
(23, 'Anggota Baru', 'anggotabaru@gmail.com', 'anggotabaru', '$2a$08$W.k/5c29kd2CUP4AJQuPROAxwnZcVVJpbkbixeG03ufZqFaLQb20m', 3, 1, 3, 'assets/img/user/1625744128card2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latihan`
--
ALTER TABLE `latihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `latihan`
--
ALTER TABLE `latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pertandingan`
--
ALTER TABLE `pertandingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
