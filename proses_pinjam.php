<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'member') {
    header("Location: login.php");
    exit();
}
include 'db_config.php';

$user_id = $_SESSION['user']['id'];
$book_id = $_POST['book_id'];
$borrow_date = date('Y-m-d H:i:s');
$return_date = date('Y-m-d H:i:s', strtotime($borrow_date . ' + 15 days'));

$query = "INSERT INTO borrowings (user_id, book_id, borrow_date, return_date) VALUES (:user_id, :book_id, :borrow_date, :return_date)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':book_id', $book_id);
$stmt->bindParam(':borrow_date', $borrow_date);
$stmt->bindParam(':return_date', $return_date);

if ($stmt->execute()) {
    $updateQuantityQuery = "UPDATE books SET quantity = quantity - 1 WHERE id = :book_id";
    $updateStmt = $conn->prepare($updateQuantityQuery);
    $updateStmt->bindParam(':book_id', $book_id);
    $updateStmt->execute();
    
    header("Location: borrow_books.php");
} else {
    echo "Peminjaman gagal.";
}
?>
