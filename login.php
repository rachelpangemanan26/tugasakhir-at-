<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan UNSRAT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Login - Perpustakaan UNSRAT</h1>
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
        <h2>Form Login</h2>
        <form action="proses_login.php" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Perpustakaan Universitas Sam Ratulangi</p>
    </footer>
</body>
</html>
