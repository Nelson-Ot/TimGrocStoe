
    <?php include 'includes/header.php'; ?>

    <!-- New Hero Section -->
    <section class="hero">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/slider/jakub-kapusnak-vnNFWKY7Tj4-unsplash.jpg" alt="Fresh Vegetables">
                    <div class="slide-caption">
                        <h2>Fresh Vegetables at 20% Off!</h2>
                        <a href="product.html" class="btn">Shop Now</a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="images/slider/scott-warman-NpNvI4ilT4A-unsplash.jpg" alt="Buy 1 Get 1 Free">
                    <div class="slide-caption">
                        <h2>Buy 1 Get 1 Free on Selected Fruits</h2>
                        <a href="product.html" class="btn">Shop Now</a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="images/slider/sydney-rae-t4XYbj1q_Cc-unsplash.jpg" alt="Organic Products">
                    <div class="slide-caption">
                        <h2>Organic Products Now Available</h2>
                        <a href="product.html" class="btn">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
<!-- Toaster Notification Section -->
<div class="toaster">
    <img src="images/new-product.jpg" alt="New Product">
    <span>New Product Alert: Fresh Avocados now in stock!</span>
    <button class="toast-close">&times;</button>
</div>

<section class="products">
    <h2>Featured Products</h2>
    <div class="product-grid">
        <!-- Existing Products -->
        
        <?php foreach ($products as $product): ?>

        <div class="product-card">
      <div class="img-area">
        <img src="images/products/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <div class="overlay">
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
      
      <div class="info">
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <p class="price">Kes <?php echo number_format($product['price'], 2); ?> per <?php echo htmlspecialchars($product['measurement_unit']); ?></p>
        
      </div>
    </div>
    <?php  endforeach; ?>

    </div>
    <a href="product.php" class="view-more">View More Products</a>
</section>


    <footer>
        <div class="footer-content">
            <div class="location">
                <h3>Visit Us</h3>
                <p>123 FreshMart Street, Grocery Town</p>
            </div>
            <div class="contact-info">
                <h3>Contact Information</h3>
                <p><i class="fas fa-phone-alt"></i> +123 456 789</p>
                <p><i class="fas fa-envelope"></i> support@freshmart.com</p>
            </div>
            <div class="social-media">
                <h3>Follow Us</h3>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
     <script src="assets/JS/index.js"></script>
         <!-- custom -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    
</body>
</html>
