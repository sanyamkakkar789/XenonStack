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

// Initialize variables for course data
$course_id = $_GET['id'];
$course_name = "";
$description = "";
$course_type = "";
$file_path = "";
$thumbnail_path = "";

// Fetch the course data from the database
$sql = "SELECT * FROM courses WHERE id = $course_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $course_name = $row["course_name"];
    $description = $row["description"];
    $course_type = $row["course_type"];
    $file_path = $row["file_path"];
    $thumbnail_path = $row["thumbnail_path"];
}

// Handle form submission for updating the course
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_course_name = $_POST["course_name"];
    $new_description = $_POST["description"];
    $new_course_type = $_POST["course_type"];

    // Check if a new file is uploaded
    if (!empty($_FILES["file"]["name"])) {
        // Handle file upload here
        $targetDirectory = "uploads/"; // Create an "uploads" directory to store files
        $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

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
            // If everything is ok, delete the old file and try to upload the new file
            if (file_exists($file_path)) {
                // Delete the old file
                unlink($file_path);
            }
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                // File uploaded successfully, update the file path variable
                $file_path = $targetFile; // Update with the new file path
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Check if a new thumbnail is uploaded
    if (!empty($_FILES["thumbnail"]["name"])) {
        // Handle thumbnail upload here
        $thumbnailDirectory = "thumbnails/"; // Create a "thumbnails" directory to store thumbnails
        $thumbnailFile = $thumbnailDirectory . basename($_FILES["thumbnail"]["name"]);
        $uploadThumbnailOk = 1;
        $thumbnailFileType = strtolower(pathinfo($thumbnailFile, PATHINFO_EXTENSION));

        // Check file size (you can set your own size limit)
        if ($_FILES["thumbnail"]["size"] > 5000000) {
            echo "Sorry, your thumbnail is too large.";
            $uploadThumbnailOk = 0;
        }

        // Allow certain file formats (you can modify this based on your needs)
        if ($thumbnailFileType != "jpg" && $thumbnailFileType != "png" && $thumbnailFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed for thumbnails.";
            $uploadThumbnailOk = 0;
        }

        // Check if $uploadThumbnailOk is set to 0 by an error
        if ($uploadThumbnailOk == 0) {
            echo "Sorry, your thumbnail was not uploaded.";
        } else {
            // If everything is ok, delete the old thumbnail and try to upload the new thumbnail
            if (file_exists($thumbnail_path)) {
                // Delete the old thumbnail
                unlink($thumbnail_path);
            }
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbnailFile)) {
                // Thumbnail uploaded successfully, update the thumbnail path variable
                $thumbnail_path = $thumbnailFile; // Update with the new thumbnail path
            } else {
                echo "Sorry, there was an error uploading your thumbnail.";
            }
        }
    }

    // Update the course data in the database, including the updated file and thumbnail paths
    $update_sql = "UPDATE courses SET course_name = ?, description = ?, course_type = ?, file_path = ?, thumbnail_path = ? WHERE id = ?";

    // Use a prepared statement
    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssssi", $new_course_name, $new_description, $new_course_type, $file_path, $thumbnail_path, $course_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Course updated successfully, redirect to view courses page
            header("Location: admin_view_courses.php");
            exit();
        } else {
            echo "Error updating course: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course/Book - Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_course.php">Add Course</a>
                    </li>
                    <li class="nav-item active">
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
    <div class="container mt-4">
        <h2>Edit Course/Book</h2>
       <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="course_name">Course/Book Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $course_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="course_type">Type</label>
                <select class="form-control" id="course_type" name="course_type" required>
                    <option value="Course" <?php if ($course_type == "Course") echo "selected"; ?>>Course</option>
                    <option value="Book" <?php if ($course_type == "Book") echo "selected"; ?>>Book</option>
                </select>
            </div>
            <!-- Add file upload input to change the file -->
            <div class="form-group">
                <label for="file">Change File</label>
                <input type="file" class="form-control-file" id="file" name="file">
            </div>
            <!-- Add file upload input to change the thumbnail -->
            <div class="form-group">
        <label for="thumbnail">Change Thumbnail</label>
        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
