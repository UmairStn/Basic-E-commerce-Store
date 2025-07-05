<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetics Inventory</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Vogue Mart</div>
        <div class="nav-item active">Products</div>
        <div class="nav-item">Users</div>
        <div class="nav-item">Disputes</div>
        <div class="nav-item">Reports</div>
        <div class="tagline">
            Elevate your natural beauty with our premium cosmetic
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div></div>
            <div class="admin-profile">
                <span>Admin</span>
                <div class="admin-avatar"></div>
                <button class="logout-btn" onclick="logoutAdmin()">Logout</button>
            </div>
        </div>

        <!-- PRODUCT MANAGEMENT SECTION -->
        <div id="productManagementView"> 
            <div class="header">
                <div class="tabs">
                    <div class="tab active">Products</div>
                    <div class="tab">Categories</div>
                </div>
                <button type="button" class="add-product-btn" onclick="addNewProduct('addProduct')">
                    <div class="add-icon">+</div>
                    Add New Product
                </button>
                <button type="button" class="add-product-btn" onclick="editProductt('editProduct')">
                    <div class="add-icon">+</div>
                    Edit Product
                </button>
                <button type="button" class="add-product-btn" onclick="deleteProductt('deleteProduct')">
                    <div class="add-icon">+</div>
                    Delete Product
                </button>
            </div>
        
            <div class="product-table">
                <div class="table-header">
                   
                    <div>Name</div>
                    <div>Category</div>
                    <div>Quantity</div>
                    <div>Price</div>
                    <div>Actions</div>
                </div>

                <?php
                // Connect to database
                $con = mysqli_connect("localhost", "root", "", "ecommerce");
                
                // Check connection
                if(mysqli_connect_errno()) {
                    echo "<div class='product-row'><div colspan='6'>Failed to connect to MySQL: " . mysqli_connect_error() . "</div></div>";
                } else {
                    // Fetch all products
                    $sql = "SELECT * FROM productdetails";
                    $result = mysqli_query($con, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        // Output data for each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='product-row'>
                                    <div class='product-id' style='display:none'>" . $row["product_id"] . "</div>
                                    <div>" . $row["name"] . "</div>
                                    <div>" . $row["category"] . "</div>
                                    <div class='quantity-controls'>
                                        <button class='quantity-btn' onclick='changeQuantity(this, -1)'>-</button>
                                        <span class='quantity'>" . $row["quantity"] . "</span>
                                        <button class='quantity-btn' onclick='changeQuantity(this, 1)'>+</button>
                                    </div>
                                    <div class='price'>Rs." . $row["price"] . "</div>
                                    <div class='action-buttons'>
                                        <button class='edit-btn' onclick='editProduct(this)'>Edit</button>
                                        <button class='delete-btn' onclick='deleteProduct(\"" . $row["product_id"] . "\")'>Delete</button>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "<div class='product-row'><div colspan='6'>No products found</div></div>";
                    }
                }

                // Close the database connection
                ?>
            
                <!-- add new product form popup -->
                <div class="popup-overlay" id="addProductPopup">
                    <div class="popup-form">
                        <div class="popup-header">
                            <h2>Add New Product</h2>
                            <button type="button" class="close-popup" onclick="closePopupadd()">&times;</button>
                        </div>
                        
                        <form id="productForm" method="POST" action="database.php"> 
                            <div class="form-row">
                                <label for="product_id">Product ID</label>
                                <input type="text" id="product_id" placeholder="Enter product ID" name="product_id" required>
                            </div>
                            <div class="form-row">
                                <label for="name">Product Name</label>
                                <input type="text" id="name" placeholder="Enter product name" name="name" required>
                            </div>
                            <div class="form-row">
                                <label for="description">Product Description</label>
                                <input type="text" id="description" placeholder="Enter product Description" name="description">
                            </div>
                            <div class="form-row">
                                <label for="category">Category</label>
                                <select id="category" name="category" required>
                                    <option value="">Select a category</option>
                                    <option value="skincare">Skin Care</option>
                                    <option value="makeup">Makeup</option>
                                    <option value="haircare">Hair Care</option>
                                    <option value="fragrance">Fragrance</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label for="image">Product Image</label>
                                <input type="text" id="image"placeholder="Enter product image URL" name="image">
                            </div>
                            <div class="form-row">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" placeholder="Enter product quantity" name="quantity" min="0" value="0">
                            </div>
                            <div class="form-row">
                                <label for="price">Price (Rs.)</label>
                                <input type="number" id="price" placeholder="Enter product price" name="price">
                            </div>
                            <div class="form-buttons">
                                <button type="button" class="cancel-btn" onclick="closePopupadd()">Cancel</button>
                                <button type="submit" name="submit" value="Save Item" class="save-btn">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- edit product form popup -->
                <div class="popup-overlay" id="editProductPopup">
                    <div class="popup-form">
                        <div class="popup-header">
                            <h2>Edit Product</h2>
                            <button type="button" class="close-popup" onclick="closePopup()">&times;</button>
                        </div>
                        
                        <form id="productForm" method="POST" action="database.php"> 
                            <div class="form-row">
                                <label for="product_id">Product ID</label>
                                <input type="text" id="product_id" placeholder="Enter product ID" name="product_id" required>
                            </div>
                            <div class="form-row">
                                <label for="name">Product Name</label>
                                <input type="text" id="name" placeholder="Enter product name" name="name" required>
                            </div>
                            <div class="form-row">
                                <label for="description">Product Description</label>
                                <input type="text" id="description" placeholder="Enter product Description" name="description">
                            </div>
                            <div class="form-row">
                                <label for="category">Category</label>
                                <select id="category" name="category" required>
                                    <option value="">Select a category</option>
                                    <option value="skincare">Skin Care</option>
                                    <option value="makeup">Makeup</option>
                                    <option value="haircare">Hair Care</option>
                                    <option value="fragrance">Fragrance</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label for="image">Product Image</label>
                                <input type="text" id="image"placeholder="Enter product image URL" name="image">
                            </div>
                            <div class="form-row">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" placeholder="Enter product quantity" name="quantity" min="0" value="0">
                            </div>
                            <div class="form-row">
                                <label for="price">Price (Rs.)</label>
                                <input type="number" id="price" placeholder="Enter product price" name="price">
                            </div>
                            <div class="form-buttons">
                                <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
                                <button type="submit" name="submit" value="Edit Item" class="save-btn">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- delete product form popup -->
                <div class="popup-overlay" id="deleteProductPopup">
                    <div class="popup-form">
                        <div class="popup-header">
                            <h2>Delete Product</h2>
                            <button type="button" class="close-popup" onclick="closePopupdel()">&times;</button>
                        </div>
                        
                        <form id="deleteProductForm" method="POST" action="database.php"> 
                            <div class="form-row">
                                <label for="product_id">Product ID</label>
                                <input type="text" id="product_id" placeholder="Enter product ID" name="product_id" required>
                            </div>
                            <div class="form-buttons">
                                <button type="button" class="cancel-btn" onclick="closePopupdel()">Cancel</button>
                                <button type="submit" name="submit" value="Delete Item" class="delete-btn">Delete Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div> <!-- Closes productManagementView -->

        <!-- USER MANAGEMENT SECTION -->
        <div class="user-management-view" id="userManagementView" style="display:none;">
            <div class="header">
                <div class="tab active">User Management</div>
                <button class="add-user-btn" onclick="addNewUserPopup()">
                    <div class="add-icon">+</div>
                    Add New User
                </button>
            </div>

                        <div class="user-table-container">
                <div class="table-header user-table-header">
                    <div></div> <!-- For checkbox -->
                    <div>Name</div>
                    <div>Role</div>
                    <div>Email</div>
                    
                    <div>Actions</div>
                </div>
                <div id="userTableBody">
                    <?php
                    // Fetch users from database
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($con, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='user-row'>
                                    <div class='checkbox' onclick='toggleCheckbox(this)'></div>
                                    <div>{$row['name']}</div>
                                    <div>{$row['role']}</div>
                                    <div>{$row['email']}</div>
                                    <div class='action-buttons'>
                                        
                                        <button class='delete-btn' onclick='deleteUser({$row['id']})'>Delete</button>
                                    </div>
                                  </div>";
                        }
                    } else {
                        echo "<div class='user-row'><div colspan='6'>No users found</div></div>";
                    }
                    ?>
                </div>
            </div>

            <div class="popup-overlay" id="addUserPopup">
                    <div class="popup-form">
                        <div class="popup-header">
                            <h2>Add New User</h2>
                            <button type="button" class="close-popup" onclick="closePopup()">&times;</button>
                        </div>
                        <form id="userForm" method="POST" action="add_user.php"> 
                            <div class="form-row">
                                <label for="userName">Name</label>
                                <input type="text" id="userName" name="name" placeholder="Enter user name" required>
                            </div>
                            <div class="form-row">
                                <label for="userRole">Role</label>
                                <select id="userRole" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label for="userEmail">Email</label>
                                <input type="email" id="userEmail" name="email" placeholder="Enter User Email" required>
                            </div>
                            <div class="form-row">
                                <label for="loginCode">Login Code</label>
                                <input type="password" id="loginCode" name="login_code" placeholder="Enter Login Code" required>
                            </div>
                            <div class="form-buttons">
                                <button type="button" class="cancel-btn" onclick="closeUserPopup()">Cancel</button>
                                <button type="submit" class="save-btn">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



         <!-- dispute -->
        <div class="disputes-view" id="disputesManagementView" style="display:none;">
            <div class="header">
                <div class="tab active">Disputes</div>
            </div>

            <div class="dispute-table-container">
                <div class="table-header dispute-table-header">
                    <div></div> <!-- For checkbox -->
                    <div>Details</div>
                    <div>Type</div>
                </div>
                <div id="disputeTableBody">
                    <!-- Example Dispute Row -->
                    <div class="dispute-row">
                        <div class="checkbox" onclick="toggleCheckbox(this)"></div>
                        <div>Request to return</div>
                        <div>return</div>
                    </div>
                    <!-- More disputes will be added here by JS -->
                </div>
            </div>
        </div>

    </div> <!-- This closes main-content -->

</body>
</html>