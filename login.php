<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cosmetics</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/script.js" defer></script>
    <style>
        
    </style>
</head>
<body>
    <div class="login-container">
        <div class="welcome-section">
            <h1 class="welcome-title">Welcome Back</h1>
            <p class="welcome-subtitle">
                Elevate your natural beauty with our premium cosmetic products carefully curated to enhance your radiance
            </p>
        </div>

        <div class="login-section">
            <h2 class="login-title">Log In</h2>
            
            <div class="user-role-dropdown">
                <button class="dropdown-button" onclick="toggleDropdown()">
                    <span id="selected-role">User Role</span>
                    <span class="dropdown-arrow" id="dropdown-arrow">▼</span>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <div class="dropdown-item" onclick="selectRole('Admin')">Admin</div>
                    
                    <div class="dropdown-item" onclick="selectRole('Staff')">Staff</div>
                </div>
            </div>

            <form onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" class="form-input" required>
                </div>

                <button type="submit" class="login-button">Login</button>
            </form>

            <!--<button type="button" onclick="testFunction()">Test JS</button> -->
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>