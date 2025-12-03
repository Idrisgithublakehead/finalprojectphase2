<?php
session_start();
require_once "includes/Crud.php";

$crudObj = new Crud();
$loginAlert = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $inputEmail = trim($_POST["login_email"]);
    $inputPassword = trim($_POST["login_pass"]);

    // Use CRUD to validate login
    $checkUser = $crudObj->loginUser($inputEmail, $inputPassword);

    if ($checkUser) {
        
        $_SESSION["loggedAdmin"] = $checkUser;

        // Send user to homepage
        header("Location: index.php");
        exit();
    } else {
        $loginAlert = "Incorrect login information. Please try again.";
    }
}

include "includes/header.php";
?>

<h1 class="text-center text-success mb-4">Login to Continue</h1>

<!--this will Show error if login fails -->
<?php if (!empty($loginAlert)): ?>
    <div class="alert alert-danger text-center">
        <?php echo $loginAlert; ?>
    </div>
<?php endif; ?>

<!-- Login section -->
<div class="d-flex justify-content-center">
    <form action="" method="POST" class="p-4 rounded bg-white shadow" style="width: 400px;">

        
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="login_email" class="form-control" placeholder="Enter email" required>
        </div>

        
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="login_pass" class="form-control" placeholder="Enter password" required>
        </div>

        
        <button type="submit" class="btn btn-primary w-100 mt-2">
            Sign In
        </button>

    </form>
</div>

<?php include "includes/footer.php"; ?>
