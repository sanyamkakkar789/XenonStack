<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not authenticated
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

// Retrieve course data from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Dashboard - CoursePulse</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS for Thumbnails and Hover Effects -->
    <style>
        body {
            background: linear-gradient(to right, #3494e6, #ec6ead);
            color: #fff;
        }

        .course-card {
            background-color: #3f3f3f; /* Different background color */
            border: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            height: 400px; /* Set a fixed height for all cards */
        }

        .course-card:hover {
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
            transform: scale(1.03) rotate(1deg); /* Slight rotation on hover */
            animation: shake 0.9s; /* Shake animation on hover */
        }

        @keyframes shake {
            10%, 90% {
                transform: translate3d(-1px, 0, 0);
            }
            20%, 80% {
                transform: translate3d(2px, 0, 0);
            }
            30%, 50%, 70% {
                transform: translate3d(-4px, 0, 0);
            }
            40%, 60% {
                transform: translate3d(4px, 0, 0);
            }
        }

        .course-card .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #fff; /* Set text color to white */
        }

        .course-card .card-text {
            color: #c0c0c0; /* Lighter text color */
            height: 100px; /* Set a fixed height for card text */
            overflow: hidden;
        }

        .course-card .card-body {
            height: 100%; /* Make card body fill the fixed height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Adjust thumbnail size */
        .thumbnail {
            max-width: 100%;
            height: auto;
            flex-grow: 1; /* Allow the thumbnail to grow and take available space */
        }

        /* Custom styling for the navigation bar */
        .navbar {
            background-color: #343a40; /* Dark background color */
            border-bottom: 2px solid #17a2b8; /* Border color */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        .navbar-brand {
            color: #fff;
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 1px; /* Adjust letter spacing */
        }

        .navbar-toggler {
            border-color: #17a2b8; /* Border color of the toggler button */
        }

        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-item {
            margin: 0 10px;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 0.5px; /* Adjust letter spacing */
            transition: color 0.3s ease, transform 0.3s ease; /* Smooth transition */
        }

        .navbar-nav .nav-link:hover {
            color: #17a2b8; /* Hover color */
            transform: translateY(-2px); /* Move the link up slightly on hover */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Course Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
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
        <h2>Available Courses</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-lg-4">';
                    echo '<div class="card course-card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["course_name"] . '</h5>';
                    echo '<p class="card-text">' . $row["description"] . '</p>';
                    echo '<a href="' . $row["file_path"] . '" target="_blank"><img src="' . $row["thumbnail_path"] . '" alt="Course Thumbnail" class="thumbnail"></a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo '<p>No courses found</p>';
                echo '</div>';
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim
