<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CoursePulse</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
            background: linear-gradient(to right, #4e54c8, #8f94fb); /* Gradient background */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
            text-align: center; /* Center-align the content */
        }

        h2 {
            color: white; /* Dark text color */
        }

        p {
            font-size: 16px;
            color: white;
        }

        .contact-info {
            margin-top: 20px;
        }

        .contact-info p {
            margin-bottom: 5px;
        }

        /* Modern Navigation Bar Styles */
        .navbar {
            background-color: #343a40; /* Dark background color */
            text-align: center; /* Center-align the navbar items */
        }

        .navbar-brand {
            color: #ffffff !important; /* White text color for brand */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-nav {
            margin: 0 auto; /* Center-align the nav links */
        }

        .nav-item {
            margin: 0 15px;
        }

        .nav-link {
            color: #ffffff !important; /* White text color for links */
            font-size: 18px;
            font-weight: bold;
            transition: color 0.3s ease; /* Add a smooth color transition */
        }

        .nav-link:hover {
            color: #ff5454 !important; /* Shades of red on hover */
        }

        /* Contact Form Styles */
        .contact-form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .btn-primary {
            background-color: #6c63ff;
            border: none;
            padding: 10px 20px;
            color: #ffffff;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #4e54c8;
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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->

    <div class="container">
        <!-- Contact Info for College Projects -->
        <div class="contact-info">
            
            <!-- <p><i class="fab fa-instagram"></i> <a href="https://instagram.com/_jes.x.in_?igshid=NTc4MTIwNjQ2YQ==" target="_blank">Instagram</a></p>
            <p><i class="far fa-envelope"></i> <a href="mailto:ajeswin0@gmail.com">Email</a></p> -->
        </div><br>
        <h2>Contact Information</h2>
        <p>
            Email: sanyamkakkar789@gmail.com
        </p>
        <!-- <p>
            Phone: +1234567890
        </p> -->

        <h2>Contact Form</h2>
        <!-- Contact Form -->
        <div class="contact-form">
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
