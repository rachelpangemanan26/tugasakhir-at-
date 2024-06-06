<?php
session_start();
include 'db_config.php';

$query = "SELECT id, title, cover_image FROM books";
$stmt = $conn->prepare($query);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Beranda - Perpustakaan UNSRAT</h1>
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
    <section>
        <h2>Selamat datang di Perpustakaan UNSRAT</h2>
        <div class="books">
            <?php foreach ($books as $book): ?>
                <div class="book">
                    <img src="uploads/<?php echo htmlspecialchars($book['cover_image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" class="cover">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'member'): ?>
                        <form action="proses_pinjam.php" method="POST">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <button type="submit">Pinjam</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>
