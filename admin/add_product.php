<?php
session_start();
require_once "../includes/Crud.php";
require_once "../includes/header.php";

$crudObj = new Crud();
$statusMsg = "";


if (!isset($_SESSION["loggedAdmin"])) {
    header("Location: ../login.php");
    exit();
}

// When the product form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $prodTitle = trim($_POST["prod_name"]);
    $prodQty   = trim($_POST["prod_qty"]);
    $prodInfo  = trim($_POST["prod_desc"]);
    $prodCost  = trim($_POST["prod_price"]);

    $storedImage = "";

    if (!empty($_FILES["prod_image"]["name"])) {

        $tempFile = $_FILES["prod_image"]["tmp_name"];
        $newName = time() . "_" . $_FILES["prod_image"]["name"];
        $savePath = "../assets/images/" . $newName;

        // if the image was uploaded Move uploaded image to images folder
        if (move_uploaded_file($tempFile, $savePath)) {
            $storedImage = $newName;
        }
    }

    // Save new product to database
    $saved = $crudObj->createProduct($prodTitle, $prodQty, $prodInfo, $prodCost, $storedImage);

    $statusMsg = $saved ? "Product has been successfully added!" 
                        : "Unable to save product. Please try again.";
}
?>

<h1 class="text-primary mb-4">Add a New Inventory Item</h1>

<!-- Show response message -->
<?php if (!empty($statusMsg)): ?>
    <div class="alert alert-info"><?php echo $statusMsg; ?></div>
<?php endif; ?>

<!-- this is the start of the Product Form -->
<form action="" method="POST" enctype="multipart/form-data" class="p-4 bg-white shadow rounded" style="max-width: 700px;">

    
    <div class="mb-3">
        <label class="form-label">Item Name</label>
        <input type="text" name="prod_name" class="form-control" placeholder="Enter product name" required>
    </div>

   
    <div class="mb-3">
        <label class="form-label">Available Quantity</label>
        <input type="number" name="prod_qty" class="form-control" placeholder="Units in stock" required>
    </div>

    <!-- Description for the item -->
    <div class="mb-3">
        <label class="form-label">Item Description</label>
        <textarea name="prod_desc" rows="3" class="form-control" placeholder="Write a short description" required></textarea>
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label class="form-label">Price ($)</label>
        <input type="number" step="0.01" name="prod_price" class="form-control" placeholder="Enter price" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Upload Image</label>
        <input type="file" name="prod_image" class="form-control">
        <small class="text-muted">Accepted: JPG, PNG, etc. Uploaded to /assets/images/</small>
    </div>

    <!-- this is a Submit button -->
    <button type="submit" class="btn btn-success w-100 mt-3">Save Item</button>

</form>

<?php require_once "../includes/footer.php"; ?>
