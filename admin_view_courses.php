<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

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

// Retrieve the list of courses/books from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses/Books - Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Replace this font link with your preferred font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #6c63ff; /* Purple background color */
            padding: 15px 0;
        }

        .navbar-brand {
            color: #ffffff; /* White text color for brand */
            font-weight: bold;
        }

        .navbar-dark .navbar-nav {
            text-align: center; /* Center align the nav links */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #000000; /* Black text color for links */
            font-size: 18px; /* Larger font size */
            font-weight: bold; /* Bold font */
            margin-right: 20px;
            transition: color 0.3s; /* Smooth color transition on hover */
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #8B4513; /* Brown color on hover */
        }

        .container {
            background-color: #ffffff; /* White background color for the container */
            padding: 20px;
            margin: 20px auto;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .table th,
        .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto"> <!-- mx-auto to center align the links -->
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_course.php">Add Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h2>View Courses/Books</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["course_name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["course_type"] . "</td>";
                        echo "<td><a href='edit_course.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>";
                        if (!empty($row["file_path"])) {
                            echo " <a href='" . $row["file_path"] . "' class='btn btn-success' target='_blank'>View File</a>";
                        }
                        echo " <a href='delete_course.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this course/book?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No courses/books found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



