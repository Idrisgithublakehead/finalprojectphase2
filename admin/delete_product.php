<?php
session_start();
require_once "../includes/Crud.php";

//here we can  Block access if the admin is not logged in
if (!isset($_SESSION["loggedAdmin"])) {
    header("Location: ../login.php");
    exit();
}

$crudHandler = new Crud();

// Get the product ID from the URL
$targetId = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// If the ID is missing or invalid, send the user back
if ($targetId < 1) {
    header("Location: ../products.php?error=invalid_id");
    exit();
}

// Try removing the product from the database
$wasRemoved = $crudHandler->deleteProduct($targetId);

// Redirect user based on the result
if ($wasRemoved) {
    header("Location: ../products.php?status=removed");
} else {
    header("Location: ../products.php?status=failed_to_remove");
}

exit();
?>
