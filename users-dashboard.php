<?php
include 'includes/header.php'; 
// session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'grocery_management';
$user = 'root'; // Update your credentials
$pass = ''; // Update your credentials

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch user details
$user_id = $_SESSION['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch user's completed orders count
$order_stmt = $conn->prepare("SELECT COUNT(*) AS completed_orders FROM orders WHERE user_id = ? AND status = 'completed'");
$order_stmt->execute([$user_id]);
$order_data = $order_stmt->fetch(PDO::FETCH_ASSOC);
$completed_orders = $order_data['completed_orders'];

?>

    <div class="dashboard-container">
        <h1>Welcome, <?php echo $user['name']; ?>!</h1>

        <div class="section-container">

            <!-- Billing Information Section -->
            <section class="section user-info">
                <h2>Billing Information</h2>
                <form action="update_billing.php" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>">

                    <button type="submit">Update Info</button>
                </form>
            </section>

            <!-- Order Summary Section -->
            <section class="section orders">
                <h2>Order Summary</h2>
                <p>You have completed <strong><?php echo $completed_orders; ?></strong> orders.</p>
                <button class="view-orders" onclick="window.location.href='view-orders.php';">View All Orders</button>
            </section>

            <!-- Cart Section -->
            <section class="section cart">
                <h2>Your Cart</h2>
                <p>View and manage items in your cart.</p>
                <button class="view-cart" onclick="window.location.href='view-cart.php';">View Cart</button>
            </section>

            <!-- Password Change Section -->
            <section class="section password-change">
                <h2>Change Password</h2>
                <form action="change_password.php" method="POST">
                    <label for="old_password">Old Password:</label>
                    <input type="password" id="old_password" name="old_password" required>

                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>

                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>

                    <button type="submit">Change Password</button>
                </form>
            </section>

            <!-- Logout Section -->
            <section class="section logout">
                <a href="logout.php">Logout</a>
            </section>
        </div>
    </div>
</body>
</html>
