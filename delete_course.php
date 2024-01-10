<?php
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

// Check if the course ID is provided in the URL
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Prepare a SQL statement to delete the course based on its ID
    $delete_sql = "DELETE FROM courses WHERE id = $course_id";

    if ($conn->query($delete_sql) === TRUE) {
        // Course deleted successfully, redirect to the view_courses.php page
        header("Location: admin_view_courses.php");
        exit();
    } else {
        echo "Error deleting course: " . $conn->error;
    }
} else {
    echo "Course ID not provided.";
}

// Close the database connection
$conn->close();
?>
