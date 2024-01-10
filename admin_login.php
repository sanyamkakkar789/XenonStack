<?php
session_start();

// Initialize $error_message as an empty string
$error_message = "";

if (isset($_SESSION['admin_username'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_GET['error']) && $_GET['error'] == 1) {
    $error_message = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* styles.css */

    /* Reset some default browser styles */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(to right, #c2e59c, #64b3f4); /* Gradient background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Center the login container */
    .login-container {
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    /* Style the header text */
    .login-container h2 {
        color: #333;
    }

    /* Style labels and inputs */
    .login-container label {
        display: block;
        font-weight: bold;
        margin-top: 20px;
        color: #555; /* Label color */
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Style the login button */
    .login-container button {
        background-color: #6c63ff; /* Purple button */
        color: white;
        border: none;
        padding: 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 100%;
    }

    .login-container button:hover {
        background-color: #574dcf; /* Darker purple on hover */
    }

    /* Error message style */
    .login-container p {
        color: red;
        margin-top: 15px;
    }
</style>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="post" action="admin_login_process.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p><?php echo $error_message; ?></p>
    </div>
</body>
</html>
