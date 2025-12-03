<?php 
// Include the global header (navigation bar, login form, CSS links, etc.)
include 'includes/header.php';
?>

<div class="text-center mb-5">

    <h1 class="fw-bold">Inventory Management System</h1>

    <!-- Quick description of the website -->
    <p class="mt-3">
        Welcome to the IMS project! Here you can view all products available in stock.
        If you're an admin, you can also add, update, or delete items after logging in.
    </p>

    <a href="products.php" class="btn btn-outline-primary mt-4">
        Browse Products
    </a>

</div>

<!-- this below is a Section giving some info about the purpose of this assignment -->
<section class="mt-5">

    <h3>About This Project</h3>

    <!-- Basic explanation of what this assignment includes -->
    <p>
        This Inventory System was created as part of a PHP final project.
        Users can register an account, admins get special access, and all product data is handled
        using SQL, PHP, and proper CRUD functions.
    </p>

</section>

<?php 
// now i Included the global footer 
include 'includes/footer.php';
?>
