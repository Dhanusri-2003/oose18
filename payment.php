<?php
// Retrieve form data
$name = $_POST['name'] ?? '';
$card_number = $_POST['card_number'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert payment details into the database
$sql = "INSERT INTO payments (name, card_number, expiry_date, cvv) VALUES ('$name', '$card_number', '$expiry_date', '$cvv')";

if ($conn->query($sql) === TRUE) {
    // Redirect to home.html upon successful payment
    header("Location: confirmation.html");
    exit(); // Ensure that script stops executing after redirection
} else {
    echo "Error processing payment: " . $conn->error;
}

// Close connection
$conn->close();
?>
