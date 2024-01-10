<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userId"])) {
    // Establish a database connection (Replace with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "coursepulse";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_POST["userId"];

    // Update the user's status to unblocked (You should have a 'blocked' field in your users table)
    $sql = "UPDATE users SET blocked = 0 WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "User unblocked successfully";
    } else {
        echo "Error unblocking user: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request";
}
?>
