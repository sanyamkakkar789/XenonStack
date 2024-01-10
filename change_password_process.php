<?php
session_start();
include 'config.php';

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Fetch the current password from the database
    $fetchPasswordStmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $fetchPasswordStmt->bind_param("i", $userID);
    $fetchPasswordStmt->execute();
    $fetchPasswordStmt->bind_result($dbPassword);
    $fetchPasswordStmt->fetch();
    $fetchPasswordStmt->close();

    if (password_verify($oldPassword, $dbPassword)) {
        // Update the password
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updatePasswordStmt->bind_param("si", $newHashedPassword, $userID);
        
        if ($updatePasswordStmt->execute()) {
            $successMessage = "Password changed successfully!";
            $_SESSION['password_change_success'] = true; // Set session variable
        } else {
            $errorMessage = "Error updating password: " . $updatePasswordStmt->error;
        }
        
        $updatePasswordStmt->close();
    } else {
        $errorMessage = "Invalid old password.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include your head section here with CSS and JavaScript links -->
</head>
<body>
    <!-- Include your header and navigation bar here -->

    <div id="change-password-form">
        <h2>Change Password</h2>
        <?php if ($successMessage): ?>
            <!-- Display success message using a modal -->
            <script>
                window.onload = function() {
                    var passwordChangeSuccess = <?php echo isset($_SESSION['password_change_success']) ? $_SESSION['password_change_success'] : 'false'; ?>;
                    if (passwordChangeSuccess) {
                        var successDialog = new bootstrap.Modal(document.getElementById('successDialog'));
                        successDialog.show();
                        successDialog._element.addEventListener('hidden.bs.modal', function () {
                            // Redirect to dashboard after the modal is closed
                            window.location.href = "dashboard.php";
                        });
                    }
                }
            </script>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <form class="user" method="post" action="change_password_process.php">
    <div class="form-group">
        <label for="old_password">Old Password</label>
        <input type="password" name="old_password" required>
    </div>
    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" required>
    </div>
    <button type="submit" class="btn btn-primary">Change Password</button>
</form>

    </div>

    <!-- Success Dialog Modal -->
    <div class="modal fade show" id="successDialog" tabindex="-1" aria-labelledby="successDialogLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successDialogLabel">Password Changed Successfully</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your password has been changed successfully.
                </div>
            </div>
        </div>
    </div>

    <!-- Include your footer here -->

    <!-- JavaScript scripts and Bootstrap libraries -->

</body>
</html>
