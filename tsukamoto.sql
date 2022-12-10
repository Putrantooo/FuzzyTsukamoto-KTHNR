-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2022 pada 20.58
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsukamoto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username_admin`, `password_admin`) VALUES
(1, 'Ferdlian Wakhid', 'mustakim', 'a3d9d26ef7dc2e82f69f727fb5072b7a'),
(4, 'akuu', 'aku', 'ebecc5ce76c90aafecf19145833fd0f2'),
(5, 'Sutarman', 'PakMaman', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id_aturan` int(11) NOT NULL,
  `nama_aturan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aturan`
--

INSERT INTO `aturan` (`id_aturan`, `nama_aturan`) VALUES
(56, 'R1'),
(57, 'R2'),
(58, 'R3'),
(59, 'R4'),
(60, 'R5'),
(61, 'R6'),
(62, 'R7'),
(63, 'R8'),
(64, 'R9'),
(65, 'R10'),
(66, 'R11'),
(67, 'R12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_aturan`
--

CREATE TABLE `detail_aturan` (
  `id_detail_aturan` int(11) NOT NULL,
  `id_aturan` int(11) NOT NULL,
  `id_himpunan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_aturan`
--

INSERT INTO `detail_aturan` (`id_detail_aturan`, `id_aturan`, `id_himpunan`) VALUES
(259, 56, 21),
(260, 56, 24),
(261, 56, 26),
(262, 56, 28),
(263, 57, 21),
(264, 57, 24),
(265, 57, 27),
(266, 57, 28),
(267, 58, 21),
(268, 58, 25),
(269, 58, 26),
(270, 58, 28),
(271, 59, 21),
(272, 59, 25),
(273, 59, 27),
(274, 59, 28),
(275, 60, 22),
(276, 60, 24),
(277, 60, 26),
(278, 60, 28),
(279, 61, 22),
(280, 61, 24),
(281, 61, 27),
(282, 61, 28),
(283, 62, 22),
(284, 62, 25),
(285, 62, 26),
(286, 62, 28),
(287, 63, 22),
(288, 63, 25),
(289, 63, 27),
(290, 63, 28),
(291, 64, 23),
(292, 64, 24),
(293, 64, 26),
(294, 64, 29),
(295, 65, 23),
(296, 65, 24),
(297, 65, 27),
(298, 65, 29),
(299, 66, 23),
(300, 66, 25),
(301, 66, 26),
(302, 66, 29),
(303, 67, 23),
(304, 67, 25),
(305, 67, 27),
(306, 67, 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `jumlah_hasil` int(11) NOT NULL,
  `rekomendasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_pemesan`, `jumlah_hasil`, `rekomendasi`) VALUES
(65, 71, 30533, 'Produksi memenuhi'),
(68, 74, 28891, 'Produksi memenuhi'),
(69, 75, 26453, 'Produksi memenuhi'),
(72, 78, 30533, 'Produksi memenuhi'),
(73, 79, 28266, 'Produksi memenuhi'),
(76, 82, 28506, 'Produksi memenuhi'),
(80, 86, 24185, 'Produksi memenuhi'),
(82, 88, 37279, 'Produksi tidak memenuhi'),
(83, 89, 10000, 'Produksi memenuhi'),
(84, 90, 37279, 'Produksi tidak memenuhi'),
(85, 91, 10000, 'Produksi memenuhi'),
(86, 92, 10000, 'Produksi memenuhi'),
(87, 93, 26436, 'Produksi memenuhi'),
(88, 94, 10000, 'Produksi memenuhi'),
(89, 95, 15112, 'Produksi memenuhi'),
(90, 96, 33684, 'Produksi memenuhi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `himpunan`
--

CREATE TABLE `himpunan` (
  `id_himpunan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_himpunan` enum('min','tengah','max') NOT NULL,
  `nilai_himpunan` int(11) NOT NULL,
  `keterangan_himpunan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `himpunan`
--

INSERT INTO `himpunan` (`id_himpunan`, `id_kriteria`, `nama_himpunan`, `nilai_himpunan`, `keterangan_himpunan`) VALUES
(21, 1, 'min', 10000, 'Sedikit'),
(22, 1, 'tengah', 11000, 'Sedang'),
(23, 1, 'max', 55000, 'Banyak'),
(24, 2, 'min', 10000, 'Sedikit'),
(25, 2, 'max', 50000, 'Banyak'),
(26, 3, 'min', 50000, 'Sedikit'),
(27, 3, 'max', 135000, 'Banyak'),
(28, 11, 'min', 10000, 'Sedikit'),
(29, 11, 'max', 55000, 'Banyak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inputan`
--

CREATE TABLE `inputan` (
  `id_inputan` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_inputan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inputan`
--

INSERT INTO `inputan` (`id_inputan`, `id_pemesan`, `id_kriteria`, `nilai_inputan`) VALUES
(168, 41, 1, 801),
(169, 41, 2, 650),
(170, 41, 3, 700),
(180, 44, 1, 812),
(181, 44, 2, 400),
(182, 44, 3, 350),
(184, 45, 1, 900),
(185, 45, 2, 325),
(186, 45, 3, 500),
(188, 46, 1, 1000),
(189, 46, 2, 320),
(190, 46, 3, 340),
(192, 47, 1, 1200),
(193, 47, 2, 592),
(194, 47, 3, 630),
(196, 48, 1, 930),
(197, 48, 2, 415),
(198, 48, 3, 332),
(200, 49, 1, 832),
(201, 49, 2, 321),
(202, 49, 3, 351),
(204, 50, 1, 1100),
(205, 50, 2, 315),
(206, 50, 3, 329),
(208, 51, 1, 623),
(209, 51, 2, 650),
(210, 51, 3, 400),
(212, 52, 1, 688),
(213, 52, 2, 630),
(214, 52, 3, 345),
(216, 53, 1, 401),
(217, 53, 2, 310),
(218, 53, 3, 512),
(220, 54, 1, 441),
(221, 54, 2, 322),
(222, 54, 3, 344),
(224, 55, 1, 600),
(225, 55, 2, 630),
(226, 55, 3, 640),
(228, 56, 1, 745),
(229, 56, 2, 534),
(230, 56, 3, 328),
(232, 57, 1, 631),
(233, 57, 2, 312),
(234, 57, 3, 638),
(236, 58, 1, 800),
(237, 58, 2, 322),
(238, 58, 3, 347),
(240, 59, 1, 400),
(241, 59, 2, 561),
(242, 59, 3, 421),
(244, 60, 1, 345),
(245, 60, 2, 400),
(246, 60, 3, 344),
(248, 61, 1, 201),
(249, 61, 2, 324),
(250, 61, 3, 501),
(252, 62, 1, 178),
(253, 62, 2, 317),
(254, 62, 3, 322),
(256, 63, 1, 339),
(257, 63, 2, 591),
(258, 63, 3, 570),
(260, 64, 1, 190),
(261, 64, 2, 360),
(262, 64, 3, 349),
(264, 65, 1, 234),
(265, 65, 2, 321),
(266, 65, 3, 400),
(268, 66, 1, 290),
(269, 66, 2, 313),
(270, 66, 3, 346),
(272, 67, 1, 7700),
(273, 67, 2, 65000),
(274, 67, 3, 22000),
(275, 68, 1, 25000),
(276, 68, 2, 7700),
(277, 68, 3, 65000),
(278, 69, 1, 11000),
(279, 69, 2, 4200),
(280, 69, 3, 26700),
(281, 70, 1, 32000),
(282, 70, 2, 3200),
(283, 70, 3, 96000),
(284, 71, 1, 30000),
(285, 71, 2, 21200),
(286, 71, 3, 22000),
(287, 72, 1, 11000),
(288, 72, 2, 4200),
(289, 72, 3, 26700),
(290, 73, 1, 45000),
(291, 73, 2, 4200),
(292, 73, 3, 82000),
(293, 74, 1, 25000),
(294, 74, 2, 5000),
(295, 74, 3, 100000),
(296, 75, 1, 25000),
(297, 75, 2, 7700),
(298, 75, 3, 65000),
(299, 76, 1, 11000),
(300, 76, 2, 4200),
(301, 76, 3, 26700),
(302, 77, 1, 32000),
(303, 77, 2, 3200),
(304, 77, 3, 96000),
(305, 78, 1, 30000),
(306, 78, 2, 21200),
(307, 78, 3, 22000),
(308, 79, 1, 20000),
(309, 79, 2, 1200),
(310, 79, 3, 86000),
(311, 80, 1, 25000),
(312, 80, 2, 6200),
(313, 80, 3, 39000),
(314, 81, 1, 27000),
(315, 81, 2, 3200),
(316, 81, 3, 54000),
(317, 82, 1, 15000),
(318, 82, 2, 6200),
(319, 82, 3, 82000),
(320, 83, 1, 18000),
(321, 83, 2, 9200),
(322, 83, 3, 43000),
(323, 84, 1, 35000),
(324, 84, 2, 11200),
(325, 84, 3, 97000),
(326, 85, 1, 11000),
(327, 85, 2, 1200),
(328, 85, 3, 47000),
(329, 86, 1, 22000),
(330, 86, 2, 5200),
(331, 86, 3, 65000),
(332, 87, 1, 24000),
(333, 87, 2, 3200),
(334, 87, 3, 40000),
(335, 88, 1, 45000),
(336, 88, 2, 4200),
(337, 88, 3, 82000),
(338, 89, 1, 11000),
(339, 89, 2, 1200),
(340, 89, 3, 47000),
(341, 90, 1, 45000),
(342, 90, 2, 4200),
(343, 90, 3, 82000),
(344, 91, 1, 9000),
(345, 91, 2, 4200),
(346, 91, 3, 32000),
(347, 92, 1, 7000),
(348, 92, 2, 5200),
(349, 92, 3, 14000),
(350, 93, 1, 24000),
(351, 93, 2, 3200),
(352, 93, 3, 72000),
(353, 94, 1, 10000),
(354, 94, 2, 9200),
(355, 94, 3, 24000),
(356, 95, 1, 16000),
(357, 95, 2, 7200),
(358, 95, 3, 36000),
(359, 96, 1, 35000),
(360, 96, 2, 3200),
(361, 96, 3, 81000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `status_kriteria` enum('input','output') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `status_kriteria`) VALUES
(1, 'Permintaan', 'input'),
(2, 'Persediaan ', 'input'),
(3, 'Bahan baku ', 'input'),
(11, 'Produksi', 'output');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `tanggal_pemesan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `nama_pemesan`, `tanggal_pemesan`) VALUES
(41, 'baba', '2021-03-04'),
(44, 'jojo', '2021-03-05'),
(45, 'tomi', '2021-03-12'),
(46, 'toni', '2021-03-18'),
(47, 'noni', '2021-03-23'),
(48, 'novi', '2021-03-29'),
(49, 'gunawann', '2021-04-09'),
(50, 'jamen', '2021-04-15'),
(51, 'janokoo', '2021-04-15'),
(52, 'manis', '2021-04-21'),
(53, 'ameliaa', '2021-04-25'),
(54, 'anaa', '2021-04-25'),
(55, 'eka', '2021-04-30'),
(56, 'asri', '2021-05-06'),
(57, 'anisaa', '2021-05-10'),
(58, 'vivin', '2021-05-11'),
(59, 'khusnul', '2021-05-14'),
(60, 'subur', '2021-05-21'),
(61, 'dion', '2021-05-21'),
(62, 'arik', '2021-05-24'),
(63, 'joko santoso', '2021-05-26'),
(64, 'joko sidik abraham', '2021-05-28'),
(65, 'anditaa', '2021-06-02'),
(66, 'hanik tri', '2021-06-04'),
(67, '25000', '2022-08-26'),
(68, 'putut wijanarko', '2022-08-26'),
(69, 'Husnul Rofik', '2022-08-26'),
(70, 'Joko Saputra', '2022-08-26'),
(71, 'Ritfan Novi Gunawan', '2022-08-26'),
(72, 'putut wijanarko', '2022-08-28'),
(73, 'Joko Saputra', '2022-08-29'),
(74, 'Joko Saputra', '2022-09-06'),
(75, 'Widodo', '2022-09-06'),
(76, 'KARMILAH', '2022-09-06'),
(77, 'SILVIA NUR WIDYASTUTI', '2022-09-06'),
(78, 'SUNARTO', '2022-09-06'),
(79, 'SARBINI', '2022-09-06'),
(80, 'DANIK FEBRI ASTUTI', '2022-09-06'),
(81, 'NEDIANTO', '2022-09-06'),
(82, 'SUPRIHATI', '2022-09-06'),
(83, 'MAULANA SIDIQ', '2022-09-06'),
(84, 'SISWO PAWIRO', '2022-09-06'),
(85, 'PUNIYAH', '2022-09-06'),
(86, 'TUKIMAN', '2022-09-06'),
(87, 'BARIYAH', '2022-09-06'),
(88, 'HERI SUSANTO', '2022-09-06'),
(89, 'DANU SETIYAWAN', '2022-09-06'),
(90, 'JOWARTONO', '2022-09-06'),
(91, 'JUMINEM', '2022-09-06'),
(92, 'PURWADI', '2022-09-06'),
(93, 'WARSIYEM', '2022-09-06'),
(94, 'ALENA PUTRI APRELIA', '2022-09-06'),
(95, 'AGIT LISTIYANI', '2022-09-06'),
(96, 'EFENDI', '2022-09-06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id_aturan`);

--
-- Indeks untuk tabel `detail_aturan`
--
ALTER TABLE `detail_aturan`
  ADD PRIMARY KEY (`id_detail_aturan`),
  ADD KEY `id_aturan` (`id_aturan`),
  ADD KEY `id_himpunan` (`id_himpunan`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_pemesan` (`id_pemesan`);

--
-- Indeks untuk tabel `himpunan`
--
ALTER TABLE `himpunan`
  ADD PRIMARY KEY (`id_himpunan`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `inputan`
--
ALTER TABLE `inputan`
  ADD PRIMARY KEY (`id_inputan`),
  ADD KEY `id_pemesan` (`id_pemesan`),
  ADD KEY `id_himpunan` (`id_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `detail_aturan`
--
ALTER TABLE `detail_aturan`
  MODIFY `id_detail_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `himpunan`
--
ALTER TABLE `himpunan`
  MODIFY `id_himpunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `inputan`
--
ALTER TABLE `inputan`
  MODIFY `id_inputan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id_pemesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_aturan`
--
ALTER TABLE `detail_aturan`
  ADD CONSTRAINT `detail_aturan_ibfk_1` FOREIGN KEY (`id_aturan`) REFERENCES `aturan` (`id_aturan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_aturan_ibfk_2` FOREIGN KEY (`id_himpunan`) REFERENCES `himpunan` (`id_himpunan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`);

--
-- Ketidakleluasaan untuk tabel `himpunan`
--
ALTER TABLE `himpunan`
  ADD CONSTRAINT `himpunan_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `inputan`
--
ALTER TABLE `inputan`
  ADD CONSTRAINT `inputan_ibfk_2` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inputan_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
