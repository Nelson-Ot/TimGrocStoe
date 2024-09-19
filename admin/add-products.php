<?php
session_start();

include 'connect.php';
// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// resize the image
function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
    {
        $resizeWidth = 600;
        $resizeHeight = 600;
        $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
        $background = imagecolorallocate($imageLayer, 0, 0, 0);
        imagecolortransparent($imageLayer, $background);
        imagealphablending($imageLayer, false);
        imagesavealpha($imageLayer, true);
        imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
        return $imageLayer;
    }

    // insert data to the db
                            if (isset($_POST['submit'])) {

                                $productName = mysqli_real_escape_string($conn, $_POST['product_name']);

                                $catname = $_POST['category_id'];
                                $pprice =  $_POST['price'];
                                $pdesc = mysqli_real_escape_string($conn, $_POST['description']);
                                $fileName = $_FILES['pimg']['tmp_name'];
                                $sourceProperties = getimagesize($fileName);
                                $resizeFileName = time();
                                $uploadPath = "../images/products/";
                                $fileExt = pathinfo($_FILES['pimg']['name'], PATHINFO_EXTENSION);
                                $uploadImageType = $sourceProperties[2];
                                $sourceImageWidth = $sourceProperties[0];
                                $sourceImageHeight = $sourceProperties[1];
                                $new_width = $sourceImageWidth;
                                $new_height = $sourceImageHeight;
                                switch ($uploadImageType) {
                                    case IMAGETYPE_JPEG:
                                        $resourceType = imagecreatefromjpeg($fileName);
                                        $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                        imagejpeg($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                        break;

                                    case IMAGETYPE_GIF:
                                        $resourceType = imagecreatefromgif($fileName);
                                        $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                        imagegif($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                        break;

                                    case IMAGETYPE_PNG:

                                        $resourceType = imagecreatefrompng($fileName);
                                        $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                        imagepng($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);

                                        break;

                                    default:
                                        $imageProcess = 0;
                                        break;
                                }

                                $url =  "thump_" . $resizeFileName . "." . $fileExt;
                                $m_unit =  $_POST['measurement_unit'];

                                
                                
                                $sql =  $conn->query("insert into products(`name`,`category_id`,`price`,`description`,`image`,`measurement_unit`)values('" . $productName . "'," . $catname . ",'" . $pprice . "','" . $pdesc . "','" . $url . "','". $m_unit ."')");

                                if ($sql) {
                                    $extra="manage-products.php?succes";
                                    echo "<script>window.location.href='".$extra."'</script>";
                                    exit();
                                } else {
                                    echo "<script>Alert('something went wrong');</script>";
                                }

                            
                        }
                        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
        <h1>Add New Product</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="product_name" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php $categories = mysqli_query($conn, "select * from categories"); foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="pimg" accept="image/*">
            </div>

            <div class="form-group">
                <label for="measurement_unit">Measurement Unit</label>
                <input type="text" id="measurement_unit" name="measurement_unit" placeholder="e.g. kg, liter, piece"
                    required>
            </div>

            <button type="submit" name="submit">Add Product</button>
        </form>
    </div>
</body>

</html>