<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'] ?? null;
    $address = $_POST['address'] ?? null;

    try {
        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email already registered.'); window.location.href='index.html?error=register';</script>";
        }

        // Insert new user into database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        $success = $stmt->execute([$name, $email, $password, $phone, $address]);

        if ($success) {
            echo "<script>alert('Registration successful.'); window.location.href='index.html?error=login';</script>";
        } else {
            echo "<script>alert('Registration failed.'); window.location.href='index.html?error=register';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database error: " . $e->getMessage() . "'); window.location.href='index.html?error=register';</script>";
        exit();
    }
}
?>
