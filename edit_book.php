<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'functions.php';
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];

    $cover_image = $_POST['existing_cover_image'];
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = basename($_FILES['cover_image']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $cover_image;
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file);
    }

    if (editBook($id, $title, $author, $description, $genre, $isbn, $cover_image, $quantity)) {  // Updated line
        header("Location: manage_books.php");
    } else {
        echo "Gagal mengedit buku.";
    }
} else {
    $id = $_GET['id'];
    $book = $conn->query("SELECT * FROM books WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        echo "Buku tidak ditemukan.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Buku</h1>
    </header>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_books.php">Manajemen Buku</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <section>
        <h2>Form Edit Buku</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
            <input type="hidden" name="existing_cover_image" value="<?php echo htmlspecialchars($book['cover_image']); ?>">
            <label for="title">Judul Buku:</label><br>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br><br>
            <label for="author">Penulis:</label><br>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required><br><br>
            <label for="description">Deskripsi:</label><br>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($book['description']); ?></textarea><br><br>
            <label for="genre">Genre:</label><br>
            <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>" required><br><br>
            <label for="isbn">ISBN:</label><br>
            <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required><br><br>
            <label for="quantity">Jumlah Buku:</label><br>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($book['quantity']); ?>" required><br><br>  <!-- New line -->
            <label for="cover_image">Foto Sampul:</label><br>
            <input type="file" id="cover_image" name="cover_image"><br><br>
            <?php if (!empty($book['cover_image'])): ?>
                <p>Current Cover: <img src="uploads/<?php echo htmlspecialchars($book['cover_image']); ?>" alt="Cover Image" style="max-width: 200px;"></p>
            <?php endif; ?>
            <input type="submit" value="Edit">
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>
