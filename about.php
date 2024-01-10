<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About CoursePulse</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            background-color: #343a40; /* Dark background color */
            color: #ffffff; /* White text color */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
        }

        h1 {
            color: #6c63ff; /* Purple heading color */
        }

        p {
            font-size: 16px;
        }

        .donation-section {
            background-color: #6c63ff; /* Purple donation section background color */
            padding: 20px;
            border-radius: 5px;
            margin-top: 30px;
        }

        .donation-text {
            color: #ffffff; /* White text color */
            text-align: center;
        }

        .upi-qr {
            text-align: center;
        }

        .upi-qr img {
            max-width: 700px;
            max-height: 500px;
            height: auto;
        }

        /* Navigation Bar styles */
        .navbar {
            background-color: #323233; /* Dark background color */
        }

        .navbar-brand, .nav-link {
            color: #ffffff !important; /* White text color for links */
            font-weight: bold;
            font-size: 18px;
        }

        .navbar-toggler-icon {
            background-color: #ffffff; /* White color for the toggler icon */
        }

        .navbar-toggler {
            border-color: #ffffff; /* White color for the toggler border */
        }

        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #6c63ff !important; /* Purple color for active/hover links */
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
                    <li class="nav-item active">
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
        <!-- Donation Section -->
        <div class="donation-section">
            <div class="donation-text">
                <h2>This website is a free college project for students!</h2>
                <p>Your support can help me to grow and improve. Please consider donating.</p>
            </div>
        </div><br>
        <h1>About CoursePulse</h1>
        <p>
            CoursePulse is a leading online platform dedicated to providing high-quality courses and educational resources to learners around the world.
            Our mission is to empower individuals with the knowledge and skills they need to succeed in their personal and professional lives.
        </p>
        <p>
            Whether you're a student looking to enhance your academic performance, a professional seeking to advance your career, or someone passionate
            about lifelong learning, CoursePulse offers a diverse range of courses to meet your needs. Our courses cover a wide array of topics,
            from technology and business to arts and humanities.
        </p>
        <p>
            At CoursePulse, we believe that learning should be accessible to all. That's why we provide a user-friendly platform where you can easily
            discover, enroll in, and complete courses at your own pace. Our dedicated instructors and support team are here to assist you every step of the way.
        </p>
        <p>
            Thank you for choosing CoursePulse as your learning partner. We look forward to helping you achieve your educational goals and explore new horizons.
        </p>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
