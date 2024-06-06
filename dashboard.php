<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
if ($user['role'] != 'admin' && $user['role'] != 'member') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Dashboard - Selamat Datang, <?php echo htmlspecialchars($user['nama']); ?></h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <?php if ($user['role'] == 'admin'): ?>
                <li><a href="manage_books.php">Manajemen Buku</a></li>
                <li><a href="add_book.php">Tambah Buku</a></li>
                <li><a href="status_peminjaman.php">Status Peminjaman</a></li>
            <?php elseif ($user['role'] == 'member'): ?>
                <li><a href="borrow_books.php">Peminjaman Buku</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <section>
        <h2>Halaman Dashboard</h2>
        <p>Selamat datang di dashboard perpustakaan UNSRAT.</p>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>