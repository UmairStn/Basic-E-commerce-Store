<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Database connection
$con = mysqli_connect("localhost", "root", "", "ecommerce");

// Check connection
if(mysqli_connect_errno()) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Prepare statements for both queries
        $check_stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
        $insert_stmt = $con->prepare("INSERT INTO users (name, role, email, login_code) VALUES (?, ?, ?, ?)");
        
        if (!$check_stmt || !$insert_stmt) {
            throw new Exception("Preparation failed: " . $con->error);
        }

        // Get and sanitize form data
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['login_code'];

        // Validate inputs
        if (!$name || !$role || !$email || !$password) {
            throw new Exception("All fields are required");
        }

        // Check if email exists
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if($result->num_rows > 0) {
            throw new Exception("Email already exists!");
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $insert_stmt->bind_param("ssss", $name, $role, $email, $hashed_password);
        
        if($insert_stmt->execute()) {
            $_SESSION['success_message'] = "User added successfully!";
        } else {
            throw new Exception("Error adding user: " . $insert_stmt->error);
        }

        // Close statements
        $check_stmt->close();
        $insert_stmt->close();

        // Redirect with success
        header('Location: admin.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header('Location: admin.php');
        exit();
    }
}

mysqli_close($con);
?>