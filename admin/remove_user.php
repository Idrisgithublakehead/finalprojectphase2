<?php
session_start();
require_once "../includes/Crud.php";

// Only admins should be allowed to delete accounts
if (!isset($_SESSION["loggedAdmin"])) {
    header("Location: ../login.php");
    exit();
}

$crudTool = new Crud();

$targetUser = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// If the ID is missing or invalid, return back with an error
if ($targetUser < 1) {
    header("Location: manage_users.php?status=bad_id");
    exit();
}

// here we will Attempt to remove the selected user from the database
$deleteSuccess = $crudTool->deleteUser($targetUser);

// now we can Decide where to send admin after the delete attempt
if ($deleteSuccess) {
    header("Location: manage_users.php?status=user_removed");
} else {
    header("Location: manage_users.php?status=remove_failed");
}

exit();
?>
