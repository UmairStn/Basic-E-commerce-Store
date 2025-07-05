console.log("Script.js loaded successfully!");

function testFunction() {
    alert("JavaScript is working!");
}

// Product management functions
function toggleCheckbox(checkbox) {
    checkbox.classList.toggle('checked');
}

function changeQuantity(button, change) {
    const quantitySpan = button.parentElement.querySelector('.quantity');
    let currentQuantity = parseInt(quantitySpan.textContent);
    currentQuantity = Math.max(0, currentQuantity + change);
    quantitySpan.textContent = currentQuantity;
}

// This function needs to accept a parameter to match your HTML
function addNewProduct(formId) {
    console.log("Opening popup for", formId);
    document.getElementById('addProductPopup').style.display = 'flex';
}
function closePopupadd() {
    console.log("Closing popup");
    document.getElementById('addProductPopup').style.display = 'none';
}

function editProductt(formId) {
    console.log("Opening popup for", formId);
    document.getElementById('editProductPopup').style.display = 'flex';
}
function closePopup() {
    console.log("Closing popup");
    document.getElementById('editProductPopup').style.display = 'none';
}

function deleteProductt(formId) {
    console.log("Opening popup for", formId);
    document.getElementById('deleteProductPopup').style.display = 'flex';
}
function closePopupdel() {
    console.log("Closing delete popup");
    document.getElementById('deleteProductPopup').style.display = 'none';
}



function addNewUserPopup(formId) {
    console.log("Opening popup for", formId);
    document.getElementById('addUserPopup').style.display = 'flex';
}
function closeUserPopup() {
    console.log("Closing popup");
    document.getElementById('addUserPopup').style.display = 'none';
}


// Add navigation functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get all nav items
    const navItems = document.querySelectorAll('.sidebar .nav-item');
    
    // Get the content sections
    const productView = document.getElementById('productManagementView');
    const userView = document.getElementById('userManagementView');
    const disputesView = document.getElementById('disputesManagementView');
    
    // Add click handler to each nav item
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked nav item
            this.classList.add('active');
            
            // Get the text of the clicked nav item
            const viewName = this.textContent.trim().toLowerCase();
            
            // show or hide  content
            if (viewName === 'products') {
                productView.style.display = 'block';
                userView.style.display = 'none';
                 disputesView.style.display = 'none';
            } 
            else if (viewName === 'users') {
                productView.style.display = 'none';
                userView.style.display = 'block';
                disputesView.style.display = 'none';
            }
            else if (viewName === 'disputes') {
                productView.style.display = 'none';
                userView.style.display = 'none';
                disputesView.style.display = 'block';
            }
        });
    });
});

// Add navigation functionality for inventory and staff views
document.addEventListener('DOMContentLoaded', function() {
    // Get all navigation items
    const navItems = document.querySelectorAll('.sidebar .nav-item');
    
    // Get the view containers
    const staffView = document.getElementById('compeletedOrdersView');
    
    // Add click event listeners to each nav item
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to the clicked item
            this.classList.add('active');
            
            // Show the appropriate view based on the clicked item
            const viewName = this.textContent.trim().toLowerCase();
            
            console.log('Clicked nav item:', viewName); // Debug log
            
            if (viewName === 'completed orders') {
                // Hide the main orders table
                document.querySelector('.product-table').style.display = 'none';
                // Show completed orders view
                staffView.style.display = 'block';
                console.log('Showing completed orders view'); // Debug log
            } else if (viewName === 'staff') {
                // Show the main orders table
                document.querySelector('.product-table').style.display = 'block';
                // Hide completed orders view
                staffView.style.display = 'none';
                console.log('Showing main staff view'); // Debug log
            }
        });
    });
});



//Login functionality
let selectedUserRole = '';

function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    const arrow = document.getElementById('dropdown-arrow');
    
    dropdown.classList.toggle('open');
    arrow.classList.toggle('rotated');
}

function selectRole(role) {
    selectedUserRole = role;
    document.getElementById('selected-role').textContent = role;
    toggleDropdown();
}

