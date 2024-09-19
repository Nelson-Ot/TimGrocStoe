<?php
session_start();
include 'connect.php';

// Check if the admin is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}



// Get the product ID from the URL
$product_id = $_GET['id'];

// Fetch product details from the database

$product = $conn->query("select * from products where id='$product_id'")->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Fetch categories for the category dropdown
$categories = mysqli_query($conn, "select * from categories");

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



// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $measurement_unit = $_POST['measurement_unit'];
    $image = $product['image']; // Retain existing image

    // Handle image upload if a new image is provided
    if (!empty($_FILES['pimg']['name'])) {
        
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
    }

    // Update the product in the database

    $sql =   $conn->query("update products set name='" . $name . "',category_id=" . $category_id . ",price='" . $price . "',description='" . $description . "',image='" . $url . "',measurement_unit='" . $measurement_unit . "' where id=" . $product_id . "");
    if ($sql) {
        # code...
        echo "<script>alert('Product updated successfully!'); window.location.href='manage-products.php?sucess';</script>";
    } else {
        # code...
        echo "<script>alert('Error updating product!'); window.location.href='manage-products.php?error';</script>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="cat-container">
        <h1>Edit Product</h1>
        <form action="edit-product.php?id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php if ($product['category_id'] == $category['id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="pimg" accept="image/*">
                <?php if (!empty($product['image'])): ?>
                    <p>Current Image: <img src="<?php echo $product['image']; ?>" alt="Product Image" width="100"></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="measurement_unit">Measurement Unit</label>
                <input type="text" id="measurement_unit" name="measurement_unit" value="<?php echo htmlspecialchars($product['measurement_unit']); ?>" required>
            </div>

            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
