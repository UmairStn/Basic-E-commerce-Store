let cart = [];

document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    updateCartCount();
});

function loadCart() {
    cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItems = document.getElementById('cartItems');
    let subtotal = 0;

    cartItems.innerHTML = '';

    if(cart.length === 0) {
        cartItems.innerHTML = '<p class="empty-cart">Your cart is empty</p>';
        updateTotals(0);
        return;
    }

    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        cartItems.innerHTML += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <h3>${item.name}</h3>
                    <p class="item-description">${item.description}</p>
                    <p class="item-price">Rs.${item.price}</p>
                </div>
                <div class="quantity-controls">
                    <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</button>
                </div>
                <p class="item-total">Rs.${itemTotal}</p>
                <button class="remove-btn" onclick="removeItem(${index})">×</button>
            </div>
        `;
    });

    updateTotals(subtotal);
}

function updateTotals(subtotal) {
    const shipping = 50;
    const total = subtotal + shipping;
    document.getElementById('subtotal').textContent = `Rs.${subtotal.toFixed(2)}`;
    document.getElementById('total').textContent = `Rs.${total.toFixed(2)}`;
}

function updateQuantity(index, change) {
    cart[index].quantity = Math.max(1, (cart[index].quantity || 1) + change);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
    updateCartCount();
}

function removeItem(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
    updateCartCount();
}

function updateCartCount() {
    const count = cart.reduce((total, item) => total + (item.quantity || 1), 0);
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
        cartCount.textContent = count;
    }
}

document.getElementById('checkoutBtn').addEventListener('click', function() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }
    showCheckout();
});

function showCheckout() {
    const popup = document.getElementById('checkoutPopup');
    const totalAmount = document.getElementById('total').textContent.replace('Rs.', '');
    document.getElementById('totalAmount').value = totalAmount;
    popup.style.display = 'flex';
}

function closeCheckout() {
    document.getElementById('checkoutPopup').style.display = 'none';
}

document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(this);
    formData.append('cart', JSON.stringify(cart));

    // Submit order
    fetch('process_checkout.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Order placed successfully!');
            // Clear cart
            cart = [];
            localStorage.removeItem('cart');
            // Redirect to cart page
            window.location.href = 'cart.php';
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing your order');
    });
});

function addToCart(product) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const existingProduct = cart.find(item => item.product_id === product.product_id);
    
    if(existingProduct) {
        existingProduct.quantity++;
    } else {
        cart.push({...product, quantity: 1});
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    showNotification('Product added to cart!');
}

function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    document.getElementById('cartCount').textContent = cart.length;
}