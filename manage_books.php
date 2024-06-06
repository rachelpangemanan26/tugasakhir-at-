<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'functions.php';
include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Manajemen Buku - Selamat Datang, <?php echo htmlspecialchars($_SESSION['user']['nama']); ?></h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_books.php">Manajemen Buku</a></li>
            <li><a href="add_book.php">Tambah Buku</a></li>
            <li><a href="status_peminjaman.php">Status Peminjaman</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <section>
        <h2>Manajemen Buku</h2>
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Deskripsi</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                    <th>Foto Sampul</th>
                    <th>Kuantitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $books = $conn->query("SELECT * FROM books")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($books as $book) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($book['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($book['author']) . "</td>";
                    echo "<td>" . htmlspecialchars($book['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($book['genre']) . "</td>";
                    echo "<td>" . htmlspecialchars($book['isbn']) . "</td>";
                    echo "<td>";
                    if (!empty($book['cover_image'])) {
                        echo "<img src='uploads/" . htmlspecialchars($book['cover_image']) . "' alt='Cover Image' style='max-width: 100px;'>";
                    }
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($book['quantity']) . "</td>";
                    echo "<td>
                            <a href='edit_book.php?id=" . htmlspecialchars($book['id']) . "'>Edit</a>
                            <a href='delete_book.php?id=" . htmlspecialchars($book['id']) . "'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>
