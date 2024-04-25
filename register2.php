<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['student_name'];
$department = $_POST['department'];
$year = $_POST['year'];
$course_name = $_POST['course'];

// Fetch all course names
$sql_fetch_courses = "SELECT course_name, seats FROM courses";
$result_fetch_courses = $conn->query($sql_fetch_courses);

// Check if the selected course has available seats
$selected_course_has_seats = false;
if ($result_fetch_courses->num_rows > 0) {
    while ($row = $result_fetch_courses->fetch_assoc()) {
        echo "Course: " . $row['course_name'] . " - Seats: " . $row['seats'] . "<br>";
        if ($row['course_name'] == $course_name && $row['seats'] > 0) {
            $selected_course_has_seats = true;
        }
    }
}

// If selected course has no available seats, display a message
if (!$selected_course_has_seats) {
    echo "<script>alert('No seats available for $course_name. Please select another course.');</script>";
    header("Location: registration_form.php"); // Redirect back to registration form
    exit; // Exit the script
}

// Proceed with registration if the selected course has available seats
$sql_check_seats = "SELECT seats FROM courses WHERE course_name = '$course_name'";
$result_check_seats = $conn->query($sql_check_seats);

if ($result_check_seats->num_rows > 0) {
    $row = $result_check_seats->fetch_assoc();
    $seats = $row['seats'];
    if ($seats > 0) {
        $sql_insert = "INSERT INTO registration (student_name, department, year, course_name) VALUES ('$name', '$department', '$year', '$course_name')";
        if ($conn->query($sql_insert) === TRUE) {
            $updated_seats = $seats - 1;
            $sql_update_seats = "UPDATE courses SET seats = $updated_seats WHERE course_name = '$course_name'";
            if ($conn->query($sql_update_seats) === TRUE) {
                echo "<script>alert('Registration successful!');</script>";
                header("Location: payment.html"); // Redirect to success page
            } else {
                echo "Error updating seats: " . $conn->error;
            }
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('No seats available for $course_name. Please select another course.');</script>";
        header("Location: registration_form.php"); // Redirect back to registration form
    }
} else {
    echo "Error: Course not found.";
}

$conn->close();
?>
