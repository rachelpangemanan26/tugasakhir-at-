<?php
include 'db_config.php';

function registerUser($nama, $username, $password) {
    global $conn;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO users (nama, username, password) VALUES (:nama, :username, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $passwordHash);
    return $stmt->execute();
}

function loginUser($username, $password) {
    global $conn;
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function deleteBook($id) {
    global $conn;
    $query = "DELETE FROM books WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

function addBook($title, $author, $description, $genre, $isbn, $cover_image, $quantity) {
    global $conn;
    $query = "INSERT INTO books (title, author, description, genre, isbn, cover_image, quantity) VALUES (:title, :author, :description, :genre, :isbn, :cover_image, :quantity)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':cover_image', $cover_image);
    $stmt->bindParam(':quantity', $quantity);
    return $stmt->execute();
}

function editBook($id, $title, $author, $description, $genre, $isbn, $cover_image, $quantity) {
    global $conn;
    $query = "UPDATE books SET title = :title, author = :author, description = :description, genre = :genre, isbn = :isbn, cover_image = :cover_image, quantity = :quantity WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':cover_image', $cover_image);
    $stmt->bindParam(':quantity', $quantity);
    return $stmt->execute();
}

function updateBookQuantity($book_id, $quantity) {
    global $conn;
    $query = "UPDATE books SET quantity = :quantity WHERE id = :book_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':book_id', $book_id);
    $stmt->bindParam(':quantity', $quantity);
    return $stmt->execute();
}
?>