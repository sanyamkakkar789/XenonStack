<?php
// Establish a database connection here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coursepulse";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    
    // Perform the delete operation in your database here
    $sql = "DELETE FROM users WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
