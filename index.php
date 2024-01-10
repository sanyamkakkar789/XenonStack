<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CoursePulse - Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add your custom styles here */
        body {
            background-color: #f4f4f4; /* Light gray background color */
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #3498db; /* Light blue background color */
            display: flex;  
            justify-content: space-between; /* Align at the ends */
            align-items: center;
            padding: 20px;
            border-bottom: 2px solid #2980b9; /* Darker blue border at the bottom */
        }
        .navbar a {
            color: white; /* White text color */
            font-size: 20px; /* Increased font size */
            font-weight: bold; /* Bold text */
            transition: color 0.3s, transform 0.3s; /* Transition for color and transform */
        }
        .navbar a:hover {
            color: #ecf0f1; /* Different color on hover (light gray) */
            transform: translateY(-3px); /* 3D effect - move slightly up on hover */
        }
        .navbar-links {
            display: flex;
            gap: 20px;
        }
        .navbar-links .nav-link {
            margin: 0;
        }
        .homepage-content {
            background: #ecf0f1; /* Light gray background */
            color: #34495e; /* Dark gray text color */
            padding: 20px;
            position: relative;
            text-align: center; /* Center-align text */
        }
        .content-text {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .image-partitions {
            display: flex;
            gap: 20px;
            justify-content: center;
            position: relative;
            margin-top: 20px; /* Adjusted margin for spacing */
        }
        .image-partition {
            width: 100%;
            max-width: 400px; /* Adjust as needed */
            border-radius: 10px;
            cursor: pointer;
        }
        .image-partition img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .image-partition:hover img {
            transform: scale(1.1);
        }
        .browse-button {
            background-color: #3498db; /* Light blue background color */
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            color: white;
            font-weight: bold; /* Bold text */
            font-family: 'Montserrat', sans-serif; /* Modern font */
            text-decoration: none; /* Remove underline */
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s; /* Transition for color and transform */
        }
        .browse-button:hover {
            background-color: #2980b9; /* Darker blue on hover */
            transform: scale(1.05); /* 3D effect on hover */
        }
        .footer {
            background-color: #3498db; /* Light blue background color */
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }
        .footer-content {
            font-size: 16px;
            margin-top: 10px;
        }
        .heart-icon {
            color: #e74c3c; /* Red heart color */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="navbar-links">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="description.php">Project Description</a>
                    </li>
                    
                </ul>
            </div>
            <div class="navbar-links">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Homepage Content -->
    <div class="homepage-content">
        <div class="container">
            <div class="content-text">
                <h1>Welcome to CSE-Core</h1>
                <p>Discover a world of knowledge with our wide range of online courses.</p>
            </div>
            <a href="login.php" class="browse-button">Browse Courses</a>
            <div class="image-partitions">
                <!-- Partition 1 -->
                <div class="image-partition">
                    <img src="images/img1.png" alt="Image 1">
                </div>
                <!-- Partition 2 -->
                <div class="image-partition">
                    <img src="images/img2.png" alt="Image 2">
                </div>
                <!-- Partition 3 -->
                <div class="image-partition">
                    <img src="images/img3.png" alt="Image 3">
                </div>
                <!-- Partition 4 -->
                <div class="image-partition">
                    <img src="images/img4.png" alt="Image 4">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <div class="footer-content">
            Made with <span class="heart-icon">&#10084;</span> by Sanyam Kakkar
        </div>
    </div>

    <!-- Include JavaScript scripts and Bootstrap libraries here -->

</body>
</html>
