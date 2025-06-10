<?php
require_once 'config.php';

// Clear all session variables
$_SESSION = array();

// Destroy the session
if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
}

// Redirect to login page
header('Location: ../index.php');
exit;
?>