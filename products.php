<?php
// Include the header (contains navigation, login form, CSS, Bootstrap, etc.)
include 'includes/header.php';
?>

<!-- Page heading -->
<h1 class="mb-4">Products Available</h1>

<p class="mb-3">
    This page will eventually load all products directly from the database.
    For now, these cards are just placeholders so the layout can be tested.
</p>


<div class="row mt-4">


    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">

            <!-- this is a  Temporary image until real product images are stored -->
            <img src="assets/images/default_product.jpg" class="card-img-top" alt="Sample Product Image">

            <div class="card-body">
                <!-- Fake product name -->
                <h5 class="card-title">Demo Item</h5>

                
                <p class="card-text">
                    This is a sample product card. Once the CRUD system is fully working,
                    this information will come directly from the inventory database.
                </p>

                <!-- this is the link to the single product page -->
                <a href="product.php?id=1" class="btn btn-primary btn-sm">See Details</a>
            </div>
        </div>
    </div>

   
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">

            <!-- this is where the Second placeholder image -->
            <img src="assets/images/default_product.jpg" class="card-img-top" alt="Sample Product Image">

            <div class="card-body">
                <h5 class="card-title">Test Product</h5>

                <p class="card-text">
                    Another temporary example showing how the layout will look.
                    Real product data will load here after connecting MySQL + PHP.
                </p>

                <!-- this right here for now is the fakr product link however (will be dynamic later) -->
                <a href="product.php?id=2" class="btn btn-primary btn-sm">See Details</a>
            </div>
        </div>
    </div>

</div>

<?php
// Include the footer 
include 'includes/footer.php';
?>
