<?php
session_start();
require_once "../includes/Crud.php";

$crudService = new Crud();
$productNotice = "";

// Only allow access if admin session exists
if (!isset($_SESSION["loggedAdmin"])) {
    header("Location: ../login.php");
    exit();
}


$productId = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

// now we can Load the current product from the database
$currentProduct = $crudService->getProduct($productId);

// here we check  If product is not found, show simple error and stop
if (!$currentProduct) {
    include "../includes/header.php";
    echo "<div class='alert alert-danger mt-4'>The product you are trying to edit could not be found.</div>";
    include "../includes/footer.php";
    exit();
}

// Handle form submission for updating the product
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $newName   = trim($_POST["prod_name"]);
    $newQty    = trim($_POST["prod_qty"]);
    $newDesc   = trim($_POST["prod_desc"]);
    $newPrice  = trim($_POST["prod_price"]);


    $finalImageName = $currentProduct["image"];

    // If the  admin chooses a new image file
    if (!empty($_FILES["prod_image"]["name"])) {
        $tempLocation = $_FILES["prod_image"]["tmp_name"];
        $newFileName  = time() . "_" . $_FILES["prod_image"]["name"];
        $uploadPath   = "../assets/images/" . $newFileName;

        // thenn we can Move uploaded file to images folder
        if (move_uploaded_file($tempLocation, $uploadPath)) {
            $finalImageName = $newFileName;
        }
    }

    // Attempt to update the product record
    $updated = $crudService->updateProduct(
        $productId,
        $newName,
        $newQty,
        $newDesc,
        $newPrice,
        $finalImageName
    );

 
    $productNotice = $updated ? "Product details have been updated." 
                              : "Could not update product. Please try again.";
}


include "../includes/header.php";
?>

<h1 class="mb-4 text-primary">Edit Existing Product</h1>

<!-- Show result message if available -->
<?php if (!empty($productNotice)): ?>
    <div class="alert alert-info">
        <?php echo $productNotice; ?>
    </div>
<?php endif; ?>


<form action="" method="POST" enctype="multipart/form-data" 
      class="p-4 bg-white shadow rounded" style="max-width: 750px;">

    
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input 
            type="text" 
            name="prod_name" 
            class="form-control"
            value="<?php echo htmlspecialchars($currentProduct['name']); ?>" 
            required
        >
    </div>

    
    <div class="mb-3">
        <label class="form-label">Quantity in Stock</label>
        <input 
            type="number" 
            name="prod_qty" 
            class="form-control"
            value="<?php echo htmlspecialchars($currentProduct['qty']); ?>" 
            required
        >
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea 
            name="prod_desc" 
            class="form-control" 
            rows="3"
            required
        ><?php echo htmlspecialchars($currentProduct['description']); ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Price ($)</label>
        <input 
            type="number" 
            step="0.01" 
            name="prod_price" 
            class="form-control"
            value="<?php echo htmlspecialchars($currentProduct['price']); ?>" 
            required
        >
    </div>

    
    <div class="mb-3">
        <label class="form-label">Current Image</label><br>
        <?php if (!empty($currentProduct['image'])): ?>
            <img 
                src="../assets/images/<?php echo htmlspecialchars($currentProduct['image']); ?>" 
                alt="Product Image" 
                style="width: 130px; border: 1px solid #ccc; border-radius: 4px;"
            >
        <?php else: ?>
            <p class="text-muted">No image available for this product.</p>
        <?php endif; ?>
    </div>

    <!-- Optionally upload a new image -->
    <div class="mb-3">
        <label class="form-label">Upload New Image (optional)</label>
        <input type="file" name="prod_image" class="form-control">
    </div>


    <button type="submit" class="btn btn-success w-100 mt-3">
        Update Product
    </button>

</form>

<?php include "../includes/footer.php"; ?>

