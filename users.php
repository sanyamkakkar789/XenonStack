<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coursepulse";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    
    // Debugging: Log the received userId
    error_log("Received userId: " . $userId);

    // Perform the block operation in your database here
    $sql = "UPDATE users SET blocked = 1 WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

// Close the database connection
$conn->close();
?>
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coursepulse";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get user status as a string
function getUserStatus($blocked) {
    return $blocked ? 'Blocked' : 'Active';
}

// Retrieve user data from the database
$sql = "SELECT * FROM users"; // Replace 'users' with your table name
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>User Management</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["id"] . '</td>';
                        echo '<td>' . $row["name"] . '</td>';
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . getUserStatus($row["blocked"]) . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-danger" onclick="blockUser(' . $row["id"] . ')">Block</button> ';
                        echo '<button class="btn btn-warning" onclick="deleteUser(' . $row["id"] . ')">Delete</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" style="display:none;">
            Action completed successfully!
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript functions to handle actions -->
    <script>
        function blockUser(userId) {
            var confirmBlock = confirm("Are you sure you want to block this user?");
            if (confirmBlock) {
                $.post("block_user.php", { userId: userId }, function(data) {
                    console.log(data); // Add this line to check the server response
                    if (data === "success") {
                        // ... (success handling)
                    } else {
                        alert("Failed to block user. Please try again.");
                    }
                }).fail(function() {
                    alert("An error occurred while sending the request.");
                });
            }
        }

        function deleteUser(userId) {
            var confirmDelete = confirm("Are you sure you want to delete this user?");
            if (confirmDelete) {
                $.post("delete_user.php", { userId: userId }, function(data) {
                    if (data === "success") {
                        $("#success-alert").text("User deleted successfully!").fadeIn().delay(2000).fadeOut();
                        // Optionally, remove the user's row from the table here
                    } else {
                        alert("Failed to delete user. Please try again.");
                    }
                }).fail(function() {
                    alert("An error occurred while sending the request.");
                });
            }
        }
    </script>
</body>
</html>
