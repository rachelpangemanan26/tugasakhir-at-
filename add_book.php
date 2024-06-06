<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'functions.php';
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];

    $cover_image = NULL;
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = basename($_FILES['cover_image']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $cover_image;
        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file)) {
        } else {
            echo "Failed to upload file.";
        }
    }

    if (addBook($title, $author, $description, $genre, $isbn, $cover_image, $quantity)) {
        header("Location: manage_books.php");
    } else {
        echo "Gagal menambahkan buku.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Tambah Buku Baru</h1>
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
        <h2>Form Tambah Buku</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Judul Buku:</label><br>
            <input type="text" id="title" name="title" required><br><br>
            <label for="author">Penulis:</label><br>
            <input type="text" id="author" name="author" required><br><br>
            <label for="description">Deskripsi:</label><br>
            <textarea id="description" name="description" required></textarea><br><br>
            <label for="genre">Genre:</label><br>
            <input type="text" id="genre" name="genre" required><br><br>
            <label for="isbn">ISBN:</label><br>
            <input type="text" id="isbn" name="isbn" required><br><br>
            <label for="quantity">Jumlah Buku:</label><br>
            <input type="number" id="quantity" name="quantity" required><br><br>
            <label for="cover_image">Foto Sampul:</label><br>
            <input type="file" id="cover_image" name="cover_image"><br><br>
            <input type="submit" value="Tambah">
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>
