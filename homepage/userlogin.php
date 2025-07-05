<?php
session_start();

// Database connection
$con = mysqli_connect("localhost", "root", "", "ecommerce");

// Check connection
if(mysqli_connect_errno()) {
    // error_log("MySQL Error: " . mysqli_connect_error());
    // echo "An error occurred. Please try again later.";
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Process login form
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['email']) && isset($_POST['password'])) {
        // Sanitize user inputs
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        // Check user credentials
        $stmt = $con->prepare("SELECT * FROM signup WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()) {
            if(password_verify($password, $row['password'])) {
                // Login successful
                $_SESSION['user_email'] = $email;
                echo "<script>
                        alert('Login successful!');
                        window.location.href='../userhome.php';
                      </script>";
            } else {
                // Login failed
                echo "<script>alert('Invalid email or password!');</script>";
            }
        } else {
            // Login failed
            echo "<script>alert('Invalid email or password!');</script>";
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
    <title>Login - Cosmetics Store</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background-color: #fff5f5;
        }

        .login-form {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            font-size: 1.5rem;
            color: #333;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff9fb3;
            box-shadow: 0 0 0 2px rgba(255, 159, 179, 0.2);
        }

        .login-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #ff9fb3;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #ff8fa8;
        }

        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .signup-link a {
            color: #ff9fb3;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
        }

        .forgot-password {
            text-align: right;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }

        .forgot-password a {
            color: #666;
            font-size: 0.8rem;
            text-decoration: none;
        }

        .forgot-password a:hover {
            color: #ff9fb3;
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
    <div class="login-container">
        <form class="login-form" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo bin2hex(random_bytes(32)); ?>">
            <div class="login-header">
                <h2>Welcome Back</h2>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="email-error"></div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message" id="password-error"></div>
            </div>

            <div class="forgot-password">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>
            
            <button type="submit" class="login-btn">Sign In</button>
            
            <div class="signup-link">
                Don't have an account? <a href="signup.php">Sign Up</a>
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
                document.getElementById('password-error').textContent = 'Password must be at least 8 characters';
                document.getElementById('password-error').style.display = 'block';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>