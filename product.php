<?php
// Bring in the common header layout (nav bar, CSS, login section)
include 'includes/header.php';


$productId = isset($_GET['id']) ? $_GET['id'] : 0;

//  This is just a placeholder until we connect the database.
// Later i will load the product using the CRUD class.
?>

<!-- this is the Page Title -->
<h1 class="mb-4 text-center text-primary">Product Information</h1>

<div class="row">

  
    <div class="col-md-5 mb-4">
        
        <img src="assets/images/default_product.jpg"
             class="img-fluid rounded border"
             alt="Item Image">
    </div>

    <!-- product details -->
    <div class="col-md-7">

       
        <h2 class="fw-semibold">Example Inventory Item</h2>

        <!-- this right below is the Product description -->
        <p class="mt-3">
            This is a placeholder description showing how a real product will look once 
            the database connection is working. When CRUD is implemented, this page will 
            automatically load the product based on the ID in the URL.
        </p>

        <!-- this right here is the Fake pricing + stock will be dynamic later -->
        <p><strong>Price:</strong> $14.99</p>
        <p><strong>Stock Available:</strong> 27 units</p>

        
        <p class="text-muted small">
            *All details shown here are temporary and will be replaced using SQL queries later.
        </p>

        <!-- Button to return to products list -->
        <a href="products.php" class="btn btn-outline-secondary mt-3">
            Go Back to Products
        </a>

    </div>
</div>

<?php
// Include the footer to connect the two files
include 'includes/footer.php';
?>
