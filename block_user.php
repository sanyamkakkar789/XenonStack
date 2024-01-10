<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coursepulse";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    
    // Debugging: Log the received userId
    error_log("Received userId: " . $userId);

    // Perform the block operation in your database here
    $sql = "UPDATE users SET blocked = 1 WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

// Close the database connection
$conn->close();
?>