//login function
function handleLogin(event) {
    event.preventDefault();
    
    const role = document.getElementById('selected-role').textContent;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    console.log('Role:', role);
    console.log('Username:', username);
    console.log('Password:', password);
    
    // Check if role is selected
    if (role === 'User Role') {
        alert('Please select a user role');
        return;
    }
    
    // Check if username and password are entered
    if (!username || !password) {
        alert('Please enter both username and password');
        return;
    }
    
    // Admin credentials
    const adminUsername = "umr";
    const adminPassword = "umr123";
    
    /*console.log('Admin Username:', adminUsername);
    console.log('Admin Password:', adminPassword);*/
    
    // Redirect based on the selected role
    if (role === 'Admin') {
        console.log('Checking admin credentials...');
        if (username === adminUsername && password === adminPassword) {
            console.log('Admin credentials correct - redirecting');
            window.location.href = 'admin.php';
        } else {
            console.log('Admin credentials incorrect');
            alert('Invalid admin credentials! Please check your username and password.');
            return;
        }
    } else if (role === 'Staff') {
        console.log('Checking staff credentials in database...');
        
        // Send AJAX request to verify staff credentials
        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);
        formData.append('role', 'Staff');
        
        fetch('verify_login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Get text first to debug
        })
        .then(text => {
            console.log('Raw response:', text);
            try {
                const data = JSON.parse(text);
                if(data.success) {
                    console.log('Staff credentials correct - redirecting');
                    window.location.href = 'staff.php';
                } else {
                    console.log('Staff credentials incorrect:', data.message);
                    alert('Invalid staff credentials! ' + data.message);
                }
            } catch(e) {
                console.error('JSON parse error:', e);
                console.error('Response text:', text);
                alert('Server error. Please check console for details.');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Error verifying credentials. Please try again.');
        });
    }
}

// Replace or add the editProduct function:

function editProduct(button) {
    const row = button.closest('.product-row');
    const product_id = row.querySelector('.product-id').textContent;
    
    fetch(`database.php?action=edit&product_id=${product_id}`)
        .then(response => response.json())
        .then(data => {
            const popup = document.getElementById('addProductPopup');
            const form = document.getElementById('productForm');
            
            // Fill form with product data
            form.querySelector('[name="product_id"]').value = data.product_id;
            form.querySelector('[name="name"]').value = data.name;
            form.querySelector('[name="description"]').value = data.description;
            form.querySelector('[name="category"]').value = data.category;
            form.querySelector('[name="image"]').value = data.image;
            form.querySelector('[name="quantity"]').value = data.quantity;
            form.querySelector('[name="price"]').value = data.price;
            
            // Change submit button value
            form.querySelector('[type="submit"]').value = 'Edit Item';
            
            // Show popup
            popup.style.display = 'flex';
        })
        .catch(error => console.error('Error:', error));
}

function deleteProduct(productId) {
    if(confirm('Are you sure you want to delete this product?')) {
        window.location.href = 'database.php?action=delete&product_id=' + productId;
    }
}

function editOrder(orderId) {
    // Add edit functionality
    console.log('Editing order:', orderId);
}

