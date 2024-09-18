<?php

// $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

session_start();
include 'connect.php';
// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// adding categories
if(isset($_POST['submit']))
    {
    $cname=$_POST['cat_name'];   
        $sql=mysqli_query($conn,"select name from categories where name='$cname'");
        $row=mysqli_num_rows($sql);
        if($row>0)
        {
            echo "<script>alert('category name exists in the system. Please try with another category name');</script>";
        } else{
            $msg=mysqli_query($conn,"insert into categories(name) values('$cname')");
        
        if($msg)
        {
            echo "<script>alert('category added successfully');</script>";
            $extra = "admin-categories.php";
     echo "<script>window.location.href='" . $extra . "'</script>";
     exit();
        }
        }
        }
// deleteing categories
// for deleting user
if (isset($_GET['delete_id'])) {
    $catid = $_GET['delete_id'];
    $msg = mysqli_query($conn, "delete from categories where id='$catid'");
    if ($msg) {
        echo "<script>alert('Data deleted');</script>";
        $extra = "admin-categories.php?succes";
     echo "<script>window.location.href='" . $extra . "'</script>";

        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
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
        <h1>Manage Categories</h1>

        <!-- Add Category Form -->
        <form action="" method="POST">
            <h2>Add New Category</h2>
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="cat_name" required>
            </div>
            <button type="submit" name="submit">Add Category</button>
        </form>

        <!-- Category Table -->
        <h2>Category List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
                    <?php
                                $category = mysqli_query($conn, "select * from categories");
                                $cnt = 1;
                                 while ($row = mysqli_fetch_array($category)) {    ?>
                <tr>
                    <td><?php echo $cnt ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <!-- <a href="manage-categories.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a> -->
                        <a href="admin-categories.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php   $cnt++; } ?>

            </tbody>
        </table>
    </div>
</body>
</html>
