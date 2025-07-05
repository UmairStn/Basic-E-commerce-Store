<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Vogue Mart</div>
        <div class="nav-item active" onclick="showOrdersView()">Orders</div>
        <div class="nav-item" onclick="showCompletedOrders()">Completed Orders</div>
        <div class="tagline">
            Elevate your natural beauty with our premium cosmetic
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div></div>
            <div class="admin-profile">
                <span>Staff</span>
                <div class="admin-avatar"></div>
                <button class="logout-btn" onclick="logoutAdmin()">Logout</button>
            </div>
        </div>

        

        <div class="product-table">
            <div class="tabs">
                <div class="tab active">Orders</div>
            </div>
            
            <div class="table-header">
                <div>Customer Detils</div>
                <div></div>
                <div>Contact Details</div>
                <div>Product Details</div>
                <div>Total</div>
                <div>Actions</div>
            </div>

            <?php

            // Database connection
            $con = mysqli_connect("localhost", "root", "", "ecommerce");

            // Check connection
            if(mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            // Fetch orders
            $sql = "SELECT * FROM orders ORDER BY order_date DESC";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product-row'>
                            <div class='customer-info'>
                                <div class='name'>{$row['user_name']}</div>
                                <div class='address'>{$row['address']}</div>
                            </div>
                            <div></div>
                           
                            <div class='contact-info'>
                                <div class='email'>{$row['user_email']}</div>
                                <div class='mobile'>{$row['mobile']}</div>
                            </div>
                            <div class='product-info'>
                                <div class='product'>{$row['product_name']}</div>
                                <div class='details'>
                                    Price: Rs.{$row['product_price']} × {$row['quantity']} units
                                </div>
                            </div>
                            <div class='total-amount'>
                                Rs.{$row['total_amount']}
                            </div>
                            <div class='action-buttons'>
                                <button class='delete-btn' onclick='deleteOrder({$row['order_id']})'>Delete</button>
                                <button class='complete-btn' onclick='completeOrder({$row['order_id']})'>Complete</button>
                            </div>
                          </div>";
                }
            } else {
                echo "<div class='product-row'><div colspan='7'>No orders found</div></div>";
            }
            ?>
        </div>

        <div class="compeletedOrders-view" id="compeletedOrdersView" style="display:none;">
            <div class="header">
                <div class="tab active">Completed Orders</div>
            </div>

            <div class="order-table-container">
                <div class="table-header order-table-header">
                    <div>Customer Details</div>
                    <div></div>
                    <div>Contact Details</div>
                    <div>Product Details</div>
                    <div>Total</div>
                </div>
                <div id="orderTableBody">
                    <?php
                    // Fetch completed orders from database
                    $completed_sql = "SELECT * FROM completed_orders ORDER BY completed_date DESC";
                    $completed_result = mysqli_query($con, $completed_sql);
                    
                    if(mysqli_num_rows($completed_result) > 0) {
                        while($row = mysqli_fetch_assoc($completed_result)) {
                            echo "<div class='product-row'>
                                    <div class='customer-info'>
                                        <div class='name'>{$row['customer_name']}</div>
                                        <div class='address'>{$row['customer_address']}</div>
                                    </div>
                                    <div></div>
                                    <div class='contact-info'>
                                        <div class='email'>{$row['contact_email']}</div>
                                        <div class='mobile'>{$row['contact_mobile']}</div>
                                    </div>
                                    <div class='product-info'>
                                        <div class='product'>{$row['product_name']}</div>
                                        <div class='details'>{$row['product_details']}</div>
                                    </div>
                                    <div class='total-amount'>
                                        Rs.{$row['total_amount']}
                                    </div>
                                  </div>";
                        }
                    } /*else {
                        echo "<div class='product-row'><div style='grid-column: 1/-1; text-align: center; padding: 20px;'>No completed orders found</div></div>";
                    }*/
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>