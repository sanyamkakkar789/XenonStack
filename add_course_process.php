<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process and validate form data here
    $courseName = $_POST["course_name"];
    $description = $_POST["description"];
    $courseType = $_POST["course_type"];
    // Handle file upload here

    // Insert data into the database (you need to set up your database connection)
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data
    $sql = "INSERT INTO courses (course_name, description, course_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $courseName, $description, $courseType);

    if ($stmt->execute()) {
        // Data inserted successfully, you can handle file upload here if needed
        $message = "Course added successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}

// Redirect back to the admin dashboard or show a success message
?>
