<?php
session_start();

// Include your database configuration
require 'config.php'; // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data (you can add more validation as needed)
    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['registration_error'] = "All fields are required.";
        header("Location: admin_register.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['registration_error'] = "Passwords do not match.";
        header("Location: admin_register.php");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert the admin into the database
    $query = "INSERT INTO admin (email, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $email, $username, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['registration_success'] = "Registration successful! You can now log in.";
        header("Location: admin_login.php");
        exit();
    } else {
        $_SESSION['registration_error'] = "Registration failed. Please try again.";
        header("Location: admin_register.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: admin_register.php");
    exit();
}
?>
