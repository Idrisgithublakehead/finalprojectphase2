<?php
// Start session if it's not already running
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS - Inventory Management</title>

    <!-- put the boostraps link below -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- this is the custom css file -->
    <link rel="stylesheet" href="/~Idris200627987/final/assets/css/style.css">
</head>

<body>

<header class="bg-primary text-white py-3">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- this code below is for the site logo and title -->
        <h3 class="m-0">IMS System</h3>

        <!-- this is where the Main Navigation will be  -->
        <nav class="d-flex align-items-center">
            <a href="/~Idris200627987/final/index.php" class="text-white me-3">Home</a>
            <a href="/~Idris200627987/final/products.php" class="text-white me-3">Products</a>
            <a href="/~Idris200627987/final/register.php" class="text-white">Register</a>
        </nav>

        
        <?php if (!isset($_SESSION['loggedAdmin'])): ?>
            <form action="/~Idris200627987/final/login.php" method="POST" class="d-flex">
                <input type="email" name="login_email" placeholder="Email" class="form-control form-control-sm me-2" required>
                <input type="password" name="login_pass" placeholder="Password" class="form-control form-control-sm me-2" required>
                <button type="submit" class="btn btn-light btn-sm">Login</button>
            </form>
        <?php else: ?>
            <div class="d-flex align-items-center">
                <span class="me-2">Logged in</span>
                <a href="/~Idris200627987/final/admin/add_product.php" class="btn btn-success btn-sm me-2">Add Product</a>
                <a href="/~Idris200627987/final/logout.php" class="btn btn-dark btn-sm">Logout</a>
            </div>
        <?php endif; ?>
        
    </div>
</header>

<!-- this is a  Wrapper for the main content  -->
<main class="container my-4">
