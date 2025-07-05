<?php
// Connect to database
$con = mysqli_connect("localhost", "root", "", "ecommerce");

// Check connection
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// adding a product
if(isset($_POST['submit']) && $_POST['submit'] == 'Save Item') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    
    $sql = "INSERT INTO productdetails(product_id, name, description, category, image, quantity, price) 
            VALUES ('$product_id', '$name', '$description', '$category', '$image', '$quantity', '$price')";
    
    $result = mysqli_query($con, $sql);
    
    if($result) {
        echo "<script>
                alert('Product added successfully');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Error inserting data: " . mysqli_error($con) . "');
                window.location.href = 'admin.php';
              </script>";
    }
}

// editing a product
if(isset($_GET['action']) && $_GET['action'] == 'edit') {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM productdetails WHERE product_id='$product_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($row) {
        echo json_encode($row);
        exit;
    }
}

if(isset($_POST['submit']) && $_POST['submit'] == 'Edit Item') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    
    $sql = "UPDATE productdetails SET 
            name='$name', 
            description='$description', 
            category='$category', 
            image='$image', 
            quantity='$quantity', 
            price='$price' 
            WHERE product_id='$product_id'";
    
    $result = mysqli_query($con, $sql);
    
    if($result) {
        echo "<script>
                alert('Details updated successfully');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating data: " . mysqli_error($con) . "');
                window.location.href = 'admin.php';
              </script>";
    }
}

// Check connection
if(mysqli_connect_errno()) {
    echo "<tr><td colspan='6'>Failed to connect to MySQL: " . mysqli_connect_error() . "</td></tr>";
} else {
    // Fetch all food items
    $sql = "SELECT * FROM productdetails";
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        // Output data for each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td>$" . $row["price"] . "</td>
                    <td>" . $row["quantity"] . "</td>
                    <td class='action-buttons'>
                        <button class='btn-success' style='padding: 5px 10px;' onclick='editProduct(\"" . $row["product_id"] . "\")'>Edit</button>
                        <button class='btn-danger' style='padding: 5px 10px;' onclick=\"window.location='database.php?action=delete&product_id=" . $row["product_id"] . "'\">Delete</button>
                    </td>
                    </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No food items found</td></tr>";
    }
    
    
}


// direct deleting product
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['product_id'])) {
    $product_id = mysqli_real_escape_string($con, $_GET['product_id']);
    
    $sql = "DELETE FROM productdetails WHERE product_id = '$product_id'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        echo "<script>
                alert('Product deleted successfully');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting product: " . mysqli_error($con) . "');
                window.location.href = 'admin.php';
              </script>";
    }
    exit();
}

// Delete product by ID from form
if(isset($_POST['submit']) && $_POST['submit'] == 'Delete Item') {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    
    // Check if product exists
    $check_sql = "SELECT product_id FROM productdetails WHERE product_id = '$product_id'";
    $check_result = mysqli_query($con, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        $sql = "DELETE FROM productdetails WHERE product_id = '$product_id'";
        $result = mysqli_query($con, $sql);
        
        if($result) {
            echo "<script>
                    alert('Product deleted successfully');
                    window.location.href = 'admin.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error deleting product: " . mysqli_error($con) . "');
                    window.location.href = 'admin.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Product ID not found');
                window.location.href = 'admin.php';
              </script>";
    }
    exit();
}

// Delete user by ID
if(isset($_GET['action']) && $_GET['action'] == 'delete_user' && isset($_GET['user_id'])) {
    $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
    
    $sql = "DELETE FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        echo "<script>
                alert('User deleted successfully');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting user: " . mysqli_error($con) . "');
                window.location.href = 'admin.php';
              </script>";
    }
    exit();
}

// Delete order for staff
if(isset($_GET['action']) && $_GET['action'] == 'delete_order' && isset($_GET['order_id'])) {
    $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
    
    $sql = "DELETE FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        echo "<script>
                alert('Order deleted successfully!');
                window.location.href = 'staff.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting order: " . mysqli_error($con) . "');
                window.location.href = 'staff.php';
              </script>";
    }
    exit();
}
?>