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
        <div class="logo">Logo</div>
        <div class="nav-item active">Inventory</div>
        <div class="nav-item">Staffs</div>
        <div class="tagline">
            Elevate your natural beauty with our premium cosmetic
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div></div>
            <div class="admin-profile">
                <span>Supervior</span>
                <div class="admin-avatar"></div>
            </div>
        </div>

        <!-- INVENTORY SECTION -->
        <div id="inventoryView"> 
            <div class="tabs">
                <div class="tab active" id="invent">Products</div>

            </div>
        
            <div class="product-table">
                <div class="table-header">
                    <div></div>
                    <div>Name</div>
                    <div>Category</div>
                    <div>Quantity</div>
                    <div>Price</div>
                </div>
            
                <div class="product-row">
                    <div class="checkbox"></div>
                    <div>Sunscreen - Spf 100</div>
                    <div>Skin Care</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="changeQuantity(this, -1)">-</button>
                        <span class="quantity">0</span>
                        <button class="quantity-btn" onclick="changeQuantity(this, 1)">+</button>
                    </div>
                    <div class="price">Rs.6500</div>
                    
                </div>

                <div class="product-row">
                    <div class="checkbox"></div>
                    <div>Sunscreen - Spf 100</div>
                    <div>Skin Care</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="changeQuantity(this, -1)">-</button>
                        <span class="quantity">0</span>
                        <button class="quantity-btn" onclick="changeQuantity(this, 1)">+</button>
                    </div>
                    <div class="price">Rs.6500</div>
                    
                </div>
                
            </div> 
        </div> <!-- inventoryView -->


        <div class="staff-view" id="staffView" style="display:none;">
            <div class="header">
                <div class="tab active">Disputes</div>
            </div>

            <div class="staff-table-container">
                <div class="table-header staff-table-header">
                    <div></div> <!-- For checkbox -->
                    <div>Details</div>
                    <div>Type</div>
                </div>
                <div id="staffTableBody">
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