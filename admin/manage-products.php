<?php
session_start();


include 'connect.php';
// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

   /// for deleting product
   if (isset($_GET['delete'])) {
    $adminid = $_GET['delete'];
    $msg = mysqli_query($conn, "delete from products where id='$adminid'");
    if ($msg) {
        echo "<script>alert('Data deleted successfully');</script>";
        echo "<script>window.location.href='manage-products.php?success'</script>";
    }
}

// Fetch products and their categories from the database
$products = mysqli_query($conn, "select * from products");
$cnt = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="assets/style.css">
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
    <div class="cat-container">
        <h1>Manage Products</h1>
        <a href="add-products.php" class="add-product-btn">+ Add Product</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Measurement Unit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $cnt ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td> <?php $cat= $conn->query("select * from categories where id=".$product['category_id']."")->fetch_assoc(); echo $cat['name'];?></td>
                    <td><?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="50">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($product['measurement_unit']); ?></td>
                    <td>
                        <a href="edit-product.php?id=<?php echo $product['id']; ?>">Edit</a> |
                        <a href="manage-products.php?delete=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php  endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
