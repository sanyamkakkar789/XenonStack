<?php
session_start();
// Include your database configuration
require 'config.php'; // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve admin credentials from the database
    $query = "SELECT username, password FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);

    // Check if the prepare() call failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("s", $username);

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Verify the entered password against the stored hash
        if (password_verify($password, $row['password'])) {
            // Passwords match, admin is authenticated
            session_start();
            $_SESSION['admin_username'] = $username;
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            exit();
        } else {
            // Invalid credentials, redirect back to the login page with an error
            header("Location: admin_login.php?error=1");
            exit();
        }
    } else {
        die("Execute failed: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
