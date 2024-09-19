<?php 
session_start();
include 'db.php';

// Fetch products and their categories from the database
$products = mysqli_query($conn, "select * from products");


?>

<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshMart - Online Grocery Store</title>
    <link rel="stylesheet" href="assets/css/styles.css">
     <!-- <link rel="stylesheet" href="tyest.css"> -->

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
<header>
        <div class="top-bar">
            <div class="contact-info">
                <span><i class="fas fa-phone-alt"></i> +123 456 789</span>
                <span><i class="fas fa-envelope"></i> support@freshmart.com</span>
            </div>
            <div class="social-media">
                <a href="login.php">login</a>  <a href="register.php">register</a> 
            </div>
        </div>
        <nav>
            <div class="logo">
                <h1>FreshMart</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <li><a href="#">Offers</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <div class="nav-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i><span class="cart-count" id="cart-count">0</span></a>
                <a href="#"><i class="fas fa-user"></i></a>
            </div>
        </nav>
    </header>