<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.html");
    exit();
}

include 'functions.php';
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteBook($id)) {
        header("Location: manage_books.php");
    } else {
        echo "Gagal menghapus buku.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Buku - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Hapus Buku</h1>
    </header>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_books.php">Manajemen Buku</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <section>
        <h2>Konfirmasi Penghapusan Buku</h2>
        <p>Apakah Anda yakin ingin menghapus buku ini?</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
            <button type="submit">Hapus</button>
            <a href="manage_books.php">Batal</a>
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>