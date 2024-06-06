<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Status Peminjaman</h1>
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
        <h2>Daftar Peminjaman Buku</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT b.id as borrowing_id, u.nama as user_name, bk.title as book_title, b.borrow_date, b.return_date 
                          FROM borrowings b 
                          JOIN users u ON b.user_id = u.id 
                          JOIN books bk ON b.book_id = bk.id";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $borrowings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($borrowings as $borrowing) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($borrowing['user_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($borrowing['book_title']) . "</td>";
                    echo "<td>" . htmlspecialchars($borrowing['borrow_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($borrowing['return_date']) . "</td>";
                    echo "<td>";
                    if (is_null($borrowing['return_date'])) {
                        echo "<form action='proses_kembali.php' method='POST'>
                                <input type='hidden' name='borrowing_id' value='" . htmlspecialchars($borrowing['borrowing_id']) . "'>
                                <button type='submit'>Kembalikan</button>
                              </form>";
                    } else {
                        echo "Sudah dikembalikan";
                    }
                    echo "</td>";
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