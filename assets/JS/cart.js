// Function to increase item quantity
function increaseQuantity(button) {
    const quantityInput = button.previousElementSibling;
    quantityInput.value = parseInt(quantityInput.value) + 1;
    updateCartSummary();
}

// Function to decrease item quantity
function decreaseQuantity(button) {
    const quantityInput = button.nextElementSibling;
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
        updateCartSummary();
    }
}

// Function to remove an item from the cart
function removeItem(button) {
    const cartItem = button.parentElement.parentElement;
    cartItem.remove();
    updateCartSummary();
}

// Function to update cart summary
function updateCartSummary() {
    const quantities = document.querySelectorAll('.item-quantity');
    let totalItems = 0;
    let totalPrice = 0;

    quantities.forEach(quantityInput => {
        const quantity = parseInt(quantityInput.value);
        totalItems += quantity;

        // Assuming price is the same for all items
        const price = parseFloat(quantityInput.parentElement.previousElementSibling.innerText.replace('$', ''));
        totalPrice += price * quantity;
    });

    document.getElementById('total-items').innerText = totalItems;
    document.getElementById('total-price').innerText = `$${totalPrice.toFixed(2)}`;
}

// Function to update the cart icon count
function updateCartIcon() {
    const cartCountElement = document.getElementById('cart-count');
    
    // Retrieve cart items from localStorage (or from a backend)
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    
    // Update the cart count
    cartCountElement.textContent = cartItems.length;
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', () => {
    updateCartIcon();
});

// Function to add an item to the cart (for demonstration purposes)
function addToCart(item) {
    // Retrieve existing cart items from localStorage
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    
    // Add new item to cart
    cartItems.push(item);
    
    // Save updated cart to localStorage
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    
    // Update cart icon
    updateCartIcon();
}

// Function to remove an item from the cart (for demonstration purposes)
function removeFromCart(itemId) {
    // Retrieve existing cart items from localStorage
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    
    // Remove item from cart
    cartItems = cartItems.filter(item => item.id !== itemId);
    
    // Save updated cart to localStorage
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    
    // Update cart icon
    updateCartIcon();
}
