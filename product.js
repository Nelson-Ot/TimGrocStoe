document.addEventListener("DOMContentLoaded", () => {
    const products = [
        { id: 1, name: "Apple", price: "kes300/kg", image: "images/products_home/badreddine-wider-nGkxwUQdcU4-unsplash.jpg", inStock: true },
        { id: 2, name: "Banana", price: "kes200/kg", image: "images/products_home/badreddine-wider-nGkxwUQdcU4-unsplash.jpg", inStock: true },
        { id: 3, name: "Orange", price: "kes500/kg", image: "images/products_home/badreddine-wider-nGkxwUQdcU4-unsplash.jpg", inStock: false },
        { id: 4, name: "Mango", price: "kes380/kg", image: "images/products_home/badreddine-wider-nGkxwUQdcU4-unsplash.jpg", inStock: true },
        { id: 5, name: "Pineapple", price: "kes600/kg", image: "images/products_home/badreddine-wider-nGkxwUQdcU4-unsplash.jpg", inStock: true },
        { id: 6, name: "Grapes", price: "kes800/kg", image: "images/products_home/badreddine-wider-nGkxwUQdcU4-unsplash.jpg", inStock: false },
    ];

    const productGrid = document.getElementById("product-grid");
    const searchInput = document.getElementById("search-input");
    const searchButton = document.getElementById("search-button");
    const cartCountElement = document.querySelector(".cart-count");
    let cartCount = 0;

    function displayProducts(productsToDisplay) {
        productGrid.innerHTML = "";

        if (productsToDisplay.length === 0) {
            productGrid.innerHTML = "<p>Product Not Found</p>";
            return;
        }

        productsToDisplay.forEach((product) => {
            const productCard = document.createElement("div");
            productCard.classList.add("product-card");
            if (!product.inStock) {
                productCard.classList.add("out-of-stock");
            }

            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>${product.price}</p>
                <p class="stock-status">${product.inStock ? "In Stock" : "Out of Stock"}</p>
                <button class="btn add-to-cart" ${!product.inStock ? "disabled" : ""}>Add to Cart</button>
            `;

            productCard.querySelector(".add-to-cart").addEventListener("click", () => {
                cartCount++;
                updateCartCount();
            });

            productGrid.appendChild(productCard);
        });
    }

    function updateCartCount() {
        cartCountElement.textContent = cartCount;
    }

    function searchProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredProducts = products.filter((product) =>
            product.name.toLowerCase().includes(searchTerm)
        );
        displayProducts(filteredProducts);
    }

    searchButton.addEventListener("click", searchProducts);
    searchInput.addEventListener("keyup", searchProducts);

    // Initial display of products
    displayProducts(products);
});
