<?php
session_start();

// Database connection
$con = mysqli_connect("localhost", "root", "", "ecommerce");

// Check connection
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Process form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['email']) && isset($_POST['password'])) {
        // Sanitize user inputs
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        // Check if email already exists
        $check_email = "SELECT * FROM signup WHERE email = '$email'";
        $result = mysqli_query($con, $check_email);
        
        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $con->prepare("INSERT INTO signup (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed_password);
            
            if($stmt->execute()) {
                echo "<script>
                        alert('Registration successful!');
                        window.location.href='home.php';
                      </script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
            }
        }
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Cosmetics Store</title>
    <style>
        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f0f0;
        }

        .signup-form {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .signup-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .signup-header h2 {
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e0d0d0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff9fb3;
        }

        .signup-btn {
            width: 100%;
            padding: 12px 20px;
            background: #ff9fb3;
            color: black;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .signup-btn:hover {
            background: #ff8fa8;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .login-link a {
            color: #ff9fb3;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #e53935;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .home-link {
        text-align: center;
        margin-top: 1rem;
        }

        .home-btn {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .home-btn:hover {
            color: #ff9fb3;
            border-color: #ff9fb3;
            background-color: #fff5f5;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <form class="signup-form" method="POST" action="signup.php" onsubmit="return validateForm()">
            <div class="signup-header">
                <h2>Create Account</h2>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="email-error"></div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message" id="password-error"></div>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <div class="error-message" id="confirm-password-error"></div>
            </div>
            
            <button type="submit" class="signup-btn">Sign Up</button>
            
            <div class="login-link">
                Already have an account? <a href="userlogin.php">Login</a>
            </div>
            <div class="home-link">
                <a href="home.php" class="home-btn">← Back to Home</a>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            let isValid = true;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            // Reset error messages
            document.querySelectorAll('.error-message').forEach(elem => {
                elem.style.display = 'none';
            });

            // Email validation
            if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                document.getElementById('email-error').textContent = 'Please enter a valid email address';
                document.getElementById('email-error').style.display = 'block';
                isValid = false;
            }

            // Password validation
            if (password.length < 8) {
                document.getElementById('password-error').textContent = 'Password must be at least 8 characters long';
                document.getElementById('password-error').style.display = 'block';
                isValid = false;
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                document.getElementById('confirm-password-error').textContent = 'Passwords do not match';
                document.getElementById('confirm-password-error').style.display = 'block';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>