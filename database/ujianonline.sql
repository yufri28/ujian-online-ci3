-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Agu 2023 pada 05.27
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujianonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama_user`, `username`, `password`) VALUES
(1, 'admin', 'admin', '$2y$10$lUddg4K8Xg3oeraSJzv3je4XTQF9tkExjvOnpTKhNp9NJQlF2s51G');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` varchar(20) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama_guru`, `username`, `password`) VALUES
('2147483647', 'Edwin', 'Edwin', '$2y$10$WhnZkmCPVJrYz46lLl1tXuQ5284iqrO2XKA.uFYuNA17Uf7v4JcI.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(5) NOT NULL,
  `id_peserta` int(5) NOT NULL,
  `id_soal_ujian` int(5) NOT NULL,
  `jawaban` varchar(15) NOT NULL,
  `skor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id_peserta`, `id_soal_ujian`, `jawaban`, `skor`) VALUES
(42, 27, 21, 'D', '1'),
(43, 27, 22, 'A', '1'),
(44, 28, 27, 'A', '0'),
(45, 29, 26, 'D', '0'),
(46, 30, 35, 'B', '0'),
(47, 30, 31, 'B', '1'),
(48, 30, 32, 'A', '0'),
(49, 30, 29, 'A', '0'),
(50, 30, 27, 'A', '0'),
(51, 30, 33, 'B', '0'),
(52, 30, 30, 'C', '1'),
(53, 30, 34, 'C', '0'),
(54, 30, 26, 'C', '0'),
(55, 30, 36, 'C', '0'),
(56, 30, 28, 'C', '0'),
(57, 31, 36, 'B', '1'),
(58, 31, 26, 'C', '0'),
(59, 31, 28, 'C', '0'),
(60, 31, 31, 'C', '0'),
(61, 31, 35, 'C', '1'),
(62, 31, 30, 'C', '1'),
(63, 31, 33, 'B', '0'),
(64, 31, 27, 'C', '0'),
(65, 31, 29, 'B', '1'),
(66, 31, 32, 'B', '1'),
(67, 31, 34, 'C', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_ujian`
--

