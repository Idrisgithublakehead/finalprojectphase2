<?php
session_start();

// now i can Remove admin session if it exists
if (isset($_SESSION["loggedAdmin"])) {
    unset($_SESSION["loggedAdmin"]);
}

// End all session data
session_destroy();

// this will now Send user back to homepage
header("Location: index.php");
exit();
?>
