<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'member') {
    header("Location: login.php");
    exit();
}
include 'db_config.php';
include 'functions.php';

$user_id = $_SESSION['user']['id'];

$query = "SELECT books.title, books.cover_image, borrowings.borrow_date, borrowings.return_date 
          FROM books 
          JOIN borrowings ON books.id = borrowings.book_id 
          WHERE borrowings.user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$borrowed_books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Dipinjam - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Buku Dipinjam - Selamat Datang, <?php echo htmlspecialchars($_SESSION['user']['nama']); ?></h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="borrow_books.php">Peminjaman Buku</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <section>
        <h2>Buku yang Dipinjam</h2>
        <div class="borrowed_books">
            <?php foreach ($borrowed_books as $book): ?>
                <div class="book">
                    <?php if (!empty($book['cover_image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($book['cover_image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" class="cover">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p>Tanggal Pinjam: <?php echo htmlspecialchars($book['borrow_date']); ?></p>
                    <p>Tanggal Kembali: <?php echo htmlspecialchars($book['return_date']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>