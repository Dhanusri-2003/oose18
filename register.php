<?php
// Retrieve form data
$student_name = $_POST['student_name'] ?? '';
$department = $_POST['department'] ?? '';
$year = $_POST['year'] ?? '';
$course_name = $_POST['course_name'] ?? '';

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert registration data into the database
$sql = "INSERT INTO registration (student_name, department,year, course_name) VALUES ('$student_name', '$department', '$year', '$course_name')";

if ($conn->query($sql) === TRUE) {
    // Redirect to payment page upon successful registration
    header("Location: payment.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
