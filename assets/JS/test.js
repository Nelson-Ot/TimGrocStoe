const slides = document.querySelectorAll('.slide');
let currentSlide = 0;

document.querySelector('.next').addEventListener('click', () => {
    changeSlide(1);
});

document.querySelector('.prev').addEventListener('click', () => {
    changeSlide(-1);
});

function changeSlide(direction) {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
}


// Increase quantity
function increaseQuantity() {
    let quantityInput = document.getElementById("product-quantity");
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
}

// Decrease quantity (but not less than 1)
function decreaseQuantity() {
    let quantityInput = document.getElementById("product-quantity");
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}
