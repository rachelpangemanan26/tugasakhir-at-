-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 06:59 PM
-- Server version: 11.1.2-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `isbn` varchar(30) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `genre`, `isbn`, `cover_image`, `quantity`) VALUES
(2, 'Harry Potter Dan Kamar Rahasia', 'J.K Rowling', 'Harry Potter sudah tidak tahan lagi melewati liburan musim panas bersama keluaraga Dursley yang menyebalkan dan dia ingin sekali bisa segera kembali ke Sekolah Sihir Hogwarts.', 'Fantasi', '0-7475-3849-2', '2444499_d7fdb326-be84-4961-a028-f4bf29cdd600.jpg', 5),
(3, '	Sherlock Holmes : a study in scarlet', 'Doyle, Arthur Conan', '	A study in scarlet merupakan novel fiksi detektif karya Sir Arthur Conan Doyle yang memperkenalkan tokoh detektif konsultan rekaannya, Sherlock Holmes, serta sahabat petualangannya, dr. Watson, yang kelak akan menjadi dua tokoh detektif paling terkenal dalam dunia sastra. Awalanya mereka kedatangan seorang klien untuk mengungkap kasus pembunuhan misterius. Ditemukan sosok mayat yang meninggal tak wajar, tanpa ada barang bukti pembunuhan. Sherlock Holmes dengan sigap mencoba mengurai semuanya. Melacak jejak pelaku, bukti-bukti yang ada di sekitar kejadian, juga motif pembunuhan.', 'Misteri', '978-602-17857-7-5', '1149668.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`id`, `user_id`, `book_id`, `borrow_date`, `return_date`) VALUES
(1, 4, 2, '2024-06-07 00:00:51', '2024-06-07 00:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`) VALUES
(3, 'Rachel Pangemanan', 'thatonegirl', '$2y$10$3xmMR.rtiFmbL7dN5hMF0.CHt1Vn3kc5tWJ4iWhPIcQu63Nf2M/mq', 'admin'),
(4, 'Rachel Pangemanan', 'burubururin', '$2y$10$5kqCkOCbKOJRhwW1Gk50d.YfMgpGufW2pG3jdfIndNRCJWZLgpRpC', 'member'),
(5, 'John Doe', 'memikat', '$2y$10$x2yVRBWmAoYrcxPUrLtW6u8dsLYU7YbZXteiVzxBLp3kn26pVpE8i', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
