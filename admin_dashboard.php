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
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include a modern font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <!-- Custom CSS for Thumbnails, Hover Effects, and Shake Effect -->
    <style>
        .thumbnail {
            max-width: 300px;
            max-height: 150px;
            transition: transform 0.3s ease;
        }

        /* Add hover effect */
        .course-card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            transform: scale(1.03);
            animation: shake 0.5s ease-in-out; /* Shake effect */
        }

        /* Shake effect */
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

        /* Customize card appearance */
        .course-card {
            background-color: #343a40; /* Dark background color */
            border: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            width: 350px; /* Set a fixed width for all cards */
            display: inline-block;
        }

        .course-card .card-title {
            font-family: 'Montserrat', sans-serif; /* Modern font */
            font-size: 1.25rem;
            font-weight: bold;
            color: #ffffff; /* White text color */
        }

        .course-card .card-text {
            color: #6c757d;
        }

        .container {
            margin-top: 30px;
            margin-left: 10px;
        }

        /* Subtle gradient background */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #b3e0ff, #99c2ff);
        }

        /* Navigation Bar Styles */
        nav.navbar {
            background-color: #343a40; /* Dark background color */
        }

        nav.navbar a.navbar-brand,
        nav.navbar a.nav-link {
            color: #ffffff; /* White text color */
            text-align: center;
            font-weight: bold;
            transition: transform 0.3s ease; /* 3D effect transition */
            display: inline-block;
        }

        nav.navbar a.navbar-brand:hover,
        nav.navbar a.nav-link:hover {
            transform: scale(1.1); /* 3D effect on hover */
        }

        /* Center the links in the navbar */
        ul.navbar-nav {
            text-align: center;
            margin: 0 auto;
        }

        ul.navbar-nav li {
            display: inline-block;
            margin-right: 10px;
        }

        /* Center and style the welcome message */
        .welcome-message {
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_course.php">Add Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_view_courses.php">View Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Welcome Message -->
        <div class="row">
            <div class="col-lg-12 welcome-message">
                Welcome, <?php echo $_SESSION['admin_username']; ?>!
            </div>
        </div>

        <!-- Courses -->
        <div class="row">
            <?php
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-lg-4">';
                        echo '<div class="card course-card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row["course_name"] . '</h5>';
                        echo '<p class="card-text">' . $row["description"] . '</p>';

                        // Check the file type and show the thumbnail
                        $file_extension = pathinfo($row["file_path"], PATHINFO_EXTENSION);
                        if (strtolower($file_extension) === 'pdf') {
                            echo '<a href="' . $row["file_path"] . '" target="_blank"><img src="' . $row["thumbnail_path"] . '" alt="PDF Thumbnail" class="thumbnail"></a>';
                        } else {
                            // For other file types, you can add similar checks and thumbnails
                            // Example: Word documents (DOC, DOCX)
                            // Example: Image files
                            // Example: Video files
                            // Add more cases as needed
                        }

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-lg-12">';
                    echo '<p>No courses/books found</p>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo '<p>Error: ' . $conn->error . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>






