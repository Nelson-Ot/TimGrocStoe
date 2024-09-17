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