function completeOrder(orderId) {
    if(confirm('Are you sure you want to mark this order as completed?')) {
        // Find the order row that contains this order
        const orderRows = document.querySelectorAll('.product-row');
        let orderData = null;
        let orderRowToRemove = null;
        
        orderRows.forEach(row => {
            const completeBtn = row.querySelector('.complete-btn');
            if (completeBtn && completeBtn.getAttribute('onclick').includes(orderId)) {
                orderRowToRemove = row;
                
                // Extract order data from the row using the actual structure
                const customerName = row.querySelector('.customer-info .name').textContent;
                const customerAddress = row.querySelector('.customer-info .address').textContent;
                const contactEmail = row.querySelector('.contact-info .email').textContent;
                const contactMobile = row.querySelector('.contact-info .mobile').textContent;
                const productName = row.querySelector('.product-info .product').textContent;
                const productDetails = row.querySelector('.product-info .details').textContent;
                const totalAmount = row.querySelector('.total-amount').textContent.replace('Rs.', '').trim();
                
                orderData = {
                    order_id: orderId,
                    customer_name: customerName,
                    customer_address: customerAddress,
                    contact_email: contactEmail,
                    contact_mobile: contactMobile,
                    product_name: productName,
                    product_details: productDetails,
                    total_amount: totalAmount
                };
            }
        });
        
        if (orderData && orderRowToRemove) {
            // Send data to PHP script to save in database
            const formData = new FormData();
            formData.append('order_id', orderData.order_id);
            formData.append('customer_name', orderData.customer_name);
            formData.append('customer_address', orderData.customer_address);
            formData.append('contact_email', orderData.contact_email);
            formData.append('contact_mobile', orderData.contact_mobile);
            formData.append('product_name', orderData.product_name);
            formData.append('product_details', orderData.product_details);
            formData.append('total_amount', orderData.total_amount);
            
            fetch('complete_order.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if(data === 'success') {
                    // Remove from orders page
                    orderRowToRemove.remove();
                    
                    // Add to completed orders page with proper structure
                    const completedOrdersBody = document.getElementById('orderTableBody');
                    const newOrderRow = document.createElement('div');
                    newOrderRow.className = 'product-row';
                    newOrderRow.innerHTML = `
                        <div class='customer-info'>
                            <div class='name'>${orderData.customer_name}</div>
                            <div class='address'>${orderData.customer_address}</div>
                        </div>
                        <div></div>
                        <div class='contact-info'>
                            <div class='email'>${orderData.contact_email}</div>
                            <div class='mobile'>${orderData.contact_mobile}</div>
                        </div>
                        <div class='product-info'>
                            <div class='product'>${orderData.product_name}</div>
                            <div class='details'>${orderData.product_details}</div>
                        </div>
                        <div class='total-amount'>
                            Rs.${orderData.total_amount}
                        </div>
                    `;
                    
                    completedOrdersBody.appendChild(newOrderRow);
                    
                    alert('Order marked as completed and saved to database!');
                    
                    // Check if no orders left in main table
                    const remainingOrders = document.querySelectorAll('.product-table .product-row');
                    if (remainingOrders.length === 0) {
                        const productTable = document.querySelector('.product-table');
                        const noOrdersRow = document.createElement('div');
                        noOrdersRow.className = 'product-row';
                        noOrdersRow.innerHTML = "<div style='grid-column: 1/-1; text-align: center; padding: 20px;'>No orders found</div>";
                        productTable.appendChild(noOrdersRow);
                    }
                } else {
                    alert('Error saving completed order to database: ' + data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error completing order');
            });
        }
    }
}

function addNewUserPopup() {
    document.getElementById('addUserPopup').style.display = 'flex';
}

function closeUserPopup() {
    document.getElementById('addUserPopup').style.display = 'none';
    document.getElementById('userForm').reset();
}

// Update the existing toggleView function to include user management
function toggleView(viewName) {
    document.getElementById('productManagementView').style.display = 'none';
    document.getElementById('userManagementView').style.display = 'none';
    document.getElementById('disputesManagementView').style.display = 'none';

    document.getElementById(viewName).style.display = 'block';

    // Update active nav item
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.classList.add('active');
}

function logoutAdmin() {
    if (confirm('Are you sure you want to logout?')) {
        // Clear any session data and redirect to login
        window.location.href = 'homepage/home.php';
    }
}

function showOrdersView() {
    document.querySelector('.product-table').style.display = 'block';
    document.getElementById('compeletedOrdersView').style.display = 'none';
    
    // Update active nav
    document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
    event.target.classList.add('active');
}

function showCompletedOrders() {
    document.querySelector('.product-table').style.display = 'none';
    document.getElementById('compeletedOrdersView').style.display = 'block';
    
    // Update active nav
    document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
    event.target.classList.add('active');
}

// Delete user function
function deleteUser(userId) {
    if(confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        window.location.href = 'database.php?action=delete_user&user_id=' + userId;
    }
}

// Delete order function (using database.php)
function deleteOrder(orderId) {
    if(confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
        window.location.href = 'database.php?action=delete_order&order_id=' + orderId;
    }
}

// Edit user function (if not already exists)
function editUser(userId) {
    // Add your edit user functionality here
    alert('Edit user functionality - User ID: ' + userId);
    // You can open an edit popup similar to edit product
}

