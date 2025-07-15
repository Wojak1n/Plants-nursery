<?php
// Hostinger database connection configuration
$host = 'localhost';
$dbname = 'u629842120_plants_nursery';
$username = 'u629842120_root';
$password = '7KwgWvruIp#';
$charset = 'utf8mb4';
// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// PDO options for error handling and security
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Create PDO instance
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Log the error but don't display it to users
    error_log('Connection Error: ' . $e->getMessage());
    die('Database connection failed. Please try again later.');
}

// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>