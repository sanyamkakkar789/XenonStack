<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Description - CoursePulse</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #e6e6e6; /* Light gray background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333; /* Dark text color */
        }

        .container {
            margin-top: 50px;
            background: linear-gradient(to right, #6c63ff, #4e54c8); /* Soothing gradient background */
            color: #ffffff; /* White text color */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
        }

        h1, h2 {
            color: #ffcc00; /* Yellow heading color */
        }

        p {
            font-size: 16px;
        }

        .project-info {
            margin-top: 20px;
        }

        .project-info p {
            margin-bottom: 5px;
        }

        /* Navigation Bar styles */
        .navbar {
            background-color: #343a40; /* Dark background color */
        }

        .navbar-brand, .nav-link {
            color: #ffffff !important; /* White text color for links */
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s ease; /* Smooth transition on color change */
        }

        .navbar-toggler-icon {
            background-color: #ffffff; /* White color for the toggler icon */
        }

        .navbar-toggler {
            border-color: #ffffff; /* White color for the toggler border */
        }

        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ff5555 !important; /* Red color for active/hover links */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">CoursePulse</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Project Information -->
        <div class="project-info">
            <h1>Project Description</h1>
            <p>
                Welcome to CoursePulse! Our platform is dedicated to providing high-quality courses and educational resources to learners around the world.
                Below, you will find information about our projects, the tools and software we used, and more.
            </p>

            <h2>Projects</h2>
            <p>
                - Project 1: Course Management System
            </p>
            <p>
                - Project 2: E-Learning Platform
            </p>

            <h2>Tools & Software Used</h2>
            <p>
                - Frontend Development: HTML, CSS, JavaScript
            </p>
            <p>
                - Backend Development: PHP, MySQL
            </p>
            <p>
                - Frameworks & Libraries: Bootstrap, jQuery
            </p>

            <h2>Features</h2>
            <p>
                - User-friendly course enrollment
            </p>
            <p>
                - Diverse range of courses from technology to arts
            </p>
            <p>
                - Dedicated instructors and support team
            </p>

            <h2>Future Plans</h2>
            <p>
                I'm continuously working on expanding my projects offerings and enhancing the user experience. Stay tuned for more exciting updates!
            </p>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
