// Function to calculate and update the total amount on the checkout page
function calculateTotal() {
    // You could pull the items from localStorage or a cart array to calculate the total
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    let total = 0;

    cartItems.forEach(item => {
        total += item.price;
    });

    document.getElementById('order-total-amount').textContent = `$${total.toFixed(2)}`;
}

// Place Order Function (currently only logs form data)
function placeOrder() {
    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;
    const city = document.getElementById('city').value;
    const country = document.getElementById('country').value;

    // Log the form details (you can send them to a server here)
    console.log(`Order placed by: ${fullName}, Email: ${email}, Address: ${address}, City: ${city}, Country: ${country}`);

    // You can send this data to your server using AJAX or fetch API for backend processing
    alert('Your order has been placed successfully!');
}

// Ensure total is calculated on page load
document.addEventListener('DOMContentLoaded', () => {
    calculateTotal();
});
