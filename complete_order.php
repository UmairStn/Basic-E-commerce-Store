<?php
session_start();

// Database connection
$con = mysqli_connect("localhost", "root", "", "ecommerce");

if(mysqli_connect_errno()) {
    echo "error";
    exit();
}

if($_POST) {
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);
    $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
    $customer_address = mysqli_real_escape_string($con, $_POST['customer_address']);
    $contact_email = mysqli_real_escape_string($con, $_POST['contact_email']);
    $contact_mobile = mysqli_real_escape_string($con, $_POST['contact_mobile']);
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $product_details = mysqli_real_escape_string($con, $_POST['product_details']);
    $total_amount = mysqli_real_escape_string($con, $_POST['total_amount']);
    
    // Insert into completed_orders table
    $sql = "INSERT INTO completed_orders (order_id, customer_name, customer_address, contact_email, contact_mobile, product_name, product_details, total_amount) 
            VALUES ('$order_id', '$customer_name', '$customer_address', '$contact_email', '$contact_mobile', '$product_name', '$product_details', '$total_amount')";
    
    if(mysqli_query($con, $sql)) {
        // Optional: Delete from original orders table
        $delete_sql = "DELETE FROM orders WHERE order_id = '$order_id'";
        mysqli_query($con, $delete_sql);
        
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}

mysqli_close($con);
?>