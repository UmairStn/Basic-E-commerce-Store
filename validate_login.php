<?php
session_start();

// Admin credentials
$admin_username = "admin";
$admin_password = "admin123";

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    // Validate based on role
    if ($role === 'Admin') {
        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['user_role'] = 'Admin';
            $_SESSION['username'] = $username;
            header('Location: admin.php');
            exit();
        } else {
            $error = "Invalid admin credentials";
        }
    } elseif ($role === 'Supervisor' || $role === 'Staff') {
        // For now, redirect to respective pages (you can add database validation later)
        $_SESSION['user_role'] = $role;
        $_SESSION['username'] = $username;
        
        if ($role === 'Supervisor') {
            header('Location: supervisor.php');
        } else {
            header('Location: staff.php');
        }
        exit();
    }
    
    // If validation fails, redirect back to login with error
    $_SESSION['login_error'] = $error ?? "Login failed";
    header('Location: login.php');
    exit();
}
?>