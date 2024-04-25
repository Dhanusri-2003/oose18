<?php
// Retrieve form data
$username = $_POST['username'] ?? '';
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Database credentials
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current password from database based on username
$sql = "SELECT password FROM users1 WHERE name ='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    // Check if current password matches stored password
    if ($current_password === $stored_password) {
        // Check if new password and confirm password match
        if ($new_password === $confirm_password) {
            // Update password and confirm password in database
            $update_sql = "UPDATE users1 SET password='$new_password', confirm_password='$confirm_password' WHERE username='$username'";
            if ($conn->query($update_sql) === TRUE) {
                echo "Password changed successfully.";
                // Redirect to home page.html
                header("Location: homepage.html");
                exit();
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Incorrect current password.";
    }
} else {
    echo "User not found.";
}

// Close connection
$conn->close();
?>
