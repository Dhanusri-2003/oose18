<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script>
        function validateForm() {
            var course = document.getElementById("course").value;
            var courseOptions = document.getElementById("course").options;
            var seats = parseInt(courseOptions[courseOptions.selectedIndex].getAttribute('data-seats'));

            if (seats <= 0) {
                alert("No seats available for " + course + ". Please select another course.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-top: 20px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.alert {
    background-color: #f44336;
    color: white;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 4px;
}
</style>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="register2.php" method="POST" onsubmit="return validateForm()">
        <label for="student_name">Name:</label>
        <input type="text" id="student_name" name="student_name" required><br><br>
        
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required><br><br>
        
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>
        
        <label for="course">Course:</label>
        <select id="course" name="course" required>
            <option value="" disabled selected>Select a course</option>
            <?php
            // Fetch available courses from database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "your_database";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT course_name, seats FROM courses";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $course_name = $row['course_name'];
                    $seats = $row['seats'];
                    echo "<option value='{$course_name}' data-seats='{$seats}'>{$course_name}</option>";
                }
            } else {
                echo "<option value=''>No courses available</option>";
            }

            $conn->close();
            ?>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
