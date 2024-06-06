<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Anggota Kelompok</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Tentang Anggota Kelompok Kami</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="about.php">About</a></li>
            <?php
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                if ($user['role'] == 'admin') {
                    echo '<li><a href="manage_books.php">Manajemen Buku</a></li>';
                    echo '<li><a href="add_book.php">Tambah Buku</a></li>';
                    echo '<li><a href="status_peminjaman.php">Status Peminjaman</a></li>';
                } elseif ($user['role'] == 'member') {
                    echo '<li><a href="borrow_books.php">Peminjaman Buku</a></li>';
                }
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="daftar.php">Daftar</a></li>';
            }
            ?>
        </ul>
    </nav>
    <section class="about-section">
        <h2>Anggota Kelompok</h2>
        <div class="member">
            <h3>Anggota 1</h3>
            <p>Nama: Happy Pricillia Wongkar</p>
            <p>NIM: 220211060009</p>
            <p>Tulis deskripsi anda disini</p>
        </div>
        <div class="member">
            <h3>Anggota 2</h3>
            <p>Nama: Eugenia Eklesia Kansil</p>
            <p>NIM: 220211060034</p>
            <p>Tulis deskripsi anda disini</p>
        </div>
        <div class="member">
            <h3>Anggota 3</h3>
            <p>Nama: Rachel Junita Pangemanan</p>
            <p>NIM: 220211060110</p>
            <p>Tulis deskripsi anda disini</p>
        </div>
        <div class="member">
            <h3>Anggota 4</h3>
            <p>Nama: Mozart Immanuel Kereh</p>
            <p>NIM: 7220211060236</p>
            <p>Tulis deskripsi anda disini</p>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>
