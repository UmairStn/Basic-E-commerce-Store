<?php
session_start();

// Prevent session fixation
function regenerateSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_regenerate_id(true);
}

// Set secure session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);

function checkUserAuth() {
    if (!isset($_SESSION['user_email'])) {
        header("Location: /finalProject/homepage/userlogin.php");
        exit();
    }
}

function checkAdminAuth() {
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: /finalProject/login.php");
        exit();
    }
}

function checkStaffAuth() {
    if (!isset($_SESSION['staff_logged_in'])) {
        header("Location: /finalProject/login.php");
        exit();
    }
}
?>