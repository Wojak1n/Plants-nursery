<?php
require_once 'config.php';

/**
 * Authenticate a user with email and password
 * 
 * @param string $email User's email
 * @param string $password User's password
 * @return array|bool User data array on success, false on failure
 */
function authenticateUser($email, $password) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Password verified successfully
            return $user;
        }
        
        return false;
    } catch (PDOException $e) {
        error_log('Authentication Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Clean and validate input data
 * 
 * @param string $data Input data to sanitize
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Validate email format
 * 
 * @param string $email Email to validate
 * @return bool True if valid, false otherwise
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Create a session for authenticated user
 * 
 * @param array $user User data
 */
function createUserSession($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['logged_in'] = true;
}

/**
 * Check if user is logged in
 * 
 * @return bool True if logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Redirect to specified page
 * 
 * @param string $location URL to redirect to
 */
function redirect($location) {
    header("Location: $location");
    exit;
}
?>