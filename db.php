<?php
$host = 'localhost';
$db = 'user_auth';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("DB Connection failed: " . $e->getMessage()); // Logs error
    die("Internal server error. Please try again later."); 
}
?>
