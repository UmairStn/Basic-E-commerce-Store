<?php
session_start();

require_once 'includes/security.php';
require_once 'includes/validation.php';
require_once 'auth/auth.php';

setSecurityHeaders();
checkUserAuth();

if(!isset($_SESSION['user_email'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

$con = mysqli_connect("localhost", "root", "", "ecommerce");

if(mysqli_connect_errno()) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $cart = json_decode($_POST['cart'], true);
    
    // Validate inputs
    if (!validateEmail($email)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email']);
        exit();
    }
    
    // Start transaction
    mysqli_begin_transaction($con);
    
    try {
        // Insert each cart item as a separate order
        foreach($cart as $item) {
            $product_name = mysqli_real_escape_string($con, $item['name']);
            $product_price = (float)$item['price'];
            $quantity = (int)$item['quantity'];
            $total_amount = $product_price * $quantity;
            
            $sql = "INSERT INTO orders (user_name, user_email, mobile, address, 
                    product_name, product_price, quantity, total_amount) 
                    VALUES ('$name', '$email', '$mobile', '$address', 
                    '$product_name', $product_price, $quantity, $total_amount)";
            
            mysqli_query($con, $sql);
            
            // Update product quantity in productdetails table
            $product_id = mysqli_real_escape_string($con, $item['product_id']);
            $update_sql = "UPDATE productdetails SET quantity = quantity - $quantity 
                          WHERE product_id = '$product_id'";
            mysqli_query($con, $update_sql);
        }
        
        mysqli_commit($con);
        $order_id = mysqli_insert_id($con);
        echo json_encode(['success' => true, 'order_id' => $order_id]);
    } catch(Exception $e) {
        mysqli_rollback($con);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

mysqli_close($con);
?>