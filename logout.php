<?php
session_start();
header('Content-Type: application/json');

// Optional cleanup
session_unset(); // Clear session variables
session_destroy(); // Destroy session completely

echo json_encode([
    'status' => 'success',
    'message' => 'Logged out'
]);
?>
