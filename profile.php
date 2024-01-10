<?php
session_start(); // Start the session
include 'config.php'; // Include the database configuration

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Fetch user details from the database
$userID = $_SESSION['user_id'];
$query = "SELECT name, email, mobile, dob FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $mobile, $dob);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Pulse - Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <style>
        body {
            background: linear-gradient(to right, #6c63ff, #574dcf); /* Gradient background */
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1 {
            color: #fff; /* White text color */
            font-weight: bold;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        #navbar {
            background-color: #333;
            padding: 10px 0;
        }

        #navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        #navbar ul li {
            display: inline;
            margin-right: 20px;
        }

        #navbar ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s;
        }

        #navbar ul li a:hover {
            color: #ffd700; /* Different color on hover (gold/yellow) */
        }

        #profile {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #profile h2 {
            color: #333;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }

        #personal-details {
            margin-top: 20px;
        }

        #personal-details h4 {
            color: #333;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        #personal-details p {
            color: #555;
            margin: 5px 0;
        }

        .btn-primary {
            background-color: #6c63ff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            font-size: 18px;
            display: block;
            margin: 20px auto;
        }

        .btn-primary:hover {
            background-color: #574dcf; /* Darker purple on hover */
        }
    </style>
</head>
<body>
    <h1>Welcome to Course Pulse</h1>
    <div id="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div id="profile">
        <h2>Profile Settings</h2>
        <div id="personal-details">
            <h4>Personal Details</h4>
            <p>Name: <?php echo $name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Mobile: <?php echo $mobile; ?></p>
            <p>Date of Birth: <?php echo $dob; ?></p>
            <a href="edit_profile.php" class="btn btn-primary">Edit Details</a>
        </div>
    </div>
</body>
</html>

