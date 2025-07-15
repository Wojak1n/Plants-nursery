<?php
// Database connection using PDO
function connectDB() {
    // Hostinger database credentials
    $host = 'localhost';
    $dbname = 'u629842120_plants_nursery';  // Fixed spelling: nursery
    $username = 'u629842120_root';
    $password = '7KwgWvruIp#';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set PDO to throw exceptions on error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Use prepared statements by default
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}