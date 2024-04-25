<?php
// Retrieve form data
$name = $_POST['name'] ?? '';
$department = $_POST['department'] ?? '';
$year = $_POST['year'] ?? '';
$college = $_POST['college'] ?? '';
$email = $_POST['email'];
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Check if password and confirm password match
if ($password !== $confirm_password) {
    echo "Error: Passwords do not match.";
    exit();
}

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

// Insert signup data into the database
$sql = "INSERT INTO users1 (name, department, year, college, email, username, password, confirm_password) 
        VALUES ('$name', '$department', '$year','$college', '$email','$username', '$password','$confirm_password')";

if ($conn->query($sql) === TRUE) {
    // Redirect to login page upon successful signup
    header("Location: login.html");
    exit(); // Ensure that script stops executing after redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
