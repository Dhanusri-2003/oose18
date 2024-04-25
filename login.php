<?php
// Retrieve form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Database credentials
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "your_database";


// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query to check user credentials
$sql = "SELECT * FROM users1 WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Check if the query returned any rows (i.e., if the login is successful)
if ($result->num_rows > 0) {
    // Start session
    session_start();
    $_SESSION['username'] = $username; // Store username in session for future use

    // Redirect to the next page (replace 'next_page.php' with the desired page)
    header("Location: homepage.html");
    exit();
} else {
     header("Location: loginmisinfo.html");
}

// Close connection
$conn->close();
?>
