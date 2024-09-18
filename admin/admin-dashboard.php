<?php
session_start();

// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
$adminName = isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- Font Awesome CDN for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="admin-header">
        <div class="logo">
            <h1>Admin Panel</h1>
        </div>
        <nav class="admin-nav">
            <a href="admin-dashboard.php">Dashboard</a>
            <a href="manage-products.php">Products</a>
            <a href="admin-orders.php">Orders</a>
            <a href="admin-customers.php">Customers</a>
            <a href="admin-categories.php">Categories</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="dashboard">
        <h2><?php echo $adminName ?> , Welcome to the Admin Dashboard</h2>

        <div class="stats-container">
            <div class="stat-box">
                <i class="fas fa-dollar-sign"></i>
                <h3>Total Sales</h3>
                <p>$50,000</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-shopping-cart"></i>
                <h3>Total Orders</h3>
                <p>150</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-box-open"></i>
                <h3>Products</h3>
                <p>75</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-users"></i>
                <h3>Customers</h3>
                <p>45</p>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <section class="recent-orders">
            <h3>Recent Orders</h3>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1234</td>
                        <td>John Doe</td>
                        <td>09/15/2024</td>
                        <td>$120.50</td>
                        <td><span class="status completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>#1235</td>
                        <td>Jane Smith</td>
                        <td>09/14/2024</td>
                        <td>$75.00</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>#1236</td>
                        <td>Mike Johnson</td>
                        <td>09/14/2024</td>
                        <td>$45.25</td>
                        <td><span class="status processing">Processing</span></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2024 Grocery Management System</p>
    </footer>
</body>
</html>
