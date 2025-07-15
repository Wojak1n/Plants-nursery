<?php
// Production Database Configuration
// Update these values with your hosting provider's database details

// Database connection configuration
$host = 'localhost'; // Usually 'localhost' for shared hosting
$dbname = 'your_database_name'; // Replace with your actual database name
$username = 'your_db_username'; // Replace with your database username
$password = 'your_db_password'; // Replace with your database password
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
    // Log the error but don't display it to users in production
    error_log('Connection Error: ' . $e->getMessage());
    die('Database connection failed. Please try again later.');
}

// Production settings
ini_set('display_errors', 0); // Hide errors from users in production
ini_set('log_errors', 1); // Log errors to file
error_reporting(E_ALL); // Report all errors to log

// Security settings
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Only if using HTTPS
ini_set('session.use_strict_mode', 1);
?>
