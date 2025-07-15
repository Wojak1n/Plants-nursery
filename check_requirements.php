<?php
/**
 * Server Requirements Checker
 * Run this file to check if your server meets the requirements
 */

echo "<h1>Plants Nursery - Server Requirements Check</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .success { color: green; }
    .error { color: red; }
    .warning { color: orange; }
    .info { background: #f0f0f0; padding: 10px; margin: 10px 0; }
</style>";

$requirements = [
    'PHP Version' => version_compare(PHP_VERSION, '7.4.0', '>='),
    'PDO Extension' => extension_loaded('pdo'),
    'PDO MySQL' => extension_loaded('pdo_mysql'),
    'GD Extension' => extension_loaded('gd'),
    'File Uploads' => ini_get('file_uploads'),
    'Session Support' => function_exists('session_start'),
];

$recommendations = [
    'cURL Extension' => extension_loaded('curl'),
    'OpenSSL Extension' => extension_loaded('openssl'),
    'Zip Extension' => extension_loaded('zip'),
];

echo "<h2>Required Extensions</h2>";
$allRequired = true;
foreach ($requirements as $name => $status) {
    $class = $status ? 'success' : 'error';
    $symbol = $status ? '✓' : '✗';
    echo "<p class='$class'>$symbol $name</p>";
    if (!$status) $allRequired = false;
}

echo "<h2>Recommended Extensions</h2>";
foreach ($recommendations as $name => $status) {
    $class = $status ? 'success' : 'warning';
    $symbol = $status ? '✓' : '⚠';
    echo "<p class='$class'>$symbol $name</p>";
}

echo "<h2>PHP Configuration</h2>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";
echo "<p>Upload Max Filesize: " . ini_get('upload_max_filesize') . "</p>";
echo "<p>Post Max Size: " . ini_get('post_max_size') . "</p>";
echo "<p>Max Execution Time: " . ini_get('max_execution_time') . " seconds</p>";

echo "<h2>Directory Permissions</h2>";
$directories = ['assets/images', 'assets/images/plants', 'assets/images/recipes'];
foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
    $writable = is_writable($dir);
    $class = $writable ? 'success' : 'error';
    $symbol = $writable ? '✓' : '✗';
    echo "<p class='$class'>$symbol $dir " . ($writable ? '(writable)' : '(not writable)') . "</p>";
}

if ($allRequired) {
    echo "<div class='info success'><strong>✓ All requirements met!</strong> Your server is ready for the Plants Nursery application.</div>";
} else {
    echo "<div class='info error'><strong>✗ Missing requirements!</strong> Please contact your hosting provider to enable the missing extensions.</div>";
}

echo "<h2>Next Steps</h2>";
echo "<ol>";
echo "<li>If all requirements are met, proceed with deployment</li>";
echo "<li>Upload all your files to the server</li>";
echo "<li>Create a MySQL database</li>";
echo "<li>Import database_setup.sql</li>";
echo "<li>Run deploy.php to configure database connection</li>";
echo "<li>Delete this file and deploy.php after setup</li>";
echo "</ol>";

echo "<p><a href='deploy.php'>→ Continue to Database Setup</a></p>";
?>
