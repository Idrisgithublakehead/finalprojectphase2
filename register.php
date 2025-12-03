<?php
include 'includes/header.php';
require_once 'includes/Crud.php';

$crud = new Crud();
$feedback = "";

// this checks for When user submits the registration form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userName = trim($_POST["name"]);
    $userEmail = trim($_POST["email"]);
    $userPass = trim($_POST["password"]);
    $confirmPass = trim($_POST["confirm"]);

    // now we Check if both passwords match
    if ($userPass !== $confirmPass) {
        $feedback = "Please make sure both passwords match.";
    } else {
        
        $created = $crud->createUser($userName, $userEmail, $userPass);

        if ($created) {
            $feedback = "Your account has been created! You may now log in.";
        } else {
            $feedback = "That email is already in use. Try another one.";
        }
    }
}
?>

<h1 class="mb-4 text-primary">Register a New Account</h1>

<!-- here we can Display any messages -->
<?php if (!empty($feedback)): ?>
    <div class="alert alert-warning">
        <?php echo $feedback; ?>
    </div>
<?php endif; ?>


<form action="" method="POST" class="p-4 border rounded shadow-sm bg-light">

    <!-- Full Name -->
    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label class="form-label">Choose Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirm" class="form-control" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success w-100 mt-2">
        Create Account
    </button>

</form>

<?php include 'includes/footer.php'; ?>
