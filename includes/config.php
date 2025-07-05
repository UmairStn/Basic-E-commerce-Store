<?php
// Session configuration
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_samesite', 'Strict');

// Database configuration for local development
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ecommerce');

// Site configuration
define('SITE_URL', 'http://localhost/finalProject');
define('UPLOAD_PATH', __DIR__ . '/../uploads');

// Database connection function
function getDBConnection() {
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if(mysqli_connect_errno()) {
        error_log("Database connection failed: " . mysqli_connect_error());
        throw new Exception("Database connection failed");
    }
    
    return $con;
}
?>