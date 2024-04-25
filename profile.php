<?php
// MySQL database credentials
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username'];

// Retrieve user information from the database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    // Add more fields as needed
} else {
    echo "User not found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $name; ?>!</h2>
        <p>Your profile information:</p>
        <ul>
            <li><strong>Name:</strong> <?php echo $name; ?></li>
            <li><strong>Username:</strong> <?php echo $username; ?></li>
            <li><strong>Email:</strong> <?php echo $email; ?></li>
            <!-- Add more profile information as needed -->
        </ul>
    </div>
</body>
</html>
