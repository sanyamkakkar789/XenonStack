<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
</head>
<style>
    /* Apply styles to the registration container */
.registration-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Style the registration form labels */
.registration-container label {
    display: block;
    font-weight: bold;
    margin-top: 15px;
}

/* Style the registration form inputs */
.registration-container input[type="text"],
.registration-container input[type="email"],
.registration-container input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style the registration form button */
.registration-container button[type="submit"] {
    background-color: #6c63ff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.registration-container button[type="submit"]:hover {
    background-color: #574dcf;
}

/* Style error messages (if any) */
.error-message {
    color: red;
    margin-top: 10px;
    text-align: center;
}

/* Center the registration container vertically */
html, body {
    height: 100%;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}
</style>
<body>
    <div class="registration-container">
        <h2>Admin Registration</h2>
        <form method="post" action="admin_register_process.php"> <!-- Replace with the actual processing script -->
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
