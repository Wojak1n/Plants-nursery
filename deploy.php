<?php
/**
 * Simple deployment configuration script
 * Run this once after uploading files to set up production configuration
 */

echo "<h1>Plants Nursery - Deployment Setup</h1>";

// Check if this is the first run
if (isset($_POST['setup'])) {
    $host = $_POST['host'] ?? 'localhost';
    $dbname = $_POST['dbname'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($dbname) || empty($username)) {
        echo "<p style='color: red;'>Please fill in all required fields.</p>";
    } else {
        // Test database connection
        try {
            // Try different connection methods for different hosting providers
            $dsn_options = [
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4;port=3306",
            ];

            $pdo = null;
            $connection_error = '';

            foreach ($dsn_options as $dsn) {
                try {
                    $pdo = new PDO($dsn, $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    break; // Connection successful
                } catch (PDOException $e) {
                    $connection_error = $e->getMessage();
                    continue; // Try next DSN
                }
            }

            if (!$pdo) {
                throw new PDOException($connection_error);
            }
            
            echo "<p style='color: green;'>✓ Database connection successful!</p>";
            
            // Update Login/config.php
            $loginConfig = "<?php
// Database connection configuration
\$host = '$host';
\$dbname = '$dbname';
\$username = '$username';
\$password = '$password';
\$charset = 'utf8mb4';
// DSN (Data Source Name)
\$dsn = \"mysql:host=\$host;dbname=\$dbname;charset=\$charset\";

// PDO options for error handling and security
\$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Create PDO instance
try {
    \$pdo = new PDO(\$dsn, \$username, \$password, \$options);
} catch (PDOException \$e) {
    // Log the error but don't display it to users
    error_log('Connection Error: ' . \$e->getMessage());
    die('Database connection failed. Please try again later.');
}

// Production settings
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
?>";
            
            // Update includes/db.php
            $includesDb = "<?php
// Database connection using PDO
function connectDB() {
    \$host = '$host';
    \$dbname = '$dbname';
    \$username = '$username';
    \$password = '$password';
    try {
        \$pdo = new PDO(\"mysql:host=\$host;dbname=\$dbname\", \$username, \$password);
        // Set PDO to throw exceptions on error
        \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Use prepared statements by default
        \$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return \$pdo;
    } catch (PDOException \$e) {
        error_log(\"Database connection failed: \" . \$e->getMessage());
        die(\"Database connection failed. Please try again later.\");
    }
}

// Production settings
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
?>";
            
            // Write the files
            if (file_put_contents('Login/config.php', $loginConfig) && 
                file_put_contents('includes/db.php', $includesDb)) {
                echo "<p style='color: green;'>✓ Configuration files updated successfully!</p>";
                echo "<p><strong>Next steps:</strong></p>";
                echo "<ul>";
                echo "<li>Import database_setup.sql into your database</li>";
                echo "<li>Test your website functionality</li>";
                echo "<li>Delete this deploy.php file for security</li>";
                echo "</ul>";
                echo "<p><a href='index.php'>Visit your website</a></p>";
            } else {
                echo "<p style='color: red;'>Error: Could not write configuration files. Check file permissions.</p>";
            }
            
        } catch (PDOException $e) {
            echo "<p style='color: red;'>Database connection failed: " . $e->getMessage() . "</p>";
        }
    }
} else {
    // Show setup form
    ?>
    <form method="POST" style="max-width: 500px; margin: 20px 0;">
        <h2>Database Configuration</h2>
        <p>Enter your hosting provider's database details:</p>

        <div style="margin: 10px 0;">
            <label>Database Host:</label><br>
            <input type="text" name="host" value="localhost" style="width: 100%; padding: 5px;" required>
            <small>For InfinityFree: use 'sql200.infinityfree.com' (or similar). Check your control panel!</small>
        </div>
        
        <div style="margin: 10px 0;">
            <label>Database Name:</label><br>
            <input type="text" name="dbname" style="width: 100%; padding: 5px;" required>
            <small>The name of your MySQL database</small>
        </div>
        
        <div style="margin: 10px 0;">
            <label>Database Username:</label><br>
            <input type="text" name="username" style="width: 100%; padding: 5px;" required>
            <small>Your database username</small>
        </div>
        
        <div style="margin: 10px 0;">
            <label>Database Password:</label><br>
            <input type="password" name="password" style="width: 100%; padding: 5px;">
            <small>Your database password (leave empty if no password)</small>
        </div>
        
        <button type="submit" name="setup" style="background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            Setup Configuration
        </button>
    </form>
    
    <div style="background: #f0f0f0; padding: 15px; margin: 20px 0;">
        <h3>Before running this setup:</h3>
        <ol>
            <li>Create a MySQL database in your hosting control panel</li>
            <li>Create a database user and assign it to the database</li>
            <li>Import the <code>database_setup.sql</code> file into your database</li>
            <li>Make sure the <code>assets/images/</code> folder has write permissions (755)</li>
        </ol>
    </div>
    <?php
}

echo "<hr>";
echo "<p><small>Delete this file after setup is complete for security reasons.</small></p>";
?>