CREATE TABLE `tb_jenis_ujian` (
  `id_jenis_ujian` int(11) NOT NULL,
  `jenis_ujian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_jenis_ujian`
--

INSERT INTO `tb_jenis_ujian` (`id_jenis_ujian`, `jenis_ujian`) VALUES
(1, 'UTS Ganjil '),
(3, 'UAS Genap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(7, 'Kelas A'),
(8, 'Kelas B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matapelajaran`
--

CREATE TABLE `tb_matapelajaran` (
  `id_matapelajaran` int(11) NOT NULL,
  `kode_matapelajaran` varchar(10) NOT NULL,
  `nama_matapelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_matapelajaran`
--

INSERT INTO `tb_matapelajaran` (`id_matapelajaran`, `kode_matapelajaran`, `nama_matapelajaran`) VALUES
(27, 'MP3040', 'Data Mining'),
(28, 'MP1243', 'Basis Data'),
(30, '098767', 'dasdsadasdas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jenis_ujian` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_ujian` time NOT NULL,
  `tanggal_deadline` date NOT NULL,
  `jam_deadline` time NOT NULL,
  `durasi_ujian` int(11) NOT NULL,
  `timer_ujian` int(11) NOT NULL,
  `status_ujian` tinyint(1) NOT NULL,
  `status_ujian_ujian` int(11) NOT NULL,
  `benar` varchar(20) NOT NULL,
  `salah` varchar(20) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `id_matapelajaran`, `id_siswa`, `id_jenis_ujian`, `tanggal_ujian`, `jam_ujian`, `tanggal_deadline`, `jam_deadline`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `status_ujian_ujian`, `benar`, `salah`, `nilai`) VALUES
(27, 27, 15, 1, '2023-08-22', '08:00:00', '0000-00-00', '00:00:00', 20, 1200, 2, 2, '2', '0', '100'),
(28, 27, 17, 1, '2023-08-22', '12:45:00', '0000-00-00', '00:00:00', 20, 1200, 2, 2, '0', '1', '0'),
(29, 27, 15, 1, '2023-08-22', '12:45:00', '0000-00-00', '00:00:00', 20, 1200, 2, 2, '0', '1', '0'),
(30, 27, 17, 1, '2023-08-24', '08:45:00', '0000-00-00', '00:00:00', 120, 7200, 2, 2, '2', '9', '18.1818181'),
(31, 27, 18, 1, '2023-08-25', '15:00:00', '2023-08-29', '08:00:00', 20, 1200, 2, 2, '5', '6', '45.45'),
(33, 27, 18, 3, '2023-08-25', '08:00:00', '2023-08-30', '08:00:00', 120, 7200, 1, 1, '', '', ''),
(34, 27, 18, 1, '2023-08-28', '08:00:00', '2023-08-28', '09:00:00', 20, 1200, 1, 0, '', '', ''),
(35, 27, 18, 3, '2023-08-29', '09:00:00', '2023-08-30', '09:00:00', 20, 1200, 1, 0, '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `nis` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `id_kelas`, `nama_siswa`, `nis`, `username`, `password`) VALUES
(15, 7, 'Ridwan', 23232, 'Ridwan', '$2y$10$.2qIzSVvop5NuUtB3cd4IeqnXSj1lIDdvbfSS/TCTIrn6VvnFPl5S'),
(17, 8, 'Genio', 332321, 'genio', '$2y$10$NEIywyoMgA.yuZKTtiKY6OX1x3iN7DzjrltSIJdYbMeL0PTLdBOCe'),
(18, 8, 'Edw', 232114, 'Edw', '$2y$10$Uf52x2C6rtUtGBLiNdZOwuO573WrGtMqFPtTIVSIA5zUqZQ7HIKpm'),
(19, 8, 'genio', 232123, 'genio', '$2y$10$zpnligeCV2oTYv3N3woRfef0E4/ySlgt1EDnXyW59YDI/NfUHOYvG'),
(20, 7, 'genios', 232322, 'genios', '$2y$10$vuI9cHIpszjyFLlhEjlnoOLVBp2BbbsNqYM16AFKVcfB4O54VQLiC'),
(21, 0, '', 0, '', '$2y$10$NfE5giHdSboXH9wUP77FU.A4Mb47mzPT78QTS62/6im7YOCXYsqLO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_soal_ujian`
--

CREATE TABLE `tb_soal_ujian` (
  `id_soal_ujian` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `kunci_jawaban` varchar(2) NOT NULL,
  `id_guru` varchar(20) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_soal_ujian`
--

INSERT INTO `tb_soal_ujian` (`id_soal_ujian`, `id_matapelajaran`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`, `kunci_jawaban`, `id_guru`, `id_kelas`) VALUES
(26, 27, '<p>A</p>\r\n', 'a', 'b', 'c', 'd', 'e', 'B', '2147483647', 8),
(27, 27, '<p>B</p>\r\n', 'a', 'b', 'c', 'd', 'e', 'D', '2147483647', 8),
(28, 27, '<p>Data Mining adalah proses untuk:</p>\r\n', 'Mengatur data dalam basis data', 'Menemukan pola tersembunyi dalam data', 'Mengimplementasikan algoritma Machine Learning', 'Mengubah data mentah menjadi informasi yang berguna', 'Semua salah', 'B', '2147483647', 8),
(29, 27, '<p>Apa yang dimaksud dengan &quot;data preprocessing&quot; dalam Data Mining?</p>\r\n', 'Mengumpulkan data dari berbagai sumber', 'Mengubah data mentah menjadi format yang lebih mudah dipahami', 'Menghapus data yang tidak relevan atau terduplikasi', 'Menemukan pola tersembunyi dalam data', 'Semua benar', 'B', '2147483647', 8),
(30, 27, '<p>Algoritma Apriori digunakan untuk:</p>\r\n', 'Klasifikasi data', 'Mengelompokkan data ke dalam cluster', 'Menemukan asosiasi antara item dalam dataset', 'Mengidentifikasi data yang tidak normal', 'Semua salah', 'C', '2147483647', 8),
(31, 27, '<p>Algoritma Decision Tree adalah metode yang digunakan untuk:</p>\r\n', 'Mengurangi dimensi data', 'Memprediksi kelas target berdasarkan aturan keputusan', 'Menganalisis sebaran data dalam ruang fitur', 'Menemukan aturan asosiasi dalam dataset', 'Semua benar', 'B', '2147483647', 8),
(32, 27, '<p>Apa yang dimaksud dengan \"supervised learning\" dalam Machine Learning?</p>\r\n', 'Model belajar dari data tanpa label', 'Model belajar dari data dengan label yang diketahui', 'Model belajar dengan melakukan eksplorasi interaktif pada data', 'Salah semua', 'Model belajar dengan memperhatikan feedback pengguna', 'B', '2147483647', 8),
(33, 27, '<p>Apa perbedaan antara \"clustering\" dan \"classification\" dalam Data Mining?</p>\r\n', 'Clustering mengelompokkan data berdasarkan kesamaan, sedangkan classification memprediksi label kelas', 'Clustering hanya digunakan pada data numerik, sedangkan classification pada data kategorikal', 'Clustering memerlukan data berlabel, sedangkan classification tidak', 'Clustering hanya menghasilkan hasil visual, sedangkan classification menghasilkan model prediktif', 'Benar semua', 'A', '2147483647', 8),
(34, 27, '<p>Apa yang dimaksud dengan \"association rule\" dalam Data Mining?</p>\r\n', 'Aturan yang menghubungkan atribut dengan tingkat kepercayaan tertentu', 'Salah semua', 'Aturan yang menentukan urutan langkah-langkah dalam proses Data Mining', 'Aturan yang menentukan penggunaan algoritma tertentu untuk jenis data tertentu', 'Aturan yang mengidentifikasi outlier dalam dataset', 'A', '2147483647', 8),
(35, 27, '<p>Metode \"k-fold cross-validation\" digunakan untuk</p>\r\n', 'Menggabungkan dua dataset yang berbeda', 'Mengurangi dimensi data', 'Menilai kinerja model dengan membagi data menjadi subset yang saling tumpang tindih', 'Mencari pola frekuensi itemset dalam dataset', 'Menghilangkan data yang tidak relevan dalam dataset', 'C', '2147483647', 8),
(36, 27, '<p>Apa yang dimaksud dengan \"data discretization\" dalam Data Mining?</p>\r\n', 'Menghilangkan data yang tidak relevan dalam dataset', 'Mengubah data kontinu menjadi data diskret', 'Menggabungkan data dari sumber yang berbeda', 'Menemukan pola tersembunyi dalam data', 'Menemukan pola tersembunyi dalam data', 'B', '2147483647', 8);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_soal_ujian` (`id_soal_ujian`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  ADD PRIMARY KEY (`id_jenis_ujian`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  ADD PRIMARY KEY (`id_matapelajaran`);

--
-- Indeks untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_matakuliah` (`id_matapelajaran`),
  ADD KEY `id_mahasiswa` (`id_siswa`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nim` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD PRIMARY KEY (`id_soal_ujian`),
  ADD KEY `id_matakuliah` (`id_matapelajaran`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id_jenis_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  MODIFY `id_matapelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD CONSTRAINT `tb_peserta_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_peserta_ibfk_2` FOREIGN KEY (`id_matapelajaran`) REFERENCES `tb_matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD CONSTRAINT `tb_soal_ujian_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_soal_ujian_ibfk_2` FOREIGN KEY (`id_matapelajaran`) REFERENCES `tb_matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_soal_ujian_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
