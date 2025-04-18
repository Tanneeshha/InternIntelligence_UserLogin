<?php
session_start();
require 'db.php';

header('Content-Type: application/json');

// Debug: log posted form data
file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

// Sanitize inputs
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$pass = $_POST['password'];  

// More debug
file_put_contents('debug.log', "Username: $username\nPassword: $pass\n", FILE_APPEND);

// Rate limiting
if (!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = 0;
if ($_SESSION['login_attempts'] > 5) {
    die(json_encode(['status' => 'error', 'message' => 'Too many attempts. Try again later.']));
}

if (!$username || !$pass) {
    die(json_encode(['status' => 'error', 'message' => 'Username and password are required.']));
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Debug: check user result
file_put_contents('debug.log', "Fetched User: " . print_r($user, true) . "\n", FILE_APPEND);

if ($user && password_verify($pass, $user['pass'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    echo json_encode(['status' => 'success', 'message' => 'Login successful']);
} else {
    $_SESSION['login_attempts'] += 1;
    echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
}
?>
