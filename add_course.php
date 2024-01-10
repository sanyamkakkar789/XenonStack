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

    // Handle file uploads for both the main file and the thumbnail
    $targetDirectory = "uploads/"; // Create an "uploads" directory to store files
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $thumbnailFile = $targetDirectory . basename($_FILES["thumbnail"]["name"]); // Added for thumbnail

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual file or fake
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Check file size (you can set your own size limit)
    if ($_FILES["file"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (you can modify this based on your needs)
    if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload the main file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now store the file path in the database
            $filePath = $targetFile; // Modify this based on your file storage location

            // Upload the thumbnail file
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbnailFile)) {
                // Thumbnail uploaded successfully
                $thumbnailPath = $thumbnailFile; // Modify this based on your file storage location

                // Insert data into the database (you need to set up your database connection)
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

                // SQL query to insert data including the file paths
                $sql = "INSERT INTO courses (course_name, description, course_type, file_path, thumbnail_path) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $courseName, $description, $courseType, $filePath, $thumbnailPath);

                if ($stmt->execute()) {
                    // Data inserted successfully, you can handle file upload here if needed
                    $message = "Course added successfully.";
                } else {
                    // Error occurred
                    $message = "Error: " . $stmt->error;

                    // Add additional debug information
                    echo "SQL Error: " . $conn->error;
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your thumbnail.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course or Book</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include a modern font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <style>
        body {
            background: linear-gradient(to right, #b3e0ff, #99c2ff);
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #343a40; /* Dark background color */
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }

        #content {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            margin-top: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #content h2 {
            text-align: center;
            color: #333;
        }

        #content form {
            margin-top: 20px;
        }

        #content .form-group label {
            color: #333;
        }

        #content .form-control {
            transition: box-shadow 0.3s, border-color 0.3s;
        }

        #content .form-control:focus {
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
            border-color: #6c63ff;
        }

        #content .btn-primary {
            background-color: #6c63ff; /* Purple button */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        #content .btn-primary:hover {
            background-color: #574dcf; /* Darker purple on hover */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_view_courses.php">View Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container" id="content">
        <h2>Add New Course or Book</h2>
        <?php
        if (isset($message)) {
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="course_name">Course/Book Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="course_type">Type</label>
                <select class="form-control" id="course_type" name="course_type" required>
                    <option value="Course">Course</option>
                    <option value="Book">Book</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file">Upload Main File (PDF, DOC, DOCX)</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <!-- Add file upload input for the thumbnail -->
            <div class="form-group">
                <label for="thumbnail">Upload Thumbnail (Image)</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


