<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_email'])) {
    header("Location: homepage/userlogin.php");
    exit();
}

// Initialize cart if not exists
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/cart.css">
    <script src="js/cart.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">Vogue Mart</div>
        <div class="nav-links">
            <a href="userhome.php">Home</a>
            <a href="cart.php" class="active">Cart <span id="cartCount">0</span></a>
            <a href="homepage/home.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Shopping Cart</h1>
        <div class="cart-container">
            <div id="cartItems" class="cart-items">
                <!-- Cart items will be loaded here -->
            </div>
            <div class="cart-summary">
                <h2>Order Summary</h2>
                <div class="summary-item">
                    <span>Subtotal:</span>
                    <span id="subtotal">Rs.0.00</span>
                </div>
                <div class="summary-item">
                    <span>Shipping:</span>
                    <span>Rs.50.00</span>
                </div>
                <div class="summary-item total">
                    <span>Total:</span>
                    <span id="total">Rs.0.00</span>
                </div>
                <button id="checkoutBtn" class="checkout-btn">Proceed to Checkout</button>
            </div>
        </div>
    </div>

    <div class="checkout-popup" id="checkoutPopup">
        <div class="checkout-form">
            <div class="popup-header">
                <h2>Checkout Details</h2>
                <button type="button" class="close-popup" onclick="closeCheckout()">&times;</button>
            </div>
            <form id="checkoutForm" method="POST" action="process_checkout.php">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['user_email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <input type="hidden" name="total_amount" id="totalAmount">
                <div class="form-buttons">
                    <button type="button" class="cancel-btn" onclick="closeCheckout()">Cancel</button>
                    <button type="submit" class="submit-btn">Complete Order</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/cart.js"></script>
</body>
</html>