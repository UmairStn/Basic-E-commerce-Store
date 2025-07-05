<?php
session_start();

// Set content type to JSON
header('Content-Type: application/json');

// Database connection
$con = mysqli_connect("localhost", "root", "", "ecommerce");

if(mysqli_connect_errno()) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit();
}

if($_POST && $_POST['role'] === 'Staff') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // Debug: Log the query
    error_log("Login attempt for user: " . $username);
    
    // Use correct column names: email and login_code
    $sql = "SELECT * FROM users WHERE email = '$username' AND login_code = '$password'";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        echo json_encode(['success' => false, 'message' => 'Query error: ' . mysqli_error($con)]);
        exit();
    }
    
    error_log("Query result rows: " . mysqli_num_rows($result));
    
    if(mysqli_num_rows($result) > 0) {
        // Valid staff credentials
        $_SESSION['staff_logged_in'] = true;
        $_SESSION['staff_email'] = $username;
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        // Invalid credentials - let's check if user exists
        $check_user_sql = "SELECT email FROM users WHERE email = '$username'";
        $check_result = mysqli_query($con, $check_user_sql);
        
        if(mysqli_num_rows($check_result) > 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid password']);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request - missing POST data or role']);
}

mysqli_close($con);
?>