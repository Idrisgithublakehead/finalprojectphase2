<?php
session_start();
require_once "../includes/Crud.php";

// Only allow admins to view this page
if (!isset($_SESSION["loggedAdmin"])) {
    header("Location: ../login.php");
    exit();
}

require_once "../includes/header.php";

$crud = new Crud();

// this code below Fetches all user accounts
$allUsers = $crud->getUsers();

// Check for delete confirmation
$note = "";
if (isset($_GET["removed"])) {
    $note = ($_GET["removed"] == 1)
        ? "Selected user has been removed."
        : "Unable to remove user.";
}
?>

<h1 class="text-success mb-4">User Management</h1>

<!--here we can Show alert if needed -->
<?php if (!empty($note)): ?>
    <div class="alert alert-info">
        <?php echo $note; ?>
    </div>
<?php endif; ?>

<!-- Display user list -->
<div class="table-responsive">
    <table class="table table-hover table-bordered shadow-sm">

        <thead class="table-light">
        <tr>
            <th style="width: 60px;">ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th style="width: 120px;">Action</th>
        </tr>
        </thead>

        <tbody>

        <?php if (!empty($allUsers)): ?>
            <?php foreach ($allUsers as $user): ?>
                <tr>
                    <td><?php echo $user["id"]; ?></td>
                    <td><?php echo htmlspecialchars($user["name"]); ?></td>
                    <td><?php echo htmlspecialchars($user["email"]); ?></td>

                    <td>
                        <a href="remove_user.php?id=<?php echo $user['id']; ?>"
                           class="btn btn-outline-danger btn-sm">
                           Remove
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center text-muted">
                    No user accounts found.
                </td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>
</div>

<?php require_once "../includes/footer.php"; ?>
