<?php
session_start(); // Start session

include 'config.php'; // Include the database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrMobile = $_POST['emailOrMobile'];
    $password = $_POST['password'];

    // Check if the provided email/mobile and password match a user in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE (email = ? OR mobile = ?) AND password = ?");
    $stmt->bind_param("sss", $emailOrMobile, $emailOrMobile, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        // User found, set session variables and redirect to dashboard
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        header("Location: dashboard.php"); // Replace with the actual dashboard page
    } else {
        // Invalid credentials, redirect back to login page with error message
        $_SESSION['login_error'] = "Invalid email/mobile or password.";
        header("Location: login.php"); // Replace with the actual login page
    }

    // Close the statement
    $stmt->close();
}
?>
