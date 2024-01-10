<!-- <?php
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
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoursePulse - Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: black;
            padding: 15px 0;
        }

        .navbar a {
            color: black;
            text-decoration: none;
            margin: 0 15px;
        }

        .container {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        h2 {
            color: #6c63ff;
        }

        /* Form Labels and Inputs */
        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Submit Button */
        .btn-primary {
            background-color: #6c63ff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #574dcf;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="container">
            <a href="#">CoursePulse</a>
            <a href="#">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <h1>Edit Profile</h1>
        <div id="edit-details">
            <h2>Edit Personal Details</h2>
            <form class="user" method="post" action="update_profile_process.php">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required>
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" value="<?php echo $mobile; ?>" required>
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" value="<?php echo $dob; ?>" required>
                <button type="submit" class="btn btn-primary">Update Details</button>
            </form>
            <h2>Change Password</h2>
            <form class="user" method="post" action="change_password_process.php">
                <label for="currentPassword">Current Password</label>
                <input type="password" name="currentPassword" placeholder="Current Password" required>
                <label for="newPassword">New Password</label>
                <input type="password" name="newPassword" placeholder="New Password" required>
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</body>
</html>