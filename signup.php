<?php
include 'config.php';

$registrationSuccessful = false;
$warningMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $name = $_POST['name'];
    $dob = $_POST['dob']; // Update to use the 'dob' field directly
    $password = $_POST['password'];

    // Check for duplicate email or mobile
    $checkDuplicateStmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR mobile = ?");
    $checkDuplicateStmt->bind_param("ss", $email, $mobile);
    $checkDuplicateStmt->execute();
    $checkDuplicateResult = $checkDuplicateStmt->get_result();

    if ($checkDuplicateResult === false) {
        echo "Error: " . $checkDuplicateStmt->error;
    } else {
        if ($checkDuplicateResult->num_rows > 0) {
            $warningMessage = "Email or Mobile already exists.";
        } else {
            $insertStmt = $conn->prepare("INSERT INTO users (email, mobile, name, dob, password) VALUES (?, ?, ?, ?, ?)");
            $insertStmt->bind_param("sssss", $email, $mobile, $name, $dob, $password);

            if ($insertStmt->execute()) {
                $registrationSuccessful = true;
                // Redirect to success page on successful registration
                header("Location: success_page.php");
                exit(); // Ensure that no further code is executed after redirection
            } else {
                echo "Error: " . $insertStmt->error;
            }

            $insertStmt->close();
        }
    }

    $checkDuplicateStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EngineerHub - Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #4a00f0, #8e2de2);
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .navbar {
            background-color: #333;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar a:hover {
            color: #17a2b8;
            transform: translateY(-2px);
        }

        .navbar-nav {
            margin: 0 auto;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        #reg-form {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 10px;
            margin-top: 70px;
            width: 600px;
            margin: 0 auto;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        #reg-form:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-label {
            width: 90px;
            margin-right: 30px;
            font-weight: bold;
            font-size: 16px;
        }

        .form-control {
            flex: 2;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #6c63ff;
        }

        .warning {
            color: red;
            margin-top: 10px;
        }

        #register-button {
            background-color: #6c63ff;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        #register-button:hover {
            background-color: #574dcf;
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(108, 99, 255, 0.4);
        }

        #loading-spinner {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">EngineerHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Registration Form -->
    <div class="container" id="reg-form">
        <h2 class="text-center">Sign Up</h2>
        <form id="registration-form" class="user" method="post" action="signup.php" onsubmit="submitForm()">
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="mobile">Mobile</label>
                <input class="form-control" type="text" name="mobile" placeholder="Mobile" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="dob">Date of Birth</label>
                <input class="form-control" type="date" name="dob" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">New Password</label>
                <input class="form-control" type="password" name="password" placeholder="New Password" required>
            </div>
            <?php if ($warningMessage): ?>
            <p class="warning"><?php echo $warningMessage; ?></p>
            <?php endif; ?>
            <button id="register-button" type="submit" class="btn btn-success">Register</button>
            <div id="loading-spinner" class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </form>
    </div>

    <div id="loading-modal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="loader.gif" alt="Loading..." width="80" height="80">
                    <p class="mt-2">Registering...</p>
                </div>
            </div>
        </div>
    </div>

    <div id="success-modal" class="modal fade" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your Learning begins here! Registration successful.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript function to submit the form
        function submitForm() {
            // Show loading spinner
            var loadingSpinner = document.getElementById("loading-spinner");
            loadingSpinner.style.display = "inline-block";

            // Disable the button to prevent multiple submissions
            var registerButton = document.getElementById("register-button");
            registerButton.disabled = true;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
