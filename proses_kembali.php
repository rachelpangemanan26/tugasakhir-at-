<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'db_config.php';
include 'functions.php';

$borrowing_id = $_POST['borrowing_id'];

$query = "SELECT book_id FROM borrowings WHERE id = :borrowing_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':borrowing_id', $borrowing_id);
$stmt->execute();
$borrowing = $stmt->fetch(PDO::FETCH_ASSOC);

if ($borrowing) {
    $book_id = $borrowing['book_id'];

    $query = "UPDATE borrowings SET return_date = NOW() WHERE id = :borrowing_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':borrowing_id', $borrowing_id);

    if ($stmt->execute()) {
        $query = "SELECT quantity FROM books WHERE id = :book_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($book) {
            $new_quantity = $book['quantity'] + 1;
            updateBookQuantity($book_id, $new_quantity);
            header("Location: status_peminjaman.php");
        } else {
            echo "Buku tidak ditemukan.";
        }
    } else {
        echo "Gagal mengembalikan buku.";
    }
} else {
    echo "Peminjaman tidak ditemukan.";
}
?>
