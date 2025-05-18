<?php
require_once '../includes/functions.php';

// Check if already logged in
if (isLoggedIn()) {
    header('Location: /dashboard.php');
    exit;
}

$error = '';

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? sanitizeInput($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // In a real application, you would check against a database
    // For this demo, we use a hardcoded admin user
    $adminUsername = 'admin';
    $adminPasswordHash = password_hash('admin123', PASSWORD_DEFAULT); // In real app, this would be stored in database
    
    if ($username === $adminUsername && password_verify($password, $adminPasswordHash)) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        
        // Redirect to dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Green Haven Nursery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9f1',
                            100: '#dcf1df',
                            200: '#bae3c1',
                            300: '#8ecf9a',
                            400: '#5fb56e',
                            500: '#3e9a4e',
                            600: '#2d7b3c',
                            700: '#266333',
                            800: '#224f2c',
                            900: '#1e4226',
                            950: '#0f2514',
                        }
                    },
                },
                fontFamily: {
                    'sans': ['Poppins', 'sans-serif'],
                    'serif': ['Merriweather', 'serif'],
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-8 bg-white rounded-lg shadow-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-serif font-bold text-primary-700">Green Haven</h1>
            <p class="text-gray-600 mt-2">Admin Panel Login</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 bg-red-50 text-red-800 rounded-md">
                <?= $error ?>
            </div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <div class="mb-6">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 custom-focus"
                       required>
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 custom-focus"
                       required>
            </div>
            
            <button type="submit" 
                    class="w-full py-3 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-md shadow-md transition-colors">
                Log In
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm text-gray-600">
            <p>For demo purposes, use:</p>
            <p>Username: <span class="font-medium">admin</span></p>
            <p>Password: <span class="font-medium">admin123</span></p>
        </div>
        
        <div class="mt-8 text-center">
            <a href="/" class="text-primary-600 hover:text-primary-700 font-medium">Back to Website</a>
        </div>
    </div>
</body>
</html>