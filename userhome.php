<?php
session_start();
// Check if user is logged in
if(!isset($_SESSION['user_email'])) {
    header("Location: homepage/userlogin.php");
    exit();
}

// Database connection
$con = mysqli_connect("localhost", "root", "", "ecommerce");

// Check connection
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Handle search
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Fetch products with search filter
if($search) {
    $sql = "SELECT * FROM productdetails WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM productdetails";
}
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetics Store</title>
    <link rel="stylesheet" href="css/userhome.css">
    <script src="js/userhome.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Search Container Styles */
        .search-container {
            margin: 30px 0;
            text-align: center;
        }

        .search-form {
            display: inline-block;
            margin-bottom: 15px;
            width: 100%;
            max-width: 1000px;
        }

        .search-input-container {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 1000px;
            width: 95%;
            margin: 0 auto;
            height: 70px;
            border: 2px solid #ff6b9d;
        }

        .search-input {
            flex: 1;
            padding: 25px 35px;
            border: none;
            outline: none;
            font-size: 22px;
            background: transparent;
            height: 100%;
            color: #333;
        }

        .search-input::placeholder {
            color: #999;
            font-size: 20px;
        }

        .search-btn {
            background: #ff6b9d;
            border: none;
            padding: 25px 35px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            height: 100%;
            min-width: 100px;
        }

        .search-btn:hover {
            background: #e55a87;
        }

        .search-btn i {
            font-size: 24px;
        }

        .search-results-info {
            margin-top: 15px;
            color: #666;
            font-size: 16px;
        }

        .search-results-info p {
            margin: 5px 0;
        }

        .clear-search {
            color: #ff6b9d;
            text-decoration: none;
            font-size: 16px;
            margin-left: 10px;
        }

        .clear-search:hover {
            text-decoration: underline;
        }

        .no-products {
            text-align: center;
            color: #666;
            font-size: 18px;
            grid-column: 1 / -1;
            padding: 40px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .search-input-container {
                width: 100%;
                height: 60px;
                border-radius: 30px;
            }
            
            .search-input {
                padding: 20px 25px;
                font-size: 18px;
            }
            
            .search-btn {
                padding: 20px 25px;
                min-width: 80px;
            }
            
            .search-btn i {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">Vogue Mart</div>
        <div class="nav-links">
            <a href="userhome.php" class="active">Home</a>
            <a href="cart.php">Cart</a>
            <a href="login.php">Admin Login</a>
            <a href="homepage/home.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Welcome to Vogue Mart</h1>
        
        <!-- Search Bar -->
        <div class="search-container">
            <form method="GET" action="userhome.php" class="search-form">
                <div class="search-input-container">
                    <input type="text" 
                           id="searchInput" 
                           name="search" 
                           placeholder="Search products..." 
                           value="<?php echo htmlspecialchars($search); ?>"
                           class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <?php if($search): ?>
                <div class="search-results-info">
                    <p>Search results for: "<strong><?php echo htmlspecialchars($search); ?></strong>"</p>
                    <a href="userhome.php" class="clear-search">Clear Search</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="products-grid">
            <?php
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product-card'>
                            <div class='product-image'>
                                <img src='" . $row['image'] . "' alt='" . $row['name'] . "'>
                            </div>
                            <div class='product-info'>
                                <h3>" . $row['name'] . "</h3>
                                <p class='description'>" . $row['description'] . "</p>
                                <p class='price'>Rs." . $row['price'] . "</p>
                                <button class='add-to-cart' onclick='addToCart(" . json_encode($row) . ")'>
                                    Add to Cart
                                </button>
                            </div>
                          </div>";
                }
            } else {
                if($search) {
                    echo "<p class='no-products'>No products found matching '<strong>" . htmlspecialchars($search) . "</strong>'</p>";
                } else {
                    echo "<p class='no-products'>No products available</p>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Cart Popup -->
    <div id="cartPopup" class="cart-popup">
        <div class="cart-content">
            <h2>Shopping Cart</h2>
            <div id="cartItems"></div>
            <div class="cart-total">
                <p>Total: Rs.<span id="cartTotal">0</span></p>
            </div>
            <button class="checkout-btn">Checkout</button>
            <button class="close-cart" onclick="closeCart()">Close</button>
        </div>
    </div>

    <script src="js/home.js"></script>
</body>
</html>