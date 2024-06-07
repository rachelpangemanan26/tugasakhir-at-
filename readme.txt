public:
about.php
daftar.php
index.php
login.php
logout.php
proses_daftar.php
proses_login.php
functions.php
db_config.php
admin:
add_book.php
dashboard.php
delete_book.php
edit_book.php
status_peminjaman.php
manage_books.php
member:
borrow_books.php
proses_pinjam.php
dashboard.php
database library tables:
CREATE TABLE `books'
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `isbn` varchar(30) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)

CREATE TABLE `borrowings`
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)

CREATE TABLE `users`
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') DEFAULT 'member',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
